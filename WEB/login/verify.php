<?php 
    session_start();
    require_once "../conexao/conexao.php";
    if(isset($_POST['email']) || isset($_POST[`pass`])){
        $email = mysqli_real_escape_string($conexao,$_POST['email']);
        $pass = mysqli_real_escape_string($conexao,$_POST['pass']);
        function str_contains(string $haystack, string $needle): bool
        {
            return '' === $needle || false !== strpos($haystack, $needle);
        }
        if(strlen($email) > 80 || strlen($email) == 0 || !str_contains($email, "@")|| !str_contains($email, ".com")){
            echo "Aqui";
        } else if (strlen($pass) == 0){
            echo "Aqui2";
        } else {
            $senha = sha1($pass);
            $sql = "SELECT nome FROM usuario u WHERE u.email = '$email' AND u.senha = '$senha'";
            $executar = mysqli_query($conexao, $sql);
            $fetch = mysqli_fetch_array($executar);
            $row = mysqli_num_rows($executar);
            if($executar){
                if($row == 1) {
                    $_SESSION['usuario'] = $fetch[0];
                    
                    header('Location: ../index.php');
                } else {
                    $_SESSION['nao_autenticado'] = true;
                    echo "Aqui3";
                }
            }else{
                echo"Erro no banco de dados";
                echo $sql;
            }
        }
    } else{

    }
?>