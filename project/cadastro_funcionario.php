<?php
include('conexao.php'); // Inclui o arquivo de conexão com o banco

// Inicializa uma variável para armazenar os departamentos
$departamento = [];

// Consulta para obter os departamentos
$sql_departamentos = "SELECT id, nome FROM departamento"; // Corrigido o nome da variável
$result_departamento = $conn->query($sql_departamentos); // Use a variável correta aqui

if ($result_departamento->num_rows > 0) {
    // Armazena os departamentos em um array
    while ($row = $result_departamento->fetch_assoc()) {
        $departamento[] = $row;
    }
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tempo_contrato = $_POST['tempo_contrato'];
    $unidade_tempo = $_POST['unidade_tempo'];
    $endereco = $_POST['endereco'];
    $idade = $_POST['idade'];
    $salario = $_POST['salario'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $carteira_trabalho = $_POST['carteira_trabalho'];
    $turno = $_POST['turno'];
    $departamento_id = $_POST['departamento']; // Adiciona a variável para o departamento

    // Insere os dados no banco de dados
    $sql = "INSERT INTO funcionarios (nome, email, tempo_contrato, unidade_tempo, endereco, idade, salario, cpf, rg, carteira_trabalho, turno, departamento_id)
            VALUES ('$nome', '$email', '$tempo_contrato', '$unidade_tempo', '$endereco', '$idade', '$salario', '$cpf', '$rg', '$carteira_trabalho', '$turno', '$departamento_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Funcionário cadastrado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar funcionário: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionários</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f4f4f4; 
            margin: 0; 
            padding: 0; 
        }
        header { 
            background-color: #fff; 
            padding: 15px; 
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center; /* Centraliza o conteúdo do cabeçalho */
            align-items: center;
        }
        .logo img {
            max-width: 300px; /* Tamanho máximo ajustado */
            max-height: 60px; /* Altura máxima opcional */
            height: auto; /* Mantém a proporção da imagem */
        }
        footer { 
            color: black; 
            text-align: center; 
            padding: 10px 0; 
            position: relative; 
            bottom: 0; 
            width: 100%; 
        }
        .card { 
            max-width: 600px; 
            margin: 20px auto; 
            padding: 20px; 
            background-color: #fff; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        }
        label { 
            display: block; 
            margin-top: 10px; 
        }
        input[type="text"], input[type="email"], input[type="number"], select { 
            width: 90%;  
            padding: 10px; 
            margin-top: 5px; 
            border: 1px solid #ccc; 
            border-radius: 20px; 
            max-width: 100%; 
        }
        button { 
            margin-top: 20px; 
            padding: 10px; 
            background-color: #4CAF50; 
            color: #fff; 
            border: none; 
            border-radius: 20px; 
            cursor: pointer; 
            width: 100%; 
        }
        button:hover { 
            background-color: red; 
            transition: background-color 0.8s ease;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo2.png" alt="Logo" class="main-logo">
        </div>
    </header>

    <div class="card">
        <form method="POST" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required placeholder="Digite seu nome">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Digite seu Email" pattern=".+@.+\..+" title="Por favor, insira um email válido (ex: usuario@exemplo.com)">

            <label for="tempo_contrato">Tempo de Contrato:</label>
            <input type="number" id="tempo_contrato" name="tempo_contrato" required min="1" placeholder="Digite o tempo">
            
            <select id="unidade_tempo" name="unidade_tempo" required>
                <option value="meses">Meses</option>
                <option value="anos">Anos</option>
            </select>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" placeholder="Digite seu endereço">

            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" required min="18" placeholder="Digite sua idade">

            <label for="salario">Salário:</label>
            <input type="number" id="salario" name="salario" required min="0" step="0.01" placeholder="Ex: 1500.00" title="Insira o salário (valor mínimo: R$ 0,00)">

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" maxlength="14" required placeholder="000.000.000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato: 000.000.000-00">

            <label for="rg">RG:</label>
            <input type="text" id="rg" name="rg" maxlength="12" required placeholder="00.000.000-0" pattern="\d{2}\.\d{3}\.\d{3}-\d" title="Formato: 00.000.000-0">

            <label for="turno">Turno:</label>
            <select id="turno" name="turno" required>
                <option value="">Selecione um turno</option>
                <option value="matutino">Matutino</option>
                <option value="noturno">Noturno</option>
            </select>

            <label for="carteira_trabalho">Carteira de Trabalho:</label>
            <input type="text" id="carteira_trabalho" name="carteira_trabalho" maxlength="12" required placeholder="000.00000.00" pattern="\d{3}\.\d{5}\.\d{2}" title="Formato: 000.00000.00">

            <label for="departamento">Departamento:</label>
            <select id="departamento" name="departamento" required>
                <option value="">Selecione um departamento</option>
                <?php foreach ($departamento as $departamento): ?>
                    <option value="<?php echo $departamento['id']; ?>"><?php echo $departamento['nome']; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Cadastrar Funcionário</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Frog Tech. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
