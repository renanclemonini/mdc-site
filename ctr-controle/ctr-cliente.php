<?php 

require_once '../ctr-model/clienteDAO.php';
$objCliente = new Cliente();

if(isset($_POST['insert'])) {
    $nome = $_POST['txtNome'];
    $telefone = $_POST['txtTelefone'];
    $aniversario = $_POST['txtAniversario'];
    if($objCliente->insert($nome, $telefone, $aniversario)) {
        $objCliente->redirect('../cadastro-cliente.php');
    }
}

if(isset($_POST['insert-adm'])) {
    $nome = $_POST['txtNome'];
    $telefone = $_POST['txtTelefone'];
    $aniversario = $_POST['txtAniversario'];
    if($objCliente->insert($nome, $telefone, $aniversario)) {
        $objCliente->redirect('../adm-clientes.php');
    }
}

if(isset($_POST['editar'])) {
    $nome = $_POST['txtNome'];
    $telefone = $_POST['txtTelefone'];
    $aniversario = $_POST['txtAniversario'];
    $id = $_POST['txtId'];
    if($objCliente->update($nome, $telefone, $aniversario, $id)) {
        $objCliente->redirect('../adm-clientes.php');
    }
}

if(isset($_POST['delete'])) {
    $id = $_POST['txtId'];
    if($objCliente->delete($id)) {
        $objCliente->redirect('../adm-clientes.php');
    }
}



?>