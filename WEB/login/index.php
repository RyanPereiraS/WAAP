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
    <form action="verify.php" method="post">
        <p><input type="text" name="email" id="" placeholder="E-Mail"></p>
        <p><input type="text" name="pass" id="" placeholder="Senha"></p>
        <input type="submit" value="Log-In">
        <p>Novo por aqui? <a href="cadastrar.php">Cadastre-se!</a></p>
    </form>
</body>
</html>