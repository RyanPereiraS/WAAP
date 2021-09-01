<?php 
    session_start();
    if(isset($_SESSION['logado']) && isset($_SESSION['ong'])){
    } else {

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
        <p><input type="text" name="CEP" id="" placeholder="CEP"></p>
        <p><input type="text" name="numero" id="" placeholder="Número"></p>
        <p><input type="text" name="complemento" id="" placeholder="Complemento"></p>
        <p><input type="text" name="email" id="" placeholder="E-Mail"></p>
        <p><input type="password" name="senha" id="" placeholder="Senha"></p>
        <p><input type="password" name="csenha" id="" placeholder="Confirmar Senha"></p>
        <p><input type="submit" name="cadastrarunidade" id="" value="Cadastrar"></p>
    </form>
</body>
</html>
<?php 
    require_once "../../utils/conexao.php";
    require_once "../../utils/functions.php";

    $sql = "SELECT id FROM ong WHERE id_administrador = '$_SESSION[gerenciador]'";
    $executar = mysqli_query($conexao, $sql);
    $fetch = mysqli_fetch_array($executar);
    if(isset($_POST['cadastrarunidade'])){
        $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
        $cep = mysqli_real_escape_string($conexao, $_POST['CEP']);
        $numero = mysqli_real_escape_string($conexao, $_POST['numero']);
        $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $csenha = mysqli_real_escape_string($conexao, $_POST['csenha']);
        if(strlen($cep)!= 9){
            echo "Aqui";
        }else if(strlen($numero)> 4){
            echo "Aqui1";
        }else if(strlen($complemento)> 15){
            echo "Aqui2";
        }else if(strlen($email)> 80){
            echo "Aqui3";
        } else if(strlen($senha) == 0 OR $senha != $csenha){
            echo "Aqui4";
        }else {
            $pass = sha1($senha);
            $login = md5(date("Y-m-d H:i:s"));
            $sql = "INSERT INTO endereco(cep, numero,complemento,email,login,senha,id_ong) VALUES ('$cep', '$numero','$complemento','$email','$login','$senha','$fetch[0]')";
            $executar = mysqli_query($conexao, $sql);
            if($executar){
                echo "<script> 
                    alert('Unidade cadastrada com sucesso!');
                </script>";
            } else {
                echo $sql;
            }
        }
    }
?>