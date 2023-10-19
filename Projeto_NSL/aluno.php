<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Aluno | Nsl</title>
    <link rel="shortcut icon" href="img/favicon (3).ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style-LG.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800&display=swap" rel="stylesheet">

    <style>
        /* Estilos do pop-up */
        #sobreposicao-popup {
            display: none;
            /* Inicialmente oculto */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        #conteudo-popup {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        #fechar-popup {
            border: none;
            width: 82px;
            height: 40px;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            background-color: #007bff;
            font-size: 20px;
        }

        button:hover {
            cursor: pointer;
        }
        input[type='submit']{
            cursor:pointer;
        }
    </style>
</head>

<body>
<header class="header-bg">
    <div class="header">
      <img src="img/Imagem3.png" alt="Brazão do Nossa Senhora de Lourdeso" class="brazao">
      <div class="barra">
        <ul class="header-menu">
          <a href="gestor.php">
            <li>Gestor</li>
          </a>
          <a href="professor.php">
            <li>Professor</li>
          </a>
        </ul>
      </div>
    </div>
  </header>


   
    <main class="main-bg">
    <div class="main-caixa">
    
      <h1 class="main-login">LOGIN</h1>

      <form action="" class="main-form" method="post" >
        <label for="" class="main-label">
          Ra:
          <input type="text" class="main-input"  name="RA" placeholder="000000" required>

          <img src="img/icons8-lock-30.png" alt="">
          </label>
      
          <input type="submit" value="Entrar" name="enviar" class="botao">
      </form>
    </div>
  </main>

    <!-- Pop-up -->
    <div id="sobreposicao-popup">
        <div id="conteudo-popup">
            <h2>Ocorreu um erro</h2>
            <p>Infelizmente não encontramos nenhum <br> aluno com esse RA</p>
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
        $RA = $_POST['RA'];
        // ... configuração da conexão ao banco de dados ...
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "dados";

        $conn = new mysqli($host, $user, $password, $db);

        $sql = "SELECT nomes, turmas FROM alunos WHERE ra = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $RA);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // ... processar os dados e redirecionar ...
            $row = $result->fetch_assoc();
            $nome = $row['nomes'];
            $serie = $row['turmas'];

            $url = "Tutoria-eletiva.php?RA=" . urlencode($RA) . "&nome=" . urlencode($nome) . "&serie=" . urlencode($serie);
            header("location: $url");

            exit;
        } else {
            // Mostrar o pop-up de erro
            echo "<script> mostrarPopup() </script>";
        }
    }
    ?>

</body>

</html>