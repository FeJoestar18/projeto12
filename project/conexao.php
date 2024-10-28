<?php
// config.php
define('DB_HOST', 'localhost'); // ou o endereço do seu servidor de banco de dados
define('DB_USER', 'root'); // substitua pelo seu usuário do banco de dados
define('DB_PASS', ''); // substitua pela sua senha do banco de dados
define('DB_NAME', 'frogtech'); // substitua pelo nome do seu banco de dados

// Cria a conexão com o banco de dados
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
