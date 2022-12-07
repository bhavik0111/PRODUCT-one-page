<?php

 $dbhost ="localhost";
 $dbusername ="root";
 $dbpassword ="";
 $dbname ="category_master";

 $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

  if(!$conn)
  {
    echo "database could not connect" .mysqli_error($conn);
  }
?>
