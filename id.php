<?php
session_start(); // Inicia a sessão

// Verifica se a variável de sessão 'user_id' está definida e exibe seu valor
if (isset($_SESSION['user_id'])) {
    echo 'ID do usuário na sessão: ' . $_SESSION['user_id'];
} else {
    echo 'A variável de sessão user_id não está definida.';
}
?>
