<?php 
    include_once 'db.php';

    class Usuario {
        // Atributos
        private $id;
        private $login;
        private $senha;
        private $nivel;
        private $pdo;

        public function __construct(){
            $this->pdo = getConnection();
        }

        //Getters e Setters - Propriedades
        public function getId(){
            return $this->id;
        }

        public function getLogin(){
            return $this->login;
        }

        public function setLogin(string $login){
            $this->login = $login;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function setSenha(string $senha){
            $this->senha = $senha;
        }

        public function getNivel(){
            return $this->nivel;
        }

        public function setNivel(string $nivel){
            $this->nivel = $nivel;
        }

        // Funções
        public function inserir():bool {
            $sql = "insert into usuarios (login, senha, nivel)
                    values (:login, md5(:senha), :nivel)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":login", $this->login);
            $cmd->bindValue(":senha", $this->senha);
            $cmd->bindValue(":nivel", $this->nivel);
            $cmd->execute();
            if ($cmd->execute()) {
                $this->id = $this->pdo->lastInsertId();
                return true;
            }
            return false;
        }

        public function listar(): array{
            $cmd = $this->pdo->query("select * from usuarios order by id desc");
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscarPorId(int $id): bool{
            $sql = "select * from usuarios where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            if ($cmd->rowCount() > 0) {
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                $this->id = $dados['id'];
                $this->login = $dados['login'];
                $this->senha = $dados['senha'];
                $this->nivel = $dados['nivel'];
                return true;
            }
            
            return false;
        }

        public function efetuarLogin(string $loginInformado, string $senhaInformada): bool{
            $sql = "select * from usuarios WHERE login = :login AND senha = md5(:senha)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":login", $loginInformado);
            $cmd->bindValue(":senha", $senhaInformada);
            $cmd->execute();
            if($cmd->rowCount()> 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                $this->id = $dados['id'];
                $this->login = $dados['login'];
                $this->senha = $dados['senha'];
                $this->nivel = $dados['nivel'];
                return true;
            }
            return false;
        }


        public function atualizar(int $idUpdate):bool{
            $id = $idUpdate;

            if (!$this->id) return false;

            $sql = "update usuarios set
                    login = :login, nivel = :nivel where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":login", $this->login);
            $cmd->bindValue(":nivel", $this->nivel);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

        public function alterarSenha(int $idUpdate, string $novaSenha):bool{
            $id = $idUpdate;

            if (!$this->id) return false;

            $sql = "update usuarios set senha = md5(:senha) where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":senha", $novaSenha);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

        public function excluir(int $idExcluir):bool{
            $id = $idExcluir;
            
            if (!$this->id) return false;

            $sql = "delete from usuarios where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

    }
?>