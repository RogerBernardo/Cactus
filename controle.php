<?php
function conectar()
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

function segurança()
{
    if (!isset($_SESSION))
        session_start();

    if (!isset($_SESSION['email']) && !isset($_SESSION['senha'])) {
        logout();
        header("Location: index.php");
    }
}

function logout()
{
    if (!isset($_SESSION))
        session_start();

    session_destroy();
    header("Location: index.php");
    exit;
}

function cadastrar_notas()
{
    $conexao = conectar();

    $inserir = true;

    if ($conexao) {
        $email = $_SESSION['email'];
        $titulo = $_POST['titulo_notas'];
        $descricao = $_POST['descricao_notas'];
        $urgencia = isset($_POST['urgente']) ? $_POST['urgente'] : 0;
        $cor = $_POST['cor'];
        $sql = "INSERT into notas (titulo, descricao, urgencia, cor, email) VALUES ('$titulo', '$descricao', '$urgencia', '$cor', '$email');";
        if (mysqli_query($conexao, $sql)) {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cactus.php'>";
        } else {
            //Exibir alguma mensagem de erro
        }
    }
}

function buscar_notas_importantes()
{
    $conexao = conectar();
    if ($conexao) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM notas WHERE email = '$email' AND urgencia = 1";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $id = $row['idnotas'];
                $titulo = $row['titulo'];
                $descricao = $row['descricao'];
                $cor = $row['cor'];
                $importante = $row['urgencia'];

                switch ($cor) {
                    case 'padrao':
                        $options = <<< FECHAROPTIONS
                        <option value="padrao" selected>Padrão</option>
                        <option value="azul">Azul</option>
                        <option value="verde">Verde</option>
                        <option value="rosa">Rosa</option>
                        <option value="amarelo">Amarelo</option>
                        FECHAROPTIONS;
                        break;
                    case 'azul':
                        $options = <<< FECHAROPTIONS
                        <option value="padrao">Padrão</option>
                        <option value="azul" selected>Azul</option>
                        <option value="verde">Verde</option>
                        <option value="rosa">Rosa</option>
                        <option value="amarelo">Amarelo</option>
                        FECHAROPTIONS;
                        break;
                    case 'verde':
                        $options = <<< FECHAROPTIONS
                        <option value="padrao">Padrão</option>
                        <option value="azul">Azul</option>
                        <option value="verde" selected>Verde</option>
                        <option value="rosa">Rosa</option>
                        <option value="amarelo">Amarelo</option>
                        FECHAROPTIONS;
                        break;
                    case 'rosa':
                        $options = <<< FECHAROPTIONS
                        <option value="padrao">Padrão</option>
                        <option value="azul">Azul</option>
                        <option value="verde">Verde</option>
                        <option value="rosa" selected>Rosa</option>
                        <option value="amarelo">Amarelo</option>
                        FECHAROPTIONS;
                        break;
                    case 'amarelo':
                        $options = <<< FECHAROPTIONS
                        <option value="padrao">Padrão</option>
                        <option value="azul">Azul</option>
                        <option value="verde">Verde</option>
                        <option value="rosa">Rosa</option>
                        <option value="amarelo" selected>Amarelo</option>
                        FECHAROPTIONS;
                        break;
                }
                $cards = <<<FECHARCARDS
                    <form method="post" autocomplete="off">
                    <div class="card $cor">
                    <div class="card-body">
                    <input type="hidden" value="$id" name="idnotas">
                    <h5 class="card-title"><input type="text" value="$titulo" name="titulo_notas"></h5>
                    <textarea cols="40" rows="10" placeholder="Insira suas ideias aqui"
                    name="descricao_notas">$descricao</textarea>
                    <div class="form-group">
                    <div class="row">
                    <div class="col-auto">
                    <label for="urgente">Importante:</label>
                    </div>
                    <div class="col-auto">
                    <input type="checkbox" class="form-check-input" name="urgente" value="1" checked>
                    </div>
                    </div>
                    </div>
                    <div class="form-inline">                   
                    <label for="cor">Cor: </label>                  
                    <select name="cor" class="form-control" id="select-cores" onchange="mudarCorForm()">
                    $options
                    </select>
                    </div>                
                    <button class="btn btn-alert" name="alterar_nota">Alterar</button>
                    <button class="btn btn-danger" name="excluir_nota">Excluir</button>
                    </div>
                    </div>
                    </form>
                FECHARCARDS;
                echo $cards;
            }
        }
    }
}

function buscar_notas_outras()
{
    $conexao = conectar();
    if ($conexao) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM notas WHERE email = '$email' AND urgencia = 0";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $id = $row['idnotas'];
                $titulo = $row['titulo'];
                $descricao = $row['descricao'];
                $cor = $row['cor'];
                $importante = $row['urgencia'];
                switch ($cor) {
                    case 'padrao':
                        $options = <<< FECHAROPTIONS
                        <option value="padrao" selected>Padrão</option>
                        <option value="azul">Azul</option>
                        <option value="verde">Verde</option>
                        <option value="rosa">Rosa</option>
                        <option value="amarelo">Amarelo</option>
                        FECHAROPTIONS;
                        break;
                    case 'azul':
                        $options = <<< FECHAROPTIONS
                        <option value="padrao">Padrão</option>
                        <option value="azul" selected>Azul</option>
                        <option value="verde">Verde</option>
                        <option value="rosa">Rosa</option>
                        <option value="amarelo">Amarelo</option>
                        FECHAROPTIONS;
                        break;
                    case 'verde':
                        $options = <<< FECHAROPTIONS
                        <option value="padrao">Padrão</option>
                        <option value="azul">Azul</option>
                        <option value="verde" selected>Verde</option>
                        <option value="rosa">Rosa</option>
                        <option value="amarelo">Amarelo</option>
                        FECHAROPTIONS;
                        break;
                    case 'rosa':
                        $options = <<< FECHAROPTIONS
                        <option value="padrao">Padrão</option>
                        <option value="azul">Azul</option>
                        <option value="verde">Verde</option>
                        <option value="rosa" selected>Rosa</option>
                        <option value="amarelo">Amarelo</option>
                        FECHAROPTIONS;
                        break;
                    case 'amarelo':
                        $options = <<< FECHAROPTIONS
                        <option value="padrao">Padrão</option>
                        <option value="azul">Azul</option>
                        <option value="verde">Verde</option>
                        <option value="rosa">Rosa</option>
                        <option value="amarelo" selected>Amarelo</option>
                        FECHAROPTIONS;
                        break;
                }


                $cards = <<<FECHARCARDS
                <form method="post" autocomplete="off">
                <div class="card $cor">
                <div class="card-body">
                <input type="hidden" value="$id" name="idnotas">
                <h5 class="card-title"><input type="text" value="$titulo" name="titulo_notas"></h5>
                <textarea cols="40" rows="10" placeholder="Insira suas ideias aqui"
                name="descricao_notas">$descricao</textarea>
                <div class="form-group">
                <div class="row">
                <div class="col-auto">
                <label for="urgente">Importante:</label>
                </div>
                <div class="col-auto">
                <input type="checkbox" class="form-check-input" name="urgente" value="1" checked>
                </div>
                </div>
                </div>
                <div class="form-inline">                   
                <label for="cor">Cor: </label>                  
                <select name="cor" class="form-control" id="select-cores" onchange="mudarCorForm()">
                $options
                </select>
                </div>                
                <button class="btn btn-alert" name="alterar_nota">Alterar</button>
                <button class="btn btn-danger" name="excluir_nota">Excluir</button>
                </div>
                </div>
                </form>
                FECHARCARDS;
                echo $cards;
            }
        }
    }
}

function excluir_notas()
{
    $conexao = conectar();
    $idnotas = $_POST['idnotas'];
    $email = $_SESSION['email'];

    if ($conexao) {
        $sql = "DELETE FROM notas WHERE email = '$email' AND idnotas = '$idnotas';";
        if (mysqli_query($conexao, $sql)) {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cactus.php'>";
        } else {
            //Exibir alguma mensagem de erro
        }
    }
}

function alterar_notas()
{
    $idnotas = $_POST['idnotas'];
    $email = $_SESSION['email'];
    $titulo = $_POST['titulo_notas'];
    $descricao = $_POST['descricao_notas'];
    $urgencia = $_POST['urgencia'];
    $cor = $_POST['cor'];
    $conexao = conectar();

    if ($conexao) {
        $sql = "UPDATE notas SET titulo = '$titulo', descricao = '$descricao', urgencia = '$urgencia', cor = '$cor' WHERE idnotas = '$idnotas' and email = '$email';";
        if (mysqli_query($conexao, $sql)) {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cactus.php'>";
        } else {
            //Exibir alguma mensagem de erro
        }
    }
}

function cadastrar_usuario()
{
    $nome = $_POST['nome_user'];
    $email = $_POST['email_user'];
    $senha1 = $_POST['senha_user'];
    $senha2 = $_POST['senha_confirm_user'];
    $conexao = conectar();

    if (empty($nome) || empty($email) || empty($senha1)) {
        echo "<div class=\"alert alert-warning\" role=\"alert\"> Os campos não podem estar vazios! </div>";
    } else if ($senha1 !== $senha2) {
        echo "<div class=\"alert alert-warning\" role=\"alert\"> As senhas devem ser iguais! </div>";
    } else {
        //Criptografando a senha
        $senha1 = md5($senha2);
        $sql = "SELECT * FROM usuario WHERE email = '$email';";
        $result = mysqli_query($conexao, $sql);
        $linhasafetadas = mysqli_num_rows($result);

        if ($linhasafetadas > 0) {
            echo "<div class=\"alert alert-warning\" role=\"alert\"> Email já cadastrado! </div>";
        } else {

            $sql = "insert into usuario (nome, email, senha) values ('$nome', '$email', '$senha1');";
            if (mysqli_query($conexao, $sql))
                echo "<div class=\"alert alert-success\" role=\"alert\"> Cadastrado com sucesso! </div>";
            else
                echo "<div class=\"alert alert-danger\" role=\"alert\"> Não foi possível cadastrá-lo! </div>";
        }
    }
}

function login()
{
    $email = $_POST['email_user'];
    $senha = MD5($_POST['senha_user']);
    $conexao = conectar();

    if (!empty($email) && !empty($senha)) {
        $sql = "SELECT * from usuario WHERE email = '$email' AND senha = '$senha';";
        $result = mysqli_query($conexao, $sql);
        $linhasafetadas = mysqli_num_rows($result);
        if ($linhasafetadas > 0) {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header("Location: cactus.php");
        } else {
            session_destroy();
            header("Location: index.php");
        }
    }
}

function executar_funcoes()
{
    if (isset($_POST['logout'])) {
        logout();
    }

    if (isset($_POST['criar_notas'])) {
        cadastrar_notas();
    }

    if (isset(($_POST['excluir_nota']))) {
        excluir_notas();
    }

    if (isset(($_POST['alterar_nota']))) {
        alterar_notas();
    }
}
