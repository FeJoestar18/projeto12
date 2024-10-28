<?php
session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}

// Conexão com o banco de dados
include 'conexao.php'; // Inclua seu arquivo de conexão aqui

// Verifique se a conexão foi criada
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Obtenha as informações do usuário
$email = $_SESSION['email'];
$query = "SELECT * FROM pessoa WHERE email = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
} else {
    die("Erro ao preparar a consulta: " . $conn->error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = $_POST['nome'];
    $novo_email = $_POST['email'];
    $novo_telefone = $_POST['telefone'];
    $novo_cpf = $_POST['cpf'];
    $nova_senha = $_POST['senha'];

    // Verifica se o novo e-mail já está em uso
    $email_check_query = "SELECT email FROM pessoa WHERE email = ? AND email != ?";
    $email_check_stmt = $conn->prepare($email_check_query);
    $email_check_stmt->bind_param("ss", $novo_email, $email);
    $email_check_stmt->execute();
    $email_check_result = $email_check_stmt->get_result();

    if ($email_check_result->num_rows > 0) {
        $error_message = "Esse e-mail já está em uso. Por favor, escolha outro.";
    } else {
        // Atualiza as informações no banco de dados
        $update_query = "UPDATE pessoa SET nome = ?, email = ?, telefone = ?, cpf = ?" . 
                        (empty($nova_senha) ? "" : ", senha = ?") . 
                        " WHERE email = ?";
        
        $update_stmt = $conn->prepare($update_query);
        
        // Monta os parâmetros do bind
        if (empty($nova_senha)) {
            $update_stmt->bind_param("sssss", $novo_nome, $novo_email, $novo_telefone, $novo_cpf, $email);
        } else {
            $update_stmt->bind_param("sssss", $novo_nome, $novo_email, $novo_telefone, $novo_cpf, password_hash($nova_senha, PASSWORD_DEFAULT), $email);
        }

        if ($update_stmt->execute()) {
            $_SESSION['email'] = $novo_email; // Atualiza o email na sessão
            header("Location: perfil.php"); // Redireciona após a atualização
            exit();
        } else {
            $error_message = "Erro ao atualizar as informações. Tente novamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Informações - Frog Tech</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #fafafa;
            color: #333;
            line-height: 1.6;
            padding: 100px 20px 20px; /* Adiciona espaçamento para o cabeçalho */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #007bff; /* Cor do botão de salvar */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <h1>Alterar Informações</h1>

    <?php if (isset($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <div class="form-container">
        <form method="POST" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($user['telefone'] ?? ''); ?>">

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($user['cpf'] ?? ''); ?>" required>

            <label for="senha">Nova Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Deixe em branco se não quiser alterar">

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>

</html>
