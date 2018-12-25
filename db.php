<?php
   // make a connection with database 
   $conn = new PDO('mysql:host=localdb;dbname=localdb', 'root', '');
   echo "<h2>You are now connected to database</h2> <br>";
    //set up the error mode for exception handling 
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
    