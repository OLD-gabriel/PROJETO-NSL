  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nsl-Professor</title>

    <link rel="stylesheet" href="css/style-PFR.css">
    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet"> 
  </head>

  <body>
    <?php
    $nome = $_GET['senha'];

    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "tutoria";

    $conn = new mysqli($host, $user, $password, $db);

    $sql = "SELECT nome_aluno, serie, ra FROM $nome";
    $result = $conn->query($sql);
    ?>

    <header class="header-bg">
      <div class="header">
        <img class="header-brazao" src="img/Imagem3.png" alt="Brazao">
        <div class="header-menu">
          <span class="nome"><?php echo $nome; ?></span>
          <img class="user" src="img/Imagem1.svg" alt="User">
        </div>
      </div>
    </header>

    <main class="main">
      <div class="alunos">
        <h1>Tutoria</h1>

        <h2>Alunos</h2>

        <?php

        echo "<table clas='teste'>";
        echo "<tr><th>Nome do Aluno</th><th>Série</th><th>RA</th></tr>";

        // Loop através dos resultados e exiba cada linha na tabela
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["nome_aluno"] . "</td><td>" . $row["serie"] . "</td><td>" . $row["ra"] . "</td></tr>";
        }

        echo "</table>";
        ?>
        <button class="export" onclick="exportToExcel()">Exportar para Excel</button>
      </div>
 
    </main>

    <script>
      function exportToExcel() { 
        
        var table = XLSX.utils.table_to_sheet(document.querySelector('table'));
 
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, table, 'Dados');
 
        XLSX.writeFile(wb, 'dados_alunos.xlsx');
      }
    </script>
  </body>

  </html>