<?php
function mysqli()
{
    if (!isset($_SESSION))
        session_start();

    $servidor = "localhost";
    $banco = "cactus";
    $usuario = "root";
    $senha = "";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
    if (!$conexao)
        die("<div class=\"alert alert-danger\" role=\"alert\"> Erro de conexão </div>");
    else
        return $conexao;
}
