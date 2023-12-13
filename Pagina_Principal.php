<?php
session_start();

// Verifica se a sessão do usuário está iniciada
if(!isset($_SESSION['user_id'])) {
    header('Location: Pagina_inicial.php'); // Redireciona para a página de login
    exit();
}

// Resto do código da página principal aqui...
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>TEAMS</title>
</head>

<style>
        body{
            font-family: Ariel, Helvetica, sans-serif;
            background-color: rgb(138 82 255);
        }
        .container{
            display: flex;
            justify-center: center;
            text-align: center;
        }
        .container img{
            display: block;
            margin: 100px;
            margin-top: 150px;
            margin-left: 130px;
       }
       .time{
        position: absolute;
        top: 25%;
        font-size: 24px;
        left: 27%;
       }
       .perfil{
        position: absolute;
        top: 25%;
        font-size: 24px;
        left: 72%;
       }
       .container a#linkcriartime{
        color:red;
       }
     
       
</style>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="Pagina_principal.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="Pagina_Meu_Time.php">Meu Time</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Jogadores</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>

<div class="container">
    <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h1 class="time">Crie seu TIME!</h1>
    </a>
    <img id="imagem-mapeada"src="img\CriarTime.png" alt="" width="400" height="350">
        
    </img>
        <h1 class="perfil">Jogadores</h1>
    <img src="img\MeuPerfil.png" alt="" width="400" height="270">
    
    
</div>

</body>
<footer>

</footer>
   