<?php 
    if (isset($_GET['buscar'])) {
        $busca = $_GET['buscar'];

        include_once './class/produto.php';
        $produto = new Produto();
        $produtos = $produto->buscarPorString($busca);
        $linhas = count($produtos);
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
    <main class="container shadow bg-light px-5">
        <section>
        <?php if ($linhas == 0) { ?>
            <h2 class="alert bg-dark text-white text-center">Nenhum resultado encontrado!</h2>
        <?php }?>
        <?php if($linhas > 0) {?>
            <h2 class="alert bg-dark text-white text-center">Busca de produtos por: "<?= $busca?>"</h2>
            <div class="row">
                <!-- Card -->
                <?php foreach($produtos as $produto):?>
                <div class="col-sm-6 col-md-4 mb-4">
                    <div class="card border border-0">
                        <img src="./images/<?= $produto['imagem']?>" alt="Picanha ao alho" class="card-img-top">
                        <div class="card-body bg-dark text-white">
                            <h3 class="card-title"><?= $produto['descricao']?></h3>
                            <p class="fst-italic"><?= $produto['rotulo']?></p>
                            <p class="card-text text-start"><?=mb_strimwidth($produto['resumo'], 0, 79,'...')?></p>
                            <button class="btn btn-default disabled" role="button" style="cursor: default;">
                                <?= "R$ ".number_format($produto['valor'], 2, ',', '.') ?>
                            </button>
                                <a href="detalhes_produto.php?id=<?=$produto['id']?>" class="btn btn-light float-end">
                                <span class="d-none d-sm-inline">Saiba mais</span>
                                <i class="bi bi-eye-fill ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- Final card -->
            </div>
        </section>
        <?php }?>
    </main>
    <footer class="container shadow bg-light text-black p-4 mt-5" id="contato">
        <a name="contato"></a>
        <?php include 'rodape.php' ?>
    </footer>
</body>
</html>