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
    <title>Marília Di Credico - Administração</title>
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
        <article>
            <h2>Agendamento</h2>
            <p>Seja bem vindo, clica na melhor opção em que se enquadre</p>
            <button class="btn btn-primary">Já sou cadastrado</button>
        </article>
    </main>
    <footer>
        <p>Site Desenvolvido por Renan Clemonini &reg;</p>
    </footer>
</body>
</html>