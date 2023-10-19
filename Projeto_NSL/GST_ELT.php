<?php


$host = "localhost";
$user = "root";
$password = "";
$db = "eletiva";

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
    <link rel="stylesheet" href="css/style.ELET.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">

</head>

<body>
    <header class="header">
        <div class="brazao">
            <a href="../Tutoria-Eletiva.html"><img src="img/brazao.png" alt="Brazao" class="brazao"></a>
        </div>

        <div class="header-user">
            <a href="#" class="nome">
                ADMINISTRADOR
            </a>
            <img src="img/Imagem1.svg" alt="" class="user">
        </div>
    </header>



    <main class="eletiva-bg">

        <?php

        foreach ($tables as $table) {
            $sql = "SELECT * FROM $table";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            echo "                                                  
      <div class='eletivas'> 
      <h2>ELETIVA:</h2>  
      <span class'nome-tutor'>" . $row["nome_eletiva"] . " <br> </span>                     
      <h2>Professores:</h2>  
      <span class'nome-eletiva'>" . $row["professor_1"] . " <br> </span>
      <span class'nome-eletiva'>" . $row["professor_2"] . " <br> </span>
      <span class'nome-eletiva'>" . $row["professor_3"] . " <br> </span>
      <span class'nome-eletiva'>
      <b>vagas:</b>
      " . $row["vagas"] . "
      </span>
      <form action='' method='post'>
          <button type='submit' class='botao' name='" . $row["nome_eletiva"] . "' > Ver alunos   </button> 
      </form> 
      <form action='' method='get'>
          <button type='submit' class='botao-excluir' name='excluir' value='excluir-" . $table . "'>Excluir</button> 
      </form> 

  </div>";

        }
        ?>
        
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

        if (isset($_GET["excluir"])) {
            $botaoclicado = $_GET["excluir"];
            foreach ($tables as $table) {
                if ($botaoclicado === "excluir-" . $table) {

                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $db = "eletiva"; 
                    
                    $conn = new mysqli($host, $user, $password, $db);
 
                    $sql_excluir = "DROP TABLE " . $table;


                    if ($conn->query($sql_excluir) === TRUE) {
                        echo "<script>mostrarPopup()</script>";
                    }   
                    $conn->close();
                }
            }
        }

        ?>

    </main>

</body>

</html>