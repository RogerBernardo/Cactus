<?php

function gerente()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    $sessao = new Sessao();
    $notas = new Notas();
    $usuario = new Usuario();


    if (isset($_POST['logout'])) {
        $sessao->logout();
    }

    if (isset($_POST['criar_notas'])) {
        $notas->cadastro($_SESSION['email'], $_POST['titulo_notas'], $_POST['descricao_notas'], isset($_POST['urgente']) ? $_POST['urgente'] : 0, $_POST['cor']);
    }

    if (isset(($_POST['excluir_nota']))) {
        $notas->exclusao($_POST['idnotas'], $_SESSION['email']);
    }

    if (isset(($_POST['alterar_nota']))) {
        $notas->alteracao($_POST['idnotas'], $_SESSION['email'],  $_POST['titulo_notas'], $_POST['descricao_notas'], isset($_POST['urgente']) ? $_POST['urgente'] : 0, $_POST['cor']);
    }

    if (isset($_POST['cadastrar'])) {
        $usuario->setProperties($_POST['nome_user'], $_POST['email_user'], $_POST['senha_user'], $_POST['senha_confirm_user']);
        $usuario->cadastrar($_POST['email_user']);
    }

    if (isset($_POST['login'])) {
        $sessao->login($_POST['email_user'], $_POST['senha_user']);
    }

    if (isset($_POST['login_token'])) {
        $sessao->loginToken($_POST['email_user'], $_POST['token_user']);
    }
}

function config()
{
    if (!isset($_SESSION)) {
        session_start();
    }  

    $usuario = new Usuario();

    if (isset($_POST['downloadToken'])) {
        $usuario->downloadToken($_SESSION['email']);
    }

    if (isset($_POST['alterarNome'])) {
        $usuario->alterarNome($_SESSION['email'], $_POST['modal-nome-1'], $_POST['modal-nome-2']);
    }

    if (isset($_POST['alterarSenha'])) {
        $usuario->alterarSenha($_SESSION['email'], $_POST['modal-senha-1'], $_POST['modal-senha-2']);
    }

    if (isset($_POST['alterarEmail'])) {
        $usuario->alterarEmail($_SESSION['email'], $_POST['modal-email-1'], $_POST['modal-email-2']);
    }
}
