<?php
	session_start();
		require_once "../../utils/config.php";
		require_once "../../utils/conexao.php";
		$idusuario = $_SESSION['id_usuario'];
		$privilegio = $_SESSION['privilegio'];
		$nomeusuario = $_SESSION['usuario'];
		$idong = $_GET['id'];

		function get_endereco($cep)
		{
			$cep = preg_replace("/[^0-9]/", "", $cep);
			$url = "http://viacep.com.br/ws/$cep/xml/";
			$xml = simplexml_load_file($url);
			return $xml;
		}

		$query = "SELECT o.* FROM ong o WHERE o.id_ong = $idong";
		$exec = mysqli_query($conexao, $query);
		if ($exec) {
			if (mysqli_num_rows($exec) == 1) {
				$fetch = mysqli_fetch_array($exec);
				/*$cep = explode("-", $fetch['cep']);
				$cep = $cep[0] . $cep[1];
				$endereco = get_endereco($cep);*/
			}
		}
		if($privilegio != 0){ //ARRUMAR ESSA VALIDAÇAO DEPOIS (RETIRAR O || $privilegio == 1)
		echo"
			<script>
				alert('Você não tem permições administratívas para acessar essa pagina.');
				location.href= '../../'
			</script>
		";
	}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
		<link rel="stylesheet" href="estilos/validar_ong.css">
		<title><?php echo $fetch[2]?> - WAAP</title>
    </head>
    <body>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script>
			$('.carousel').carousel({
				interval: 1000
			})
		</script>
		<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
			<a href="../../" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
				<img src="../../assets/Logoparalela.png" class="logo" alt="Logo" title="Logo Waap">
			</a>
		
			<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
			<li><a href="../../index.php" class="nav-link px-2 link-dark">Início</a></li>
                <li><a href="../../adocao" class="nav-link px-2 link-dark">Adote</a></li>
                <li><a href="../../ong/ongs.php" class="nav-link px-2 link-dark">ONGs</a></li>
                <li><a href="../../sobre-nos" class="nav-link px-2 link-dark">Sobre Nós</a></li>
			</ul>
			<?php
				if(isset($privilegio)){
					switch($privilegio){
						case 0:
							echo'
								<div class="col-md-3 menus-nav text-end">
									<a href="#" class=""><button type="button" class="btn btn-outline-primary me-2">Painel</button></a>
									<a href="sair.php" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>
							';
						break;
						case 1:
							echo'
								<div class="col-md-3 menus-nav text-end">
								<a href="gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
								<a href="gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
								<a href="sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>
							';
						break;
						default:
							echo'
								<div class="col-md-3 menus-nav text-end">
								<a href="gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
								<a href="sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>
							';
						break;
					}
				}else{
					echo'
						<div class="col-md-3 menus-nav text-end">
						<a href="../../login/" class=""><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
						<a href="../../cadastro/" class=""><button type="button" class="btn btn-primary">Cadastre-se</button></a>
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
					<th scope="row">Informações de Cadastro</th>
					<td></td>
				</thead>
				<thead>
					<tr>
						<td><?php echo "<img src='../../assets/ong/logo/$fetch[logo]'>"; ?></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row" class="table-active">Nome</th>
						<td><?php echo $fetch['nome']; ?></td>
					</tr>
					<tr>
						<th scope="row" class="table-active">CNPJ</th>
						<td><?php echo $fetch["cnpj"]; ?></td>
					</tr>
					<tr>
						<th scope="row" class="table-active">Fundação</th>
						<td><?php echo $fetch["fundacao"] ?></td>
					</tr>
					
					<?php
					if ($fetch["complemento"] != '') {
						echo "<tr>
						<th scope='row' class='table-active'>Complemento</th>
						<td> $fetch[complemento] </td>
					</tr>";
					}

					if ($fetch["referencia"] != '') {
						echo "<tr>
						<th scope='row' class='table-active'>Referencia</th>
						<td> $fetch[referencia] </td>
					</tr>";
					}
					if ($fetch["email"] != '') {
						echo "<tr>
						<th scope='row' class='table-active'>Email</th>
						<td> $fetch[email] </td>
					</tr>";
					}
					if ($fetch["tel_fixo"] != '') {
						echo "<tr>
						<th scope='row' class='table-active'>Telefones</th>
						<td> $fetch[tel_fixo]"; if($fetch['whatsapp']!=''){echo $fetch['whatsapp'];}echo "</td>
					</tr>";
					}
					if ($fetch["descricao_ong"] != '') {
						echo "<tr>
						<th scope='row' class='table-active'>Missão</th>
						<td> $fetch[descricao_ong] </td>
					</tr>";
					}
					?>
					<tr>
					    <th scope="row" class="table-active">Ação</th>
					    <td class="align-top">
							<form action="" method='POST'>
								<button type="submit" name= "aprovar"class="btn btn-link">Aprovar</button>
								<button type="submit" name= "negar"class="btn btn-link">Negar</button>
							</form>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>   
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
							<li class="nav-item mb-2 p-0 text-muted"><ion-icon name="mail-unread-outline"></ion-icon> contato@waap.com.br</li>
							<li class="nav-item mb-2 p-0 text-muted"><ion-icon name="bug-outline"></ion-icon> bugbounty@waap.com.br</li>
							<li class="nav-item mb-2 p-0 text-muted"><ion-icon name="call-outline"></ion-icon> (11) 5555-5555</li>
							<li class="nav-item mb-2 p-0 text-muted"><ion-icon name="logo-whatsapp"></ion-icon> (11) 99999-9999</li>
						</ul>
					</div>
			
					<div class="col-4 offset-1">
						<form>
							<h5>Inscreva-se no nosso newsletter</h5>
							<p>Receba noticias sobre nosso site e sobre o mundo pet.</p>
							<div class="d-flex w-100 gap-2">
								<label for="newsletter1" class="visually-hidden">Endereço de E-mail</label>
								<input id="newsletter1" type="text" class="form-control" placeholder="Endereço de E-mail">
								<button class="btn btn-primary" type="button"><ion-icon class="iconfooter" name="send-outline"></ion-icon></button>
							</div>
						</form>
					</div>
				</div>
				<div class="d-flex justify-content-between py-4 my-4 border-top">
					<p>© 2021 Wanna Adopt a Pet, Todos direitos reservados.</p>
					<ul class="list-unstyled d-flex">
						 <li class="ms-3"><a class="link-dark" href="#"><ion-icon class="iconfooter" name="logo-instagram"></ion-icon></a></li>
						<li class="ms-3"><a class="link-dark" href="#"><ion-icon class="iconfooter" name="logo-facebook"></ion-icon></a></li>
						<li class="ms-3"><a class="link-dark" href="#"><ion-icon class="iconfooter" name="logo-twitter"></ion-icon></a></li>
					</ul>
				</div>
			</footer>
		</div>
    </body>
</html>
<?php
	if(isset($_POST['aprovar'])){
		$sql_aprovar = "UPDATE ong SET status_ong = 1 WHERE id_ong = $idong";
		$exec_atualizar = mysqli_query($conexao, $sql_aprovar);
		echo $update_usuario = "UPDATE usuario SET privilegio = 1 WHERE id_usuario = $fetch[1]";
		$exec_usuario = mysqli_query($conexao, $update_usuario);
		$sql = "SELECT u.email, u.nome,o.nome as ong FROM ong o INNER JOIN usuario u ON u.id_usuario = o.id_usuario WHERE id_ong = $idong";
		$exe = mysqli_query($conexao, $sql);
		$fetch = mysqli_fetch_array($exe);
		$dados = array(
			'email' => $fetch['email'],
			'nome' => $fetch['nome'],
			'ong' => $fetch['ong']
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://$host:$port/waap_oficial/web3/utils/ongaprovada.php");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		
		if($exec_atualizar){
			$_POST['aprovar'] = null;
			echo"
				<script>
					alert('Ong aprovada!');
					location.href='index.php'
				</script>
			";
		}
		
	}
	if(isset($_POST["negar"])){
		$sql_negar = "UPDATE ong SET status_ong = 2 WHERE id_ong = $idong";
		$exec_negar = mysqli_query($conexao, $sql_negar);
		if($exec_negar){
			$_POST['negar'] = null;
			echo"
				<script>
					alert('Ong negada!');
					location.href='index.php'
				</script>
			";
		}
	}
?>