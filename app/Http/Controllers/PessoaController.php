<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use App\Email;
use  App\Telefone;
use   App\Whatsapp;


class PessoaController extends Controller {
    protected $pessoaModel;

    public function __construct(Pessoa $pessoaModel) {
        $this->pessoaModel = $pessoaModel;
    }
    private function atualizarContato($modelo, $campo, $valor, $pessoaId) {
        $novoContato = new $modelo([$campo => $valor]);
        $novoContato->pessoa_id = $pessoaId;
        $novoContato->save();
    }
    public function buscarTodos(Request $request) {
        $pessoas = $this->pessoaModel->with(['emails', 'whatsapps', 'telefones'])->get();


        return view('home', ['pessoas' => $pessoas]);
    }

    public function buscarUm(Request $request) {
        $pessoaEncontrada = $this->pessoaModel->with(['emails', 'whatsapps', 'telefones'])->get()->find($request->id);


        return view('pessoa', ['pessoaEncontrada' => $pessoaEncontrada]);
    }
    public function salvar(Request $request) {
        $data = $request->only(['nome', 'email', 'telefone', 'whatsapp']);

        $pessoa = $this->pessoaModel->create($data);

        if ($request->filled('email')) {
            $pessoa->emails()->createMany([
                ['email' => $data['email']]
            ]);
        }

        if ($request->filled('whatsapp')) {
            $pessoa->whatsapps()->createMany([
                ['whatsapp' => $data['whatsapp']]
            ]);
        }

        if ($request->filled('telefone')) {
            $pessoa->telefones()->createMany([
                ['telefone' => $data['telefone']]
            ]);
        }

        $pessoas = $this->pessoaModel->all();
        return redirect()->route('home');
    }


    public function excluir(Request $request) {

        $pessoa = Pessoa::find($request->id);

        if (!$pessoa) {
            return redirect()->back()->with('error', 'Pessoa não encontrada.');
        }

        $pessoa->emails()->delete();
        $pessoa->telefones()->delete();
        $pessoa->whatsapps()->delete();

        $pessoa->delete();
        $pessoas = $this->pessoaModel->all();
        echo "<script>alert('Pessoa excluida com sucesso.');</script>";

        return redirect()->route('home');
    }

    public function atualizar(Request $request) {
        $pessoa = Pessoa::find($request->id);
        if (!$pessoa) {
            return redirect()->back()->with('error', 'Pessoa não encontrada.');
        }

        switch ($request->input('acao')) {
            case 'novo_telefone':
                if ($request->telefone == '') {
                    echo "<script>alert('Insira um telefone !');</script>";
                    break;
                }
                echo "<script>alert('Telefone cadastrado com sucesso.');</script>";

                $this->atualizarContato(Telefone::class, 'telefone', $request->input('telefone'), $pessoa->id);
                break;
            case 'editar_telefone':
                $telefoneId = $request->input('telefoneId');
                $telefone = Telefone::find($telefoneId);

                if ($telefone) {
                    $novoTelefone = $request->input('telefone');

                    $telefone->telefone = $novoTelefone;

                    $telefone->save();

                    echo "<script>alert('Telefone atualizado com sucesso.');</script>";
                } else {
                    echo "<script>alert('Telefone não encontrado.');</script>";
                }
                break;
            case 'limpar_telefone':
                $telefoneId = $request->input('telefoneId');
                $telefone = Telefone::find($telefoneId);
                if ($telefone) {
                    $telefone->delete();
                    echo "<script>alert('Telefone deletado com sucesso.');</script>";
                } else {
                    echo "<script>alert('Telefone não encontrado.');</script>";
                }
                break;
            case 'limpar_whatsapp':
                $whatsappId = $request->input('whatsappId');
                $whatsapp = Whatsapp::find($whatsappId);
                if ($whatsapp) {
                    $whatsapp->delete();
                    echo "<script>alert('Whatsapp deletado com sucesso!'); </script>";
                } else {
                    echo "<script>alert('WhatsApp não encontrado.');</script>";
                }
                break;
            case 'editar_whatsapp':
                $whatsappId = $request->input('whatsappId');
                $whatsapp = Whatsapp::find($whatsappId);

                if ($whatsapp) {
                    $novoWhatsapp = $request->input('whatsapp');

                    $whatsapp->whatsapp = $novoWhatsapp;

                    $whatsapp->save();

                    echo "<script>alert('Whatsapp atualizado com sucesso.');</script>";
                } else {
                    echo "<script>alert('Whatsapp não encontrado.');</script>";
                }
                break;
            case 'novo_whatsapp':
                if ($request->whatsapp == '') {
                    echo "<script>alert('Insira um whatsapp !');</script>";
                    break;
                }
                echo "<script>alert('Whatsapp cadastrado com sucesso.');</script>";

                $this->atualizarContato(Whatsapp::class, 'whatsapp', $request->input('whatsapp'), $pessoa->id);
                break;

            case 'novo_email':
                if ($request->email == '') {
                    echo "<script>alert('Insira um email !');</script>";
                    break;
                }
                echo "<script>alert('Email cadastrado com sucesso!'); </script>";

                $this->atualizarContato(Email::class, 'email', $request->input('email'), $pessoa->id);
                break;
            case 'editar_email':
                $emailId = $request->input('emailId');
                $email = Email::find($emailId);

                if ($email) {
                    $novoEmail = $request->input('email');

                    $email->email = $novoEmail;

                    $email->save();

                    echo "<script>alert('E-mail atualizado com sucesso.');</script>";
                } else {
                    echo "<script>alert('E-mail não encontrado.');</script>";
                }
                break;
            case 'limpar_email':
                $emailId = $request->input('emailId');
                $email = Email::find($emailId);
                if ($email) {
                    $email->delete();
                    echo "<script>alert('Email deletado com sucesso!'); </script>";
                } else {
                    echo "<script>alert('E-mail não encontrado.');</script>";
                }
                break;
        }


        $pessoa->update($request->only(['nome']));
        $pessoaEncontrada = $this->pessoaModel->with(['emails', 'whatsapps', 'telefones'])->get()->find($request->id);

        return view('pessoa', ['pessoaEncontrada' => $pessoaEncontrada]);
    }


    public function pesquisar(Request $request) {
        $nome = $request->input('busca');

        $pessoas = $this->pessoaModel->whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($nome) . '%'])->get();

        return view('home', ['pessoas' => $pessoas]);
    }

    function validarSequenciaColchetes(Request $request) {

        $sequencia = $request->sequencia;
        if (!$sequencia) {
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
        if (empty($pilha) == 1) {
            echo "<script>alert('A sequência é valida.'); window.location.href = '/home'</script>";
        } else {
            echo "<script>alert('A sequência não é válida!'); window.location.href = '/home'</script>";
        }
    }
}
