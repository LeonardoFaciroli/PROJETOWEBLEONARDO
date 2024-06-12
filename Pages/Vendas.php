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
    
    if(isset($_POST['Produto'], $_POST['QuantidadeProduto'], $_POST['PreçoPro'], $_POST['ServiçoSolicitado'], $_POST['PreçoServ'], $_POST['Evento'],  $_POST['Localizacao'], $_POST['CPF'], $_POST['StatusPedido'])) {
        
            $Produto = $_POST['Produto'];
            $QuantidadeProduto = $_POST['QuantidadeProduto'];
            $PreçoPro = $_POST['PreçoPro'];
            $ServiçoSolicitado = $_POST['ServiçoSolicitado'];
            $PreçoServ = $_POST['PreçoServ'];
            $Evento = $_POST['Evento'];
            $Localizacao = $_POST['Localizacao'];
            $CPF = $_POST['CPF'];
            $StatusPedido = $_POST['StatusPedido'];

            $stmt = $conexao->prepare("INSERT INTO Vendas (Produto, QuantidadeProduto, PreçoPro, ServiçoSolicitado, PreçoServ, Evento,  Localizacao, CPFcli, StatusPedido) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sidsdssis", $Produto, $QuantidadeProduto, $PreçoPro, $ServiçoSolicitado, $PreçoServ, $Evento, $Localizacao, $CPF, $StatusPedido);

            if ($stmt->execute()) {
                echo "Dados inseridos com sucesso!";
            } else {
                echo "Erro ao inserir dados: " . $stmt->error;
            }
            // Redireciona para a mesma página para evitar a reinserção ao recarregar
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
} else {
        echo "Todos os campos são obrigatórios.";
    }


if (!empty($_POST['ServiçoSolicitado'])) {
    $ServiçoSolicitado = $_POST['ServiçoSolicitado'];
} else {
    $ServiçoSolicitado = "Não especificado";
}

$sqlVendas = "SELECT 
    C.CPF,
    V.ServiçoSolicitado, 
    V.PreçoServ, 
    V.Evento, 
    V.Produto, 
    V.QuantidadeProduto, 
    V.PreçoPro,  
    V.Localizacao, 
    V.StatusPedido,
    C.StatusCli
FROM 
    Vendas V
JOIN 
    Clientes C ON V.CPFcli = C.CPF";

$resultvendas = $conexao->query($sqlVendas);

$sqlCpf = "SELECT CPF FROM Clientes";
$resultcpf = $conexao->query($sqlCpf);
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
            left: 0;
        }

        #toggleMenuButton1 {
            position: absolute;
            bottom: 0;
            right: 0;
            color: red;
        }
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
            background-color:#140B27;
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
            margin-top: 100px;
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
                <h2>Venda Produtos e Serviços</h2>
                <label for="CPF">CPF do Cliente:</label><br>
                <select id="CPF" name="CPF">
                    <?php
                    if ($resultcpf->num_rows > 0) {
                        while($row = $resultcpf->fetch_assoc()) {
                            echo '<option value="' . $row['CPF'] . '">' . $row['CPF'] . '</option>';
                        }
                    }
                    ?>
                </select><br><br>
                <label for="ServiçoSolicitado">Serviço Solicitado:</label><br>
                <input type="text" id="ServiçoSolicitado" name="ServiçoSolicitado" value=""><br><br>

                <label for="PreçoServ">Preço do Serviço:</label><br>
                <input type="number" step="0.01" id="PreçoServ" name="PreçoServ"><br><br>

                <label for="Evento">Evento:</label><br>
                <input type="text" id="Evento" name="Evento"><br><br>

                <label for="Produto">Produto:</label><br>
                <input type="text" id="Produto" name="Produto"><br><br>

                <label for="QuantidadeProduto">Quantidade de Produto:</label><br>
                <input type="number" id="QuantidadeProduto" name="QuantidadeProduto"><br><br>

                <label for="PreçoPro">Preço do Produto:</label><br>
                <input type="number" step="0.01" id="PreçoPro" name="PreçoPro"><br><br>             

                <label for="Localizacao">Localização:</label><br>
                <input type="text" id="Localizacao" name="Localizacao"><br><br>
          
                <h5>Status de negociação</h5>
                        <input type="hidden" name="StatusPedido" value="">
                        <select name="StatusPedido">
                            <option value="Orçamento">Orçamento</option>
                            <option value="Pedido efetuado">Pedido efetuado</option>
                            <option value="Aguardando pagamento">Aguardando pagamento</option>
                            <option value="Venda concluída">Venda concluída</option>
                            <option value="Processo de análise de montagem">Processo de análise de montagem</option>
                            <option value="Montagem iniciada">Montagem iniciada</option>
                            <option value="Evento concluído">Evento concluído</option>
                        </select>
                <input type="submit" name="submit" value="Enviar">
            </form>
        </div>
        
        <div class="display-direito">
            <h2>Lista de Vendas</h2>
            <table>
                <tr>
                    <th>CPF</th>
                    <th>Serviço solicitado</th>
                    <th>Preço do serviço</th>
                    <th>Evento</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço dos produtos selecionados</th>
                    <th>Localização</th>                   
                    <th>Status da negociação</th>
                    <th>Status do cliente</th>
                </tr>
                <?php
                if ($resultvendas->num_rows > 0) {
                    while($row = $resultvendas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['CPF'] . "</td>";
                        echo "<td>" . $row['ServiçoSolicitado'] . "</td>";
                        echo "<td>" . $row['PreçoServ'] . "</td>";
                        echo "<td>" . $row['Evento'] . "</td>";
                        echo "<td>" . $row['Produto'] . "</td>";
                        echo "<td>" . $row['QuantidadeProduto'] . "</td>";
                        echo "<td>" . $row['PreçoPro'] . "</td>";        
                        echo "<td>" . $row['Localizacao'] . "</td>";             
                        echo "<td>" . $row['StatusPedido'] . "</td>";
                        echo "<td>" . $row['StatusCli'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Nenhum registro encontrado</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <script>
        const toggleButton = document.getElementById('toggleMenuButton');
        const menu = document.querySelector('.menu');
        toggleButton.addEventListener('click', () => {
            menu.classList.toggle('show');
        });
    </script>
</body>
</html>
