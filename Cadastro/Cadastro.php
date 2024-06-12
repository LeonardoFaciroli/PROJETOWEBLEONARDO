<?php
include_once('../Outros/Config.php');
global $conexao;

if(isset($_POST['submit'])) {
    $Email = $_POST['Email'];
    $NomeCompleto = $_POST['NomeCompleto'];

    //if(isset($_POST['Nome']) && isset($_POST['Numeros'])) {
       // $Nome = $_POST['Nome'];
       // $Numeros = $_POST['Numeros'];
       // $NomeUsuario = $Nome . '#' . $Numeros;

        //if (preg_match('/^[a-zA-Z]+#[0-9]+$/', $NomeUsuario)) {
            //$check_query = "SELECT * FROM Usuarios WHERE NomeUsuario = '$NomeUsuario'";
            //$check_result = $conexao->query($check_query);

           // if ($check_result->num_rows > 0) {
           //     echo "O nome de usuário '$NomeUsuario' já está em uso. Por favor, escolha outro.";
           // } else {
                
                $Senha = $_POST['Senha'];
                $sql = "INSERT INTO Usuarios (Email, NomeCompleto, Senha) VALUES ('$Email', '$NomeCompleto', '$Senha')";

                if ($conexao->query($sql) === TRUE) {
                    echo "Dados inseridos com sucesso!";
                } else {
                    echo "Erro ao inserir dados: " . $conexao->error;
                }
            
        } //else {
          //  echo "O nome de usuário não segue o padrão desejado (Nome#123).";
        //}
    

$conexao->close();
?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<style>
    body{
        font-family: Ariel, Helvetica, sans-serif;
            background-color: #140B27;
        }
     
        input{
            width: 405px;
            outline: none;
            border: none;   
            padding: auto; 
            font-size: 30px;
            padding: 10px;
            padding-right: 10px;
            
        }
        .botaocad{
            margin-top:20px;
            background-color: #C85C5C;
            border: none;
            padding: 15px;
            width: 80%;
            border-radius: 10px;
            color: white;
            font-size: 20px;
        }
        .tela-cadastro{
            background-color: #E1A07C;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 30px;
            border-radius: 15px;
            color: #C85C5C; 
            text-align: center;
        }
   
</style>
<body>
    <div class="tela-cadastro">
        <a href="Login.php">
            <img src="../img/insiraeventos.png" alt="" width="500" height="200">
        </a>
        
        <form class="formcad"action="" method="post">
            <div>
                <input type="text" placeholder="Email" class="inputs" name="Email">
            </div>
            <br>
            <div>
                <input type="text" placeholder="Nome completo" class="inputs" name="NomeCompleto">                
            </div>
            <br>
            <div>
                <input type="password" placeholder="Senha" class="inputs" name="Senha">            
            </div>
            
            <button class="botaocad"type="submit" id="botao" name="submit">CADASTRAR</button>
        </form>
    </div>
</body>
<footer>    
</footer>
</html>