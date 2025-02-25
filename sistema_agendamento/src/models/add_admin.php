<?php
// Configurações do banco de dados
$host = 'localhost'; // ou o endereço do servidor
$dbname = 'sistema_agendamento';
$username = 'root'; // substitua pelo seu usuário do banco de dados
$password = ''; // substitua pela senha do seu banco de dados

try {
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Dados a serem inseridos
    $nome = 'Olívio Cumbe';
    $email = 'oliviocumbe@vegait.com';
    $senha = password_hash('SenhaAdmin123', PASSWORD_BCRYPT); // Hash da senha
    $tipo = 'admin';

    // Query de inserção
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
    $stmt = $pdo->prepare($sql);

    // Bind dos parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':tipo', $tipo);

    // Execução da query
    if ($stmt->execute()) {
        echo "Usuário inserido com sucesso!";
    } else {
        echo "Erro ao inserir usuário.";
    }
} catch (PDOException $e) {
    // Exibe o erro caso ocorra
    echo "Erro de conexão ou execução: " . $e->getMessage();
}
?>
