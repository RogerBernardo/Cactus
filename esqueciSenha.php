<?php session_start(); ?>
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
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-navbar">
            <a class="navbar-brand" href="index.php">
                <img src="src/img/logo/cactus-32.png" class="d-inline-block align-top" alt="Imagem de um cacto">
                Cactus
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="cadastro.php">Cadastre-se</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <main>
        <div class="store d-flex align-content-center flex-wrap justify-content-center">
            <div class="box">
                <p><img alt="Logo do Cactus" src="src/img/logo/cactus-128.png" class="img-fluid" /></p>
                <h1>Esqueci minha senha</h1>
                <p>Entre com seu email e token</p>
                <form class="" action="" method="POST">
                    <div class="form-group">
                        <input type="email" class="form-input" id="email_user" name="email_user" placeholder="Email" require>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" id="token_user" name="token_user" placeholder="Token" require>
                    </div>
                    <input type="submit" class="btn" value="Entrar" name="login" />
                    <p><a href="login.php">Faça o Login</a> / <a href="cadastro.php">Cadastre-se</a></p>
                </form>
                <?php
                include("controle.php");
                if (isset($_POST['login'])) {
                    $sessao = new Sessao();
                    $sessao->loginToken($_POST['email_user'], $_POST['token_user']);
                }
                ?>
            </div>
        </div>
    </main>

    <footer>
        <a href="https://www.linkedin.com/in/rbmelolima/"><img src="src/img/linkedin.png" alt="Linkedin" /></a>
        <a href="mailto:rogerbernardo007@gmail.com"><img src="src/img/gmail.png" alt="Gmail" /></a>
        <a href="https://github.com/RogerBernardo"><img src="src/img/github.png" alt="Github" /></a>
        <p><?php echo ('Cactus©' . date("Y")) ?><p>
    </footer>

    <script src="src/jquery/jquery-3.4.1.min.js"></script>
    <script src="src/popper/popper.min.js"></script>
    <script src="src/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>