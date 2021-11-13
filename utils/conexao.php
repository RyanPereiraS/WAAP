<?php 
    require_once "config.php";
    $conexao = mysqli_connect('localhost', 'root', '', 'waap_official') or die ('Error 404');
    mysqli_set_charset($conexao, $mysqlcharset);

?>