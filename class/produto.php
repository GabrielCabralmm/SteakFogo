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
            $this->valor = $valor;
        }

        public function getImagem(){
            return $this->imagem;
        }

        public function setImagem(string $imagem){
            $this->imagem = $imagem;
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
            $cmd->bindValue(":descricao", $this->descricao);
            $cmd->bindValue(":resumo", $this->resumo);
            $cmd->bindValue(":valor", $this->valor);
            $cmd->bindValue(":imagem", $this->imagem);
            $cmd->bindValue(":destaque", $this->destaque);
            if ($cmd->execute()) {
                $this->id = $this->pdo->lastInsertId();
                return true;
            }
            return false;
        }

        public function listar(int $destaque): array{
            if ($destaque == 0) {
                $cmd = $this->pdo->query("select * from vw_produtos order by id desc");
            } elseif ($destaque == 1){
                $cmd = $this->pdo->query("select * from vw_produtos where destaque = 1 order by id desc");
            }
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscarPorId(int $id):array{
            $sql = "select * from vw_produtos where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $dados = $cmd->fetch();
            return $dados;
        }

        public function buscarPorTipo(int $tipoId):array{
            $sql = "select * from vw_produtos where tipo_id = :tipo_id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":tipo_id", $tipoId);
            $cmd->execute();
            $dados = $cmd->fetchAll();
            return $dados;
        }

        public function buscarPorString(string $busca):array{
            $sql = "select * from vw_produtos
            where descricao like '%$busca%' or resumo like '%$busca%'
            order by descricao asc";
            $cmd = $this->pdo->prepare($sql);
            $cmd->execute();
            $dados = $cmd->fetchAll();
            return $dados;
        }

        public function atualizar(int $idUpdate):bool{
            $this->id = $idUpdate;
            if(!$this->id) return false;
    
            $sql = "UPDATE produtos SET 
                tipo_id = :tipo_id,
                descricao = :descricao, 
                resumo = :resumo,
                valor = :valor,
                imagem = :imagem,
                destaque = ".($this->destaque==true?1:0)."
                WHERE id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":tipo_id", $this->tipoId); // (C#) cmd.Paramenters.AddWithValue("splogin", Login);
            $cmd->bindValue(":descricao", $this->descricao);
            $cmd->bindValue(":resumo", $this->resumo);
            $cmd->bindValue(":valor", $this->valor);
            $cmd->bindValue(":imagem", $this->imagem);
            //$cmd->bindValue(":destaque",$this->destaque==true?1:0);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
            return $cmd->execute();
        }

        public function excluir(int $idExcluir):bool{
            $this->id = $idExcluir;
            if (!$this->id) return false;

            $sql = "delete from produtos where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);

            return $cmd->execute();
        }

    }
?>