<?php 
    include_once 'db.php';

    class Tipo {
        // Atributos
        private $id;
        private $sigla;
        private $rotulo;
        private $pdo;

        public function __construct(){
            $this->pdo = getConnection();
        }

        //Getters e Setters - Propriedades
        public function getId(){
            return $this->id;
        }

        public function getSigla(){
            return $this->sigla;
        }

        public function setSigla(int $sigla){
            $this->sigla = $sigla;
        }

        public function getRotulo(){
            return $this->rotulo;
        }

        public function setRotulo(int $rotulo){
            $this->rotulo = $rotulo;
        }

        // Funções
        public function inserir():bool {
            $sql = "insert into tipos (sigla, rotulo)
                    values (:sigla, :rotulo)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":sigla", $this->sigla);
            $cmd->bindValue(":rotulo", $this->rotulo);
            $cmd->execute();
            if ($cmd->execute()) {
                $this->id = $this->pdo->lastInsertId();
                return true;
            }
            return false;
        }

        public function listar(): array{
            $cmd = $this->pdo->query("select * from tipos order by id desc");
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscarPorId(int $id):array{
            $sql = "select * from tipos where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $dados = $cmd->fetch();
            return $dados;
        }

        public function atualizar(int $idUpdate):bool{
            $id = $idUpdate;

            if (!$this->id) return false;

            $sql = "update produtos set
                    sigla = :sigla, rotulo = :rotulo where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":sigla", $this->sigla);
            $cmd->bindValue(":rotulo", $this->rotulo);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

        public function excluir(int $idExcluir):bool{
            $id = $idExcluir;
            
            if (!$this->id) return false;

            $sql = "delete from tipos where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }
    }
?>