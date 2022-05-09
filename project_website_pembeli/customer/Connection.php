<?php 
 $conn = new mysqli("localhost", "root", "","projectweb");
 if($conn->connect_error){
     die("Connection failed!".$conn->connect_error);
 }
?>