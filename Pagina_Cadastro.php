<?php
include_once('Config.php');

if(isset($_POST['submit'])) {
    $Email = $_POST['Email'];
    $NomeCompleto = $_POST['NomeCompleto'];

    if(isset($_POST['Nome']) && isset($_POST['Numeros'])) {
        $Nome = $_POST['Nome'];
        $Numeros = $_POST['Numeros'];
        $NomeUsuario = $Nome . '#' . $Numeros;

        if (preg_match('/^[a-zA-Z]+#[0-9]+$/', $NomeUsuario)) {
            $check_query = "SELECT * FROM Usuarios WHERE NomeUsuario = '$NomeUsuario'";
            $check_result = $conexao->query($check_query);

            if ($check_result->num_rows > 0) {
                echo "O nome de usuário '$NomeUsuario' já está em uso. Por favor, escolha outro.";
            } else {
                $Senha = $_POST['Senha'];
                $sql = "INSERT INTO Usuarios (Email, NomeCompleto, NomeUsuario, Senha) VALUES ('$Email', '$NomeCompleto', '$NomeUsuario', '$Senha')";

                if ($conexao->query($sql) === TRUE) {
                    echo "Dados inseridos com sucesso!";
                } else {
                    echo "Erro ao inserir dados: " . $conexao->error;
                }
            }
        } else {
            echo "O nome de usuário não segue o padrão desejado (Nome#123).";
        }
    }
}

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
            background-color: rgb(130 167 241);
        }
        .tela-cadastro{
            background-color: rgb(138 82 255);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 50px;
            padding-bottom:25px;
            padding-top: 6px;
            border-radius: 15px;
            color: white; 
            text-align: center;
            
        }
        .tela-cadastro input#formnome{
            outline: none;
            border: none;               
            font-size: 30px;
            width: 249px;              
            margin-left: 1px;       
        }
        .tela-cadastro input#formnumero{
            outline: none;
            border: none;   
            font-size: 30px;
            width: 105px;
            
            
        }
        .tela-cadastro button#botao{
            background-color: blue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 20px; 
            margin-top: 10%;          
            
        }
        .tela-cadastro button#botao:hover{
            background-color: black;
            cursor: pointer;
            
        }
        .tela-cadastro h1#titulo{
            margin-top: -10%;
            display: inline-block;
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
   
</style>
<body>
    <div class="tela-cadastro">
    <a href="Pagina_inicial.php">
            <img src="img\Teams.png" alt="" width="540" height="97">
        </a>
        
        <br>
        <br>
        <form action="" method="post">
            <div>
                <input type="text" placeholder="Email" class="inputs" name="Email">
            </div>
            <br>
            <div>
                <input type="text" placeholder="Nome completo" class="inputs" name="NomeCompleto">                
            </div>
            <br>
            <div>           
                <input id="formnome" type="text" placeholder="Usuário + tag" class="inputs" name="Nome">
                <span style="display: inline-block; width: 23px; text-align: center; font-size: 31px;">#</span>
                <input id="formnumero"type="text" placeholder="000" class="inputs" name="Numeros">          
            </div>
            <br>
            <div>
                <input type="password" placeholder="Senha" class="inputs" name="Senha">            
            </div>
            
            <button type="submit" id="botao" name="submit">Cadastrar</button>
        </form>
    </div>
</body>
<footer>    
</footer>
</html>