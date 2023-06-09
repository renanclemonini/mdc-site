<?php 
        
class dataBase{
    private $userName = "root";
    private $senha = "";
    public $connexao;
    
    public function dbConnection(){
        $this->connexao = null;
        try{
            $this->connexao = new PDO('mysql:host=localhost; dbname=mdcsite;',$this->userName, $this->senha);
            $this->connexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $this->connexao;
    }
}

?>