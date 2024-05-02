<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'leonardo123';
$dbName = 'BdGerenciador';

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
global $conexao;
//echo "Conexão bem-sucedida!";
//BANCO DE DADOS CONEXAO!!
//if($conexao->connect_errno) {
 //   echo "Erro na conexão!";
//} else {
//    echo "Conexão efetuada com sucesso!";
//}

?>

