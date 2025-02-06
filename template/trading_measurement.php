<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: register.php");
    exit;
}
// If authenticated, display the page content
// echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
?>
<?php include '../Common_header/header.php'; ?>
    <!-- partial -->
					
               
                    <style>
                        .card_value {
            position: relative;
            background: linear-gradient(135deg, #a8ff78, #78ffd6);
            border-radius: 15px;
            padding: 20px;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            color: #333;
        }
        .card_value_2 {
            position: relative;
            background: linear-gradient(135deg, #a8ff78, #78ffd6);
            border-radius: 15px;
            padding: 20px;
            width: 100%;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            color: #333;
        }
        
        /* Decorative Shapes */
        .decorative-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.2;
            z-index: 0;
        }

        .shape-1 {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            top: -30px;
            left: -30px;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #fbc2eb, #a18cd1);
            bottom: -50px;
            right: -50px;
        }

        

        @media screen and (max-width: 768px) {
            .card-header {
                font-size: 20px;
            }

            .card-subtitle {
                font-size: 14px;
            }
        }
                        </style>
                            
                            <div class="row">
                            

                                <div class="col-md-12 grid-margin stretch-card">
                                    
                                    <div class="card">
                                    <div class="decorative-shape shape-1"></div>
                                    <div class="decorative-shape shape-2"></div>
                                        <div class="card-body">
                                        
                                        <?php
                                            $functionName = 'fetchData_stocks';
                                            $url = 'http://localhost/Share_Market/Api_files/query_file.php?function=fetchData_stocks';
                                            $jsonData = file_get_contents($url);

                                            $dataArray = json_decode($jsonData, true);

                                            if (is_array($dataArray) && !empty($dataArray)) {
                                                foreach ($dataArray as $item) {
                                                    echo '<div class="template-demo">
                                                        <div class="form-group row" id="item_' . htmlspecialchars($item['id']) . '">
                                                            <div class="col-md-1" style="width:4%;" id="plus_icon' . htmlspecialchars($item['id']) . '">
                                                                <button type="button" class="btn btn-primary btn-rounded btn-icon plus-btn" data-id="' . htmlspecialchars($item['id']) . '">
                                                                    <i class="mdi mdi-plus-circle"></i>
                                                                </button>
                                                            </div>
                                                            <div class="col-md-1" style="width:4%; display:none;" id="minus_icon' . htmlspecialchars($item['id']) . '">
                                                                <button type="button" class="btn btn-primary btn-rounded btn-icon minus-btn" data-id="' . htmlspecialchars($item['id']) . '">
                                                                    <i class="mdi mdi-minus-circle"></i>
                                                                </button>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h4 class="card-title" style="margin: 5px;" data-article="' . htmlspecialchars($item['article_name']) . '">' . htmlspecialchars($item['article_name']) . '</h4>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row details" id="details_' . htmlspecialchars($item['id']) . '" style="display:none;">
                                                            <div class="col-md-12">
                                                                
                                                                
                                                                <div class="row">

                                                                    <h4 class="card-title">Open Value</h4>
                                                                    <div class="template-demo">
                                                                        <div class="form-group row">
                                                                            <div class="col">
                                                                                <div id="the-basics">
                                                                                    <input class="typeahead" type="text" placeholder="0.00" id="open_main_value' . htmlspecialchars($item['id']) . '">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    
                                                                    <div class="col-md-3 grid-margin stretch-card">
                                                                        <div class="card card_value">
                                                                                <div class="decorative-shape shape-1"></div>
                                                                                <div class="decorative-shape shape-2"></div>
                                                                            <div class="card-body" style="background:#b3c4eb">
                                                                                <h4 class="card-title">Down Trend Means</h4>
                                                                    
                                                                                <div class="template-demo">
                                                                                    <div class="form-group row">
                                                                                        <div class="col">
                                                                                            <div id="the-basics">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" readonly id = "down_trend_means_one' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" readonly id = "down_trend_means__two' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 grid-margin stretch-card">
                                                                        <div class="card card_value">
                                                                                <div class="decorative-shape shape-1"></div>
                                                                                <div class="decorative-shape shape-2"></div>
                                                                            <div class="card-body" style="background:#b3c4eb">
                                                                                <h4 class="card-title">Put Strike Price</h4>
                                                                                
                                                                                <div class="template-demo">
                                                                                    <div class="form-group row">
                                                                                        <div class="col">
                                                                                            <div id="the-basics">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" readonly id = "put_trend_means_one' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" readonly id = "put_trend_means_two' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3 grid-margin stretch-card">
                                                                        <div class="card card_value">
                                                                                <div class="decorative-shape shape-1"></div>
                                                                                <div class="decorative-shape shape-2"></div>
                                                                            <div class="card-body" style="background:#f3c8c6">
                                                                                <h4 class="card-title">Up Trend Means</h4>
                                                                    
                                                                                <div class="template-demo">
                                                                                    <div class="form-group row">
                                                                                        <div class="col">
                                                                                            <div id="the-basics">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "up_trend_means_one' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "up_trend_means_two' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                    <div class="col-md-3 grid-margin stretch-card">
                                                                        <div class="card card_value">
                                                                                <div class="decorative-shape shape-1"></div>
                                                                                <div class="decorative-shape shape-2"></div>
                                                                            <div class="card-body" style="background:#f3c8c6">
                                                                                <h4 class="card-title">Call Strike Price</h4>
                                                                                
                                                                                <div class="template-demo">
                                                                                    <div class="form-group row">
                                                                                        <div class="col">
                                                                                            <div id="the-basics">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "put_up_trend_means_one' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "put_up_trend_means_two' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    
                                                                </div>


                                                                <div class="row">

                                                                    <div class="col-md-6 grid-margin stretch-card">
                                                                        <div class="card card_value">
                                                                                <div class="decorative-shape shape-1"></div>
                                                                                <div class="decorative-shape shape-2"></div>
                                                                            <div class="card-body" style="background:#b3c4eb">
                                                                                <h4 class="card-title">UP TREND</h4>
                                                                                <p class="card-title">Confirm Market  <code class="card-title">Low with Target 1</code></p>
                                                                                <div class="template-demo">
                                                                                    <div class="form-group row">
                                                                                        <div class="col">
                                                                                            <label >15 Min</label>
                                                                                            <div id="the-basics">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "fifteen_final' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Hourly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "hourly_final' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Daily</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "daily_final' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Weekly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "weekly_final' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Monthly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "monthly_final' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 grid-margin stretch-card">
                                                                        <div class="card card_value">
                                                                                <div class="decorative-shape shape-1"></div>
                                                                                <div class="decorative-shape shape-2"></div>
                                                                            <div class="card-body" style="background:#f3c8c6">
                                                                                <h4 class="card-title">DOWN TREND</h4>
                                                                                <p class="card-title">Confirm Market  <code class="card-title">High with Target 1</code></p>
                                                                                <div class="template-demo">
                                                                                    <div class="form-group row">
                                                                                        <div class="col">
                                                                                            <label>15 Min</label>
                                                                                            <div id="the-basics">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "put_fifteen_final' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Hourly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "put_hourly_final' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Daily</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "put_daily_final' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Weekly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "put_weekly_final' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Monthly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id = "put_monthly_final' . htmlspecialchars($item['id']) . '">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                
                                                                                                                                                                                    <div class="row">
                                                                    <div class="col-md-12 grid-margin stretch-card">
                                                                    <div class="card card_value" style="background-color:#e5e3d4">
                                                                                <div class="decorative-shape shape-1"></div>
                                                                                <div class="decorative-shape shape-2"></div>
                                                                       
                                                                            <div class="card-body">
                                                                            <div class="form-group row">
                                                                               
                                                                                <div class="col-md-6">
                                                                                    <p class="mb-2">SCALPING PUT</p>
                                                                                <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id="scalping_put' . htmlspecialchars($item['id']) . '">
                                                                                            </div>                  
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <p class="mb-2">SCALPING CALL</p>
                                                                                <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" id="scalping_call' . htmlspecialchars($item['id']) . '">
                                                                                            </div>                     
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                </div>

                                                                


                                                                <div class="form-group row">
                                                                    <div class="col">
                                                                    <p class="mb-2">Show Details</p>
                                                                    <label class="toggle-switch">
                                                                          <input 
                                                                            type="checkbox" 
                                                                            id="toggleSwitch' . htmlspecialchars($item['id']) . '" 
                                                                            onchange="toggleDiv(this, \'detailsDiv' . htmlspecialchars($item['id']) . '\')" 
                                                                            checked
                                                                        >

                                                                        <span class="toggle-slider round"></span>
                                                                    </label>                      
                                                                    </div>
                                                                    
                                                                </div>
                                                                    

                                                                <div class="row" id="detailsDiv' . htmlspecialchars($item['id']) . '">
                                                                    <div class="col-md-12">
                                                                         <div class="card card_value_2" style="">
                                                                                <div class="decorative-shape shape-1"></div>
                                                                                <div class="decorative-shape shape-2"></div>
                                                                       
                                                                            <div class="card-body">
                                                                                                                                                                                                           
                                                                                                                                                                                                           <div class="col-md-12"       style="margin:7px;margin: 7px;
    color: green;
    font-weight: 700;
    font-size: 23px;text-align: center;background-color: #cbc9c9;">Daily Details</div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">

                                                                                                                                                                                                                                                                                                    <div class="col-md-6" style="margin:7px;margin: 7px;
                                                                                                color: green;
                                                                                                font-weight: 700;
                                                                                                font-size: 18px;padding: 10px;
    background: #cbc9c9;">
                                                                                                                                                                                                                                                                                                                                      Call Targets

                                                                                            <div id="bloodhound" style="    padding: 9px 0px 0px 0px;">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="daily_call_target_' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #cbc9c9;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="daily_call_target_one' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="daily_call_target_two' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="daily_call_target_three' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="daily_call_target_four' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">

                                                                                                                                                                                                                                                                                                    <div class="col-md-6" style="margin:7px;margin: 7px;
                                                                                                color: red;
                                                                                                font-weight: 700;
                                                                                                font-size: 18px;padding: 10px;
    background: #cbc9c9;">
                                                                                                                                                                                                                                                                                                                                      Put Targets

                                                                                            <div id="bloodhound" style="    padding: 9px 0px 0px 0px;">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="daily_call_tarput_' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #cbc9c9;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="daily_call_tarput_one' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="daily_call_tarput_two' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="daily_call_tarput_three' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="daily_call_tarput_four' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </div>


                                                                            <div class="card-body">
                                                                                                                                                                                                           
                                                                                                                                                                                                           <div class="col-md-12"       style="margin:7px;margin: 7px;
    color: green;
    font-weight: 700;
    font-size: 23px;text-align: center;background-color: #f3cdeb;">Weekly Details</div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">

                                                                                                                                                                                                                                                                                                    <div class="col-md-6" style="margin:7px;margin: 7px;
                                                                                                color: green;
                                                                                                font-weight: 700;
                                                                                                font-size: 18px;padding: 10px;
    background: #f3cdeb;">
                                                                                                                                                                                                                                                                                                                                      Call Targets

                                                                                            <div id="bloodhound" style="    padding: 9px 0px 0px 0px;">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="weekly_call_target_' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #f3cdeb;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="weekly_call_target_one' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="weekly_call_target_two' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="weekly_call_target_three' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="weekly_call_target_four' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">

                                                                                                                                                                                                                                                                                                    <div class="col-md-6" style="margin:7px;margin: 7px;
                                                                                                color: red;
                                                                                                font-weight: 700;
                                                                                                font-size: 18px;padding: 10px;
    background: #f3cdeb;">
                                                                                                                                                                                                                                                                                                                                      Put Targets

                                                                                            <div id="bloodhound" style="    padding: 9px 0px 0px 0px;">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="weekly_call_tarput_' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #f3cdeb;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="weekly_call_tarput_one' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="weekly_call_tarput_two' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="weekly_call_tarput_three' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="weekly_call_tarput_four' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </div>



                                                                            <div class="card-body">
                                                                                                                                                                                                           
                                                                                                                                                                                                           <div class="col-md-12"       style="margin:7px;margin: 7px;
    color: green;
    font-weight: 700;
    font-size: 23px;text-align: center;background-color: #fdecb0;">Monthly Details</div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">

                                                                                                                                                                                                                                                                                                    <div class="col-md-6" style="margin:7px;margin: 7px;
                                                                                                color: green;
                                                                                                font-weight: 700;
                                                                                                font-size: 18px;padding: 10px;
    background: #fdecb0;">
                                                                                                                                                                                                                                                                                                                                      Call Targets

                                                                                            <div id="bloodhound" style="    padding: 9px 0px 0px 0px;">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="monthly_call_target_' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #fdecb0;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="monthly_call_target_one' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="monthly_call_target_two' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="monthly_call_target_three' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="monthly_call_target_four' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">

                                                                                                                                                                                                                                                                                                    <div class="col-md-6" style="margin:7px;margin: 7px;
                                                                                                color: red;
                                                                                                font-weight: 700;
                                                                                                font-size: 18px;padding: 10px;
    background: #fdecb0;">
                                                                                                                                                                                                                                                                                                                                      Put Targets

                                                                                            <div id="bloodhound" style="    padding: 9px 0px 0px 0px;">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="monthly_call_tarput_' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #fdecb0;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="monthly_call_tarput_one' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="monthly_call_tarput_two' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="monthly_call_tarput_three' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="monthly_call_tarput_four' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </div>





                                                                            <div class="card-body">
                                                                                                                                                                                                           
                                                                                                                                                                                                           <div class="col-md-12"       style="margin:7px;margin: 7px;
    color: green;
    font-weight: 700;
    font-size: 23px;text-align: center;background-color: #7bc7eb;">Hourly Details</div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">

                                                                                                                                                                                                                                                                                                    <div class="col-md-6" style="margin:7px;margin: 7px;
                                                                                                color: green;
                                                                                                font-weight: 700;
                                                                                                font-size: 18px;padding: 10px;
    background: #7bc7eb;">
                                                                                                                                                                                                                                                                                                                                      Call Targets

                                                                                            <div id="bloodhound" style="    padding: 9px 0px 0px 0px;">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="hourly_call_target_' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #7bc7eb;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="hourly_call_target_one' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="hourly_call_target_two' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="hourly_call_target_three' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="hourly_call_target_four' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">

                                                                                                                                                                                                                                                                                                    <div class="col-md-6" style="margin:7px;margin: 7px;
                                                                                                color: red;
                                                                                                font-weight: 700;
                                                                                                font-size: 18px;padding: 10px;
    background: #7bc7eb;">
                                                                                                                                                                                                                                                                                                                                      Put Targets

                                                                                            <div id="bloodhound" style="    padding: 9px 0px 0px 0px;">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="hourly_call_tarput_' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #7bc7eb;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="hourly_call_tarput_one' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="hourly_call_tarput_two' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="hourly_call_tarput_three' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="hourly_call_tarput_four' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </div>


                                                                            <div class="card-body">
                                                                                                                                                                                                           
                                                                                                                                                                                                           <div class="col-md-12"       style="margin:7px;margin: 7px;
    color: green;
    font-weight: 700;
    font-size: 23px;text-align: center;background-color: #f1ab89;">15 Min Details</div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">

                                                                                                                                                                                                                                                                                                    <div class="col-md-6" style="margin:7px;margin: 7px;
                                                                                                color: green;
                                                                                                font-weight: 700;
                                                                                                font-size: 18px;padding: 10px;
    background: #f1ab89;">
                                                                                                                                                                                                                                                                                                                                      Call Targets

                                                                                            <div id="bloodhound" style="    padding: 9px 0px 0px 0px;">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="fifteen_call_target_' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #f1ab89;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="fifteen_call_target_one' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="fifteen_call_target_two' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="fifteen_call_target_three' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="fifteen_call_target_four' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">

                                                                                                                                                                                                                                                                                                    <div class="col-md-6" style="margin:7px;margin: 7px;
                                                                                                color: red;
                                                                                                font-weight: 700;
                                                                                                font-size: 18px;padding: 10px;
    background: #f1ab89;">
                                                                                                                                                                                                                                                                                                                                      Put Targets

                                                                                            <div id="bloodhound" style="    padding: 9px 0px 0px 0px;">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="fifteen_call_tarput_' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #f1ab89;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="fifteen_call_tarput_one' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="fifteen_call_tarput_two' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="fifteen_call_tarput_three' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00" id ="fifteen_call_tarput_four' . htmlspecialchars($item['id']) . '">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </div>




                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }
                                            } else {
                                                echo "No data available.";
                                            }
                                            ?>


                                            
                                            

                                            
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

function toggleDiv(checkbox, targetDivId) {
    const targetDiv = document.getElementById(targetDivId);
    if (checkbox.checked) {
        targetDiv.style.display = "block"; // Show the div
    } else {
        targetDiv.style.display = "none"; // Hide the div
    }
}


document.addEventListener("DOMContentLoaded", function () {
    // Add event listener to all plus buttons
    let array = [];
    let third_large_array = [];
    document.querySelectorAll('.plus-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');

            document.getElementById(`plus_icon${id}`).style.display = 'none';
            document.getElementById(`minus_icon${id}`).style.display = 'block';
            document.getElementById(`details_${id}`).style.display = 'block';

            $(`#open_main_value${id}`).on('keyup', function() {
                var open_main_value = $(`#open_main_value${id}`).val();
                var formData = {
                    "low_support": open_main_value,
                    "up_support": open_main_value,
                    "stock_val": id,
                };
                var functionName_fetchtable = "fetch_trade_daily"
                $.ajax({
                url: "../Api_files/trade_data.php?function=" + functionName_fetchtable,
                type: "POST",
                data: formData,
                dataType: "json",
                    success: function(data) {
                        

                        for (const key in data) {
                            $(`#daily_call_target_${id}`).val(open_main_value);
                            $(`#daily_call_target_one${id}`).val(data['Targett_CE_2']);
                            $(`#daily_call_target_two${id}`).val(data['Targett_CE_4']);
                            $(`#daily_call_target_three${id}`).val(data['Targett_CE_1']);
                            array.push(data['Targett_CE_1']); // Append the value
                            
                            $(`#daily_final${id}`).val(data['Targett_CE_1']);
                            $(`#daily_call_target_four${id}`).val(data['Targett_CE_3']);
                            $(`#daily_call_tarput_${id}`).val(open_main_value);
                            $(`#daily_call_tarput_one${id}`).val(data['Targett_CE_5']);
                            $(`#daily_call_tarput_two${id}`).val(data['Targett_CE_8']);
                            $(`#daily_call_tarput_three${id}`).val(data['Targett_CE_7']);
                            third_large_array.push(data['Targett_CE_7']); // Append the value
                            $(`#put_daily_final${id}`).val(data['Targett_CE_7']);
                            $(`#daily_call_tarput_four${id}`).val(data['Targett_CE_6']);


                            $(`#weekly_call_target_${id}`).val(open_main_value);
                            $(`#weekly_call_target_one${id}`).val(data['Targett_WEEK_1']);
                            $(`#weekly_call_target_two${id}`).val(data['Targett_WEEK_2']);
                            $(`#weekly_call_target_three${id}`).val(data['Targett_WEEK_4']);
                            array.push(data['Targett_WEEK_4']); // Append the value
                            $(`#weekly_final${id}`).val(data['Targett_WEEK_4']);
                            $(`#weekly_call_target_four${id}`).val(data['Targett_WEEK_3']);
                            $(`#weekly_call_tarput_${id}`).val(open_main_value);
                            $(`#weekly_call_tarput_one${id}`).val(data['Targett_WEEK_5']);
                            $(`#weekly_call_tarput_two${id}`).val(data['Targett_WEEK_8']);
                            $(`#weekly_call_tarput_three${id}`).val(data['Targett_WEEK_6']);
                            third_large_array.push(data['Targett_WEEK_6']); // Append the value
                            $(`#put_weekly_final${id}`).val(data['Targett_WEEK_6']);
                            $(`#weekly_call_tarput_four${id}`).val(data['Targett_WEEK_7']);


                            $(`#monthly_call_target_${id}`).val(open_main_value);
                            $(`#monthly_call_target_one${id}`).val(data['Targett_Month_1']);
                            $(`#monthly_call_target_two${id}`).val(data['Targett_Month_4']);
                            $(`#monthly_call_target_three${id}`).val(data['Targett_Month_2']);
                            array.push(data['Targett_Month_2']); // Append the value
                            $(`#monthly_final${id}`).val(data['Targett_Month_2']);
                            $(`#monthly_call_target_four${id}`).val(data['Targett_Month_3']);
                            $(`#monthly_call_tarput_${id}`).val(open_main_value);
                            $(`#monthly_call_tarput_one${id}`).val(data['Targett_Month_5']);
                            $(`#monthly_call_tarput_two${id}`).val(data['Targett_Month_6']);
                            $(`#monthly_call_tarput_three${id}`).val(data['Targett_Month_8']);
                            third_large_array.push(data['Targett_Month_8']); // Append the value
                            $(`#put_monthly_final${id}`).val(data['Targett_Month_8']);
                            $(`#monthly_call_tarput_four${id}`).val(data['Targett_Month_7']);


                            $(`#hourly_call_target_${id}`).val(open_main_value);
                            $(`#hourly_call_target_one${id}`).val(data['Targett_HOUR_1']);
                            $(`#hourly_call_target_two${id}`).val(data['Targett_HOUR_4']);
                            $(`#hourly_call_target_three${id}`).val(data['Targett_HOUR_3']);
                            array.push(data['Targett_HOUR_3']); // Append the value
                            $(`#hourly_final${id}`).val(data['Targett_HOUR_3']);
                            $(`#hourly_call_target_four${id}`).val(data['Targett_HOUR_2']);
                            $(`#hourly_call_tarput_${id}`).val(open_main_value);
                            $(`#hourly_call_tarput_one${id}`).val(data['Targett_HOUR_5']);
                            $(`#hourly_call_tarput_two${id}`).val(data['Targett_HOUR_6']);
                            $(`#hourly_call_tarput_three${id}`).val(data['Targett_HOUR_8']);
                            third_large_array.push(data['Targett_HOUR_8']); // Append the value
                            $(`#put_hourly_final${id}`).val(data['Targett_HOUR_8']);
                            $(`#hourly_call_tarput_four${id}`).val(data['Targett_HOUR_7']);


                            $(`#fifteen_call_target_${id}`).val(open_main_value);
                            $(`#fifteen_call_target_one${id}`).val(data['Targett_FIF_2']);
                            $(`#fifteen_call_target_two${id}`).val(data['Targett_FIF_1']);
                            $(`#fifteen_call_target_three${id}`).val(data['Targett_FIF_4']);
                            array.push(data['Targett_FIF_4']); // Append the value
                            $(`#fifteen_final${id}`).val(data['Targett_FIF_4']);
                            $(`#fifteen_call_target_four${id}`).val(data['Targett_FIF_3']);
                            $(`#fifteen_call_tarput_${id}`).val(open_main_value);
                            $(`#fifteen_call_tarput_one${id}`).val(data['Targett_FIF_5']);
                            $(`#fifteen_call_tarput_two${id}`).val(data['Targett_FIF_6']);
                            $(`#fifteen_call_tarput_three${id}`).val(data['Targett_FIF_8']);
                            third_large_array.push(data['Targett_FIF_8']); // Append the value
                            $(`#put_fifteen_final${id}`).val(data['Targett_FIF_8']);
                            $(`#fifteen_call_tarput_four${id}`).val(data['Targett_FIF_7']);

                        }  
                        
                        var firstFiveValues_arr = third_large_array.slice(0, 5);
                        var firstFiveValues = array.slice(0, 5);

                        
                        let C7 = open_main_value; // C7 as a string
                        let numberArray = firstFiveValues.map(value => parseFloat(value));
                        let C7Number = parseFloat(C7);
                        let countLess = numberArray.filter(value => value < C7Number).length;
                        numberArray.sort((a, b) => a - b);
                        let result = numberArray[countLess];
                        $(`#down_trend_means_one${id}`).val(result);
                        
                        let num = parseFloat(result); // Convert string to number
                        let roundedValue = Math.ceil(num / 100) * 100; // Round up
                        $(`#put_trend_means_one${id}`).val(roundedValue);

                        
                        let numberArray_val = firstFiveValues_arr.map(Number);
                        numberArray_val.sort((a, b) => b - a);
                        if (numberArray_val.length >= 3) {
                            let thirdHighest = numberArray_val[2]; // Third largest is at index 2
                            $(`#down_trend_means__two${id}`).val(thirdHighest);
                            let num1 = parseFloat(thirdHighest); // Convert string to number
                            let roundedValue1 = Math.ceil(num1 / 100) * 100; // Round up
                            $(`#put_trend_means_two${id}`).val(roundedValue1);

                        } else {
                            $(`#down_trend_means__two${id}`).val("0");
                        }



                        let numberArray_val_put = firstFiveValues.map(Number);
                        numberArray_val_put.sort((a, b) => b - a);
                        if (numberArray_val_put.length >= 3) {
                            let thirdHighest_put = numberArray_val_put[2]; // Third largest is at index 2
                            $(`#up_trend_means_one${id}`).val(thirdHighest_put);
                            let num1 = parseFloat(thirdHighest_put); // Convert string to number
                            let roundedValue2 = Math.floor(num1 / 100) * 100; // Round up
                            $(`#put_up_trend_means_one${id}`).val(roundedValue2);

                        } else {
                            $(`#up_trend_means_one${id}`).val("0");
                        }


                        

                        // Value of M7 (the reference value)
                        let M7 = (open_main_value);

                        // Step 1: Filter values greater than M7
                        let greaterValues = firstFiveValues_arr.filter(value => value > M7);

                        // Step 2: Calculate rank (number of values greater than M7)
                        let rank = greaterValues.length + 1;

                        // Step 3: Sort the array in descending order
                        let sortedArray = firstFiveValues_arr.slice().sort((a, b) => b - a);

                        // Step 4: Get the value at the calculated rank
                        let result1 = sortedArray[rank - 1];

                        $(`#up_trend_means_two${id}`).val(result1);
                        
                        let num1 = parseFloat(result1); // Convert string to number
                        let roundedValue1 = Math.floor(num1 / 100) * 100; // Round up
                        $(`#put_up_trend_means_two${id}`).val(roundedValue1);



                        // Convert strings to numbers and sort the array in descending order
                        var sortedArr = firstFiveValues.map(function(num) {
                            return parseFloat(num);
                        }).sort(function(a, b) {
                            return b - a; // Sort in descending order
                        });
                        $(`#scalping_put${id}`).val(sortedArr[1]);
                        


                         // Count the number of zeros in the array
                        var countZeros = firstFiveValues_arr.filter(function(value) {
                            return value === 0;
                        }).length;
                        var position = countZeros + 2;
                        var sortedValues = firstFiveValues_arr.slice().sort(function(a, b) {
                            return a - b; // Sorting in ascending order
                        });
                        var nthSmallest = sortedValues[position - 1]; // Array index starts from 0, so subtract 1
                        
                        $(`#scalping_call${id}`).val(nthSmallest);

                    }
                }); 

               


            });

        });
    });

    // Add event listener to all minus buttons
    document.querySelectorAll('.minus-btn').forEach(button => {
        button.addEventListener('click', function () {
            
            const id = this.getAttribute('data-id');
            document.getElementById(`plus_icon${id}`).style.display = 'block';
            document.getElementById(`minus_icon${id}`).style.display = 'none';
            document.getElementById(`details_${id}`).style.display = 'none';
        });
    });
});

</script>

