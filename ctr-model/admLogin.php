<?php 

require_once './admClass.php';
$objAdm = new Adm();

if(isset($_POST['log'])) {
    $login = $_POST['txtLogin'];
    $senha = $_POST['txtSenha'];

    if($login == "renan" && $senha == "123re"){
        $objAdm->redirect('../adm-agendamentos.php');
    }
}

?>