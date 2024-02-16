<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="display:flex; justify-content:space-between">
    <div>
        <form>
            <h4>
                Cadastre um novo usuário:
            </h4>

        </form>
        <form action="/salvar" method="post">
            <input type="text" id="nome" name="nome" placeholder="Nome Completo" required><br><br>
            <input type="number" id="telefone" name="telefone" placeholder="Telefone"><br><br>
            <input type="number" id="whatsapp" name="whatsapp" placeholder="WhatsApp"><br><br>
            <input type="email" id="email" name="email" placeholder="E-mail"><br><br>

            <button type="submit">
                Salvar
            </button>
        </form>

        <p>Usuários Cadastrados</p>
        <div style="display: flex;">
            @foreach ($pessoas as $pessoa)
                <div
                    style="max-width:fit-content; border:1px solid darkgrey; padding:10px; margin:25px; display:flex; justify-content:space-between; flex-direction:column">
                    <div>
                        <p style="margin:0;">{{ $pessoa->nome }}</p>

                    </div>
                    @if ($pessoa->contatos->isNotEmpty())
                        <div>
                            @foreach ($pessoa->contatos as $contato)
                                <form method="post" action="/atualizar/{{ $pessoa->id }}"
                                    style="display: flex; flex-direction:column; padding:25px;">
                                    <span>Contatos:</span>

                                    <label for="email" style="margin:5px;">Email</label>
                                    <input type="email" value="{{ $contato->email }}" name="email" id="email" />
                                    @if ($contato->email)
                                        <button type="submit" name="acao" value="limpar_email">Excluir
                                            Email</button>
                                    @endif

                                    <label for="telefone" style="margin:5px;">Telefone</label>
                                    <input type="number" value="{{ $contato->telefone }}" name="telefone" />
                                    @if ($contato->telefone)
                                        <button type="submit" name="acao" value="limpar_telefone">Excluir
                                            Telefone</button>
                                    @endif

                                    <label for="whatsapp" style="margin:5px;">WhatsApp</label>
                                    <input type="number" value="{{ $contato->whatsapp }}" name="whatsapp" />
                                    @if ($contato->whatsapp)
                                        <button type="submit" name="acao" value="limpar_whatsapp">Excluir
                                            WhatsApp</button>
                                    @endif

                                    <button type="submit" style="width: 100%; margin-top:15px;">Editar Pessoa</button>
                                </form>
                            @endforeach
                        </div>
                    @endif
                    <div style="display: flex; justify-content: flex-end;">
                        <form method="post" action="/excluir/{{ $pessoa->id }}">
                            <button type="submit">Remover</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <div style="display:flex; justify-content:flex-start;padding:100px;">
        <form method="post" action="/validar">
            <input type="text" placeholder="Sequencia" style="font-size:28px" name="sequencia" /><br />
            <button type="submit">Validar</button>
        </form>
    </div>

</body>


</html>
