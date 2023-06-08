<?php 
    require_once('connection.php');

    class Agendamentos{
        private $connexao;

        public function __construct(){
            $dataBase = new dataBase();
            $this->connexao = $dataBase->dbConnection();                       
        }

        public function runQuery($sql){
            $stmt = $this->connexao->prepare($sql);
            return $stmt;
        }

        public function read(){
            try {
                $sql = "SELECT * FROM agendamentos";
                $stmt = $this->connexao->prepare($sql);
                $stmt->execute();

                return $stmt;
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        public function filter($dateChoosed)
        {
            try {
                $sql = "SELECT a.id, a.idCliente as 'idCliente', a.idServico as 'idServico', cli.nome as 'Cliente', serv.nome as 'Servico', date_format(a.agendamentoData, '%d/%m/%Y') as 'Data', a.horario as 'Horario'
                from agendamentos a 
                inner join clientes cli on a.idCliente = cli.id
                inner join servicos serv on a.idServico = serv.id 
                WHERE a.agendamentoData = :dateChoosed
                ORDER BY a.horario";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':dateChoosed', $dateChoosed); 
                $stmt->execute();

                return $stmt;
            } catch(PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        public function insert($idCliente, $idServico, $dataAgendamento, $horarioAgendamento){
            try{
                $sql = "INSERT INTO agendamentos (idCliente, idServico, agendamentoData, horario) values (:idCliente, :idServico, :agendamentoData, :horario)";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':idCliente', $idCliente);
                $stmt->bindParam(':idServico', $idServico);
                $stmt->bindParam(':agendamentoData', $dataAgendamento);
                $stmt->bindParam(':horario', $horarioAgendamento);

                $stmt->execute();

                return $stmt;
            }catch(PDOException $e){
                echo $e -> getMessage();
            }
        }

        public function deletar($id){
            try {
                $sql = "DELETE from agendamentos where id = :id";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function editar($idCliente, $idServico, $dataAgendamento, $horarioAgendamento, $id){
            try {
                $sql = "UPDATE agendamentos set idCliente = :idCliente, idServico = :idServico, dataAgendamento = :dataAgendamento, horarioAgendamento = :horarioAgendamento where id = :id";

                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':idCliente', $idCliente);
                $stmt->bindParam(':idServico', $idServico);
                $stmt->bindParam(':dataAgendamento', $dataAgendamento);
                $stmt->bindParam(':horarioAgendamento', $horarioAgendamento);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function redirect($url){
            header("Location: $url");
        }

        
    }
?>