<?php
function display_message(){
  if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    $_SESSION['message'] = " ";
  }
}
function set_message($message){
  if(!empty($message)){
    $_SESSION['message'] = $message;
  } else{
    $message = "";
  }
}

function clear_message($message){
  $message = " ";
}

/*function check_jelovnik(){

  $user = get_user();
  $user_id = $user['id_korisnika'];
  $sql = "SELECT * FROM Korisnik WHERE id_korisnika = '$user_id'";
  $result = query($sql);

  while($row = $result -> fetch_assoc()){
    if($row['ponedeljak'] == 'none'){
      echo "
      <form action='dodaj_jeloget_obrok.php'>
      <h1>Niste dodali jelo!</h1>
      <button type='submit' class='btn'>Dodaj jelo</button>
      </form>
 ";
    }

  }


}*/

function get_obrok(){
  $sql = "SELECT * FROM obrok";
  $result = query($sql);

  while ($row = $result -> fetch_assoc())
  echo "  <option value='Empty' selected disabled hidden>Izaberi...</option>
  <option value='".$row['obrok']."'>".$row['obrok']."</option>";
  }

function upisi_iduci_jelovnik(){
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['iduca_nedelja']){
    $ponedeljak = ($_POST['iduci_pon']);
    $utorak = ($_POST['iduci_uto']);
    $sreda = ($_POST['iduci_sre']);
    $cetvrtak = ($_POST['iduci_cet']);
    $petak = ($_POST['iduci_pet']);
  
    $user = get_user();
    $user_id = $user['id_korisnika'];
  
    $sql = "UPDATE korisnik SET
    izabraoJelovnik_iduci = 1
    WHERE id_korisnika = '$user_id'
    ";
  
  
    $sql2 = "UPDATE jelovnik SET
    iduci_pon = '$ponedeljak',
    iduci_uto = '$utorak',
    iduci_sre = '$sreda',
    iduci_cet = '$cetvrtak',
    iduci_pet = '$petak'
    WHERE id_korisnika = '$user_id'
    ";
    
    confirm(query($sql));
    confirm(query($sql2));
    $html = "<p>Uspesno ste izabrali <a href='index.php'> jelovnik </a> za iduću nedelju.</p>";
    set_message($html);
    redirect('jelovnik.php');
    clear_message();
  
}}}


function upisi_tekuci_jelovnik(){
  if($_SERVER["REQUEST_METHOD"] == "POST")
{
  if($_POST['tekuca_nedelja']){
  $ponedeljak = ($_POST['tekuci_pon']);
  $utorak = ($_POST['tekuci_uto']);
  $sreda = ($_POST['tekuci_sre']);
  $cetvrtak = ($_POST['tekuci_cet']);
  $petak = ($_POST['tekuci_pet']);

  $user = get_user();
  $user_id = $user['id_korisnika'];

  $sql = "UPDATE korisnik SET
  izabraoJelovnik_tekuci = 1
  WHERE id_korisnika = '$user_id'
  ";


  $sql2 = "UPDATE jelovnik SET
  tekuci_pon = '$ponedeljak',
  tekuci_uto = '$utorak',
  tekuci_sre = '$sreda',
  tekuci_cet = '$cetvrtak',
  tekuci_pet = '$petak'
  WHERE id_korisnika = '$user_id'
  ";
  
  confirm(query($sql));
  confirm(query($sql2));
  $html = "<p>Uspesno ste izabrali <a href='index.php'> jelovnik </a> za iduću nedelju.</p>";
  set_message($html);
  redirect('jelovnik.php');
  clear_message();
  }
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
    $password = ($_POST['password']);
    $ime_prezime = ($_POST['ime_prezime']);
    $pozicija = ($_POST['pozicija']);
    $confirm_password = ($_POST['confirm_password']);

    if(strlen($email) < 3){
      $errors[] = "Email ne sme biti manji od 3 karaktera";
    }
    
    if(email_exists($email)){
      $errors[] = "Taj email je zauzet!";
    }
    if(strlen($password) < 8){
      $errors[] = "Lozinka mora biti veca od 8 karaktera!";
    }
    if($password != $confirm_password){
      $errors[] = "Lozinke se ne podudaraju!";
    }
    if(!empty($errors)){
      foreach($errors as $error){
        echo '<div class="alert" > ' . $error . '</div>';
      }
      echo "<hr>";
        
    } else{
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      $password = filter_var($password, FILTER_SANITIZE_STRING);
      $ime_prezime = filter_var($ime_prezime, FILTER_SANITIZE_STRING);
      $pozicija = filter_var($pozicija, FILTER_SANITIZE_EMAIL);
      create_user($email, $password, $ime_prezime, $pozicija);
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
                $errors[] = "Pogresni podaci za prijavljivanje, pokusajte ponovo.";
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

function create_user($email, $password, $ime_prezime, $pozicija){
  $email = escape($email);
  $password = escape($password);
  $password = password_hash($password, PASSWORD_DEFAULT);

  $ime_prezime = escape($ime_prezime);
  $pozicija = escape($pozicija);
  
  
  $sql = "INSERT INTO korisnik(email, password, ime_prezime, pozicija, isAdmin, izabraoJelovnik_tekuci, izabraoJelovnik_iduci)";
  $sql .= "VALUES('$email', '$password', '$ime_prezime', '$pozicija', 0, 0 , 0)";

  confirm(query($sql));

  $sql2 = "SELECT * FROM korisnik WHERE email='$email'";
  $result = query($sql2);
  $row = $result-> fetch_assoc();

  $id_korisnika = $row['id_korisnika'];
  $sql3 = "INSERT INTO jelovnik(id_korisnika, tekuci_pon, tekuci_uto, tekuci_sre, tekuci_cet, tekuci_pet, iduci_pon, iduci_uto, iduci_sre, iduci_cet, iduci_pet)";
  $sql3 .= "VALUES('$id_korisnika', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none')";
  confirm(query($sql3));
  set_message("Uspesno ste se registrovali!");
  redirect('login.php');
}

function get_user($id = NULL){
  if($id != NULL){
      $query = "SELECT * FROM korisnik WHERE id_korisnika =" . $id;
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


function check_jelovnik(){
  $user = get_user();
  $user_id = $user['id_korisnika'];
  $sql = "SELECT * FROM korisnik WHERE id_korisnika = '$user_id'";
  $result = query($sql);

  while($row = $result -> fetch_assoc()){
     if($row['izabranoJelo'] = '0'){
     }
  }
}

function iduca_nedelja(){
  echo "<p style='font-size: 20px;'>".date("d.m.Y", strtotime("monday next week"))." - ".date("d.m.Y", strtotime("sunday next week"))."</p>";
}


function tekuca_nedelja(){
  echo "<p style='font-size: 20px;'>".date("d.m.Y.", strtotime("monday this week"))." - ".date("d.m.Y.", strtotime("sunday this week")). "</p>";
}

function izabraoJelovnik_tekuci(){

  $id = get_user();
  $id_korisnika = $id['id_korisnika'];
  $sql = "SELECT * FROM korisnik WHERE id_korisnika='$id_korisnika'";
  $result = query($sql);
  $row = $result-> fetch_assoc();
  if($row['izabraoJelovnik_tekuci'] == 1){
    return 1;
  }
else{
  return 0;
}
}

function izabraoJelovnik_iduci(){
  $id = get_user();
  $id_korisnika = $id['id_korisnika'];
  $sql = "SELECT * FROM korisnik WHERE id_korisnika='$id_korisnika'";
  $result = query($sql);
  $row = $result-> fetch_assoc();
  if($row['izabraoJelovnik_iduci'] == 1){
    return 1;
  }
else
{
  return 0;
}
}


function get_iduci_jelovnik(){
  $user = get_user();
  $user_id = $user['id_korisnika'];
  $query = "SELECT * FROM jelovnik WHERE id_korisnika ='$user_id'";
  $query2 = "SELECT * FROM korisnik WHERe id_korisnika ='$user_id'";
  $result = query($query);
  $result2 = query($query2);
  $row = $result->fetch_assoc();
  $row2 = $result2->fetch_assoc();


  if ($row2['izabraoJelovnik_iduci']!='0') {
      
      $pon = $row['iduci_pon'];
      $uto = $row['iduci_uto'];
      $sre = $row['iduci_sre'];
      $cet = $row['iduci_cet'];
      $pet = $row['iduci_pet'];
      $korisnik = $row2['ime_prezime'];
      echo "
      <div class='center'>
      <table style='width: 100%;'>
      <tr>
      <td class='key'>Ponedeljak:</td>
      <td class='value'> ".$pon."</td> 
      </tr>
      <tr>
      <td class='key'>Utorak:</td>
      <td class='value'> ".$uto."</td> 
      </tr>
      <tr>
      <td class='key'>Sreda:</td>
      <td class='value'> ".$sre."</td> 
      </tr>
      <tr>
      <td class='key'>Cetvrtak:</td>
      <td class='value'> ".$cet."</td> 
      </tr>
      <tr>
      <td class='key'>Petak:</td>
      <td class='value'> ".$pet."</td> 
      </tr>
      </table>
            </div>
            ";
            /*
<button type='submit' class='btn' id='update' onclick='izmeni()'>Izmeni</button>

      
      ";*/
}
  else{
    echo "<div class='container'><h1 text-align: center;'>Niste izabrali jelovnik!</h1>
    
    <form action='jelovnik.php' style='padding-top: 15px;'>
    <button class='btn'>Izaberi jelovnik </button>
    </form>
    </div>";
  }
}


function get_tekuci_jelovnik(){
  $user = get_user();
  $user_id = $user['id_korisnika'];
  $query = "SELECT * FROM jelovnik WHERE id_korisnika ='$user_id'";
  $query2 = "SELECT * FROM korisnik WHERe id_korisnika ='$user_id'";
  $result = query($query);
  $result2 = query($query2);
  $row = $result->fetch_assoc();
  $row2 = $result2->fetch_assoc();


  if ($row2['izabraoJelovnik_tekuci']!='0') {
      
      $pon = $row['tekuci_pon'];
      $uto = $row['tekuci_uto'];
      $sre = $row['tekuci_sre'];
      $cet = $row['tekuci_cet'];
      $pet = $row['tekuci_pet'];
      $korisnik = $row2['ime_prezime'];
     
echo "
<div class='center'>
<table style='width: 100%;'>
<tr>
<td class='key'>Ponedeljak:</td>
<td class='value'>".$pon."</td> 
</tr>
<tr>
<td class='key'>Utorak:</td>
<td class='value'> ".$uto."</td> 
</tr>
<tr>
<td class='key'>Sreda:</td>
<td class='value'> ".$sre."</td> 
</tr>
<tr>
<td class='key'>Cetvrtak:</td>
<td class='value'> ".$cet."</td> 
</tr>
<tr>
<td class='key'>Petak:</td>
<td class='value'> ".$pet."</td> 
</tr>
</table>
      </div>
      ";
}
  else{
    echo "<div class='container'><h1 text-align: center;'>Niste izabrali jelovnik!</h1>
    
    <form action='jelovnik.php' style='padding-top: 15px;'>
    <button class='btn'>Izaberi jelovnik </button>
    </form>
    </div>";
  }
}

//
//function check_jelovnik(){

  //$user = get_user();
  //$user_id = $user['id_korisnika'];
  //$sql = "SELECT * FROM Korisnik WHERE id_korisnika = '$user_id'";
  //$result = query($sql);

  //while($row = $result -> fetch_assoc()){
    //if($row['izabranoJelo'] == '0'){
      //echo "<form action='dodaj_jelo.php'>
      //<button type='submit' class='izmeni'>Dodaj jelo</button>
      //<form>";
    //}

  //}


//}