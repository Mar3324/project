<?php include('includes/header.php') ?>
<link rel="stylesheet" href="includes/css/style.css">

  <?php alertMessage()?>
      <div class="carousel slide" id="myCarousel" data-bs-ride="carousel" style="height:90vh">
        <ol class="carousel-indicators">
          <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
          <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
          <li data-bs-target="#myCarousel" data-bs-slide-to="3"></li>
          <!-- <li data-bs-target="#myCarousel" data-bs-slide-to="4"></li>
          <li data-bs-target="#myCarousel" data-bs-slide-to="5"></li> -->
        </ol>
        <div class="carousel-inner">

        <!-- carousel 1 pic -->
          <div class="carousel-item active" data-bs-interval="7000">
          <div class="overlay-image" style="background-image:url('images/carsel7.jpg')"></div>  
            <div class="container">
              <h1 style="color:rgb(89, 8, 175);">Agriyield Vegetable farm inventory</h1>
              <h3 class="cont-text1">📚 Efficient Record-Keeping Inventory System Available Now!Are you tired of losing track of your records? Our state-of-the-art record-keeping inventory system is the solution you've been waiting for!</h3>
            </div>
          </div>

          <!-- carousel 2 pic -->
          <div class="carousel-item" data-bs-interval="10000">
          <div class="overlay-image" style="background-image:url('images/carsel2.jpg')"></div>   
            <div class="container">
            Our System Offers:
            <ul>
             <li>Digital Storage: Say goodbye to physical clutter. Our system stores all records digitally for easy access and retrieval.</li>
             <li> User-Friendly Interface: No need to be tech-savvy. Our system is designed with simplicity and ease of use in mind.</li>
             <li> Data Security: Your records are safe with us. We use advanced security measures to protect your data.
              Customizable Categories: Organize your records your way. Our system allows you to create custom categories to suit your needs.</li>
              </ul>
            </div>
          </div>

          <!-- carousel 3 pic -->
          <div class="carousel-item" data-bs-interval="4000">
          <div class="overlay-image" style="background-image:url('images/carsel6.jpg')"></div>   
            <div class="container">
            <h2>Trusted by hundreds of farmers worldwide for record keeping.We are reliable</h2>
            
              </ul>
            </div>
          </div>

          <!-- carousel 4 pic -->
          <div class="carousel-item" data-bs-interval="4000">
          <div class="overlay-image" style="background-image:url('images/carsel5.jpg')"></div>   
            <div class="container">
              <ul>
              <p class="cont-text">Keep track of:</p>
              <li class="cont-text">Produce</li>
              <li class="cont-text">Orders</li>
              <li class="cont-text">Customers</li>
              <li class="cont-text">Staff</li>
              </ul>
              </ul>
            </div>
          </div>



        </div>
          <a href="#myCarousel" class="carousel-control-prev" role="button" data-bs-slide="prev">
            <span class="sr-only"></span>
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </a>
          <a href="#myCarousel" class="carousel-control-next" role="button" data-bs-slide="next">
            <span class="sr-only"></span>
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>
      </div>
    <?php include('includes/footer.php') ?> 
  </body>
</html>