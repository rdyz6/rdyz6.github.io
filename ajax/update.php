<?php
$connect = mysqli_connect("localhost", "root", "Toothless521", "CS4380") or die("can not connect to database:".mysqli_connect_error());
error_reporting(0);
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE user SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>