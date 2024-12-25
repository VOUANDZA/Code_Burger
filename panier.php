<?php
require 'admin/database.php';
session_start();
if(isset($_GET["id"])){
    $produitId=htmlspecialchars($_GET['id']);
    unset($_SESSION['panier'][$produitId]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="css/styles.css">
    <title>Document</title>

    <style>

        table{
            position: relative;
            top:100px;
        }

    table, thead, tbody{
color:black;

    }
    tbody,tr,td{
        color:black;
        text-align: center;
    }
    .ced{
        color: green;
        position: relative;
        top:100px;
        text-align: center;
        font-weight: bold;
        font-size:25px;
        
    }
    </style>
</head>
<body>
<h1 class="text-logo"><span class="bi-shop"></span>Maison Burger de Cedric<span class="bi-shop"></span></h1>
<div class="container admin">
    <table class="table table-striped table-bordered">

<thead>
<tr>
<th>Nom</th>
<th>Image</th>
<th>Description</th>
                      
<th>Prix</th>
                     
<th>Quantite</th>
                      
<th>Actions</th>

</tr>

</thead>
<tbody>
<?php 
$total=0;
if(isset($_SESSION['panier']) && is_array($_SESSION['panier'])){
    $ids= array_keys($_SESSION['panier']);
    
    if(empty($ids)){
        echo "votre panier est vide";
    }else{
        $req=Database::connect()->query("SELECT * FROM items where id IN (".implode(',',$ids).")");
        foreach ($req as $product):
            $total=$total+ $product['price']* $_SESSION['panier'][$product['id']];
       



    


    ?>


<tr>
<td><?=$product["name"]?></td>
<td><img src="images/<?=$product["image"]?>" style="width: 50px"></td>
<td><?=$product["description"]?></td>
                      
<td><?=number_format((float)$product['price'],2,".","")?>€</td>
                     
<td><?=$_SESSION['panier'][$product['id']]?></td>
                      
<td><a href="panier.php?id=<?=$product['id']?>"><img src="images/sup.jpg" style="width: 50px"></a></td>

</tr>
<?php endforeach;
}
}
?>

</tbody>

    </table>
    

    <div class="ced">
    <tr>Quantite total:<?=array_sum($_SESSION['panier'])?> </tr>
        <tr>Total:<?=$total?>€</tr>

    </div>

<a href="Accueil.php" class="btn btn-primary" style="margin-top:110px; margin-left:950px;">Retour</a>
</div>  
</body>
</html>