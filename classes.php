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

function gerente()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    $sessao = new Sessao();
    $notas = new Notas();

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
        $usuario = new Usuario();
        $usuario->setProperties($_POST['nome_user'], $_POST['email_user'], $_POST['senha_user'], $_POST['senha_confirm_user']);
        $usuario->cadastrar($_POST['email_user']);
    }

    if (isset($_POST['login'])) {
        $sessao->login($_POST['email_user'], $_POST['senha_user']);
    }

    if (isset($_POST['login_token'])) {
        $sessao = new Sessao();
        $sessao->loginToken($_POST['email_user'], $_POST['token_user']);
    }

    if (isset($_POST['downloadToken'])) {
        $usuario = new Usuario();
        $usuario->downloadToken($_SESSION['email']);
    }
}

class Criptografar
{
    public function criptografia($senha)
    {
        return sha1($senha);
    }

    public function token($email, $nome)
    {
        return sha1(md5($email . $nome));
    }
}

class Sessao extends Criptografar
{
    public function login($email, $senha)
    {
        $mysqli = mysqli();
        $sql = "SELECT * from usuario WHERE email = ? AND senha = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $email, $this->criptografia($senha));
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $_SESSION['nome'] = $row['nome'];
            }
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header("Location: cactus.php");
        } else {
            session_destroy();
            echo "<div class=\"alert alert-warning\" role=\"alert\">Não foi possível realizar o login!</div>";
        }

        $mysqli->close();
        $stmt->close();
    }

    public function loginToken($email, $token)
    {
        $mysqli = mysqli();
        $sql = "SELECT * from usuario WHERE email = ? AND token = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $email, $token);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $_SESSION['nome'] = $row['nome'];
            }
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $token;
            header("Location: cactus.php");
        } else {
            session_destroy();
            echo "<div class=\"alert alert-warning\" role=\"alert\">Não foi possível realizar o login com o seu Token!</div>";
        }
        $mysqli->close();
        $stmt->close();
    }

    public function logout()
    {
        if (!isset($_SESSION))
            session_start();

        session_destroy();
        header("Location: index.php");
        exit;
    }

    public function seguranca()
    {
        if (!isset($_SESSION))
            session_start();

        if (!isset($_SESSION['email']) && !isset($_SESSION['senha']) && !isset($_SESSION['nome'])) {
            session_destroy();
            header("Location: erro.html");
        }
    }
}

class Usuario extends Criptografar
{
    private $nome, $email, $senha, $token, $permissao;

    public function setProperties($nome, $email, $senha1, $senha2)
    {
        if (($senha1 === $senha2) && !empty($nome) && !empty($email) && !empty($senha1) && !empty($senha2)) {
            $this->nome = $nome;
            $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $this->senha = $this->criptografia($senha1);
            $this->token = $this->token($email, $nome);
            $this->permissao = true;
        } else {
            echo "<div class=\"alert alert-warning\" role=\"alert\"> As senhas devem ser iguais e nenhum campo deve estar em branco! </div>";
            $this->permissao = false;
        }
    }

    public function cadastrar()
    {
        if ($this->permissao) {
            $mysqli = mysqli();
            $sql = "SELECT * FROM usuario WHERE email = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('s', $this->email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<div class=\"alert alert-warning\" role=\"alert\"> Email já cadastrado! </div>";
            } else if ($result->num_rows == 0) {
                $newmysqli = mysqli();
                $sql = "INSERT INTO usuario (nome, email, senha, token) VALUES (?,?,?,?)";
                $stmt = $newmysqli->prepare($sql);
                $stmt->bind_param('ssss', $this->nome, $this->email, $this->senha, $this->token);
                $stmt->execute();


                if ($stmt->affected_rows > 0)
                    echo "<div class=\"alert alert-success\" role=\"alert\"> Cadastrado com sucesso! </div>";
                else if ($stmt->affected_rows == 0)
                    echo "<div class=\"alert alert-danger\" role=\"alert\"> Cadastro não executado! </div>";
                else
                    echo "<div class=\"alert alert-danger\" role=\"alert\"> Erro Inesperado! </div>";
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\"> Erro Inesperado! </div>";
            }
        }
    }

    public function alterarSenha()
    {
    }

    public function alterarNome()
    {
    }
    public function downloadToken($email)
    {
        /* 
        arquivo = Objeto para manipular o arquivo
        arquivoLocal = Caminho absoluto do arquivo
        nome_arquivo = Nome do arquivo.txt
        */
        $mysqli = mysqli();
        $sql = "SELECT token from usuario WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc())
                $token = $row['token'];

            $nome_arquivo = $email . "-Token.txt";
            $arquivo = fopen($nome_arquivo, 'w');
            if ($arquivo == false) die("<div class=\"alert alert-warning\" role=\"alert\">Não foi possível criar o arquivo!</div>");

            //Escrevendo no arquivo
            fwrite($arquivo, $token);
            //Fechando o arquivo
            fclose($arquivo);

            set_time_limit(0);
            $arquivoLocal = "C:/xampp/htdocs/Cactus/" . $nome_arquivo;
            echo ($arquivoLocal);
            // Verifica se o arquivo não existe
            if (!file_exists($arquivoLocal)) die("<div class=\"alert alert-warning\" role=\"alert\">Não foi possível localizar o arquivo!</div>");

            // Configuramos os headers que serão enviados para o browser
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename="' . $nome_arquivo . '"');
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($nome_arquivo));
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Expires: 0');
            // Envia o arquivo para o cliente
            readfile($nome_arquivo);
            //Apagando arquivo do servidor
            unlink($arquivoLocal);
        } else {
            echo "<div class=\"alert alert-warning\" role=\"alert\">Não foi possível realizar o download!</div>";
        }

        $mysqli->close();
        $stmt->close();
    }

    public function getToken($email)
    {
        $mysqli = mysqli();
        $sql = "SELECT token from usuario WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $token = $row['token'];
                return $token;
            }
        } else {
            return "Não foi possível buscar o token!";
        }

        $mysqli->close();
        $stmt->close();
    }
}

class Notas
{
    public function cadastro($email, $titulo, $descricao, $importancia, $cor)
    {
        $mysqli = mysqli();
        $sql = "INSERT INTO notas (titulo, descricao, importancia, cor, email) VALUES (?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssiss', $titulo, $descricao, $importancia, $cor, $email);
        $stmt->execute();

        if ($stmt->num_rows > 0) {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cactus.php'>";
        } else {
            //Exibir alguma mensagem de erro
        }

        $mysqli->close();
        $stmt->close();
    }

    public function busca($email, $importancia)
    {
        $mysqli = mysqli();
        $sql = "SELECT * FROM notas WHERE email = ? AND importancia = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $email, $importancia);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $id = $row['idnotas'];
                $titulo = $row['titulo'];
                $descricao = $row['descricao'];
                $cor = $row['cor'];
                $importante = $row['importancia'];

                if ($importante == 1) {
                    $checkbox = <<< FECHARCHECKBOX
                    <input type="checkbox" class="form-check-input" name="urgente" value="1" checked>
                    FECHARCHECKBOX;
                } else {
                    $checkbox = <<< FECHARCHECKBOX
                    <input type="checkbox" class="form-check-input" name="urgente" value="1">
                    FECHARCHECKBOX;
                }

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
                <form method="post" action="" autocomplete="off" onClick="formFocus($id)">
                <div class="card $cor">
                <div class="card-body">
                <input type="hidden" value="$id" name="idnotas">
                <h5 class="card-title"><input type="text" value="$titulo" name="titulo_notas"></h5>
                <textarea cols="40" rows="10" placeholder="Insira suas ideias aqui"
                name="descricao_notas">$descricao</textarea>
                <div class="controles" id="$id">
                <div class="form-group">
                <div class="row">
                <div class="col-auto">
                <label for="urgente">Importante:</label>
                </div>
                <div class="col-auto">
                $checkbox
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
                </div>
                </form>
                FECHARCARDS;

                echo $cards;
            }
        }
    }

    public function exclusao($idnotas, $email)
    {
        $mysqli = mysqli();
        $sql = "DELETE FROM notas WHERE email = ? AND idnotas = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $email, $idnotas);
        $stmt->execute();

        if ($stmt->num_rows > 0) {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0; URL=cactus.php'>";
        } else {
            //Exibir alguma mensagem de erro
        }

        $mysqli->close();
        $stmt->close();
    }

    public function alteracao($idnotas, $email,  $titulo, $descricao,  $importancia, $cor)
    {
        $mysqli = mysqli();
        $sql = "UPDATE notas SET titulo = ?, descricao = ?, importancia = ?, cor = ? WHERE idnotas = ? and email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssisis', $titulo, $descricao, $importancia, $cor, $idnotas, $email);
        $stmt->execute();

        if ($stmt->num_rows > 0) {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cactus.php'>";
        } else {
            //Exibir alguma mensagem de erro
        }

        $mysqli->close();
        $stmt->close();
    }
}
