<?php 

require_once 'connection.php';

class Cliente
{
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
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function insert($nome, $telefone, $aniversario)
    {
        try {
            $sql = "INSERT INTO clientes (nome, telefone, aniversario) VALUES (:nome, :telefone, :aniversario)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":aniversario", $aniversario);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function read()
    {
        try {
            $sql = "SELECT id, nome, telefone, date_format(aniversario, '%d/%m/%Y') as 'aniversario' FROM clientes";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function update($nome, $telefone, $aniversario, $id)  
    {
        try {
            $sql = "UPDATE clientes SET nome = :nome, telefone = :telefone, aniversario = :aniversario WHERE id = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":aniversario", $aniversario);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function delete($id)
    {
        try
        {
            $sql = "DELETE FROM clientes WHERE id = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function redirect($url)
    {  
        header("Location: $url");
    }

}
?>