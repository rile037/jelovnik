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


function promeni_jelovnik(){
  $user = get_user();
    $user_id =$user['id_korisnika'];
    $sql = "SELECT * FROM jelovnik WHERE id_korisnika ='$user_id' ";
    $result = query($sql);
    while($row = $result -> fetch_assoc())
    {

      $iduci_pon = $row['iduci_pon'];
      $iduci_uto = $row['iduci_uto'];
      $iduci_sre = $row['iduci_sre'];
      $iduci_cet = $row['iduci_cet'];
      $iduci_pet = $row['iduci_pet'];
      echo $iduci_pon;

      $sql2 = "UPDATE jelovnik SET 
      tekuci_pon = '$iduci_pon',
      tekuci_uto = '$iduci_uto',
      tekuci_sre = '$iduci_sre',
      tekuci_cet = '$iduci_cet',
      tekuci_pet = '$iduci_pet'
      WHERE id_korisnika = '$user_id'
      ";

      $sql3 = "UPDATE jelovnik SET 
      iduci_pon = 'none',
      iduci_uto = 'none',
      iduci_sre = 'none',
      iduci_cet = 'none',
      iduci_pet = 'none'
      WHERE id_korisnika = '$user_id'
      ";

      $sql4 = "UPDATE korisnik SET
      izabraoJelovnik_iduci = 0
      WHERE id_korisnika = '$user_id'
      ";
      confirm(query($sql2));
      confirm(query($sql3));
      confirm(query($sql4));

    }
}

function proveri_datum()
{

$currentDate = date("d.m.Y");
$currentTime = date("H:i:s");

$thisWeekDay = date("d.m.Y.", strtotime("sunday this week"));
$thisWeekHour = date("H:i", strtotime("23:59"));
$result =  date("d.m.Y H:i:s", strtotime($currentDate . $currentTime));

if($currentDate = $thisWeekDay){

  if ($currentTime > $thisWeekHour) 
  {
    promeni_jelovnik();
  }
}
}

function user_profile_image_upload()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $target_dir = "user/";
        $user = get_user();
        $user_id = $user['id_korisnika'];
        $target_file = $target_dir . $user_id . "." .pathinfo(basename($_FILES["profile_image_file"]["name"]), PATHINFO_EXTENSION);;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $error = "";

        $check = getimagesize($_FILES["profile_image_file"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["profile_image_file"]["size"] > 5000000) {
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            set_message('Error uploading file: '. $error);
        } else {
            $sql = "UPDATE korisnik SET fotografija='$target_file' WHERE id_korisnika=$user_id";
            confirm(query($sql));
            $html = "<h5 style='color: green;'>Uspesno ste promenili fotografiju!<h5>";
            set_message($html);

            if (!move_uploaded_file($_FILES["profile_image_file"]["tmp_name"], $target_file)) {
                set_message('Error uploading file: '. $error);
            }
        }

        redirect('profil.php');
    }
  }

function get_profile_data($id)
{
  $sql = "SELECT * FROM korisnik WHERE id_korisnika='$id'";
  $result = query($sql);

  while($row = $result -> fetch_assoc()){
    echo 
    "
    <img src='".$row['fotografija']."' id='img-profile'/ >
    <br>
    <button class='btn' onclick='open_file()'>Promeni fotografiju</button>
    <form method='POST' enctype='multipart/form-data' id='inp'>
    <input type='file' id='input_file' name='profile_image_file' hidden>
    <input type='submit' id='save-button' class='btn' style='background-color: green;' value='Sačuvaj promene' name='submit' hidden>
    </form>
        <hr>
    <h1>".$row['ime_prezime']."</h1>
    <hr>
    <h4>".$row['email']."</h4>
    <h4>".$row['pozicija']."</h4>
    
    ";
  }
}

function get_obrok(){
  $sql = "SELECT * FROM obrok";
  $result = query($sql);

  while ($row = $result -> fetch_assoc())
  echo "  <option value='Empty' selected disabled hidden>Izaberi...</option>
  <option value='".$row['obrok']."'>".$row['obrok']."</option>";
  }

function upisi_iduci_jelovnik(){
  $errors;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['iduca_nedelja']))
    {
    if(!isset($_POST['iduci_pon']) or !isset($_POST['iduci_uto']) or !isset($_POST['iduci_sre']) or !isset($_POST['iduci_cet']) or !isset($_POST['iduci_pet']))
    {
        $errors = "<p style='color: red;'>Greska, obrok nije izabran.</p>";
    }
    else{
        $ponedeljak = $_POST['iduci_pon'];
        $utorak = ($_POST['iduci_uto']);
        $sreda = ($_POST['iduci_sre']);
        $cetvrtak = ($_POST['iduci_cet']);
        $petak = ($_POST['iduci_pet']);
    }
  
    $user = get_user();
    $user_id = $user['id_korisnika'];

    if(!empty($errors))
    {
      set_message($errors);
    } 
else
{
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
    $html = "<p>Uspesno ste izabrali <a href='index.php'> jelovnik</a>.</p>";
    set_message($html);
    redirect('jelovnik.php');
    clear_message();
  
}
}
}
}


function upisi_tekuci_jelovnik(){
  $errors;
  if($_SERVER["REQUEST_METHOD"] == "POST")
{
  if(isset($_POST['tekuca_nedelja']))
  {
    if(!isset($_POST['tekuci_pon']) or !isset($_POST['tekuci_uto']) or !isset($_POST['tekuci_sre']) or !isset($_POST['tekuci_cet']) or !isset($_POST['tekuci_pet']))
    {
        $errors = "<p style='color: red;'>Greska, obrok nije izabran.</p>";
    }
    else{
        $ponedeljak = $_POST['tekuci_pon'];
        $utorak = ($_POST['tekuci_uto']);
        $sreda = ($_POST['tekuci_sre']);
        $cetvrtak = ($_POST['tekuci_cet']);
        $petak = ($_POST['tekuci_pet']);
    }

    $user = get_user();
    $user_id = $user['id_korisnika'];
  if(!empty($errors)){
        set_message($errors);
    } 
  else
  {
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
  $html = "<p>Uspesno ste izabrali <a href='index.php'> jelovnik.</a>.</p>";
  set_message($html);
  redirect('jelovnik.php');
  clear_message();
  }
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
  
  
  $sql = "INSERT INTO korisnik(email, password, ime_prezime, pozicija, fotografija, isAdmin, izabraoJelovnik_tekuci, izabraoJelovnik_iduci)";
  $sql .= "VALUES('$email', '$password', '$ime_prezime', '$pozicija', 'user//user.png', 0, 0 , 0)";

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
    return 1;
  }
  else{
    return 0;
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
            <div class='center'>
            <form action='izmeni.php' target='_blank' method='POST' name='iduci_jelovnik'>
            <button type='submit' class='btn' id='izmeni' name='iduci_jelovnik'>Izmeni</button>
            </form>
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

function izmeni_jelovnik(){
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST['iduci_jelovnik']))
    {
      iduca_nedelja();
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
<form method='POST' id='upisi_iduci_jelovnik'>

<table style='width: 100%;'>
<tr class='sveKolone'>
<td class='key'>Ponedeljak:</td>
<td class='value'>
<select style='width: 200px; height: 25px;' name='iduci_pon' id='iduci_pon' form='upisi_iduci_jelovnik'>
"; get_obrok(); echo"
</select>
</td>
<tr>
<td class='key'>Utorak:</td>
<td class='value'>
<select style='width: 200px; height: 25px;' name='iduci_uto' id='iduci_uto' form='upisi_iduci_jelovnik'>
"; get_obrok(); echo"
</select>
</td> 
</tr>
<tr>
<td class='key'>Sreda:</td>
<td class='value'>
<select style='width: 200px; height: 25px;' name='iduci_sre' id='iduci_sre' form='upisi_iduci_jelovnik'>
"; get_obrok(); echo"
</select>
</td> 
</tr>
<tr>
<td class='key'>Cetvrtak:</td>
<td class='value'>
<select style='width: 200px; height: 25px;' name='iduci_cet' id='iduci_cet' form='upisi_iduci_jelovnik'>
"; get_obrok(); echo"
</select>
</td> 
</tr>
<tr>
<td class='key'>Petak:</td>
<td class='value'>
<select style='width: 200px; height: 25px;' name='iduci_pet' id='iduci_pet' form='upisi_iduci_jelovnik'>
"; get_obrok(); echo"
</select>
</td> 
</tr>
</table>
</form>
</div>
<button type='submit' class='btn' id='update' onclick='sacuvaj()'>Sačuvaj</button>
";
    }
  }
}
}

?>