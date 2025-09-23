<?php 
    include "acesso_com.php";
    include_once '../class/produto.php';

    if (isset($_GET)) {
        $produto = new Produto();
        if ($produto->excluir($_GET['id'])) {
            header('location: produtos_lista.php'); 
        }
    }
?>