<?php
include "connection.php";
session_start();
if(isset($_POST['name']) && ! empty($_POST['name']))
      {
          $futsalname=$_POST['name'];
        $futsals = $conn->query("SELECT * FROM futsals where lower(Name) like '%".$futsalname."%'");
        if ($futsals) {
            $futsals = mysqli_fetch_all($futsals);
            $_SESSION["searchedItems"]=$futsals;
            $_SESSION["searchedText"]=$futsalname;
            echo "success";
        }
        
      }
?>