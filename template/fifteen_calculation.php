<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: register.php");
    exit;
}
?>
<?php include '../Common_header/header.php'; ?>
    <!-- partial -->
		
					

            <div class="col-lg-12">                
                    <div class="card" style="margin: 0px 0px 27px 0px;">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card-body">
                                <h4 class="card-title">Select Stock</h4>
                                    <select class="form-control" id ="category_list">
                                            <?php
                                                $functionName = 'fetchData_stocks';
                                                $url = 'http://localhost/Share_Market/Api_files/query_file.php?function=fetchData_stocks';
                                                $jsonData = file_get_contents($url);

                                                $dataArray = json_decode($jsonData, true);
                                            
                                                if (is_array($dataArray) && !empty($dataArray)) {
                                                    echo '<option value="0" >Select Stock</option>';
                                                
                                                    // Loop through the array and create dropdown options
                                                    foreach ($dataArray as $item) {
                                                        echo '<option value="' . htmlspecialchars($item['id']) . '">' . htmlspecialchars($item['article_name']) . '</option>';
                                                    }
                                                
                                                    echo '</select>';
                                                } else {
                                                    echo "No data available.";
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                            
                            </div>
                            <div class="col-md-3">
                                
                                
                            </div>
                            <div class="col-md-3">
                            
                            </div>
                            

                            
                        </div>
                    </div>

                    <div class="card" style="margin: 0px 0px 27px 0px;">
                        <div class="row">
                            <div class="col-md-12" align="center">
                                <div class="card-body">
                                    <h4 class="card-title">GREEN UP TREND CANDLE CLOSING</h4>
                                    
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6" align="center">
                                <div class="card-body">
                                    <h4 class="card-title">BOTTOM</h4>
                                    <div class="form-group row">
                                        
                                        <div class="col">
                                            <label>Bottom</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" placeholder="Bottom" id = "enter_bottom_value">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        
                                        <div class="col">
                                            <label>Stop Loss</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" id = "bottom_low">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Entry</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text"  id = "bottom_support">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Exit</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text"  id = "bottom_high">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Avg</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" id = "entry_level_low">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6" align="center">
                            <div class="card-body">
                                    <h4 class="card-title">UP SUPPORT</h4>
                                    <div class="form-group row">
                                        
                                        <div class="col">
                                            <label>Up Support</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" placeholder="Up Support" id = "enter_upsupport_value">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        
                                        <div class="col">
                                            <label>Exit</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" id = "up_support_low">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Entry</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text"  id = "up_support_support">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Stop Loss</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text"  id = "up_support_high">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Avg</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" id = "entry_level_up">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-md-6" align="center">
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover" id ="table-id-bottom">
                                            <thead>
                                                <tr style="background: teal;color:#fff">
                                                <th>Trend</th>
                                                <th class="text-center">Low</th>
                                                <th class="text-center">Support</th>
                                                <th class="text-center">High</th>
                                                <th class="text-center">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>

                                        <div class="col-md-12" align="center" id="no-stock-divd2_up">
                                            <p class="ps-1" style="color:black;    background: beige;">No Data Available</p>
                                        </div>
                                    </div>     
                                    
                                </div>
                            </div>
                            <div class="col-md-6" align="center">
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover" id ="table-id-up">
                                            <thead>
                                                <tr style="background: teal;color:#fff">
                                                <th>Trend</th>
                                                <th class="text-center">Low</th>
                                                <th class="text-center">Support</th>
                                                <th class="text-center">High</th>
                                                <th class="text-center">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>

                                        <div class="col-md-12" align="center" id="no-stock-divd2">
                                            <p class="ps-1" style="color:black;    background: beige;">No Data Available</p>
                                        </div>
                                    </div>     
                                    
                                </div>
                            </div>
                            
                        </div>


                        <div class="row">
                            <div class="col-md-12" align="center">
                                <div class="card-body">
                                    <h4 class="card-title">RED DOWN TREND CANDLE CLOSING</h4>
                                    
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6" align="center">
                                <div class="card-body">
                                    <h4 class="card-title">Down Support</h4>
                                    <div class="form-group row">
                                        
                                        <div class="col">
                                            <label>Down Support</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" placeholder="Down Support" id = "enter_upsupport_value_1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        
                                        <div class="col">
                                            <label>Exit</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" id = "upsupport_low_1">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Entry</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text"  id = "upsupport_support_1">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Stop Loss</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text"  id = "upsupport_high_1">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Avg</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" id = "entry_level_down">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6" align="center">
                            <div class="card-body">
                                    <h4 class="card-title">High</h4>
                                    <div class="form-group row">
                                        
                                        <div class="col">
                                            <label>High</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" placeholder="High" id = "enter_high_value_1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        
                                        <div class="col">
                                            <label>Exit</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" id = "enter_high_value_2">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Entry</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text"  id = "enter_high_value_3">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Stop Loss</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text"  id = "enter_high_value_4">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Avg</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" id = "entry_level_high">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-md-6" align="center">
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover" id ="table-id-put-up">
                                            <thead>
                                                <tr style="background: teal;color:#fff">
                                                <th>Trend</th>
                                                <th class="text-center">Low</th>
                                                <th class="text-center">Support</th>
                                                <th class="text-center">High</th>
                                                <th class="text-center">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>

                                        <div class="col-md-12" align="center" id="no-stock-divd3">
                                            <p class="ps-1" style="color:black;    background: beige;">No Data Available</p>
                                        </div>
                                    </div>     
                                    
                                </div>
                            </div>
                            <div class="col-md-6" align="center">
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover" id ="table-id-put-high">
                                            <thead>
                                                <tr style="background: teal;color:#fff">
                                                <th>Trend</th>
                                                <th class="text-center">Low</th>
                                                <th class="text-center">Support</th>
                                                <th class="text-center">High</th>
                                                <th class="text-center">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>

                                        <div class="col-md-12" align="center" id="no-stock-divd4">
                                            <p class="ps-1" style="color:black;    background: beige;">No Data Available</p>
                                        </div>
                                    </div>     
                                    
                                </div>
                            </div>
                            
                        </div>

                    </div>

                                            
                </div>
            
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<?php include '../Common_footer/footer.php'; ?>

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

$(function() {
    $('#no-stock-divd').show();
    $('#no-stock-divd2').show();
    $('#no-stock-divd2_up').show();
    $('#no-stock-divd3').show();
    $('#no-stock-divd4').show();

 
});


$('#enter_bottom_value').on('keyup', function() {
    
    var bottom_val = $('#enter_bottom_value').val();
    var stock_text = $('#category_list option:selected').text();
    var stock_val = $('#category_list option:selected').val();
    var functionName_fetchtable = "fetch_calc_details"
    var formData = {
        "bottom_value" : bottom_val,
        "stock_text" : stock_text,
        "stock_val" : stock_val
    };
    $.ajax({
    url: "../Api_files/fifteen_query.php?function=" + functionName_fetchtable,
    type: "POST",
    data: formData,
    dataType: "json",

        success: function(data) {
            // for (var i = 0; i < data.length; i++) {
            //     var item = data[i];
            //     const maxLow = data
            // .filter(item => parseFloat(item["low"]) < bottom_val && item["calc_trend"] == "DOWN")  // Filter conditions
            // .reduce((max, item) => Math.max(max, parseFloat(item["low"])), -Infinity);   50176.15// Find the max low

            // console.log(maxLow === -Infinity ? "No matching values" : maxLow);
            // }
            // // Find the maximum `low` where `low < dailyTargetB3` and `calc_trend === "DOWN"`
            

            for (const key in data) {
                if (key === "details") {
                    // Loop through the nested 'details' object
                    for (const detailKey in data.details) {
                        $('#bottom_support').val(data.details["support"]);
                        $('#bottom_high').val(data.details["high"]);
                        // $('#enter_upsupport_value').val(data.details["high"]);

                    }
                } else {
                    $('#bottom_low').val(data['low_value']);
                }
            }

        }
    }); 

    // Table fetch
 var functionName_fetchdata = "fetch_calc_details_down_support_get_table"
 $.ajax({
     url: "../Api_files/fifteen_query.php?function=" + functionName_fetchdata,
     type: "POST",
     data: formData,
     dataType: "json",
 
         success: function(data) {
             var tableBody = $('#table-id-bottom tbody');
             tableBody.empty();  // Clear existing rows from the table body
             var extraDetails = data.extra_details;
             if (extraDetails !=""){
                 $('#no-stock-divd2_up').hide();
                 extraDetails.forEach(function(detail) {
                     // alert(
                     //     "Support: " + detail.support + "\n" +
                     //     "Low: " + detail.low + "\n" +
                     //     "High: " + detail.high + "\n" +
                     //     "Calc Trend: " + detail.calc_trend + "\n" +
                     //     "Date: " + detail.date
                     // );
                     var row = '<tr>';

                     row += '<td><div class="widget-content p-0"><div class="widget-content-wrapper"><div class="widget-content-left mr-3"><div class="widget-content-left"></div></div><div class="widget-content-left flex2"><div class="widget-heading"> '+detail.calc_trend+' </div> </div> </div> </div></td><td class="text-center">'+detail.low+'</td><td class="text-center">'+detail.support+'</td><td class="text-center">'+detail.high+'</td><td class="text-center"><div class="badge badge-primary">'+detail.date+'</div></td>'; 

                     row += '</tr>';
                     tableBody.append(row);  // Append the row to the table

                 });
             } else{
                     $('#no-stock-divd2_up').show();

                 }
         }
     }); 
});



$('#enter_upsupport_value').on('keyup', function() {
 
 var bottom_val = $('#enter_upsupport_value').val();
 var stock_text = $('#category_list option:selected').text();
 var stock_val = $('#category_list option:selected').val();
 var functionName_fetchtable = "fetch_calc_details_up_support"
 var formData = {
     "bottom_value" : bottom_val,
     "stock_text" : stock_text,
     "stock_val" : stock_val
 };
 $.ajax({
 url: "../Api_files/fifteen_query.php?function=" + functionName_fetchtable,
 type: "POST",
 data: formData,
 dataType: "json",

     success: function(data) {
         for (const key in data) {
             if (key === "details") {
                 // Loop through the nested 'details' object
                 for (const detailKey in data.details) {
                     $('#up_support_support').val(data.details["support"]);
                     $('#up_support_high').val(data.details["low"]);
                     $('#enter_bottom_value').val(data.details["low"]);
                     $('#up_support_low').val(data.details["high"]);
                     $('#enter_upsupport_value_1').val(data.details["high"]);

                     

                 }
             } 
         }

     }
 }); 

 // Table fetch
 var functionName_fetchdata = "fetch_calc_details_up_support_get_table"
 $.ajax({
 url: "../Api_files/fifteen_query.php?function=" + functionName_fetchdata,
 type: "POST",
 data: formData,
 dataType: "json",

     success: function(data) {
         var tableBody = $('#table-id-up tbody');
         tableBody.empty();  // Clear existing rows from the table body
         var extraDetails = data.extra_details;
         if (extraDetails !=""){
             $('#no-stock-divd2').hide();
             support_val_arr = [];
             extraDetails.forEach(function(detail) {
                 // alert(
                 //     "Support: " + detail.support + "\n" +
                 //     "Low: " + detail.low + "\n" +
                 //     "High: " + detail.high + "\n" +
                 //     "Calc Trend: " + detail.calc_trend + "\n" +
                 //     "Date: " + detail.date
                 // );
                 support_val_arr.push(detail.support);
                 var row = '<tr>';
                 
                 row += '<td><div class="widget-content p-0"><div class="widget-content-wrapper"><div class="widget-content-left mr-3"><div class="widget-content-left"></div></div><div class="widget-content-left flex2"><div class="widget-heading"> '+detail.calc_trend+' </div> </div> </div> </div></td><td class="text-center">'+detail.low+'</td><td class="text-center">'+detail.support+'</td><td class="text-center">'+detail.high+'</td><td class="text-center"><div class="badge badge-primary">'+detail.date+'</div></td>'; 

                 row += '</tr>';
                 tableBody.append(row);  // Append the row to the table

             });
             values = support_val_arr.map(parseFloat);
             let differences = [];
             let highestDifference = Number.NEGATIVE_INFINITY;
              // Calculate differences using a loop
               for (let i = 0; i < values.length; i++) {
                  if (i > 0) { // Skip the first value since there's no previous value to subtract
                        let difference = values[i] - values[i - 1];
                        differences.push(difference);

                        // Update the highest difference
                        if (difference > highestDifference) {
                           highestDifference = difference;
                        }
                  }
               }
               console.log(differences);
               $('#entry_level_up').val(highestDifference.toFixed(2));
               

         } else{
                 $('#no-stock-divd2').show();

             }
     }
 }); 

});




// Put option

$('#enter_upsupport_value_1').on('keyup', function() {
    
    var upsupport_val = $('#enter_upsupport_value_1').val();
    var stock_text = $('#category_list option:selected').text();
    var stock_val = $('#category_list option:selected').val();
    var functionName_fetchtable = "fetch_calc_details_up_support_val"
    var formData = {
        "bottom_value" : upsupport_val,
        "stock_text" : stock_text,
        "stock_val" : stock_val
    };
    $.ajax({
    url: "../Api_files/fifteen_query.php?function=" + functionName_fetchtable,
    type: "POST",
    data: formData,
    dataType: "json",
   
        success: function(data) {
            for (const key in data) {
                if (key === "details") {
                    // Loop through the nested 'details' object
                    for (const detailKey in data.details) {
                        $('#upsupport_support_1').val(data.details["support"]);
                        $('#upsupport_high_1').val(data.details["high"]);
                        $('#enter_high_value_1').val(data.details["high"]);
                        $('#upsupport_low_1').val(data.details['low']);


                    }
                } 
            }
        }
    }); 

   // Table fetch
   var functionName_fetchdata = "fetch_calc_details_up_support_get_table_put_call"
    $.ajax({
    url: "../Api_files/fifteen_query.php?function=" + functionName_fetchdata,
    type: "POST",
    data: formData,
    dataType: "json",
   
        success: function(data) {
            var tableBody = $('#table-id-put-up tbody');
            tableBody.empty();  // Clear existing rows from the table body
            var extraDetails = data.extra_details;
            if (extraDetails !=""){
                $('#no-stock-divd3').hide();
                support_val_arr = []
                extraDetails.forEach(function(detail) {
                    // alert(
                    //     "Support: " + detail.support + "\n" +
                    //     "Low: " + detail.low + "\n" +
                    //     "High: " + detail.high + "\n" +
                    //     "Calc Trend: " + detail.calc_trend + "\n" +
                    //     "Date: " + detail.date
                    // );
                    support_val_arr.push(detail.support);

                    var row = '<tr>';

                    row += '<td><div class="widget-content p-0"><div class="widget-content-wrapper"><div class="widget-content-left mr-3"><div class="widget-content-left"></div></div><div class="widget-content-left flex2"><div class="widget-heading"> '+detail.calc_trend+' </div> </div> </div> </div></td><td class="text-center">'+detail.low+'</td><td class="text-center">'+detail.support+'</td><td class="text-center">'+detail.high+'</td><td class="text-center"><div class="badge badge-primary">'+detail.date+'</div></td>'; 

                    row += '</tr>';
                    tableBody.append(row);  // Append the row to the table

                });

                values = support_val_arr.map(parseFloat);
                let differences = [];
                let highestDifference = Number.NEGATIVE_INFINITY;
                 // Calculate differences using a loop
                  for (let i = 0; i < values.length; i++) {
                     if (i > 0) { // Skip the first value since there's no previous value to subtract
                           let difference = values[i] - values[i - 1];
                           differences.push(difference);

                           // Update the highest difference
                           if (difference > highestDifference) {
                              highestDifference = difference;
                           }
                     }
                  }
                  $('#entry_level_down').val(highestDifference.toFixed(2));

            } else{
                    $('#no-stock-divd3').show();

                }
        }
    }); 
});  


$('#enter_high_value_1').on('keyup', function() {
    
    var upsupport_val = $('#enter_high_value_1').val();
    var stock_text = $('#category_list option:selected').text();
    var stock_val = $('#category_list option:selected').val();
    var functionName_fetchtable = "fetch_calc_details_high_support_val"
    var formData = {
        "bottom_value" : upsupport_val,
        "stock_text" : stock_text,
        "stock_val" : stock_val
    };
    $.ajax({
    url: "../Api_files/fifteen_query.php?function=" + functionName_fetchtable,
    type: "POST",
    data: formData,
    dataType: "json",
   
        success: function(data) {
            for (const key in data) {
                if (key === "details") {
                    // Loop through the nested 'details' object
                    for (const detailKey in data.details) {
                        $('#enter_high_value_3').val(data.details["support"]);
                        $('#enter_high_value_4').val(data.details["high"]);
                        $('#enter_high_value_2').val(data.details["low"]);


                    }
                } 
            }
        }
    }); 
    // Table fetch
   var functionName_fetchdata = "fetch_calc_details_high_get_table_put_call"
    $.ajax({
    url: "../Api_files/fifteen_query.php?function=" + functionName_fetchdata,
    type: "POST",
    data: formData,
    dataType: "json",
   
        success: function(data) {
            var tableBody = $('#table-id-put-high tbody');
            tableBody.empty();  // Clear existing rows from the table body
            var extraDetails = data.extra_details;
            if (extraDetails !=""){
                support_val_arr = []
                $('#no-stock-divd4').hide();
                extraDetails.forEach(function(detail) {
                    // alert(
                    //     "Support: " + detail.support + "\n" +
                    //     "Low: " + detail.low + "\n" +
                    //     "High: " + detail.high + "\n" +
                    //     "Calc Trend: " + detail.calc_trend + "\n" +
                    //     "Date: " + detail.date
                    // );
                    support_val_arr.push(detail.support);
                    var row = '<tr>';

                    row += '<td><div class="widget-content p-0"><div class="widget-content-wrapper"><div class="widget-content-left mr-3"><div class="widget-content-left"></div></div><div class="widget-content-left flex2"><div class="widget-heading"> '+detail.calc_trend+' </div> </div> </div> </div></td><td class="text-center">'+detail.low+'</td><td class="text-center">'+detail.support+'</td><td class="text-center">'+detail.high+'</td><td class="text-center"><div class="badge badge-primary">'+detail.date+'</div></td>'; 

                    row += '</tr>';
                    tableBody.append(row);  // Append the row to the table

                });

                values = support_val_arr.map(parseFloat);
                let differences = [];
                let highestDifference = Number.POSITIVE_INFINITY;
                 // Calculate differences using a loop
                  for (let i = 0; i < values.length; i++) {
                     if (i > 0) { // Skip the first value since there's no previous value to subtract
                           let difference = values[i] - values[i - 1];
                           differences.push(difference);

                           
                     }
                  }
                  // Loop to find the lowest value
                  for (let i = 0; i < differences.length; i++) {
                     if (differences[i] < highestDifference) {
                        highestDifference = differences[i];
                     }
                  }
                  console.log(highestDifference);
                  $('#entry_level_high').val(highestDifference.toFixed(2));
            } else{
                    $('#no-stock-divd4').show();

                }
        }
    }); 
});  

</script>