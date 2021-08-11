<?php 
    session_start();
    if(isset($_SESSION['logado'])){

    } else if($_SESSION['type'] == 1) {

    }else if($_SESSION['type'] == 2) {
        
    }else {

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
    <?php 
        require_once "../../utils/conexao.php";
        require_once "../../utils/functions.php";
        $sql = "SELECT * FROM ong WHERE id_administrador='$_SESSION[gerenciador]'";
        $executar = mysqli_query($conexao, $sql);
        $linhas = mysqli_num_rows($executar);
        if($linhas == 0){
            echo '<form action="" method="post">
                <h1>Bem-Vindo</h1>
                <h3>Como esse é o seu primeiro login precisamos cadastra sua Ong<h3>
            <p>
                Nome da Instituição:
                <input type="text" name="nome" id="">
            </p>
            <p>
                CNPJ: 
                <input type="text" name="cnpj" id="">
            </p>
            <p>
                <input type="submit" name="redessociais" id="" value="Enviar">
            </p>
        </form>';
        }
    ?>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Inicio</a>
        <a href="perfil.php">Perfil</a>
        <a href="#">Unidades</a>
        <form method="POST">
            <input type="hidden" name="sair" value="true">
            <input type="submit" value="Sair" name="sair">
            
        </form>
    </div>
    <span onclick="openNav()">open</span>

</body>
</html>
<?php 
    require_once "../../utils/conexao.php";
    require_once "../../utils/functions.php";
    if(isset($_POST['redessociais'])){
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $cnpj = mysqli_real_escape_string($conexao, $_POST['cnpj']);
        if(strlen($nome) == 0 || strlen($nome) > 50){

        } else {
            $sql = "INSERT INTO ong(nome, id_administrador, certificado) VALUES ('$nome','$_SESSION[gerenciador]','$cnpj')";
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
    if(isset($_POST['sair'])){
        $_SESSION['logado'] = false;
        unset($_SESSION['gerenciador']);
        unset($_SESSION['administrador']);
        unset($_SESSION['type']);
        echo "<script> 
                location.href='../ong/login.php';
            </script>";
    }
?>