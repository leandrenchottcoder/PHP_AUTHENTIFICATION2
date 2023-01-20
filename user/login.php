<?php
include("../Database/Database.php");
@$nom = $_POST['nom'];
@$prenom = $_POST['prenom'];
@$mail = $_POST['mail'];
@$numTel = $_POST['numTel'];
@$motdepass = $_POST['motdepass'];
@$valider = $_POST['valider'];
$erreur = "";
$resultat ="";


if(isset($valider)){

    if(!empty($nom) or !empty($prenom) or !empty($mail) or !empty($numTel) or !empty($motdepass))
    {

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $mail = htmlspecialchars($_POST['mail']);
        $numTel = htmlspecialchars($_POST['numTel']);
        $motdepass = sha1($_POST['motdepass']);

        $requmail = $bdd->prepare("select * from membres WHERE mail=?");
        $requmail->execute(array($mail));
        $mailexist = $requmail->rowCount();

        if($mailexist == 0 )
        {
             $resultat = 'merci '.$nom.' '. $prenom.' pour votre inscription sur notre logiciel';
             $requete = $bdd->prepare('insert into membres(nom , prenom, mail, numTel, motdepass) values(?,?,?,?,?)');
             $requete->execute(array($nom, $prenom,$mail, $numTel, $motdepass));
        }
        else
        {
          $erreur = "Mail deja utilisé , trouver vous un autre Mail . " ;
        }

    }
    else if(empty($nom) or empty($prenom) or empty($mail) or empty($numTel) or empty($motdepass))
    {
        $erreur = " Veuillez remplir tout les champs";
    }




}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">

	  <style type="text/css">
	  #buttn{
		  color:#fff;
		  background-color: #5c4ac7;
	  }
	  </style>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>




<div class="pen-title">

</div>

<div class="module form-module">
  <div class="toggle">

  </div>
  <div class="form">
    <h2>Login to your account</h2>
    <span style="color:red;text-algn:center;"><?php if(isset($erreur)){echo $erreur; }?></span>
     <span style="color:green;"><?php if(isset($resultat)){ echo $resultat;} ?></span>
   <form class="login-form" action="login.php" method="post">
     <input type="text" placeholder="Nom" name="nom"/>
     <input type="text" placeholder="Prenom" name="prenom"/>
     <input type="email" placeholder="Mail" name="mail"/>
     <input type="text" placeholder="numTel" name="numTel"/>
     <input type="password" placeholder="Mot de passe" name="motdepass"/>
     <input type="submit"  style="background-color:#5c4ac7;color:white;" name="valider" value="valider" />

   </form>
  </div>

  <div class="cta">Account admin?<a href="../admin/index.php" style="color:#5c4ac7;"> Click an account</a></div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>




  <div class="container-fluid pt-3">
	<p></p>
  </div>






</body>

</html>
