<?php

include ("functions/init.php");
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type='image/png' sizes="57x57" href='../assets/logo.png'>
    <script src="script.js"></script>
    
  <nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color:#000; font-size:28px;"></i></span>
  </button>
  <div class="collapse navbar-collapse" style='font-size: 20px;' id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a id='logo' href='index.php'>Jelovnik.rs</a>
      </li>
    </ul>


    <?php if(!isset($_SESSION['email'])) : ?>
      
      <span class="navbar-text">     
    <a class="nav-link" href="login.php">Prijavi se <span class="sr-only"></span></a>
    </span>
   
   
    <?php else: ?>
      <?php if(isAdmin() == 1):?>
    <span class="navbar-text">     
    <a class="nav-link" href="admin.php"><b>Admin</b> <span class="sr-only"></span></a>
    </span>
    <?php endif;?>
      <span class="navbar-text">     
    <a class="nav-link" href="profil.php"><b>Profil</b> <span class="sr-only"></span></a>
    </span>

    <span class="navbar-text">     
    <a class="nav-link" href="#" style='padding-left: 0px; padding-right: 0px;'>| <span class="sr-only"></span></a>
    </span>
      <span class="navbar-text" >     
    <a class="nav-link" href="index.php">Po??etna <span class="sr-only"></span></a>
    </span>

    <span class="navbar-text">
    <a class="nav-link" href="jelovnik.php">Jelovnik <span class="sr-only"></span></a>
    </span>
    
    <span class="navbar-text">
    <a class="nav-link" href="logout.php">Odjavi se <span class="sr-only"></span></a>
    </span>
    <?php endif;?>
  </div>
  
</nav>
<body>
