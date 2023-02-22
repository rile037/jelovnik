<?php

$con = mysqli_connect("localhost", "root", "", "jelovnik");
if (!$con) {
  // whatever processing you want to do upon error in connection
  // like log error or send an email to admin
  // I am just printing the error at the moment.
  echo mysqli_connect_errno() . ":" . mysqli_connect_error();
  exit;
}
function escape($string){
  global $con;
  return mysqli_real_escape_string($con, $string);
}

function query($query){
  global $con;
  return mysqli_query($con, $query);
}

function confirm($result){
  global $con;
  if(!$result){
    die("QUERY FAILED " . mysqli_error($con));
  }
}
