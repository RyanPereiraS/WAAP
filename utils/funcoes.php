<?php
    function newsletter($email){
        require_once 'conexao.php';
        $email = mysqli_real_escape_string($conexao, $email);
        $token = md5(date('Y-m-d H:i:s'));
        $sql= "INSERT INTO newsletter(email,token) VALUES('$email', '$token')";
        $executar = mysqli_query($conexao,$sql);
        if($executar){
            echo "<script> 
                alert('Cadastrado com sucesso!');
            </script>";
        } else {
            echo "<script> 
                alert('Houve um erro de conexão!');
            </script>";
        }
    }
    
?>