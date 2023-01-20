<?php
error_reporting(0);
session_start();

include("../Database/DataBase.php");

@$nom = $_POST['nom'];
@$prenom = $_POST['prenom'];
@$mail = $_POST['mail'];
@$numTel = $_POST['numTel'];
@$motdepass = $_POST['motdepass'];
@$valider = $_POST['valider'];
$erreur = "";
$resultat ="";

if(isset($valider)){

    if(!empty($nom) or !empty($prenom) or !empty($mail) or !empty($numTel) or !empty($motdepass)){

//           $resultat = 'merci '.$pseudo.' pour votre inscription';
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$mail = htmlspecialchars($_POST['mail']);
$numTel = htmlspecialchars($_POST['numTel']);
$motdepass = sha1($_POST['motdepass']);
//        $requete = $bdd->prepare('insert into membres(pseudo ,mail, motdepass) values(?,?,?)');
//        $requete->execute(array($pseudo,$mail,$motdepass));
//        $requpseudo = $bdd->prepare("select * from membres");
//        $requpseudo->execute(array($pseudo));
//        $pseudoexist = $requpseudo->rowCount();
        $requser = $bdd->prepare("SELECT * from membres WHERE nom =? AND prenom =? AND mail =? AND numTel =?  AND motdepass =?");
        $requser->execute(array($nom ,$prenom,$mail,$numTel,$motdepass));
        $userexist = $requser->rowCount();
         if($userexist == 1)
         {

            $userinfo = $requser->fetch();
             $_SESSION['id'] = $userinfo['id'];
             $_SESSION['nom'] = $userinfo['nom'];
             $_SESSION['prenom'] = $userinfo['prenom'];
              $_SESSION['mail'] = $userinfo['mail'];
              $_SESSION['numTel'] = $userinfo['numTel'];
              $_SESSION['motdepass'] = $userinfo['motdepass'];
             header("location: dashboard.php?id= ".$_SESSION['id']);
         }
        else {
             $erreur = "Mauvais identifiant";
        }
    }
    else if(empty($nom) or empty($prenom) or empty($mail) or empty($numTel) or empty($motdepass))
    {

          $erreur =" veuillez  remplire tout les champs avant de vous connecter !!";


    }

}



?>

<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">


</head>

<body>


<div class="container">
  <div class="info">
    <h1>Admin Panel </h1>
  </div>
</div>
<div class="form">
  <div class="thumbnail"><img src="images/manager.png"/></div>
  <span style="color:red;"><?php if(isset($erreur)){echo $erreur; }?></span>
   <span style="color:green;"><?php if(isset($resultat)){ echo $resultat;} ?></span>
  <form class="login-form" action="index.php" method="post">
    <input type="text" placeholder="Nom" name="nom"/>
    <input type="text" placeholder="Prenom" name="prenom"/>
    <input type="email" placeholder="Mail" name="mail"/>
    <input type="text" placeholder="numTel" name="numTel"/>
    <input type="password" placeholder="Mot de passe" name="motdepass"/>
    <input type="submit"  name="valider" value="valider" />

  </form>
  <div class="cta" style="font-size: 10px;">Account user?<a href="../user/login.php" style="color:#5c4ac7;font-suze: 10px;"> Click an account</a></div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='js/index.js'></script>
</body>

</html>
