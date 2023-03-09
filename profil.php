<?php include('inc/header.php');
user_restriction();
user_profile_image_upload();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
</head>
<body>
  <div class='main'>
    <div class='center'>
<div class='container' id='container-profile'>
  <?php 
  display_message();
  $user = get_user();
  $user_id = $user['id_korisnika'];
  get_profile_data($user_id);?>
</div>
</div>
</div>
<script>


</script>

</body>
</html>