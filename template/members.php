
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: register.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>VISINAW STOCK TECH</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="./images/com_logo.jpeg" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

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

    .overlay_2 {
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

    .popup.active {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }

    .popup_2 {
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

    .popup_2.active {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }

    .overlay_delete {
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

    .popup_delete {
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

    .popup_delete.active {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }


    .close-button {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(243, 244, 246, 0.8);
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #6B7280;
        padding: 8px;
        line-height: 1;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-button:hover {
        background: rgba(243, 244, 246, 1);
        color: #374151;
        transform: rotate(90deg);
    }

    .popup-content {

        position: relative;
        color:#000;
    }

    .popup-content h2 {
        margin: 0 0 12px 0;
        color: var(--text-color);
        font-size: 28px;
        font-weight: 700;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.2;
    }

    .popup-content p {
        margin: 0 0 32px 0;
        color: #4B5563;
        font-size: 16px;
        line-height: 1.6;
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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="main-panel w-100  documentation">
        <div class="content-wrapper">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12 doc-header">
                <a class="btn btn-success" style="background: #a09ad9;" href="index.php"><i class="mdi mdi-backspace"></i></a>
              </div>
            </div>
            <div class="row" style="padding-top:84px;">
              
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Members</h4>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped" id="table-id">
                      <thead>
                        <tr>
                          <th>
                            User ID
                          </th>
                          <th>
                            User Name
                          </th>
                          <th>
                            Phone Number
                          </th>
                          <th>
                            Email ID
                          </th>
                          <th>
                            Password
                          </th>
                          <th>
                            Start Date
                          </th>
                          <th>
                            End Date
                          </th>
                          <th>
                            Current Status
                          </th>
                          <th>
                            Active Status
                          </th>
                          <th>
                            Members
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>


          <div class="overlay" id="overlay">
          <div class="popup" id="popup">
              <div class="decorative-shape shape-1"></div>
              <div class="decorative-shape shape-2"></div>
              <button class="close-button" onclick="hidePopup()">&times;</button>
              <div class="popup-content">
                  <h2>Edit Users</h2>
                  
                  <form id="leadForm" onsubmit="handleSubmit(event)">
                      <div class="form-group">

                          <div class="template-demo">
                              <div class="form-group row">
                                  <div class="col">
                                      <div id="the-basics">
                                      <label for="name">User ID</label>
                                      <input type="text" id="edit_user_id_value" required placeholder="User ID">

                                      </div>
                                  </div>
                                  <div class="col">
                                      <div id="bloodhound">
                                      <label for="name">User Name</label>

                                      <input type="text" id="edit_user_name_value" required placeholder="User Name">

                                      </div>
                                  </div>
                                  
                              </div>
                              
                          </div>

                          <div class="template-demo">
                              <div class="form-group row">
                                  <div class="col">
                                      <div id="the-basics">
                                      <label for="name">Phone Number</label>
                                      <input type="text" id="edit_phone_value" required placeholder="Phone Number">

                                      </div>
                                  </div>
                                  <div class="col">
                                      <div id="bloodhound">
                                      <label for="name">Password</label>
                                      <input type="text" id="edit_password_value" required placeholder="Password">

                                      </div>
                                  </div>
                                  
                              </div>
                              
                          </div>
                          <div class="template-demo">
                              <div class="form-group row">
                                  <div class="col">
                                      <div id="the-basics">
                                      <label for="name">Current Status</label>
                                      <select class="form-control" id ="category_list">
                                        <option value="0" >Select Status</option>
                                        <option value="1" >Active</option>
                                        <option value="2" >In-Active</option>
                                        <option value="3" >Expired</option>

                                      </select>

                                      </div>
                                  </div>
                                  <div class="col">
                                      <div id="bloodhound">
                                      <label for="name">Active Status</label>
                                      <select class="form-control" id ="category_list">
                                        <option value="0" >Select Status</option>
                                        <option value="1" >1</option>
                                        <option value="2" >0</option>

                                      </select>

                                      </div>
                                  </div>
                                  
                              </div>
                              
                          </div>

                          <div class="template-demo">
                              <div class="form-group row">
                                  <div class="col">
                                      <div id="the-basics">
                                      <label for="name">Start Date</label>
                                      <input type="datetime-local" id="edit_start_value" required placeholder="Start Date">

                                      </div>
                                  </div>
                                  <div class="col">
                                      <div id="bloodhound">
                                      <label for="name">End Date</label>
                                      <input type="datetime-local" id="edit_end_value" required placeholder="End Date">

                                      </div>
                                  </div>
                                  
                              </div>
                              
                          </div>


                          

                          <label for="name">Members</label>

                          <select class="form-control" id ="category_list">
                            <option value="0" >Select Member/option>
                            <option value="1" >Admin</option>
                            <option value="2" >Users</option>

                          </select>

                          <input type="hidden" name="hiddenFieldName" value="" id = "hiddenValue">

                      </div>
                      
                      <button type="submit" class="submit-button" id="edit-new-daily-details">Submit</button>
                  </form>
              </div>
          </div>

        </div>
        <!-- partial:../partials/_footer.html -->
        <footer class="footer">
            <div class="footer-wrap">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Stock Analysis 2025</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">VISINAW STOCK TECH </span>
            </div>
            </div>
        </footer>
        <!-- partial -->
      </div>
    </div>
  </div>
</body>

</html>




<script>

function hidePopup() {
    const overlay = document.getElementById('overlay');
    const popup = document.getElementById('popup');
    popup.classList.remove('active');
    setTimeout(() => {
        overlay.style.display = 'none';
    }, 300);

}

$(function() {

    var functionName_fetchtable = "fetch_data_register_details"
  
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

                        row += '<td>'+item['id']+'</td><td>'+item['user_name']+'</td><td>'+item['phone_number']+'</td><td>'+item['email_id']+'</td><td>'+item['password']+'</td><td>'+item['startdate']+'</td><td>'+item['enddate']+'</td><td><label class="badge badge-danger">'+item['active_status']+'</label></td><td><label class="badge badge-danger">'+item['current_status']+'</label></td><td>'+item['members']+'</td><td><button type="button" class="btn btn-success btn-rounded btn-icon" onclick="editRow('+item['id']+')"><i class="mdi mdi-pencil"></i> </button></td>'; 

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

function editRow(value) {
  var stock_val = value

  const overlay = document.getElementById('overlay');
  const popup = document.getElementById('popup');
  overlay.style.display = 'block';
  setTimeout(() => {
      popup.classList.add('active');
  }, 10);

  var formData = {
        "id": stock_val
    };
    var functionName_fetchtable = "edit_members"
    $.ajax({
    url: "../Api_files/members_query.php?function=" + functionName_fetchtable,
    type: "POST",
    data: formData,
    dataType: "json",

        success: function(data) {
            if (data && Array.isArray(data)) {
                
                if (data.length > 0) {

                    for (var i = 0; i < data.length; i++) {
                        var item = data[i];
                        $('#edit_user_id_value').val(item["id"]);
                        $('#edit_user_name_value').val(item["user_name"]);
                        $('#edit_phone_value').val(item["phone_number"]);
                        $('#edit_password_value').val(item["password"]);

                        $('#hiddenValue').val(stock_val);

                    }
                }
            }
        }
    }); 

}
</script>