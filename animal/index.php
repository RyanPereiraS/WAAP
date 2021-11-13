<?php
	session_start();
	require_once "../utils/conexao.php";
	if (!isset($_GET['id'])) {
		header('Location: ../');
	} else {
		$id = $_GET['id'];
		if (isset($_SESSION['logado'])) {
			$idusuario = $_SESSION['id_usuario'];
			$privilegio = $_SESSION['privilegio'];
			$nomeusuario = $_SESSION['usuario'];
		}
	}
	$sql = "SELECT *, r.raca as racanome FROM animal a INNER JOIN ong o on o.id_ong = a.id_ong INNER JOIN raca r on r.id_raca = a.raca WHERE id_animal = $id";
	$exe = mysqli_query($conexao, $sql);
	$fetch = mysqli_fetch_array($exe);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/ong.css">
	<title><?php echo $fetch['2']; ?> - WAAP</title>
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
			<li><a href="../sobre-nos/" class="nav-link px-2 link-secondary">Sobre Nós</a></li>
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
							<a href="../painel/ong/" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
							<a href="../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
							<a href="../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>
					';
					break;
				default:
					echo '
						<div class="col-md-3 menus-nav text-end">
							<a href="../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
							<a href="../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
						</div>
					';
					break;
			}
		} else {
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

	<div class="container">
		<div class="row">
			<table class="table table-hover">
				<thead class="table-light">
					<p>
						<th scope="row">Informações do Animal</th>
						<td></td>
					</p>
				</thead>
				<thead>
					<tr>
						<td><?php echo "<img class='card-img-top' width='250' src='../assets/animais/$fetch[foto]'>"; ?></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row" class="table-active">Nome</th>
						<td><?php echo $fetch['2']; ?></td>
					</tr>
					<tr>
						<th scope="row" class="table-active">Sexo/Idade</th>
						<td>
							<?php
								switch ($fetch['sexo']) {
									case "m":
										echo " <ion-icon name='male'></ion-icon>, " . $fetch["idade"];
										break;
									case "f":
										echo "<ion-icon name='female'></ion-icon>, " . $fetch["idade"];
										break;
								}
							
							?>		
						</td>
					</tr>
					<tr>
						<th scope="row" class="table-active">Porte</th>
						<td class="align-top">
							<?php
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
							?>
						</td>
					</tr>
					<tr>
						<th scope="row" class="table-active">Raça</th>
						<td><?php echo $fetch["racanome"]; ?></td>
					</tr>
					<tr>
						<th scope="row" class="table-active">História</th>
						<td><?php

							echo $fetch['historia_animal'] ?></td>
					</tr>

					<tr>
						<th scope="row" class="table-active">Protetora</th>
						<td><?php echo $fetch["12"]; ?></td>
					</tr>

					<tr>
						<th scope="row" class="table-active">Contato</th>
						<td class="align-top"><?php echo "<a href='../ong/pagina-ong.php?id=$fetch[id_ong]' class='btn btn-primary'>Ver Dados</a>"; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="container">
		<footer class="py-5">
			<div class="row">
				<div class="col-22">
					<h5>Wanna Adopt a Pet</h5>
					<ul class="nav flex-column">
						<li class="nav-item mb-2"><a href="../" class="nav-link p-0 text-muted">Início</a></li>
						<li class="nav-item mb-2"><a href="../adocao/" class="nav-link p-0 text-muted">Adote</a></li>
						<li class="nav-item mb-2"><a href="../ong/ongs.php" class="nav-link p-0 text-muted">ONGs</a></li>
						<li class="nav-item mb-2"><a href="../sobre-nos/" class="nav-link p-0 text-muted">Sobre</a></li>
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
</body>

</html>