<?php
include "controls/connection.php";


?>
<html lang="en">
<head>
    <title>Details Page</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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

// // Get the modal
// var modal = document.getElementById("myModal");

// // Get the button that opens the modal
// var btn = document.getElementById("myBtn");

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks the button, open the modal 
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   modal.style.display = "none";
// }

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
</script>
</head>
<body>
<?php include 'navbar.php' ?> 


<div class="main-content" style="padding-top: 6rem">


<div class="container">
  <div class="row" style="width: 105rem;">
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="width: 54rem; margin-right: 0.5rem;">
  <div class="carousel-indicators" style="width: 39rem;">
  <?php
  $id=$_GET["id"];
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
  <div class="carousel-inner" style="height: 27rem;width: 54rem;">
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
<div class="card" style="width: 50rem;">
  <div class="card-header" style="font-size: 2rem;">
    <?=$futsals[0][1]?>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?=$futsals[0][4]?></h5>
    <p class="card-text"><img src="assets/icons/location2.svg" alt="" style="height: 2rem;"><?=$futsals[0][2]?><br/><img src="assets/icons/contact.svg" alt="" style="height: 2rem;">&nbsp;<?=$futsals[0][3]?><span style="margin-left: 32rem;font-size: 1.5rem;color: red;">Price:<?=$futsals[0][5]?></span></p>
   <p class="card-text">Select Time:
   <select name="cars" id="cars">
   <option value="" >Choose option</option>
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="opel">Opel</option>
    <option value="audi">Audi</option>
  </select>
   </p>
   <input type="submit"  name="submit" class="btn btn-primary" value="Book Now">
    </form>
    <?php
       if(isset($_POST['submit'])){
        if(!empty($_POST['cars'])) {
         if(!empty($_SESSION['id']))
         {
          echo'<div id="myModal" class="modal">
          <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close"  aria-label="Close" onclick="closeForm()"></button>
      </div>
      <div class="modal-body">
        <h1>Continue to Checkout
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeForm()">Close</button>
        <form action="https://uat.esewa.com.np/epay/main" method="POST" style="height: 1.5rem;">
          <input value="100" name="tAmt" type="hidden">
          <input value="90" name="amt" type="hidden">
          <input value="5" name="txAmt" type="hidden">
          <input value="2" name="psc" type="hidden">
          <input value="3" name="pdc" type="hidden">
          <input value="EPAYTEST" name="scd" type="hidden">
          <input value="ee2c3ca1-696b-4cc5-a6be-2c40d929d453" name="pid" type="hidden">
          <input value="http://merchant.com.np/page/esewa_payment_success?q=su" type="hidden" name="su">
          <input value="http://merchant.com.np/page/esewa_payment_failed?q=fu" type="hidden" name="fu">
          <input value="Yes" class="btn btn-primary" type="submit">
          </form> 
          
      
        
      </div>
    </div>
  </div>
          </div>
             
            
';          
        
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
          </div>
             
            
';          
        
        echo '<script type="text/javascript">',
        'openloginModal();',
        '</script>'
   ;

        }
        } else {
          echo "<script type='text/javascript'>alert('Please select the Time.');</script>";
          
         
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
</body>

</html>