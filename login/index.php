<?php
session_start();
if (isset($_SESSION['logado'])) {
    echo "
        <script>
            history.back();
        </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel='stylesheet' type='text/css' href="estilos/login-usuario.css">
    <base href="../">
    <title>Login - WAAP</title>
</head>

<body>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="./" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img src="./assets/Logoparalela.png" class="logo" alt="Logo" title="Logo Waap">
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="./" class="nav-link px-2 link-dark">Início</a></li>
            <li><a href="./adocao/" class="nav-link px-2 link-dark">Adote</a></li>
            <li><a href="./ong/ongs.php" class="nav-link px-2 link-dark">ONGs</a></li>
            <li><a href="./sobre-nos/" class="nav-link px-2 link-dark">Sobre Nós</a></li>
        </ul>
        <?php
        if (isset($privilegio)) {
            switch ($privilegio) {
                case 0:
                    echo '
                        <div class="col-md-3 menus-nav text-end">
                            <a href="./painel/admin/" class=""><button type="button" class="btn btn-outline-primary me-2">Painel</button></a>
                            <a href="./sair.php" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                        </div>
                    ';
                    break;
                case 1:
                    echo '
                        <div class="col-md-3 menus-nav text-end">
                            <a href="./painel/ong/" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
                            <a href="./gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
                            <a href="./sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                        </div>
                    ';
                    break;
                default:
                    echo '
                        <div class="col-md-3 menus-nav text-end">
                            <a href="./gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
                            <a href="./sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                        </div>
                    ';
                    break;
            }
            }else{
                echo '
                    <div class="col-md-3 menus-nav text-end">
                        <a href="./login/" class=""><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
                        <a href="./cadastro/" class=""><button type="button" class="btn btn-primary">Cadastre-se</button></a>
                    </div>
                ';
            }
        ?>

    </header>

    <div class='formlogin'>
        <form method='POST'>
            <img class="mb-4" src="./assets/Logoparalela.png" alt="">
            <h1 class="h3 mb-3 fw-normal">Insira os dados</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name='email' placeholder="name@example.com">
                <label for="floatingInput">Endereço Email</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name='pass' placeholder="Password">
                <label for="floatingPassword">Senha</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Lembre-se de Mim
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary botaosubmit" name='' type="submit">Entrar</button>
            <p class="mt-5 mb-3 text-muted">© 2021</p>
        </form>
    </div>

</body>

</html>
<?php
require_once "../utils/conexao.php";
if (isset($_POST['email']) || isset($_POST[`pass`])) {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $pass = mysqli_real_escape_string($conexao, $_POST['pass']);
    if (empty($email) || empty($pass)) {
        echo
        "
                <script>
                    alert('Preencha todos os campos!')
                 </script>
            ";
    } else {
        $senha = sha1($pass);
        $sql = "SELECT id_usuario, nome, privilegio,token FROM usuario u WHERE u.email = '$email' AND u.senha = '$senha'";
        $executar = mysqli_query($conexao, $sql);
        $fetch = mysqli_fetch_array($executar);
        $row = mysqli_num_rows($executar);
        if ($executar) {
            if ($row == 1) {
                if($fetch['token'] == ''){
                    $_SESSION['usuario'] = $fetch['nome'];
                    $_SESSION['id_usuario'] = $fetch['id_usuario'];
                    $_SESSION['privilegio'] = $fetch['privilegio'];
                    $_SESSION['logado'] = true;
                    echo "
                            <script> 
                                location.href='./';
                            </script>
                        ";
                } else {
                    echo "
                            <script> 
                                location.href='cadastro/validar/';
                            </script>
                        ";
                }
            } else {
                $_SESSION['logado'] = false;
                echo "Login não efetuado!";
            }
        } else {
            echo "Erro no banco de dados";
            echo $sql;
        }
    }
} else {
}
?>