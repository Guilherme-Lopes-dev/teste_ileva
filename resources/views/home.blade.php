<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste Backend</title>
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
    }

    input {
        border-radius: 5px;
        height: 24px;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

    .person_container {
        border-radius: 5px;
        -webkit-box-shadow: 3px 2px 11px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 3px 2px 11px 0px rgba(0, 0, 0, 0.75);
        box-shadow: 3px 2px 11px 0px rgba(0, 0, 0, 0.75);
    }
    .name{
        background-color: white;
        padding:5px;
        border-radius: 5px;

    }
</style>

<body style="background-color: darkgray">
    <div id="salvar">
        <div style=" display:flex; justify-content:space-between;">
            <form action="/salvar" method="post">
                <h4>
                    Cadastre um novo usuário:
                </h4>
                <input type="text" id="nome" name="nome" placeholder="Nome Completo" required><br><br>
                <input type="number" id="telefone" name="telefone" placeholder="Telefone"><br><br>
                <input type="number" id="whatsapp" name="whatsapp" placeholder="WhatsApp"><br><br>
                <input type="email" id="email" name="email" placeholder="E-mail"><br><br>

                <button type="submit">
                    Salvar
                </button>
            </form>
            <div id="consulta">
                <h4>Buscar um usuário</h4>
                <form action="/pesquisar" method="post">
                    <input type="text" name="busca" id="busca">
                    <button type="submit">Buscar </button>
                </form>
                <form action="/home" method="get">
                    <button type="submit">Buscar Todos</button>
                </form>
            </div>
            <div style="display:flex; justify-content:flex-start;padding:100px;">
                <form method="post" action="/validar">
                    <label for="sequencia">Insira uma sequência de colchetes, parenteses ou chaves</label>
                    <input type="text" style="font-size:14px; width:300px;" name="sequencia" /><br />
                    <button type="submit">Validar</button>
                </form>
            </div>
        </div>



        <h4>Usuários Cadastrados</h4>
        <div style="display:flex; ">
            @foreach ($pessoas as $pessoa)
                <div class="person_container"
                    style=" border:1px solid darkgrey; padding:10px; margin:25px; display:flex; justify-content:space-between; flex-direction:column   ">
                    <form method="post" action="/atualizar/{{ $pessoa->id }}"
                        style="display: flex; flex-direction:row; padding:25px; justify-content:space-between;">
                        <div style="margin:15px 0px;">
                            <label for="nome" style="margin:5px;">Nome:</label>
                            <p class="name">{{ $pessoa->nome }}</p>
                       
                        </div>
                    </form>
                    <div style="display: flex; justify-content: flex-end;">
                        <form method="get" action="/pessoa/{{ $pessoa->id }}">
                            <button>Ver Pessoa</button>
                        </form>
                        <form method="post" action="/excluir/{{ $pessoa->id }}">
                            <button type="submit">Remover</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>




</body>


</html>
