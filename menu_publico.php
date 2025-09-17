<?php 
    include "./class/db.php";
    $pdo = getConnection();
    $tipo_lista = $pdo->query("select * from tipos");
    $tipos = $tipo_lista->fetchAll();
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a href="index.html" class="navbar-brand">
            <img src="./images/logo/Logo-200-40-Escuro.png" alt="Logotipo Steak & Fogo" width="190px">
        </a>
        <button 
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#menupublico"
        aria-controls="menupublico"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menupublico">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a href="index.php" class="nav-link active" aria-current="page">
                        <i class="bi bi-house-door-fill"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#destaques" class="nav-link">Destaques</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Produtos</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tipos</a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <?php foreach ($tipos as $tipo):?>
                            <li><a href="produto_por_tipo.php?tipo_id=<?=$tipo['id']?>" class="dropdown-item"><?=$tipo['rotulo']?></a></li>
                        <?php endforeach?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#contato" class="nav-link me-2">Contato</a>
                </li>
                <li class="nav-item">
                    <form class="d-flex" role="search">
                        <input type="search" class="form-control form-control-sm me-2" placeholder="Buscar" aria-label="Search" required>
                        <button class="btn btn-dark"><i class="bi bi-search"></i></button>
                    </form>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-person-fill"></i>&nbsp;Admin/Cliente
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>