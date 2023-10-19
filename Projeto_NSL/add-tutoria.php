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
        <h2 class="titulo">Inserção de Tutoria</h2>
        <form action="" method="post">
 
            <label for="1-nome">Dgite o nome do Professor:</label>
            <input type="text" required id="1-nome" class="nomes" name="1prof">

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
            <p> Tutoria inserida com <br> sucesso!</p>
            <button id="fechar-popup">Fechar</button>
        </div>
    </div>
    <div id="sobreposicao-popup2">
        <div id="conteudo-popup">
            <h2>Sucess</h2>
            <p> Tutoria inserida com <br> sucesso!</p>
            <button id="fechar-popup2">Fechar</button>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script>
        const botaoFecharPopup = document.getElementById('fechar-popup');
        const sobreposicaoPopup = document.getElementById('sobreposicao-popup');
        const botaoFecharPopup2 = document.getElementById('fechar-popup2');
        const sobreposicaoPopup2 = document.getElementById('sobreposicao-popup2');

        function fecharPopup() {
            sobreposicaoPopup.style.display = 'none';
        }

        function mostrarPopup() {
            sobreposicaoPopup.style.display = 'block';
        }

        function fecharPopup2() {
            sobreposicaoPopup2.style.display = 'none';
        }

        function mostrarPopup2() {
            sobreposicaoPopup2.style.display = 'block';
        }

        botaoFecharPopup.addEventListener('click', fecharPopup);
        botaoFecharPopup2.addEventListener('click', fecharPopup2);
    </script>
 
    <?php
    if (isset($_POST['enviar'])) {
        $professor_1 = $_POST["1prof"];
        $vagas = $_POST["vagas"];

        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "tutoria";

        $conn = new mysqli($host, $user, $password, $db);

        $mysqli = new mysqli($host, $user, $password, $db);
        $sql = "CREATE TABLE IF NOT EXISTS $professor_1 (  
            nome_tutor varchar(255),
            nome_aluno varchar(255),
            serie varchar(255),
            ra int,
            vagas int
            )default charset utf8;";
 
        if ($conn->query($sql) === TRUE) {
            echo "<script> mostrarPopup() </script>";
        }else{
            echo "<script> mostrarPopup2() </script>";

        } 
    }
    ?>
</body> 
</html>