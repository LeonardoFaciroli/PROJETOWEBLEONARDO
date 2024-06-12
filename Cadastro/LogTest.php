<?php
session_start();


// Verifica se o formulário foi submetido e se os campos necessários foram preenchidos
if(isset($_POST['submit']) && !empty($_POST['Email']) && !empty($_POST['Senha'])) {
    include_once('../Outros/Config.php');

    // Sanitiza e obtém os valores dos campos
    $Email = mysqli_real_escape_string($conexao, $_POST['Email']);
    //$Numeros = mysqli_real_escape_string($conexao, $_POST['Numeros']);
    $Senha = mysqli_real_escape_string($conexao, $_POST['Senha']);

    // Concatenação do Nome de Usuário
    

    // Consulta preparada para evitar injeção de SQL
    $check_query = "SELECT * FROM Usuarios WHERE Email = ? AND Senha = ?";
    $stmt = $conexao->prepare($check_query);
    $stmt->bind_param("ss", $Email, $Senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se as credenciais são válidas..................................
    if ($result->num_rows > 0) {
        // Usuário válido, proceda com o login
        // Obtenha o ID do usuário
        $row = $result->fetch_assoc();//session
        $id_do_usuario = $row['Id']; 
        $nivel_acesso_id = $row['nivel_acesso_id']; 
        $_SESSION['user_id'] = $id_do_usuario;
        $_SESSION['nivel_acesso_id'] = $nivel_acesso_id;

        //echo "ID do usuário: " . $id_do_usuario;
        //exit();

        header('Location: ../Pages/Pagina_Principal.php'); // Aqui você pode redirecionar o usuário para sua página principal, por exemplo.
        exit();
    } else {
        echo "nenhum usuario encontrado";
        exit();
       header('Location: ../Cadastro/Login.php?erroe-invalid_credentials');
    exit();
        
    }

    $stmt->close();
    $conexao->close();
} 
?>
