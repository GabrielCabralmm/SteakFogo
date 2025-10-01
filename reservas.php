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
        <h2 class="alert bg-dark text-white text-center mb-3">Minhas Reservas</h2>
        <div class="row">
            <div class="d-flex flex-row gap-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data: 20/11/2025</h5>
                        <h5 class="card-title">Hora: 20:30</h5>
                        <p class="card-text">Motivo: Confraternização</p>
                        <p class="card-text">Pessoas: 6</p>
                        <p class="card-text">Status: Confirmado</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="container shadow bg-light text-black p-4 mt-5" id="contato">
        <a name="contato"></a>
        <?php include 'rodape.php' ?>
    </footer>
</body>
</html>