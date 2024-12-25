<?php
require 'Admin/database.php';
$nom_erreur=$email_erreur=$tel_erreur=$mot_de_passe_erreur="";
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['inscription'])){
$nom=valid_donnees($_POST['nom']);
$email=valid_donnees($_POST['email']);
$tel=valid_donnees($_POST['tel']);
$mot_de_passe=valid_donnees($_POST['password']);
$isvalid=true;

if(!is_name($nom)){
$nom_erreur="verifiez votre nom";
$isvalid=false;
}if(!ismail($email)){
$email_erreur="verifiez votre email";
$isvalid=false;
}if(!is_Tel($tel)){
    $tel_erreur="verifier votre numéro de teléphone";
    $isvalid=false;
}if(!verif_mdp($mot_de_passe)){

$mot_de_passe_erreur="verifiez votre mot de passe";
$isvalid=false;
}
if($isvalid){
    $mot_de_passe= password_hash($mot_de_passe,PASSWORD_DEFAULT);
    $con=Database::connect();
    $req=$con->prepare("insert into users(name,email,phone,passeword) VALUES (?,?,?,?)");
    $req->execute(array($nom,$email,$tel,$mot_de_passe));

}

}

//les fonction.......................................................................
function is_name ($name){
return preg_match('/^[A-Za-z\'\-]+$/',$name);

}

function valid_donnees($donnees){
 $donnees=htmlentities($donnees);
    $donnees=trim($donnees);
    $donnees=htmlspecialchars($donnees);
    $donnees=stripslashes($donnees);
    return $donnees;
}
function ismail($mail){
return filter_var($mail,FILTER_VALIDATE_EMAIL);

}

function is_Tel($telephone){
    $pattern='/^(?:\+33|0)[1-9](?:\d{2}){4}$/';
return preg_match($pattern,$telephone);
}

function verif_mdp($mdp){
if(strlen($mdp)<8){
return false;
}if(!preg_match('/[0-9]/',$mdp)){
 return false;
}if(!preg_match('/[A-Z]/',$mdp)){
  return false;
}if(!preg_match('/[a-z]/',$mdp)){
    return false;
}if(!preg_match("/[@#$%^&*()\-_=+\\[\]{};':\"|,.<>\/?]/",$mdp)){
    return false;
}
return true;

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
p{
    color: red;
    font-style: italic;
}


        </style>
    </head>
    
    <body>
        <h1 class="text-logo"><span class="bi-shop"></span>Maison Burger de Cedric inscription <span class="bi-shop"></span></h1>
        <div class="container admin">
            <div class="row">
           
            <center><img src="images/m3.png" style="width:250px;"></center>
                <form class="form" role="form" method="post" >
                    <br>
                    <div>
                        <label class="form-label" for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="nom" placeholder="Nom">
                        <p><?=$nom_erreur?></p>
                  
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email">
                        <p><?=$email_erreur?></p>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="phone">Télephone</label>
                        <input type="text" class="form-control" id="phone" name="tel" placeholder="Téléphone">
                        <p><?=$tel_erreur?></p>
                    </div>
                    <div>
                        <label class="form-label" for="passeword">Mot de passe</label>
                        <input type="password" class="form-control" id="passeword" name="password" placeholder="Définissez un mot de passe">
                        <p><?=$mot_de_passe_erreur?></p>
                    </div>
                    
                  
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="inscription" style="margin-left:410px; width:400px; margin-bottom:30px"> Inscription</button>
              <span style="display:<?php if($isvalid) echo 'bloc'; else echo 'none'?>; color:green">Inscription réussie avec succès!!!</span>
               <a href="index.php"  style="margin-left:20px;">Connectez-vous</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>