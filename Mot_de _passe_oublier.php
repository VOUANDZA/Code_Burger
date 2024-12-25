
<?php
$message_email='';
require 'Admin/database.php';
if(isset($_POST['email'])){
$token=uniqid();
$url="http://localhost/Burger/token.php?token=$token";
$message="Votre lien de reintialisation du Mot de passe : ".$url;
$destinataire="From:tsoumoujubrainfresnel@gmail.com";

//Envoie de l'email avec le lien de réinitialisation
if(mail($_POST['email'],'Mot de passe oublier',$message,$destinataire)){
    $message_email="Un email vous a été envoyé avec un lien pour réinitialiser votre mot de passe";
    $con=Database::connect();
    $stmt=$con->prepare("update users set token = ? where email = ?");
    $stmt->execute([$token,$_POST['email']]);
}else{
    echo "Une erreur est survenue lors de l'envoie de l'email";
}


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
        <link rel="stylesheet" href="CSS/styles.css">
    </head>
    
    <body>
        <h1 class="text-logo"><span class="bi-shop"></span> Mot de passe oublier <span class="bi-shop"></span></h1>
        <div class="container admin">
            <div class="row">
            <center><img src="images/sa3.png" style="width:250px;"></center>

       <!-- Vérifiez si $infos n'est pas vide avant de l'afficher -->

                  
                        <p  style="color:green; font-style:italic"><?=$message_email?></p>
                <form method="POST"  action="">
                 
                    <div>
                        <label class="form-label" for="email">Email:</label>
                  
                       
                        <input type="text" class="form-control" id="email" name="email" placeholder="saisissez votre motre de email">
                        
            
                        <br>
                     
                    </div>
                    
                    <div>
                     <input type="submit"  name="Seconnecter" value ="Connexion" class="btn btn-primary">
                       </div>
                </form>
</div>
        </div>   
    </body>
</html>

