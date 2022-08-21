<?php


if(!isset($_SESSION)) {
    session_start();
}


if(!isset($_SESSION['id'])){
   die("ERRO você não pode entrar na página, clique <a href=\"index.php\">Entrar</a>");
}
