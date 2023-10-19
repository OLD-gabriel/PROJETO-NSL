<?php
$RA = $_GET['RA'];
$serie = $_GET['serie'];
$nome = $_GET['nome'];

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
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.ELET.css">
  <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">

  <title>Eletiva | nsl</title>
</head>

<body>
  <header class="header">
    <div class="brazao">
      <a href="../Tutoria-Eletiva.html"><img src="img/brazao.png" alt="Brazao" class="brazao"></a>
    </div>

    <div class="header-user">
      <a href="#" class="nome">
        <?php echo $nome . "<br>" . $serie; ?>
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
      <span class'nome-tutor'>". $row["nome_eletiva"] ." <br> </span>                     
      <h2>Professores:</h2>  
      <span class'nome-eletiva'>". $row["professor_1"] ." <br> </span>
      <span class'nome-eletiva'>". $row["professor_2"] ." <br> </span>
      <span class'nome-eletiva'>". $row["professor_3"] ." <br> </span>
      <span class'nome-eletiva'>
      <b>vagas:</b>
      " . $row["vagas"] . "
      </span>
      <form action='' method='post'>
          <button type='submit' class='botao' name='".$row["nome_eletiva"]."' > Escolher </button>
      </form>
  </div>";
 
    }

    ?>
 


  </main>


</body>

</html>