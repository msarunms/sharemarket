<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: register.php");
    exit;
}
?>
<?php include '../Common_header/header.php'; ?>
    <!-- partial -->
		
					

            <div class="col-lg-12 grid-margin stretch-card">                
                    <div class="card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-body">
                            <h4 class="card-title">Select Stock (Fetch)</h4>
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
                            <div class="card-body">
                            <h4 class="card-title">Total 15 Min Details</h4>
                            <div class="template-demo">
                                <button type="button" class="btn btn-success btn-rounded btn-fw" id="click-stock">Add 15 Min</button>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-body">
                            <h4 class="card-title">Truncate Stock Details</h4>
                            <div class="template-demo">
                                <label for="exampleInputUsername1">Stock name</label>

                                <select class="form-control" id="category_list_3">
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

                                <button type="button" class="btn btn-warning btn-icon-text button_del">
                                <i class="mdi mdi-alert btn-icon-prepend"></i>                                                    
                                Truncate
                                </button>
                            </div>
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="card-body">
                            <h4 class="card-title">Bulk Upload 15 Min Details</h4>
                            <div class="template-demo">
                                <form id="uploadForm" enctype="multipart/form-data">
                                    <input class="typeahead file-input" type="file" id="fileInput" name="fileInput" accept=".xlsx" type="file">
                                </form>
                                <button type="button" class="btn btn-info btn-icon-text" onclick ="uploadfile()">
                                <i class="mdi mdi-upload btn-icon-prepend"></i>                                                    
                                    Submit Upload
                                </button>
                            </div>
                            </div>
                        </div>
                        

                        <div class="col-md-12 grid-margin stretch-card" style="display:none;" id="open-stock">
                            <div class="card" style="">
                            <div class="card-body">
                                <h4 class="card-title">15 Min Form</h4>
                                
                                <form class="forms-sample">
                                    <div class="form-group row">
                                        <div class="col">
                                            <label>Select Stock</label>
                                            <div id="bloodhound">
                                            <select class="form-control" id = "category_list_2">
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
                                        <div class="col">
                                            <label>High</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" placeholder="High" id="high-value">
                                            </div>
                                        </div>
                                        
                                        <div class="col">
                                            <label>Low</label>
                                            <div id="bloodhound">
                                                <input class="typeahead" type="text" placeholder="Low" id="low-value">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Open</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" placeholder="Open" id="open-value">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Close</label>
                                            <div id="the-basics">
                                                <input class="typeahead" type="text" placeholder="Close" id="close-value">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Date</label>
                                            <div id="bloodhound">
                                                <input class="typeahead" type="date" placeholder="Date" id="date-value">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    
                                
                                    <button type="submit" class="btn btn-primary me-2" id="add-new-daily-details">Submit</button>
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
                        <h4 class="card-title">15 Min Details</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="search"  id="search">

                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                <div class="btn-actions-pane-right" >
                                            
                                    <div class="form-group" style="margin-bottom: 0px !important"> 	<!--		Show Numbers Of Rows 		-->
                                        <select class  ="form-control" name="state" id="maxRows">
                                            <option value="50000">Show ALL Rows</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="70">70</option>
                                            <option value="100">100</option>
                                            </select>
                            
                                    </div>
                            
                                </div>
                            </div>
                            
                        </div>                      
                        <p class="card-description">
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-id">
                                <thead>
                                    <tr>
                                    <th>Stock ID</th>
                                    <th>Stock Name</th>
                                    <th>High</th>
                                    <th>Open</th>
                                    <th>Low</th>
                                    <th>Close</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>

                            <div class="col-md-12" align="center" id="no-stock-divd">
                                <p class="text-light bg-dark ps-1">No Data Available</p>
                            </div>
                            <div class="pagination-container" ><nav> <ul class="pagination"><li data-page="prev" style="padding:10px;"><span > < <span class="sr-only"></span></span></li><li data-page="next" id="prev" style="padding:10px;"><span> > <span class="sr-only"></span></span></li></ul></nav></div>
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


getPagination('#table-id');
function getPagination(table) {
  var lastPage = 1;
  $('#maxRows').on('change', function(evt) {
        lastPage = 1;
        $('.pagination')
        .find('li')
        .slice(1, -1)
        .remove();
        var trnum = 0; // reset tr counter
        var maxRows = parseInt($(this).val()); // get Max Rows from select option

        if (maxRows == 5000) {
            $('.pagination').hide();
        } else {
            $('.pagination').show();
        }

      var totalRows = $(table + ' tbody tr').length; // numbers of rows
      $(table + ' tr:gt(0)').each(function() {
        // each TR in  table and not the header
        trnum++; // Start Counter
        if (trnum > maxRows) {
          // if tr number gt maxRows

          $(this).hide(); // fade it out
        }
        if (trnum <= maxRows) {
          $(this).show();
        } // else fade in Important in case if it ..
      }); //  was fade out to fade it in
      if (totalRows > maxRows) {
        // if tr total rows gt max rows option
        var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
        //	numbers of pages
        for (var i = 1; i <= pagenum; ) {
          // for each page append pagination li
          $('.pagination #prev')
            .before(
              '<li style="padding:10px;" data-page="' +
                i +
                '">\
								  <span>' +
                i++ +
                '<span class="sr-only"></span></span>\
								</li>'
            )
            .show();
        } // end for i
      } // end if row count > max rows
      $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
      $('.pagination li').on('click', function(evt) {
        // on click each page
        evt.stopImmediatePropagation();
        evt.preventDefault();
        var pageNum = $(this).attr('data-page'); // get it's number

        var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

        if (pageNum == 'prev') {
          if (lastPage == 1) {
            return;
          }
          pageNum = --lastPage;
        }
        if (pageNum == 'next') {
          if (lastPage == $('.pagination li').length - 2) {
            return;
          }
          pageNum = ++lastPage;
        }

        lastPage = pageNum;
        var trIndex = 0; // reset tr counter
        $('.pagination li').removeClass('active'); // remove active class from all li
        $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
        // $(this).addClass('active');					// add active class to the clicked
	  	limitPagging();
        $(table + ' tr:gt(0)').each(function() {
          // each tr in table not the header
          trIndex++; // tr index counter
          // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
          if (
            trIndex > maxRows * pageNum ||
            trIndex <= maxRows * pageNum - maxRows
          ) {
            $(this).hide();
          } else {
            $(this).show();
          } //else fade in
        }); // end of for each tr in table
      }); // end of on click pagination list
	  limitPagging();
    })
    .val(100)
    .change();

  // end of on select change

  // END OF PAGINATION
}


function limitPagging(){

	if($('.pagination li').length > 7 ){
        
		if( $('.pagination li.active').attr('data-page') <= 3 ){
			$('.pagination li:gt(5)').hide();
			$('.pagination li:lt(5)').show();
			$('.pagination [data-page="next"]').show();
        }
        if ($('.pagination li.active').attr('data-page') > 3){
            
            $('.pagination li:gt(0)').hide();
            $('.pagination [data-page="next"]').show();
            for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
                $('.pagination [data-page="'+i+'"]').show();

            }

        }
    
	}
    else{
        if ($('.pagination li').length == 2){
            $('.pagination [data-page="prev"]').hide();
			$('.pagination [data-page="next"]').hide();
            $('#no-stock-divd').hide();
            $('#no-stock-divd2').hide();


        }
        else{
            $('.pagination [data-page="prev"]').show();
			$('.pagination [data-page="next"]').show();
            $('#no-stock-divd').hide();
            $('#no-stock-divd2').hide();



        }

    }


    $("#myDiv").hide();
    $('.form-popup-bg').hide();
    $("#submitBtn").hide();


    // Open div when "Open Bottom Div" button is clicked
    $("#openBtn").click(function() {
        $("#myDiv").slideDown();
    });

    // Close div when "Close" button inside the div is clicked
    $("#closeBtn").click(function() {
        $("#myDiv").slideUp();
    });

    
      //close popup when clicking x or off popup
    $('.close-button').on('click', function(event) {
        $('.form-popup-bg').hide();

    });
}



$('#click-stock').on('click', function() {
  $('#open-stock').show();
});

$(function() {
    var id = 0;
    $('#no-stock-divd').show();
    $('#no-stock-divd2').hide();
    $('table tr:eq(0)').prepend('<th> ID </th>');
    $('#table-id tr:gt(0)').each(function() {
        id++;
        $(this).prepend('<td>' + id + '</td>');
    });


   

});



$('#category_list').on('change', function() {

    var functionName_fetchtable = "Fetch_daily_details"
    var selectedValue = $(this).val();  // Get the selected value from the dropdown
    var selectedText = $(this).find('option:selected').text();  // Get the text of the selected option
    var formData = {
      "article_id": selectedValue
    };
    $.ajax({
        url: "../Api_files/fifteen_query.php?function=" + functionName_fetchtable,
        type: "POST",
        data: formData,
        dataType: "json",

        success: function(data) {
            var tableBody = $('#table-id tbody');
            tableBody.empty();  // Clear existing rows from the table body

            if (data && Array.isArray(data)) {
                console.log(data);
                if (data.length > 0) {

                    for (var i = 0; i < data.length; i++) {
                        var item = data[i];
                        var row = '<tr>';

                        // row += '<td><div class="widget-content p-0"><div class="widget-content-wrapper"><div class="widget-content-left mr-3"><div class="widget-content-left"><img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt=""></div></div><div class="widget-content-left flex2"><div class="widget-heading">'+(i+1)+'</div></div></div></div></td><td><div class="widget-content p-0"><div class="widget-content-wrapper"><div class="widget-content-left mr-3"><div class="widget-content-left"><img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt=""></div></div><div class="widget-content-left flex2"><div class="widget-heading">'+item['id']+'</div></div></div></div></td><td class="text-center">'+item['article_name']+'</td><td class="text-center"><i class="material-icons" style="font-size:30px;color:blue" id="btnOpenForm" onclick="editRow('+item['id']+')">edit</i><i class="material-icons" style="font-size:30px;color:red" onclick="delRow('+item['id']+')">delete</i></td>'; 

                        row += '<td>'+(i+1)+'</td><td>'+item['article_id']+'</td><td class="text-success"> '+item['article_name']+' <i class="mdi mdi-arrow-up"></i></td><td>'+item['High']+'</td><td>'+item['Open']+'</td><td>'+item['Low']+'</td><td>'+item['Date']+'</td><td>'+item['Close']+'</td><td><label class="badge badge-success"></label><button type="button" class="btn btn-outline-success btn-fw" style="margin:10px;">Edit</button><button type="button" class="btn btn-outline-danger btn-fw">Delete</button></td>';
                        row += '</tr>';
                        
                        tableBody.append(row);  // Append the row to the table

                        $('#no-stock-divd').hide();

                    }
                } 
                else{
                    $('#no-stock-divd').show();

                }
            }
            

        
        
        }
    }); 

}); 



function uploadfile(){
    event.preventDefault(); // Prevent default behavior
    formData = new FormData(document.getElementById('uploadForm'));
    var functionName_fetchtable = 'bulk_upload_details';
    var stock_text = $('#category_list option:selected').text();
    var stock_val = $('#category_list option:selected').val();
    formData.append('stock_text', stock_text);
    formData.append('stock_val', stock_val);

    if (stock_val !== "0" && stock_val !== 0) {
        $.ajax({
            url: "../Api_files/fifteen_query.php?function=" + functionName_fetchtable,
            type: "POST",
            data: formData,
            // dataType: "json",
            processData: false,
            contentType: false,
            success: function(response) {
                // var jsonResponse = JSON.parse(response);
                if (response.success == false) {
                    // Display the error message or handle accordingly
                    toastr.info("Error: " + response.message);

                } else {
                    toastr.info("Data successfully uploaded!");

                    // Handle successful response here
                }
            // Handle the response from the server
            
            }
        }); 
    }else{
        toastr.info("Select Any Stocks");

    }
    
}


$('#add-new-daily-details').on('click', function() {
    event.preventDefault(); // Prevent default behavior

    var stock_text = $('#category_list_2 option:selected').text();
    var stock_val = $('#category_list_2 option:selected').val();
    var open_val = $('#open-value').val();
    var date_val = $('#date-value').val();
    var high_val = $('#high-value').val();
    var low_val = $('#low-value').val();
    var close_val = $('#close-value').val();

    if (stock_text === "" || stock_val == 0) {
        toastr.info("Please check Stock value");
    }
    else if (date_val === "") {
        toastr.info("Please check Date value");
    }
    else if (open_val === "") {
        toastr.info("Please check Open value");
    }else if (high_val === "") {
        toastr.info("Please check High value");
    }else if (low_val === "") {
        toastr.info("Please check Low value");
    }else if (close_val === "") {
        toastr.info("Please check Close value");
    }else{

        var formData = {
            "stock_text": stock_text,
            "stock_val": stock_val,
            "open_val": open_val,
            "date_val": date_val,
            "high_val": high_val,
            "low_val": low_val,
            "close_val": close_val

        };
        var functionName_fetchtable = "add_new_entry"
        $.ajax({
        url: "../Api_files/fifteen_query.php?function=" + functionName_fetchtable,
        type: "POST",
        data: formData,
        dataType: "json",

            success: function(response) {
                // if( data == "Sucess"){
                //     toastr.info("New Reecord Created Successfully");
                //     setTimeout(function() {
                //         location.reload();
                //     }, 2000);
                // }
                if (response.success == false) {
                    // Display the error message or handle accordingly
                    toastr.info("Error: " + response.message);

                } else {
                    toastr.info("New Reecord Created Successfully");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);

                    // Handle successful response here
                }
                
                
            }
        }); 
    }
    
   
});

$('.button_del').on('click', function() {
    var stock_text = $('#category_list_3 option:selected').text();
    var stock_val = $('#category_list_3 option:selected').val();
    
    if (stock_text === "" || stock_val == 0) {
        toastr.info("Please check Stock value");
    }else{

        var formData = {
            "stock_text": stock_text,
            "stock_val": stock_val
        };
        var functionName_fetchtable = "delete_details_trunc"
        $.ajax({
        url: "../Api_files/fifteen_query.php?function=" + functionName_fetchtable,
        type: "POST",
        data: formData,
        dataType: "json",

            success: function(response) {
                toastr.info(response.message);
                
                
            }
        }); 
    }
    
   
});

</script>