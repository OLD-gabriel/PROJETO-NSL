<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "tutoria";
$conn = new mysqli($host, $user, $password, $db);


$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tables[] = $row['Tables_in_' . $db];
    }
}

?>
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

    <main class="tutor">

        <?php
        foreach ($tables as $table) {
            $sql = "SELECT MIN(vagas) AS vagas_disponiveis FROM $table ";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($row["vagas_disponiveis"] == NULL) {
                $row["vagas_disponiveis"] = 16;
            }
            $vagas[$table] = $row['vagas_disponiveis'];

            echo "
    <div class='tutores'>
        <img src='img/avatar.png' alt='' class=''>
        <span class='nome-tutor'>" . $table . "<br>
            vagas:
            " . $vagas[$table] . "
        </span>
        <form action='' method='get'>
            <button type='submit' class='botao-ver' name='tutores' value='escolher-" . $table . "' >Ver alunos</button>
        </form>
        <form action='' method='get'>
          <button type='submit' class='botao-excluir' name='excluir' value='excluir-" . $table . "'>Excluir</button> 
      </form>
    </div>
 ";
 
        }
        ?>

    </main>
    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2>Sucess</h2>
            <p> tutoria excluida com sucesso! <br> recarregue a pagina </p>
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

    if (isset($_GET["excluir"])) {
        $botaoclicado = $_GET["excluir"];
        foreach ($tables as $table) {
            if ($botaoclicado === "excluir-" . $table) {

                $host = "localhost";
                $user = "root";
                $password = "";
                $db = "tutoria";

                $conn = new mysqli($host, $user, $password, $db);

                $sql_excluir = "DROP TABLE " . $table;


                if ($conn->query($sql_excluir) === TRUE) {
                    echo "<script>mostrarPopup()</script>";
                }
                $conn->close();
            }
        }
    }   

    if (isset($_GET["tutores"])) {
        
        $botaoclicado = $_GET["tutores"];
        foreach ($tables as $table) {
            if ($botaoclicado === "escolher-" . $table) {
                $nome = $table ;
                $url = "tutorandos.php?nome=" . urldecode($nome);
                header("location: $url");
            }
        }
    }

    ?>
</body>

</html>