<?php include('inc/header.php');
display_message();
login_check_pages();
?>

<html>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <script src="script.js"></script>
  <title>Jelovnik</title>
</head>
  <body>
    <div class='main'>
    <div class='center'>
    <div class='container' style='margin-bottom: 30px;'>
    <?php validate_user_registration();?>
    <img id='img' src='assets/restaurant.png' width='74px' height='74px'></img>
  <p id='text'>Registrujte se<br>
   <form method="POST" id="forma">

      <input class='input' type='text' name='email' id='email' placeholder='E-mail' required><br>
<input class='input' name='password' type='password' id='password' placeholder='Lozinka' required><br>
<input class='input' name='confirm_password' type='password' id='password' placeholder='Potvrdite lozinku' required><br>
<input class='input' type='text' name='ime_prezime' id='ime_prezime' placeholder='Ime i prezime' required><br>
<input class='input' type='text' name='pozicija' id='pozicija' placeholder='Pozicija' required><br>

<input  style='letter-spacing: 1px; 'class='btn' type='submit' value='REGISTRACIJA'>
        
      </form>
</div>
</div>
      
</div>
  </body>
</html>

