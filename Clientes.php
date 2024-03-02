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
// --          --        --         --        --
include_once('Config.php');

if(isset($_POST['submit'])) {
    $Email = $_POST['NomeCliente'];
    $NomeCompleto = $_POST['CpfCliente'];
    $NomeCompleto = $_POST['EmailCliente'];
    $NomeCompleto = $_POST['CelularCliente'];
    $NomeCompleto = $_POST['EventoCliente'];
    $NomeCompleto = $_POST['OrçamentoCliente'];
    $NomeCompleto = $_POST['LocalEventoCliente'];
    if ($check_result->num_rows > 0) {
        echo "O nome de usuário '$CpfCliente' já está em uso. Por favor, escolha outro.";
    } else {
        $sql = "INSERT INTO Clientes (NomeCliente, CpfCliente, EmailCliente, CelularCliente, EventoCliente, OrçamentoCliente, LocalEventoCliente) VALUES ('$NomeCliente', '$CpfCliente', '$EmailCliente', '$CelularCliente', '$EventoCliente', '$OrçamentoCliente', '$LocalEventoCliente')";

        if ($conexao->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . $conexao->error;
        }
    }
}

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
            background-color: rgb(white);}
           
     /* styles.css */
        .menu{
            width: 200px;
            height: 100vh; /* 100% da altura da viewport */
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
.container{   
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh; 
}
     
</style>

<body>
<div class="container">  
<form action="" method="post">
            <div>
                <input type="text" placeholder="Nome Completo" class="inputs" name="NomeCliente">
            </div>
            <br>
            <div>
                <input type="text" placeholder="CPF" class="inputs" name="CpfCliente">                
            </div>
            <br>  
            <div>
                <input type="text" placeholder="Email" class="inputs" name="EmailCliente">                
            </div>                         
            <br>
            <input type="text" placeholder="Celular" class="inputs" name="CelularCliente">                
            </br>
            <br>
            <input type="text" placeholder="Evento sugerido" class="inputs" name="EventoCliente">                
            </br>
            <br>
            <input type="text" placeholder="Orçamento relacionado" class="inputs" name="OrçamentoCliente">                
            </br>
            <br>
            <input type="text" placeholder="Local do evento" class="inputs" name="LocalEventoCliente">                
            </br>                       
            <button type="submit" id="botao" name="submit">Cadastrar</button>
        </form>    
</div>
<div class="menu2">
</div>
      <button id="toggleMenuButton">Toggle Menu</button>
<div class="menu">   
    <ul>
        <a href="Pagina_Principal.php" id="linkcriartime">
        <h4 class="time">Tela Principal</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Dashboards</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Agenda</h4>
        </a>
        <a href="Clientes.php" id="linkcriartime">
        <h4 class="time">Clientes</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Fornecedores</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Equipe</h4>
        </a>
        <a href="Pagina_CreateTeam.php" id="linkcriartime">
        <h4 class="time">Estoque/Inventário</h4>
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
    </ul>
    </div>
<script src="script.js"></script>

</body>
<footer>

</footer>
   