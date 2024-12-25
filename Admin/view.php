<?php
require_once('database.php');
if(!empty($_GET['id'])){
    $id= checkInput($_GET['id']) ; //securité
}
$db=Database::connect();
$statement=$db->prepare("select items.id,items.name, items.image,items.description,items.price,categories.name As category from items left join categories on items.category=categories.id where items.id= ? ");
$statement->execute(array($id));
$item=$statement->fetch();
Database::disconnect();

function checkInput($data){
    $data=trim($data);//permet de supprimer les caractères choisie
    $data=stripcslashes($data);//supprime les slaches
    $data=htmlspecialchars($data);// rend inofensif les balises//convertie les caractère spéciaux en entité hmtl(faire des recherche d'entité html)Cela contribue à prévenir les attaques de type Cross-Site Scripting (XSS) en rendant inoffensives les balises HTML potentiellement malveillantes.
   return $data;

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
      <link rel="stylesheet" href="../CSS/styles.css">
    </head>
    
    <body>
      <h1 class="text-logo"><span class="bi-shop"></span> Burger Ced <span class="bi-shop"></span></h1>
      <div class="container admin">
        <div class="row">
          <div class="col-md-6">
            <h1><strong>Voir un item</strong></h1>
            <br>
            <form>
              <div>
                <label>Nom:</label><?php echo '  '.$item['name'];?>
              </div>
              <br>
              <div>
                <label>Description:</label><?php echo '  '.$item['description'];?>
              </div>
              <br>
              <div>
                <label>Prix:</label><?php echo '  '.number_format((float)$item['price'], 2, '.', ''). ' €';?>
              </div>
              <br>
              <div>
                <label>Catégorie:</label><?php echo '  '.$item['category'];?>
              </div>
              <br>
              <div>
                <label>Image:</label><?php echo '  '.$item['image'];?>
              </div>
            </form>
            <br>
            <div class="form-actions">
              <a class="btn btn-primary" href="gestion.php"><span class="bi-arrow-left"></span> Retour</a>
            </div>
          </div>
          <div class="col-md-6 site">
            <div class="img-thumbnail">
              <img src="<?php echo '../images/'.$item['image'];?>" alt="...">
              <div class="price"><?php echo number_format((float)$item['price'], 2, '.', ''). ' €';?></div>
              <div class="caption">
                <h4><?php echo $item['name'];?></h4>
                <p><?php echo $item['description'];?></p>
                <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>
              </div>
           
            </div>
          </div>
        </div>
      </div>   
    </body>
</html>
