<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestor | Nsl</title>
    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style-GST.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">

</head>

<body>
    <header class="header-bg">
        <div class="header">
            <img class="header-brazao" src="img/Imagem3.png" alt="Brazao">
            <div class="header-menu">
                <a href="#" class="nome">
                    ADMINISTRADOR
                </a>
                <img class="user" src="img/Imagem1.svg" alt="User">
            </div>
        </div>
    </header>

    <div class="main-box-add">
        <h2 class="titulo">Inserção de eletivas</h2>
        <form action="" method="post">

            <label for="nome-eletiva">Digite o nome da Eletiva:</label>
            <input type="text" required id="nome-eletiva" name="nome-eletiva" class="campos">

            <label for="1-nome">Dgite o 1º nome do Professor:</label>
            <input type="text" required id="1-nome" class="nomes" name="1prof">

            <label for="2-nome">Dgite o 2º nome do Professor:</label>
            <input type="text" id="2-nome" name="2prof" class="nomes">

            <label for="3-nome">Dgite o 3º nome do Professor(se tiver):</label>
            <input type="text" id="3-nome" name="3prof" class="nomes">

            <label for="vagas">Digite o numero de vagas:</label>
            <input type="text" class="N-vagas" name="vagas" required>

            <br><br>

            <div class="botoes">

                <input type="reset">
                <input type="submit" name="enviar">

            </div>
        </form>
    </div>



    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2>Sucess</h2>
            <p> Eletiva inserida com <br> sucesso!</p>
            <button id="fechar-popup">Fechar</button>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script>
        const botaoFecharPopup = document.getElementById('fechar-popup');
        const sobreposicaoPopup = document.getElementById('sobreposicao-popup');

        function fecharPopup() {
            sobreposicaoPopup.style.display = 'none';
        }
        function mostrarPopup() {
            sobreposicaoPopup.style.display = 'block';
        }

        botaoFecharPopup.addEventListener('click', fecharPopup);
    </script>



    <?php
    if (isset($_POST['enviar'])) {
        $nome_eletiva = $_POST["nome-eletiva"];
        $professor_1 = $_POST["1prof"];
        $professor_2 = $_POST["2prof"];
        $professor_3 = $_POST["3prof"];
        $vagas = $_POST["vagas"];

        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "eletiva";

        $conn = new mysqli($host, $user, $password, $db);

        $mysqli = new mysqli($host, $user, $password, $db);

        $sql = "CREATE TABLE IF NOT EXISTS $nome_eletiva ( 
                nome_eletiva varchar(255),
                professor_1 varchar(255),
                professor_2 varchar(255),    
                professor_3 varchar(255),    
                vagas int
            )";
        if ($conn->query($sql) === TRUE) {
            // Inserção dos dados na tabela
            $sql_insert = "INSERT INTO $nome_eletiva (nome_eletiva, professor_1, professor_2, professor_3, vagas) 
                               VALUES ('$nome_eletiva', '$professor_1', '$professor_2', '$professor_3', $vagas)";

            if ($conn->query($sql_insert) === TRUE) {
                echo "<script> mostrarPopup() </script>";
            }
 
        }
    }

    ?>
</body>

</html>