<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use App\Contato;


class PessoaController extends Controller {
    protected $pessoaModel;

    public function __construct(Pessoa $pessoaModel) {
        $this->pessoaModel = $pessoaModel;
    }

    public function show(Request $request) {
        $pessoas = $this->pessoaModel->with('contatos')->get();

        return view('home', ['pessoas' => $pessoas]);
    }
    public function salvar(Request $request) {
        $pessoa = $this->pessoaModel->create($request->only(['nome', 'email', 'telefone', 'whatsapp']));

        $pessoa->contatos()->create([
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'whatsapp' => $request->input('whatsapp'),
        ]);

        $pessoas = $this->pessoaModel->all();
        return redirect()->route('home');
    }

    public function excluir(Request $request) {

        $pessoa = Pessoa::find($request->id);

        if (!$pessoa) {
            return redirect()->back()->with('error', 'Pessoa não encontrada.');
        }

        $pessoa->contatos()->delete();
        $pessoa->delete();
        $pessoas = $this->pessoaModel->all();

        return redirect()->route('home');
    }

    public function atualizar(Request $request) {

        $pessoa = Pessoa::find($request->id);

        if (!$pessoa) {
            return redirect()->back()->with('error', 'Pessoa não encontrada.');
        }

        switch ($request->input('acao')) {
            case 'limpar_email':
                $request->merge(['email' => '']);
                break;
            case 'limpar_telefone':
                $request->merge(['telefone' => '']);
                break;
            case 'limpar_whatsapp':
                $request->merge(['whatsapp' => '']);
                break;
        }

        $pessoa->update($request->only(['nome']));

        $contato = Contato::firstOrNew(['pessoa_id' => $pessoa->id]);

        $contato->update($request->only(['email', 'telefone', 'whatsapp']));

        return redirect()->route('home');
    }

    public function pesquisar(Request $request) {
        $nome = $request->input('busca');
    
        $pessoas = $this->pessoaModel->whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($nome) . '%'])->get();
    
        return view('home', ['pessoas' => $pessoas]);
    }

    function validarSequenciaColchetes(Request $request) {

        $sequencia = $request->sequencia;
        if(!$sequencia){
            echo "<script>alert('Insira algo a ser validado'); window.location.href = '/home';</script>";

        }

        $pilha = [];
        $mapeamento = [
            ')' => '(',
            '}' => '{',
            ']' => '[',
        ];

        for ($i = 0; $i < strlen($sequencia); $i++) {
            $char = $sequencia[$i];

            if (in_array($char, [')', '}', ']'])) {
                $topo = array_pop($pilha);

                if ($topo !== $mapeamento[$char]) {
                }
            } else {
                array_push($pilha, $char);
            }
        }
        if(empty($pilha) == 1){
            echo "<script>alert('A sequência é valida.'); window.location.href = '/home'</script>";

        } else {
            echo "<script>alert('A sequência não é válida!'); window.location.href = '/home'</script>";
        }

    }
}
