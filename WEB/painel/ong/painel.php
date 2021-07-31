<?php
    session_start();
    if(isset($_SESSION['logado'])){
        if($_SESSION['logado']){
            header("Location: ../");
        }
    }
?>