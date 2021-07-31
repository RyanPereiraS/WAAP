<?php 
    session_start();
    if(isset($_SESSION['logado'])){
        echo $_SESSION['usuario'];
    }
?>
<a href="login/">LOGIn</a>
<form action="" method="post">
    <input type="submit" value="Log-out">
</form>

<?php
    session_destroy();
?>