<?php 
    session_name('chulettaaa');
    session_start();

    // $_SESSION['login_usuario'] = "Gabriel";
    // $_SESSION['nome_da_sessao'] = 'chulettaaa';

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

    if (!isset($_SESSION['ip_usuario'])) {
        $_SESSION['ip_usuario'] = $_SERVER['REMOTE_ADDR'];
    }

    if (!isset($_SESSION['user_agent'])) {
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    }

    if ($_SESSION['ip_usuario']!== $_SERVER['REMOTE_ADDR'] ||
    $_SESSION['user_agent']!== $_SERVER['HTTP_USER_AGENT']) {
        session_destroy();
        header('location: login.php');
        exit;
    }
?>