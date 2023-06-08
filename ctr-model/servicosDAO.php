<?php 

require_once 'connection.php';

class Servicos{
    private $conexao;

    public function __construct()
    {   
        $dataBase = new dataBase();
        $this->conexao = $dataBase->dbConnection();
    }

    public function runQuery($sql)
    {
        try {
            $stmt = $this->conexao->prepare($sql);

            return $stmt;
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function insert($nome)
    {
        try {
            $sql = "INSERT INTO servicos (nome) VALUES (:nome)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->execute();

            return $stmt;
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function read()
    {
        try {
            $sql = "SELECT * FROM servicos";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function update($nome, $id)
    {
        try {
            $sql = "UPDATE servicos SET nome = :nome WHERE id = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt;
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM servicos WHERE id = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt;
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function redirect($url)
    {  
        header("Location: $url");
    }
}

?>