<?php
include_once('classes.php');
include_once('gerencia.php');
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
    <?php
    $navegacao = new Navegacao();
    $navegacao->navbarNotas($_SESSION['nome']);
    ?>

    <main>
        <div class="fundo-padrao d-flex align-content-center flex-wrap justify-content-center">
            <section class="configuracoes">
                <div class="text-center">
                    <img src="src/img/logo/cactus-128.png" />
                    <h1>Configurações</h1>
                </div>

                <section>
                    <h3>Informações: </h3>
                    <p>Esses são os seus dados que guardamos conosco! Baixe seu token, ele é o substituto da sua senha.
                        Com ele é possível entrar em sua conta e redefinir seus dados.
                    </p>
                    <?php $usuario = new Usuario;
                    $usuario->getProperties($_SESSION['email']); ?>
                </section>

                <section>
                    <button class="d-inline  m-1 btn verde-escuro" data-toggle="modal" data-target="#modalAlterarSenha"> Alterar Senha </button>
                    <button class="d-inline  m-1 btn rosa-claro" data-toggle="modal" data-target="#modalAlterarEmail"> Alterar Email </button>
                    <button class="d-inline  m-1 btn verde-claro" data-toggle="modal" data-target="#modalAlterarNome"> Alterar Nome </button>
                    <form action="" method="POST" class="d-inline m-1"><button class="btn rosa-escuro" name="downloadToken"> Baixar Token </button> <?php config(); ?></form>
                </section>

                <section id="modal-hidden">
                    <div class="modal" id="modalAlterarSenha">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Alteração de Senha</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" autocomplete="off">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="modal-senha-1" placeholder="Nova senha" require />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="modal-senha-2" placeholder="Confirme sua senha" require />
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success" name="alterarSenha">Salvar alterações</button>
                                            <button class="btn btn-danger" data-dismiss="modal" type="reset">Fechar</button>
                                            <?php config(); ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal" id="modalAlterarEmail">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Alteração de Email</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" autocomplete="off">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="modal-email-1" placeholder="Novo email" require />
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="modal-email-2" placeholder="Confirme seu email" require />
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success" name="alterarEmail">Salvar alterações</button>
                                            <button class="btn btn-danger" data-dismiss="modal" type="reset">Fechar</button>
                                            <?php config(); ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal" id="modalAlterarNome">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Alteração de Nome</h4>
                                </div>

                                <div class="modal-body">
                                    <form action="" method="POST" autocomplete="off">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="modal-nome-1" placeholder="Novo nome" require />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="modal-nome-2" placeholder="Confirme seu nome" require />
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-success" name="alterarNome">Salvar alterações</button>
                                            <button class="btn btn-danger" data-dismiss="modal" type="reset">Fechar</button>
                                            <?php config(); ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </main>

    <?php
    $navegacao = new Navegacao();
    $navegacao->footer();
    ?>

    <script src="src/jquery/jquery-3.4.1.min.js"></script>
    <script src="js/comportamento.js"></script>
    <script src="src/popper/popper.min.js"></script>
    <script src="src/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>