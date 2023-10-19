<?php
$RA = $_GET['RA'];
$serie = $_GET['serie'];
$nome_aluno = $_GET['nome'];

$nometutor = "";


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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.TUT.css">
    <title>Escolha Tutoria</title>

    <meta http-equiv="refresh" content="30">

    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">

</head>

<body>
    <header class="header">
        <div class="brazao">
            <a href="../Tutoria-Eletiva.html"><img src="img/brazao.png" alt="Brazao" class="brazao"></a>
        </div>

        <div class="header-user">
            <a href="#" class="nome">
                <?php echo $nome_aluno . "<br>" . $serie; ?>
            </a>
            <img src="img/Imagem1.svg" alt="" class="user">
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
        <form action='' method='post'>
            <button type='submit' class='botao' name='tutores' value='escolher-" . $table . "' >Escolher</button>
        </form>
    </div>
 ";
        }
        ?>

    </main>
    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2 style="padding:5px;">CONFIRMADO!</h2>
            <p>Você selecionou tutor com <br> sucesso!</p>
            <div class="botoes">
                <button id="fechar-popup">Fechar</button>
            </div>
        </div>
    </div>

    <!-- Pop-up -->
    <div id="sobreposicao-popup2">
        <div id="conteudo-popup">
            <h2 style="padding:5px;">Erro!</h2>
            <p>Ocorreu um erro ao inserir registro! <br><br> Talvez você já tenha selecionado o tutor! <br> </p>
            <div class="botoes">
                <button id="fechar-popup2">Fechar</button>
            </div>
        </div>
    </div>

    <!-- Pop-up -->
    <div id="sobreposicao-popup3">
        <div id="conteudo-popup">
            <h2 style="padding:5px;">Erro!</h2>
            <p>Esse tutor atingiu o limite de vagas! <br> </p>
            <div class="botoes">
                <button id="fechar-popup3">Fechar</button>
            </div>
        </div>
    </div>

    <script>
        const botaoFecharPopup = document.getElementById('fechar-popup');
        const botaoFecharPopup2 = document.getElementById('fechar-popup2');
        const sobreposicaoPopup = document.getElementById('sobreposicao-popup');
        const sobreposicaoPopup2 = document.getElementById('sobreposicao-popup2');
        const botaoFecharPopup3 = document.getElementById('fechar-popup3');
        const sobreposicaoPopup3 = document.getElementById('sobreposicao-popup3');

        function fecharPopup() {
            sobreposicaoPopup.style.display = 'none';
        }

        function fecharPopup2() {
            sobreposicaoPopup2.style.display = 'none';
        }

        function fecharPopup3() {
            sobreposicaoPopup3.style.display = 'none';
        }

        function mostrarPopup() {
            sobreposicaoPopup.style.display = 'block';
        }

        function mostrarPopup2() {
            sobreposicaoPopup2.style.display = 'block';
        }

        function mostrarPopup3() {
            sobreposicaoPopup3.style.display = 'block';
        }

        botaoFecharPopup.addEventListener('click', fecharPopup);
        botaoFecharPopup2.addEventListener('click', fecharPopup2);
        botaoFecharPopup3.addEventListener('click', fecharPopup3);

        function esgotado_alex() {
            box_v = document.getElementById("alex_v");
            box = document.getElementById("alex");
            box.style.display = "block";
            box_v.style.display = "none";
        }

        function esgotado_vania() {
            box_v = document.getElementById("vania_v");
            box = document.getElementById("vania");
            box.style.display = "block";
            box_v.style.display = "none";
        }

        function esgotado_pedro() {
            box_v = document.getElementById("pedro_v");
            box = document.getElementById("pedro");
            box.style.display = "block";
            box_v.style.display = "none";
        }

        function esgotado_devilson() {
            box_v = document.getElementById("devilson_v");
            box = document.getElementById("devilson");
            box.style.display = "block";
            box_v.style.display = "none";
        }

        function esgotado_maikon() {
            box_v = document.getElementById("maikon_v");
            box = document.getElementById("maikon");
            box.style.display = "block";
            box_v.style.display = "none";
        }
    </script>

    <?php

    function escolherTutor($conn, $nometutor, $nome_aluno, $serie, $RA)
    {
        // Consulta para pegar o número de vagas disponíveis                                                                    
        $sql = "SELECT MIN(vagas) AS vagas_disponiveis FROM $nometutor";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $vagas = $row['vagas_disponiveis'];
        if ($vagas === null) {
            $vagas = 16;
        }
        if ($vagas > 0) {
            $vagas = $vagas - 1;

            // Inserir a escolha do aluno no banco de dados
            // Inserir a escolha do aluno na tabela correspondente
            $sql_inserir = "INSERT INTO $nometutor (nome_tutor, nome_aluno, serie, ra, vagas) VALUES ('$nometutor', '$nome_aluno', '$serie', '$RA', '$vagas')";

            try {
                if ($conn->query($sql_inserir) === TRUE) {

                    // Inserir os dados na tabela "tudo"

                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $db = "dados";
                    $conn = new mysqli($host, $user, $password, $db);

                    $sql_tudo = "INSERT INTO tudo (nome_tutor, nome_aluno, ra_aluno, serie) VALUES ('$nometutor', '$nome_aluno', '$RA', '$serie')";
                    if ($conn->query($sql_tudo) === TRUE) {
                        echo "<script>mostrarPopup()</script>";
                        exit();
                    } else {
                        echo "<script>mostrarPopup2()</script>";
                    }
                }
            } catch (mysqli_sql_exception $e) {
                // Erro de chave primária duplicada, exibir pop-up de erro
                echo "<script>mostrarPopup2()</script>";
            }
        } else {
            echo "<script>mostrarPopup3()</script>";
        }
    }
    if (isset($_POST["tutores"])) {
        $botaoclicado = $_POST["tutores"];
        $conn = new mysqli($host, $user, $password, $db);

        foreach ($tables as $table) {

            if ($botaoclicado === "escolher-" . $table) {
                $nometutor = $table;

                $host = "localhost";
                $user = "root";
                $password = "";
                $db = "tutoria";

                escolherTutor($conn, $nometutor, $nome_aluno, $serie, $RA);
            }
        }
    }

    ?>

</body>

</html>