<?php
    include 'acesso_com.php';

    include "../class/produto.php";

    $produto = new Produto();
    $produtos = $produto->listar(0);
    $linhas = count($produtos);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Lista</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <?php include 'menu_adm.php'; ?>
    <main class="container my-4">
        <h2 class="alert bg-dark text-white text-center">Lista de Produtos</h2>
        <table class="table table-hover table-sm table-warning align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="d-none">ID</th>
                    <th class="text-center">TIPO</th>
                    <th class="text-center">DESCRIÇÃO</th>
                    <th class="text-center">RESUMO</th>
                    <th class="text-center">VALOR</th>
                    <th class="text-center">IMAGEM</th>
                    <th>
                        <a href="produtos_insere.php" target="_self" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-plus-circle"></i>
                            <span class="d-none d-sm-inline"> ADICIONAR</span>
                        </a>
                    </th>
                </tr>
            </thead>
           
            <tbody>
                <?php foreach($produtos as $produto):?>
                    <tr class="fs-5">
                        <td class="d-none">
                            <p><?= $produto['id']?></p>
                        </td>
                        <td>
                            <p class="mx-2"><?= $produto['rotulo']?></p>
                        </td>
                        <td>
                            
                            <?php 
                                if ($produto['destaque'] == 1) {
                                    echo '<p>'.$produto['descricao'].'<i class="bi bi-star-fill mx-3 text-warning"></i></p>';
                                } else {
                                    echo "<p>".$produto['descricao']."</p>";
                                }
                            ?>
                        </td>
                        <td>
                            <p><?=mb_strimwidth($produto['resumo'], 0, 50,'...')?></p>
                        </td>
                        <td>
                            <p class="text-center mx-3"><?= "R$ ".number_format($produto['valor'], 2, ',', '.') ?></p>
                        </td>
                        <td>
                            <div class="text-center">
                                <img src="../images/<?= $produto['imagem']?>" width="150" class="my-1 img-fluid rounded">
                            </div>
                        </td>
                        <td>
                            <div class="mx-2">
                                <a href="produtos_atualiza.php?id=<?=$produto['id']?>"
                                class="btn btn-warning btn-sm w-100 mb-1">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    <span class="d-none d-sm-inline"> ALTERAR</span>    
                                </a>
    
                            
    
                                <button
                                    data-nome="<?=$produto['descricao']?>"
                                    data-id="<?=$produto['id']?>"
                                    class="delete btn btn-danger btn-sm w-100 <?=$produto['destaque']?'d-none':''?>">
                                    
                                    <i class="bi bi-trash"></i>
                                    <span class="d-none d-sm-inline"> EXCLUIR</span>
                                </button>
                            </div>
                        </td>
                    </tr>    
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
 
    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Vamos deletar?</h4>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Deseja mesmo excluir o item?
                    <h4><span class="nome text-danger"></span></h4>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger delete-yes">Confirmar</a>
                    <button class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
 
    <!-- JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 
    <script>
        document.querySelectorAll('.delete').forEach(btn =>{
            btn.addEventListener('click', function(){
                let nome = this.getAttribute('data-nome');
                let id = this.getAttribute('data-id');

                document.querySelector('span.nome').textContent = nome;
                document.querySelector('a.delete-yes').setAttribute('href', 'produtos_exluir.php?id='+id)

                let modal = new bootstrap.Modal(document.getElementById('modalEdit'));
                modal.show();
            });
        });
    </script>
</body>
</html>