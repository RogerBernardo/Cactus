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

    <?php
    $navegacao = new Navegacao();
    $navegacao->navbarIndex();
    ?>

    <main>
        <section id="section-1">
            <div class="row">
                <div class="col-md-6" id="bloco-banner">
                    <h1>Cactus - Seu bloco de notas</h1>
                    <p>Registre suas ideias onde quer que esteja, afinal, elas sempre estarão guardadas conosco!</p>

                    <a href="cadastro.php" class="btn calltoaction">Cadastre-se</a>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="src/img/logo/cactus-512.png" class="img-fluid" alt="Imagem de um cacto">
                </div>
            </div>
        </section>

        <section id="section-2">
            <div class="text-center">
                <h2>Como funciona?</h2>
            </div>

            <div class="row text-center">
                <div class="col-md-4 caixa">
                    <img class="img-fluid" alt="Imagem de um cadastro" src="src/img/register.png" />
                    <h4>Cadastre-se</h4>
                    <p>Crie sua conta gratuitamente. </p>
                </div>
                <div class="col-md-4 caixa">
                    <img class="img-fluid" alt="Imagem de login" src="src/img/user.png" />
                    <h4>Faça seu login</h4>
                    <p>Entre com sua senha ou token de segurança.</p>
                </div>
                <div class="col-md-4 caixa">
                    <img class="img-fluid" alt="Imagem de uma nota" src="src/img/note.png" />
                    <h4>Adicione conteúdo</h4>
                    <p>Digite notas, mude de cor e adicione grau de importância.</p>
                </div>
            </div>
        </section>

        <section id="section-3">
            <h2>Está pronto para registrar o que você está pensando?</h2>
            <a class="btn calltoaction" href="cadastro.php">Sim, estou pronto! </a>
        </section>

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