<?php 
    include "acesso_com.php";
    include_once '../class/reserva.php';
    include_once '../class/mesa_reserva.php';

    if (isset($_GET)) {
        $reserva = new Reserva();
        $id = $_Get['id'];
        if ($reserva->aceitar($_GET['id'])) {
            if (isset($_GET['id_mesa'])) {
                $mesa_reserva = new MesaReserva();
                $id_mesa = $_Get['id_mesa'];
                if ($mesa_reserva->inserir($id, $id_mesa)){
                    header('location: ./reservas_pedidos.php');
                }
            }
        }
    }
?>