<!DOCTYPE html>
<html>
<head>
	<title>Hotel Booking Website</title>
	<!-- CSS only -->
<?php require('inc/links.php'); ?>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
<link rel="stylesheet" type="text/css" href="css/common.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<style>
  .pop:hover{
    border-top-color: var(--teal) !important;
    transform: scale(1.03);
    transition: all 0.3s;
  }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">HOŤEL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>
    </div>
  </nav>

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>

  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
  Welcome to our luxurious hotel, where we pride ourselves on providing an exceptional experience for our guests. Our hotel is equipped with a wide range of world-class facilities, ensuring your stay with us is nothing short of extraordinary.

Indulge in ultimate relaxation at our exquisite spa, where our skilled therapists will pamper you with a variety of rejuvenating treatments, including massages, facials, and body therapies. Immerse yourself in a haven of tranquility and emerge feeling revitalized and renewed.
  </p>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
        <div class="d-flex align-items-center mb-2">
          <img src="images/facilities/Wifi.svg" width="40px">
          <h5 class="m-0 ms-3">WIFI</h5>
        </div>  
          <p>
           Wifi available
          </p> 
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
        <div class="d-flex align-items-center mb-2">
          <img src="images/facilities/food.png" width="80px">
          <h5 class="m-0 ms-3">FOOD</h5>
        </div>  
          <p>
          Best restaurants available
          </p> 
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
        <div class="d-flex align-items-center mb-2">
          <img src="images/facilities/gym.png" width="40px">
          <h5 class="m-0 ms-3">GYM</h5>
        </div>  
          <p>
           Best Gym available
          </p> 
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
        <div class="d-flex align-items-center mb-2">
          <img src="images/facilities/rooms.png" width="40px">
          <h5 class="m-0 ms-3">ROOMS</h5>
        </div>  
          <p>
           peaceful rooms available
          </p> 
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
        <div class="d-flex align-items-center mb-2">
          <img src="images/facilities/laundry.jpg" width="40px">
          <h5 class="m-0 ms-3">LAUNDRY</h5>
        </div>  
          <p>
           Laundry service avilable
          </p> 
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
        <div class="d-flex align-items-center mb-2">
          <img src="images/facilities/cab.png" width="40px">
          <h5 class="m-0 ms-3">CAB</h5>
        </div>  
          <p>
           Cab service available for airport
          </p> 
      </div>
    </div>
  </div>
</div>

<?php require('inc/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>