<?php
session_start();
error_reporting(0);

include("../Database/DataBase.php");

 // Code pour mettre a jour le profil
 if(isset($_SESSION['id']))
  {
     $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ? ");
      $requser->execute(array($_SESSION['id']));
      $user = $requser->fetch();

      // Code pour modifier le Nom
      if(isset($_POST['newNom']) and !empty($_POST['newNom']) and $_POST['newNom'] != $user['nom'])
      {
          $newNom = htmlspecialchars($_POST['newNom']);
        $requeteNom = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ? ");
          $requeteNom->execute(array($newNom, $_SESSION['id']));
          header('Location: dashboard.php?id='.$_SESSION['id']);

      }
      // Code pour modifier le Prenom
      if(isset($_POST['newPrenom']) and !empty($_POST['newPrenom']) and $_POST['newPrenom'] != $user['prenom'])
      {
          $newPrenom = htmlspecialchars($_POST['newPrenom']);
        $requetePrenom = $bdd->prepare("UPDATE membres SET prenom = ? WHERE id = ? ");
          $requetePrenom->execute(array($newPrenom, $_SESSION['id']));
          header('Location: dashboard.php?id='.$_SESSION['id']);



      }

      // Code pour modifier le Mail
       if(isset($_POST['newMail']) and !empty($_POST['newMail']) and $_POST['newMail'] != $user['mail'])
      {
          $newMail = htmlspecialchars($_POST['newMail']);
        $requeteMail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ? ");
          $requeteMail->execute(array($newMail, $_SESSION['id']));
          header('Location: dashboard.php?id='.$_SESSION['id']);



      }
      // Code pour modifier le Numero de téléphone
       if(isset($_POST['newNumTel']) and !empty($_POST['newNumTel']) and $_POST['newNumTel'] != $user['numTel'])
      {
          $newNumtel = htmlspecialchars($_POST['newNumTel']);
        $requeteNumTel = $bdd->prepare("UPDATE membres SET numTel = ? WHERE id = ? ");
          $requeteNumTel->execute(array($newNumTel, $_SESSION['id']));
          header('Location: dashboard.php?id='.$_SESSION['id']);



      }

      //Code pour modifier le Mot passe
       if(isset($_POST['newMotdepass']) and !empty($_POST['newMotdepass']) and $_POST['newMotdepass'] != $user['motdepass'])
      {
          $newMotdepass = sha1($_POST['newMotdepass']);
        $requeteMotdepass = $bdd->prepare("UPDATE membres SET newMotdepass = ? WHERE id = ? ");
          $requeteMotdepass->execute(array($newMotdepass, $_SESSION['id']));
          header('Location: dashboard.php?id='.$_SESSION['id']);



      }

  }
 //Fin du code
  if(empty( $_SESSION['id']))
  {
  	header('location:index.php');
  }
  else
  {
?>
<!DOCTYPE html>
<html lang="en">
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Panel</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Login css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">
</head>

<body class="fix-header">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <div id="main-wrapper">

        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">

            <div class="navbar-header">
                    <a class="navbar-brand" href="#">
												<span class="btn btn-primary">Editer profil  <?php echo $user['nom'] ;?> <?php echo $user['prenom'] ; ?></span>
                        <!-- <span><img src="" alt="homepage" class="dark-logo" /></span> -->
                    </a>
                </div>

                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>




                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> <span style="font-size: 10px">Logout</span></a></li>
                                    <!-- <li><a href="logout.php"><i class="fa fa-edit"></i> <span style="font-size: 10px">Modifier</span></a></li> -->
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="left-sidebar">

            <div class="scroll-sidebar">

                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li>

                          <!-- <a href="dashboard.php?id= ".$_SESSION['id']><i class="fa fa-tachometer"></i><span>Dashboard</span></a> -->

                        </li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php">  <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <!-- <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Restaurant</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_restaurant.php">All Restaurant</a></li>
								<li><a href="add_category.php">Add Category</a></li>
                                <li><a href="add_restaurant.php">Add Restaurant</a></li>

                            </ul>
                        </li> -->
                       <!-- <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_menu.php">All Menues</a></li>
								<li><a href="add_menu.php">Add Menu</a></li>


                            </ul>
                        </li> -->
						 <!-- <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li> -->

                    </ul>
                </nav>

            </div>

        </div>

        <div class="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Editer son profil <?php ?></h4>
                            </div>

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
                              <form class="login-form" action="" method="post">
                                <input type="text" placeholder="Nom" name="newNom" value="<?php echo $user['nom'] ;?>"/>
                                <input type="text" placeholder="Prenom" name="newPrenom" value="<?php echo $user['prenom'] ;?>"/>
                                <input type="email" placeholder="Mail" name="newMail" value="<?php echo $user['mail'] ;?>"/>
                                <input type="text" placeholder="numTel" name="newNumTel" value="<?php echo $user['numTel'] ;?>"/>
                                <input type="password" placeholder="Mot de passe" name="newMotdepass" value="<?php echo $user['motdepass'] ;?>"/>
                                <input type="submit" value="Mettre a jour son profil" />

                              </form>

                            </div>
                              <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
                              <script src='js/index.js'></script>
                            </body>
                            </div>
                        </div>
						 </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <footer class="footer"> © 2022 - Online Food Ordering System</footer>

        </div>
    </div>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

</body>

</html>
<?php
}
?>
