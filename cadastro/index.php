<?php
session_start();
require_once "../utils/config.php";
if (isset($_SESSION['logado'])) {
    echo "
            <script>
                history.back();
            </script>
        ";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilos/cadastro-usuario.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cadastro</title>
</head>

<body>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="../" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img src="../assets/Logoparalela.png" class="logo" alt="Logo" title="Logo Waap">
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="../" class="nav-link px-2 link-dark">Início</a></li>
            <li><a href="../adocao/" class="nav-link px-2 link-dark">Adote</a></li>
            <li><a href="../ong/ongs.php" class="nav-link px-2 link-dark">ONGs</a></li>
            <li><a href="../sobre-nos/" class="nav-link px-2 link-dark">Sobre Nós</a></li>
        </ul>
        <?php
        if (isset($privilegio)) {
            switch ($privilegio) {
                case 0:
                    echo '
                                <div class="col-md-3 menus-nav text-end">
                                    <a href="../painel/admin/" class=""><button type="button" class="btn btn-outline-primary me-2">Painel</button></a>
                                    <a href="../sair.php" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                                </div>
                            ';
                    break;
                case 1:
                    echo '                               
                                <div class="col-md-3 menus-nav text-end">
                                    <a href="../painel/ong/" title="Painel" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
                                    <a href="../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
                                    <a href="../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                                </div>                              
                            ';
                    break;
                default:
                    echo "                               
                                <div class='col-md-3 menus-nav text-end'>
                                    <a href='../gerenciamento-conta/dados.php' title='Configurações' class=''><button type='button' class='btn btn-outline-primary me-2'><ion-icon name='settings-outline'></ion-icon></button></a>
                                    <a href='../sair.php' title='Sair' class=''><button type='button' class='btn btn-primary'><ion-icon name='log-out-outline'></ion-icon></button></a>
                                </div>                              
                            ";
                    break;
            }
        } else {
            echo '
                        <div class="col-md-3 menus-nav text-end">
                        <a href="../login/" class=""><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
                        <a href="#" class=""><button type="button" class="btn btn-primary">Cadastre-se</button></a>
                        </div>
                    ';
        }
        ?>
        <div class="col-md-3 text-end">
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col">
                <div id=img_text>
                    <img class="mb-4" src="../assets/Logoparalela.png" alt="">
                    <h1 class="h3 mb-3 fw-normal">Cadastre-se</h1>
                </div>
                <div id="cadastro_form">
                    <form action="" method="post">
                        <div class="nomesob">
                            <div class="row g-3">
                                <div class="col">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-badge"></i></span>
                                        <input type="text" class="form-control" placeholder="Nome completo" aria-label="Username" aria-describedby="addon-wrapping" name="nome">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-open"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="name@example.com">
                        </div>
                        <hr>
                        <div id="senha">
                            <div class="row g-3">
                                <div class="col">
                                    <input type="password" name="pass" id="" class="form-control" placeholder="Senha">
                                </div>
                                <div class="col">
                                    <input type="password" name="cpass" id="" class="form-control" placeholder="Confirme sua senha">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="tele">
                            <div class="mb-3 input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-card-text"></i></span>
                                <input type="text" class="form-control" name="cpf" placeholder="CPF" id="cpf">
                                <script type="text/javascript">
                                    $("#cpf").mask("000.000.000-00", {
                                    reverse: true
                                    });
                                </script>
                            </div>
                        </div>
                        <hr>
                        <div id="datan">
                            <div class="mb-3 input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-calendar3"></i></span>
                                <input type="date" class="form-control" name="nasci">
                            </div>
                        </div>
                        <hr>
                        <h2>Sexo</h2>
                        <div id="genero">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gen" id="inlineRadio1" value="m">
                                <label class="form-check-label" for="inlineRadio1">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gen" id="inlineRadio2" value="f">
                                <label class="form-check-label" for="inlineRadio2">Feminino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gen" id="inlineRadio3" value="o">
                                <label class="form-check-label" for="inlineRadio3">Outro</label>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-primary" type="submit">Cadastrar</button>
                            <a href="../login/" class="btn btn-outline-primary" type="submit">Login</a>
                            <figcaption class="figure-caption text-end">Caso já possua um cadastro, Faça o Login..</figcaption>
                        </div>
                    </form>
                    <p class="mt-5 mb-3 text-muted">© 2021</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php

require_once "../utils/conexao.php";
if (isset($_POST['nome']) || isset($_POST['email']) || isset($_POST['cpf']) || isset($_POST['nasci']) || isset($_POST['pass']) || isset($_POST['cpass'])) {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $nasc = mysqli_real_escape_string($conexao, $_POST['nasci']);
    $senha = mysqli_real_escape_string($conexao, $_POST['pass']);
    $cpass = mysqli_real_escape_string($conexao, $_POST['cpass']);
    $ano = explode("-", $nasc);
    $sexo = mysqli_real_escape_string($conexao, $_POST['gen']);

    $privilegio = mysqli_real_escape_string($conexao, 2);
    if (strlen($nome) > 80 || empty($nome)) { // Nome Inválido
        echo "<script>
                    alert('Nome Inválido');
                    history.back();
                </script>";
    } else if (($ano[0] - date('Y')) > -18) { //Menor 18
        echo "<script>
                    alert('Menor de idade');
                    history.back();
                 </script>";
    } else if (strlen($email) > 80 || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) { // Email Inválido
        echo "<script>
                    alert('Email Inválido');
                    history.back();
                </script>";
    } else if (strlen($cpf) != 14) { // DDD Inválido
        echo "<script>
                    alert('CPF Inválido');
                </script>";
    } else if ($senha != $cpass) { // Senha Inválida
        echo "<script>
                    alert('Senha Inválida');
                </script>";
    } else if (empty($sexo)) {
        echo "<script>
                    alert('Sexo inválido');
                    history.back();
                </script>";
    } else {
        $verificacao = "SELECT id_usuario FROM usuario WHERE email='$email'";
        $executarver = mysqli_query($conexao, $verificacao);
        $linhas = mysqli_num_rows($executarver);
        if ($linhas != 0) {
            echo "<script>
                    alert('Você já está cadastrado!');
                </script>";
        } else {
            $senha = sha1($senha);
            $token = md5(date("Y-m-d h:i:sa"));
            //echo $token;exit;
            $sql = "INSERT INTO usuario(nome, email, senha, sexo, nascimento, cpf, privilegio, token) VALUES ('$nome','$email','$senha', '$sexo', '$nasc', '$cpf', '$privilegio', '$token')";
            $executar = mysqli_query($conexao, $sql);
            if ($executar == 1) { // Sucesso
                $dados = array(
                    'email' => $email,
                    'nome' => $nome,
                    'token' => $token
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://$host:$port/waap_oficial/web3/utils/testemailer.php");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $data = curl_exec($ch);
                curl_close($ch);

                echo "<script>
                        location.href ='validar/';
                    </script>";
                
            } else { // Falha
                echo "<script>
                        alert('Erro ao realizar o cadastro. Contate o suporte');
                    </script>";
            }
        }
    }
} else {
}
?>