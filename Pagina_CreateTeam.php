<?php
  session_start();
  // Conexão com o Banco de Dados
  include_once('Config.php'); // Certifique-se de que está incluindo corretamente o arquivo com a conexão

  if (isset($_POST['logout'])) 
{
    session_destroy(); // Destruir todas as variáveis de sessão  
    header('Location: Pagina_inicial.php');
    exit();
}


  if(!isset($_SESSION['user_id'])) 
  {
    header('Location: Pagina_inicial.php'); // Redireciona para a página de login
    exit();
  }
  //criar um time
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
    if ($check_result->num_rows > 0) //Checa se o nome do time já esta em uso.
    {
        echo "O nome do time '$NomeTime' já está em uso. Por favor, escolha outro.";
    } 
    //caso o nome do time não seja encontrado no banco, cria-se o time
    else 
    {   // Inserção dos dados usando prepared statements
        $sql = $conexao->prepare("INSERT INTO Times (NomeTime,idCriador) VALUES (?, ?)");
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
    .nav button#finalizarSessao{

    }


</style>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="Pagina_Principal.php">Home</a>
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
   <!--botao para finalizar sessão--><form action="" method="post" >
   <input type="submit" value="Sair" name="logout"style="background-color:red; margin-left:2100%";>
  </form>
</nav>
  <form action="" method="post">
    <table class="table table-striped table-dark mx-auto custom-mt-5" style="width: 50%;">
      <thead>
        <tr>     
          <th scope="col">CRIE SEU TIME</th>     
        </tr>
      </thead>
      <<tbody>
        <tr>
            <th scope="row" >ADICIONE O NOME DO SEU TIME:</th>
            <td ><input  type="text" placeholder="LOUD" class="inputs" name="Nome"></td>
            <td><input style="display: inline-block; class="inputSubmit" type="submit" id="botao" value="CRIAR" name="submitTeam"></td>
      </tbody>
      <!--<table class="table table-striped table-dark mx-auto" style="width: 50%;">

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
      <tbody>
         <tr>     
          <th scope="col">Lista de Usuários</th>             
        </tr>
      </thead>
      <tbody>
      </tr>-->
      <?php
      //if ($result->num_rows > 0) 
      //{
       //   while ($row = $result->fetch_assoc()) 
         // {             
           //   echo "<td>" . $row['NomeUsuario'] . "</td>";
            //  echo "</tr>";
          //}
      //} 
     // else 
     // {
     //     echo "<tr><td colspan='2'>Nenhum usuário encontrado.</td></tr>";
     // }
      ?>
      </tbody>
    </table>   
  </table>
</body>

   