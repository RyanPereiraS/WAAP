<?php 
    require_once "../conexao/conexao.php";
    if(isset($_POST['nome'])&&isset($_POST['email'])&&isset($_POST['tell'])&&isset($_POST['ddd'])&&isset($_POST['nasci'])&&isset($_POST['pass'])&&isset($_POST['cpass'])){
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $telefone = mysqli_real_escape_string($conexao, $_POST['tell']);
        $ddd = mysqli_real_escape_string($conexao, $_POST['ddd']);
        $nasc = mysqli_real_escape_string($conexao, $_POST['nasci']);
        $senha = mysqli_real_escape_string($conexao, $_POST['pass']);
        $cpass = mysqli_real_escape_string($conexao, $_POST['cpass']);
        $ano = explode("-", $nasc);
        if(strlen($nome) > 80 || strlen($nome) ==0){// Nome Inválido
            echo "<script>
            alert('Nome Inválido');
            </script>";
        }else if(($ano[0]-date('Y')) > -18){//Menor 18
            echo "<script>
            alert('Menor de idade');
            </script>";
        } else if(strlen($email) > 80 || strlen($email) == 0){// Email Inválido
            echo "<script>
            alert('Email Inválido');
            </script>";
        } else if(strlen($telefone) > 9 || strlen($telefone) == 0){// Telefone Inválido
            echo "<script>
            alert('Telefone Inválido');
            </script>";
        } else if(strlen($ddd) != 3){// DDD Inválido
            echo "<script>
            alert('DDD Inválido');
            </script>";
        } else if($senha != $cpass){// Senha Inválida
            echo "<script>
            alert('Senha Inválido');
            </script>";
        } else {
            $senha = sha1($senha);
            $sql = "INSERT INTO usuario(nome, telefone, ddd, email, senha, nascimento) VALUES ('$nome', 
            '$telefone','$ddd','$email', '$senha', '$nasc')";
            $executar = mysqli_query($conexao, $sql);
            if($executar == 1){// Sucesso
                echo "<script>
                    alert('Deu Certo');
                    </script>";
            } else {// Falha
                echo "<script>
                    alert('Deu Errado');
                    </script>";
            }
        }
    } else {//Se Vier por fora
        echo "<script>
                    alert('Erro');
                    </script>";
    }
?>