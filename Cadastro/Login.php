
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
        .botaolog{
            margin-top:20px;
            background-color: #C85C5C;
            border: none;
            padding: 15px;
            width: 80%;
            border-radius: 10px;
            color: white;
            font-size: 20px;
        }
        .tela-login{
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
        .login{
            color:#140B27
        }
        
    </style>
</head>

<body>
    <!--Preciso fazer o tratamento para que o login seja feito com o nome de usuario mais a tag NOME#000-->
    <form action="LogTest.php" method="post" class="tela-login">
        <h1 class="login">Login</h1>
            <input id="formnome" type="text" placeholder="Email" class="inputs" name="Email">
            <!--<span style="display: inline-block; width: 23px; text-align: center; font-size: 31px;">#</span>
            <input id="formnumero"type="text" placeholder="000" class="inputs" name="Numeros"> -->
        <br><br>
            <input  type="password" placeholder="Senha" name="Senha" class="senha">
        <br><br>
            <input  class="botaolog" type="submit" id="botao" value="Entrar" name="submit">
        <h1  style="display: inline-block; margin-bottom: -20px; margin-top: 50px; color:#140B27;">Não tem uma conta?<a href="../Cadastro/Cadastro.php">Cadastre-se</a></h1>
    </form>
</body>
<footer>

</footer>