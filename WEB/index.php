<?php 
    session_start();
    if(isset($_SESSION['usuario'])){
        echo $_SESSION['usuario'];
    }
?>