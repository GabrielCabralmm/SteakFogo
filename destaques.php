<?php 
    include "./class/produto.php";

    $produto = new Produto();
    $produtos = $produto->listar(1);
    $linhas = count($produtos);
?>

<section>
<?php if ($linhas == 0) { ?>
    <h2 class="alert bg-dark text-white text-center">Não há produtos em destaque.</h2>
<?php }?>
<?php if($linhas > 0) {?>
    <h2 class="alert bg-dark text-white text-center">Destaques</h2>
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