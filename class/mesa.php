<?php 
    include_once 'db.php';

    class Mesa {
        // Atributos
        private $id;
        private $numero;
        private $capacidade;
        private $pdo;

        public function __construct(){
            $this->pdo = getConnection();
        }

        //Getters e Setters - Propriedades
        public function getId(){
            return $this->id;
        }

        public function getNumero(){
            return $this->numero;
        }

        public function setNumero(int $numero){
            $this->numero = $numero;
        }

        public function getCapacidade(){
            return $this->capacidade;
        }

        public function setCapacidade(int $capacidade){
            $this->capacidade = $capacidade;
        }

        // Funções
        public function inserir():bool {
            $sql = "insert into mesas (numero, capacidade)
                    values (:numero, :capacidade)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":numero", $this->numero);
            $cmd->bindValue(":capacidade", $this->capacidade);
            $cmd->execute();
            if ($cmd->execute()) {
                $this->id = $this->pdo->lastInsertId();
                return true;
            }
            return false;
        }

        public function listar(): array{
            $cmd = $this->pdo->query("select * from mesas order by id desc");
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscarPorId(int $id):array{
            $sql = "select * from mesas where id = :id";
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
                    numero = :numero, capacidade = :capacidade where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":numero", $this->numero);
            $cmd->bindValue(":capacidade", $this->capacidade);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

        public function excluir(int $idExcluir):bool{
            $this->id = $idExcluir;
            if(!$this->id) return false;

            $sql = "delete from mesas where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }
    }
?>