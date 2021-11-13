<?php
  session_start();
  if (isset($_SESSION['logado'])) {
        $idusuario = $_SESSION['id_usuario'];
        $privilegio = $_SESSION['privilegio'];
        $nomeusuario = $_SESSION['usuario'];
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css%22%3E">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <title>WAAP - Sobre Nos</title>
  <link href="styles.css" rel="stylesheet">
</head>

<body>
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="../assets/Logoparalela.png" class="logo" alt="Logo" title="Logo Waap">
            </a>
        
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../index.php" class="nav-link px-2 link-dark">Início</a></li>
                <li><a href="../adocao" class="nav-link px-2 link-dark">Adote</a></li>
                <li><a href="../ong/ongs.php" class="nav-link px-2 link-dark">ONGs</a></li>
                <li><a href="../sobre-nos" class="nav-link px-2 link-dark">Sobre Nós</a></li>
            </ul>
            <?php
        if(isset($privilegio)){
          switch($privilegio){
            case 0:
              echo'
                <div class="col-md-3 menus-nav text-end">
                  <a href="../painel/admin" class=""><button type="button" class="btn btn-outline-primary me-2">Painel</button></a>
                  <a href="../sair.php" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                </div>
              ';
            break;
            case 1:
              echo'
                <div class="col-md-3 menus-nav text-end">
                <a href="../painel/ong/index.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="home-outline"></ion-icon> Minha ONG</button></a>
                <a href="../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
                <a href="../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                </div>
              ';
            break;
            default:
              echo'
                <div class="col-md-3 menus-nav text-end">
                <a href="../gerenciamento-conta/dados.php" title="Configurações" class=""><button type="button" class="btn btn-outline-primary me-2"><ion-icon name="settings-outline"></ion-icon></button></a>
                <a href="../sair.php" title="Sair" class=""><button type="button" class="btn btn-primary"><ion-icon name="log-out-outline"></ion-icon></button></a>
                </div>
              ';
            break;
          }
        }else{
          echo'
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


  <div class="container marketing">
    <!-- START THE FEATURETTES -->

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Wanna Adopt A Pet. </h2>
        <p class="pslogan"><span class="text-muted slogan">Adote novas experiências.</span></p>
        <p class="lead">Somos uma equipe de estudantes e amantes de animais. Criamos o projeto com o intuito de contribuir com a causa de varias entidades espalhadas pelo mundo de forma rápida e simples.</p>
      </div>
      <div class="col-md-5">
        <figure class="figure">
          <img src="../assets/img-sobre-nois.png" class="figure-img img-fluid rounded" alt="...">
          <figcaption class="figure-caption text-end">Logo, Wanna Adopt a Pet?</figcaption>
        </figure>
      </div>
    </div>



    <hr class="featurette-divider">
    <div class="row">
    <div class="col-lg-4">
            <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="profiles/2.png" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/></img>      
              <h2>Paulo Daniel</h2>
              <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
              <p><a class="icons" href="#"><ion-icon name="logo-github"></ion-icon></a> <a class="icons instagram" href="#"><ion-icon name="logo-instagram"></ion-icon>
              </a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
              <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="profiles/1.png" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/></img>
      
              <h2>Ryan Pereira</h2>
              <p>Pequenas ações formam grandes destinos, grandes destinos formam grandes ações.</p>
              <p><a class="icons" href="https://github.com/RyanPereiraS" target="_newblank"><ion-icon name="logo-github"></ion-icon></a> <a class="icons instagram" href="https://www.instagram.com/ryan.pereirasilva/" target="_newblank"><ion-icon name="logo-instagram"></ion-icon></a> <a class="icons instagram" href="https://twitter.com/PereiraRyanS" target="_newblank"><ion-icon name="logo-twitter"></ion-icon>
              </a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
            <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="profiles/5.png" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/></img>
      
              <h2>Bryan Palácio</h2>
              <p>And lastly this, the third column of representative placeholder content.</p>
              <p><a class="icons" href="#"><ion-icon name="logo-github"></ion-icon></a> <a class="icons instagram" href="#"><ion-icon name="logo-instagram"></ion-icon></a> <a class="icons instagram" href="#"><ion-icon name="logo-twitter"></ion-icon>
              </a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
            <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="profiles/4.png" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/></img>        
                <h2>Raul Germano</h2>
                <p>And lastly this, the third column of representative placeholder content.</p>
                <p><a class="icons" href="#"><ion-icon name="logo-github"></ion-icon></a> <a class="icons instagram" href="#"><ion-icon name="logo-instagram"></ion-icon>
                </a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
            <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="profiles/3.png" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/></img>        
                <h2>Rafael Neves</h2>
                <p>And lastly this, the third column of representative placeholder content.</p>
                <p><a class="icons" href="#"><ion-icon name="logo-github"></ion-icon></a> <a class="icons instagram" href="#"><ion-icon name="logo-instagram"></ion-icon>
                </a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
            <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="profiles/6.png" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/></img>        
                <h2>Vitor Leon</h2>
                <p>And lastly this, the third column of representative placeholder content.</p>
                <p><a class="icons" href="#"><ion-icon name="logo-github"></ion-icon></a> <a class="icons instagram" href="#"><ion-icon name="logo-instagram"></ion-icon>
                </a></p>
            </div><!-- /.col-lg-4 -->
          </div><!-- /.row -->
    </div><!-- /.row -->


    <!-- /END THE FEATURETTES -->

  </div>

  <hr class="featurette-divider">
  <div class="container">
    <footer class="py-5">
      <div class="row">
        <div class="col-2">
          <h5>Wanna Adopt a Pet</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="../" class="nav-link p-0 text-muted">Início</a></li>
            <li class="nav-item mb-2"><a href="../adocao/" class="nav-link p-0 text-muted">Adote</a></li>
            <li class="nav-item mb-2"><a href="../ong/ongs.php" class="nav-link p-0 text-muted">ONGs</a></li>
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
require_once "../utils/funcoes.php";
if (isset($_POST['newsletter'])) {
  if (!empty($_POST['email'])) {
    newsletter($_POST['email']);
  }
}
?>