<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'sistema_academico';

$conn = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conn) {
    die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
}
?>
