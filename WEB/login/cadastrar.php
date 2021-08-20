<?php 
session_start();
    if(isset($_SESSION['logado'])){
        if($_SESSION['logado']){
            header("Location: ../");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilos/cadastro.css" rel="stylesheet" type="text/css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Cadastro</title>
</head>
<body>
    <div id="logo">
        <img src="../assets/Logoparalela.png" title="logo WAAP">
    </div>
    <nav id="menu-home">
		<ul>
			<li><a href="#">Adote</a></li>
			<li><a href="#">Doe</a></li>
			<li><a href="#">Emergência</a></li>
			<li><a href="#">Notícias</a></li>
			<li><a href="../WEB/login/cadastrar.php" >Cadastrar</a></li>
			<li><a href="#" >Login</a></li>
		</ul>
	</nav>
   

    <div class="linha">
		<hr>
	</div>

    
<div id="cadastro_form">
        <form action="cadastro.php" method="post">
                <h2>Cadastro do Usuario</h2>
        
        <div class="nomesob">
                    <div class="row g-3">
                         <div class="col">
                            <input type="text" name="nome" class="form-control" placeholder="Nome" aria-label="Nome">
                        </div>
                         <div class="col">
                            <input type="text" name="nome" id="" class="form-control" placeholder="Sobrenome" aria-label="Sobrenome">
                        </div>
                   </div>
             </div>
               <div class="mb-3">
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="nome@example.com">
                </div>
        
<div id="senha">
        <div class="row g-3">
            <div class="col">
               <input type="password" name="pass" id="" class="form-control" placeholder="Senha">
            </div>
              <div class="col">
                 <input type="password" name="cpass" id="" class="form-control" placeholder="Confirme sua senha">
              </div>
        </div>
</div>
<div id="tele">
     <div class="row g-3">
            <div class="col">
               <input type="text" name="ddd" id="" class="form-control" placeholder="DDD">
            </div>
                <div class="col"> 
                    <input type="text" name="tell" id="" class="form-control" placeholder="Telefone">
              </div>
      </div>
</div>        
             <div id="datan">
                <input type="date" name="nasci" id="" class="form-control">
            </div>
        
            <div id="genero">
             <input type="radio" name="gen" value="M"> Masculino
             <input type="radio" name="gen" value="F" > Feminino
             <input type="radio" name="gen" value="O">  Outro
            </div>
        
        
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <p>Já possui cadastro? <a href="index.php">Login!</a></p>
        
     </form>
 </div>

 <div class="linha">
		<hr>
	</div>

</body>
</html>