<?php
session_start();
require_once "../../utils/config.php";
if (isset($_SESSION['logado'])) {
    if ($_SESSION['logado'] != true) {
        echo "
                <script> 
                    alert('Para ter acesso a esta página é nescessario estar logado!');
                    location.href='../../';
                </script>
            ";
    } else if ($_SESSION['privilegio'] != 2) {
        echo "
                <script> 
                    alert('Apenas 1 ONG por cadastro!');
                    location.href='../../';
                </script>
            ";
    } else {
        $privilegio = $_SESSION['privilegio'];
    }
} else {
    echo "
                <script> 
                    alert('Para ter acesso a esta página é nescessario estar logado!');
                    location.href='../../';
                </script>
            ";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <base href="../../">
    <title>Cadastro ONG - WAAP</title>
</head>

<body>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
		<a href="./" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
			<img src="./assets/Logoparalela.png" class="logo" alt="Logo" title="Logo Waap">
		</a>

		<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
			<li><a href="./" class="nav-link px-2 link-dark">Início</a></li>
			<li><a href="./adocao/" class="nav-link px-2 link-dark">Adote</a></li>
			<li><a href="./ong/ongs.php" class="nav-link px-2 link-dark">ONGs</a></li>
			<li><a href="./sobre-nos/" class="nav-link px-2 link-dark">Sobre Nós</a></li>
		</ul>
		<?php
            if (isset($privilegio)) {
                switch ($privilegio) {
                    case 0:
                        echo '
                                    <div class="col-md-3 menus-nav text-end">
                                        <a href="./painel/admin/" class=""><button type="button" class="btn btn-outline-primary me-2">Painel</button></a>
                                        <a href="./sair.php" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                                    </div>
                                ';
                        break;
                    case 1:
                        echo '
                                    <div class="col-md-3 menus-nav text-end">
                                    <a href="./painel/ong/" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
                                    <a href="./gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
                                    <a href="./sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                                    </div>
                                ';
                        break;
                    default:
                        echo '
                                    <div class="col-md-3 menus-nav text-end">
                                    <a href="./gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
                                    <a href="./sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                                    </div>
                                ';
                        break;
                }
            } else {
                echo '
                            <div class="col-md-3 menus-nav text-end">
                            <a href="./login/" class=""><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
                            <a href="./cadastro/" class=""><button type="button" class="btn btn-primary">Cadastre-se</button></a>
                            </div>
                        ';
            }
        ?>
		
	</header>
    <div class=" bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-3 text-center">Crie a ONG</h4>
            <p class="text-center">Insira os dados da Entidade</p>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <ion-icon name="home"></ion-icon>
                        </span>
                    </div>
                    <input name="nome" class="form-control" placeholder="Nome da Entidade" type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <ion-icon name="document"></ion-icon>
                        </span>
                    </div>
                    <input name="cnpj" id="cnpj" class="form-control" placeholder="CNPJ" type="text">
                    <script type="text/javascript">
                        $("#cnpj").mask("00.000.000/0000-00", {
                            reverse: true
                        });
                    </script>
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <ion-icon name="calendar"></ion-icon>
                        </span>
                    </div>
                    <input name="anofunda" id="data" class="form-control" placeholder="Ano de Fundação" type="text">
                    <script>
                        $("#data").mask("00/00/0000", {
                            reverse: false
                        });
                    </script>
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend ">
                        <span class=" image">
                            <ion-icon name="image"></ion-icon>
                        </span>
                    </div>
                    
                    <div class="form-control">
                        Insira a Logo
                    <input name="logo" type="file" id="logo" accept="image/*" title="&nbsp;"/>
                    </div>
                </div> <!-- form-group// -->
                
                
                
                <div class="form-group">
                    <input type="submit" value="Enviar registro" name='enviar' class="btn btn-primary btn-block"> </input>
                </div> <!-- form-group// -->

            </form>
        </article>
    </div>
    <script>
        $(function () {
            $('input[type="file"]').change(function () {
                if ($(this).val() != "") {
                        $(this).css('color', '#333');
                }else{
                        $(this).css('color', 'transparent');
                }
            });
        })
    </script>

</body>

</html>

<?php
if (isset($_POST['enviar'])) {
    if (empty($_POST['nome']) or empty($_POST['cnpj']) or empty($_POST['anofunda'])) {
        echo "<script> 
                alert('Preencha todos os campos!');
            </script>";
    } else {
        $explode = explode('/', $_POST['anofunda']);
        $replace = $explode[2]."-".$explode[1]."-".$explode[0];

        if (strlen($_POST['nome']) > 60) {
            echo "<script> 
                    alert('Nome inválido! \n o nome da ONG não pode ter mais de 60 caracteres');
                    
                </script>";
        } else if (strlen($_POST['cnpj']) != 18) {
            echo "<script> 
                    alert('CNPJ inválido!');
                    
                </script>";
        } else if (strtotime($replace) > time()) {
            echo "<script> 
                alert('A data de fundação esta no futuro!');
                </script>";
        } else if(!isset($_FILES['logo'])){
            echo "<script> 
            alert('Nenhuma logo selecionada');
            </script>";
        
        } else {
            require_once '../../utils/conexao.php';
            $verify = "SELECT id_usuario FROM ong WHERE id_usuario = $_SESSION[id_usuario]";
            $executarverify = mysqli_query($conexao, $verify);
            $rows = mysqli_num_rows($executarverify);
            if($rows != 0){
                echo"
                    <script>
                        alert('Já existe um pedido feito por este usuário!');
                        history.back();
                    </script>
                ";
                exit;
            }
            $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
            $cnpj = mysqli_real_escape_string($conexao, $_POST['cnpj']);
            $anofunda = mysqli_real_escape_string($conexao, $_POST['anofunda']);
            $imglogo = $_FILES['logo'];
            $pegarextlogo = explode(".", $imglogo['name']);
            $extlogo = $pegarextlogo[1];
            $nomelogo = md5(uniqid(time())).".".$extlogo;
            $dimencaologo = getimagesize($imglogo['tmp_name']);
            if($dimencaologo[0] != 250 || $dimencaologo[1] != 250){
                echo"
                    <script>
                        alert('Envie uma logo de 250x250 pixeis');
                        history.back();
                    </script>
                ";
            } else {
                $origemlogo = $imglogo['tmp_name'];
                $destinologo = "../../assets/ong/logo/".$nomelogo;
                $uparlogo = move_uploaded_file($origemlogo ,$destinologo);
                if($uparlogo){
                    $sql = "INSERT INTO ong(id_usuario, nome, cnpj, fundacao, logo,  status_ong) VALUES ('$_SESSION[id_usuario]', '$nome','$cnpj','$replace', '$nomelogo','0')";
                    $executar = mysqli_query($conexao, $sql);
                    if ($executar) {
                        $sql2 = "SELECT email from usuario where id_usuario = $_SESSION[id_usuario]";
                        $exe2 = mysqli_query($conexao,$sql2);
                        $fech2 = mysqli_fetch_array($exe2);
                        $dados = array(
                            'email' => $fech2['email'],
                            'nome' => $nome,
                            'cnpj' => $cnpj
                        );
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://$host:$port/waap_oficial/web3/utils/emailnovaong.php");
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $data = curl_exec($ch);
                        curl_close($ch);
                        echo "<script> 
                            alert('Seu pedido foi cadastrado com sucesso! \\nenviaremos um E-Mail quando seu pedido for aprovado.');
                            location.href='index.php';
                        </script>";
                    } else {
                        echo "<script> 
                            alert('Houve um problema ao registra seu pedido! \\nTente novamente, se o erro persistir contate nossa equipe.');
                        </script>";
                    }
                }
            }
        }
    };
}
?>