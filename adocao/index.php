<?php
session_start();
if (isset($_SESSION['logado'])) {
	$idusuario = $_SESSION['id_usuario'];
	$privilegio = $_SESSION['privilegio'];
}
require_once "../utils/conexao.php";
// PAGINACAO
// VERIFICAR SE ESTA SENDO PASSADO A NA URL A PAG ATUAL, SENAO E ATRIBUIDO A PAG 1
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<link rel="stylesheet" href="estilos/ong.css">
	<title>Patas - WAAP</title>
</head>
<body>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
			<a href="../" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
				<img src="../assets/Logoparalela.png" class="logo" alt="Logo" title="Logo Waap">
		</a>

		<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
			<li><a href="../" class="nav-link px-2 link-dark">Início</a></li>
			<li><a href="../adocao/" class="nav-link px-2 link-dark">Adote</a></li>
			<li><a href="../ong/ongs.php" class="nav-link px-2 link-dark">ONGs</a></li>
			<li><a href="../sobre-nos/" class="nav-link px-2 link-dark">Sobre Nós</a></li>
		</ul>
		<?php
		if (isset($privilegio)) {
			switch ($privilegio) {
				case 0:
					echo '
						<div class="col-md-3 menus-nav text-end">
							<a href="../painel/admin/" class=""><button type="button" class="btn btn-outline-primary me-2">Painel</button></a>
							<a href="../sair.php" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
						</div>
					';
					break;
				case 1:
					echo '								
						<div class="col-md-3 menus-nav text-end">
							<a href="../painel/ong/index.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
							<a href="../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
							<a href="../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
						</div>								
					';
					break;
				default:
					echo "								
						<div class='col-md-3 menus-nav text-end'>
							<a href='../gerenciamento-conta/dados.php?id_usuario=$idusuario' title='Configurações' class=''><button type='button' class='btn btn-outline-primary me-2'><ion-icon name='settings-outline'></ion-icon></button></a>
							<a href='../sair.php' title='Sair' class=''><button type='button' class='btn btn-primary'><ion-icon name='log-out-outline'></ion-icon></button></a>
						</div>								
					";
					break;
				}
			}else{
			echo '
				<div class="col-md-3 menus-nav text-end">
					<a href="../login/" class=""><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
					<a href="../cadastro/" class=""><button type="button" class="btn btn-primary">Cadastre-se</button></a>
				</div>
			';
			}
		?>
		<div class="col-md-3 text-end">
		</div>
	</header>
	<h1 class='title'>Animais cadastrados</h1>
	<section class='home-section'>
	<hr>
		<div class="container">
			<form method="GET">
				<div class="row">
					<div class="col-md-12 sm-12 d-flex justify-content-center">
						<h3 class="title">Filtro</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-4 col-xs-12">
						<p>Sexo</p>
						<input type="radio" name="sexo" value="m">Macho
						<input type="radio" name="sexo" value="f">Fêmea
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<p>Porte</p>
						<input type="radio" name="porte" value="p"> Pequeno 
						<input type="radio" name="porte" value="m"> Médio 						
						<input type="radio" name="porte" value="g"> Grande	 					
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12">
						<p>Especie</p>
						<input type="radio" name="espec" value="1">Cachorro
						<input type="radio" name="espec" value="2">Gato
					</div>
				</div> 
				<input type="submit" name="" value="filtrar">
			</form>
			<div class="row">
				<div class="col">
	<?php
	$queryongs = "SELECT a.*,o.nome nomeong FROM animal a INNER JOIN ong o ON o.id_ong = a.id_ong";
	if(!empty($_GET)){

		$queryongs .= " WHERE (1=1) ";
		$queryongs .= " AND o.status_ong = 1 ";
		if(isset($_GET["sexo"])){
			$sexo = $_GET["sexo"];
			$queryongs .= " AND a.sexo = '$sexo'";
		}
		if(isset($_GET['porte'])){
			$porte = $_GET["porte"];
			$queryongs .= " AND a.porte = '$porte'";
		}
		if(isset($_GET['espec'])){
			$espec = $_GET['espec'];
			$queryongs .= " AND a.especie = $espec ";
		}
	}
	$execongs = mysqli_query($conexao, $queryongs);
	$totalanimal = mysqli_num_rows($execongs);

	// definir a quantidade de animais por pagina

	$quantidade_pag = 8;

	// CALCULAR O NUMERO DE PAG NECESSARIA PARA APRESENTAR OS ANIMAIS

	$num_pag = ceil($totalanimal/$quantidade_pag);

	//CALCULAR O INICIO DA VISU

	$inicio = ($quantidade_pag*$pagina)-$quantidade_pag;

	//Selecionar os animais a serem apresentados

	$result_animais = "SELECT a.*,o.nome nomeong FROM animal a INNER JOIN ong o ON o.id_ong = a.id_ong";
	if(!empty($_GET)){
		$result_animais .= " WHERE (1=1) ";
		$result_animais .= " AND o.status_ong = 1 ";
		if(isset($_GET["sexo"])){
			$sexo = $_GET["sexo"];
			$result_animais .= " AND a.sexo = '$sexo'";
		}
		if(isset($_GET['porte'])){
			$porte = $_GET["porte"];
			$result_animais .= " AND a.porte = '$porte'";
		}
		if(isset($_GET['espec'])){
			$espec = $_GET['espec'];
			$result_animais .= " AND a.especie = '$espec' ";
		}
		
	}

	$result_animais .=" ORDER BY id_animal DESC limit $inicio, $quantidade_pag";
	
	$resultado_animais = mysqli_query($conexao, $result_animais);

	$totalanimal = mysqli_num_rows($resultado_animais);

	
	while ($dadosong = mysqli_fetch_array($resultado_animais)) {
		echo "
			<div class='card' style='width: 15rem;' id='animais_list'>
				<img class='card-img-top' width='200px' height='200px' src='../assets/animais/$dadosong[foto]' alt='Card image cap'>
			<hr>
			<div class='card-body'>
				<h5 class='card-title'>$dadosong[nome]</h5>
				<p class='card-text'>$dadosong[nomeong]</p>
				<a href='../animal/index.php?id=$dadosong[id_animal]' class='btn btn-primary'>Veja-Mais</a>
				</div>
			</div>
		";
	}

	?>
	<p>
		<?php
			// VERIFICAR A PAGINA ANTERIOR E POSTERIOR
			$pagina_ant = $pagina - 1;
			$pagina_pos = $pagina + 1;

			// VERIFICAR FILTRO
			$filtro = "";
			if(!empty($_GET)){
					
				if(isset($_GET["sexo"])){
					$sexo = $_GET["sexo"];
					$filtro .= "&sexo=$sexo";
				}
				if(isset($_GET['porte'])){
					$porte = $_GET["porte"];
					$filtro .= "&porte=$porte";
				}
				if(isset($_GET['espec'])){
					$espec = $_GET['espec'];
					$filtro .= "&espec=$espec";
				}
			}
		?>
		

		<nav aria-label="Page navigation example">
		  <ul class="pagination justify-content-end">
		    <li class="page-item disabled">
		    	<?php 
		    		if ($pagina_ant != 0) { ?>
						
		    			<li class="page-item">
		    			  <a class="page-link" href="index.php?pagina=<?php echo $pagina_ant.$filtro; ?>">Anterior</a>
		    			</li>
						<li class="page-item">
		    			  <a class="page-link" href="index.php?pagina=<?php echo $pagina_ant.$filtro; ?>"><?php echo $pagina_ant; ?></a>
		    			</li>
		    	<?php }else{ ?>
		    	<li class="page-item disabled">
		    		<a class="page-link" href="#">Anterior</a>
		    	</li>
		    <?php }	?>
		    </li>
		    <?php 
		   
		    /*for ($i = 1; $i < $num_pag + 1; $i++){ 
				
		    	echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$i$filtro'>$i</a></li>";
		    } */
			?>

		    <li class="page-item">
				<?php 
		    		if ($pagina_pos <= $num_pag) { 
						echo "<li class='page-item disabled'><a class='page-link' href='#'>$pagina</a></li>";
						echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$pagina_pos$filtro'>$pagina_pos</a></li>";
						?>
		    			<li class="page-item">
		    				<a class="page-link" href="index.php?pagina=<?php echo $pagina_pos.$filtro; ?>">Proximo</a>
		    			</li>
		    		<?php }else{ ?>
						<?php 
							echo "<li class='page-item disabled'><a class='page-link' href='#'>$pagina</a></li>";
						?>
		    		<li class="page-item disabled">
						
		    			<a class="page-link" href="#">Proximo</a>
		    		</li>
		    	<?php }	?>
		    </li>
		  </ul>
		</nav>
	</p>
	</div>
		</div>
			</div>

	<div class="container">
		<footer class="py-5">
			<div class="row">
				<div class="col-22">
					<h5>Wanna Adopt a Pet</h5>
					<ul class="nav flex-column">
						<li class="nav-item mb-2"><a href="./" class="nav-link p-0 text-muted">Início</a></li>
						<li class="nav-item mb-2"><a href="./adocao/" class="nav-link p-0 text-muted">Adote</a></li>
						<li class="nav-item mb-2"><a href="./ong/ongs.php" class="nav-link p-0 text-muted">ONGs</a></li>
						<li class="nav-item mb-2"><a href="./sobre-nos/" class="nav-link p-0 text-muted">Sobre</a></li>
					</ul>
				</div>

				<div class="col-2">
					<h5>Contatos</h5>
					<ul class="nav flex-column">
						<li class="nav-item mb-2 p-0 text-muted">
							<ion-icon name="mail-unread-outline"></ion-icon> contato@waap.com
						</li>
						<li class="nav-item mb-2 p-0 text-muted">
							<ion-icon name="bug-outline"></ion-icon> bounty@waap.com
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
					<form>
						<h5>Inscreva-se no nosso newsletter</h5>
						<p>Receba noticias sobre nosso site e sobre o mundo pet.</p>
						<div class="d-flex w-100 gap-2">
							<label for="newsletter1" class="visually-hidden">Endereço de E-mail</label>
							<input id="newsletter1" type="text" class="form-control" placeholder="Endereço de E-mail">
							<button class="btn btn-primary" type="button">
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
	</section>
</body>

</html>
