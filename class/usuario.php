<?php 
    include_once 'db.php';

    class Usuario {
        // Atributos
        private $id;
        private $login;
        private $email;
        private $id_nivel;
        private $senha;
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

        public function getEmail(){
            return $this->email;
        }

        public function setEmail(string $email){
            $this->email = $email;
        }

        public function getId_nivel(){
            return $this->id_nivel;
        }

        public function setId_nivel(int $id_nivel){
            $this->id_nivel = $id_nivel;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function setSenha(string $senha){
            $this->senha = $senha;
        }

        // Funções
        public function inserir():bool {
            $sql = "insert into usuarios (login, email, id_nivel, senha)
                    values (:login, :email, :id_nivel, md5(:senha))";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":login", $this->login);
            $cmd->bindValue(":email", $this->email);
            $cmd->bindValue(":senha", $this->senha);
            $cmd->bindValue(":id_nivel", $this->id_nivel);
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
                $this->email = $dados['email'];
                $this->id_nivel = $dados['id_id_nivel'];
                $this->senha = $dados['senha'];
                return true;
            }
            
            return false;
        }

        public function efetuarLogin(string $loginInformado, string $senhaInformada): array{
            $sql = "select * from usuarios WHERE login = :login AND senha = md5(:senha)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":login", $loginInformado);
            $cmd->bindValue(":senha", $senhaInformada);
            $cmd->execute();
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            return $dados;
        }


        public function atualizar(int $idUpdate):bool{
            $this->id = $idUpdate;
            if(!$this->id) return false;

            $sql = "update usuarios set
                    login = :login, id_nivel = :id_nivel where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":login", $this->login);
            $cmd->bindValue(":id_nivel", $this->id_nivel);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
            return $cmd->execute();
        }

        public function alterarSenha(int $idUpdate, string $novaSenha):bool{
            $this->id = $idUpdate;
            if(!$this->id) return false;

            $sql = "update usuarios set senha = md5(:senha) where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":senha", $novaSenha);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

        public function excluir(int $idExcluir):bool{
            $this->id = $idExcluir;
            if(!$this->id) return false;

            $sql = "delete from usuarios where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

    }
?>