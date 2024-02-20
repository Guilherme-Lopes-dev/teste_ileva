<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pessoa</title>
</head>
<style>
    button {
        margin: 3px;
        border-radius: 5px;
        background-color: #723788;
        color: #fff;
        border: none;
        text-decoration: none;
        padding: 6px 12px;
        cursor: pointer;
        max-width: 200px;
    }

    button:disabled {
        cursor: not-allowed;
        background-color: #3a1d44;

    }

    input {
        border-radius: 5px;
        height: 24px;
        max-width: 300px;
    }
</style>

<body>
    <header style="display:flex; width:100%; justify-content:space-between;">
        <h4>Usuário: </h4>
        <a href="/home">Voltar ao inicio</a >
    </header>
    <form method="post" action="/atualizar/{{ $pessoaEncontrada->id }}">
        <input type="text" value="{{ $pessoaEncontrada->nome }}" name="nome" id="nome" />
        <button type="submit">
            Atualizar Nome
        </button>
    </form>
    <div>
        <div style="display:flex; flex-direction:column">
            <div style="margin:5px;">Email's cadastrados:</div>
            @if ($pessoaEncontrada->emails)
                <ul>
                    @foreach ($pessoaEncontrada->emails as $emails)
                        <li>
                            <form method="post" action="/atualizar/{{ $pessoaEncontrada->id }}">


                                <input type="text" value="{{ $emails->email }}" name="email" id="email" />

                                <input type="hidden" value="{{ $emails->id }}" name="emailId" id="emailId" />
                                <button type="submit" name="acao" value="editar_email">Editar
                                    Email</button>
                                <button type="submit" name="acao" value="limpar_email">Excluir
                                    Email</button>
                        </li>
                        </form>
                    @endforeach

                </ul>
            @endif
            <form method="post" action="/atualizar/{{ $pessoaEncontrada->id }}">
                <label for="email" style="margin:5px;">Novo e-mail</label>
                <input type="email" value="" name="email" id="email" />
                <button type="submit" name="acao" id="salvar_email" value="novo_email">Salvar
                    Email</button>
            </form>
        </div>
        <br>
        <br>
        <hr>
        <br>
        <br>
        <div style="display:flex; flex-direction:column">
            <div style="margin:5px;">Whatsapp's cadastrados:</div>
            @if ($pessoaEncontrada->whatsapps)
                <ul>
                    @foreach ($pessoaEncontrada->whatsapps as $whatsapps)
                        <li>
                            <form method="post" action="/atualizar/{{ $pessoaEncontrada->id }}">


                                <input type="number" value="{{ $whatsapps->whatsapp }}" name="whatsapp"
                                    id="whatsapp" />

                                <input type="hidden" value="{{ $whatsapps->id }}" name="whatsappId" id="whatsappId" />
                                <button type="submit" name="acao" value="editar_whatsapp">Editar
                                    Whatsapp</button>
                                <button type="submit" name="acao" value="limpar_whatsapp">Excluir
                                    Whatsapp</button>
                        </li>
                        </form>
                    @endforeach

                </ul>
            @endif
            <form method="post" action="/atualizar/{{ $pessoaEncontrada->id }}">
                <label for="whatsapp" style="margin:5px;">Novo Whatsapp</label>
                <input type="number" value="" name="whatsapp" id="whatsapp" />
                <button type="submit" name="acao" id="novo_whatsapp" value="novo_whatsapp">Salvar
                    Whatsapp</button>
            </form>
        </div>
        <br>
        <br>
        <hr>
        <br>
        <br>
        <div style="display:flex; flex-direction:column">
            <div style="margin:5px;">Telefones cadastrados:</div>
            @if ($pessoaEncontrada->telefones)
                <ul>
                    @foreach ($pessoaEncontrada->telefones as $telefones)
                        <li>
                            <form method="post" action="/atualizar/{{ $pessoaEncontrada->id }}">


                                <input type="number" value="{{ $telefones->telefone }}" name="telefone"
                                    id="telefone" />

                                <input type="hidden" value="{{ $telefones->id }}" name="telefoneId" id="telefoneId" />
                                <button type="submit" name="acao" value="editar_telefone">Editar
                                    Telefone</button>
                                <button type="submit" name="acao" value="limpar_telefone">Excluir
                                    Telefone</button>
                        </li>
                        </form>
                    @endforeach

                </ul>
            @endif
            <form method="post" action="/atualizar/{{ $pessoaEncontrada->id }}">
                <label for="telefone" style="margin:5px;">Novo Telefone</label>
                <input type="number" value="" name="telefone" id="telefone" />
                <button type="submit" name="acao" id="novo_telefone" value="novo_telefone">Salvar
                    Telefone</button>
            </form>
        </div>
    </div>
    </form>
    <div style="display: flex; justify-content: flex-end;">
        <form method="post" action="/excluir/{{ $pessoaEncontrada->id }}">
            <button type="submit">Remover</button>
        </form>
    </div>


</body>
<script></script>

</html>
