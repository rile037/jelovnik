<?php
function display_message(){
  if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
  }
}
function set_message($message){
  if(!empty($message)){
    $_SESSION['message'] = $message;
  } else{
    $message = "";
  }
}



/*function check_jelovnik(){

  $user = get_user();
  $user_id = $user['id_korisnika'];
  $sql = "SELECT * FROM Korisnik WHERE id_korisnika = '$user_id'";
  $result = query($sql);

  while($row = $result -> fetch_assoc()){
    if($row['ponedeljak'] == 'none'){
      echo "
      <form action='dodaj_jelo.php'>
      <h1>Niste dodali jelo!</h1>
      <button type='submit' class='btn'>Dodaj jelo</button>
      </form>
 ";
    }

  }


}*/

function get_jelovnik(){
  $sql = "SELECT * FROM obrok";
  $result = query($sql);

  while ($row = $result -> fetch_assoc())
  echo "  <option value='Empty' selected disabled hidden>Izaberi...</option>
  <option value='".$row['obrok']."'>".$row['obrok']."</option>";
  }

function upisi_jelovnik(){
  if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $ponedeljak = ($_POST['pon']);
  $utorak = ($_POST['uto']);
  $sreda = ($_POST['sre']);
  $cetvrtak = ($_POST['cet']);
  $petak = ($_POST['pet']);

  $user = get_user();
  $user_id = $user['id_korisnika'];

  $sql = "UPDATE korisnik SET
  ponedeljak= '$ponedeljak',
  utorak= '$utorak',
  sreda= '$sreda',
  cetvrtak= '$cetvrtak',
  petak= '$petak'
  WHERE id_korisnika = '$user_id'
  ";
  
  confirm(query($sql));
  $html = "<p>Uspesno ste izabrali <a href='index.php'> jelovnik </a> za iducu nedelju.</p>";
  set_message($html);
  redirect('dodaj_jelo.php');

}
}

function login_check_pages(){
  if(isset($_SESSION['email'])){
    redirect('index.php');
  }
}


function email_exists($email){
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $query = "SELECT id_korisnika FROM korisnik WHERE email = '$email'";
  $result = query($query);

  if($result->num_rows > 0){
    return true;
  }else{
    return false;
  }
}
function user_exists($email){
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $query = "SELECT email FROM korisnik WHERE email = '$email'";
  $result = query($query);

  if($result->num_rows > 0){
    return true;
  }else{
    return false;
  }
}

function validate_user_registration(){
  $errors = [];

  if($_SERVER['REQUEST_METHOD'] == "POST"){

    $email = ($_POST['email']);
    $ime_prezime = ($_POST['ime_prezime']);
    $pozicija = ($_POST['pozicija']);
    $password = ($_POST['password']);
    $confirm_password = ($_POST['confirm_password']);

    if(strlen($email) < 3){
      $errors[] = "- Email ne sme biti manji od 3 karaktera";
    }
    
    if(email_exists($email)){
      $errors[] = "- Taj email je zauzet!";
    }
    if(strlen($password) < 8){
      $errors[] = "- Lozinka mora biti veca od 8 karaktera!";
    }
    if($password != $confirm_password){
      $errors[] = "- Lozinke se ne podudaraju!";
    }
    if(!empty($errors)){
      foreach($errors as $error){
        echo "<div class='
        alert' style='
        color: red;
        text-align: center;
        font-size: 20px;
        '>" . $error . "</div>";
      }
    } else{
      $ime_prezime = filter_var($ime_prezime, FILTER_SANITIZE_STRING);
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      $pozicija = filter_var($pozicija, FILTER_SANITIZE_EMAIL);
      $password = filter_var($password, FILTER_SANITIZE_STRING);
      create_user($ime_prezime, $email, $pozicija, $password);
    }

  }
}

function redirect($location){
  header("location: {$location}");
  exit();
}

function validate_user_login()
{
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = ($_POST['email']);
        $password = ($_POST['password']);

        if (empty($email)) {
            $errors[] = "Polje za email ne sme biti prazan.";
        }
        if (empty($password)) {
            $errors[] = "Polje za lozinku ne sme biti prazno.";
        }
        if (empty($errors)) {
            if (user_login($email, $password)) {
                redirect('index.php');
            } else {
                $errors[] = "- Pogresni podaci za prijavljivanje, pokusajte ponovo.";
            }
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="alert" > ' . $error . '</div>';
            }
            echo "<hr>";
        }
    }

}

function user_login($email, $password)
{
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $query = "SELECT * FROM korisnik WHERE email='$email'";
    $result = query($query);

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();

        if (password_verify($password, $data['password'])) {
            $_SESSION['email'] = $email;
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function create_user($ime_prezime, $email, $pozicija, $password){
  $ime_prezime = escape($ime_prezime);
  $email = escape($email);
  $pozicija = escape($pozicija);
  $password = escape($password);
  $password = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO korisnik(ime_prezime, email, pozicija, password, ponedeljak, utorak, sreda, cetvrtak, petak)";
  $sql .= "VALUES('$ime_prezime', '$email', '$pozicija', '$password', 'none', 'none', 'none', 'none', 'none')";

  confirm(query($sql));
  set_message("Uspesno ste se registrovali!");
  redirect('login.php');
}

function get_user($id = NULL){
  if($id != NULL){
      $query = "SELECT * FROM korisnik WHERE id =" . $id;
      $result = query($query);

      if($result->num_rows > 0){
        return $result->fetch_assoc();
      }else{
        return "User not found!";
      }

  }else
    {
    $query = "SELECT * FROM korisnik WHERE email='" . $_SESSION['email'] . "'";
    $result = query($query);
    }
  if($result->num_rows > 0)
  {
    return $result->fetch_assoc();
  }else{
    return "User not found!";
  }
}

function user_restriction(){
  if(!isset($_SESSION['email'])){
    redirect('login.php');
  }
}

function isAdmin(){
  $user = get_user();
  $user_id = $user['id_korisnika'];
  $sql = "SELECT * FROM korisnik WHERE id_korisnika = '$user_id'";
  $result = query($sql);
  $row = $result->fetch_assoc();
  if($row['isAdmin'] == 1){
    echo"<span class='navbar-text'>
    <a class='nav-link' href='admin.php'><b id='admin'>Admin</b> <span class='sr-only'>(current)</span></a>
    </span>";
  }
  else{
    echo "";
  }
}

function popuni_select(){
    $user = get_user();
    $user_id = $user['id_korisnika'];
    $query = "SELECT * FROM korisnik WHERE id_korisnika ='$user_id'";
    $result = query($query);
    $row = $result->fetch_assoc();
        $pon = $row['ponedeljak'];
        $uto = $row['utorak'];
        $sre = $row['sreda'];
        $cet = $row['cetvrtak'];
        $pet = $row['petak'];
    
}

function profile(){
  $user = get_user();
  $user_id = $user['id_korisnika'];
  $sql = "SELECT * FROM korisnik WHERE id_korisnika = '$user_id'";
  $result = query($sql);

  while($row = $result -> fetch_assoc()){
      echo "
      <div class='center'>
      <div class='container'>
      <h1>Podaci korisnika</h1>
<hr style='background-color: black;'>
<div style='text-align: left;'>
        <p>Jedinstveni broj: <b><u>".$row['id_korisnika']."</u></b></p>
        <p>Ime i prezime: <b>".$row['ime_prezime']."</b></p>
        <p>E-mail adresa: <b>".$row['email']."</b></p>
        <p>Radno mesto: <b>".$row['pozicija']."</b></p>
        <p>Pocetak radnog odnosa: <b>12.01.2023.</b></p>
        </div>
      </div>
      </div>
      ";
  }
}

function izlistaj_sve_zaposlene(){
  $query = "SELECT * FROM korisnik ORDER BY id_korisnika ASC";
  $result = query($query);
  while($row = $result->fetch_assoc()) {   
    echo" 
      <p>". $row['ime_prezime'] . "</p>";
  }
 
}


function get_jelo(){
  $user = get_user();
  $user_id = $user['id_korisnika'];
  $query = "SELECT * FROM korisnik WHERE id_korisnika ='$user_id'";
  $result = query($query);
  $row = $result->fetch_assoc();
  if ($row['ponedeljak']!='') {
      $pon = $row['ponedeljak'];
      $uto = $row['utorak'];
      $sre = $row['sreda'];
      $cet = $row['cetvrtak'];
      $pet = $row['petak'];
      $korisnik = $row['ime_prezime'];
      echo "
      <table class='styled-table'>
    <thead>
        <tr>
            <th>Dan</th>
            <th>Jelo</th>
        </tr>
    </thead>
    <tbody>
    <tr class='kolone'>
          <td><b>Ponedeljak</b></td>
          <td id='kolonaPon'>". $pon ."</td>
        </tr>
        <tr class='kolone'>
          <td id='kUto'><b>Utorak</b></td>
          <td id='kolonaUto'>" . $uto ."</td>
        </tr>
        <tr class='kolone'>
          <td><b>Sreda</b></td>
          <td id='kolonaSre'>" . $sre ."</td>
        </tr>
        <tr class='kolone'>
          <td id='kCet'><b>Cetvrtak</b></td>
          <td id='kolonaCet'>" . $cet . "</td>
        </tr>
        <tr class='kolone'>
          <td id='kPet'><b>Petak</b></td>
          <td id='kolonaPet'>" . $pet . "</td>
        </tr>
        
       
    </tbody>

</table>
      
      
      ";
}
  else{
    echo "<div class='container'><h1 text-align: center;'>Niste izabrali jelovnik!</h1>
    
    <form action='dodaj_jelo.php' style='padding-top: 15px;'>
    <button class='btn'>Izaberi jelovnik </button>
    </form>
    </div>";
  }
}


function check_jelovnik(){

  $user = get_user();
  $user_id = $user['id_korisnika'];
  $sql = "SELECT * FROM Korisnik WHERE id_korisnika = '$user_id'";
  $result = query($sql);

  while($row = $result -> fetch_assoc()){
    if(!$row['ponedeljak'] == 'none'){
      echo "<form action='dodaj_jelo.php'>
      <button type='submit' class='izmeni'>Dodaj jelo</button>
      <form>";
    }
    else{
      echo "<div class='center'><button type='submit' class='btn' id='update' onclick='izmeni()'>Izmeni</button></div>";
    }
  }


}