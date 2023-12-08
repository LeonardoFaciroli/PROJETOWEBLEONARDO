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
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
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
   