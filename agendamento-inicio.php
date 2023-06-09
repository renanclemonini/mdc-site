<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/mobile-first.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/adm.css">
    <?php include './bs4.php' ?>
    <script src="./js/index.js"></script>
    <title>Marília Di Credico - Agendamentos</title>
    <style>
        .btnAlign{
            display: flex;
            justify-content: space-between;
        }

        .btnDesign{
            color: #fff;
            background-color: #000;
        }
    </style>
</head>
<body onresize="mudouTamanho()">
    <header id="container">
        
    </header>
    <span id="menuBurguer" class="material-symbols-outlined" onclick="clickMenu()">
        menu
    </span>
    <menu id="itensMenu">
        <ul>
            <li><a href="index.php" target="_self">Home</a></li>
            <li><a href="adm.php" target="_self">Administração</a></li>
            <li><a href="https://www.instagram.com/mariliadicredico.bioestetica/" target="_blank">Instagram</a></li>
            <li><a href="micropig.php">Micropigmentação</a></li>
            <li><a href="produtos.php">Produtos</a></li>
        </ul>
    </menu>
    <main id="mainAdm">
        <article class="p-4">
            <h2>Agendamento</h2>
            <p>Nesta área você pode agendar o melhor dia para vir ao nosso estabelecimento, por favor realize o cadastro clicando em 'Novo Cliente' primeiro antes de agendar. Caso já esteja cadastrado é só seguir para a opção 'Novo Agendamento'</p>
            <div class="btnAlign">
                <a href="./cadastro-cliente.php" class="btn btnDesign">Novo Cliente</a>
                <a href="./agendamento-novo.php" class="btn btnDesign">Novo Agendamento</a>
            </div>
        </article>
    </main>
    <footer>
        <p>Site Desenvolvido por Renan Clemonini &reg;</p>
    </footer>
</body>
</html>