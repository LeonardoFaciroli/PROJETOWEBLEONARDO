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
?>



<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>TEAMS</title>

    <script src="https://kit.fontawesome.com/3cd7cbdd5d.js" crossorigin="anonymous"></script>

    <style>
        body{
            font-family: Ariel, Helvetica, sans-serif;
            background-color: rgb(white);}
           
     /* styles.css */
     
        .menu{
            width: 200px;
            height: 100vh; /* 100% da altura da viewport */
            overflow-y: auto;
            background-color: #2698F0;
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
     
}
.menu2 {
    
    width: 200px;
    height: 200px; 
    background-color:#2698F0;
    position: fixed;
    top: 0;
    left: 0;   
    }  
    nav ul a i {
    margin: 10px 10px; /* Ajuste para espaçamento entre o ícone e o texto */
                } 
</style>
</head>
<body>
    <div class="menu2"></div>
      <button id="toggleMenuButton">Toggle Menu</button>
<div class="menu">   
    <nav>
        <ul>
            <a href="Pagina_CreateTeam.php">          
                <h4><i class="fas fa-home"></i>Tela Principal</h4>        
            </a>
            <a href="Pagina_CreateTeam.php">
                <h4><i class="fas fa-chart-line"></i>Dashboards</h4>
            </a>
            <a href="Pagina_CreateTeam.php">
                <h4><i class="fas fa-calendar"></i>Agenda</h4>
            </a>
            <a href="Clientes.php">
                <h4><i class="fas fa-user"></i>Clientes</h4>
            </a>
            <a href="Fornecedores.php">
                <h4><i class="fas fa-truck"></i>Fornecedores</h4>
            </a>
            <a href="Equipe.php">
                <h4><i class="fas fa-users"></i>Equipe</h4>
            </a>
            <a href="Estoque_Inventario.php">
                <h4><i class="fas fa-box-open"></i>Estoque/Inventário</h4>
            </a>
            <a href="Pagina_CreateTeam.php">
                <h4><i class="fas fa-wrench"></i>Serviços e Produtos</h4>
            </a>
            <a href="Pagina_CreateTeam.php">
                <h4><i class="fas fa-calendar-alt"></i>Eventos</h4>
            </a>
            <a href="Pagina_CreateTeam.php">
                <h4><i class="fas fa-file-alt"></i>Relatórios</h4>
            </a>
            <a href="Pagina_CreateTeam.php">
                <h4><i class="fas fa-cogs"></i>Configurações</h4>
            </a>
        </ul>
    </nav>
    </div>
<script src="script.js"></script>

</body>
<footer>

</footer>
   