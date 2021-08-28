<?php 
    session_start();
    if($_SESSION['logado'] == false){
        echo "<script>
            alert('Você não está Logado!');
            location.href = 'index.php';
        </script>";
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
    <?php 
        require_once 'utils/conexao.php';
        $sql = "SELECT nome,telefone,ddd,nascimento,sexo FROM usuario WHERE id='$_SESSION[usuario]'";
        $executar = mysqli_query($conexao,$sql);
        $array = mysqli_fetch_array($executar);
    
    ?>
    <form action="" method="post">
        <h2>Alterar Dados</h2>
        <input type="text" name="nome" <?php echo "value='$array[0]'" ?> id="">
        <input type="number" maxlength="3" name="ddd" <?php echo "value='$array[2]'" ?> id="">
        <input type="number" maxlength="9" name="telefone" <?php echo "value='$array[1]'" ?> id="">
        <?php 
            switch($array[4]){
                case "M":
                    echo '
                    <input type="radio" id="Masculino" checked name="sexo" value="M" id="">
                    <label for="Masculino" >Masculino</label>
                    <input type="radio" id="Feminino" name="sexo" value="F" id="">
                    <label for="Feminino">Feminino</label>
                    <input type="radio" id="Outro" name="sexo" value="O" id="">
                    <label for="Outro">Outro</label>';
                    
                    break;
                case "F":
                    echo '
                    <input type="radio" id="Masculino" name="sexo" value="M" id="">
                    <label for="Masculino" >Masculino</label>
                    <input type="radio" id="Feminino" Checked name="sexo" value="F" id="">
                    <label for="Feminino">Feminino</label>
                    <input type="radio" id="Outro" name="sexo" value="O" id="">
                    <label for="Outro">Outro</label>';
                    break;
                case "O":
                    echo '
                    <input type="radio" id="Masculino"  name="sexo" value="M" id="">
                    <label for="Masculino" >Masculino</label>
                    <input type="radio" id="Feminino" name="sexo" value="F" id="">
                    <label for="Feminino">Feminino</label>
                    <input type="radio" id="Outro" checked name="sexo" value="O" id="">
                    <label for="Outro">Outro</label>';
                    break;
            }
        ?>
        <input type="date" name="nascimento" <?php echo "value='$array[3]'" ?> id="">
        <input type="submit" name="alterardados" value="Alterar dados">
    </form>
    <br>
    <form action="" method="post">
        <h2>Alterar Senha</h2>
        <input type="password" name="pass" placeholder="Senha Atual">
        <input type="password" name="npass" placeholder="Nova Senha">
        <input type="password" name="cnpass" placeholder="Confirme a Senha">
        <input type="submit" name="alterarsenha" value="Alterar Senha">
    </form>
</body>
</html>
<?php 
    if(isset($_POST['alterardados'])){
        $nome = mysqli_real_escape_string($conexao,$_POST['nome']);
        $ddd = mysqli_real_escape_string($conexao,$_POST['ddd']);
        $telefone = mysqli_real_escape_string($conexao,$_POST['telefone']);
        $sexo = mysqli_real_escape_string($conexao,$_POST['sexo']);
        $nascimento = mysqli_real_escape_string($conexao,$_POST['nascimento']);
        $ano = explode("-", $nascimento);
        if(strlen($nome) > 80 || strlen($nome) == 0){

        } else if(strlen($ddd) !=3){

        } else if(strlen($telefone) != 9){

        } else if($sexo != "M" && $sexo !="F" && $sexo !="O"){

        } else if(($ano[0]-date('Y')) > -18){//Menor 18
            echo "<script>
            alert('Menor de idade');
            </script>";
        } else {
            $sql = "UPDATE `usuario` SET `nome` = '$nome', `sexo` = '$sexo', `telefone` = '$telefone', `ddd` = '$ddd', `nascimento` = '$nascimento' WHERE `usuario`.`id` = '$_SESSION[usuario]'";
            $executar = mysqli_query($conexao, $sql);
            if($executar){
                echo "<script>alert('Sucesso!');
                    location.href='utils/../dados.php';;
                </script>";
            } else {
                echo "<script>alert('Falha \n $sql');</script>";
            }
        }
    }else if(isset($_POST['alterarsenha'])){
        $pass = mysqli_real_escape_string($conexao, $_POST['pass']);
        $npass = mysqli_real_escape_string($conexao, $_POST['npass']);
        $cnpass = mysqli_real_escape_string($conexao, $_POST['cnpass']);
        if(strlen($pass) == 0){

        } else if(strlen($npass) == 0 || strlen($cnpass) == 0){

        } else if($npass != $cnpass){}
        else{
            $senha = sha1($pass);
            $sql = "SELECT id FROM usuario WHERE id='$_SESSION[usuario]' AND senha='$senha'";
            $executar = mysqli_query($conexao, $sql);
            if($executar){
                $row = mysqli_num_rows($executar);
                if($row == 1){
                    $senhanova = sha1($npass);
                    $sql="UPDATE `usuario` SET `senha` = '$senhanova' WHERE `usuario`.`id` = '$_SESSION[usuario]'";
                    $executar= mysqli_query($conexao, $sql);
                    if($executar){
                        echo "<script> 
                            alert('Senha Alterada com Sucesso!');
                        </script>";
                    } else {
                        echo "<script> 
                            alert('Houve um problema no meio do caminho! \n $sql');
                        </script>";
                    }
                }
            }
        }
    }
?>