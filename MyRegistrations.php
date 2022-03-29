<?php 
include "controls/connection.php";
include "controls/functions.php";
 if(isset($_POST['submit']))
{
  if( isset($_POST['time']) && ! empty($_POST['name']) && ! empty($_POST['location']) && ! empty($_POST['contact']) && ! empty($_POST['description']) && ! empty($_POST['price']))
  {
    $name=$_POST['name'];
    $location=$_POST['location'];
    $contact=$_POST['contact'];
    $description=trim($_POST['description']);
    $price=$_POST['price'];
    $longitude=$_POST['longitude'];
    $latitude=$_POST['latitude'];
    $times=$_POST["time"];        
    $futsalid=$_POST['submit'];
    $sql = "update futsals set Name='$name', Location='$location', ContactNo='$contact', Description='$description', Price='$price', Longitude='$longitude', Latitude='$latitude' where futsalid='$futsalid'";
    
    $result = mysqli_query($conn, $sql);
    if($result)
    {
      $sql="Delete from futsaltime where futsalid='$futsalid'";
        $result1=mysqli_query($conn, "Delete from futsaltime where futsalid='$futsalid'");
        if($result1)
        {
          foreach($times as $time)
          {
            $insertime=mysqli_query($conn, "Insert into futsaltime(FutsalID, TimeID) values('$futsalid', '$time')");
            if(! $insertime)
            {
              header("Location: ../MyRegistrations.php?error=something went wrong!");
            }
          }
          header("Location: ../MyRegistrations.php?success=true");   
        }
    }
    else
    {
      header("Location: MyRegistrations.php?error=something went wrong!");
    }

  }
  else
    {
      header("Location: MyRegistrations.php?error=Fields cannot be empty");
    }
}

if(isset($_POST['delete']) && ! empty($_POST['delete']))
{
  $imageId=$_POST['delete'];
  $sql="Delete from futsalimages where imageid='$imageId'";
  $result = mysqli_query($conn, $sql);
  if($result)
  {
    header("Location: MyRegistrations.php");
  }


}
if(isset($_POST['upload']))
{
if(isset($_FILES['files']) && ! empty($_FILES['files']))
{
  $fileNames = array_filter($_FILES['files']['name']);
  if(empty($fileNames)){ 
    header("Location: MyRegistrations.php?error=Select some image file first.");
  }
  else
  {
    $uploaded=uploadImage($_FILES['files'], $_POST['upload'], $conn, "assets/images/Futsals/");
    if($uploaded=="true")
    {
      header("Location: MyRegistrations.php");
    }
    else
    {
      header("Location: MyRegistrations.php?error=something went wrong!");
    }
  }

}
else
{
  header("Location: MyRegistrations.php?error=Select some image file first.");
}
}
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    
        <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
        <style>
          /* .container {
            position: relative;
            width: 100%;
            max-width: 15.8rem;
          } */

          /* Make the image to responsive */
          .image {
            width: 15rem;
            height: 10.5rem;
          }

          /* The overlay effect (full height and width) - lays on top of the container and over the image */
          .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 15rem;
            height: 10.5rem;
            /* height: 100%;
            width: 100%; */
            opacity: 0;
            transition: .3s ease;
            background-color: black;
            
          }

          /* When you mouse over the container, fade in the overlay icon*/
          .container:hover .overlay {
            opacity: 1;
          }

          /* The icon inside the overlay is positioned in the middle vertically and horizontally */
          .icon {
            color: white;
            font-size: 5rem;
            position: absolute;
            top: 50%;
            left: 52%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
            background:none;
          }
          input
          {
            width:26rem !important;
          }

          /* When you move the mouse over the icon, change color */
          .fa-user:hover {
            color: #eee;
          }


          .response
          {
           /* padding:4.6rem; */
           padding-top:4.6rem;
          }

          /* .filter {
          width:100%;
          padding:25px;
          border:1px solid black;
          /* margin:25px; */
          /* float:left;
          margin-bottom: 1rem;
        } */

        /* .col {
          width:100%;
          display:block;
          /* margin-right:10px; */
        /* } */ 

        /* label {
          vertical-align:top;
          float:left;
          width:11.5rem;;
        } */

          @media (max-width: 991.98px){
          .card-text{
            /* padding:0rem !important; */
            margin-bottom: 0rem !important;
          }

          input
          {
            margin-left: 0rem !important;
            width:100% !important;
          }

          .row {
            margin-bottom:1rem;
          }

          textarea{
            width:100% !important;
          }
          .card-body
          {
          width: 28rem !important;
          }
          .registration-content
          {
            padding-top: 0rem !important;
          }

          #timeid{
            width: 55rem !important;
          }
         

          }
        </style>

        <script>
          function edit()
          {
            debugger;
            document.getElementById("name").disabled = false;
            document.getElementById("location").disabled = false;
            document.getElementById("contact").disabled = false;
            document.getElementById("description").disabled = false;
            document.getElementById("price").disabled = false;
            document.getElementById("longitude").disabled = false;
            document.getElementById("latitude").disabled = false;
            document.getElementById("btnedit").hidden = true;
            document.getElementById("btnsubmit").hidden = false;
            document.getElementById("btncancel").hidden = false;
            $(".the_checkbox:checkbox").attr("disabled", false); //enabling checkboxes
            
            
          }

          function cancel()
          {
            document.getElementById("name").disabled = false;
            document.getElementById("location").disabled = true;
            document.getElementById("contact").disabled = true;
            document.getElementById("description").disabled = true;
            document.getElementById("price").disabled = true;
            document.getElementById("longitude").disabled = true;
            document.getElementById("latitude").disabled = true;
            document.getElementById("btnedit").hidden = false;
            document.getElementById("btnsubmit").hidden = true;
            document.getElementById("btncancel").hidden = true;
            $(".the_checkbox:checkbox").attr("disabled", true);//disabling checkboxes 

          }

          function closeMessage()
          {
            document.getElementById("message").style.display="none";

          }

          function removeimage()
          {
            debugger;
            $.ajax({
        url: "controls/fetchTime.php",
        type: "post",
        data: {Time:date, ID:id} ,
        success: function (response) {
          debugger;
          if(response="success")
          {
            document.getElementById("errortxt").style.display = "none";             
            window.location.reload();

          }
          elseif(response="full")
          {
            document.getElementById("errortxt1").style.display = "contents"; 
          }
          elseif(response="error")
           {
            alert("something went wrong !")
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
          }
        </script>
</head>
<body>
<?php include 'navbar.php' ?> 
<?php if(isset($_GET['success']) && $_GET['success']){?>
	<div class="response" id="message">
<div class="alert alert-success" ><strong> Updated Successfull!</strong><img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()"> </div>
</div>
<?php echo'<script type="text/javascript">',
		'setTimeout(function () {',
   'document.getElementById("response").hidden = true;', 
	'},5000);',
	'</script>'; ?>
<?php }
elseif(isset($_GET['error']) && $_GET['error']){
  ?>
  <div class="response" id="message">
  <div class="alert alert-danger" ><strong><?=$_GET['error']?></strong><img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()"> </div>
  </div>
<?php }?>
<div class="registration-content" style="padding:6rem; padding-top:5rem">
<?php
$userID=$_SESSION['id'];
$sql="Select * from futsals where createdby=".$userID."";
$myRegistration=$conn->query("Select * from futsals where createdby=".$userID."");
if($myRegistration)
{
  $myRegistration=mysqli_fetch_all($myRegistration);
}
foreach($myRegistration as $register)
{
?>
	
<div class="card" style="margin-bottom:2rem; margin-left: 3rem;">
  <div class="card-header" style="font-size: 2rem;">
    <?=$register[1]?>
  </div>
  <form class="border shadow p-3 rounded"
      	      action="" 
      	      method="post" >
  <div class="row" style="width: 100%;">
  <div class="card-body" style="border-right: 1px solid;">
  <div class="row" style="width: 100%; margin-left: 0.5rem;">
       <p class="card-text" style="padding: 0.5rem;">Name:</p><input type="text" 
		           class="form-control" 
		           name="name" 
		           id="name"
               value="<?=$register[1]?>"
               disabled style="width: 30rem;margin-left: 3.5rem;">
    </div>
    <div class="row" style="width: 100%; margin-left: 0.5rem;">
       <p class="card-text" style="padding: 0.5rem;">Location:</p><input type="text" 
		           class="form-control" 
		           name="location" 
		           id="location"
               value="<?=$register[2]?>"
               disabled style="width: 30rem;margin-left: 2.3rem;">
    </div>
    <div class="row" style="width: 100%; margin-left: 0.5rem;">
       <p class="card-text" style="padding: 0.5rem;">Contact No:</p><input type="text" 
		           class="form-control" 
		           name="contact" 
		           id="contact"
               value="<?=$register[3]?>"
               disabled style="width: 30rem;margin-left: 1rem;">
    </div>
    <div class="row" style="width: 100%; margin-left: 0.5rem;">
       <p class="card-text" style="padding: 0.5rem;">Description:</p> 
       <textarea rows = "3"  name = "description" id="description"  style=" width: 72%; margin-bottom: 1.5rem; margin-left: 1rem;" disabled><?=$register[4]?>"</textarea>	
    </div>
    <div class="row" style="width: 100%; margin-left: 0.5rem;">
       <p class="card-text" style="padding: 0.5rem;">Price:</p><input type="text" 
		           class="form-control" 
		           name="price" 
		           id="price"
               value="<?=$register[5]?>"
               disabled style="width: 30rem;margin-left: 4rem;">
    </div>
    <div class="row" style="width: 100%; margin-left: 0.5rem;">
       <p class="card-text" style="padding: 0.5rem;">Longitude:</p><input type="text" 
		           class="form-control" 
		           name="longitude" 
		           id="longitude"
               value="<?=$register[6]?>"
               disabled style="width: 30rem;margin-left: 1.5rem;">
    </div>
    <div class="row" style="width: 100%; margin-left: 0.5rem;">
       <p class="card-text" style="padding: 0.5rem;">Latitude:</p><input type="text" 
		           class="form-control" 
		           name="latitude" 
		           id="latitude"
               value="<?=$register[7]?>"
               disabled style="width: 30rem;margin-left: 2.3rem;">
    </div>

    <div class="mb-1" style="width: 15rem;">
    <div class="row" style="width: 40rem;" id="timeid">
    <p class="card-text" style="padding: 0.5rem; ">Time:</p>
        <div class="filter"> 
      <div class="tags"> 
   <div class="col"> 
    <?php
    $status="";
    $sql="SELECT * from futsaltime where futsalid='$register[0]'";
      $alltime = $conn->query("select * from time");
      if($alltime)
      {
      $alltime = mysqli_fetch_all($alltime);
      }

      $regtime=$conn->query("Select Timeid from futsaltime where futsalid='$register[0]'");
      if($regtime)
      {
        $times=mysqli_fetch_all($regtime);
      }
      foreach($alltime  as $time)
      {
        foreach($times as $key=>$value)
        {
          if($times[$key][0]==$time[0])
          {
            $status="checked";
          }
        }
      ?>    
   
    <label style="margin-right: 1rem;"> <input type="checkbox" rel="time" name="time[]" class="the_checkbox" value="<?=$time[0]?>"  disabled  <?=$status?> style="width: 2rem !important;"><?=$time[1]?> </label>     
    <?php
     $status="";
    }?>
    </div>
    </div>
      </div>
    </div>
    </div>
       
      
    <a href="#" class="btn btn-primary" id="btnedit" onclick="edit()" style="width: 5rem; margin-left: 0.2rem;">Edit</a>    
    <button type="submit" name="submit" id="btnsubmit"  class="btn btn-success" style="width: 5rem;" hidden value="<?=$register[0]?>">Save</button>
    <a href="#" class="btn btn-danger" id="btncancel" onclick="cancel()" style="width: 5rem;" hidden>Cancel</a>
  </form>
  </div>
  <div class="card-body" style="width:31rem;">
  <form  action=""  method="post"  enctype="multipart/form-data" style="height:100%;">
  <h5 class="card-title">Images</h5>
  <div class="imagecontainer" style="overflow: scroll;width: 105%;height: 27rem;margin-bottom:1rem;">
  <div class="row" style="width: 100%; justify-content: space-evenly;">
  <?php
  $images=$conn->query("Select ImageID, ImageUrl from futsalimages where FutsalID=".$register[0]."");
  if($images)
  {
    $images=mysqli_fetch_all($images);
  }
  foreach($images as $image)
  {
  ?>
  <div class="container" style="padding-right: 1rem;  position: relative;
    width: 100%;
    max-width: 15.8rem;height: 12rem;">
  <img src="<?=$image[1]?>" alt="Avatar" class="image">
  <div class="overlay" >
    <!-- <a  class="icon" title="Remove image" onclick="removeimage()"> -->
    <button name="delete"  class="icon" type="submit" value="<?=$image[0]?>" style="height: 3rem; border: none;">
    <img src="assets/icons/remove.svg" alt="" style="height: 2rem; vertical-align: top;" >
  </button>
     
    <!-- </a> -->
  </div>
</div>  
  <?php }?>
  </div>
  </div>
       
<label for="latitude"  class="form-label" style=" float: none;width: 25rem;">Upload More Images<em>(Multiple file can be choosen)</em>:</label><br/>
<input type="file" name="files[]" id="fileToUpload" multiple><br/>
<button name="upload"  class="btn btn-primary" type="submit" value="<?=$register[0]?>" style="width: 8rem !important; margin-top:0.5rem;">Upload Image</button>

  </div>
</div>
</div>
<?php }?>
  </form>
</div>
</body>
</html>