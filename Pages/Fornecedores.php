<?php
session_start();

include_once('../Outros/Config.php');

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
if (!isset($_SESSION['nivel_acesso_id'])) {   
    echo "acesso nao autorizado";
    exit();
}



$nivel = $_SESSION['nivel_acesso_id'];
$userId = $_SESSION['user_id'];
// Consulta para obter o nome do time pelo IdCriador
$getTimeNameQuery = $conexao->prepare("SELECT NomeCompleto FROM Usuarios WHERE id = ?");
$getTimeNameQuery->bind_param("i", $userId);
$getTimeNameQuery->execute();
$getTimeNameResult = $getTimeNameQuery->get_result();

if ($getTimeNameResult->num_rows > 0) {
    // Obtém a linha de resultado
    $row = $getTimeNameResult->fetch_assoc();
    // Armazena o nome completo do usuário na sessão
    $_SESSION['NomeCompleto'] = $row['NomeCompleto'];
} else {
    // Se não houver resultados, define um valor padrão para o nome completo do usuário
    echo "Erro: Não foi possível encontrar o nome do usuário.";
}

?>

<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>INSIRA EVENTOS</title>

    <script src="https://kit.fontawesome.com/3cd7cbdd5d.js" crossorigin="anonymous"></script>

    <style>
        body{
            font-family: Ariel, Helvetica, sans-serif;
            background-color: #EDEDED;          
        }
           
     /* styles.css */
     
        .menu{
            width: 200px;
            height: 100vh; /* 100% da altura da viewport */
            overflow-y: auto;
            background-color: #140B27;
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
            position: absolute;
            bottom: 0;
            left: 0;}

        #sair {
            position: absolute;
            bottom: 0;
            right: 0;
            color: red;
            cursor: pointer;
        }
        .menu2 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 200px;
            height: 200px;
            background-color: #140B27;
            position: fixed;
            top: 0;
            left: 0;   
        }  
        .user-circle {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        .circular-image {
            width: 100px; /* Ajuste a largura da imagem conforme necessário */
            height: 100px; /* Ajuste a altura da imagem conforme necessário */
            border-radius: 50%; /* Torna a imagem circular */
            object-fit: cover;
            margin: 0 auto;
        }
        .user-name {
            text-align: center; /* Centraliza o texto */
            color: #FFFFFF; /* Cor do texto (opcional) */ 
            margin: 0 auto;  
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;     
        }
        nav ul a i {
        margin: 10px 10px; /* Ajuste para espaçamento entre o ícone e o texto */
        } 
</style>
</head>
<body>
<div class="menu2"> 
    <div>
        <div class="user-circle">
            <img src="../img/Imagemperfil.png" alt="Imagem do Usuário" class="circular-image">
        </div>   
        <span class="user-name"><?php echo $_SESSION['NomeCompleto']; ?></span>  
    </div>   
    <div>
        <button id="toggleMenuButton"> <i class="fas fa-bars"></i></button>
    <form action="" method="post" >
        <input type="submit" value="Sair" name="logout"; id="sair";>
    </form>
    </div>
</div>        
<div class="menu">     
    <nav>
    <ul>
            <a href="Pagina_Principal.php" style=" text-decoration: none;">          
                <h4 style="color : white; "><i class="fas fa-home" ></i>Tela Principal</h4>        
            </a>
            <a href="Dashboard.php" style=" text-decoration: none;">
                <h4 style="color : white;"><i class="fas fa-chart-line"></i>Dashboards</h4>
            </a>
            <a href="Agenda.php" style=" text-decoration: none;">
                <h4 style="color : white; "><i class="fas fa-calendar"></i>Agenda</h4>
            </a>
            <a href="Clientes.php" style=" text-decoration: none;">
                <h4 style="color : white; "><i class="fas fa-user"></i>Clientes</h4>
            </a>
            <a href="Fornecedores.php" style=" text-decoration: none;">
                <h4 style="color : white; "><i class="fas fa-truck"></i>Fornecedores</h4>
            </a>
            <a href="Equipe.php" style=" text-decoration: none;">
                <h4 style="color : white; "><i class="fas fa-users"></i>Equipe</h4>
            </a>
            <a href="Estoque_Inventario.php" style=" text-decoration: none;">
                <h4 style="color : white; "><i class="fas fa-box-open"></i>Estoque/Inventário</h4>
            </a>
            <a href="Servicos.php" style=" text-decoration: none;">
                <h4 style="color : white; "><i class="fas fa-wrench"></i>Serviços e Produtos</h4>
            </a>
            <a href="Eventos.php" style=" text-decoration: none;">
                <h4 style="color : white; "><i class="fas fa-calendar-alt"></i>Eventos</h4>
            </a>
            <?php if ($nivel == 1  || $nivel == 2): ?>
            <a href="Relatorios.php" style=" text-decoration: none;">
                <h4 style="color : white; "><i class="fas fa-file-alt"></i>Relatórios</h4>
            </a>
            <?php endif; ?>
            <a href="Vendas.php" style=" text-decoration: none;">
                <h4 style="color : white; "><i class="fas fa-dollar-sign"></i>Vendas</h4>
            </a>
            <a href="Configuracoes.php "id="link-configuracoes" style=" text-decoration: none;">
                <h4 style="color : white; "><i class="fas fa-cogs"></i>Configurações</h4>
            </a>
        </ul>
    </nav>
</div>
<script src="../script.js"></script>
</body>
<footer>

</footer>
   