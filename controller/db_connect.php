<?php 
$conn=mysqli_connect("localhost","root","","prodi_arsitektur_unwira");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
