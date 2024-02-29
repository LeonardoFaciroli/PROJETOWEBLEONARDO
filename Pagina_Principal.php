<?php
session_start();


if (isset($_POST['logout'])) 
{
    session_destroy(); // Destruir todas as variáveis de sessão  
    header('Location: Pagina_inicial.php');
    exit();
}

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
    
    <title>TEAMS</title>
</head>

<style>
        body{
            font-family: Ariel, Helvetica, sans-serif;
            background-color: rgb(138 82 255);}
           
     /* styles.css */
        .menu{
            width: 200px;
            height: 100vh; /* 100% da altura da viewport */
            background-color: #f0f0f0;
            position: fixed; /* ou absolute, dependendo do comportamento desejado */
            top: 0;
            left: 0;
            margin-top:200px;

            transition: transform 0.3s ease; /* Adiciona uma transição suave */
            transform: translateX(-120%); /* Inicia o menu fora da tela */
        }

        .menu.show{
            transform: translateX(0); /* Move o menu para dentro da tela */
        }

        .menu ul{
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .menu ul li{
            padding: 10px;
        }

        .menu ul li a{
            text-decoration: none;
            color: #333;
            display: block;
        }

        .menu ul li a:hover{
            background-color: #ddd;
        }
        #toggleMenuButton {
    position: fixed; /* ou absolute, dependendo do comportamento desejado */
    top: 0px;
    left: 0;
     /* Ajuste conforme necessário */
}
.menu2 {
    
    width: 200px; /* ajuste conforme necessário */
    height: 200px; /* ajuste conforme necessário */
    background-color: white;
    position: fixed;
    top: 0;
    left: 0;
}



      
</style>

<body>
<div class="container">      
</div>
<div class="menu2">
</div>
      <button id="toggleMenuButton">Toggle Menu</button>
<div class="menu">   
    <ul>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Tela Principal</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Dashboards</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Agenda</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Clientes</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Fornecedores</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Equipe</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Estoque</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Serviços e Produtos</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Eventos</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Relatórios</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Configurações</h4>
        </a>
        <!-- Adicione mais itens conforme necessário -->
    </ul>
    </div>
<script src="script.js"></script>

</body>
<footer>

</footer>
   