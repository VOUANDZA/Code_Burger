<?php
session_start();
$email_err=$mdp_err=''; 
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
        <h1 class="text-logo"><span class="bi-shop"></span>Maison Burger de Cedric connexion <span class="bi-shop"></span></h1>
        <div class="container admin">
            <div class="row">
            <center><img src="images/sa3.png" style="width:250px;"></center>

       <!-- Vérifiez si $infos n'est pas vide avant de l'afficher -->

            
                <form method="POST"  action="">
                 
                    <div>
                        <label class="form-label" for="email">Email:</label>
                        
                       
                        <input type="text" class="form-control" id="email" name="email" placeholder="email">
            
                        <p style="color:red"><?=$email_err;?></p>
                        <br>
                     
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="passeword">Mot de passe</label>
                    <input type="password" class="form-control" id="passeword" name="mdp" placeholder="Saisir un mot de passe">
                    <p style="color:red;font-style:italic"><?=$mdp_err ?></p>
       
                   <br>
            
                    
                    </div>
                    
                    <br>
                    <div>
                     <input type="submit"  name="Seconnecter" value ="Connexion" class="btn btn-primary">
                       
                     <a href="inscription.php" class="btn btn-success">S'inscrire </a>
                     <a href="Mot_de _passe_oublier.php">Mot de passe oublié</a>
               
                   </div>
                </form>

              
            </div>
        </div>   
    </body>
</html>

<?php
require_once ('Admin/database.php');

 //Connexion utilisateur
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["Seconnecter"])){
$con= Database::connect();
$email=$_POST['email'];
$stmt=$con->prepare("select passeword from users where email=?");
$stmt->execute([$_POST['email']]);
$hashpassword=$stmt->fetchColumn();
if(!empty($email)){
    $email_err= "Veuillez remplir le champ email";
 
}if(empty($_POST['mdp'])){
    $mdp_err= "Veuillez remplir le champ Mot de passe";
}

if(password_verify($_POST['mdp'],$hashpassword)){
    $_SESSION['email']=$_POST['email'];
   header("Location:Accueil.php");
   exit();

   
   }else {
       $infos ="verifiez votre email ou Mot de password";
    
   }
   
   
   }
?>
