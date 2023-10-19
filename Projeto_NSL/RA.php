<?php
// Configurações de conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$db = "dados";
$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $RA = $_POST["codigo"];
    // Substitua "sua_tabela" pelo nome da tabela onde os dados estão armazenados
    
    $sql = "SELECT nomes, turmas FROM alunos WHERE ra = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $RA);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $nome = $row['nomes'];
        $serie = $row['turmas'];

        // Retorne os resultados como JSON
        echo json_encode(["success" => true, "nome" => $nome, "serie" => $serie]);
    } else {
        // Código não encontrado
        echo json_encode(["success" => false]);
    }
} else {
    // Requisição não é POST
    echo json_encode(["success" => false]);
}

$conn->close();
?>