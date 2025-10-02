<?php
    include 'acesso_com.php';

    include "../class/reserva.php";

    $status = "A";
    $reserva = new Reserva();
    $reservas = $reserva->listar($status);
    $linhas = count($reservas);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/bootstrap.min.js" defer></script>
    <script src="../js/bootstrap.bundle.min.js" defer></script>
    <title>Reserva - Pedidos</title>
</head>
<body>
    <?php include 'menu_adm.php'; ?>
    <main class="container my-4">
        <h2 class="alert bg-dark text-white text-center">Lista de Reservas</h2>
        <table class="table table-hover table-sm table-warning align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="d-none">ID</th>
                    <th class="text-center">CÓDIGO</th>
                    <th class="text-center">CLIENTE</th>
                    <th class="text-center">DATA</th>
                    <th class="text-center">HORÁRIO</th>
                    <th class="text-center">MOTIVO</th>
                    <th class="text-center">PESSOAS</th>
                    <th class="text-center">MESA</th>
                </tr>
            </thead>
           
            <tbody>
                <?php foreach($reservas as $reserva):?>
                    <tr class="fs-5 text-center">
                        <td class="d-none">
                            <p><?= $reserva['id']?></p>
                        </td>
                        <td>
                            <p><?= $reserva['codigo_reserva']?></p>
                        </td>
                        <td>
                            <p><?= $reserva['nome']?></p>
                        </td>
                        <td>
                            <p><?= $reserva['data_reserva']?></p>
                        </td>
                        <td>
                            <p><?=$reserva['horario']?></p>
                        </td>
                        <td>
                            <p><?= $reserva['motivo']?></p>
                        </td>
                        <td>
                            <p><?= $reserva['qtd_pessoas']?></p>
                        </td>
                        <td>
                            <p><?= $reserva['mesa']?></p>
                        </td>
                    </tr>    
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>