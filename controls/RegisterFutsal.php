<?php
include "../controls/connection.php";
include "functions.php";
session_start();

if(isset($_FILES['files']) && isset($_POST['time']) && ! empty($_POST['name']) && ! empty($_POST['location']) && ! empty($_POST['contact']) && ! empty($_POST['description']) && ! empty($_POST['price']) )
{
    $message;
    if(strlen($_POST['description']) > 500)
    {
        $message="Description Limit Exceeds";
        // header("Location: ../FutsalRegistration.php?error=Description Limit Exceeds");
    }

    $fileNames = array_filter($_FILES['files']['name']);     
    if(empty($fileNames)){ 
        $message="Pick some images(At least one)";

    }


    if(empty($message))
    {
        $id;
        $name=$_POST['name'];
        $location=$_POST['location'];
        $contact=$_POST['contact'];
        $description=trim($_POST['description']);
        $price=$_POST['price'];
        $longitude=$_POST['longitude'];
        $latitude=$_POST['latitude'];
        $times=$_POST["time"];        
        $files=$_FILES["files"];
        $userid=$_SESSION['id'];
        $todaysdate=date("m/d/Y");

        $sql = "Insert into futsals(Name, Location, ContactNo, Description, Price, Longitude, Latitude, CreatedBy, CreatedDate, ApprovedFlag, DeletedFlag) values('$name', '$location','$contact','$description','$price','$longitude','$latitude', '$userid', '$todaysdate', 'N', 'N')";
    
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $sql="Select FutsalID from futsals where Name='".$name."'";
            $id = $conn->query($sql);
            if($id)
            {
            $id = mysqli_fetch_all($id);
            $id=$id[0][0];
            foreach($times as $time) {
            
                $sql = "Insert into futsaltime(FutsalID, TimeID) values('$id', '$time')";    
                $result2 = mysqli_query($conn, $sql);
                if(!$result2)
                {
                    header("Location: ../FutsalRegistration.php?error=something went wrong!");
                }
            }
            $uploaded=uploadImage($files, $id, $conn, "../assets/images/Futsals/");
            if($uploaded=="true")
            {
                header("Location: ../FutsalRegistration.php?success=true");   
            } 
            else
            {
                header("Location: ../FutsalRegistration.php?error=".$uploaded."");
            }
            }else
            {
                header("Location: ../FutsalRegistration.php?error=something went wrong!");


            }

        }
        else
        {
            
        }
          
    }
    else{
        header("Location: ../FutsalRegistration.php?error=".$message."");
    }        
}
else
{
    header("Location: ../FutsalRegistration.php?error=Please fill out all fields");
}

?>
