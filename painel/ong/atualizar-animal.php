<?php
	session_start();

	if (!isset($_SESSION['logado'])) {
		echo "
				<script>
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
		$privilegio = $_SESSION['privilegio'];
		$idanimal = $_GET['id_animal'];
	}
	require_once "../../utils/conexao.php";
	echo $query_animal = "SELECT * FROM animal WHERE id_animal = $idanimal";
	$exec_animal = mysqli_query($conexao, $query_animal);
	$fetch_animal = mysqli_fetch_array($exec_animal);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/core.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>
        Atualizar Animal
    </title>
</head>

<body>  
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="../../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none" id="logo_cadastro_animal">
            <img src="../../assets/Logoparalela.png" class="logo" alt="Logo" title="Logo Waap">
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="../../index.php" class="nav-link px-2 link-dark">Início</a></li>
            <li><a href="../../adocao" class="nav-link px-2 link-dark">Adote</a></li>
            <li><a href="../../ong/ongs.php" class="nav-link px-2 link-dark">ONGs</a></li>
            <li><a href="../../sobre-nos/index.php" class="nav-link px-2 link-dark">Sobre Nós</a></li>
        </ul>
        <?php
        if (isset($privilegio)) {
            switch ($privilegio) {
                case 0:
                    echo '
						<div class="col-md-3 menus-nav text-end">
							<a href="../admin/" class=""><button type="button" class="btn btn-outline-primary me-2">Painel</button></a>
							<a href="../../sair.php" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
						</div>
					';
                    break;
                case 1:
                    echo '
						<div class="col-md-3 menus-nav text-end">
							<a href="index.php" title="Painel ONG" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
							<a href="../../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
							<a href="../../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
						</div>
					';
                    break;
                default:
                    echo '
						<div class="col-md-3 menus-nav text-end">
						  <a href="../../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
						  <a href="../../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
						</div>
					';
                    break;
                }
            }else{
            echo '
				<div class="col-md-3 menus-nav text-end">
                    <a href="../../login/" class=""><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
                    <a href="../../cadastro/" class=""><button type="button" class="btn btn-primary">Cadastre-se</button></a>
                </div>
			';
        }
        ?>
    </header>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron">
                    <br>
                    <h1 class="display-5">Cadastrar Animal</h1>
                    <p class="lead">Cadastre seus 'animaizinhos' para que nossos Usuários possam velos e se tiver interesse, Adotá-los</p>
                    <hr>
				</div>

                <form method='POST' enctype='multipart/form-data'>

                	<div class='mb-3'>
                    	<h5><label class='form-label'>Nome Do Animal:</label></h5>
                    	<input type='text' class='form-control' value='<?php echo"$fetch_animal[2]"?>' name='nome'>
                	</div>
            
					<div class='mb-3'>
						<h5><label class='form-label'>Idade:</label></h5>
						<input type='number' class='form-control' value='<?php echo"$fetch_animal[3]"?>' name='idade'>
					</div>
			
					<hr>
        
					<div class='col-sm-6'>
						<div class='card'>
							<div class='card-body'>
								<h4><p id='selects'>Sexo:</h4>
                                    <?php
                                        if($fetch_animal["sexo"] == "m"){
                                            echo"
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' value='m' checked type='radio' name='sexo' id='inlineRadio1'>
                                                    <h5><label class='form-check-label' for='inlineRadio1' >Macho</label></h5>
                                                </div>
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' value='f' type='radio' name='sexo' id='inlineRadio2' >
                                                    <h5><label class='form-check-label' for='inlineRadio2' >Fêmea</label></h5>
                                                </div>
                                            ";
                                        }else{
                                            echo"                                      
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' value='m' type='radio' name='sexo' id='inlineRadio1'>
                                                    <h5><label class='form-check-label' for='inlineRadio1' >Macho</label></h5>
                                                </div>
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' checked value='f' type='radio' name='sexo' id='inlineRadio2' >
                                                    <h5><label class='form-check-label' for='inlineRadio2' >Fêmea</label></h5>
                                                </div>
                                            ";
                                        }

                                    ?>
                                </p>
							</div>
						</div>
					</div>
					<br>
					<div class='col-sm-6'>
						<div class='card'>
							<div class='card-body'>
								<h4><p id='selects'>Porte Do Animal:</h4>
                                    <?php
                                        switch ($fetch_animal['porte']) {
                                            case 'p':
                                                echo"
                                                    <div class='form-check form-check-inline'>
                                                        <input class='form-check-input' value='p' checked type='radio' name='porte' id='inlineRadio3'>
                                                        <h5><label class='form-check-label' for='inlineRadio3'>Pequeno</label></h5>
                                                    </div>
                                                    <div class='form-check form-check-inline'>
                                                        <input class='form-check-input' value='m' type='radio' name='porte' id='inlineRadio4'>
                                                        <h5><label class='form-check-label' for='inlineRadio4'>Médio</label></h5>
                                                    </div>
                                                    <div class='form-check form-check-inline'>
                                                        <input class='form-check-input' value='g' type='radio' name='porte' id='inlineRadio5'>
                                                        <h5><label class='form-check-label' for='inlineRadio5'>Grande</label></h5>
                                                    </div>
                                                ";
                                            break;
                                            
                                            case 'm':
                                                echo"
                                                    <div class='form-check form-check-inline'>
                                                        <input class='form-check-input' value='p' type='radio' name='porte' id='inlineRadio3'>
                                                        <h5><label class='form-check-label' for='inlineRadio3'>Pequeno</label></h5>
                                                    </div>
                                                    <div class='form-check form-check-inline'>
                                                        <input class='form-check-input' value='m' checked type='radio' name='porte' id='inlineRadio4'>
                                                        <h5><label class='form-check-label' for='inlineRadio4'>Médio</label></h5>
                                                    </div>
                                                    <div class='form-check form-check-inline'>
                                                        <input class='form-check-input' value='g' type='radio' name='porte' id='inlineRadio5'>
                                                        <h5><label class='form-check-label' for='inlineRadio5'>Grande</label></h5>
                                                    </div>
                                                ";
                                            break;
                                            
                                            case 'g':
                                                echo"
                                                    <div class='form-check form-check-inline'>
                                                        <input class='form-check-input' value='p' type='radio' name='porte' id='inlineRadio3'>
                                                        <h5><label class='form-check-label' for='inlineRadio3'>Pequeno</label></h5>
                                                    </div>
                                                    <div class='form-check form-check-inline'>
                                                        <input class='form-check-input' value='m' type='radio' name='porte' id='inlineRadio4'>
                                                        <h5><label class='form-check-label' for='inlineRadio4'>Médio</label></h5>
                                                    </div>
                                                    <div class='form-check form-check-inline'>
                                                        <input class='form-check-input' checked value='g' type='radio' name='porte' id='inlineRadio5'>
                                                        <h5><label class='form-check-label' for='inlineRadio5'>Grande</label></h5>
                                                    </div>
                                                ";
                                            break;
                                            
                                        }

                                    ?>
								</p>
							</div>
						</div>
					</div>

					<h4><label for='exampleDataList' class='form-label'>Historia:</label></h4>
                        <div class='form-floating'>
                            <textarea class='form-control' name='desc' placeholder='História do animal' id='floatingTextarea2' style='height: 100px'><?php echo$fetch_animal[5]?></textarea>
                            <label for='floatingTextarea2'>Conte-nos...</label>
                            <figcaption class='figure-caption'>Conte-nos mais sobre esse animalzinho fofo.</figcaption>
                        </div>
					<br>
			
					<h4><label for='exampleDataList' class='form-label'>Raças</label></h4>
					<select name='raca' class='form-select' id='datalistOptions' aria-placeholder='Selecione a raça'>
                    <?php
                        $query = "SELECT id_raca, raca FROM raca WHERE id_raca = $fetch_animal[9]";
                        $exec = mysqli_query($conexao, $query);
                        $fetch_raca = mysqli_fetch_array($exec);
                        echo"<option value='$fetch_animal[9]'>$fetch_raca[1]</option>";
     
						$queryraca = "SELECT id_raca,raca FROM raca WHERE especie = $fetch_animal[6] AND id_raca <> $fetch_animal[9] ORDER BY raca ASC";
						$execraca = mysqli_query($conexao, $queryraca);
						while ($tableraca = mysqli_fetch_array($execraca)) {
							echo"<option value='$tableraca[id_raca]'> $tableraca[raca]</option>";
						}
					?>
					
					</select>
					<br>
					<h4><p id='selects'>Vacinas:</h4>
					<?php

						echo $queryvac = "SELECT id_vacina, vacina FROM vacina WHERE especie = $fetch_animal[6] ORDER BY vacina ASC";
						$execvac = mysqli_query($conexao, $queryvac);
						while ($vac = mysqli_fetch_array($execvac)) {
                            $query_tem_vac = "SELECT * FROM vacina_animal WHERE id_animal = $idanimal AND id_vacina = $vac[id_vacina]";
                            $exec_tem_vac = mysqli_query($conexao, $query_tem_vac);
                            $rows_tem_vac = mysqli_num_rows($exec_tem_vac);
                            if($rows_tem_vac == 0){
                                echo"
                                    <div class='form-check form-switch'>
                                        <input class='form-check-input' role='switch' type='checkbox' name='vac[]' id='iflexSwitchCheckDefault' value='$vac[id_vacina]'>$vac[vacina]
                                    </div>
                                ";
                            }else{
                                echo"
                                    <div class='form-check form-switch'>
                                        <input class='form-check-input' checked role='switch' type='checkbox' name='vac[]' id='iflexSwitchCheckDefault' value='$vac[id_vacina]'>$vac[vacina]
                                    </div>
                                ";
                            }
          
						}
					?>
					
					<br>
					<button class='w-100 btn btn-lg btn-primary botaosubmit' name='enviar' id='cadastrar_botao' type='submit'>Atualizar Animal</button>
                    <br>
					<hr>
			
					<div class='mb-3'>
						<h5><label for='formFile' class='form-label'>Insira uma foto do animal:</label></h5>
						<input class='form-control' name='foto' type='file' id='formFile'onchange='previewImagem()'><br>
						<img id='foto'  src="../../assets/animais/<?php echo $fetch_animal[8]?>"  style='width: 300px; height: 290px;'>
					</div>
					<script>
						function previewImagem() {
							var imagem = document.querySelector('input[name=foto]').files[0];
							//var preview = document.querySelector('img');
							var preview = document.getElementById('foto');
			
							var reader = new FileReader();
			
							reader.onloadend = function() {
								preview.src = reader.result;
							}
			
							if (imagem) {
								reader.readAsDataURL(imagem);
							} else {
								preview.src = '';
							}
						}
					</script>

                    <button class='w-100 btn btn-lg btn-primary botaosubmit' name='atualizar' id='cadastrar_botao' type='submit'>Atualizar Foto</button>
                    <br>
					<hr>
                </form>
    		</div>
		</div>
	</div>

    <hr class="featurette-divider">
    <div class="container">
        <footer class="py-5">
            <div class="row">
                <div class="col-2">
                    <h5>Wanna Adopt a Pet</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Início</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Adote</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">ONGs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Doe</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Emergência</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre</a></li>
                    </ul>
                </div>

                <div class="col-2">
                    <h5>Contatos</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2 p-0 text-muted">
                            <ion-icon name="mail-unread-outline"></ion-icon> contato@waap.com.br
                        </li>
                        <li class="nav-item mb-2 p-0 text-muted">
                            <ion-icon name="bug-outline"></ion-icon> bugbounty@waap.com.br
                        </li>
                        <li class="nav-item mb-2 p-0 text-muted">
                            <ion-icon name="call-outline"></ion-icon> (11) 5555-5555
                        </li>
                        <li class="nav-item mb-2 p-0 text-muted">
                            <ion-icon name="logo-whatsapp"></ion-icon> (11) 99999-9999
                        </li>
                    </ul>
                </div>

                <div class="col-4 offset-1">
                    <form method="POST">
                        <h5>Inscreva-se no nosso newsletter</h5>
                        <p>Receba noticias sobre nosso site e sobre o mundo pet.</p>
                        <div class="d-flex w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Endereço de E-mail</label>
                            <input id="newsletter1" type="text" class="form-control" name="email" placeholder="Endereço de E-mail">
                            <button class="btn btn-primary" name="newsletter" type="submit">
                                <ion-icon class="iconfooter" name="send-outline"></ion-icon>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex justify-content-between py-4 my-4 border-top">
                <p>© 2021 Wanna Adopt a Pet, Todos direitos reservados.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#">
                            <ion-icon class="iconfooter" name="logo-instagram"></ion-icon>
                        </a></li>
                    <li class="ms-3"><a class="link-dark" href="#">
                            <ion-icon class="iconfooter" name="logo-facebook"></ion-icon>
                        </a></li>
                    <li class="ms-3"><a class="link-dark" href="#">
                            <ion-icon class="iconfooter" name="logo-twitter"></ion-icon>
                        </a></li>
                </ul>
            </div>
        </footer>
    </div>
</body>

</html>
<?php
    if (isset($_POST['enviar'])) {
        echo $_POST['raca'];
        if (strlen($_POST['nome']) > 30  ||  empty($_POST['nome'])) {
            echo "<script>
                        alert('Nome invalido');
                    </script>
                ";
        } else if (strlen($_POST['idade']) > 2 || empty($_POST['idade'])) {
            echo "<script>
                        alert('idade invalida');
                        history.back();
                    </script>
                ";
        } else if (empty($_POST['sexo'])) {
            echo "<script>
                        alert('Preencha o sexo do animal');
                        history.back();
                    </script>
                ";
        } else if (empty($_POST['desc'])) {
            echo "<script>
                        alert('Preencha a Descrição do animal');
                        history.back();
                    </script>
                ";
        } else if (empty($_POST['porte'])) {
            echo "<script>
                        alert('Selecione o porte do animal');
                        history.back();
                    </script>
                ";
        } else if (empty($_POST['raca'])) {
            echo "<script>
                        alert('Selecione a raça do animal');
                        history.back();
                    </script>
                ";
        } else {
            $nome = $_POST['nome'];
            $idade = $_POST['idade'];
            $sexo = $_POST['sexo'];
            $desc = $_POST['desc'];
            $porte = $_POST['porte'];
            $especie = $fetch_animal[6];
            $raca = $_POST['raca'];

            $idong=$fetch_animal[1];      

            $sql="UPDATE animal SET nome= '$nome', idade =$idade, sexo = '$sexo', historia_animal = '$desc', porte = '$porte', raca =$raca WHERE id_animal = $fetch_animal[0]";
            $inserir=mysqli_query($conexao,$sql);
            $query_delete_vac = "DELETE FROM vacina_animal WHERE id_animal = $fetch_animal[0]";
            $exec_delete_vac = mysqli_query($conexao, $query_delete_vac);    
            foreach($_POST['vac'] as $vacina){     
                $queryvac="INSERT INTO vacina_animal (id_animal,id_vacina)VALUES($fetch_animal[0],$vacina)";
                $inserevac=mysqli_query($conexao,$queryvac);
            }

            if($inserir==1){
                echo "
                    <script>
                        alert('Dados do animal atualizados com sucesso!');
                        location.href='pet.php';
                    </script>";
            }else{
                echo $sql;           
            }
        }
    }
    if(isset($_POST['atualizar'])){
        if(isset($_FILES['foto'])){
            $img = $_FILES['foto'];
        
            $dimension = getimagesize($img['tmp_name']);
            $pegarext = pathinfo($img['name'], PATHINFO_EXTENSION);
            if(preg_match('/\.(jpg|png|jpeg)$/', $pegarext)) {
                echo "A";
            }
            if($img['error'] == 4){
                echo"<script>
                        alert('Envie uma foto do animal');
                        history.back();
                    </script>
                ";
            }else if($img['error']==1){
                echo "A";
                echo"<script>
                        alert('Arquivo muito grande');
                        history.back();
                    </script>
                ";
            }else if(!in_array($pegarext, array('jpg', 'png', 'jpeg'))){
                echo"<script>
                        alert('Utilize apenas fotos com os formatos: jpg, png ou jpeg');
                        history.back();
                    </script>
                ";
            }else{           
                $nomeimagem= md5(uniqid(time())).".".$pegarext;
                unlink("../../assets/animais/$fetch_animal[8]");
                $sql_atualizar="UPDATE animal SET foto = '$nomeimagem' WHERE id_animal = $fetch_animal[0]";
                $inserir_atualizar = mysqli_query($conexao, $sql_atualizar); 
                if($inserir_atualizar==1){
                    $up= move_uploaded_file($img['tmp_name'],"../../assets/animais/".$nomeimagem);    
                    echo "
                        <script>
                            alert('Foto atualizada com sucesso!');
                            location.href='pet.php';
                        </script>";
                  }else{
                    echo $sql_atualizar;               
                }
            } 
        }else{
            echo"erro";
        }
    }else{
        echo"erro";
    }
?>