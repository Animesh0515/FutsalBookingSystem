<?php

include "../controls/connection.php";
$success=null;

if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['address']) && isset($_POST['phoneno']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role']))
{
    

      $username = $_POST['username'];
      $role=$_POST['role'];
      $sql = "Select * from users where username='$username' and  role='$role'";
    
      $result = mysqli_query($conn, $sql);
      
      $num = mysqli_num_rows($result);

      if($num ==0)
      {
      $password = $_POST['password'];
      if(strlen($password) <= 6)
      {
        header("Location: ../Signup.php?error=Password must have greater than 6 character");
      }
      else
      {
        // Hashing the password
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $address=$_POST['address'];
        $phoneno=$_POST['phoneno'];
        $password = md5($_POST['password']);
        $todaydate=date("Y-m-d H:i:s");
        $sql = "Insert into users(FirstName, LastName, Address, PhoneNumber, UserName, Password, Role, CreatedDate, DeletedFlag) values('$firstname', '$lastname','$address','$phoneno','$username','$password','$role', ' $todaydate','N')";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
              $success=true;
              header("Location: ../Signup.php?success=true");
              // echo 'div class="alert alert-success">
              // <a href="#" class="close" data-dismiss="alert">&times;</a>
              // <strong>Successfull!</strong> Redirecting please wait.
              // </div>';
              //  header('Refresh: 10; URL=../Login.php');
                
            }
            else{
              $success=false;
              header("Location: ../Signup.php??success=true");
            }


      }
      }
      else
      {
        
        header("Location: ../Signup.php?error=Username already exists");
      }
}
else
{
    header("Location: ../Signup.php?error=Please fill out all fields");
}
?>