<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Bootstrap css -->
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

    <!-- Addtional stylesheet -->
      <link rel="stylesheet" href="assets/css/style.css">
    <style>
      .top-left {
        position: absolute;
        float:left;
        top: 17rem;
        left: 5rem;
        color: lightgoldenrodyellow;
        font-size: 4rem;
      }
      .button_top-left{
        position: absolute;
        top: 29rem;
        left: 5rem;
        color: lightgoldenrodyellow;
        border: solid 0.2rem #fafad2;
        width: 11rem;
        height: 4rem;
        background: none;
        text-align: center;
         overflow: hidden;
        cursor: pointer;
        
      }

      .button_top-left a{
        color:white;
        display: block;
        position: relative;
        font-size: 1.2rem;
        font-weight: 600;
        line-height: 3.5rem;
        text-decoration: none;
        
      }

     
      .button_top-left:hover {
        
        background-color:white;
       
      }
      .button_top-left:hover a{
          color:black;
      }

      
      .icon_boxes {
          width: 100%;
          padding-top: 5rem;
          padding-bottom: 5rem;
      }
      .row {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      margin-right: -0.9375rem;
      margin-left: -0.9375rem;
      }

      .icon_box {
      width: 100%;
      text-align: center;
      } 

      .icon_box_title {
        font-size: 1.2rem;
        font-weight: 500;
        color: #1b1b1b;
        margin-top: 1.5rem;
        }

        .division_border
        {
          width: 100%;
          border-top: solid 0.2rem #e3e3e3;
          
        }
        .icon_box_image {
          width: 6rem;
          height: 6rem;
          margin-left: auto;
          margin-right: auto;
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
      
      <!-- Image -->
     <div class="main-content">
      <img src="assets/images/fustal.jpg" class="img-fluid" alt="..." style="width: 100%;height: 45rem;"/>

      <!-- Text In Image -->
      <div class="top-left" style="font-weight: 600; line-height: 1.2;">A New Futsal Booking<br/> Experience</div>
      <div class="button_top-left"><a href="#">Book Now</a></div>
    
     <div class="icon_boxes">
		<div class="container">
			<div class="row icon_box_row">
				
				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="assets/icons/bookings.svg" alt=""></div>
						<div class="icon_box_title">Easy Booking</div>
						<div class="icon_box_text">
							<p>Book the futsal venue to play with your friends in few clicks.</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="assets/icons/register.svg" alt=""></div>
						<div class="icon_box_title">Fustal Registration</div>
						<div class="icon_box_text">
							<p>Register futsal venue (For futsal owners).</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="assets/icons/search.svg" alt=""></div>
						<div class="icon_box_title">Search</div>
						<div class="icon_box_text">
							<p>Search and spot futsal venues.</p>
						</div>
					</div>
				</div>

			</div>
		</div>
  <div class="division_border"></div>
	</div>
  <div class="search-index">
      <div class="container">
        <div class="more-info-content">
          
              <div class="right-content">
                
                <h2 style="font-weight: 800;">Book your <em style="color:white;">Favourite Futsal</em></h2>
                <span style="color:white;">Search for your favourite fustal and book it now !</span>
                <form class="d-flex" style="margin-bottom: 0.7rem;">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="margin-right: 0.5rem">
                <button class="btn" type="button">Search</button>
              </form>
                <a href="about.html" class="filled-button" style="margin-top:0.2rem; color:white;">Show All</a>
              </div>
            </div>
         
      </div>
    </div>
</div>
<?php include 'footer.html' ?> 

  
  </body>
</html>