<?php
require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $data_cadastro = date('Y-m-d');

    // Insere o novo usuário na tabela de usuários
    $query = "INSERT INTO usuarios (nome, email, senha, data_cadastro) 
              VALUES ('$nome', '$email', '$senha', '$data_cadastro')";

    if (mysqli_query($conn, $query)) {
        // Obtém o ID do usuário recém-cadastrado
        $id_usuario = mysqli_insert_id($conn);

         // Registra o log do cadastro na tabela logs_atividades
         $data_hora = date('Y-m-d H:i:s');
         $descricao = 'Cadastro realizado';
         $query_log = "INSERT INTO logs_atividades (id_usuario, data_hora, descricao, tipo_actividade) 
                       VALUES ($id_usuario, '$data_hora', '$descricao', 'Cadastro')";
         mysqli_query($conn, $query_log);

        header('location: ../pages/auth/login.php');
    } else {
        echo "<p>Erro ao cadastrar: " . mysqli_error($conn) . "</p>";
    }
}
?>
