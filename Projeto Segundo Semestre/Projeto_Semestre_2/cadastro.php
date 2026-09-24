<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Cadastro</title>
</head>

<body>
    <div class="container">
        <div class="abacate">
            <br><br>
            <h1>Cadastro de Usuário</h1>

            <div id="mensagem-geral"></div>

            <p class="login">
                Já possui login?
                <a href="login.php">Clique aqui</a>
            </p>

        </div>
        <!--O "event" é quando o formulário é enviado-->
        <form action="banco.php" method="post" id="formulario" onsubmit="cadastrar(event)" novalidate>

            <div class="lado-esquerdo">

                <label>Nome completo</label>
                <!-- Regex que permite colocar somente caracteres alfabéticos e não permite espaços no final ou no inicio do nome-->
                <input name="nome" pattern="^[A-Za-zÀ-ÿ]+(?:\s+[A-Za-zÀ-ÿ]+)+$" type="text"
                    placeholder="Digite seu nome completo" minlength="15" maxlength="80" required>

                <label>Data de nascimento</label>
                <input name="data_nascimento" type="date" placeholder="Digite sua data de nascimento" required
                    max="2026-06-01" min="1906-01-01">

                <label>Gênero</label>
                <select name="genero" required>
                    <option disabled selected></option>
                    <option>Masculino</option>
                    <option>Feminino</option>
                    <option>Outros</option>
                </select>

                <label>Nome da mãe</label><!-- Só pode colocar letras-->
                <input name="nome_materno" pattern="^[A-Za-zÀ-ÿ]+(?:\s+[A-Za-zÀ-ÿ]+)+$" type="text"
                    placeholder="Digite o nome materno" required>

                <label>Email</label>
                <input name="email" id="email" type="email" placeholder="Digite seu email" required>

                <label>CEP</label>
                <input name="cep" id="CEP" type="text" placeholder="Digite seu CEP" required maxlength="9">
                <small id="erro-cep"></small>
                <br><br>

                <input name="rua" type="text" id="logradouro" placeholder="Rua" readonly>
                <br><br>

                <input name="bairro" type="text" id="bairro" placeholder="Bairro" readonly>
                <br><br>

                <input name="cidade" type="text" id="cidade" placeholder="Cidade" readonly>
                <br><br>

                <input name="estado" type="text" id="estado" placeholder="Estado" readonly>
                <br>


            </div>

            <div class="lado-direito">

                <label>CPF</label>
                <input name="cpf" id="CPF" type="text" placeholder="Digite seu CPF" required>
                <small id="erro-cpf"></small>

                <label>Número de celular</label>
                <input name="telefone_celular" id="celular" type="text" placeholder="Digite seu n° de celular" required>
                <small id="erro-celular"></small>

                <label>Número do telefone fixo</label>
                <input name="telefone_fixo" id="telefone" type="text" placeholder="Digite o telefone fixo" required>
                <small id="erro-telefone"></small>

                <label>Senha</label>
                <input name="senha" minlength="8" id="senha" type="password" placeholder="Digite uma senha" required>

                <label>Confirmar Senha</label>
                <input minlength="8" id="senha2" type="password" placeholder="Confirme a senha" required>
                <small id="erro-senha"></small>

            </div>

            <div class="botoes">

                <button type="submit">
                    Enviar
                </button>

                <button type="reset">
                    Limpar Tela
                </button>

                
            </div>

        </form>

    </div>


</body>

<script src="js/cadastro.js"></script>
<!--Script da submascara-->
<script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>

<!--Script da submascara-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--Script da submascara-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
    integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="js/mascaras.js"></script>

</html>