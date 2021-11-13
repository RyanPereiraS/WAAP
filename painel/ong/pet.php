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
    $query = "SELECT u.nome, e.nome, e.id_ong FROM usuario u INNER JOIN ong e ON e.id_usuario = u.id_usuario WHERE u.id_usuario = $_SESSION[id_usuario]";
    $sql = mysqli_query($conexao, $query);
    $usuario = mysqli_fetch_array($sql);
}
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
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
    <link rel="stylesheet" href="css/core.css">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="stylesheet" href="css/animate.css">
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
    <section class='home-section'>
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="jumbotron">
                        <h1 class="display-5">Pets Cadastrados</h1>
                    </div>
                    <hr class="featurette-divider">

                </div>
            </div>
        </div>


    
        <?php
        if(isset($_GET['animal'])){
            $sql = "SELECT * FROM animal a INNER JOIN ong o on o.id_ong = a.id_ong INNER JOIN raca r on r.id_raca = a.raca WHERE id_animal = $_GET[animal] AND a.id_ong = $_SESSION[id_ong]";
            
            $exe = mysqli_query($conexao, $sql);
            if(mysqli_num_rows($exe) != 1) echo "<script>location.href='pet.php'</script>";
            $fetch = mysqli_fetch_array($exe);
            echo"
                <div class='container'>
                    <div class='row'>
                        <div class='col'>  
                            <table class='table table-hover'>
                                <thead class='table-light'>
                                    <p>
                                        <th scope='row'>Informações do Animal</th>
                                        <td></td>
                                    </p>
                                </thead>
                                <thead>
                                    <tr>
                                        <td>
                                            <div class='img-espec'>
                                                <img class='card-img-top' width='250px' src='../../assets/animais/$fetch[foto]'></td>
                                            </div
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope='row' class='table-active'>Nome</th>
                                        <td>$fetch[2]</td>
                                    </tr>
                                    <tr>
                                        <th scope='row' class='table-active'>Sexo/Idade</th>
                                        <td>
                                        ";
                                            if($fetch['sexo'] == 'm'){
                                                echo $simbolo = "<svg xmlns='http://www.w3.org/2000/svg' width='30px' height='30px' fill='currentColor' class='bi bi-gender-male'viewBox='0 0 16 16' id='simb'> <path fill-rule='evenodd' d='M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z'/></svg>
                                                , $fetch[idade] Ano(s)";
                                            }else{
                                                echo $simbolo = "<svg xmlns='http://www.w3.org/2000/svg' width='30px' height='30px' fill='currentColor' class='bi bi-gender-female' viewBox='0 0 16 16' id='simb'><path fill-rule='evenodd' d='M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z'/></svg>
                                                , $fetch[idade] Ano(s)";
                                            }
                                            echo"               
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope='row' class='table-active'>Porte</th>
                                        <td class='align-top'>
                                        ";
                                            switch ($fetch["porte"]) {
                                                case "0":
                                                    echo "Pequeno";
                                                break;
                                                case "1":
                                                    echo "Médio";
                                                break;
                                                default:
                                                    echo "Grande";
                                                break;
                                            }
                                    echo"
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope='row' class='table-active'>Raça</th>
                                        <td>$fetch[30]</td>
                                    </tr>
                                    <tr>
                                        <th scope='row' class='table-active''>História</th>
                                        <td>
                                            $fetch[historia_animal]</td>
                                    </tr>
                                    <tr>
                                        <th scope='row' class='table-active''>Vacinas</th>
                                        <td>

                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope='row' class='table-active'>Protetora</th>
                                        <td>$fetch[12]</td>
                                    </tr>
                                    <tr>
                                        <th scope='row' class='table-active'>Ações</th>
                                        <td>                                
                                            <a href='atualizar-animal.php?id_animal=$fetch[0]'><button type='submit' class='btn btn-primary'>Atualizar</button></a>
                                            
                                            <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#confirmar-delete'>Deletar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                         </div>
                        </div>
                    </div>
                </div>
            ";
        }else{
            $query = "SELECT a.*, r.raca FROM animal a INNER JOIN raca r ON r.id_raca = a.raca WHERE id_ong = $usuario[2]";
            $exe = mysqli_query($conexao, $query);
            $totaldeanimal = mysqli_num_rows($exe);

            $quantidade_pg = 12;

            $num_pag = ceil($totaldeanimal/$quantidade_pg);

            $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;

            $result_pet = "SELECT a.*, r.raca FROM animal a INNER JOIN raca r ON r.id_raca = a.raca WHERE id_ong = $usuario[2] ORDER BY id_animal DESC limit $inicio, $quantidade_pg"; 
            $resultado_animal = mysqli_query($conexao, $result_pet);

            $totalanimal = mysqli_num_rows($resultado_animal);

            while ($dados = mysqli_fetch_array($resultado_animal)){
                if($dados['sexo'] == 'm'){
                $simbolo = "<svg xmlns='http://www.w3.org/2000/svg' width='30px' height='30px' fill='currentColor' class='bi bi-gender-male'viewBox='0 0 16 16' id='simb'> <path fill-rule='evenodd' d='M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z'/></svg>
                ";
                }else{
                    $simbolo = "<svg xmlns='http://www.w3.org/2000/svg' width='30px' height='30px' fill='currentColor' class='bi bi-gender-female' viewBox='0 0 16 16' id='simb'><path fill-rule='evenodd' d='M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z'/></svg>
                    ";
                }
                $historia = mb_strimwidth($dados['historia_animal'], 0, 50, '...');
                echo "
                    
                <div id='card_pet'>
                    <div class='row'>
                        <div class='col'>
                            <div class='card'>
                                <img class='card-img-top'  width='100px' heigth='100px' src='../../assets/animais/$dados[foto]'>
                                <div class='card-body'>
                                    <h3 class='card-title'>$dados[nome] $simbolo</h3>
                                    <p class='card-text'>$historia</p>
                                    <ul class='list-group list-group-flush'>
                                    <h5><li class='list-group-item'>Raça: $dados[raca]</li></h5> 
                                    </ul>  
                                    <a href='pet.php?animal=$dados[0]' class='btn btn-primary'>Visualizar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                ";                  
            }
            echo"<p>";
			$pagina_ant = $pagina - 1;
			$pagina_pos = $pagina + 1;
            echo" 
            <nav aria-label='Page navigation example'>
              <ul class='pagination justify-content-end'>
                <li class='page-item disabled'>
            ";
                        if ($pagina_ant != 0) {
                            echo"
                                <li class='page-item'>
                                <a class='page-link' href='pet.php?pagina=$pagina_ant'>Anterior</a>
                                </li>
                            ";
                        }else{
                            echo"
                                <li class='page-item disabled'>
                                    <a class='page-link' href='#'>Anterior</a>
                                </li>
                            ";
                        }
                        echo"</li>";
                for ($i = 1; $i < $num_pag + 1; $i++){
                    echo"<li class='page-item'><a class='page-link' href='pet.php?pagina=$i'>$i</a></li>";
                }
    
                echo"<li class='page-item'>";
                
                if ($pagina_pos <= $num_pag) { 
                    echo"
                        <li class='page-item'>
                            <a class='page-link' href='pet.php?pagina=$pagina_pos'>Proximo</a>
                        </li>
                    ";
                }else{
                    echo"
                        <li class='page-item disabled'>
                            <a class='page-link' href='#'>Proximo</a>
                        </li>
                    ";
                }
                echo"
                            </li>
                        </ul>
                        </nav>
                    </p>
                    
                ";
        }
    ?>
    </section>
    
    <script src="js/jquery/jquery.js"></script>
    <script src="js/waypoint/jquery.waypoints.min.js"></script>
    <script src="js/core.js"></script>
    <!-- JavaScript Bundle with Popper -->

    <!--Modal-->
    <!--Modal confirmar-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <div class="modal fade" id="confirmar-delete" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atenção!</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>x</span></button>
                </div>
                <div class="modal-body">
                    <p>Deseja excluir o animal?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <button class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                        <?php echo"<input type='hidden' name='id_animal' value='$fetch[0]'>";?>
                        <button class="btn btn-danger" type="submit" name="deletar">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal deletado-->
    <div class="modal fade" id="deletado" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aviso</h5>
                    <a href='pet.php'><button type="button" class="close" data-bs-dismiss="modal"><span>x</span></button></a>
                </div>
                <div class="modal-body">
                    <p>Animal deletado com sucesso!</p>
                </div>
                <div class="modal-footer">
                    <a href="pet.php"><button class="btn btn-primary" data-bs-dismiss="modal">Voltar</button></a>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Erro ao deletar-->
    <div class="modal fade" id="erro" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atenção</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>x</span></button>
                </div>
                <div class="modal-body">
                    <p>Erro ao deletar animal</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>
    <!--FimModal-->
</body>

</html>
<?php
    if(isset($_POST['deletar'])){
        $query_delete_vac = "DELETE FROM vacina_animal WHERE id_animal = $_POST[id_animal]";
        $exec_delete_vac = mysqli_query($conexao, $query_delete_vac);
        if($query_delete_vac){
            $query_delete_animal = "DELETE FROM animal WHERE id_animal = $_POST[id_animal]";
            $exec_delete_animal = mysqli_query($conexao, $query_delete_animal);
            if($exec_delete_animal){
                unlink("../../assets/animais/$fetch[foto]");
                echo"
                    <script>
                        let deletado = document.getElementById('deletado');
                        let exec_deletado = new bootstrap.Modal(deletado);

                        exec_deletado.show();
                    </script>
                ";
            }else{
                echo"
                    <script>
                        let erro = document.getElementById('erro');
                        let exec_erro = new bootstrap.Modal(erro);

                        exec_erro.show();
                    </script>
                ";
            }
        }
    }
?>