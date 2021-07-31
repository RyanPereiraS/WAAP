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
    <form action="cadastro.php" method="post">
        <p><input type="text" name="nome" id="" placeholder="Nome"></p>
        <p><input type="text" name="email" id="" placeholder="E-Mail"></p>
        <p><input type="text" name="tell" id="" placeholder="Telefone"></p>
        <p><input type="text" name="ddd" id="" placeholder="DDD"></p>
        <p><input type="date" name="nasci" id=""></p>
        <p><input type="text" name="pass" id="" placeholder="Senha"></p>
        <p><input type="text" name="cpass" id="" placeholder="Confirme sua senha"></p>
        <input type="submit" value="Cadastrar">
        <p>Já possui cadastro? <a href="index.php">Login!</a></p>
    </form>
</body>
</html>