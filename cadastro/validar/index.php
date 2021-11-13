<head>
    <script type="text/javascript" src="gifffer.min.js"></script>
    
</head>
<?php
if (isset($_GET['token'])) {
    function validar($token)
    {
        require_once '../../utils/conexao.php';
        if ($token == '') { //return false;
        }
        $sql = "SELECT nome FROM `usuario` WHERE `token` = '$token'";
        $exe = mysqli_query($conexao, $sql);
        $rows = mysqli_num_rows($exe);
        if ($rows == 1) {
            $sql = "UPDATE `usuario` SET `token` = '' WHERE `usuario`.`token` = '$token'";
            $exe = mysqli_query($conexao, $sql);
            if ($exe) return true;
        } else {
            return false;
        }
    }
    $sucesso = validar($_GET['token']);
    if ($sucesso) {
        echo "
                <p class='text-center'>
                    <img class='info-sucesso' width='500' src='https://i.pinimg.com/originals/45/97/70/459770a2983c886f0473e62097c5006a.gif' alt=''>
                    <br><span class='quase'>Tudo Pronto!</span>
                </p>
                <p class='text-center info '>
                    Sua conta foi ativada! <br> Você será redirecionado em 5 segundos!
                </p>
            ";
        echo "
                <script> 
                    setTimeout(function () {
                        location.href= '../../login/';
                    },5000);
                </script>
            ";
    } else {
        echo "
                <p class='text-center'>
                    <img class='info-sucesso' width='500' src='https://cdn.dribbble.com/users/2469324/screenshots/6538803/comp_3.gif' alt=''>
                    <br><span class='quase'>Falha ao validar!</span>
                </p>
                <p class='text-center info '>
                    Seu token não está válido em nosso banco de dados! <br> Você será redirecionado em 5 segundos!
                </p>
                <script> 
                    setTimeout(function () {
                        location.href= '../'; 
                    },5000);
                </script>
            ";
    }
} else {
    echo "
            <p class='text-center'>
                <img width='500' src='https://cdn.dribbble.com/users/1603428/screenshots/4158745/web-dev-gif.gif' alt='Gif'>
                <br><span class='quase'>Quase Lá!</span>
            </p>
            <p class='text-center info'>
                Antes de começar a usar sua conta WAAP é preciso verificar o seu e-mail para ativar sua conta, enquanto isso estamos preparando tudo para você!
            </p>
        ";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>WAAP - Validar Conta</title>
</head>
<style>
    .info {
        max-width: 50%;
        margin: 0 auto;
        color: #7d7d7d;
    }

    .quase {
        font-size: 50px;
        color: #7d7d7d;
    }

    .info-sucesso {
        border-radius: 50%;
    }
</style>

<body>


</body>

</html>