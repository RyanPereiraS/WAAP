<?php
session_start();
require_once '../utils/conexao.php';
require_once '../utils/config.php';
if (!isset($_SESSION['logado'])) {
    echo "<script>
            alert('Você não está Logado!');
            location.href = '../index.php';
        </script>";
} else {
    $sql = mysqli_fetch_array(mysqli_query($conexao, "SELECT privilegio FROM usuario WHERE id_usuario = $_SESSION[id_usuario]"));
    $privilegio = $sql['0'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilos/novoalterar_dados.css">
    <link rel="stylesheet" href="estilos/footer.css">
    <base href="../">
    <title>Dados Do Usuario</title>
</head>

<body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <div class="clearfix">
        <div id="void">
        </div>

        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="./" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="assets/Logoparalela.png" class="logo" alt="Logo" title="Logo Waap" id="logo_bar">
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="./" class="nav-link px-2 link-dark">Início</a></li>
                <li><a href="adocao/" class="nav-link px-2 link-dark">Adote</a></li>
                <li><a href="ong/ongs.php" class="nav-link px-2 link-dark">ONGs</a></li>
                <li><a href="sobre-nos/" class="nav-link px-2 link-dark">Sobre Nós</a></li>
            </ul>
            <?php
            if (isset($privilegio)) {
                switch ($privilegio) {
                    case 0:
                        echo '
								<div class="col-md-3 menus-nav text-end">
									<a href="painel/admin" class=""><button type="button" class="btn btn-outline-primary me-2">Painel</button></a>
									<a href="sair.php" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>
							';
                        break;
                    case 1:
                        echo '
								<div class="col-md-3 menus-nav text-end">
								<a href="./painel/ong/" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
								<a href="sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>
							';
                        break;
                    default:
                        echo '
								<div class="col-md-3 menus-nav text-end">
								<a href="./sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>
							';
                        break;
                }
            } else {
                echo '
					<div class="col-md-3 menus-nav text-end">
					<a href="../login/" class=""><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
					<a href="../cadastro/" class=""><button type="button" class="btn btn-primary">Cadastre-se</button></a>
					</div>
					';
            }
            ?>
        </header>

        <?php
        $sql = "SELECT nome,nascimento,sexo FROM usuario WHERE id_usuario='$_SESSION[id_usuario]'";
        $executar = mysqli_query($conexao, $sql);
        $array = mysqli_fetch_array($executar);

        ?>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="alterar_dados">

                        <form action="" method="post">
                            <div class="jumbotron" id="camp_alterar">
                                <h1 class="display-4">Alterar Dados</h1>
                                <p class="lead">
                                    Caso tenha nos informado algum dado errado, fique a vontade para o corrigi-lo!
                                </p>
                                <hr>
                                <?php
                                if ($privilegio == 1) {
                                    echo "
                                    <p class='lead'>
                                
                                    Você possui uma ONG cadastrada, utilize o painel de administradores para alterar as informações.
                                    </p>
                                    <p><a href='painel/ong/' class='btn btn-outline-primary me-2'>Minha ONG</a></p>
                                    ";
                                } else {
                                    echo "
                                    <p class='lead'>
                                
                                    Possui uma ONG, e Deseja cadastrar ela no nosso Site, Fique a Vontade.
                                    </p>
                                    <p><a href='cadastro/ong/' class='btn btn-outline-primary me-2'>Cadastrar ONG</a></p>
                                    ";
                                }
                                ?>
                                <br><br>

                            </div>

                            <div id="campnome">
                                <h2>Nome</h2>
                                <div class="row g-3">
                                    <div class="col">
                                        <input type="text" name="nome" id="alterard" class="form-control" placeholder="Nome" <?php echo "value='$array[0]'" ?> id="">
                                    </div>
                                </div>
                            </div>
                            <div id="sexo">
                                <h2>Sexo</h2>
                                <?php
                                switch ($array[2]) {
                                    case "m":
                                        echo '
                                        <input type="radio" id="Masculino" checked name="sexo" value="m" id="">
                                        <label for="Masculino" >Masculino</label>
                                        <input type="radio" id="Feminino" name="sexo" value="f" id="">
                                        <label for="Feminino">Feminino</label>
                                        <input type="radio" id="Outro" name="sexo" value="o" id="">
                                        <label for="Outro">Outro</label>';

                                        break;
                                    case "f":
                                        echo '
                                        <input type="radio" id="Masculino" name="sexo" value="m" id="">
                                        <label for="Masculino" >Masculino</label>
                                        <input type="radio" id="Feminino" Checked name="sexo" value="f" id="">
                                        <label for="Feminino">Feminino</label>
                                        <input type="radio" id="Outro" name="sexo" value="o" id="">
                                        <label for="Outro">Outro</label>';
                                        break;
                                    default:
                                        echo '
                                        <input type="radio" id="Masculino"  name="sexo" value="m" id="">
                                        <label for="Masculino" >Masculino</label>
                                        <input type="radio" id="Feminino" name="sexo" value="f" id="">
                                        <label for="Feminino">Feminino</label>
                                        <input type="radio" id="Outro" checked name="sexo" value="o" id="">
                                        <label for="Outro">Outro</label>';
                                        break;
                                }
                                ?>
                            </div>
                            <div class="col">
                                <div id="campnasc">
                                    <h2 class="namescamp">Data de Nascimento</h2>
                                    <input type="date" name="nascimento" id="alterard" class="form-control" <?php echo "value='$array[1]'" ?> id="">
                                </div>
                            </div>
                    </div>

                    <div class="d-grid gap-2">
                        <input type="submit" id="botao" name="alterardados" class="btn btn-outline-primary me-2" value="Alterar dados">
                    </div>
                    </form>
                    <br>
                    <form action="" method="post">
                        <h2 class="namescamp">Alterar Senha</h2>
                        <div class="row g-3">
                            <div class="col">
                                <input type="password" id="alterars" name="pass" class="form-control" placeholder="Senha Atual">
                            </div>
                            <div class="col">
                                <input type="password" id="alterars" name="npass" class="form-control" placeholder="Nova Senha">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col">
                                <input type="password" id="csenha" name="cnpass" class="form-control" placeholder="Confirme a Senha">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <input type="submit" id="botaotwo" name="alterarsenha" class="btn btn-outline-primary me-2" value="Alterar Senha">
                        </div>
                        <hr>
                    </form>
                    <div class="d-grid gap-2">
                        <button class="btn btn-dark" id="" data-bs-toggle="modal" data-bs-target="#encerrar">Encerrar conta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="container">
        <footer class="py-5">
            <div class="row">
                <div class="col-22">
                    <h5>Wanna Adopt a Pet</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="./" class="nav-link p-0 text-muted">Início</a></li>
                        <li class="nav-item mb-2"><a href="./adocao/" class="nav-link p-0 text-muted">Adote</a></li>
                        <li class="nav-item mb-2"><a href="./ong/ongs.php" class="nav-link p-0 text-muted">ONGs</a></li>
                        <li class="nav-item mb-2"><a href="./sobre-nos/" class="nav-link p-0 text-muted">Sobre</a></li>
                    </ul>
                </div>

                <div class="col-2">
                    <h5>Contatos</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2 p-0 text-muted">
                            <ion-icon name="mail-unread-outline"></ion-icon> contato@waap.com
                        </li>
                        <li class="nav-item mb-2 p-0 text-muted">
                            <ion-icon name="bug-outline"></ion-icon> bounty@waap.com
                        </li>
                        <li class="nav-item mb-2 p-0 text-muted">
                            <ion-icon name="call-outline"></ion-icon> (11) 5555-5555
                        </li>
                        <li class="nav-item mb-2 p-0 text-muted">
                            <ion-icon name="logo-whatsapp"></ion-icon> (11) 99999-9999
                        </li>
                    </ul>
                </div>

                <div class="col-4 offset-1">
                    <form>
                        <h5>Inscreva-se no nosso newsletter</h5>
                        <p>Receba noticias sobre nosso site e sobre o mundo pet.</p>
                        <div class="d-flex w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Endereço de E-mail</label>
                            <input id="newsletter1" type="text" class="form-control" placeholder="Endereço de E-mail">
                            <button class="btn btn-primary" type="button">
                                <ion-icon class="iconfooter" name="send-outline"></ion-icon>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex justify-content-between py-4 my-4 border-top">
                <p>© 2021 Wanna Adopt a Pet, Todos direitos reservados.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#">
                            <ion-icon class="iconfooter" name="logo-instagram"></ion-icon>
                        </a></li>
                    <li class="ms-3"><a class="link-dark" href="#">
                            <ion-icon class="iconfooter" name="logo-facebook"></ion-icon>
                        </a></li>
                    <li class="ms-3"><a class="link-dark" href="#">
                            <ion-icon class="iconfooter" name="logo-twitter"></ion-icon>
                        </a></li>
                </ul>
            </div>
        </footer>
    </div>

    <!--Modal-->
    <!--Modal-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <div class="modal fade" id="encerrar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atenção!</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>x</span></button>
                </div>
                <div class="modal-body">
                    <p>Deseja encerrar a conta no WAAP?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <button class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-danger" type="submit" name="encerrar">Encerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php
if (isset($_POST['alterardados'])) {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $nascimento = mysqli_real_escape_string($conexao, $_POST['nascimento']);
    $ano = explode("-", $nascimento);
    if (strlen($nome) > 80 || strlen($nome) == 0) {
        echo 'N';
    } else if ($sexo != "m" && $sexo != "f" && $sexo != "o") {
        echo 'S';
    } else if (($ano[0] - date('Y')) > -18) { //Menor 18
        echo "<script>
            alert('Menor de idade');
            </script>";
    } else {
        $sql = "UPDATE `usuario` SET `nome` = '$nome', `sexo` = '$sexo', `nascimento` = '$nascimento' WHERE `usuario`.`id_usuario` = '$_SESSION[id_usuario]'";
        //echo $sql;exit;
        $executar = mysqli_query($conexao, $sql);
        if ($executar) {
            echo "<script>alert('Sucesso!');
                    location.href='./';
                </script>";
        } else {
            echo "<script>alert('Falha \n $sql');</script>";
        }
    }
} else if (isset($_POST['alterarsenha'])) {
    $pass = mysqli_real_escape_string($conexao, $_POST['pass']);
    $npass = mysqli_real_escape_string($conexao, $_POST['npass']);
    $cnpass = mysqli_real_escape_string($conexao, $_POST['cnpass']);
    if (strlen($pass) == 0) {
    } else if (strlen($npass) == 0 || strlen($cnpass) == 0) {
    } else if ($npass != $cnpass) {
    } else {
        $senha = sha1($pass);
        $sql = "SELECT id_usuario FROM usuario WHERE id_usuario='$_SESSION[id_usuario]' AND senha='$senha'";
        $executar = mysqli_query($conexao, $sql);
        if ($executar) {
            
            $row = mysqli_num_rows($executar);
            if ($row == 1) {
                $senhanova = sha1($npass);
                $sql = "UPDATE `usuario` SET `senha` = '$senhanova' WHERE `usuario`.`id_usuario` = '$_SESSION[id_usuario]'";
                $executar = mysqli_query($conexao, $sql);
                if ($executar) {
                    echo "<script> 
                            alert('Senha Alterada com Sucesso!');
                        </script>";
                } else {
                    echo "<script> 
                            alert('Houve um problema no meio do caminho!');
                        </script>";
                        echo $sql;
                }
            }
        }
    }
} else if (isset($_POST['encerrar'])) {
    if ($privilegio != 2) {
        echo "<script> 
                            alert('Para deletar sua conta encerre sua ONG antes disso!');
                            location.href=location.this();
                        </script>";
    }
    $sql2 = "SELECT email FROM usuario WHERE id_usuario = $_SESSION[id_usuario]";
    $exe2 = mysqli_fetch_array(mysqli_query($conexao, $sql2));
    $dados = array(
        'email' => $exe2['email']
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://$host:$port/waap_oficial/web/utils/encerrarconta.php");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    $sql = "DELETE FROM `usuario` WHERE `usuario`.`id_usuario` = $_SESSION[id_usuario]";

    $exe = mysqli_query($conexao, $sql);
    session_destroy();
    if ($exe) {
        echo "<script> 
            alert('Sua conta foi apagada de nosso banco de dados!');
            location.href='./';
        </script>";
    }
}
?>