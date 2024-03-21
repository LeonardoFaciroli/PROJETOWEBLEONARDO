
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
   
    <style>
        body{
            font-family: Ariel, Helvetica, sans-serif;
            background-color: rgb(130 167 241);

        }
        .tela-login{
            background-color: rgb(138 82 255);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 60px;
            border-radius: 15px;
            color: white; 
            text-align: center;            
        }
        .tela-login input#botao{
            background-color: blue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 20px;
            
        }
        .tela-login input#botao:hover{
            background-color: black;
            cursor: pointer;
        }
        .tela-login h1#login{
            margin-top: -50px;
        }
        .tela-login input#formnome{
            outline: none;
            border: none;               
            font-size: 30px;
            width: 249px;              
            margin-left: 1px
        }
            .tela-login input#formnumero{
            outline: none;
            border: none;   
            font-size: 30px;
            width: 105px;
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
</head>

<body>
    <!--Preciso fazer o tratamento para que o login seja feito com o nome de usuario mais a tag NOME#000-->
    <form action="LogTest.php" method="post" class="tela-login">
        <h1 id="login">Login</h1>
            <input style="display: inline-block; margin-bottom: -20px; margin-top: 30px" id="formnome" type="text" placeholder="Email" class="inputs" name="Email">
            <!--<span style="display: inline-block; width: 23px; text-align: center; font-size: 31px;">#</span>
            <input id="formnumero"type="text" placeholder="000" class="inputs" name="Numeros"> -->
        <br><br>
            <input  type="password" placeholder="Senha" name="Senha">
        <br><br>
            <input style="display: inline-block; margin-bottom: -20px; margin-top: 30px" class="inputSubmit" type="submit" id="botao" value="Entrar" name="submit">
        <h1  style="display: inline-block; margin-bottom: -20px; margin-top: 50px">Não tem uma conta?<a href="../Cadastro/Cadastro.php">Cadastre-se</a></h1>
    </form>
</body>
<footer>

</footer>