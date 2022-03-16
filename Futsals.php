<?php
include "controls/connection.php";
?>

<html lang="en">
<head>
<title>Fustal Booking</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <!-- Bootstrap css -->
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

    <!-- Addtional stylesheet -->
      <link rel="stylesheet" href="assets/css/style.css">
    <style>
      .row {
      
      margin-right: -0.9375rem !important;
      margin-left: -0.9375rem !important;
      }

      @media (max-width: 991.98px){
      .row {
          padding-left: 0rem !important;
          width: 100% !important;
      }
    }
    </style>


</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php' ?> 
    <div class="main-content">
    <div class="futsal-content" style="padding-top:3rem; padding-left: 33rem">    
    <form class="d-flex" style="width:40rem;">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="margin-right: 0.5rem">
                <button class="btn" type="button">Search</button>
              </form>
    </div>
    <div class="row" style=" justify-content: space-around;">
    <?php 
       $futsals = $conn->query("SELECT * FROM futsals");
       if ($futsals) {
           $futsals = mysqli_fetch_all($futsals);
    foreach($futsals as $futsal){?>
    <div class="card border-dark mb-3" style="max-width: 37rem;">
  <div class="row g-0">
    <div class="col-md-4">
      <?php
       $image = $conn->query("SELECT ImageUrl FROM futsalimages where FutsalID=$futsal[0] limit 1");
       $image = mysqli_fetch_all($image);
      ?>
      <img src=<?=(string)$image[0][0]?> class="img-fluid rounded-start" alt="..." style="padding: 1rem; height: 100%;">
    </div>
    <div class="col-md-8" style="max-width: 23rem;">
      <div class="card-body">
        <h5 class="card-title"><?=$futsal[1]?></h5>
        <p class="card-text">Location: <?=$futsal[2]?><br/>Contact No: <?=$futsal[3]?><br/>Price:<?=$futsal[5]?> per hour</p>             
        <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="assets/icons/location.svg" alt="" style="height: 2rem;"></button>
        <button type="button" class="btn btn-info" onClick="RedirectTo(<?=$futsal[0]?>)">Details</button>
        <button type="button" class="btn btn-dark" onClick="RedirectTo(<?=$futsal[0]?>)">Book</button>

        <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="map"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

      </div>
    </div>
  </div>
</div>
<?php } }?>

</div>
    <!-- <div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card" style="width: 25rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card" style="width: 25rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card" style="width: 25rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card" style="width: 25rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div> -->

</div>
<?php include 'footer.html' ?> 
</body>

<script>
 function RedirectTo(id) {
   debugger;
    window.location.href="BookingDetails.php?id="+id;
  }

  </script>
</html>