<?php

if (!isset($_SESSION['username'])) {
    header("Location: register.php");
    exit;
}
$username = $_SESSION['username']; // Access session username
$userid = $_SESSION['user_id']; // Access session username


?>
<!DOCTYPE html>
<html lang="en">
  <head>
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
    .typeahead{
      border-radius:6px;
    }
    .card-title{
      border-radius:6px;

    }
    <style>
  :root {
    --primary-gradient: linear-gradient(135deg, #4F46E5, #7C3AED);
    --secondary-gradient: linear-gradient(135deg, #3B82F6, #2563EB);
  }
  .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(6px);
        z-index: 1000;
        animation: fadeIn 0.3s ease-out;
    }

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.7);
        background: white;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        width: 90%;
        max-width: 480px;
        z-index: 1001;
        opacity: 0;
        transition: all 0.3s ease-out;
        background-image: 
            radial-gradient(circle at 0% 0%, rgba(79, 70, 229, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 100% 100%, rgba(124, 58, 237, 0.03) 0%, transparent 50%);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    

    .form-group {
        margin-bottom: 24px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-color);
        font-weight: 500;
        font-size: 14px;
        
    }

    .form-group input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s;
        box-sizing: border-box;
        background: #F9FAFB;
    }

    .form-group input:focus {
        outline: none;
        border-color: #4F46E5;
        background: white;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .submit-button {
        width: 100%;
        padding: 16px;
        background-image: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        position: relative;
        overflow: hidden;
    }

    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.3);
    }

    .submit-button::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            45deg,
            transparent 0%,
            rgba(255, 255, 255, 0.1) 50%,
            transparent 100%
        );
        transform: rotate(45deg);
        transition: transform 0.5s;
    }

    .submit-button:hover::after {
        transform: rotate(45deg) translate(50%, 50%);
    }

    .discount-badge {
        position: absolute;
        top: -15px;
        right: -15px;
        background: linear-gradient(135deg, #FF6B6B, #FF8E53);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(255, 107, 107, 0.2);
        transform: rotate(12deg);
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .form-group {
        animation: slideUp 0.5s ease-out forwards;
        opacity: 0;
    }

    .form-group:nth-child(1) { animation-delay: 0.2s; }
    .form-group:nth-child(2) { animation-delay: 0.3s; }

    @media (max-width: 640px) {
        .popup {
            padding: 32px;
            width: 95%;
        }

        .popup-content h2 {
            font-size: 24px;
        }
    }

    /* Decorative elements */
    .decorative-shape {
        position: absolute;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(79, 70, 229, 0.1), rgba(124, 58, 237, 0.1));
        z-index: -1;
    }

    .shape-1 {
        top: -20px;
        left: -20px;
    }

    .shape-2 {
        bottom: -20px;
        right: -20px;
        background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.1));
    }
  </style>
  <body>
    <div class="container-scroller">
				<!-- <div class="row p-0 m-0 proBanner" id="proBanner">
					<div class="col-md-12 p-0 m-0">
						<div class="card-body card-body-padding d-flex align-items-center justify-content-between">
							<div class="ps-lg-1">
								<div class="d-flex align-items-center justify-content-between">
									<p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
									<a href="https://www.bootstrapdash.com/product/kapella-admin-pro/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
								</div>
							</div>
							<div class="d-flex align-items-center justify-content-between">
								<a href="https://www.bootstrapdash.com/product/kapella-admin-pro/"><i class="mdi mdi-home me-3 text-white"></i></a>
								<button id="bannerClose" class="btn border-0 p-0">
									<i class="mdi mdi-close text-white me-0"></i>
								</button>
							</div>
						</div>
					</div>
				</div> -->
		<!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      
      <nav class="bottom-navbar" style="background-color: teal;">
      
        <div class="container">
                
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="index.php" style="padding: 17px 18px;">
                  <i class="mdi mdi-calendar-blank menu-icon" style="color:#fff"></i>
                  <span class="menu-title" style="color:#fff">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                  <a href="trading_measurement.php" class="nav-link" style="padding: 17px 18px;">
                    <i class="mdi mdi-checkbox-multiple-blank menu-icon" style="color:#fff"></i>
                    <span class="menu-title" style="color:#fff">Trading Measurement</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              
              <li class="nav-item">
                  <a href="stock.php" class="nav-link" style="padding: 17px 18px;">
                    <i class="mdi mdi-clipboard-text menu-icon" style="color:#fff"></i>
                    <span class="menu-title" style="color:#fff">Add Stocks</span>
                    <i class="menu-arrow" style="color:#fff"></i>
                  </a>
              </li>

              <!-- <li class="nav-item">
                  <a href="stock_api.php" class="nav-link">
                    <i class="mdi mdi-grid menu-icon"></i>
                    <span class="menu-title">Stocks</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li> -->

              <li class="nav-item">
                  <a href="#" class="nav-link" style="padding: 17px 18px;">
                    <i class="mdi mdi-cube-outline menu-icon" style="color:#fff"></i>
                    <span class="menu-title" style="color:#fff">Daily Details</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="daily_details.php" >Add New Daily</a></li>
                          <li class="nav-item"><a class="nav-link" href="daily_calculation.php">Daily Target Calculation</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link" style="padding: 17px 18px;">
                    <i class="mdi mdi-cube-outline menu-icon" style="color:#fff"></i>
                    <span class="menu-title" style="color:#fff">Weekly Details</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="weekly_details.php">Add New Weekly</a></li>
                          <li class="nav-item"><a class="nav-link" href="weekly_calculation.php">Weekly Target Calculation</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link" style="padding: 17px 18px;">
                    <i class="mdi mdi-cube-outline menu-icon" style="color:#fff"></i>
                    <span class="menu-title" style="color:#fff">Monthly Details</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="monthly_details.php">Add New Monthly</a></li>
                          <li class="nav-item"><a class="nav-link" href="monthly_calculation.php">Monthly Target Calculation</a></li>
                      </ul>
                  </div>
              </li>
              
              <li class="nav-item">
                  <a href="#" class="nav-link" style="padding: 17px 18px;">
                    <i class="mdi mdi-cube-outline menu-icon" style="color:#fff"></i>
                    <span class="menu-title" style="color:#fff">15 Min Details</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="fifteen_details.php">Add New 15 Min</a></li>
                          <li class="nav-item"><a class="nav-link" href="fifteen_calculation.php">15 Min Target Calculation</a></li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item">
                  <a href="#" class="nav-link" style="padding: 17px 18px;">
                    <i class="mdi mdi-cube-outline menu-icon" style="color:#fff"></i>
                    <span class="menu-title" style="color:#fff">Hourly Details</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="hourly_details.php">Add New Hourly</a></li>
                          <li class="nav-item"><a class="nav-link" href="hourly_calculation.php">Hourly Target Calculation</a></li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item">
                  <a href="#" class="nav-link" style="padding: 17px 18px;">
                    <i class="mdi mdi-cube-outline menu-icon" style="color:#fff"></i>
                    <span class="menu-title" style="color:#fff">User Details</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="members.php">Members</a></li>
                          <li class="nav-item"><a class="nav-link" href="register.php">Logout</a></li>
                      </ul>
                  </div>
              </li>
              <!-- <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="mdi mdi-finance menu-icon"></i>
                    <span class="menu-title">Trading Target</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li> -->
            
            </ul>
        </div>
      </nav>
    </div>

    <div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="row">
                        <div class="col-sm-5 mb-4 mb-xl-0">
							
						</div>
						<div class="col-sm-4 mb-4 mb-xl-0">
							<div class="d-lg-flex align-items-center">
								<div>
									<h3 class="font-weight-bold mb-2" style="font-weight:bold;color:green;">Hi, <?php echo htmlspecialchars($username); ?> Welcome!</h3>
								</div>
								
							</div>
						</div>
                        <div class="col-sm-4 mb-4 mb-xl-0">
							
						</div>
						
					</div>





<script>


  $(function() {

      var functionName_fetchtable = "fetch_data_register_details_login"
    
      var formData = {
      };
      $.ajax({
          url: "../Api_files/register_query.php?function=" + functionName_fetchtable,
          type: "POST",
          data: formData,
          dataType: "json",

          success: function(data) {
              var tableBody = $('#table-id tbody');
              tableBody.empty();  // Clear existing rows from the table body

              if (data && Array.isArray(data)) {
                  
                  if (data.length > 0) {
                      $('#no-stock-divd').hide();

                      for (var i = 0; i < data.length; i++) {
                          var item = data[i];
                          var row = '<tr>';

                          row += '<td>'+item['id']+'</td><td>'+item['user_name']+'</td><td>'+item['phone_number']+'</td><td>'+item['email_id']+'</td><td>'+item['password']+'</td><td>'+item['startdate']+'</td><td>'+item['enddate']+'</td><td><label class="badge badge-danger">'+item['active_status']+'</label></td><td><label class="badge badge-danger">'+item['current_status']+'</label></td><td>'+item['members']+'</td><td><button type="button" class="btn btn-success btn-rounded btn-icon"><i class="mdi mdi-pencil"></i> </button></td>'; 

                          row += '</tr>';
                          
                          tableBody.append(row);  // Append the row to the table


                      }
                  } 
                  else{
                      $('#no-stock-divd').show();

                  }
              }
              

          
          
          }
      }); 

  });


</script>