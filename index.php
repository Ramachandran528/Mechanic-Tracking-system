<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home page</title>
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/link-hover-effect.css" />
</head>

<body>

  <!-- Header -->
  <header>
    <div class="menus">
      <a href="#" class="logo menu">Logo</a>
      <ul>
        <li><a href="#" class="menu active">Home</a></li>
        <li><a href="#how-it-works" class="menu">How it works</a></li>
        <li><a href="#contact-us-container" class="menu">contact us</a></li>
        <li><a href="login.php" class="menu login link">Login</a></li>
      </ul>
    </div>
  </header>
  <script src="js/header.js"></script>

  <!-- Hero container -->
  <main>
    <div class="hero-container">
      <div class="hero-content">
        <h1 class="hero-heading"><span>Mechanic</span> Tracker</h1>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit.
          Cupiditate, molestiae sed perferendis asperiores eveniet nemo! Dicta
          veritatis minima expedita et!
        </p>
        <a href="signup_customer.php" class="hero-link link" id="sign-up-as-customer">Sign up as Customer</a>
        <a href="signup_mechanic.php" class="hero-link link" id="sign-up-as-mechanic">Sign up as Mechanic</a>
      </div>
      <img src="images/mechanic-hero.jpg" alt="mechanic-hero-image" class="hero-image" />
    </div>

    <!-- How it works -->
    <div id="how-it-works">
      <h1 class="how-it-works-heading">How it works</h1>
      <div class="how-it-works-container">
        <img src="images/home_choosing.svg" alt="choosing-mechanic-illustration" class="how-it-works-img" />
        <div class="how-it-works-content">
          <h1 class="how-it-works-container-heading">choose your mechanic</h1>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Molestias quisquam corporis nihil vero libero. Recusandae quaerat
            libero vitae excepturi impedit veniam ex. Quas, veritatis
            doloribus?
          </p>
        </div>
      </div>
      <div class="how-it-works-container">
        <img src="images/home_booking.svg" alt="choosing-mechanic-illustration" class="how-it-works-img" />
        <div class="how-it-works-content">
          <h1 class="how-it-works-container-heading">Book your mechanic</h1>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Molestias quisquam corporis nihil vero libero. Recusandae quaerat
            libero vitae excepturi impedit veniam ex. Quas, veritatis
            doloribus?
          </p>
        </div>
      </div>
      <div class="how-it-works-container">
        <img src="images/home_tracking.svg" alt="choosing-mechanic-illustration" class="how-it-works-img" />
        <div class="how-it-works-content">
          <h1 class="how-it-works-container-heading">
            Mechanic will reach you
          </h1>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Molestias quisquam corporis nihil vero libero. Recusandae quaerat
            libero vitae excepturi impedit veniam ex. Quas, veritatis
            doloribus?
          </p>
        </div>
      </div>
      <!-- Shape divider -->
      <div class="custom-shape-divider-top-1611506635">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
          <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
      </div>
      <div class="custom-shape-divider-bottom-1611509465">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
          <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
      </div>
    </div>

    <!-- Contact -us container -->
    <div id="contact-us-container">
      <h1 class="contact-us-heading">Contact us</h1>
      <p>Connect with us through our social media handle</p>
      <div class="contact-us-image-container">
        <a href="#"><img src="images/001-facebook.svg" alt="facebook-link" /></a>
        <a href="#"><img src="images/002-gmail.svg" alt="gmail-link"></a>
        <a href="#"><img src="images/005-instagram.svg" alt="instagram-link"></a>
      </div>
    </div>
  </main>
</body>

</html>