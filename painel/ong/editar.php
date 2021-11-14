<?php
session_start();
require_once "../../utils/conexao.php";
if (!isset($_SESSION['logado'])) {
    echo "
            <script>
            alert('a');
                location.href='../../';
            </script>
        ";
} else if ($_SESSION['privilegio'] != 1) {
    echo "
            <script>
                
                location.href='../../';
            </script>
        ";
} else {
    $query = "SELECT u.nome, e.nome FROM usuario u INNER JOIN ong e ON e.id_usuario = u.id_usuario WHERE u.id_usuario = $_SESSION[id_usuario]";
    $sql = mysqli_query($conexao, $query);
    $usuario = mysqli_fetch_array($sql);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tiny.cloud/1/wa5iyyb1ulyzeqh8d9sgupjbm09mog7gynaqideu5gwfpp2t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#descricao-ong'
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/styles.css">
    <title>Painel de administração da ONG</title>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <!--<i class='bx bxl-c-plus-plus icon'></i>-->
            <div class="logo_name">WAAP</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Buscar...">
                <span class="tooltip">Buscar</span>
            </li>
            <li>
                <a href="./">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="pet.php">
                    <i><span class="iconify" data-icon="cil:animal"></span></i>
                    <span class="links_name">Pets</span>
                </a>
                <span class="tooltip">Pets</span>
            </li>
            <li>
                <a href="aviso.php">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Avisos</span>
                </a>
                <span class="tooltip">Avisos</span>
            </li>
            <li>
                <a href="estatisticas.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Estatísticas</span>
                </a>
                <span class="tooltip">Estatísticas</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
                </a>
                <span class="tooltip">Setting</span>
            </li>
            <li>
                <a href="cadastro-animal.php">
                    <i><span class="iconify" data-icon="ic:outline-app-registration"></span></i>
                    <span class="links_name">Cadastrar Pet</span>
                </a>
                <span class="tooltip">Cadastrar Pet</span>
            </li>
            <li class="profile">
                <a href="../../index.php">
                    <i class='bx bx-log-out' id="log_out"></i>
                    <div class="profile-details">
                        <div class="name_job">
                            <div class="name"><?php echo $usuario[0]; ?></div>
                            <div class="job"><?php echo $usuario[1]; ?></div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });
        searchBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });

        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        }
    </script>
    <section class="home-section">
        <?php
        $id_usuario = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM ong WHERE id_usuario='$id_usuario'";
        $executar = mysqli_query($conexao, $sql);
        $ong = mysqli_fetch_array($executar);

        ?>

        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="jumbotron">
                        <br>
                        <h1 class="display-5">Gerenciar</h1>
                        <hr>
                        <br>
                    </div>


                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto da Capa Atual:</label><br>
                            <?php
                            if (!empty($ong['foto_capa'])) {
                                echo "<img id='foto_capa' width='290' src='../../assets/ong/capa/$ong[foto_capa]'>";
                            } else {
                                echo "<img id='foto_capa' style='width: 300px; height: 290px;'><br>";
                            }
                            ?>
                            <br><br>
                            <input class="form-control" type="file" name="foto_capa" onchange="previewImagem()">
                            <figcaption class="figure-caption">Caso deseje Trocar a imagem de Capa, basta selecionar uma nova...</figcaption>
                        </div>
                        <script>
                            function previewImagem() {
                                var imagem = document.querySelector('input[name=foto_capa]').files[0];
                                //var preview = document.querySelector('img');
                                var preview = document.getElementById('foto_capa');

                                var reader = new FileReader();

                                reader.onloadend = function() {
                                    preview.src = reader.result;
                                }

                                if (imagem) {
                                    reader.readAsDataURL(imagem);
                                } else {
                                    preview.src = "";
                                }
                            }
                        </script>
                        <hr>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto da logo atual:</label><br>
                            <?php
                            if (!empty($ong['logo'])) {
                                echo "<img id='foto_logo' width='250' src='../../assets/ong/logo/$ong[logo]'><br><br>";
                            } else {
                                echo "<img id='foto_logo' style='width: 300px; height: 290px;'><br>";
                            }
                            ?>
                            <input class="form-control" type="file" name='foto_logo' onchange="previewImagemtwo()">
                            <figcaption class="figure-caption">Caso deseje Trocar a imagem da Logo, basta selecionar uma nova...</figcaption>
                        </div>
                        <script>
                            function previewImagemtwo() {
                                var imagem = document.querySelector('input[name=foto_logo]').files[0];
                                var preview = document.getElementById('foto_logo');

                                var reader = new FileReader();

                                reader.onloadend = function() {
                                    preview.src = reader.result;
                                }



                                if (imagem) {
                                    reader.readAsDataURL(imagem);
                                } else {
                                    preview.src = "";
                                }
                            }
                        </script>
                        <hr>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nome Da ONG:</label>
                            <input type="text" class="form-control" name="nome" <?php echo "value='$ong[nome]'"; ?>>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">CNPJ:</label>
                            <input class="form-control" type="text" <?php echo "value='$ong[cnpj]'"; ?> aria-label="Disabled input example" disabled readonly>
                        </div>
                        <hr>
                        <div class="mb-3">

                            <label for="exampleFormControlInput1" class="form-label">Ano de Fundação:</label>
                            <input class="form-control" type="date" name='fundacao' <?php echo "value='$ong[fundacao]'";
                                                                                    ?>>
                        </div>
                        <hr>
                        <label for="exampleFormControlInput1" class="form-label">Descrição da ONG:</label>
                        <textarea name="descricao" id="descricao-ong"><?php echo "$ong[descricao_ong]"; ?></textarea>
                        <br>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <input type="submit" class="btn btn-outline-success" name="enviar" value="Atualizar ONG">
                            <br>
                        </div>

                    </form>


                    <form action="" method="post">

                        <div class="jumbotron">
                            <h1 class="display-5">Dados de Endereço</h1>
                            <hr>
                            <br>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">CEP:</label>
                                <input type="text" class="form-control" value="<?php echo $ong['cep'] ?>" name="cep" id="cep" aria-label="First name">
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Número:</label>
                                <input type="number" class="form-control" name="num" value="<?php echo $ong['numero'] ?>" id="" aria-label="Last name">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Complemento:</label>
                                <input type="text" class="form-control" name="comp" value="<?php echo $ong['complemento'] ?>" id="" aria-label="First name">
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Referência:</label>
                                <input type="text" class="form-control" name="ref" value="<?php echo $ong['referencia'] ?>" id="" aria-label="Last name">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label>Rua, Logradouro, Travessa <span>*</span> <span id='mensagem'></span></label>
                                <input type="text" class="form-control pula" id="rua" name="rua" value="<?php echo $ong['logradouro'] ?>" placeholder="Informe a Rua, Logradouro, Travessa" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Cidade</label>
                                <input type="text" class="form-control pula" id="cidade" name="cidade" value="<?php echo $ong['cidade'] ?>" placeholder="Informe a Cidade">
                            </div>
                            <div class="col">
                                <label>Bairro <span>*</span> <span id='mensagem'></span></label>
                                <input type="text" class="form-control pula" id="bairro" name="bairro" value="<?php echo $ong['bairro'] ?>" placeholder="Bairro" required>
                            </div>
                            
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>UF</label>
                                    <input type="text" class="form-control pula" id="uf" maxlength="2" disabled name="uf" value="<?php echo $ong['uf'] ?>" placeholder="UF">
                                </div>
                            </div> 
                            
                        </div>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <br>
                            <input type="submit" class="btn btn-outline-success" name="enviarEnd" value="Atualizar">
                            <br>
                            <br>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function() {

                                // Inseri máscara no CEP
                                $("#cep").mask("99999-999");

                                // Método para consultar o CEP
                                $('#cep').on('blur', function() {

                                    if ($.trim($("#cep").val()) != "") {

                                        $("#mensagem").html('(Aguarde, consultando CEP ...)');
                                        $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep=" + $("#cep").val(), function() {

                                            if (resultadoCEP["resultado"]) {
                                                $("#rua").val(unescape(resultadoCEP["tipo_logradouro"]) + " " + unescape(resultadoCEP["logradouro"]));
                                                $("#bairro").val(unescape(resultadoCEP["bairro"]));
                                                $("#cidade").val(unescape(resultadoCEP["cidade"]));
                                                $("#uf").val(unescape(resultadoCEP["uf"]));
                                            }

                                            $("#mensagem").html('');
                                        });
                                    }
                                });
                            });
                        </script>

                    </form>

                    <form action="" method="post">

                        <div class="jumbotron">
                            <h1 class="display-5">Dados de Contato</h1>
                            <hr>
                            <br>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Facebook:</label>
                                <input type="text" class="form-control" value="<?php echo $ong['facebook'] ?>" name="facebook" id="facebook" aria-label="First name">
                                <figcaption class="figure-caption"><span style="color:red;">https://facebook.com/<span><span style="color:green;">waap<span></figcaption>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Instagram:</label>
                                <input type="text" class="form-control" name="instagram" value="<?php echo $ong['instagram'] ?>" id="" aria-label="Last name">
                                <figcaption class="figure-caption"><span style="color:red;">https://instagram.com/<span><span style="color:green;">waap<span></figcaption>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">WhatsApp:</label>
                                <input type="text" class="form-control" name="whatsapp" value="<?php echo $ong['whatsapp'] ?>" id="whatsapp" aria-label="First name">
                                <figcaption class="figure-caption">Por Favor Não inserir o número com DDD !!</figcaption>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Telefone Fixo:</label>
                                <input type="text" class="form-control" name="tel_fixo" value="<?php echo $ong['tel_fixo'] ?>" id="tel_fixo" aria-label="Last name">
                                <figcaption class="figure-caption">(DDD) Telefone</figcaption>
                            </div>
                        </div>
                        <br>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" name="email" value="<?php echo $ong['email'] ?>" id="">
                            </div>
                        </div>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <br>
                            <input type="submit" class="btn btn-outline-success" name="enviarCon" value="Atualizar">
                            <br>
                        </div>

                        <script type="text/javascript">
                            $("#whatsapp").mask("(99) 99999-9999");
                        </script>
                        <script type="text/javascript">
                            $("#tel_fixo").mask("(99) 9999-9999");
                        </script>
                    </form>
                    <hr>
                    <br />

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-dark align-center" data-bs-toggle="modal" data-bs-target="#encerrar">Encerrar ONG</button>
                        <br>
                    </div>
    </section>

    </div>
    </div>
    </div>
    <!--Modal-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <div class="modal fade" id="encerrar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atenção!</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>x</span></button>
                </div>
                <div class="modal-body">
                    <p>Deseja encerrar as atividades no WAAP?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <button class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-danger" type="submit" name="encerrar">Encerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php

if (isset($_POST['enviar'])) {
    if (strlen($_POST['nome']) > 60 || empty($_POST['nome'])) {
        echo "<script>
                    alert('nome invalido');
                    history.back();
                </script>
            ";
    } else if (strtotime($_POST['fundacao']) > time()) {
        echo "<script> 
                alert('A data de fundação esta no futuro!');
                </script>";
    } else {
        if ($_FILES['foto_capa']['error'] == 4) {
            if (empty($ong['foto_capa'])) {
                echo "
                        <script>
                            alert('Envie uma foto de capa.');
                        </script>
                    ";
            } else {
                $nome_capa = $ong['foto_capa'];
            }
        } else {
            $img_capa = $_FILES['foto_capa'];
            $pegarextcapa = explode(".", $img_capa['name']);
            $extcapa = $pegarextcapa[1];
            $nome_capa = md5(uniqid(time())) . "." . $extcapa;
            $dimencaocapa = getimagesize($img_capa['tmp_name']);
            $origemcapa = $img_capa['tmp_name'];
            $destinocapa = "../../assets/ong/capa/" . $nome_capa;
            $uparcapa = move_uploaded_file($origemcapa, $destinocapa);
            if ($uparcapa) {
                unlink("../../assets/ong/capa/" . $ong['foto_capa']);
            }
        }
        if ($_FILES['foto_logo']['error'] == 4) {
            $nome_logo = $ong['logo'];
        } else {
            $img_logo = $_FILES['foto_logo'];
            $pegarextlogo = explode(".", $img_logo['name']);
            $extlogo = $pegarextlogo[1];
            $nome_logo = md5(uniqid(time())) . "." . $extlogo;
            $dimencaologo = getimagesize($img_logo['tmp_name']);
            if ($dimencaologo[0] > 500 || $dimencaologo[1] > 500) {
                echo "
                        <script>
                            alert('Envie uma logo no máximo de 500x500');
                            history.back();
                        </script>
                    ";
            } else {
                $origemlogo = $img_logo['tmp_name'];
                $destinologo = "../../assets/ong/logo/" . $nome_logo;
                $uparlogo = move_uploaded_file($origemlogo, $destinologo);
                if ($uparlogo) {
                    unlink("../../assets/ong/logo/" . $ong['logo']);
                }
            }
        }
        $nome = $_POST['nome'];
        $desc = $_POST['descricao'];
        $fundacao = $_POST['fundacao'];
        $id_ong = $ong['id_ong'];
        if (!empty($nome_capa) and !empty($nome_logo)) {
            $sqlupdate = "UPDATE ong SET nome = '$nome', descricao_ong = '$desc', fundacao='$fundacao' , foto_capa = '$nome_capa' , logo = '$nome_logo'  WHERE id_ong = $id_ong";
            $execupdate = mysqli_query($conexao, $sqlupdate);
            if ($execupdate) {
                echo "<script> 
                                alert('Informações da ONG atualizadas com sucesso.');
                                location.href='editar.php';
                        </script>
                        ";
            } else {
                echo "<script> 
                                alert('Erro.');

                        </script>
                        ";
            }
        }
    }
} else if (isset($_POST['enviarEnd'])) {    
    if (empty($_POST['cep']) || empty($_POST['num'])) {
        echo "<script>
                    alert('A');
                    location.href='./';
                </script>";
    } else {
        if (strlen($_POST['cep']) != 9) {
            echo "<script>
                    alert('B');
                    location.href='./';
                </script>";
        } else if (strlen($_POST['num']) < 1) {
            echo "<script>
                    alert('C');
                    location.href='./';
                </script>";
        } else {
            $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
            $num = mysqli_real_escape_string($conexao, $_POST['num']);
            $logradouro = mysqli_real_escape_string($conexao, $_POST['rua']);
            $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
            $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
            $uf = mysqli_real_escape_string($conexao, $_POST['uf']);
            if (strlen($_POST['comp']) == 0) {
                $comp = null;
            } else {
                $comp = mysqli_real_escape_string($conexao, $_POST['comp']);
            }
            if (strlen($_POST['ref']) == 0) {
                $ref = null;
            } else {
                $ref = mysqli_real_escape_string($conexao, $_POST['ref']);
            }
            $sql = "UPDATE `ong` SET `cep` = '$cep', `numero` = '$num', `complemento` = '$comp', `referencia` = '$ref', `logradouro` = '$logradouro', `cidade` = '$cidade', `bairro` = '$bairro', `uf` = '$uf' WHERE `ong`.`id_ong` = $_SESSION[id_ong]";
            $exe = mysqli_query($conexao, $sql);
            if ($exe) {
                //echo $sql;
                echo "<script>
                    alert('Endereço Atualizado com sucesso!');
                    location.href='editar.php';
                </script>";
            } else {
                echo $sql;
            }
        }
    }
} else if (isset($_POST['enviarCon'])) {
    if (empty($_POST['email']) || empty($_POST['tel_fixo'])) {
        echo "<script>
                    alert('Os Campos E-Mail e Telefone Fixo não podem estar em branco!');
                    location.href='./';
                </script>";
    } else {
        if (strlen($_POST['tel_fixo']) != 14) {
            echo "<script>
                    alert('Telefone fixo Inválido');
                    location.href='./';
                </script>";
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "<script>
                    alert('E-Mail Inválido');
                    location.href='./';
                </script>";
        } else if (strlen($_POST['instagram']) > 50 && !empty($_POST['instagram'])) {
            echo "<script>
                        alert('Insira apenas o valor após a barra do link!\\n Exemplo: Instagram.com/*waap*');
                        location.href='./';
                    </script>";
        } else if (strlen($_POST['facebook']) > 50 && !empty($_POST['facebook'])) {
            echo "<script>
                        alert('Insira apenas o valor após a barra do link!\\n Exemplo: facebook.com/*waap*');
                        location.href='./';
                    </script>";
        } else if (strlen($_POST['whatsapp']) != 15 && !empty($_POST['whatsapp'])) {
            echo "
                <script>
                    alert('WhatsApp Inválido');
                    location.href='./';
                </script>
            ";
        } else {
            $whatsapp = mysqli_real_escape_string($conexao, $_POST['whatsapp']);
            $tel_fixo = mysqli_real_escape_string($conexao, $_POST['tel_fixo']);
            $instagram = mysqli_real_escape_string($conexao, $_POST['instagram']);
            $email = mysqli_real_escape_string($conexao, $_POST['email']);
            $facebook = mysqli_real_escape_string($conexao, $_POST['facebook']);
            $sql = "UPDATE `ong` SET `facebook` = '$facebook', `instagram` = '$instagram', `email` = '$email', `whatsapp` = '$whatsapp', `tel_fixo` = '$tel_fixo' WHERE `ong`.`id_ong`  = $_SESSION[id_ong]";
            $exe = mysqli_query($conexao, $sql);
            if ($exe) {
                echo "<script>
                    alert('Metodos de contato atualizados com sucesso!');
                    location.href='editar.php';
                </script>";
            } else {
                echo $sql;
            }
        }
    }
} else if (isset($_POST['encerrar'])) {
    $sql = "SELECT id_animal FROM animal WHERE id_ong=$_SESSION[id_ong]";
    $exe = mysqli_query($conexao, $sql);
    if ($exe) {

        while ($dados = mysqli_fetch_array($exe)) {
            $sql2 = "DELETE FROM vacina_animal WHERE id_animal = $dados[id_animal]";
            $exe2 = mysqli_query($conexao, $sql2);
            if ($exe) {
                $sql3 = "DELETE FROM animal WHERE id_animal = $dados[id_animal]";
                $exe3 = mysqli_query($conexao, $sql3);
            }
        }
        $sql4 = "DELETE FROM `ong` WHERE `ong`.`id_ong` = $_SESSION[id_ong]";
        $exe4 = mysqli_query($conexao, $sql4);
        if ($exe4) {

            $sql5 = "UPDATE `usuario` SET `privilegio` = '2' WHERE `usuario`.`id_usuario` = '$_SESSION[id_usuario]'";
            $exe5 = mysqli_query($conexao, $sql5);
            session_destroy();
            echo "<script> 
                    location.href='../../'
                </script>";
        } else {
            echo "<script> 
                    alert('A');
                </script>";
        }
        // echo $sql4;echo"<br>";echo$sql5;exit;

    } else {
    }
}

?>