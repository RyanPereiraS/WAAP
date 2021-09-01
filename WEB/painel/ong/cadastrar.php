<?php 
    session_start();
    if(isset($_SESSION['logado'])){
        if($_SESSION['logado']){
            header("Location: ../ong/");
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
        <p><input type="text" name="nome" placeholder="Nome da Instituição" id=""></p>
        <p><input type="text" name="cnpj" id="" placeholder="CNPJ"></p>
        <p><input type="text" name="administrador" id="" placeholder="Nome do Administrador"></p>
        <p><input type="text" name="email" placeholder="E-Mail do Administrador" id=""></p>
        <p><input type="text" name="cpf" placeholder="CPF do Administrador" id=""></p>
        <p><input type="password" name="senha" placeholder="Senha do Administrador" id=""></p>
        <p><input type="password" name="csenha" placeholder="Confirme a Senha" id=""></p>
        <p><input type="submit" value="Enviar para Analise" name="" id=""></p>
    </form>
</body>
</html>

<?php 
    require_once "../../utils/conexao.php";
    require_once "../../utils/functions.php";
    if(isset($_POST['nome'])){
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $cnpj = mysqli_real_escape_string($conexao, $_POST['cnpj']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $administrador = mysqli_real_escape_string($conexao, $_POST['administrador']);
        $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
        $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
        $csenha = mysqli_real_escape_string($conexao, $_POST['csenha']);
        
        if(strlen($nome) == 0 || strlen($nome) > 50) {
            echo "<script> 
                    alert('Nome inválido');
                </script>";
        } else if (strlen($cnpj) != 14){
            // cnpj invalido
            echo "<script> 
                    alert('cnpj inválido');
                </script>";
        } else if (strlen($email) == 0 || strlen($email) > 80 || !str_contains($email, "@") || !str_contains($email, ".com")) {
            // email invalido
            echo "<script> 
                    alert('email inválido');
                </script>";
        } else if (strlen($senha) == 0  || $senha != $csenha){
            // senha invalida
            echo "<script> 
                    alert('senha inválido');
                </script>";
        } else if(strlen($administrador) == 0 || strlen($email) > 50 || strlen($email) < 4){
            echo "<script> 
                    alert('Nome de administrador inválido');
                </script>";
        } else if(strlen($cpf) != 11){
            echo "<script> 
                    alert('CPF inválido');
                </script>";
        }else {
            $verificacao = "SELECT id_administrador FROM gerenciador WHERE email='$email' OR cpnj='$cnpj'";
            $executarver = mysqli_query($conexao, $verificacao);
            $linhas = mysqli_num_rows($executarver);
            if($linhas != 0){
                echo "<script>
                        alert('Você já está cadastrado!');
                    </script>";
            } else {
                $pass = sha1($senha);
                $sql = "INSERT INTO gerenciador (nome,email,cnpj,status, administrador, cpf, senha) VALUES ('$nome', '$email', '$cnpj', '0', '$administrador', '$cpf', '$pass')";
                $executar = mysqli_query($conexao, $sql);
                if($executar) {
                    echo "<script> 
                        alert('Seus dados foram enviados! Assim que for aprovado você recebera um e-mail para concluir o cadastro de suas unidades!');
                    </script>";
                } else {
                    echo "<script> 
                        alert('Erro');
                    </script>";
                }
            }
        }
    }
    
?>