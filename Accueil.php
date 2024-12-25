<?php 
 session_start();
if(!isset($_SESSION['email'])){
    header("Location:index.php");
    exit();
 
   }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="css/styles.css">

   <style>
.ok{
    position: absolute;
      

      background-color: red;
      border-radius: 50%;
      
      align-items: center;
     
      color: white;
      font-size: 40px;
      
}
a .ok{
    color:white;
}

   </style>
    </head>
    <body>
        <div class="container site">
           
        <h1 class="text-logo">
    <!-- Icône du magasin -->
    <span class="bi-shop"></span>Maison Burger de Cedric

    <!-- Icône du caddie avec le lien vers la page panier -->
    <span class="bi-shop">
        <!-- Lien vers la page panier avec une image de caddie -->
        <a href="panier.php">
            <img src="images/caddie.jpg" style="width:60px; margin-left:100px;" alt="...">

            <!-- Affichage du montant total dans le panier -->
            <span class="ok">
                <?php
                // Vérifier si $_SESSION['panier'] est défini et n'est pas null avant d'utiliser array_sum
                if(isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
                    // Afficher la somme des éléments dans $_SESSION['panier']
                    echo array_sum($_SESSION['panier']);
                } else {
                    // Afficher "0" si $_SESSION['panier'] n'est pas défini ou est null
                    echo "0"; // ou gérer le cas où $_SESSION['panier'] n'est pas défini ou est null selon vos besoins
                }
                ?>
            </span>
        </a>
    </span>
    <a href="Deconnexion.php"><img src="images/logout.png" style="width:60px; margin-left:80px;" alt="..."></a>
</h1>

            
            <?php
				require 'Admin/database.php';
			 
                echo '<nav>
                        <ul class="nav nav-pills" role="tablist">';

                $db = Database::connect();
                $statement = $db->query('SELECT * FROM categories');
                $categories = $statement->fetchAll();
                foreach ($categories as $category) {
                    if($category['id'] == '1') {
                        echo '<li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab'. $category['id'] . '" role="tab">' . $category['name'] . '</a></li>';
                    } else {
                        echo '<li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab'. $category['id'] . '" role="tab">' . $category['name'] . '</a></li>';
                    }
                }

                echo    '</ul>
                      </nav>';

                echo '<div class="tab-content">';

                foreach ($categories as $category) {
                    if($category['id'] == '1') {
                        echo '<div class="tab-pane active" id="tab' . $category['id'] .'" role="tabpanel">';
                    } else {
                        echo '<div class="tab-pane" id="tab' . $category['id'] .'" role="tabpanel">';
                    }
                    
                    echo '<div class="row">';
                    
                    $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
                    $statement->execute(array($category['id']));
                    while ($item = $statement->fetch()) {
                        echo '<div class="col-md-6 col-lg-4">
                                <div class="img-thumbnail">
                                    <img src="images/' . $item['image'] . '" class="img-fluid" alt="...">
                                    <div class="price">' . number_format($item['price'], 2, '.', ''). ' €</div>
                                    <div class="caption">
                                        <h4>' . $item['name'] . '</h4>
                                        <p>' . $item['description'] . '</p>
                                        <a href="commander.php?id='.$item['id'].'" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>
                                    </div>
                                </div>
                            </div>';
                    }
                   
                   echo    '</div>
                        </div>';
                }
                Database::disconnect();
                echo  '</div>';
            ?>

        </div>
    </body>
</html>