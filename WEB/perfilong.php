<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
    require_once 'utils/conexao.php';
    if(isset($_GET['id'])){
        $id_ong = $_GET['id'];
        $queryong="SELECT a.nome,a.id_administrador,b.id_administrador,b.cnpj FROM ong as a INNER JOIN gerenciador as b on a.id_administrador=b.id_administrador WHERE id ='$id_ong'";
        $exec=mysqli_query($conexao,$queryong);
        $ong=mysqli_fetch_array($exec);


        $querycont="SELECT a.id_ong,b.id_ong,a.facebook,a.instagram,a.email,a.site,b.cep,b.numero,b.complemento FROM contato AS a INNER JOIN endereco as b on a.id_ong=b.id_ong WHERE a.id_ong='$id_ong'";
        $execont=mysqli_query($conexao,$querycont);
        $ong_cont=mysqli_fetch_array($execont);
        
        echo"
            <p>
                Perfil da ong 
            </p>
            <p>
                nome: $ong[nome]
            </p>
            <p>
                cnpj: $ong[cnpj]
            </p>
            <br/>
            <p>
                contatos
            </p>
            <p>
                facebook: $ong_cont[facebook]
            </p>
            <p> 
                instagram: $ong_cont[instagram]
            </p>
            <p>
                E-mail: $ong_cont[email]
            </p>
            <p>
                site: $ong_cont[site]
            </p>
            <p>
            <br/>
            <p>
                Endereço 
            </p>
            <p>
                CEP: $ong_cont[cep]
            </p>
            <p>
                número: $ong_cont[numero]
            </p>
            <p>
                complemento: $ong_cont[complemento]
            </p>
            <p>
            </body>
        </html>
        ";
    }   
?>