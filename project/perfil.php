<?php
session_start(); // Inicia a sessão
include("protect.php"); // Inclui o arquivo de proteção
include("conexao.php"); // Inclui o arquivo de conexão ao banco de dados

if (!isset($_SESSION['email'])) {
    echo "<p style='color: red;'>Você não está logado.</p>";
    // Para depuração, exiba o conteúdo da sessão
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    exit();
}

// Obtém o email do usuário da sessão
$email = $_SESSION['email'];

// Busca as informações do usuário no banco de dados
$sql_code = "SELECT * FROM pessoa WHERE email = ?";
$stmt = $mysqli->prepare($sql_code);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
} else {
    echo "<p style='color: red;'>Usuário não encontrado.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frog Tech - Perfil de Usuário</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #eeeeee;
            padding: 20px;
        }
        .perfil-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .user-info {
            margin-bottom: 20px;
            color: #555;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="perfil-container">
        <h1>Perfil de Usuário</h1>
        <div class="user-info">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome']); ?></p>
            <p><strong>Data de Cadastro:</strong> <?php echo htmlspecialchars($usuario['data_cadastro']); ?></p>
        </div>
        <div style="text-align: center;">
            <a href="logout.php">Sair</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Meu Site. Todos os direitos reservados a Frog Tech.</p>
    </footer>
</body>
</html>
