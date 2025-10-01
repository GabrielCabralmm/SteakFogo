<?php
    include 'acesso_com.php';

    include "../class/reserva.php";

    $status = "P";
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
                            <p><?= $reserva['data_criacao']?></p>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-2">
                                <button class="accept btn btn-success btn-sm w-100 fs-5"
                                data-nome="<?=$tipo['codigo_reserva']?>"
                                data-id="<?=$tipo['id']?>"
                                ><i class="bi bi-check-circle-fill"></i> Aceitar</button>
                                <button class="btn btn-danger btn-sm w-100 fs-5"><i class="bi bi-x-circle-fill"></i> Recusar</button>
                            </div>
                        </td>
                    </tr>    
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Deseja confirmar a reserva?</h4>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p><?=$reserva['nome']?></p>
                    <p><?=$reserva['codigo_reserva']?></p>
                    <p><?=$reserva['data_reserva']?> às <?=$reserva['horario']?></p>
                    <h4><span class="codigo_reserva text-danger"></span></h4>
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
        document.querySelectorAll('.accept').forEach(btn =>{
            btn.addEventListener('click', function(){
                let codigo_reserva = this.getAttribute('codigo_reserva');
                let id = this.getAttribute('data-id');

                document.querySelector('span.codigo_reserva').textContent = codigo_reserva;
                document.querySelector('a.delete-yes').setAttribute('href', 'tipos_exluir.php?id='+id)

                let modal = new bootstrap.Modal(document.getElementById('modalEdit'));
                modal.show();
            });
        });
    </script>
</body>
</html>