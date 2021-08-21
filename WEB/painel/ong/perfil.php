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
    <link rel="stylesheet" href="styles.css">
    <script src="index.js"></script>
    <title>Document</title>
</head>
<body>
<div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php">Inicio</a>
        <a href="#">Perfil</a>
        <a href="#">Unidades</a>
        <a href="#">Sla</a>
    </div>
    <span onclick="openNav()">open</span>
    <?php
        require_once "../../utils/conexao.php";
        require_once "../../utils/functions.php";
        $sql2 = "SELECT id FROM ong WHERE id_administrador = '$_SESSION[gerenciador]'";
        $executar2 = mysqli_query($conexao, $sql2);
        $fetch = mysqli_fetch_array($executar2);
        
        $sql = "SELECT id FROM contato WHERE id_ong='$fetch[0]'";
        $executar = mysqli_query($conexao, $sql);
        $linhas = mysqli_num_rows($executar);
        if($linhas == 0){
        echo '<form action="" method="post">
            <h1>Bem-Vindo</h1>
            <h3>Precisamos cadastrar metodos de contato com a sua Ong<h3>
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
        </p>';
        } else {
            $sql2 = "SELECT id FROM ong WHERE id_administrador = '$_SESSION[gerenciador]'";
            $executar2 = mysqli_query($conexao, $sql2);
            $fetch = mysqli_fetch_array($executar2);
            $sql = "SELECT facebook, instagram, email, site FROM contato WHERE id_ong='$fetch[0]'";
            $executar = mysqli_query($conexao, $sql);
            $fetch = mysqli_fetch_array($executar);
            echo "<form action='' method='post'>
                <p>
                    Facebook: (facebook.com/<strong>Insira este valor</strong>)
                    <input type='text' name='facebook' id='' value='$fetch[0]'>
                </p>
                <p>
                    Instagram: (instagram.com/<strong>Insira este valor</strong>/)
                    <input type='text' name='instagram' id='' value='$fetch[1]'></p>
                <p>
                    Email:
                    <input type='text' name='email' id='' value='$fetch[2]' required>
                </p>
                <p>
                    Site: (https://<strong>Insira este valor</strong>)
                    <input type='text' name='site' id='' value='$fetch[3]'>
                </p>
                <p>
                    <input type='submit' name='attredes' id='' value='Atualizar'>
                </p>
            </form>";

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
        $sql2 = "SELECT id FROM ong WHERE id_administrador = '$_SESSION[gerenciador]'";
        $executar2 = mysqli_query($conexao, $sql2);
        $fetch = mysqli_fetch_array($executar2);
        if(strlen($email) == 0 || strlen($email) > 80){

        } else {
            $sql = "INSERT INTO contato(facebook,instagram,email,site,id_ong) VALUES ('$face','$insta','$email','$site','$fetch[0]')";
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
    }else if(isset($_POST['attredes'])){
        $face = mysqli_real_escape_string($conexao, $_POST['facebook']);
        $insta = mysqli_real_escape_string($conexao, $_POST['instagram']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $site = mysqli_real_escape_string($conexao, $_POST['site']);
        if(!str_contains($email, '@') && !str_contains($email, '.com') OR strlen($email) > 80){
            echo "<script> 
            alert('Email Inválido!');
            location.href='../ong/perfil.php';
            </script>";
        } else if(strlen($face) > 50){
            echo "<script> 
            alert('Facebook Inválido!');
            location.href='../ong/perfil.php';
            </script>";
        } else if(strlen($insta) > 50){
            echo "<script> 
            alert('Instagram Inválido!');
            location.href='../ong/perfil.php';
            </script>";
        } else if(strlen($site) > 80){
            echo "<script> 
            alert('Site Inválido!');
            location.href='../ong/perfil.php';
            </script>";
        }else {
            $sql = "SELECT id FROM ong WHERE id_administrador = '$_SESSION[gerenciador]'";
            $executar = mysqli_query($conexao, $sql);
            $fetch = mysqli_fetch_array($executar);
            $sql = "UPDATE contato SET facebook='$face',instagram='$insta',email='$email',site='$site' WHERE id_ong='$fetch[0]'";
            $executar = mysqli_query($conexao, $sql);
            if($executar){
                echo "<script> 
                        alert('Dados atualizados com sucesso!');
                        location.href='../ong/perfil.php';
                    </script>";
            }else {
                echo "<script> 
                        alert('Ouve um problema no caminho!');
                        location.href='../ong/perfil.php';
                    </script>";
            }
        }
        
    }
?>