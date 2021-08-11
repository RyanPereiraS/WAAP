<?php
    session_start();
    if(isset($_SESSION['logado'])){
        if($_SESSION['logado']){
            header("Location: ../");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <p><input type="text" name="login" id="" placeholder="Login"></p>
        <p><input type="password" name="senha" id="" placeholder="Senha"></p>
        <p><input type="submit" value="Entrar" id=""></p>
    </form>
</body>
</html>
<?php 
    require_once "../../utils/conexao.php";
    require_once "../../utils/functions.php";
    if(isset($_POST['login'])){
        $login = mysqli_real_escape_string($conexao,$_POST['login']);
        $senha = mysqli_real_escape_string($conexao,$_POST['senha']);
        if(strlen($login) == 0){

        } else if(strlen($senha) == 0){

        } else {
            $senha = sha1($senha);
            if(str_contains($login, '@') && str_contains($login, '.com')){
                
                $sql = "SELECT id_administrador,status, administrador FROM gerenciador WHERE email='$login' AND senha='$senha'";
                $executar = mysqli_query($conexao, $sql);
                $resultado = mysqli_num_rows($executar);
                $fetch = mysqli_fetch_array($executar);
                if($resultado == 1 && $fetch[1] == "1"){
                    $_SESSION['logado'] = true;
                    $_SESSION['gerenciador'] = $fetch[0];
                    $_SESSION['administrador'] = $fetch[2];
                    $_SESSION['type'] = 1;
                    echo "<script> 
                        location.href='../ong/';
                    </script>";
                }else if($resultado==1 && $fetch[1] != "1"){
                    echo "Seu perfil se encontra com divergencias!, Código de divergência: $fetch[1]";
                } else {
                    echo "Perfil não encontrado!";
                }
            } else {

            }
        }
    }
?>