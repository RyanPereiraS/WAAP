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
    <?php 
        require_once "../../utils/conexao.php";
        require_once "../../utils/functions.php";
        $sql = "SELECT * FROM contato WHERE id_ong='$_SESSION[ong]'";
        $executar = mysqli_query($conexao, $sql);
        $linhas = mysqli_num_rows($executar);
        if($linhas == 0){
            echo '<form action="" method="post">
        
            <p>
                Facebook: (facebook.com/<strong>Insira este valor</strong>)
                <input type="text" name="facebook" id="">
            </p>
            <p>
                Instagram: (instagram.com/<strong>Insira este valor</strong>/)
                <input type="text" name="instagram" id=""></p>
            <p>
                Email:
                <input type="text" name="email" id="" required>
            </p>
            <p>
                Site: (https://<strong>Insira este valor</strong>)
                <input type="text" name="site" id="">
            </p>
            <p>
                <input type="submit" name="redessociais" id="" value="Enviar">
            </p>
        </form>';
        }
    ?>
</body>
</html>
<?php 
    require_once "../../utils/conexao.php";
    require_once "../../utils/functions.php";
    if(isset($_POST['redessociais'])){
        $face = mysqli_real_escape_string($conexao, $_POST['facebook']);
        $insta = mysqli_real_escape_string($conexao, $_POST['instagram']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $site = mysqli_real_escape_string($conexao, $_POST['site']);
        if(strlen($email) == 0 || strlen($email) > 80){

        } else {
            $sql = "INSERT INTO contato(facebook,instagram,email,site,id_ong) VALUES ('$face','$insta','$email','$site','$_SESSION[ong]')";
            $executar = mysqli_query($conexao, $sql);
            if($executar){
                echo "<script> 
                    alert('Dados cadastrados com sucesso!');
                    location.href='../ong/';
                </script>";
            } else {
                echo "Erro!";
            }
        }
    }
?>