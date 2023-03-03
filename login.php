<?php include('inc/header.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anaheim&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pocetna</title>
</head>
<body>
  <div class='main'>
    <div class='center'>
  <div class='container'>
    <?php validate_user_login();?>
  <img id='img' src='assets/restaurant.png' width='74px' height='74px'></img>
  <p id='text'>Dobrodošli nazad!<br>
<span id='text2'>Prijavite se</span></p>

<form method='POST'>
  <input class='input' type='text' name='email' id='email' placeholder='E-mail'><br>
<input class='input' name='password' type='password' id='password' placeholder='Password'><br>
<input  style='letter-spacing: 1px; 'class='btn' type='submit' value='PRIJAVA'>
</form>
<hr style='margin-top: 25px;'>
<h4><a href='register.php'>Registrujte se</a></h4>
<br>
<div style='color: green;'>
<?php display_message();?>
</div>

</div>
</div>

</div>
</div>
</body>
</html>