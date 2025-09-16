<?php 
    include_once 'db.php';

    class Produto {
        // Atributos
        private $id;
        private $tipoId;
        private $descricao;
        private $resumo;
        private $valor;
        private $imagem;
        private $destaque;
        private $pdo;

        public function __construct(){
            $this->pdo = getConnection();
        }

        //Getters e Setters - Propriedades
        public function getId(){
            return $this->id;
        }

        public function getTipoId(){
            return $this->tipoId;
        }

        public function setTipoId(int $tipoId){
            $this->tipoId = $tipoId;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setDescricao(string $descricao){
            $this->descricao = $descricao;
        }

        public function getResumo(){
            return $this->resumo;
        }

        public function setResumo(string $resumo){
            $this->resumo = $resumo;
        }

        public function getValor(){
            return $this->valor;
        }

        public function setValor(float $valor){
            $this->resumo = $valor;
        }

        public function getImagem(){
            return $this->imagem;
        }

        public function setImagem(string $imagem){
            $this->resumo = $imagem;
        }

        public function getDestaque(){
            return $this->destaque;
        }

        public function setDestaque(bool $destaque){
            $this->destaque = $destaque;
        }

        // Funções
        public function inserir():bool {
            $sql = "insert into produtos (tipo_id, descricao, resumo, valor, imagem, destaque)
                    values (:tipo_id, :descricao, :resumo, :valor, :imagem, :destaque)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":tipo_id", $this->tipoId);
            $cmd->bindValue(":descicao", $this->descricao);
            $cmd->bindValue(":resumo", $this->resumo);
            $cmd->bindValue(":valor", $this->valor);
            $cmd->bindValue(":imagem", $this->imagem);
            $cmd->bindValue(":destaque", $this->destaque);
            $cmd->execute();
            if ($cmd->execute()) {
                $this->id = $this->pdo->lastInsertId();
                return true;
            }
            return false;
        }

        public function listar(): array{
            $cmd = $this->pdo->query("select * from vw_produtos order by id desc");
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscarPorId(int $id): bool{
            $sql = "select * from produtos where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->bindValue(":tipo_id", $this->tipoId);
            $cmd->bindValue(":descicao", $this->descricao);
            $cmd->bindValue(":resumo", $this->resumo);
            $cmd->bindValue(":valor", $this->valor);
            $cmd->bindValue(":imagem", $this->imagem);
            $cmd->bindValue(":destaque", $this->destaque);
            $cmd->execute();
            if ($cmd->rowCount() > 0) {
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                $this->id = $dados['id'];
                $this->tipoId = $dados['tipo_id'];
                $this->descricao = $dados['descricao'];
                $this->resumo = $dados['resumo'];
                $this->valor = $dados['valor'];
                $this->imagem = $dados['imagem'];
                $this->destaque = $dados['destaque'];
                return true;
            }
            
            return false;
        }

        public function atualizar(int $idUpdate):bool{
            $id = $idUpdate;

            if (!$this->id) return false;

            $sql = "update produtos set
                    tipo_id = :tipo_id, descricao = :descricao, resumo = :resumo,
                    valor = :valor, imagem = :imagem, destaque = :destaque
                    where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":tipo_id", $this->tipoId);
            $cmd->bindValue(":descicao", $this->descricao);
            $cmd->bindValue(":resumo", $this->resumo);
            $cmd->bindValue(":valor", $this->valor);
            $cmd->bindValue(":imagem", $this->imagem);
            $cmd->bindValue(":destaque", $this->destaque);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

        public function excluir(int $idExcluir):bool{
            $id = $idExcluir;
            
            if (!$this->id) return false;

            $sql = "delete from produtos where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

    }
?>