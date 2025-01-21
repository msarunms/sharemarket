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
                                                                <h4 class="card-title" style="margin: 5px;">' . htmlspecialchars($item['article_name']) . '</h4>
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
                                                                                    <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                <input class="typeahead" type="text" placeholder="0.00" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" readonly>
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
                                                                                                <input class="typeahead" type="text" placeholder="0.00" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00" readonly>
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
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Hourly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Daily</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Weekly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Monthly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Hourly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Daily</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Weekly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label>Monthly</label>
                                                                                            <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
                                                                                            </div>                  
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <p class="mb-2">SCALPING CALL</p>
                                                                                <div id="bloodhound">
                                                                                                <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #cbc9c9;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #cbc9c9;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #f3cdeb;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #f3cdeb;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #fdecb0;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #fdecb0;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #7bc7eb;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #7bc7eb;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #f1ab89;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
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
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                        </div>

                                                                                    <div class="card">
                                                                                        <div class="card-body" style="background: #f1ab89;">
                                                                                        <div class="form-group row">
                                                                                        
                                                                                            <div class="col-md-3">
                                                                                                
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                  
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
                                                                                                        </div>                     
                                                                                            </div>
                                                                                            <div class="col">
                                                                                               
                                                                                            <div id="bloodhound">
                                                                                                            <input class="typeahead" type="text" placeholder="0.00">
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
    document.querySelectorAll('.plus-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            document.getElementById(`plus_icon${id}`).style.display = 'none';
            document.getElementById(`minus_icon${id}`).style.display = 'block';
            document.getElementById(`details_${id}`).style.display = 'block';
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
