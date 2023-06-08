<?php 

require_once 'connection.php';

class Adm
{
    private $login;
    private $senha;

    // public function __construct($login, $senha)
    // {
    //     $this->login = $login;
    //     $this->senha = $senha;
    // }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    
    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function redirect($url){
        header("Location: $url");
    }
    
}

?>