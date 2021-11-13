<?php 
    session_start();
    require_once "../../utils/conexao.php";

    $privilegio = $_SESSION['privilegio'];
    $nomeusuario = $_SESSION['usuario'];
    $idadm = $_SESSION["id_usuario"];
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
        <title>Painel ADM</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
		<link rel="stylesheet" href="estilos/estilo.css">
    </head>
    <body>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#conteudo-aviso'
            });
        </script>
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
									<a href="../../sair.php" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
								</div>
							';
						break;
						case 1:
							echo'
								<div class="col-md-3 menus-nav text-end">
								<a href="../../ong/index.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
								<a href="../../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
								<a href="../../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
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

	    <div class="container">
			 <div class="row">
				<div class="col">


			<div id='aviso'>
                <div class="jumbotron" id="camp_alterar">
                    <h1 class="display-4">Postar Avisos</h1>
					<p class="lead">
                    	Seja Bem-vindo(a), <?php echo $nomeusuario ?>, utilize essa pagina, para postar avisos as de mais ONG'S Cadastradas no Site!
                    </p>
                    <hr>
                    <br>

                <form action='' method="POST">
                	<div class="mb-3">
                	  <h3><label for="formGroupExampleInput" class="form-label">Título</label></h3>
                	  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Digite o Título do Aviso" name="titulo">
                	    <figcaption class="figure-caption text-end">O Título aparecerá em primeiro lugar.</figcaption>
                	  </figure>
                	</div>
                    
                    <div class="mb-3">
                    	<br>
                     <h4><label for="formGroupExampleInput" class="form-label">Conteúdo</label></h4>
                      <textarea name="conteudo" id="conteudo-aviso"></textarea>
                      <figcaption class="figure-caption text-end">O Conteúdo, será o corpo do seu Aviso.</figcaption>
                    </div>
                    <p>
                    	<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    	  <button class="btn btn-outline-primary me-md-2" type="submit" name="enviar">Postar Aviso</button>
                    	</div>
                    </p>
                </form>
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
<?php
    date_default_timezone_set('America/Sao_Paulo');
    if(isset($_POST['enviar'])){
        $data = date('y/m/d H:i:s');
        if(empty($_POST['titulo'])){
            echo"
                <script>
                    alert('Coloque um título para o aviso')
                </script>
            ";
        }else if(empty($_POST['conteudo'])){
            echo"
                <script>
                    alert('Preencha o contúdo do aviso')
                </script>
            ";
        }else{
            $_POST['conteudo'];
            $query_enviar = "INSERT INTO avisos(admin_id, aviso_titulo, aviso_conteudo, postagem) VALUE($idadm, '$_POST[titulo]', '$_POST[conteudo]', '$data')";
            $exec_enviar = mysqli_query($conexao, $query_enviar);
            if($exec_enviar){
                echo"
                    <script>
                        alert('Aviso postado')
                    </script>
                ";    
                unset($_POST['enviar']);
                unset($_POST['titulo']);
                unset($_POST['conteudo']);
            }else{
                echo"
                    <script>
                        alert('Erro ao enviar aviso')
                    </script>
                ";
            }
        }
    }
?>