<?php include_once('classes.php'); include_once('gerencia.php'); ?>

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
        <div class="store d-flex align-content-center flex-wrap justify-content-center">
            <div class="box">
                <p><img alt="Logo do Cactus" src="src/img/logo/cactus-128.png" class="img-fluid" /></p>
                <h1>Cadastre-se</h1>
                <form class="" action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <input type="text" class="form-input" id="nome_user" name="nome_user" placeholder="Nome Completo" require>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-input" id="email_user" name="email_user" placeholder="Email" require>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" id="senha_user" name="senha_user" placeholder="Senha" require>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" id="senha_confirm_user" name="senha_confirm_user" placeholder="Confirme sua senha" require>
                    </div>
                    <button class="btn" name="cadastrar">Cadastrar </button>

                    <p><a href="login.php">Já tem uma conta? Faça o login!</a></p>
                </form>

                <?php
                gerente();
                ?>
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