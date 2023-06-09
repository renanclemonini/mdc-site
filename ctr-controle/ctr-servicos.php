<?php 

    require_once '../ctr-model/servicosDAO.php';
    $objServicos = new Servicos();

    if(isset($_POST['insert'])) {
        $nome = $_POST['txtNome'];
        if($objServicos->insert($nome)) {
            $objServicos->redirect('../adm-servicos.php');
        }
    }

    if(isset($_POST['editar'])) {
        $nome = $_POST['txtNome'];
        $id = $_POST['txtId'];
        if($objServicos->update($nome, $id)) {
            $objServicos->redirect("../adm-servicos.php");
        }
    }
    
    if(isset($_POST['delete'])) {
        $id = $_POST['txtId'];
        if($objServicos->delete($id)) {
            $objServicos->redirect("../adm-servicos.php");
        }
    }
?>