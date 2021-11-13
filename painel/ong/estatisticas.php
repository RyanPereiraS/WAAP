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
    $query = "SELECT u.nome, e.nome, e.id_ong, e.visitas FROM usuario u INNER JOIN ong e ON e.id_usuario = u.id_usuario WHERE u.id_usuario = $_SESSION[id_usuario]";
    $sql = mysqli_query($conexao, $query);
    $query4 = "SELECT SUM(visitas) FROM ong";
    $visitastotal = mysqli_query($conexao, $query4);
    $total = mysqli_fetch_array($visitastotal);
    $total = $total[0];
    
    $usuario = mysqli_fetch_array($sql);
    $query2 = "SELECT COUNT(*) FROM animal WHERE id_ong = $usuario[2]";
    $sql2 = mysqli_query($conexao, $query2);
    $pets = mysqli_fetch_array($sql2);
    $query3 = "SELECT COUNT(*) FROM animal";
    $sql3 = mysqli_query($conexao, $query3);
    $petsgeneral = mysqli_fetch_array($sql3);
}
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
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
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
        <div class="container">
            <div class="col">
                <div class="row">
                <div class="jumbotron" id="camp_alterar">
                    <h1 class="display-4">Estatísticas</h1>
                    <hr>
                    <h1 class="display-5">Pets</h1>
                    <div class="row gx-2 gx-lg-3">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <div class="card card-hover-shadow h-100">
                                <div class="card-body">
                                    <h6 class="card-subtitle">Pet's</h6>
                                    <div class="row align-items-center gx-2 mb-1">
                                        <div class="col-6">
                                            <span class="card-title h2"><?php echo $pets[0] ?></span>
                                        </div>
                                        <div class="col-6">
                                            <!-- Chart -->
                                            <div class="chartjs-custom" style="height: 3rem;">
                                                <div class="chartjs-size-monitor">
                                                    <div class="chartjs-size-monitor-expand">
                                                        <div class=""></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink">
                                                        <div class=""></div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- End Chart -->
                                        </div>
                                    </div>
                                    <!-- End Row -->

                                    <span class="badge badge-soft-success">
                                        <i class="tio-trending-up"></i>
                                    </span>
                                    <span class="text-body font-size-sm ml-1">De <?php echo $petsgeneral[0] ?></span>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                    </div>
                    <h1 class="display-5">Visitas</h1>
                    
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <div class="card card-hover-shadow h-100" href="#">
                                <div class="card-body">
                                    <h6 class="card-subtitle">Visitas</h6>

                                    <div class="row align-items-center gx-2 mb-1">
                                        <div class="col-6">
                                            <span class="card-title h2"><?php echo $usuario[3]; ?></span>
                                        </div>

                                        <div class="col-6">
                                            <!-- Chart -->
                                            <div class="chartjs-custom" style="height: 3rem;">
                                                <div class="chartjs-size-monitor">
                                                    <div class="chartjs-size-monitor-expand">
                                                        <div class=""></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink">
                                                        <div class=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Chart -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                    <span class="badge badge-soft-success">
                                        <i class="tio-trending-up"></i>
                                    </span>
                                    <span class="text-body font-size-sm ml-1">De <?php echo $total; ?></span>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>
</body>

</html>
<?php

?>