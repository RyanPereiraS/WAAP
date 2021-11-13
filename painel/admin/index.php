<?php 
    session_start();
    require_once "../../utils/conexao.php";

    $privilegio = $_SESSION['privilegio'];
    $nomeusuario = $_SESSION['usuario'];
    $idadm = $_SESSION["id_usuario"];
    $query = "SELECT (SELECT COUNT(*) FROM usuario), (SELECT COUNT(*) FROM ong), (SELECT COUNT(*) FROM animal)";
    $executar = mysqli_query($conexao, $query);
    $fetch = mysqli_fetch_array($executar);
    
    if($privilegio == 0){ //ARRUMAR ESSA VALIDAÇAO DEPOIS (RETIRAR O || $privilegio == 1)
        echo"
            <script>
                alert('Seja bem vindo, $nomeusuario');
            </script>
        ";
    }else{
        echo"
            <script>
                alert('Você não tem permições administratívas para acessar essa pagina.');
            </script>
        ";
    }
?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
        <title>Painel ADM</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
		<link rel="stylesheet" href="estilos/estilo.css">
        <meta charsert='utf-8'>
    </head>
    <body>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="../../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
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
									<a href="../../sair.php" class=""><button type="button" class="btn btn-primary" id="botao_sair"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>
							';
						break;
						case 1:
							echo'
								<div class="col-md-3 menus-nav text-end">
									<a href="../ong/index.php" title="Painel" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
									<a href="../../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2" id="test"><ion-icon name="settings-outline"></ion-icon></button></a>
									<a href="../../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary" id="test2"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>	
							';
						break;
						default:
							echo'
								<div class="col-md-3 menus-nav text-end">
								<a href="../../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
								<a href="../../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
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
	    </header>
		<br>
		<div id='alert'>
			<?php
				$query = "SELECT id_ong, nome FROM ong WHERE status_ong = 0";
				$exec = mysqli_query($conexao, $query);
				$rowsong = mysqli_num_rows($exec);
				if($rowsong == 0){
					echo '
						<div class="alert alert-success" role="alert">
							<i class="bi bi-check2-all"></i> Nenhuma ONG aguarda aprovação!
						</div>
					';
				}else{
					echo "
						<div class='alert alert-warning' role='alert'>
							<i class='bi bi-exclamation-triangle-fill'></i> Existem $rowsong ONG(s) para serem aprovadas
						</div>
						
					";
				}
			?>
		</div>
		
		<div class="container">
			 <div class="row">
				<div class="col">	
				<div class="jumbotron" id="camp_alterar">
                      <h1 class="display-4" align='center'>Painel Do ADM</h1>
                      <p class="lead" align='center'>
                          Painel para solicitações de ONG's e envio de avisos.
                      </p>
                    </div>
                    <hr>
                    <br>

					<div class="card mb-3" style="max-width: 540px;">
					  <div class="row g-0">
					    <div class="col-md-4">
					      <img src="img/user.png" class="img-fluid rounded-start" alt="usuarios" width="230" height="230">
					    </div>
					    <div class="col-md-8">
					      <div class="card-body">
					        <h5 class="card-title text-center">Usuarios Cadastrados:</h5>
					        <h3><p class="card-text text-center">• <?php echo"$fetch[0]"?> Usuarios</p></h3>
					      </div>
					    </div>
					  </div>
					</div>
					<div class="card mb-3" style="max-width: 540px;">
					  <div class="row g-0">
					    <div class="col-md-4">
					      <img src="img/ong.png" class="img-fluid rounded-start" alt="ONG" width="250" height="250">
					    </div>
					    <div class="col-md-8">
					      <div class="card-body">
					        <h5 class="card-title text-center">ONG'S Cadastradas:</h5>
					        <h3><p class="card-text text-center">• <?php echo"$fetch[1]"?> ONG'S</p></h3>
					      </div>
					    </div>
					  </div>
					</div>
					<div class="card mb-3" style="max-width: 540px;">
					  <div class="row g-0">
					    <div class="col-md-4">
					      <img src="img/animaisperfil.jpeg" class="img-fluid rounded-start" alt="Animais" width="250" height="250">
					    </div>
					    <div class="col-md-8">
					      <div class="card-body">
					        <h5 class="card-title text-center">Animais Cadastrados</h5>
					        <h3><p class="card-text text-center">• <?php echo"$fetch[2]"?> Animais</p></h3>
					      </div>
					    </div>
					  </div>
					</div>
					<br>
					<br>

					<div class="d-grid gap-2">
					  <a href='../verificar-ong/index.php' class="btn btn-outline-primary" type="submit">Validar ONGS</a>
					  <a href='aviso.php' class="btn btn-outline-primary" type="submit">Postar aviso</a>
					</div>
	      </div>
	       </div>
	        </div>
	  <hr>		
        <div class="container">
			<footer class="py-5">
				<div class="row">
					<div class="col-22">
						<h5>Wanna Adopt a Pet</h5>
						<ul class="nav flex-column">
							<li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Início</a></li>
							<li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Adote</a></li>
							<li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">ONGs</a></li>
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
								<button class="btn btn-primary" type="button"><ion-icon class="iconfooter" name="send-outline" class="botao_email_footer"></ion-icon></button>
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