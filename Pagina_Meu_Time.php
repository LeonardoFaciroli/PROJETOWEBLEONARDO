<?php
session_start();

include_once('Config.php');

if (isset($_POST['logout'])) 
{
    session_destroy(); // Destruir todas as variáveis de sessão  
    header('Location: Pagina_inicial.php');
    exit();
}

if (!isset($_SESSION['user_id'])) {
  header('Location: Pagina_inicial.php');
  exit();
}


$IdCriador = $_SESSION['user_id'];
// Consulta para obter o nome do time pelo IdCriador
$getTimeNameQuery = $conexao->prepare("SELECT NomeTime FROM Times WHERE idCriador = ?");
$getTimeNameQuery->bind_param("i", $IdCriador);
$getTimeNameQuery->execute();
$getTimeNameResult = $getTimeNameQuery->get_result();

if ($getTimeNameResult->num_rows === 0) {
  // Redireciona para uma página específica informando que não há times disponíveis
  header("Location: Pagina_Principal.php");
  exit();
}


$times_do_criador = [];
while ($row = $getTimeNameResult->fetch_assoc()) {
    $times_do_criador[] = $row;
}

if (count($times_do_criador) > 0) {
  $time = $times_do_criador[0]; // Ajuste para obter o primeiro registro, se necessário
  $NomeTime = $time['NomeTime'];
} else {
  $NomeTime = "Nenhum time disponível";
}


// Verifica se foi submetido o formulário de atualização do nome do time
if (isset($_POST['submitNomeTime'])) 
{
    if (isset($_POST['NovoNomeTime'])) 
    {
        $novoNomeTime = $_POST['NovoNomeTime'];
        // Atualiza o nome do time no banco de dados usando prepared statement
        $atualizar_query = $conexao->prepare("UPDATE Times SET NomeTime = ? WHERE idCriador = ?");
        $atualizar_query->bind_param("si", $novoNomeTime, $IdCriador);

        if ($atualizar_query->execute()) 
        {
            $NomeTime = $novoNomeTime; // Atualiza o valor de $NomeTime com o novo nome

            echo "Nome do time atualizado com sucesso para: $novoNomeTime";
        } 
        else 
        {
            echo "Erro ao atualizar o nome do time: " . $conexao->error;
        }
    } 
    else 
    {
        echo "O campo Novo Nome do Time está vazio.";
    }
}

if (isset($_POST['submitExcluirTime'])) {
  $excluir_query = $conexao->prepare("DELETE FROM Times WHERE idCriador = ?");
  $excluir_query->bind_param("i", $IdCriador);

  if ($excluir_query->execute()) {
    // Verificar se não existem mais times associados ao IdCriador
    $verificar_times_query = $conexao->prepare("SELECT COUNT(*) AS total_times FROM Times WHERE idCriador = ?");
    $verificar_times_query->bind_param("i", $IdCriador);
    $verificar_times_query->execute();
    $result = $verificar_times_query->get_result();
    $row = $result->fetch_assoc();

    if ($row['total_times'] == 0) {
        // Não há mais times associados ao IdCriador, redirecionar para a tela inicial
        header('Location: Pagina_Principal.php');
        exit();
    }

    echo "Time excluído com sucesso!";
    // Redirecionar para uma página ou realizar ações adicionais após a exclusão bem-sucedida, se necessário
} else {
    echo "Erro ao excluir o time: " . $conexao->error;
}
}

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
<!-- Em algum lugar da sua página onde você exibe o nome do time, adicione um id -->

<form id="formAtualizarNome" action="" method="post">
    <table class="table table-striped table-dark mx-auto custom-mt-5" style="width: 60%;margin-top: 15%;">
      <thead>
        <tr>     
          <th scope="col" style="text-align: right;">SEU TIME :</th> 
         <!--caso todos os times sejam excluidos, esta linha permitira que o sistema continue rodando sem apontar um erro que a variavel esta sem valor!--> <td id="NomeTime"><?php echo isset($NomeTime) ? $NomeTime : "Nenhum time disponível"; ?></td>
 
        </tr>
      </thead>
      <tbody>
          <th scope="row">TROCAR O NOME DO TIME PARA:</th>
          <td><input type="text" placeholder="NOVO NOME" class="inputs" name="NovoNomeTime"></td>
          <td><input style="display: inline-block;" class="inputSubmit" type="submit" id="botao" value="SALVAR" name="submitNomeTime"></td>
      </tbody>    
</form>

<form id="formExcluirTime" action="" method="post">
  <table class="table table-striped table-dark mx-auto custom-mt-5" style="width: 60%; margin-top: 1px;">

    <tbody>
      <th><label for="selectTime">EXCLUIR TIME</label></th>
      <td> <input style="display: inline-block;" class="inputSubmit" type="submit" id="botaoExcluir" value="EXCLUIR" name="submitExcluirTime"></td>
    </tbody>
  </table>        



<!--<select name="IdTimeExcluir" id="selectTime"> 
<?php //foreach ($times_do_criador as $time) : ?>
<?php //if (isset($time['Id']) && isset($time['NomeTime'])) : ?>
    <option value="<?php //echo $time['Id'];?>">
        <?php //echo $time['NomeTime']; ?>
    </option>
<?php// endif; ?>
<?php //endforeach; ?>
<input style="display: inline-block;" class="inputSubmit" type="submit" id="botaoExcluir" value="EXCLUIR" name="submitExcluirTime">
</select>-->
<!-- No seu arquivo HTML/PHP -->


</form>
</body>

