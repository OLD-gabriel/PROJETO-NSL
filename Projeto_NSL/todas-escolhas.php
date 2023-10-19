<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

$host = "localhost";
$user = "root";
$password = "";
$db = "dados";

$conn = new mysqli($host, $user, $password, $db);

$sql = "SELECT nome_tutor,nome_aluno,ra_aluno,serie FROM tudo ORDER BY nome_tutor ASC";
$result = $conn->query($sql);

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
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

    <br><br><br>

    <main class="main">
        <div class="alunos">
            <h1>Todas as escolhas</h1>

            <h2>Professores e Alunos</h2>

            <?php
            echo "<table class='teste'>";
            echo "<tr><th>Nome do professor</th><th>Nome do Aluno</th><th>Série</th><th>RA</th></tr>";

            // Loop através dos resultados e exiba cada linha na tabela
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nome_tutor"] . "</td>";
                echo "<td>" . $row["nome_aluno"] . "</td>";
                echo "<td>" . $row["serie"] . "</td>";
                echo "<td>" . $row["ra_aluno"] . "</td>";
                echo "</tr>";
                echo "<tr><td colspan='4'><hr></td></tr>"; // Adicione uma linha horizontal após cada linha de dados
            }

            echo "</table>";
            ?>


            <button class="export" onclick="exportToExcel()">Exportar para Excel</button>
            <button class="excluir-dados" onclick="mostrarPopup()" >Excluir dados</button>
        </div>

        <!-- Pop-up -->
        <div id="sobreposicao-popup">
            <div id="conteudo-popup">
                <h2>Excluir dados</h2>
                <p>Tem certeza que deseja <br>excluir todos os dados?</p>
                <button id="fechar-popup" >Fechar</button>
                <button class="enviar" name="enviar">Enviar</button>
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

            function exportToExcel() {

                var table = XLSX.utils.table_to_sheet(document.querySelector('table'));

                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, table, 'Dados');

                XLSX.writeFile(wb, 'dados_alunos.xlsx');



            }
        </script>
    </main>

</body>

</html>