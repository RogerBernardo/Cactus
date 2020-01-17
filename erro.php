<?php include_once('classes.php'); include_once('gerencia.php');?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Roger Bernardo de Melo Lima">

    <!--FOLHA DE ESTILO-->
    <link rel="stylesheet" href="css/estilo.css" />

    <!--Bootstrap 4 -->
    <link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css" />

    <title>Cactus - Seu bloco de notas</title>

</head>

<body>
    <main class="fundo-padrao">
        <div class="store d-flex align-content-center flex-wrap justify-content-center">
            <div class="box">
                <div class="text-center">
                    <img src="src/img/logo/cactus-128.png" class="img-fluid" alt="Imagem de um cacto" />
                </div>
                <br>
                <h1>Você tentou acessar uma página protegida...</h1>
                <p><a href="index.php">Volte para página inicial</a href="index.php"></p>
            </div>
        </div>
    </main>

    <?php
    $navegacao = new Navegacao();
    $navegacao->footer();
    ?>

    <script src="src/jquery/jquery-3.4.1.min.js"></script>
    <script src="src/popper/popper.min.js"></script>
    <script src="src/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>