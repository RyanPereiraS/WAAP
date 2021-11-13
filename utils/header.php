<?php 
    session_start();
    require_once 'conexao.php';
?>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link rel="stylesheet" href="css.css">
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
			<a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
				<img src="../assets/Logoparalela.png" class="logo" alt="Logo" title="Logo Waap">
			</a>
		
			<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
				<li><a href="index.php" class="nav-link px-2 link-dark">Início</a></li>
				<li><a href="adote/" class="nav-link px-2 link-dark">Adote</a></li>
				<li><a href="pagina-ong/ongs.php" class="nav-link px-2 link-dark">ONGs</a></li>
				<li><a href="sobre-nos/" class="nav-link px-2 link-dark">Sobre Nós</a></li>
			</ul>
			<?php
				if(isset($privilegio)){
					switch($privilegio){
						case 0:
							echo'
								<div class="col-md-3 menus-nav text-end">
									<a href="painel/admin/" class=""><button type="button" class="btn btn-outline-primary me-2">Painel</button></a>
									<a href="sair.php" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>
							';
						break;
						case 1:
							echo'								
								<div class="col-md-3 menus-nav text-end">
									<a href="painel/ong/" title="Painel" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
									<a href="gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
									<a href="sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>								
							';
						break;
						default:
							echo"								
								<div class='col-md-3 menus-nav text-end'>
									<a href='gerenciamento-conta/dados.php?id_usuario=$idusuario' title='Configurações' class=''><button type='button' class='btn btn-outline-primary me-2'><ion-icon name='settings-outline'></ion-icon></button></a>
									<a href='sair.php' title='Sair' class=''><button type='button' class='btn btn-primary'><ion-icon name='log-out-outline'></ion-icon></button></a>
								</div>								
							";
						break;
					}
				}else{
					echo'
						<div class="col-md-3 menus-nav text-end">
						<a href="login/" class=""><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
						<a href="cadastro/cadastro-usuario/" class=""><button type="button" class="btn btn-primary">Cadastre-se</button></a>
						</div>
					';
				}
			?>
			<div class="col-md-3 text-end">
			</div>
		</header>