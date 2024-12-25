<?php
require 'Admin/database.php';
if(!isset($_SESSION)){
session_start();
}

if(!isset($_SESSION['panier'])){
 $_SESSION['panier']=array();
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $con=Database::connect();
    $req=$con->query("select * from items where id=$id");
    if(empty($req)){
  die("ce produit n'existe pas");

    }
    if(isset($_SESSION['panier'][$id])){
        $_SESSION['panier'][$id]++;
    }else{
        $_SESSION['panier'][$id]=1;
    }
    
    header("location:Accueil.php");
}

?>