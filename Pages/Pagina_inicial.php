<?php
session_start();
?>
<head>

</head>
<style>
    
body{
    margin-top:40px;
    margin-left:0px;
    margin-right:0px;
    margin-bottom:0px;    
}
.img{
    display: block;
    height: calc(100vh - 40px);; 
    width:100vw
    
}


.barra-superior {
    background-color:#E1A07C;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 40px;
    z-index: 1;
    display: flex;
    justify-content: flex-end; /* Alinha os itens à esquerda */
    align-items: center; /* Centraliza verticalmente os itens */
    padding-right: 20px; /* Adiciona algum espaço à esquerda dos botões */
}
.botao{
    color: white;
    background-color: #140B27;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
    text-decoration: none;
}
.botao:hover{
    background-color: #26154A;
}

</style>
<Body >
    <div>
    <img src="../img/insiraeventos.png" alt="" class="img">
    </div>
<div>
<img src="../img/FacaseuseventosganharemvidaV2.png" alt="" class="img">
</div>    

    <div class="barra-superior">
        <a href="../Cadastro/Login.php"class="botao">Login</a>
        <a href="../Cadastro/Cadastro.php" class="botao">Cadastre-se</a>
    </div>
    
</Body>