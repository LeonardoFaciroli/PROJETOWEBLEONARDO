<?php
  session_start();
  // Conexão com o Banco de Dados
  include_once('Config.php'); // Certifique-se de que está incluindo corretamente o arquivo com a conexão
  if(!isset($_SESSION['user_id'])) 
  {
    header('Location: Pagina_inicial.php'); // Redireciona para a página de login
    exit();
  }
  if(isset($_POST['submitTeam']))
  {
    $NomeTime = $_POST['Nome'];
    $IdCriador = $_SESSION['user_id'];
    // Evite injeção de SQL usando prepared statements
    $check_query = $conexao->prepare("SELECT * FROM Times WHERE NomeTime = ?");
    $check_query->bind_param("s", $NomeTime);
    $check_query->execute();
    $check_result = $check_query->get_result();
    //---------
                  
    //---------
    if ($check_result->num_rows > 0) //Cadastra o Time.
    {
        echo "O nome do time '$NomeTime' já está em uso. Por favor, escolha outro.";
    } 
    else 
    {
        // Inserção dos dados usando prepared statements
        $sql = $conexao->prepare("INSERT INTO Times (NomeTime,idCriador,IdTime) VALUES (?, ?)");
        $sql->bind_param("si",$NomeTime, $IdCriador);
        
        if ($sql->execute()) 
        {
            echo "Dados inseridos com sucesso!";
        } 
        else 
        {
            echo "Erro ao inserir dados: " . $conexao->error;
        }
    } 
  }

  $getIdTimeQuery = $conexao->prepare("SELECT Id FROM Times WHERE NomeTime = ?");
  $getIdTimeQuery->bind_param("s", $NomeTime);
  $getIdTimeQuery->execute();
  $getIdTimeResult = $getIdTimeQuery->get_result();

  if ($getIdTimeResult) {
    if ($getIdTimeResult->num_rows > 0) {
        // Obtendo o resultado da consulta
        $time = $getIdTimeResult->fetch_assoc();
        $IdTime = $time['Id'];

        // Exibindo o resultado obtido
        echo "Id do Time obtido: " . $IdTime;
    } else {
        echo "Nenhum resultado encontrado para o Id: " . $NomeTime;
    }
} else {
    echo "Erro ao obter o Id do Time.";
} 
  // Consulta para obter o IdUsuario
  $getIdUsuarioQuery = $conexao->prepare("SELECT Id FROM Usuarios WHERE NomeUsuario = ?");
  $getIdUsuarioQuery->bind_param("s", $NomeUsuario); // Substitua 'algum_criterio' e 'algumValor' por condições específicas
  $getIdUsuarioQuery->execute();
  $getIdUsuarioResult = $getIdUsuarioQuery->get_result();
  if ($getIdUsuarioResult->num_rows > 0) 
  {
      $usuario = $getIdUsuarioResult->fetch_assoc();
      $IdUsuario = $usuario['Id'];
      
  }
  
 if (isset($_POST['submitPlayer'])) 
 {
  $NomeJogador = $_POST['NomeJogador'];

  $check_query_jogador = $conexao->prepare("SELECT Id FROM MembrosTime WHERE IdUsuario = ?");
  $check_query_jogador->bind_param("i", $_POST['IdUsuario']); // Suponho que 'Id' seja o Id do jogador que está sendo verificado
  $check_query_jogador->execute();
  $check_result_jogador = $check_query_jogador->get_result();

  if ($check_result_jogador->num_rows > 0) 
  {
      echo "O jogador '$NomeJogador' já pertence a outro time.";
  } 
  else 
  {
      // O jogador não está em nenhum time, então você pode adicionar o jogador ao novo time
      $Cargo = "Membro"; // Defina o cargo conforme necessário
      if (isset($IdTime) && isset($IdUsuario)) 
      {
        $sql = $conexao->prepare("INSERT INTO MembrosTime (IdUsuario, IdTime, Cargo) VALUES (?, ?, ?)");
        $sql->bind_param("iis", $IdUsuario, $IdTime, $Cargo);

        if ($sql->execute()) 
        {
            echo "Jogador adicionado com sucesso ao time!";
        } else {
            echo "Erro ao adicionar jogador: " . $conexao->error;
        }
    }     
  }
}

      $query = "SELECT NomeUsuario FROM Usuarios";
      $result = $conexao->query($query);
      $conexao->close();
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
    body
      {
        font-family: Arial, Helvetica, sans-serif;
        background-color: rgb(138 82 255);
      }

    .custom-mt-6 
    {
      margin-top: 10rem !important;
      margin-bottom: 0px; /* Adapte o valor conforme necessário */
    }


</style>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"         aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
  <form action="" method="post">
    <table class="table table-striped table-dark mx-auto custom-mt-5" style="width: 50%;">
      <thead>
        <tr>     
          <th scope="col">CRIE SEU TIME</th>     
        </tr>
      </thead>
      <tbody>
        <tr>
            <th scope="row" >ADICIONE O NOME DO SEU TIME:</th>
            <td ><input  type="text" placeholder="LOUD" class="inputs" name="Nome"></td>
            <td><input style="display: inline-block; class="inputSubmit" type="submit" id="botao" value="CRIAR" name="submitTeam"></td>
      </tbody>
      <table class="table table-striped table-dark mx-auto" style="width: 50%;">

      <tbody>
        <tr>
            <th scope="row" >ADICIONAR JOGADOR EM SEU TIME:</th>
            <td ><input style="display: inline-block;  width: 110px; " id="formnome" type="text" placeholder="Usuário + tag" class="inputs" name="NomeJogador">
            <span style="display: inline-block; width: 23px; text-align: center; font-size: 20px;">#</span>
            <input style="display: inline-block;  width: 50px;"id="formnumero"type="text" placeholder="000" class="inputs" name="Numeros"> </td>
            <td><input style="display: inline-block;  class="inputSubmit" type="submit" id="botao" value="ADD" name="submitPlayer"></td>
      </tbody>
      
    </table>
    <table class="table table-striped table-dark mx-auto custom-mt-1" style="width: 50%;">
      <thead >
        <tr>     
          <th scope="col">Lista de Usuários</th>             
        </tr>
      </thead>
      <tbody>
      </tr>
      <?php
      if ($result->num_rows > 0) 
      {
          while ($row = $result->fetch_assoc()) 
          {             
              echo "<td>" . $row['NomeUsuario'] . "</td>";
              echo "</tr>";
          }
      } 
      else 
      {
          echo "<tr><td colspan='2'>Nenhum usuário encontrado.</td></tr>";
      }
      ?>
      </tbody>
    </table>   
  </table>
</body>

   