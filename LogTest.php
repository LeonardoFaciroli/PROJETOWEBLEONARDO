<?php
session_set_cookie_params(0);
session_start();

// Verifica se o formulário foi submetido e se os campos necessários foram preenchidos
if(isset($_POST['submit']) && !empty($_POST['Nome']) && !empty($_POST['Senha'])) {
    include_once('Config.php');

    // Sanitiza e obtém os valores dos campos
    $Nome = mysqli_real_escape_string($conexao, $_POST['Nome']);
    $Numeros = mysqli_real_escape_string($conexao, $_POST['Numeros']);
    $Senha = mysqli_real_escape_string($conexao, $_POST['Senha']);

    // Concatenação do Nome de Usuário
    $NomeUsuario = $Nome . '#' . $Numeros;

    // Consulta preparada para evitar injeção de SQL
    $check_query = "SELECT * FROM Usuarios WHERE NomeUsuario = ? AND Senha = ?";
    $stmt = $conexao->prepare($check_query);
    $stmt->bind_param("ss", $NomeUsuario, $Senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se as credenciais são válidas
    if ($result->num_rows > 0) {
        // Usuário válido, proceda com o login
        // Obtenha o ID do usuário
        $row = $result->fetch_assoc();//session
        $id_do_usuario = $row['id']; // Altere 'id' para o nome da coluna que armazena o ID do usuário
        $_SESSION['user_id'] = $id_do_usuario;
        header('Location: Pagina_Principal.php'); // Aqui você pode redirecionar o usuário para sua página principal, por exemplo.
        exit();
    } else {
        echo '<script>alert("Nome de usuário ou senha inválidos."); window.location.href = "Pagina_inicial.php";</script>';
    exit();
        
    }

    $stmt->close();
    $conexao->close();
} 
?>
