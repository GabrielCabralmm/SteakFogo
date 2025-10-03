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
        <h2 class="alert bg-dark text-white text-center mb-3">Reservas</h2>
        <div class="d-flex flex-row justify-content-between">
        <div class="w-75 mb-3">
            <form method="post" class="d-flex flex-column mx-auto border border-light-subtle p-3 rounded">
                <div class="d-flex flex-column mx-auto w-75">
                    <div class="mb-3">
                        <label class="form-label">Nome completo:</label>
                            <input type="text" class="form-control" id="nome" required>
                            <div class="form-text">Insira seu nome completo.</div>
                        </div>
                    <div class="mb-3">
                            <label class="form-label">CPF completo:</label>
                            <input type="text" class="form-control" id="cpf" required>
                            <div class="form-text">Insira seu CPF.</div>
                    </div>
                    <div class="mb-3">
                            <label class="form-label">Email completo:</label>
                            <input type="email" class="form-control" id="email" required>
                            <div class="form-text">Insira seu email completo.</div>
                    </div>
                    <div class="mb-3">
                            <label class="form-label">Telefone com DDD:</label>
                            <input type="tel" class="form-control" id="tel" required>
                            <div class="form-text">Insira seu telefone completo.</div>
                    </div>  
                    <div class="d-flex flex-row justify-content-evenly">
                        <div class="mb-3">
                                <label class="form-label">Data da reserva:</label>
                                <input type="date" class="form-control" id="data_reserva" required>
                                <div class="form-text">Escolha a data da reserva.</div>
                        </div>
                        <div class="mb-3">
                                <label class="form-label">Horário da reserva:</label>
                                <select class="form-control" id="horario" name="horario" required>
                                    <option value="">Selecione um horário</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                </select>
                                <div class="form-text">Escolha um horário para a reserva.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                            <label class="form-label">Quantidade de pessoas:</label>
                            <input type="number" class="form-control" id="pessoas" required min="1">
                            <div class="form-text">Informe a quantidade de pessoas.</div>
                    </div>
                    <div class="mb-3">
                            <label class="form-label">Motivo da reserva:</label>
                            <input type="text" class="form-control" id="motivo" required>
                            <div class="form-text">Informe o motivo da reserva.</div>
                    </div>
                </div>
                <div class="my-3 mx-auto">
                    <input type="submit" value="Reservar" class="btn btn-warning fs-5">
                </div>
            </form>
        </div>
            <ul class="bg-dark text-white px-5 pt-5 pb-3 rounded fs-5 w-50">
                <li class="mb-1">Reservas na churrascaria oferecendo 30% de desconto no valor do rodízio do titular da reserva, e 15% de desconto em todas as bebidas da comada da mesa associada a reserva, para reservas com mais de 5 pessoas.</li>
                <li class="mb-1">No mínimo 36 horas de antecedência e no máximo 60 dias.</li>
                <li class="mb-1">Apenas um pedido de reserva por dia para um mesmo CPF.</li>
                <li class="mb-1">O cliente deve indicar a data escolhida, o horário e o número de pessoas da reserva, além de um possível motivo. Exemplo: "Aniversário", "Casamento", "Confraternização", etc.</li>
                <li class="mb-1">O cliente deve usar o nome completo, o CPF, o E-mail e o telefone para realizar a reserva</li>
            </ul>
        </div>
    </main>
    <footer class="container shadow bg-light text-black p-4 mt-5" id="contato">
        <a name="contato"></a>
        <?php include 'rodape.php' ?>
    </footer>
</body>
</html>