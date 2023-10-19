<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escolha Eletiva</title>
  <link rel="stylesheet" href="CSS/style-ELT.css">

  <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">
</head>

<body>
  <?php
  $RA = $_GET['RA'];
  $serie = $_GET['serie'];
  $nome = $_GET['nome'];
  ?>


  <header class="header-bg">
    <div class="header">
      <img class="header-brazao" src="img/Imagem3.png" alt="Brazao">
      <div class="header-menu">
        <a href="#" class="nome">
          <?php echo $nome ."<br>" .$serie;?>
        </a>
        <img class="user" src="img/Imagem1.svg" alt="User">
      </div>
    </div>
  </header>

  <main class="main-bg">
    <div class="main-caixa">

      <form action="" method="post">
        <button type="submit" name="eletiva" Class="animated-button1">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          ELETIVA
        </button>
      </form>
      <form action="" method="post">
        <button type="submit" name="tutoria" class="animated-button1">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          TUTORIA
        </button>
      </form>
    </div>
  </main>

  <?php 
    if(isset($_POST["eletiva"])){
      $url = "eletiva.php?RA=" . urlencode($RA) . "&nome=" . urlencode($nome) . "&serie=" . urlencode($serie);
      header("location: $url");
    }

    if(isset($_POST["tutoria"])){
      $url = "tutoria.php?RA=" . urlencode($RA) . "&nome=" . urlencode($nome) . "&serie=" . urlencode($serie);
      header("location: $url");
    }
  ?>


</body>

</html>