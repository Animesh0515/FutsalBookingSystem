<?php
include "controls/connection.php";
if(isset($_GET['q']) && $_GET['q']=="fu")
{
  header("Location:http://localhost:59392/index.php"); 
  exit();
}
session_start();
if(isset($_GET['q']) && $_GET['q']=="su")
{
  if(isset( $_SESSION['bookedDetails']) && ! empty( $_SESSION['bookedDetails']))
  {
    $futsalid= $_SESSION['bookedDetails'][0]["futsalID"];
    $bookeddate= strtotime($_SESSION['bookedDetails'][0]["day"]);
    $bookeddate = date('m/d/Y',$bookeddate);
    $bookedtime= $_SESSION['bookedDetails'][0]["time"];
    $userid=$_SESSION['id'];
    $todaysdate=date("m/d/Y");
    $sql = "Insert into futsalbooking(UserID, FutsalTimeID, BookedDate, BookedFor) values('$userid', '$bookedtime','$todaysdate','$bookeddate')";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
      $message="success";
     
    }
    else
    {
      $message="error";
    }
  }
  elseif(isset($_GET['q']) && $_GET['q']=="fu")
  {
    $message="Payment failure";
  }

}

?>
<html lang="en">
<head>
    <title>Details Page</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap css -->
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

    <!-- Addtional stylesheet -->
      <link rel="stylesheet" href="assets/css/style.css">

      <style>
          .carousel-control-next-icon {
    background-image: url(assets/icons/next.svg) !important;
        }

        .carousel-control-prev-icon {
    background-image: url(assets/icons/previous.svg) !important;
        }

        .carousel-indicators .active {
    background-color: black !important;
    }
  /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}   

.carousel-indicators {
  bottom: 24px !important;
}

    @media (max-width: 991.98px){
      .row{
        width:54rem !important;
          }
}
      </style>
  <script>
function openForm() {
  debugger;
  var modal=document.getElementById("myModal");
  modal.style.display = "block";
}


function closeForm(){
  debugger;
  var modal=document.getElementById("myModal");
  modal.style.display = "none";
  
}

function openloginModal(){
  document.getElementById("loginModal").style.display = "block";
}

function closeloginform(){
  document.getElementById("loginModal").style.display = "none";
}

function redirect() {
    window.location.href="login.php";
  }
  function fetchTime(date, id){
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

  function Timeclick(){
    debugger;
    var selectedTime = document.getElementById('time').options;
    if(selectedTime.length==1)
    {
      document.getElementById("errortxt").style.display = "contents"; 
    }
    
  }

  function closeMessage()
  {
    document.getElementById("message").style.display="none";

  }
</script>
</head>
<body>
<?php include 'navbar.php'?> 
<div style="padding-top: 4.6em">
<?php
if(isset($message))
{
  if($message=="success")
  {?>
<div class="alert alert-success" role="alert" id="message">
				  success <img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()">
			  </div>
        <?php }
  elseif($message="error")
  {?>
<div class="alert alert-danger" role="alert" id="message">
				  Something went wrong! Contact Admin <img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()">
			  </div>
<?php
 }
 else
 {?>
  <div class="alert alert-danger" role="alert" id="message">
				  $message <img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()">
			  </div>
<?php
 }
}

?>
</div>
<div class="main-content" style="padding-top: 6rem" >

<div class="container">
  <div class="row" style="width: 105rem;">
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="width: 54rem; margin-right: 0.5rem;">
  <div class="carousel-indicators" style="width: 39rem;">
  <?php
  if(isset($_GET["id"]))
  {
  $id=$_GET["id"];
  }
  else
  {
    $id=$futsalid;
  }
  $count=0;
   $images = $conn->query("SELECT ImageURL FROM futsalimages where FutsalID={$id}");
   if ($images) {
    $images = mysqli_fetch_all($images);
    foreach($images as $image){
      if($count==0){?>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to=<?=$count?> class="active" aria-current="true" ></button>
     <?php }else{?>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to=<?=$count?> ></button>
      <?php }
    $count=$count + 1;
    }?>
    
  </div>
  <div class="carousel-inner" style="height: 30.4rem;width: 54rem;">
  <?php 
  $count=0;
  foreach($images as $image){
    if($count==0){?>
    <div class="carousel-item active">
      <img src="<?=$image[0]?>" class="d-block w-100" alt="..." style="height: 100%;">
    </div>
    <?php }else{?>
    <div class="carousel-item ">
      <img src="<?=$image[0]?>" class="d-block w-100" alt="..." style="height: 100%;">
    </div>
    <?php }
    $count=$count + 1;
    ?>
  <?php }}?>
  </div>


  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" style="background-color: transparent;border: none;">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="background-color: transparent;border: none;">
    <span class="carousel-control-next-icon" aria-hidden="true" style="width: 36px;height: 30px"></span>

  </button>
</div>
<?php  

     $futsals = $conn->query("SELECT * FROM futsals where FutsalID={$id}");
     if ($futsals) {
      $futsals = mysqli_fetch_all($futsals);
     }
   ?>
<form action="" method="post" >
<div class="card" style="width: 50rem;height: 30.5rem;">
  <div class="card-header" style="font-size: 2rem;">
    <?=$futsals[0][1]?>
  </div>
  <div class="card-body">
    <h5 class="card-title" ><?=$futsals[0][4]?></h5>
    <p class="card-text"><img src="assets/icons/location2.svg" alt="" style="height: 2rem;"><?=$futsals[0][2]?><br/><img src="assets/icons/contact.svg" alt="" style="height: 2rem;">&nbsp;<?=$futsals[0][3]?><span style="margin-left: 32rem;font-size: 1.5rem;color: red;">Price:<?=$futsals[0][5]?></span></p>
    <p class="card-text">Select Date:
      <?php
      if(!empty($_SESSION['selectedDate']))
      {
        $date=strtotime($_SESSION['selectedDate']);
        $date = date('Y-m-d',$date);
      }
      else
      {
        $date="";
      }
      ?>
    <input type="date" id="date" name="Day" min="<?=date("Y-m-d")?>" onchange="fetchTime(this.value,<?=$id?>)" value="<?=$date?>">   
   </p>
    <p class="card-text">Select Time:
   <select name="Time" id="time" onclick="Timeclick()">
   <option value="" >Choose option</option>
   <?php 
   if(!empty($_SESSION['availableTime']))
   {
    $times=$_SESSION['availableTime'];
   foreach($times as $time){
   ?>
    <option value="<?=$time[0]?>"><?=$time[1]?></option>    
    <?php } }?>
  </select>
  <span style="color:red; display:none; font-size: 0.9rem;" id="errortxt" >Select date First </span>
   </p>
   <?php
   if (! isset($_SESSION["availableTime"]) || count($_SESSION["availableTime"])==0) 
   {
     $disabletxt="disabled";
     
   }
   else
   {
    $disabletxt="";
   }
   ?>
   <input type="submit"  name="submit" id="btnBook" class="btn btn-primary" value="Book Now" <?=$disabletxt?>>
   <span style="color:red; display:none; font-size: 0.9rem;" id="errortxt1" >Booking Full </span>
    </form>
    <?php
       if(isset($_POST['submit'])){
        
        if(!empty($_POST['Day']) && !empty($_POST['Time'])) {
         if(!empty($_SESSION['id']))
         {
           
           $advance=(string)(($futsals[0][5])*10/100);
           $esewaid=uniqid();//created a uniqu id for every transaction
           $bookingArray=array(
             array("futsalID"=>$id,"day"=>$_POST['Day'],"time"=>$_POST['Time']),
               );
          $_SESSION['bookedDetails']=$bookingArray;
          //getting the current host and port
          $url= $_SERVER['HTTP_HOST']; 


          $a='<div id="myModal" class="modal">
          <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close"  aria-label="Close" onclick="closeForm()"></button>
      </div>
      <div class="modal-body">
        <h1>Continue to Checkout</h1>
        <span>10% should be paid for booking</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeForm()">Close</button>
        <form action="https://uat.esewa.com.np/epay/main" method="POST" style="height: 1.5rem;">
          <input value="'.$advance.'" name="tAmt" type="hidden">
          <input value="'.$advance.'" name="amt" type="hidden">
          <input value="0" name="txAmt" type="hidden">
          <input value="0" name="psc" type="hidden">
          <input value="0" name="pdc" type="hidden">
          <input value="EPAYTEST" name="scd" type="hidden">
          <input value="'.$esewaid.'" name="pid" type="hidden">
          <input value="http://'.$url.'/BookingDetails.php?q=su" type="hidden" name="su">
          <input value="http://'.$url.'/BookingDetails.php?q=fu" type="hidden" name="fu">
          <input value="Yes" class="btn btn-primary" type="submit">
          </form> 
          
      
        
      </div>
    </div>
  </div>
          </div>';          
        echo $a;
        echo '<script type="text/javascript">',
        'openForm();',
        '</script>'
   ;
        }
        else{
          echo'<div id="loginModal" class="modal">
          <div class="modal-dialog">
    <div class="modal-content">
     
      <div class="modal-body">
        <h1>Please Login First</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeloginform()">Close</button>
        <button type="button" class="btn btn-primary" onclick="redirect()">Continue to login</button>
      </div>
    </div>
  </div>
          </div>';          
        
        echo '<script type="text/javascript">',
        'openloginModal();',
        '</script>';

        }
        } else {
          echo "<script type='text/javascript'>alert('Please select the Day and Time.');</script>";
          
         
        }
      }
    
    ?> 


   
    
  </div>
</div>
</div>
</div>
</div>


<
</div>
 <?php include 'footer.html' ?> 
 <?php
 unset($_SESSION['selectedDate']);  
 unset($_SESSION['availableTime']);
 ?>
</body>

</html>