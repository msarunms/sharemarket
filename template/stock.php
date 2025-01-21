<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: register.php");
    exit;
}
?>
<?php include '../Common_header/header.php'; ?>
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
    <!-- partial -->
		
					

            <div class="col-lg-12 grid-margin stretch-card">                
              <div class="card">
              <div class="row">
                  <div class="col-md-3">
                    <div class="card-body">
                      <h4 class="card-title">Add New Stock</h4>
                      <div class="template-demo">
                        <button type="button" class="btn btn-success btn-rounded btn-fw" id="click-stock">Add</button>
                      </div>
                    </div>
                  </div>
                  

                  <div class="col-md-3 grid-margin stretch-card" style="display:none;" id="open-stock">
                    <div class="card" style="margin:16px;">
                      <div class="card-body">
                        <h4 class="card-title">Stock Form</h4>
                        
                        <form class="forms-sample">
                          <div class="form-group">
                            <label for="exampleInputUsername1">Stock name</label>
                            <input type="text" class="form-control" id="stock-value" placeholder="Stock name">
                          </div>
                          <button type="submit" class="btn btn-primary me-2" id="add_new_stock">Submit</button>
                          <button type="submit" class="btn btn-primary me-2" id="edit_new_stock" style="display:none">Submit</button>

                          <button class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Stocks Details</h4>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover" id="table-id">
                      <thead>
                        <tr>
                          <th>Stock ID</th>
                          <th>Stock Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            

            

				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<?php include '../Common_footer/footer.php'; ?>


        <div class="overlay" id="overlay">
          <div class="popup" id="popup">
              <div class="decorative-shape shape-1"></div>
              <div class="decorative-shape shape-2"></div>
              <button class="close-button" onclick="hidePopup()">&times;</button>
              <div class="popup-content">
                  <h2>Edit Stock</h2>
                  
                  <form id="leadForm" onsubmit="handleSubmit(event)">
                      <div class="form-group">
                          <label for="name">Stock Name</label>
                          <input type="text" id="edit-stock-value" required placeholder="Enter your stock">
                          <input type="hidden" name="hiddenFieldName" value="" id = "hiddenValue">

                      </div>
                      
                      <button type="submit" class="submit-button" id="edit-new-daily-details">Submit</button>
                  </form>
              </div>
          </div>
       </div>



       <div class="overlay_2" id="overlay_2">
          <div class="popup_2" id="popup_2">
              <div class="decorative-shape shape-1"></div>
              <div class="decorative-shape shape-2"></div>
              <button class="close-button" onclick="hidePopup()">&times;</button>
              <div class="popup-content">
                  <h2>Delete Stock</h2>
                  <input type="hidden" name="hiddenValue_dele" value="" id = "hiddenValue_dele">

                  <form id="leadForm" onsubmit="handleSubmit(event)">

                        <div class="row">
                            <div class="col-md-6">
                            <button type="submit" class="submit-button" id="delete_stock_details">Yes</button>

                            </div>
                            <div class="col-md-6">
                            <button type="submit" class="submit-button" id="cancel_stock">No</button>

                            </div>

                        </div>
                      
                  </form>
              </div>
          </div>
      </div>


      


				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
    </div>
		<!-- container-scroller -->
    <!-- base:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
		<script src="vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
		<script src="vendors/justgage/raphael-2.1.4.min.js"></script>
		<script src="vendors/justgage/justgage.js"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>



<script>

$('#click-stock').on('click', function() {
  $('#open-stock').show();
});



$('#add_new_stock').on('click', function() {
    event.preventDefault(); // Prevent default behavior

    var stock_val = $('#stock-value').val();
    if (stock_val === "" || stock_val == 0) {
        toastr.info("Please check Stock value");
    }else{
        var formData = {
            "stock_val": stock_val
        };
        var functionName_fetchtable = "add_new_stock"
        $.ajax({
        url: "../Api_files/query_file.php?function=" + functionName_fetchtable,
        type: "POST",
        data: formData,
        dataType: "json",

            success: function(data) {
                if( data == "Sucess"){
                    toastr.info("New Stock Created Successfully");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
                
                
            }
        }); 
    }
});


$(function() {

  $('table tr:eq(0)').prepend('<th> ID </th>');
  var id = 0;
  var functionName_fetchtable = "get_stocks"
  
    var formData = {
    };
    $.ajax({
        url: "../Api_files/query_file.php?function=" + functionName_fetchtable,
        type: "POST",
        data: formData,
        dataType: "json",

        success: function(data) {
            var tableBody = $('#table-id tbody');
            tableBody.empty();  // Clear existing rows from the table body

            if (data && Array.isArray(data)) {
                
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var item = data[i];
                        var row = '<tr>';
                        id++;

                        // row += '<td><div class="widget-content p-0"><div class="widget-content-wrapper"><div class="widget-content-left mr-3"><div class="widget-content-left"><img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt=""></div></div><div class="widget-content-left flex2"><div class="widget-heading">'+(i+1)+'</div></div></div></div></td><td><div class="widget-content p-0"><div class="widget-content-wrapper"><div class="widget-content-left mr-3"><div class="widget-content-left"><img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt=""></div></div><div class="widget-content-left flex2"><div class="widget-heading">'+item['id']+'</div></div></div></div></td><td class="text-center">'+item['article_name']+'</td><td class="text-center"><i class="material-icons" style="font-size:30px;color:blue" id="btnOpenForm" onclick="editRow('+item['id']+')">edit</i><i class="material-icons" style="font-size:30px;color:red" onclick="delRow('+item['id']+')">delete</i></td>'; 

                        row += '<td>' + id + '</td><td>'+item['id']+'</td><td class="text-success"> '+item['article_name']+' <i class="mdi mdi-arrow-up"></i></td><td><label class="badge badge-success"></label><button type="button" class="btn btn-outline-success btn-fw" style="margin:10px;" onclick="editRow('+item['id']+')">Edit</button><button type="button" class="btn btn-outline-danger btn-fw" onclick="delRow('+item['id']+')">Delete</button></td>';
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

function hidePopup() {
    const overlay = document.getElementById('overlay');
    const popup = document.getElementById('popup');
    popup.classList.remove('active');
    setTimeout(() => {
        overlay.style.display = 'none';
    }, 300);


    const overlay_2 = document.getElementById('overlay_2');
    const popup_2 = document.getElementById('popup_2');
    popup_2.classList.remove('active');
    setTimeout(() => {
        overlay_2.style.display = 'none';
    }, 300);
}

function editRow(value) {
  var stock_val = value

  const overlay = document.getElementById('overlay');
  const popup = document.getElementById('popup');
  overlay.style.display = 'block';
  setTimeout(() => {
      popup.classList.add('active');
  }, 10);

  var formData = {
        "stock_val": stock_val
    };
    var functionName_fetchtable = "edit_new_stock"
    $.ajax({
    url: "../Api_files/query_file.php?function=" + functionName_fetchtable,
    type: "POST",
    data: formData,
    dataType: "json",

        success: function(data) {
            if (data && Array.isArray(data)) {
                
                if (data.length > 0) {

                    for (var i = 0; i < data.length; i++) {
                        var item = data[i];
                        $('#edit-stock-value').val(item["article_name"]);
                        $('#hiddenValue').val(stock_val);

                    }
                }
            }
        }
    }); 
}



$('#edit-new-daily-details').on('click', function() {
    event.preventDefault(); // Prevent default behavior

    var stock_val = $('#edit-stock-value').val();
    var stock_id = $('#hiddenValue').val();
    if (stock_val === "" || stock_val == 0) {
        toastr.info("Please check Stock value");
    }else{
        var formData = {
            "stock_val": stock_val,
            "stock_id": stock_id

        };
        var functionName_fetchtable = "edit_new_stock_details"
        $.ajax({
        url: "../Api_files/query_file.php?function=" + functionName_fetchtable,
        type: "POST",
        data: formData,
        dataType: "json",

            success: function(data) {
                if( data == "Sucess"){
                    toastr.info("Stock Updated Successfully");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
                
                
            }
        }); 
    }
});


function delRow(value) {
    var stock_id = $('#hiddenValue_dele').val(value);

    var stock_val = value

    const overlay = document.getElementById('overlay_2');
    const popup = document.getElementById('popup_2');
    overlay.style.display = 'block';
    setTimeout(() => {
        popup.classList.add('active');
    }, 10);

}



$('#delete_stock_details').on('click', function() {
    event.preventDefault(); // Prevent default behavior
    
    var dele_id = $('#hiddenValue_dele').val();
    var formData = {
            "stock_id": dele_id

        };
        var functionName_fetchtable = "dele_new_stock_details"
        $.ajax({
        url: "../Api_files/query_file.php?function=" + functionName_fetchtable,
        type: "POST",
        data: formData,
        dataType: "json",

            success: function(data) {
                if( data == "Sucess"){
                    toastr.info("Stock Deleted Successfully");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
                
                
            }
        }); 
});

</script>