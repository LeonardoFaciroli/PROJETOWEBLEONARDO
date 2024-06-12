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

if(isset($_POST['submit'])) {
    echo "Formulário enviado!";
    if(isset($_POST['NomeCliente'],$_POST['CPF'],$_POST['EmailCliente'],$_POST['CelularCliente'],$_POST['EndereçoCliente'],$_POST['StatusCli'])){
    $NomeCliente = $_POST['NomeCliente'];
    $CPF = $_POST['CPF'];           
    $EmailCliente = $_POST['EmailCliente'];
    $CelularCliente = $_POST['CelularCliente'];
    $EndereçoCliente = $_POST['EndereçoCliente'];
    $StatusCli = $_POST['StatusCli'];

    $sql_check = "SELECT CPF FROM Clientes WHERE CPF = '$CPF'";
        $result_check = $conexao->query($sql_check);
        if ($result_check->num_rows > 0) {
            echo "Erro: CPF já está em uso.";
        } else {

                $sql = "INSERT INTO Clientes (NomeCliente, CPF, EmailCliente, CelularCliente, EndereçoCliente, StatusCli) VALUES ('$NomeCliente', '$CPF', '$EmailCliente', '$CelularCliente', '$EndereçoCliente', '$StatusCli')";
                if ($conexao->query($sql) === TRUE) {
                    echo "Dados inseridos com sucesso!";
                } else {
                    echo "Erro ao inserir dados: " . $conexao->error;
                }
            
        }
        if(is_numeric($CPF) && is_numeric($CelularCliente)) {
        } else {
            echo "CPF e Celular devem conter apenas números.";
        }
    }else {
        echo "Todos os campos obrigatórios devem ser preenchidos!";
    }
}

if (isset($_POST['DELETE_CLIENTE'])) {
    $DELETE_CLIENTE = $_POST['DELETE_CLIENTE'];

    // Preparar e executar a instrução SQL para excluir o usuário
    $deleteQuery = $conexao->prepare("DELETE FROM Clientes WHERE IdCli = ?");
    $deleteQuery->bind_param("i", $DELETE_CLIENTE);
    $deleteQuery->execute();
    
    // Verificar se a exclusão foi bem-sucedida
    if ($deleteQuery->affected_rows > 0) {
        echo "Usuário excluído com sucesso.";
        // Você pode redirecionar o usuário para uma página de confirmação ou atualizar a página atual
        // header("Location: sua_pagina.php");
        // exit();
    } else {
        echo "Erro ao excluir o usuário.";
    }
}
$sql = "SELECT * FROM Clientes";
$result = $conexao->query($sql);

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
        /* Estilos para o modal */
.container {
    display: flex;
    justify-content: space-around;
    align-items: flex-start;
    overflow-x: auto;
  }
   .display-direito {
    margin-right: 500px;
    flex: 1;
    padding: 20px;
  }
  .form-esquerdo {
    flex: 1;
    padding: 20px;
    border-right: 1px solid #ccc;
    margin-left:200px;
    height: calc(100vh - 80px);
  }
  th, td {
            border: 1px solid #ddd;
            padding: 8px; /* Adiciona espaçamento interno às células */
            white-space: nowrap;
    }       
    table {
    border-collapse: separate; /* Necessário para que border-spacing funcione */
    border-spacing: 10px; /* Adiciona espaçamento entre as células */
    width: 100%;
    min-width: 1000px;
    }
    th {
            background-color: #f2f2f2;
            text-align: left;
        }
        tr:hover {
            background-color: #f5f5f5;
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
<div class="container">  
    <div class="form-esquerdo">
        <form action="" method="post">
                <div>
                    <input type="text" placeholder="Nome Completo" class="inputs" name="NomeCliente">
                </div>
                <br>
                <div>
                    <input type="number" placeholder="CPF" class="inputs" name="CPF">                
                </div>
                <br>  
                <div>
                    <input type="text" placeholder="Email" class="inputs" name="EmailCliente">                
                </div>                         
                <br>
                <input type="number" placeholder="Celular" class="inputs" name="CelularCliente">                
                </br>
                <br>
                <input type="text" placeholder="Endereço" class="inputs" name="EndereçoCliente">                
                </br>
                <h5>Status de negociação</h5>
                        <input type="hidden" name="StatusCli" value="">
                        <select name="StatusCli">
                            <option value="Orçamento">Orçamento</option>
                        </select>           
                <button type="submit" id="botao" name="submit">Cadastrar</button>
        </form>
    </div> 
    <div class="display-direito">

    <h1>Clientes Cadastrados</h1>
    <h2>Gerenciar Clientes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Celular</th>
            <th>Endereço</th>
            <th>Status</th>      
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['IdCli']; ?></td>
                <td><?php echo $row['NomeCliente']; ?></td>
                <td><?php echo $row['CPF']; ?></td>
                <td><?php echo $row['EmailCliente']; ?></td>
                <td><?php echo $row['CelularCliente']; ?></td>
                <td><?php echo $row['EndereçoCliente']; ?></td>
                <td><?php echo $row['StatusCli']; ?></td>             
                <td>
                    <!-- Botões de Excluir e Editar -->
                    <form method="post">
                        <input type="hidden" name="DELETE_CLIENTE" value="<?php echo $row['IdCli']; ?>">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>   

<script src="../script.js"></script>
</body>
<footer>

</footer>
   