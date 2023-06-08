<?php
    require_once('./ctr-model/servicosDAO.php');
    $objServicos = new Servicos();

    require_once('./ctr-model/clienteDAO.php');
    $objClientes = new Cliente();
    
    require_once('./ctr-model/agendamentosDAO.php');
    $objAgendamentos = new Agendamentos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Clientes</title>
</head>
<body>
    <header><?php include'./nav.php' ?></header>

    <div class="container">
        <h2 class="my-3">Agendamentos</h2>
        <p>Lista de Agendamentos Realizados.</p>
        <div id="filtrar">
            <form action="adm-agendamentos.php" method="post">
                <label for="iDateChooser">Filtro Atual: </label>
                <input type="hidden" name="filter">
                <input class="mx-2" type="date" name="txtDateChooser" id="iDateChooser" autofocus required>
                <input type="submit" value="Filtrar" class="mx-2 mb-3">
            </form>
        </div>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Serviço</th>
                    <th class="text-center">Data</th>
                    <th class="text-center">Horário</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Deletar</th>
                </tr>
            </thead>
            <tbody>
            <p>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Novo Agendamento
                </button>
            </p>
                <?php
                    date_default_timezone_set('America/Bahia');
                    $dia = date('d');
                    $mes = date('m');
                    $ano = date('Y');
                    $dateAgenda = $_POST['txtDateChooser'] ?? "$ano-$mes-$dia";
                    function dataEngToBr($dateAgenda)
                    {
                        if (!empty($dateAgenda)) {
                            $dateAgenda = explode("-", $dateAgenda);
                            return $dateAgenda[2].'/'.$dateAgenda[1].'/'.$dateAgenda[0];
                        }
                    }
                    $dataFormatada = dataEngToBr($dateAgenda);
                    echo "<p>Exibindo agendamentos do dia $dataFormatada</p>";
                    $stmt = $objAgendamentos->filter($dateAgenda);
                    while ($objAgendamentos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <tr>
                            <td>
                                <?php echo $objAgendamentos['Cliente']; ?>
                            </td>
                            <td>
                                <?php echo $objAgendamentos['Servico']; ?>
                            </td>
                            <td>
                                <?php echo $objAgendamentos['Data']; ?>
                            </td>
                            <td>
                                <?php echo $objAgendamentos['Horario']; ?>
                            </td>
                            <td>
                                <button type="button" class="btn"
                                data-toggle="modal" 
                                data-target="#myModalEditar" 
                                data-id="<?php #echo $objAgendamentos['id']; ?>"
                                data-idCliente="<?php echo $objAgendamentos['idCliente']; ?>"
                                data-cliente="<?php echo $objAgendamentos['Cliente']; ?>"
                                data-idServico="<?php echo $objAgendamentos['idServico']; ?>"
                                data-servico="<?php echo $objAgendamentos['Servico']; ?>"
                                data-agendamento="<?php echo $objAgendamentos['Data']; ?>"
                                data-horario="<?php echo $objAgendamentos['Horario']; ?>">
                                <img src="./imagens/database_edit.png" alt="editar"></button> 
                            </td>
                            <td>
                                <button type="button" class="btn" 
                                data-toggle="modal" 
                                data-target="#myModalDelete" 
                                data-id="<?php echo $objAgendamentos['id']; ?>"
                                data-nome="<?php echo $objAgendamentos['Cliente']; ?>"> <img src="./imagens/database_delete.png" alt="delete"> </button> 
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        

    <!-- Modal Cadastro -->
    <div class="modal" id="myModal">
            
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-dark" style="color: #fff;">
                    <h4 class="modal-title">Novo Agendamento</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="./ctr-controle/ctr-agendamentos.php" method="post">
                        <input type="hidden" name="insert">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <br>
                            <select name="txtCliente" id="nome">
                                <?php
                                    $sql = "SELECT * FROM clientes ORDER BY nome";
                                    $stmt = $objClientes->runQuery($sql);
                                    $stmt->execute();
                                    while($objClientes = $stmt->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?php echo $objClientes['id'] ?>"><?php echo $objClientes['nome'] ?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="servico">Serviço:</label>
                            <br>
                            <select name="txtServico" id="servico">
                                <?php
                                    $sql = "SELECT * FROM servicos ORDER BY id";
                                    $stmt = $objServicos->runQuery($sql);
                                    $stmt->execute();
                                    while($objServicos = $stmt->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?php echo $objServicos['id'] ?>"><?php echo $objServicos['nome'] ?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dataAgendamento">Data:</label>
                            <input type="date" class="form-control" id="dataAgendamento" name="txtData">
                        </div>
                        <div class="form-group">
                            <label for="horarioAgendamento">Horário:</label>
                            <input type="time" class="form-control" id="horarioAgendamento" name="txtHorario">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal" id="myModalEditar">
            
        <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header bg-dark" style="color: #fff;">
                        <h4 class="modal-title">Editar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="./ctr-controle/ctr-agendamentos.php" method="post">
                            <input type="hidden" name="editar">
                            <input type="hidden" name="txtId" id="recipient-id">
                            <div class="form-group">
                                <label for="recipient-cliente">Cliente:</label>
                                <input type="text" name="txtIdCliente" id="recipient-idCliente">
                                <input type="text" class="form-control" placeholder="Digite seu nome" id="recipient-cliente" name="txtCliente">
                            </div>
                            <div class="form-group">
                                <label for="recipient-servico">Serviço:</label>
                                <input type="text" name="idServico" id="recipient-idServico">
                                <input type="text" class="form-control" placeholder="Digite serviço" id="recipient-servico" name="txtServico">
                            </div>
                            <div class="form-group">
                                <label for="recipient-dataAgendamento">Data:</label>
                                <input type="date" class="form-control" id="recipient-dataAgendamento" name="txtData">
                            </div>
                            <div class="form-group">
                                <label for="recipient-horarioAgendamento">Horario:</label>
                                <input type="time" class="form-control" id="recipient-horarioAgendamento" name="horarioAgendamento">
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
        
    <!-- Modal Delete -->
    <div class="modal" id="myModalDelete">
        
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-dark" style="color: #fff;">
                    <h4 class="modal-title">Deletar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="./ctr-controle/ctr-agendamentos.php" method="post">
                        <input type="hidden" name="delete">
                        <input type="hidden" name="txtId" id="recipient-id" readonly>
                        <div class="form-group">
                            <label for="nome">Tem certeza que deseja deletar este agendamento?</label>
                            <input type="hidden" name="nome" id="recipient-nome">
                        </div>
                        <button type="submit" class="btn btn-primary">Deletar</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
    <!-- JQuery Delete -->
    <script>
        $('#myModalDelete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');

            var modal = $(this);
            modal.find('#recipient-id').val(recipientId);
        });
    </script>

    <!-- JQuery Editar -->
    <script>
        $('#myModalEditar').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');
            var recipientIdCliente = button.data('idCliente');
            var recipientCliente = button.data('cliente');
            var recipientIdServico = button.data('idServico');
            var recipientServico = button.data('servico');
            var recipientDataAgendamento = button.data('agendamento');
            var recipientHorarioAgendamento = button.data('horario');
            

            var modal = $(this);
            modal.find('#recipient-idCliente').val(recipientIdCliente);
            modal.find('#recipient-cliente').val(recipientCliente);
            modal.find('#recipient-idServico').val(recipientIdServico);
            modal.find('#recipient-servico').val(recipientServico);
            modal.find('#recipient-dataAgendamento').val(recipientDataAgendamento);
            modal.find('#recipient-horarioAgendamento').val(recipientHorarioAgendamento);
            modal.find('#recipient-id').val(recipientId);
        });
    </script>
    <script>  
        function formatar(mascara, documento) {
            let i = documento.value.length;
            let saida = '#';
            let texto = mascara.substring(i);
            while (texto.substring(0, 1) != saida && texto.length ) {
            documento.value += texto.substring(0, 1);
            i++;
            texto = mascara.substring(i);
            }
        }
    </script>
</body>

</html>