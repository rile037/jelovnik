<?php include('inc/header.php');
login_check_pages();
?>


<div>
<?php
display_message();
validate_user_registration();

?>
</div>
<html>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <script src="script.js"></script>
  <title>JS vezbanje</title>
</head>
  <body>
    <div class='center'>
    <div class='container' style='margin-bottom: 30px;'>
  <div class="form">
      <form method="POST" id="forma">
        <h1 style="text-align: center">
        Registracija korisnika
          
        </h1>


        <p class="cred" id="email">E-mail</p>
        <input
          type="email"
          class="input"
          name="email"
          placeholder="Unesite E-mail adresu..."
          required
        >


        
        <p class="cred" id="password">Lozinka</p>
        <input
          type="password"
          class="input"
          name="password"
          placeholder="Unesite lozinku..."
          id="id_password"
          required
        >

        <p class="cred" id="re-enterPass">Potvrda lozinke</p>

        <input
          type="password"
          class="input"
          placeholder="Potvrdite lozinku..."
          name="confirm_password"
          id="id_password1"
          required
        >

        <p class="cred" id="ime_prezime">Ime i prezime</p>
        <input 
        type="text" 
        name="ime_prezime" 
        class="input" 
        placeholder="Unesite ime i prezime..." 
        required
        >

        <p class="cred" id="pozicija">Radno mesto</p>
        <input 
        type="text" 
        name="pozicija" 
        class="input" 
        placeholder="Unesite ime i prezime..." 
        required
        >



        <input class="buttonRegister" style='width: 100%;' value="Registruj se" type="submit" name="register_submit">
      </form>
</div>
</div>
      
</div>
  </body>
</html>

