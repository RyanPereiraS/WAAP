<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='css/login.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel='stylesheet' type='text/css' href='../../../BOOTSTRAP/css/bootstrap.min.css'>
    <title>Document</title>
</head>
    <body>
        <script href='../../BOOTSTRAP/js/bootstrap.min.js'></script>
    <div class="clearfix">
		<div id="void">	
	</div>

	<div id="Logo">
		<img src="../home/img/Logoparalela.png" title="logo WAAP">
	</div>

	<nav id="menu-home">
		<ul>
			<li><a href="">Adote</a></li>
			<li><a href="">Doe</a></li>
			<li><a href="">Emergência</a></li>
			<li><a href="">Notícias</a></li>
			<li><a href="../WEB/login/cadastrar.php" >Cadastrar</a></li>
			<li><a href="" >Login</a></li>
		</ul>
	</nav>

	<div class="linha">
		<hr>
	</div>
        <div id='login'>
            <h1>LOGIN</h1>
            <form action="verify.php" method="post">
                <p><input type="text" name="email" id="" placeholder="E-Mail"></p>
                <p><input type="password" name="pass" id="" placeholder="Senha"></p>
                <button type='submit' class="btn btn-danger">Login</button>
                <p class='text'>Novo por aqui? <a href="cadastrar.php">Cadastre-se!</a></p>
            </form>
        </div>
        <footer id='rodape'>
            <div class='slogan'>
                <h2>"Adote novas experiencias"</h2>
                <p>waap.contato@gmail.com</p>
            </div>
            <div class="nav">
                <ul>
                    <li class='title'>Conheça nosso site</li>
                    <li><a href="">Adote</a></li>
                    <li><a href="">Doe</a></li>
                    <li><a href="">Emergência</a></li>
                    <li><a href="">Notícias</a></li>
                    <li><a href="../WEB/login/cadastrar.php" >Cadastrar</a></li>
                    <li><a href="" >Login</a></li>
                </ul>
            </div>
            <div class='nav'>
                <ul>
                    <li class='title'>Quem somos</li>
                    <li><a href="">Sobre nós</a></li>
                    <li><a href="">Contato</a></li>
                    <li><a href="">Termos de uso</a></li>
                    <li><a href="">Políticas de privacidade</a></li>
                </ul>
            </div>
            <div class='redes'>
                <a href=''><i class="bi bi-facebook"></i></a>
                <a href=''><i class="bi bi-twitter"></i></a>
                <a href=''><i class="bi bi-instagram"></i></a>
                <a href=''><i class="bi bi-github"></i></a>
            </div>
        </footer>
    </body>
</html>