<?php
$conn = new mysqli("localhost","root","","proformation");
if($conn->connect_error){
  die("فشل الاتصال");
}
$conn->set_charset("utf8");
?>
