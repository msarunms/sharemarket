<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Required meta tags -->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>VISINAW STOCK TECH</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="./images/com_logo.jpeg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<style>
 /* General Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: "Times New Roman", serif; /* Ensures Times New Roman globally */
  overflow-x: hidden;
  background: url("../template/images/trading_3.jpg")
    no-repeat center center/cover;
  height: auto;
  width: 100%;
}

/* Navbar */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 18px;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
  background-color: rgba(
    255,
    255,
    255,
    0.8
  ); /* Semi-transparent white background */
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.navbar ul {
  display: flex;
  list-style: none;
}

.navbar ul li {
  margin: 0 20px;
}

.navbar ul li a {
  text-decoration: none;
  color: #000; /* Neutral black for text color */
  font-size: 1rem;
  font-weight: 600;
  transition: color 0.3s ease;
}

.navbar ul li a:hover {
  color: #555; /* Subtle hover effect */
}

.navbar .logo {
  width: 140px; /* Slightly increased logo size */
  height: 140px;
}

/* Responsive Design */
@media only screen and (max-width: 600px){
  /* Hero Section */
  .hero {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    text-align: center;
    height: 181vh;
    padding-top: 170px; /* Adjusted padding to move text further down */
  }
}
@media only screen and (min-width: 1200px) {

/* Hero Section */
.hero {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;
  text-align: center;
  height: 80vh;
  padding-top: 192px; /* Adjusted padding to move text further down */
}
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  /* Hero Section */
.hero {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;
  text-align: center;
  height: 80vh;
  padding-top: 192px; /* Adjusted padding to move text further down */
}
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
  /* Hero Section */
.hero {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;
  text-align: center;
  height: 80vh;
  padding-top: 192px; /* Adjusted padding to move text further down */
}
}



.hero h1 {
  font-size: 4.5rem; /* Matches the large font size in the image */
  margin-bottom: 20px;
  color: #fff; /* Black text */
  text-shadow: 0 3px 6px rgba(0, 0, 0, 0.4); /* Emphasized shadow */
  line-height: 1.2;
}

.hero p {
  font-size: 1.5rem;
  margin-bottom: 40px;
  color: #fff;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); /* Consistent text shadow */
}

.hero .btn {
  display: inline-block;
  padding: 15px 30px;
  font-size: 1rem;
  font-weight: 600;
  color: white;
  background-color: rgba(0, 51, 102, 0.8); /* Transparent blue button */
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.hero .btn:hover {
  background-color: #1e90ff; /* Bright blue hover effect */
  transform: scale(1.05);
}

/* Responsive Design */
@media (max-width: 768px) {
  .navbar ul li {
    margin: 0 10px;
  }

  .hero h1 {
    font-size: 3rem;
  }

  .hero p {
    font-size: 1.2rem;
  }
}
/* Mission & Vision Section */
.mission-vision {
  padding: 60px 20px;
  background-color: #ffffff;
  text-align: center;
}

.mission-vision .container {
  max-width: 1200px;
  margin: 0 auto;
}

.mission-vision .section-header h2 {
  font-size: 2.5rem;
  margin-bottom: 30px;
}

.mission-vision .content {
  display: flex;
  gap: 50px;
  justify-content: center;
  margin-top: 40px;
}

.mission-vision .mission,
.mission-vision .vision {
  width: 45%;
}

.mission-vision .mission img,
.mission-vision .vision img {
  width: 100%;
  height: auto;
  border-radius: 8px;
  margin-top: 20px;
}
/* General Styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  line-height: 1.6;
  background-color: #f9f9f9;
}

/* About Us Section */
.about-us {
  padding: 40px 20px;
  background-color: #ffffff;
  text-align: center;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 20px auto;
  max-width: 800px;
  border-radius: 8px;
}

.about-us h1 {
  font-size: 2.5rem;
  color: #007bff;
  margin-bottom: 20px;
}

.about-us p {
  font-size: 1rem;
  color: #555;
  margin-bottom: 20px;
  line-height: 1.8;
}
/* General Styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  line-height: 1.6;
  background-color: #f9f9f9;
}

/* Our Services Section */
.our-services {
  padding: 50px 20px;
  background-color: #ffffff;
  text-align: center;
  border-top: 5px solid #333; /* Add a dark border above the section */
}

.our-services h1 {
  font-size: 2.5rem;
  color: #007bff;
  margin-bottom: 20px;
}

.our-services p {
  font-size: 1.2rem;
  color: #555;
  margin-bottom: 40px;
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.service-item {
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

.service-item:hover {
  transform: translateY(-5px);
}

.service-item h2 {
  font-size: 1.5rem;
  color: #333;
  margin-bottom: 10px;
}

.service-item p {
  font-size: 1rem;
  color: #555;
  line-height: 1.6;
}

/* General Styles */
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #f7f7f7;
  color: #333;
  line-height: 1.6;
}

h2 {
  text-align: center;
  font-size: 2rem;
  margin: 20px 0;
}

p {
  text-align: center;
  font-size: 1rem;
  margin-bottom: 30px;
  color: #666;
}

/* Partners Section */
.partners-section {
  padding: 50px 20px;
  background-color: #ffffff;
}

.partners-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
  gap: 20px;
  justify-items: center;
  align-items: center;
  margin: 0 auto;
  max-width: 1200px;
}

.partner-logo img {
  width: 80px;
  height: 80px;
  object-fit: contain;
  transition: transform 0.3s ease;
}

.partner-logo img:hover {
  transform: scale(1.1);
}

/* Statistics Section Styling */
.statistics {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  align-items: center;
  background-color: #f1f1f1; /* Light grey background */
  padding: 40px 20px;
  text-align: center;
  border-top: 3px solid #007bff; /* Highlighted border above statistics */
}
.brand-logos {
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

.stat-item {
  flex: 1;
  min-width: 200px;
  margin: 10px;
}

.stat-item h2 {
  font-size: 2.5rem;
  font-weight: bold;
  color: #007bff; /* Highlight color */
  margin: 0;
}

.stat-item p {
  font-size: 1.2rem;
  color: #333; /* Text color */
  margin: 10px 0 0;
}

/* Footer Section Styling */
footer {
  background-color: #222; /* Dark grey background */
  color: #fff; /* White text */
  font-family: Arial, sans-serif;
  padding: 20px 0;
}

.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 0 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-column {
  flex: 1;
  min-width: 200px;
  margin: 10px;
}

.footer-column h3 {
  font-size: 1.2rem;
  margin-bottom: 10px;
  color: #f1f1f1;
}

.footer-column ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-column li {
  margin-bottom: 8px;
}

.footer-column a {
  color: #ddd;
  text-decoration: none;
  font-size: 0.9rem;
}

.footer-column a:hover {
  color: #007bff; /* Highlighted blue on hover */
}

/* Social Links */
.social-links i {
  margin-right: 8px;
  font-size: 1.2rem;
}

/* Footer Bottom */
.footer-bottom {
  text-align: center;
  margin-top: 20px;
  padding-top: 10px;
  border-top: 1px solid #555;
  font-size: 0.8rem;
  color: #aaa;
}

.footer-bottom p {
  margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
  .statistics {
    flex-direction: row;
    padding: 20px 10px;
  }

  .stat-item {
    margin: 20px 0;
  }

  .footer-container {
    flex-direction: row;
  }

  .footer-column {
    margin-bottom: 20px;
  }
}

</style>
<body>
  <!-- <header>
    <div class="logo">
      <img src="../template/images/trading_1.jpg" alt="StreetGains Logo">
    </div>
    <h1>Pay For <span class="highlight">Successful</span> Research Calls</h1>
    <p>Trade in Equity, Futures & Options from SEBI Reg Analyst</p>
  </header>
  <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Input size</h4>
                  <p class="card-description">
                    Add classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>.
                  </p>
                  <div class="form-group">
                    <label>Large input</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username">
                  </div>
                  <div class="form-group">
                    <label>Default input</label>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                  </div>
                  <div class="form-group">
                    <label>Small input</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Username" aria-label="Username">
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">

              <section class="forms-section">
                  <div class="forms">
                    <div class="form-wrapper is-active">
                      <button type="button" class="switcher switcher-login">
                        Login
                        <span class="underline"></span>
                      </button>
                      <form class="form form-login">
                        <fieldset>
                          <legend>Please, enter your email and password for login.</legend>
                          <div class="input-block">
                            <label for="login-email">E-mail</label>
                            <input id="login-email" type="email" required>
                          </div>
                          <div class="input-block">
                            <label for="login-password">Password</label>
                            <input id="login-password" type="password" required>
                          </div>
                        </fieldset>
                        <button type="submit" class="btn-login">Login</button>
                      </form>
                    </div>
                    <div class="form-wrapper">
                      <button type="button" class="switcher switcher-signup">
                        Sign Up
                        <span class="underline"></span>
                      </button>
                      <form class="form form-signup">
                        <fieldset>
                          <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                          <div class="input-block">
                            <label for="signup-email">E-mail</label>
                            <input id="signup-email" type="email" required>
                          </div>
                          <div class="input-block">
                            <label for="signup-password">Password</label>
                            <input id="signup-password" type="password" required>
                          </div>
                          <div class="input-block">
                            <label for="signup-password-confirm">Confirm password</label>
                            <input id="signup-password-confirm" type="password" required>
                          </div>
                        </fieldset>
                        <button type="submit" class="btn-signup">Continue</button>
                      </form>
                    </div>
                  </div>
                </section>

              </div>
            </div>

            </div>
            </div>
            </div>
            </div> -->


            <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bitana Business Management</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <img src="./images/com_logo.jpeg" alt="Logo" class="logo" style="border-radius:10px;width:80px;height:80px;">
    <ul>
      <li><a href="" id="home_button">Home</a></li>
      <li><a href="" id="register_button">Register</a></li>
      <li><a href="" id="contact_us">Contact Us</a></li>

    </ul>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <h1>VISINAW STOCK TECH</h1>
    <p>Our mission is to make trading and investing accessible, understandable, and profitable for everyone. We believe that financial education is the foundation of success in today’s dynamic markets, and we are dedicated to providing the knowledge and tools you need to succeed.
</p>
    <a href="" class="btn">Register</a>
  </section>
</body>

</html>
<!-- Mission & Vision Section -->
<section id="mission-vision" class="mission-vision">
  <div class="container">
    <div class="section-header">
      <h2>Trades & Subscribers</h2>
    </div>
    <div class="content">
      <div class="mission">
        <h3>Who We Are</h3>
        
        <p>Who We Are
At VISINAW STOCK TECH, we are a team of experienced traders, market analysts, and educators passionate about empowering individuals to achieve financial independence through smart trading and investment strategies. With a combined experience of over [X] years, we’ve trained thousands of aspiring traders and investors, helping them confidently navigate the complexities of financial markets.
</p>
        <img src="../template/images/trading_2.jpeg" alt="Mission Image">
      </div>
      <div class="vision">
        <h3>What We Offer</h3>
        <p>
We specialize in providing comprehensive training and resources in the following areas:

Stock Market Trading: Learn the fundamentals of stock trading, technical analysis, and market trends to make informed decisions.
Forex Trading: Master the art of currency trading, risk management, and strategies to profit in the global forex markets.
Investment Strategies: Explore long-term investment strategies, portfolio management, and wealth-building techniques.
Advanced Techniques: Dive into advanced concepts like options trading, algorithmic trading, and chart pattern analysis.
Our training programs cater to all skill levels—from beginners to advanced traders—and are designed to fit your learning pace and style.

</p>
        <img src="../template/images/trading_4.jpeg" alt="Vision Image">
      </div>
    </div>
  </div>
</section>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <!-- About Us Section -->
  <section class="about-us" id="about-us">
    <div class="container" id="register_value">
    <div class="col-md-12 grid-margin stretch-card">
              <div class="card" id="register_form">
                <div class="card-body">
                  <h4 class="card-title">Register Form</h4>
                  
                  <form class="forms-sample">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Username">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="Mobile number">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="exampleInputConfirmPassword2" placeholder="Password">
                      </div>
                    </div>
                   
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                  
                </div>


              </div>


              <div class="card" id ="login_form" style="display:none;">
                <div class="card-body">
                  <h4 class="card-title">Login Form</h4>
                  
                  <form id="total_array"  method="post" enctype="multipart/form-data">
                  <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Username" id="username" name="username" >
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="password" id="password" name="password" >
                      </div>
                    </div>
                  
                   
                    <button type="submit" class="btn btn-primary me-2" id="sbmt">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                  
                </div>


              </div>
            </div>
            <button type="submit" class="btn btn-primary me-2" id="register_screen" style="display:none;">Register</button>

            <button type="submit" class="btn btn-primary me-2" id="login_screen">Login</button>

    </div>
  </section>
  
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  
  <!-- Our Services Section -->
  <section class="our-services">
    <h4>  Why Choose Us?
</h4>
  <p>
Expert Guidance: Learn directly from industry professionals with proven track records of success.
Practical Learning : Gain hands-on experience with live market analysis, case studies, and trading simulations.
Comprehensive Resources: Access a wealth of study materials, webinars, and tools to support your journey.
Community Support: Join a vibrant community of like-minded traders and investors who share ideas and strategies.
Flexible Learning: Choose from online or in-person classes that fit your schedule.
Our Values
Integrity: We prioritize transparency and ethical practices in all aspects of trading and training.
Excellence: We strive to deliver the highest quality education and support to our students.
Innovation: We stay ahead of market trends and technological advancements to provide cutting-edge training.
Our Vision
To build a community of financially empowered individuals who are confident in navigating global markets and achieving their financial goals.

Get Started Today
Whether you’re looking to start your trading journey, enhance your existing skills, or explore new opportunities, [Your Business Name] is here to guide you every step of the way.

Join us and take the first step towards financial independence and market success.

Contact us today to learn more about our programs or to schedule a free consultation!
  </p>
    <footer class="footer-sm">
    <div class="container">
      
        <div class="row">
            <!-- ABOUT -->
            <div class="col-md-9">
                <h6>About Us</h6>
                <p style="color:#fff; font-size:1rem; text-align:justify; line-height:1.5; padding-left:10px;">Welcome to VISINAW STOCK TECH, your trusted partner in mastering the art of trading and investing in the share market, stock market, and forex markets.<br>
            </div>

            <!-- Categories -->
            <div class="col-md-3">
                <h6>Contact</h6>
                <ul>
                    <li>
                        <p><b>VISINAW STOCK TECH </b></p>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</footer>
</section>
  
</body>
</html>


<script>


document.addEventListener("keydown", function (e) {
        // Disable Ctrl+U
        if (e.ctrlKey && e.key === "u") {
            e.preventDefault();
            alert("View Source is disabled!");
        }

        // Disable Ctrl+Shift+I (DevTools)
        if (e.ctrlKey && e.shiftKey && e.key === "I") {
            e.preventDefault();
            alert("Developer Tools are disabled!");
        }

        // Disable F12 (DevTools)
        if (e.key === "F12") {
            e.preventDefault();
            alert("Developer Tools are disabled!");
        }
    });
    
document.getElementById('home_button').addEventListener('click', function () {
  
    const targetDiv = document.getElementById('mission-vision');
    targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
});



document.getElementById('register_button').addEventListener('click', function () {

    const container = document.getElementById('register_value');
    const target = document.getElementById('register_value');

    // Scroll the container to ensure the target is visible
    container.scrollTo({
        top: target.offsetTop - container.offsetTop,
        behavior: 'smooth',
    });
    event.preventDefault(); // Prevent default behavior

});


$('#login_screen').on('click', function() {
  $('#login_form').show();
  $('#register_form').hide();
  $('#register_screen').show();
  $('#login_screen').hide();

});


$('#register_screen').on('click', function() {
  $('#login_form').hide();
  $('#register_form').show();
  $('#register_screen').hide();
  $('#login_screen').show();

});


$("#total_array").on("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent default form submission
            submitForm(); // Call the AJAX function
        }
    });

$('#sbmt').on('click', function() {
    submitForm();
});

function submitForm() {
  event.preventDefault(); // Prevent default behavior

var username = $('#username').val();
var password = $('#password').val();


if (username === "") {
    toastr.info("Please check username");
}
else if (password === "") {
    toastr.info("Please check password");
}else{
    function runAjaxRequest() {

      var formData = {
          "user_name": username,
          "pass_word": password,
          

      };
      var functionName_fetchtable = "user_details"
      $.ajax({
          url: "../Api_files/login_query.php?function=" + functionName_fetchtable,
          type: "POST",
          data: formData,
          dataType: "json",

          success: function(response) {
              console.log(response);
              if (response.status === "success") {
                  toastr.success(response.message);

                  // Redirect to the specified page
                  setTimeout(function() {
                      window.location.href = response.redirect;
                  }, 1000);
              } else {
                  toastr.error(response.message || "Login failed. Please try again.");
              }
          },
          error: function(xhr, status, error) {
              toastr.error("An error occurred: " + error);
          }
      }); 
    }

  runAjaxRequest();

}


}

// document.getElementById('home_button').addEventListener('click', function () {
//     const targetDiv = document.getElementById('mission-vision');
//     targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
// });

// document.getElementById('home_button').addEventListener('click', function () {
//     const targetDiv = document.getElementById('mission-vision');
//     targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
// });

</script>