<?php 
    include_once 'db.php';

    class MesaReserva {
        // Atributos
        private $id;
        private $id_reserva;
        private $id_mesa;
        private $pdo;

        public function __construct(){
            $this->pdo = getConnection();
        }

        //Getters e Setters - Propriedades

        public function getId(){
            return $this->id;
        }

        public function getId_reserva(){
            return $this->id_reserva;
        }

        public function setId_reserva(int $id_reserva){
            $this->id_reserva = $id_reserva;
        }

        public function getId_mesa(){
            return $this->id_mesa;
        }

        public function setId_mesa(int $id_mesa){
            $this->id_mesa = $id_mesa;
        }

        // Funções
        public function inserir(int $id_reserva, int $id_mesa):bool {
            $sql = "insert into reserva_mesa (id_reserva, id_mesa)
                    values (:id_reserva, :id_mesa)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id_reserva", $id_reserva);
            $cmd->bindValue(":id_mesa", $id_mesa);
            $cmd->execute();
            if ($cmd->execute()) {
                $this->id = $this->pdo->lastInsertId();
                return true;
            }
            return false;
        }

        public function listar(): array{
            $cmd = $this->pdo->query("select * from reserva_mesa order by id desc");
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscarPorId(int $id):array{
            $sql = "select * from reserva_mesa where id = :id ";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $dados = $cmd->fetch();
            return $dados;
        }

        public function atualizar(int $idUpdate):bool{
            $this->id = $idUpdate;
            if(!$this->id) return false;

            $sql = "update produtos set
                    id_reserva = :id_reserva, id_mesa = :id_mesa where id = :id ";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id_reserva", $this->id_reserva);
            $cmd->bindValue(":id_mesa", $this->id_mesa);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

        public function excluir(int $idExcluir):bool{
            $this->id = $idExcluir;
            if(!$this->id) return false;

            $sql = "delete from reserva_mesa where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }
    }
?>