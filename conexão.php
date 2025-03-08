<?php
    $hostname ="localhost";
    $bd = "proj_ia";
    $usuario = "root";
    $senha = "";
    // criando um objeto  sql
    $con =mysqli_connect($hostname,$usuario,$senha,$bd);
    if ($con->connect_errno){
        echo "ERRO NA CONEXÂO";
    }
?> 