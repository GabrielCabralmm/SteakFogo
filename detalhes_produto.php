<?php 
    include_once './class/produto.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $produto = new Produto();
        $produto = $produto->buscarPorId($id);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/bootstrap.min.js" defer></script>
    <script src="./js/bootstrap.bundle.min.js" defer></script>
    <title>Steak & Fogo</title>
</head>
<body class="fundo-fixo">
    <head>
    <?php include 'menu_publico.php'?>
    </head>
    <main class="container shadow-lg bg-light">
        <h2 class="alert bg-dark text-white text-center">
            <a href="index.php" class="text-decoration-none">
                <button class="btn btn-danger">
                    <span class="bi bi-chevron-double-left"></span>
                </button>
                <strong class="text-white">Detalhes do produto</strong>
            </a>
        </h2>
        <div class="col-sm-6 col-md-6 mx-auto">
            <div class="card border-0">
                <div class="card border border-0">
                    <img src="./images/<?= $produto['imagem']?>" alt="Picanha ao alho" class="card-img-top">
                    <div class="card-body bg-dark text-white">
                        <h3 class="card-title"><?= $produto['descricao']?></h3>
                        <p class="fst-italic"><?= $produto['rotulo']?></p>
                        <p class="card-text text-start"><?=mb_strimwidth($produto['resumo'], 0, 79,'...')?></p>
                        <button class="btn btn-default disabled" role="button" style="cursor: default;">
                            <?= "R$ ".number_format($produto['valor'], 2, ',', '.') ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>