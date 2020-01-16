<?php
include_once('classes.php');
$sessao = new Sessao();
$sessao->seguranca();
gerente();
?>

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
                        <a class="nav-link" href="#"><?php echo ("Bem vindo, " . $_SESSION['nome'] . "!") ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Configurações</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST"><button class="nav-link" name="logout">Sair</button></form>
                    </li>
                    <li class="nav-item">
                        <form method="POST"><button class="nav-link" name="downloadToken">Baixar Token</button></form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="bg-main">
        <section id="criar-notas">
            <form method="POST" action="" class="form-notas" id="form-notas" autocomplete="off">
                <div><input type="text" name="titulo_notas" placeholder="Título" id="titulo_notas" class="" /></div>
                <div><textarea cols="40" rows="10" placeholder="Insira suas ideias aqui" name="descricao_notas"></textarea></div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-auto">
                            <label for="urgente">Importante:</label>
                        </div>
                        <div class="col-auto">
                            <input type="checkbox" class="form-check-input" name="urgente" value="1">
                        </div>
                    </div>
                </div>
                <div class="form-inline">
                    <label for="cor">Cor: </label>
                    <select name="cor" class="form-control" id="select-cores" onchange="mudarCorForm()">
                        <option value="padrao">Padrão</option>
                        <option value="azul">Azul</option>
                        <option value="verde">Verde</option>
                        <option value="rosa">Rosa</option>
                        <option value="amarelo">Amarelo</option>
                    </select>
                </div>
                <button type="reset" class="btn">Limpar</button>
                <button class="btn btn-info" name="criar_notas">Ok</button>
            </form>
        </section>

        <section id="notas-importantes">
            <h6 class="title">Importante</h6>
            <div class="card-group">
                <?php
                $notasImportantes = new Notas();
                $notasImportantes->busca($_SESSION['email'], 1);
                ?>
            </div>
        </section>


        <section id="notas-restantes">
            <h6 class="title">Outras</h6>
            <div class="card-group">
                <?php
                $notas = new Notas();
                $notas->busca($_SESSION['email'], 0);
                ?>
            </div>
        </section>
    </main>

    <footer>
        <a href="https://www.linkedin.com/in/rbmelolima/"><img src="src/img/linkedin.png" alt="Linkedin" /></a>
        <a href="mailto:rogerbernardo007@gmail.com"><img src="src/img/gmail.png" alt="Gmail" /></a>
        <a href="https://github.com/RogerBernardo"><img src="src/img/github.png" alt="Github" /></a>
        <p><?php echo ('Cactus©' . date("Y")) ?><p>
    </footer>

    <script src="js/comportamento.js"></script>
    <script src="src/jquery/jquery-3.4.1.min.js"></script>
    <script src="src/popper/popper.min.js"></script>
    <script src="src/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>