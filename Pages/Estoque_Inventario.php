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
    if(isset($_POST['NomeProduto'],$_POST['DataCompraProduto'],$_POST['Quantidade'],$_POST['Categoria'],$_POST['SubCategoria'],$_POST['PrecoCompra'],$_POST['PrecoVenda'],$_POST ['Validade'], $_POST['LocalizacaoEstoque'])){
    $NomeProduto = $_POST['NomeProduto'];
    $DataCompraProduto = $_POST['DataCompraProduto'];           
    $Quantidade = $_POST['Quantidade'];
    $Categoria = $_POST['Categoria'];
    $SubCategoria = $_POST['SubCategoria'];
    $PrecoCompra = $_POST['PrecoCompra'];
    $PrecoVenda = $_POST['PrecoVenda'];
    $Validade = $_POST ['Validade'];
    $LocalizacaoEstoque = $_POST ['LocalizacaoEstoque'];

    $sql_check = "SELECT NomeProduto FROM Estoque WHERE NomeProduto = '$NomeProduto'";
        $result_check = $conexao->query($sql_check);
        if ($result_check->num_rows > 0) {
            echo "Erro:  Este produto" . $NomeProduto . "já está cadastrado no sistema !";
        } else {

                $sql = "INSERT INTO Estoque (NomeProduto, DataCompraProduto, Quantidade, Categoria, SubCategoria, PrecoCompra, PrecoVenda, Validade, LocalizacaoEstoque) VALUES ('$NomeProduto', '$DataCompraProduto', '$Quantidade', '$Categoria', '$SubCategoria', '$PrecoCompra', '$PrecoVenda', '$Validade', '$LocalizacaoEstoque')";
                if ($conexao->query($sql) === TRUE) {
                    echo "Dados inseridos com sucesso!";
                } else {
                    echo "Erro ao inserir dados: " . $conexao->error;
                }
            
        }
        if(is_numeric($Quantidade) && is_numeric($PrecoCompra) && is_numeric($PrecoVenda)) {
            // Restante do seu código de inserção no banco de dados...
        } else {
            echo "Os campos Quantidade, Preço de Compra e Preço de Venda devem conter apenas números.";
        }
    }else {
        // Se algum campo obrigatório estiver em falta, exiba uma mensagem de erro
        echo "Todos os campos obrigatórios devem ser preenchidos!";
    }
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
            background-color: #EDEDED;
            
    }
           
     /* styles.css */
     
        .menu{
            width: 200px;
            height: 100vh; /* 100% da altura da viewport */
            overflow-y: auto;
            background-color: #4F5A98;
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

        #toggleMenuButton1 {
            position: absolute;
            bottom: 0;
            right: 0;
            color: red;
        }
        .menu2 {
        
        width: 200px;
        height: 200px; 
        background-color:#4F5A98;
        position: fixed;
        top: 0;
        left: 0;   
        }  
        .user-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%; /* Tornar o elemento um círculo */
            background-color: #B5B5B5; /* Cor de fundo do círculo */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer; /* Transformar o cursor em uma mão quando passar por cima */
        }
        .user-name {
    text-align: center; /* Centraliza o texto */
    margin-top: 120px; /* Adiciona uma margem superior para separar o nome do círculo */
    color: #FFFFFF; /* Cor do texto (opcional) */        
    }
    nav ul a i {
    margin: 10px 10px; /* Ajuste para espaçamento entre o ícone e o texto */
    } 
 /* Estilos para o modal */
 .container {
    display: flex;
    justify-content: space-around;
    align-items: flex-start;
  }
   .display-direito {
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

</style>
</head>
<body>
    <div class="menu2"> 
        <div class="user-circle">
            <!-- Aqui você pode obter o nome do usuário da sessão -->
            <span class="user-name"><?php echo $_SESSION['NomeCompleto']; ?></span>  
        </div>     
        <button id="toggleMenuButton"> <i class="fas fa-bars"></i></button>
        <button id="toggleMenuButton1">Sair</button>
        <!--botao para finalizar sessão-->
        <form action="" method="post" >
            <input type="submit" value="Sair" name="logout"style="background-color:red; margin-left:2100%";>
        </form>
    </div>
      
<div class="menu">     
    <nav>
    <ul>
            <a href="Pagina_Principal.php">          
                <h4><i class="fas fa-home"></i>Tela Principal</h4>        
            </a>
            <a href="Dashboard.php">
                <h4><i class="fas fa-chart-line"></i>Dashboards</h4>
            </a>
            <a href="Agenda.php">
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
            <a href="Servicos.php">
                <h4><i class="fas fa-wrench"></i>Serviços e Produtos</h4>
            </a>
            <a href="Eventos.php">
                <h4><i class="fas fa-calendar-alt"></i>Eventos</h4>
            </a>
            <a href="Relatorios.php">
                <h4><i class="fas fa-file-alt"></i>Relatórios</h4>
            </a>
            <a href="Configuracoes.php">
                <h4><i class="fas fa-cogs"></i>Configurações</h4>
            </a>
        </ul>
    </nav>
</div>
<div class="container">  
    <div class="form-esquerdo">
        <form action="" method="post">
            <br>
                <div>
                    <input type="text" placeholder="Nome do Produto" class="inputs" name="NomeProduto">
                </div>                
                <div>
                    <h5>Data da Compra</h5>
                    <input type="date" placeholder="Data de compra" class="inputs" name="DataCompraProduto">
                </div>                                     
            <br>  
                <div>
                    <input type="text" placeholder="Quantidade a ser adicionada" class="inputs" name="Quantidade">                
                </div> 
            </br>                        
            
                <div>
                    <input type="text" placeholder="Categoria" class="inputs" name="Categoria">  
                </div>              
            <br>
            
                <div>
                    <input type="text" placeholder="SubCategoria" class="inputs" name="SubCategoria">
                </div>                
            
            <br>
                <div>
                    <input type="text" placeholder="Preço de Compra" class="inputs" name="PrecoCompra">
                </div>                
            </br>
                    <input type="text" placeholder="Preço de venda" class="inputs" name="PrecoVenda"> 
              
                <div>
                    <h5>Validade</h5>
                    <input  type="date" placeholder="Data de validade" class="inputs" name="Validade"> 
                </div>                    
            <br>
                <div>
                    <input type="text" placeholder="Localização no estoque" class="inputs" name="LocalizacaoEstoque">  
                </div>              
            </br>                   
                <button type="submit" id="botao" name="submit">Cadastrar</button>
        </form>  
    </div> 
    <div class="display-direito">

        
        <h2>Produtos Cadastrados</h2>
        <ul>
            
            <li>Produto 1</li>
            <li>Produto 2</li>
            <li>Produto 3</li>
        </ul>
    </div>
</div>
    <script src="../script.js"></script>

</body>
<footer>

</footer>
   