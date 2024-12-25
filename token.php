<?php
require 'Admin/database.php';
$Success="";

if(isset($_GET['token'])){
$token = $_GET['token'];

$db = Database::connect();
$stmt=$db->prepare("select email from users where token=?");

$stmt->execute(array($token));
$email=$stmt->fetchColumn();

if($email){

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
            <link rel="stylesheet" href="CSS/styles.css">
        </head>
        
        <body>
            <h1 class="text-logo"><span class="bi-shop"></span> réinitialisation du Mot de passe <span class="bi-shop"></span></h1>
            <div class="container admin">
                <div class="row">
                <center><img src="images/sa3.png" style="width:250px;"></center>

                
           <p  style="color:green; font-style:italic"><?=$Success?></p>
                
                    <form method="POST"  action="">
                     
                        <div>
                            <label class="form-label" for="mdp">Mot de passe:</label>
                            
                           
                            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="saisissez votre nouveau mot de passe">
                     
                
                            <br>
                         
                        </div>
                        
                        <div>
                         <input type="submit"  name="changer" value =" réinitialisalisation" class="btn btn-primary">
                           </div>
                    </form>
    </div>
            </div>   
        </body>
    </html>
    <?php
}
} if(isset($_POST['mdp']) && $_POST['mdp']!=null){
    $mdp=$_POST['mdp'];
    $mdp_hash=password_hash($mdp,PASSWORD_DEFAULT);
$req=$db->prepare("update users set passeword=?, token=null where email=?");
$req->execute(array( $mdp_hash,$email));
$verification=$req->fetch();
if(isset($verification)){
 $Success="votre mot de passe a bien été reinitialé";
}else{
    echo "Token invalide";
}

} 



