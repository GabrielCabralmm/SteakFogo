<?php 
    include_once 'db.php';

    class Reserva {
        // Atributos
        private $id;
        private $id_cliente;
        private $data_reserva;
        private $horario;
        private $qtd_pessoas;
        private $motivo;
        private $status;
        private $codigo;
        private $data_criacao;
        private $data_atualizacao;
        private $pdo;

        public function __construct(){
            $this->pdo = getConnection();
        }

        //Getters e Setters - Propriedades
        public function getId(){
            return $this->id;
        }

        public function getIdCliente(){
            return $this->id_cliente;
        }

        public function setIdCliente(int $id_cliente){
            $this->id_cliente = $id_cliente;
        }

        public function getDataReserva(){
            return $this->data_reserva;
        }

        public function setDataReserva(datetime $data_reserva){
            $this->data_reserva = $data_reserva;
        }

        public function getHorario(){
            return $this->horario;
        }

        public function setHorario(datetime $horario){
            $this->horario = $horario;
        }

        public function getQtdPessoas(){
            return $this->qtd_pessoas;
        }

        public function setQtdPessoas(int $qtd_pessoas){
            $this->qtd_pessoas = $qtd_pessoas;
        }

        public function getMotivo(){
            return $this->motivo;
        }

        public function setMotivo(string $motivo){
            $this->motivo = $motivo;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus(string $status){
            $this->status = $status;
        }

        public function getCodigo(){
            return $this->codigo;
        }

        public function setCodigo(string $codigo){
            $this->codigo = $codigo;
        }

        public function getDataCriacao(){
            return $this->data_criacao;
        }

        public function setDataCriacao(datetime $data_criacao){
            $this->data_criacao = $data_criacao;
        }

        public function getDataAtualizacao(){
            return $this->data_atualizacao;
        }

        public function setDataAtualizacao(datetime $data_atualizacao){
            $this->data_atualizacao = $data_atualizacao;
        }

        // Funções
        public function inserir():bool {

            $sql = "insert into reservas (id_cliente, data_reserva, horario, qtd_pessoas, motivo, status, codigo_reserva, data_criacao, data_atualizacao)
                    values (:id_cliente, :data_reserva, :horario, :qtd_pessoas, :motivo, default, :codigo_reserva, default, :data_atualizacao)";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id_cliente", $this->id_cliente);
            $cmd->bindValue(":data_reserva", $this->data_reserva);
            $cmd->bindValue(":horario", $this->horario);
            $cmd->bindValue(":qtd_pessoas", $this->qtd_pessoas);
            $cmd->bindValue(":motivo", $this->motivo);
            $cmd->bindValue(":codigo_reserva", $this->codigo);
            $cmd->bindValue(":data_atualizacao", $this->data_atualizacao);
            if ($cmd->execute()) {
                $this->id = $this->pdo->lastInsertId();
                return true;
            }
            return false;
        }

        public function listar(string $status): array{
            if ($status == "P") {
                $cmd = $this->pdo->query('select * from vw_reservas where status = "P" order by id desc');
            } elseif ($status == "N"){
                $cmd = $this->pdo->query('select * from vw_reservas_negadas order by id desc');
            } elseif ($status == "A"){
                $cmd = $this->pdo->query('select * from vw_mesa_reserva order by id desc');
            }

            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscarPorId(int $id):array{
            $sql = "select * from reservas where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $dados = $cmd->fetch();
            return $dados;
        }

        public function buscarPorCodigo(int $codigo):array{
            $sql = "select * from reservas where codigo_reserva = :codigo_reserva";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":codigo", $codigo);
            $cmd->execute();
            $dados = $cmd->fetch();
            return $dados;
        }

        public function aceitar(int $idUpdate):bool{
            $this->id = $idUpdate;
            if(!$this->id) return false;

            $sql = 'UPDATE produtos SET 
                status = "A",
                data_atualizacao = NOW()
                WHERE id = :id';
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":status", $this->status);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
            return $cmd->execute();
        }

        public function negar(int $idUpdate):bool{
            $this->id = $idUpdate;
            if(!$this->id) return false;

            $sql = 'UPDATE produtos SET 
                status = "N",
                data_atualizacao = NOW()
                WHERE id = :id';
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":status", $this->status);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
            return $cmd->execute();
        }
    }
?>