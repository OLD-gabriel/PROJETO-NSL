<?php  
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "dados";

    $conn = new mysqli($host, $user, $password, $db);

    $sql = "SELECT ra, nomes, turmas FROM alunos ORDER BY nomes ASC";
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">
    <style>
    td {
        padding: 2px 4vw;
    }
    </style>
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

    <main class="main">
        <div class="alunos">
            <h1>Todos os alunos</h1>

            
            <?php

        echo "<table class='teste'>";
        echo "<tr><th>Nome do Aluno</th><th>Série</th><th>RA</th></tr> ";
        $vagas = 0;
        // Loop através dos resultados e exiba cada linha na tabela
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["nomes"] . "</td><td>" . $row["turmas"] . "</td><td>" . $row["ra"] . "</td></tr>";
          echo "<tr><td colspan='4'><hr></td></tr>"; 
        }

        echo "</table>";
        ?> 
            <button class="export" onclick="exportToExcel()">Exportar para Excel</button>
        </div>

        <script>
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