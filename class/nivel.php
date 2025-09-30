<?php 
    include_once 'db.php';

    class Nivel {
        // Atributos
        private $id;
        private $nivel;
        private $sigla;
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

        public function getNivel(){
            return $this->nivel;
        }

        public function setNivel(int $nivel){
            $this->nivel = $nivel;
        }

        // Funções
        public function inserir():bool {
            $sql = "insert into niveis (sigla, nivel)
                    values (:sigla, :nivel)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":sigla", $this->sigla);
            $cmd->bindValue(":nivel", $this->nivel);
            $cmd->execute();
            if ($cmd->execute()) {
                $this->id = $this->pdo->lastInsertId();
                return true;
            }
            return false;
        }

        public function listar(): array{
            $cmd = $this->pdo->query("select * from niveis order by id desc");
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscarPorId(int $id):array{
            $sql = "select * from niveis where id = :id";
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
                    sigla = :sigla, nivel = :nivel where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":sigla", $this->sigla);
            $cmd->bindValue(":nivel", $this->nivel);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

        public function excluir(int $idExcluir):bool{
            $this->id = $idExcluir;
            if(!$this->id) return false;

            $sql = "delete from niveis where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }
    }
?>