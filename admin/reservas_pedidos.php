<?php
    include 'acesso_com.php';

    include "../class/reserva.php";
    include "../class/mesa.php";

    $status = "P";
    $reserva = new Reserva();
    $reservas = $reserva->listar($status);
    $linhas = count($reservas);

    $mesa = new Mesa();
    $mesas = $mesa->listar();
    $linhas = count($mesas);
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
        <h2 class="alert bg-dark text-white text-center">Lista de Pedidos de Reserva</h2>
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
                    <th class="text-center">EXPEDIDO</th>
                    <th class="text-center">AÇÕES</th>
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
                            <p><?= $reserva['data_criacao']?></p>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-2">

                                <button 
                                data-codigo="<?=$reserva['codigo_reserva']?>"
                                data-id="<?=$reserva['id']?>"
                                class="accept btn btn-success btn-sm w-100 fs-5">
                                <i class="bi bi-check-circle-fill"></i> Aceitar</button>


                                <button
                                data-codigo="<?=$reserva['codigo_reserva']?>"
                                data-id="<?=$reserva['id']?>"
                                class="decline btn btn-danger btn-sm w-100 fs-5">
                                <i class="bi bi-x-circle-fill"></i> Recusar</button>
                            </div>
                        </td>
                    </tr>    
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="modalAccept" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Deseja confirmar reserva?</h4>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Código: <span class="nome text-danger"></span></p>
                    <p>Cliente: <?=$reserva['nome']?></p>
                    <p>Data: <?=$reserva['data_reserva']?> às <?=$reserva['horario']?></p>
                    <p>Pessoas: <?=$reserva['qtd_pessoas']?></p>
                    <form method="get">
                        <div>
                            <label class="label-form">Selecione a mesa.</label>
                            <select name="id_mesa" id="id_mesa" class="form-select" required>
                            <?php foreach ($mesas as $mesa): ?>
                                <option value="<?=$mesa['id']?>">Mesa: <?=$mesa['numero']?> para até <?=$mesa['capacidade']?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-success confirm-yes">Confirmar</a>
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Recusa -->
    <div class="modal fade" id="modalDecline" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Deseja recusar a reserva?</h4>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Código: <span class="nome text-danger"><?=$reserva['codigo_reserva']?></span></p>
                    <p>Cliente: <?=$reserva['nome']?></p>
                    <p>Data: <?=$reserva['data_reserva']?> às <?=$reserva['horario']?></p>
                    <p>Pessoas: <?=$reserva['qtd_pessoas']?></p>
                    <form method="post">
                        <div>
                            <label class="label-form">Informe o motivo da resusa.</label>
                            <input type="text" name="motivo" id="motivo" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-success refuse-yes">Confirmar</a>
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
 
    <!-- JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.querySelectorAll('.accept').forEach(btn =>{
            btn.addEventListener('click', function(){
                let nome = this.getAttribute('data-codigo');
                let id = this.getAttribute('data-id');

                document.querySelector('span.nome').textContent = nome;
                document.querySelector('a.confirm-yes').setAttribute('href', 'reservas_lista.php?id='+id)

                let modal = new bootstrap.Modal(document.getElementById('modalAccept'));
                modal.show();
            });
        });
    </script>

    <script>
        document.querySelectorAll('.decline').forEach(btn =>{
            btn.addEventListener('click', function(){
                let nome = this.getAttribute('data-codigo');
                let id = this.getAttribute('data-id');

                document.querySelector('span.nome').textContent = nome;
                document.querySelector('a.refuse-yes').setAttribute('href', 'reservas_lista.php?id='+id)

                let modal = new bootstrap.Modal(document.getElementById('modalDecline'));
                modal.show();
            });
        });
    </script>
</body>
</html>