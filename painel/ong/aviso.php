<?php
session_start();
require_once "../../utils/conexao.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#descricao-ong'
        });
    </script>
    <style> 
        .img-thumbnail{
            border-radius: 50%!important;
        }
    </style>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/avisos.css">
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
                    <span class="links_name">Mensagens</span>
                </a>
                <span class="tooltip">Mensagens</span>
            </li>
            <li>
                <a href="estatisticas.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Estatísticas</span>
                </a>
                <span class="tooltip">Estatísticas</span>
            </li>
            <li>
                <a href="editar.php">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Gerenciar</span>
                </a>
                <span class="tooltip">Gerenciar</span>
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
                            <div class="name"><?php echo $_SESSION['usuario']; ?></div>
                            <div class="job"><?php echo $_SESSION['ong']; ?></div>
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
        if (isset($_POST['id_warn'])) {
            $sql = "SELECT id_aviso_visu FROM avisos_visu WHERE id_aviso = '$_POST[id_warn]' AND id_usuario = '$_SESSION[id_usuario]'";
            $exe = mysqli_query($conexao, $sql);
            if (mysqli_num_rows($exe) != 1) {
                $sql = "INSERT INTO avisos_visu(id_aviso, id_usuario) VALUES ('$_POST[id_warn]', '$_SESSION[id_usuario]')";
                mysqli_query($conexao, $sql);
            }
            $sql = "SELECT * FROM avisos a INNER JOIN usuario u ON u.id_usuario = a.admin_id WHERE id_aviso = $_POST[id_warn]";
            $exe = mysqli_query($conexao, $sql);
            $fetch = mysqli_fetch_array($exe);
            $post = explode(" ", $fetch['postagem']);
            $post_date = explode("-", $post[0]);
            $post_date = $post_date[2] . "/" . $post_date[1] . "/" . $post_date[0];
            $post_hour = explode(":", $post[1]);
            $post_hour = $post_hour[0] . ":" . $post_hour[1];

            echo "
            <div class='text'>Aviso</div>
        
            <div class='well'>
                <div class='media'>
                    <a class='pull-left' href='#'>
                        <img class='media-object' width='250' style='border-radius: 50%;' src='../../assets/profiles/$fetch[id_usuario].png'>
                    </a>
                    <div class='media-body'>
                        <h4 class='media-heading'>$fetch[aviso_titulo]</h4>
                        <p class='text-right'> Postado por: $fetch[nome]</p>
                        <p>$fetch[aviso_conteudo]</p>
                        <ul class='list-inline list-unstyled'>
                            <li><span><i class='glyphicon glyphicon-calendar'></i> $post_date, $post_hour </span></li>
                            <li>|</li>
                            <li>
                                <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
                                <span><i class='fa fa-facebook-square'></i></span>
                                <span><i class='fa fa-twitter-square'></i></span>
                                <span><i class='fa fa-google-plus-square'></i></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            ";
        } else {
            echo "<div class='text'>Avisos</div><div class='well'></div>";
            $sql = "SELECT * FROM avisos a INNER JOIN usuario u ON u.id_usuario = a.admin_id";
            $exe = mysqli_query($conexao, $sql);
            while($aviso = mysqli_fetch_array($exe)){
                $result = mb_strimwidth($aviso['aviso_conteudo'], 0, 500, '...');
                $nome = explode(' ',$aviso['nome']);
                $nome = $nome[0].' '.$nome[1];  
            echo "
                
                    <div class='media'>
                        <div class='col-md-10 blogShort'>
                            <h1>$aviso[aviso_titulo]</h1>
                            <img src='../../assets/profiles/$aviso[id_usuario].png' alt='post img' width='100' class='pull-left img-responsive thumb margin10 img-thumbnail'>
                            
                            <em>$nome</em>
                            <article><p>
                                $result <br>
                                <form class='warn' action='aviso.php' method='post'>
                                    <input type='hidden' name='id_warn' value='$aviso[id_aviso]'> 
                                    <a href='#' class='btn btn-blog pull-right marginBottom10' onclick='this.parentNode.submit()'>Continuar Leitura</a>
                                </form>  
                            </p>
                            </article>
                            
                        </div>
                    </div>
               
            ";
            }
        }
        //print_r($fetch);
        ?>
    </section>
</body>

</html>