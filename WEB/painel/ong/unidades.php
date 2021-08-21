<?php 
    session_start();
    if(isset($_SESSION['logado'])){

    } else if($_SESSION['type'] == 1) {

    }else if($_SESSION['type'] == 2) {
        
    }else {

    }
    require_once "../../utils/conexao.php";
    require_once "../../utils/functions.php";
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
    <p><a href="cadastrarunidade.php">Nova Unidade</a></p>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>CEP</td>
            <td>Login</td>
            <td>Senha</td>
            <td>Remover</td>
            <td>Alterar</td>
        </tr>
        <?php
            $sql = "SELECT id FROM ong WHERE id_administrador = '$_SESSION[gerenciador]'";
            $executar = mysqli_query($conexao, $sql);
            $fetch = mysqli_fetch_array($executar);
            $query = "SELECT * FROM endereco WHERE id_ong=$fetch[0]";
            $execucao = mysqli_query($conexao, $query);
            while($dados = mysqli_fetch_array($execucao)){
                echo "
                    <tr>
                        <td>$dados[id]</td>
                        <td>$dados[cep] </td>
                        <td>$dados[login]</td>
                        <td><input type='password' value='$dados[senha]'></input></td>
                        <td></td>
                        <td></td>
                    </tr>";
            }
            
        ?>
    </table>
</body>
</html>