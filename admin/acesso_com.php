<?php 
    session_name('chulettaaa');
    session_start();

    if (!isset($_SESSION['login_usuario'])) {
        header('location: login.php');
        exit;
    }

    if (!isset($_SESSION['nome_da_sessao'])) {
        $_SESSION['nome_da_sessao'] = session_name();
    } elseif ($_SESSION['nome_da_sessao'] !== session_name()) {
        session_destroy();
        header('location: login.php');
        exit;
    }

    
?>