<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '123';
$dbName = 'BdGerenciador';
$port = 3309;
$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName, $port);
global $conexao;
//echo "Conexão bem-sucedida!";
//BANCO DE DADOS CONEXAO!!
//if($conexao->connect_errno) {
 //   echo "Erro na conexão!";
//} else {
//    echo "Conexão efetuada com sucesso!";
//}
?>
