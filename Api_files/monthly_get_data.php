<?php
include '../Config/config.php';


function fetchData_product() {
    $conn = db_connect();
    $getcategories = "SELECT*FROM articles_details";
    $resultscategory = $conn->query($getcategories);
    $data = array();
    if ($resultscategory->num_rows > 0) {            
        while($row = $resultscategory->fetch_assoc()) {
            $data[] = $row;
        }
    } 
    return $data;
}

function fetch_stocks() {
    $conn = db_connect();
    $stock_id = $_POST['article_id'];
    $getcategories = "SELECT * FROM monthly_details WHERE article_id = ".$stock_id." ORDER BY Date DESC";
    $resultscategory = $conn->query($getcategories);
    $data = array();
    if ($resultscategory->num_rows > 0) {            
        while($row = $resultscategory->fetch_assoc()) {
            $data[] = $row;
        }
    } 
    return $data;

}

function add_daily_details() {
    $conn = db_connect();
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];
    $open_val = $_POST['open_val'];
    $date_val = $_POST['date_val'];
    $high_val = $_POST['high_val'];
    $low_val = $_POST['low_val'];
    $close_val = $_POST['close_val'];

    // $getcategories = "INSERT INTO monthly_details (article_name, article_id,Open, High, Low, Close, Date) VALUES ('".$stock_text."', '".$stock_val."','".$open_val."','".$high_val."','".$low_val."','".$close_val."','".$date_val."')";


    // if (mysqli_query($conn, $getcategories)) {
        $check_query = "SELECT * FROM monthly_details WHERE article_name = '$stock_text' AND article_id = '$stock_val' AND Date = '$date_val'";

        $check_result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_result) == 0) {
            // Insert only if no duplicate is found
            $query = "INSERT INTO monthly_details (article_name, article_id, Date, Open, High, Low, Close) 
            VALUES (
                '$stock_text',
                '$stock_val',
                '$date_val',
                '".(isset($open_val) ? $open_val : "")."',
                '".(isset($high_val) ? $high_val : "")."',
                '".(isset($low_val) ? $low_val : "")."',
                '".(isset($close_val) ? $close_val : "")."'
            )";


            if (!mysqli_query($conn, $query)) {
                $response['success'] = false;
                $response['message'] = 'Failed to insert row';
            }else {
                $last_inserted_id = mysqli_insert_id($conn);

                if (isset($open_val)) {
                    $open_val_main = floatval($open_val);
                } else {
                    $open_val_main = 0.00;
                }
                if (isset($high_val)) {
                    $high_val_main = floatval($high_val);
                } else {
                    $high_val_main = 0.00;
                }
                if (isset($low_val)) {
                    $low_val_main = floatval($low_val);
                } else {
                    $low_val_main = 0.00;
                }
                if (isset($close_val)) {
                    $close_val_main = floatval($close_val);
                } else {
                    $close_val_main = 0.00;
                }
                $date = $date_val;
                $open = floatval($open_val_main);
                $high = floatval($high_val_main);
                $low = floatval($low_val_main);
                $close = floatval($close_val_main);
                
                // Step 1: Calculate the three initial values
                $high_low = floatval($high - $low);
                $high_close = floatval($high - $close);
                $close_low = floatval($close - $low);
                
                $up_down = ($high_close > $close_low) ? "UP" : "DOWN";

                // Order values as specified
                // Determine which value is the lowest, second highest, and highest
                if ($close_low <= $high_close && $close_low <= $high_low) {
                    $first_value = $close_low; // Lowest value
                    if ($high_close <= $high_low) {
                        $second_value = $high_close;
                        $third_value = $high_low;
                    } else {
                        $second_value = $high_low;
                        $third_value = $high_close;
                    }
                } elseif ($high_close <= $close_low && $high_close <= $high_low) {
                    $first_value = $high_close; // Lowest value
                    if ($close_low <= $high_low) {
                        $second_value = $close_low;
                        $third_value = $high_low;
                    } else {
                        $second_value = $high_low;
                        $third_value = $close_low;
                    }
                } else {
                    $first_value = $high_low; // Lowest value
                    if ($close_low <= $high_close) {
                        $second_value = $close_low;
                        $third_value = $high_close;
                    } else {
                        $second_value = $high_close;
                        $third_value = $close_low;
                    }
                }
                
                // Level 1 Calculations
                $level1_low = floatval($low - $third_value);
                $level1_support = floatval($close - $third_value);
                $level1_high = floatval($high - $third_value);

                $calc_level1_supprot_high = floatval($level1_high - $level1_support);
                $calc_level1_supprot_low = floatval($level1_support - $level1_low);
                $calc_level1_up_down = ($calc_level1_supprot_low > $calc_level1_supprot_high) ? "DOWN" : "UP";

                // Level 2 Calculations
                $level2_low = floatval($low - $second_value);
                $level2_support = floatval($close - $second_value);
                $level2_high = floatval($high - $second_value);

                $calc_level2_supprot_high = floatval($level2_high - $level2_support);
                $calc_level2_supprot_low = floatval($level2_support - $level2_low);
                $calc_level2_up_down = ($calc_level2_supprot_low > $calc_level2_supprot_high) ? "DOWN" : "UP";


                // Level 3 Calculations
                $level3_low = floatval($low - $first_value);
                $level3_support = floatval($close - $first_value);
                $level3_high = floatval($high - $first_value);

                $calc_level3_supprot_high = floatval($level3_high - $level3_support);
                $calc_level3_supprot_low = floatval($level3_support - $level3_low);
                $calc_level3_up_down = ($calc_level3_supprot_low > $calc_level3_supprot_high) ? "DOWN" : "UP";



                // Level 1-1 Calculations
                $level1_1_low = floatval($low + $first_value);
                $level1_1_support = floatval($close + $first_value);
                $level1_1_high = floatval($high + $first_value);

                $calc_level1_1_supprot_high = floatval($level1_1_high - $level1_1_support);
                $calc_level1_1_supprot_low = floatval($level1_1_support - $level1_1_low);
                $calc_level1_1_up_down = ($calc_level1_1_supprot_low > $calc_level1_1_supprot_high) ? "DOWN" : "UP";


                // Level 2-1 Calculations
                $level2_1_low = floatval($low + $second_value);
                $level2_1_support = floatval($close + $second_value);
                $level2_1_high = floatval($high + $second_value);

                $calc_level2_1_supprot_high = floatval($level2_1_high - $level2_1_support);
                $calc_level2_1_supprot_low = floatval($level2_1_support - $level2_1_low);
                $calc_level2_1_up_down = ($calc_level2_1_supprot_low > $calc_level2_1_supprot_high) ? "DOWN" : "UP";



                // Level 3-1 Calculations
                $level3_1_low = floatval($low + $third_value);
                $level3_1_support = floatval($close + $third_value);
                $level3_1_high = floatval($high + $third_value);

                $calc_level3_1_supprot_high = floatval($level3_1_high - $level3_1_support);
                $calc_level3_1_supprot_low = floatval($level3_1_support - $level3_1_low);
                $calc_level3_1_up_down = ($calc_level3_1_supprot_low > $calc_level3_1_supprot_high) ? "DOWN" : "UP";

                
                $rows = [
                    // Example rows of data for 18 rows (populate with actual values)
                    [$stock_text, $stock_val,$level1_low, $level1_support, $level1_high, $calc_level1_supprot_high,$calc_level1_supprot_low,$calc_level1_up_down,$date_val,$last_inserted_id],
                    [$stock_text, $stock_val,$level2_low, $level2_support, $level2_high, $calc_level2_supprot_high,$calc_level2_supprot_low,$calc_level2_up_down,$date_val,$last_inserted_id],
                    [$stock_text, $stock_val,$level3_low, $level3_support, $level3_high, $calc_level3_supprot_high,$calc_level3_supprot_low,$calc_level3_up_down,$date_val,$last_inserted_id],
                    [$stock_text, $stock_val,$level1_1_low, $level1_1_support, $level1_1_high, $calc_level1_1_supprot_high,$calc_level1_1_supprot_low,$calc_level1_1_up_down,$date_val,$last_inserted_id],
                    [$stock_text, $stock_val,$level2_1_low, $level2_1_support, $level2_1_high, $calc_level2_1_supprot_high,$calc_level2_1_supprot_low,$calc_level2_1_up_down,$date_val,$last_inserted_id],
                    [$stock_text, $stock_val,$level3_1_low, $level3_1_support, $level3_1_high, $calc_level3_1_supprot_high,$calc_level3_1_supprot_low,$calc_level3_1_up_down,$date_val,$last_inserted_id]
                   
                ];
                
                $query = "INSERT INTO monthly_calculation (article_name, article_id, low,support,high,calc_first,calc_two,calc_trend,date,monthly_id) VALUES ";

                $valuesArr = [];
                foreach ($rows as $rowData) {
                    $article_name = $rowData[0];
                    $article_id = $rowData[1];
                    $level_one_in_low = isset($rowData[2]) ? $rowData[2] : "";
                    $level_one_in_support = isset($rowData[3]) ? $rowData[3] : "";
                    $level_one_in_high = isset($rowData[4]) ? $rowData[4] : "";
                    $level_one_in_supp_high = isset($rowData[5]) ? $rowData[5] : "";
                    $level_one_in_supp_low = isset($rowData[6]) ? $rowData[6] : "";
                    $level_one_in_up_down = isset($rowData[7]) ? $rowData[7] : "";
                    $date = $rowData[8];
                    $monthly_id = $rowData[9];

                    // Escape values to avoid SQL injection
                    $valuesArr[] = "('$article_name', '$article_id', '$level_one_in_low', '$level_one_in_support', '$level_one_in_high', '$level_one_in_supp_high', '$level_one_in_supp_low','$level_one_in_up_down','$date','$monthly_id')";
                }

                // Join all value sets with commas and append to the query
                $query .= implode(", ", $valuesArr);
                if (mysqli_query($conn, $query)) {
                    $response['success'] = true;
                    $response['message'] = 'Calculation Completed';
                }
                $response['success'] = true;
                $response['message'] = 'Data successfully inserted into the database.';
            }

        }else {
            $response['success'] = false;
            // Optional: Track skipped duplicates
            $response['message'] = 'Duplicate entry found and skipped for date ' . $date_val;
        }

        return $response;
    // }
    // else{
    //     return $response;
    // }
    

}
header('Content-Type: application/json');

function bulk_upload_details() {
    $conn = db_connect();
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];
    $fileTmpPath = $_FILES['fileInput']['tmp_name'];
    $zip = new ZipArchive();
    if ($zip->open($fileTmpPath) === TRUE) {
        $xmlString = $zip->getFromName('xl/worksheets/sheet1.xml');
        if ($xmlString !== false) {
            $xml = simplexml_load_string($xmlString);
            $namespaces = $xml->getNamespaces(true);
            $xml->registerXPathNamespace('s', $namespaces['']);
            $rowIndex = 0;

           
            foreach ($xml->sheetData->row as $row) {
                if ($rowIndex == 0) { $rowIndex++; continue; } // Skip header row
                $rowData = [];
                foreach ($row->c as $cell) {
                    if (isset($cell->v)) {
                        $rowData[] = (string)$cell->v;
                    } else {
                        $rowData[] = ""; // Empty cell
                    }
                }
                $excelStartDate = '1900-01-01';

                // Handle date conversion for rowData[0] (expected to be a date in Excel format)
                if (isset($rowData[0]) && is_numeric($rowData[0])) {
                    $timestamp = strtotime($excelStartDate) + ($rowData[0] - 2) * 86400;
                    $final_date_val = date("Y-m-d", $timestamp);
                } else {
                    $final_date_val = date("Y-m-d", strtotime($excelStartDate));
                }
                
                 // You can change this format to your preference
                
                 // Check for duplicates
                $check_query = "SELECT * FROM monthly_details WHERE article_name = '$stock_text' AND article_id = '$stock_val' AND Date = '$final_date_val'";
                $check_result = mysqli_query($conn, $check_query);
                

                //First calculate below three value:
                // $high_low = float($rowData[1])-float($rowData[2])
                
                if (mysqli_num_rows($check_result) == 0) {
                    
                    // Insert only if no duplicate is found
                    $query = "INSERT INTO monthly_details (article_name, article_id, Date, Open, High, Low, Close) 
                    VALUES (
                        '$stock_text',
                        '$stock_val',
                        '$final_date_val',
                        '".(isset($rowData[1]) ? $rowData[1] : "")."',
                        '".(isset($rowData[2]) ? $rowData[2] : "")."',
                        '".(isset($rowData[3]) ? $rowData[3] : "")."',
                        '".(isset($rowData[4]) ? $rowData[4] : "")."'
                    )";


                    if (!mysqli_query($conn, $query)) {
                        $response['success'] = false;
                        $response['message'] = 'Failed to insert row';
                    }else {
                        $last_inserted_id = mysqli_insert_id($conn);
                        if (isset($rowData[1])) {
                            $open_val_main = floatval($rowData[1]);
                        } else {
                            $open_val_main = 0.00;
                        }
                        if (isset($rowData[2])) {
                            $high_val_main = floatval($rowData[2]);
                        } else {
                            $high_val_main = 0.00;
                        }
                        if (isset($rowData[3])) {
                            $low_val_main = floatval($rowData[3]);
                        } else {
                            $low_val_main = 0.00;
                        }
                        if (isset($rowData[4])) {
                            $close_val_main = floatval($rowData[4]);
                        } else {
                            $close_val_main = 0.00;
                        }
                        $date = $final_date_val;
                        $open = floatval($open_val_main);
                        $high = floatval($high_val_main);
                        $low = floatval($low_val_main);
                        $close = floatval($close_val_main);
                        
                        // Step 1: Calculate the three initial values
                        $high_low = floatval($high - $low);
                        $high_close = floatval($high - $close);
                        $close_low = floatval($close - $low);
                        
                        $up_down = ($high_close > $close_low) ? "UP" : "DOWN";

                        // Order values as specified
                        // Determine which value is the lowest, second highest, and highest
                        if ($close_low <= $high_close && $close_low <= $high_low) {
                            $first_value = $close_low; // Lowest value
                            if ($high_close <= $high_low) {
                                $second_value = $high_close;
                                $third_value = $high_low;
                            } else {
                                $second_value = $high_low;
                                $third_value = $high_close;
                            }
                        } elseif ($high_close <= $close_low && $high_close <= $high_low) {
                            $first_value = $high_close; // Lowest value
                            if ($close_low <= $high_low) {
                                $second_value = $close_low;
                                $third_value = $high_low;
                            } else {
                                $second_value = $high_low;
                                $third_value = $close_low;
                            }
                        } else {
                            $first_value = $high_low; // Lowest value
                            if ($close_low <= $high_close) {
                                $second_value = $close_low;
                                $third_value = $high_close;
                            } else {
                                $second_value = $high_close;
                                $third_value = $close_low;
                            }
                        }
                        
                        // Level 1 Calculations
                        $level1_low = floatval($low - $third_value);
                        $level1_support = floatval($close - $third_value);
                        $level1_high = floatval($high - $third_value);

                        $calc_level1_supprot_high = floatval($level1_high - $level1_support);
                        $calc_level1_supprot_low = floatval($level1_support - $level1_low);
                        $calc_level1_up_down = ($calc_level1_supprot_low > $calc_level1_supprot_high) ? "DOWN" : "UP";

                        // Level 2 Calculations
                        $level2_low = floatval($low - $second_value);
                        $level2_support = floatval($close - $second_value);
                        $level2_high = floatval($high - $second_value);

                        $calc_level2_supprot_high = floatval($level2_high - $level2_support);
                        $calc_level2_supprot_low = floatval($level2_support - $level2_low);
                        $calc_level2_up_down = ($calc_level2_supprot_low > $calc_level2_supprot_high) ? "DOWN" : "UP";


                        // Level 3 Calculations
                        $level3_low = floatval($low - $first_value);
                        $level3_support = floatval($close - $first_value);
                        $level3_high = floatval($high - $first_value);

                        $calc_level3_supprot_high = floatval($level3_high - $level3_support);
                        $calc_level3_supprot_low = floatval($level3_support - $level3_low);
                        $calc_level3_up_down = ($calc_level3_supprot_low > $calc_level3_supprot_high) ? "DOWN" : "UP";



                        // Level 1-1 Calculations
                        $level1_1_low = floatval($low + $first_value);
                        $level1_1_support = floatval($close + $first_value);
                        $level1_1_high = floatval($high + $first_value);

                        $calc_level1_1_supprot_high = floatval($level1_1_high - $level1_1_support);
                        $calc_level1_1_supprot_low = floatval($level1_1_support - $level1_1_low);
                        $calc_level1_1_up_down = ($calc_level1_1_supprot_low > $calc_level1_1_supprot_high) ? "DOWN" : "UP";


                        // Level 2-1 Calculations
                        $level2_1_low = floatval($low + $second_value);
                        $level2_1_support = floatval($close + $second_value);
                        $level2_1_high = floatval($high + $second_value);

                        $calc_level2_1_supprot_high = floatval($level2_1_high - $level2_1_support);
                        $calc_level2_1_supprot_low = floatval($level2_1_support - $level2_1_low);
                        $calc_level2_1_up_down = ($calc_level2_1_supprot_low > $calc_level2_1_supprot_high) ? "DOWN" : "UP";



                        // Level 3-1 Calculations
                        $level3_1_low = floatval($low + $third_value);
                        $level3_1_support = floatval($close + $third_value);
                        $level3_1_high = floatval($high + $third_value);

                        $calc_level3_1_supprot_high = floatval($level3_1_high - $level3_1_support);
                        $calc_level3_1_supprot_low = floatval($level3_1_support - $level3_1_low);
                        $calc_level3_1_up_down = ($calc_level3_1_supprot_low > $calc_level3_1_supprot_high) ? "DOWN" : "UP";

                        
                        $rows = [
                            // Example rows of data for 18 rows (populate with actual values)
                            [$stock_text, $stock_val,$level1_low, $level1_support, $level1_high, $calc_level1_supprot_high,$calc_level1_supprot_low,$calc_level1_up_down,$final_date_val,$last_inserted_id],
                            [$stock_text, $stock_val,$level2_low, $level2_support, $level2_high, $calc_level2_supprot_high,$calc_level2_supprot_low,$calc_level2_up_down,$final_date_val,$last_inserted_id],
                            [$stock_text, $stock_val,$level3_low, $level3_support, $level3_high, $calc_level3_supprot_high,$calc_level3_supprot_low,$calc_level3_up_down,$final_date_val,$last_inserted_id],
                            [$stock_text, $stock_val,$level1_1_low, $level1_1_support, $level1_1_high, $calc_level1_1_supprot_high,$calc_level1_1_supprot_low,$calc_level1_1_up_down,$final_date_val,$last_inserted_id],
                            [$stock_text, $stock_val,$level2_1_low, $level2_1_support, $level2_1_high, $calc_level2_1_supprot_high,$calc_level2_1_supprot_low,$calc_level2_1_up_down,$final_date_val,$last_inserted_id],
                            [$stock_text, $stock_val,$level3_1_low, $level3_1_support, $level3_1_high, $calc_level3_1_supprot_high,$calc_level3_1_supprot_low,$calc_level3_1_up_down,$final_date_val,$last_inserted_id]
                           
                        ];
                        
                        $query = "INSERT INTO monthly_calculation (article_name, article_id, low,support,high,calc_first,calc_two,calc_trend,date,monthly_id) VALUES ";

                        $valuesArr = [];
                        foreach ($rows as $rowData) {
                            $article_name = $rowData[0];
                            $article_id = $rowData[1];
                            $level_one_in_low = isset($rowData[2]) ? $rowData[2] : "";
                            $level_one_in_support = isset($rowData[3]) ? $rowData[3] : "";
                            $level_one_in_high = isset($rowData[4]) ? $rowData[4] : "";
                            $level_one_in_supp_high = isset($rowData[5]) ? $rowData[5] : "";
                            $level_one_in_supp_low = isset($rowData[6]) ? $rowData[6] : "";
                            $level_one_in_up_down = isset($rowData[7]) ? $rowData[7] : "";
                            $date = $rowData[8];
                            $monthly_id = $rowData[9];
                            // Escape values to avoid SQL injection
                            $valuesArr[] = "('$article_name', '$article_id', '$level_one_in_low', '$level_one_in_support', '$level_one_in_high', '$level_one_in_supp_high', '$level_one_in_supp_low','$level_one_in_up_down','$date','$monthly_id')";
                        }

                        // Join all value sets with commas and append to the query
                        $query .= implode(", ", $valuesArr);
                        if (mysqli_query($conn, $query)) {
                            $response['success'] = true;
                            $response['message'] = 'Calculation Completed';
                        }
                        $response['success'] = true;
                        $response['message'] = 'Data successfully inserted into the database.';
                    }

                }else {
                    $response['success'] = false;
                    // Optional: Track skipped duplicates
                    $response['message'] = 'Duplicate entry found and skipped for date ' . $final_date_val;
                }

                $rowIndex++;
            }

            // $stmt->close();
            // $conn->close();

            

        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to read sheet data from the .xlsx file.';
        }

    }else {
        $response['success'] = false;
        $response['message'] = 'Failed to open .xlsx file (not a valid ZIP).';
    }
    return $response;

}

// function fetch_calc_details() {
//     $conn = db_connect();
//     $bottom_value = $_POST['bottom_value'];
//     $getcategories = "SELECT *
//                     FROM monthly_calculation";
    

//     $resultscategory = $conn->query($getcategories);
//     $data = array();
//     if ($resultscategory->num_rows > 0) {            
//         while($row = $resultscategory->fetch_assoc()) {
//             $data[] = $row;
//         }
//     } 

//     return $data;

// }
function fetch_calc_details() {
    // Get stock_text, stock_val, and other values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the bottom value from POST and ensure it is sanitized
    $bottom_value = isset($_POST['bottom_value']) ? (float) $_POST['bottom_value'] : 0;

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(low) AS low_value
                      FROM monthly_calculation
                      WHERE low < ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $bottom_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support, high, calc_trend, date
                                FROM monthly_calculation
                                WHERE low = ?
                                AND article_name = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("dss", $low_value, $stock_text, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $data['details'] = $row_2;
            }
            $stmt_2->close();
        }
    }

    // Close the statements
    $stmt->close();

    return $data;
}

function fetch_calc_details_up_support() {
    // Get stock_text, stock_val, and other values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the bottom value from POST and ensure it is sanitized
    $bottom_value = isset($_POST['bottom_value']) ? (float) $_POST['bottom_value'] : 0;

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(support) AS low_value
                      FROM monthly_calculation
                      WHERE support < ?
                      AND calc_trend = 'UP'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $bottom_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM monthly_calculation
                                WHERE support = ?
                                AND article_name = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("dss", $low_value, $stock_text, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $data['details'] = $row_2;
            }
            $stmt_2->close();
        }
    }

    // Close the statements
    $stmt->close();

    return $data;
}
function fetch_calc_details_up_support_get_table() {
    // Get `stock_text` and `stock_val` values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the `bottom_value` from POST, default to 0 if not provided
    $bottom_value = isset($_POST['bottom_value']) ? (float)$_POST['bottom_value'] : 0;

    // Query to get the minimum high value based on the conditions
    $getcategories = "
        SELECT MAX(support) AS low_value
        FROM monthly_calculation
        WHERE support < ?
          AND calc_trend = 'UP'
          AND article_name = ?
          AND article_id = ?
    ";

    // Prepare the SQL statement
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dss", $bottom_value, $stock_text, $stock_val);
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the minimum high value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the minimum high value
            $getcategories_1 = "
                SELECT support, low, high, calc_trend, date
                FROM monthly_calculation
                WHERE support = ?
                  AND article_name = ?
                  AND article_id = ?
            ";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("dss", $low_value, $stock_text, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                $row_2 = $resultscategory_2->fetch_assoc();
                $low_val = $row_2['date'];
               
                $data['details'] = $row_2;

                // Additional query for each value in the array
                $extra_details = array();
                $getcategories_2 = "
                    SELECT support, low, high, calc_trend, date
                    FROM monthly_calculation
                    WHERE date = ?
                        AND article_name = ?
                        AND article_id = ?
                ";

                $stmt_3 = $conn->prepare($getcategories_2);
                $stmt_3->bind_param("sss", $low_val, $stock_text, $stock_val);
                $stmt_3->execute();
                $resultscategory_3 = $stmt_3->get_result();

                while ($row_3 = $resultscategory_3->fetch_assoc()) {
                    $extra_details[] = $row_3;
                }
                $stmt_3->close();
                
                $data['extra_details'] = $extra_details; // Store all rows as an array
            }
            $stmt_2->close();
        }
    }

    // Close the statement
    $stmt->close();

    return $data;
}

function fetch_calc_details_down_support_get_table() {
    // Get `stock_text` and `stock_val` values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the `bottom_value` from POST, default to 0 if not provided
    $bottom_value = isset($_POST['bottom_value']) ? (float)$_POST['bottom_value'] : 0;

    // Query to get the minimum high value based on the conditions
    $getcategories = "
        SELECT MAX(low) AS low_value
                      FROM monthly_calculation
                      WHERE low < ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?
    ";

    // Prepare the SQL statement
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dss", $bottom_value, $stock_text, $stock_val);
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the minimum high value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the minimum high value
            $getcategories_1 = "
                SELECT support, high, calc_trend, date,low
                                FROM monthly_calculation
                                WHERE low = ?
                                AND article_name = ?
                                AND article_id = ?
                                LIMIT 1
            ";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("dss", $low_value, $stock_text, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                $row_2 = $resultscategory_2->fetch_assoc();
                $low_val = $row_2['date'];
               
                $data['details'] = $row_2;

                // Additional query for each value in the array
                $extra_details = array();
                $getcategories_2 = "
                    SELECT support, low, high, calc_trend, date
                    FROM monthly_calculation
                    WHERE date = ?
                        AND article_name = ?
                        AND article_id = ?
                ";

                $stmt_3 = $conn->prepare($getcategories_2);
                $stmt_3->bind_param("sss", $low_val, $stock_text, $stock_val);
                $stmt_3->execute();
                $resultscategory_3 = $stmt_3->get_result();

                while ($row_3 = $resultscategory_3->fetch_assoc()) {
                    $extra_details[] = $row_3;
                }
                $stmt_3->close();
                
                $data['extra_details'] = $extra_details; // Store all rows as an array
            }
            $stmt_2->close();
        }
    }

    // Close the statement
    $stmt->close();

    return $data;
}


//put


function fetch_calc_details_up_support_val() {
    // Get stock_text, stock_val, and other values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the bottom value from POST and ensure it is sanitized
    $bottom_value = isset($_POST['bottom_value']) ? (float) $_POST['bottom_value'] : 0;

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM monthly_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $bottom_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM monthly_calculation
                                WHERE support = ?
                                AND article_name = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("dss", $low_value, $stock_text, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $data['details'] = $row_2;
            }
            $stmt_2->close();
        }
    }

    // Close the statements
    $stmt->close();

    return $data;
}


function fetch_calc_details_high_support_val() {
    // Get stock_text, stock_val, and other values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the bottom value from POST and ensure it is sanitized
    $bottom_value = isset($_POST['bottom_value']) ? (float) $_POST['bottom_value'] : 0;

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(high) AS low_value
                      FROM monthly_calculation
                      WHERE high > ?
                      AND calc_trend = 'UP'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $bottom_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM monthly_calculation
                                WHERE high = ?
                                AND article_name = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("dss", $low_value, $stock_text, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $data['details'] = $row_2;
            }
            $stmt_2->close();
        }
    }

    // Close the statements
    $stmt->close();

    return $data;
}

function fetch_calc_details_up_support_get_table_put_call() {
    // Get `stock_text` and `stock_val` values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the `bottom_value` from POST, default to 0 if not provided
    $bottom_value = isset($_POST['bottom_value']) ? (float)$_POST['bottom_value'] : 0;

    // Query to get the minimum high value based on the conditions
    $getcategories = "
        SELECT MIN(support) AS low_value
                      FROM monthly_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?
    ";

    // Prepare the SQL statement
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dss", $bottom_value, $stock_text, $stock_val);
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the minimum high value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the minimum high value
            $getcategories_1 = "
                SELECT support, low, high, calc_trend, date
                FROM monthly_calculation
                WHERE support = ?
                  AND article_name = ?
                  AND article_id = ?
            ";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("dss", $low_value, $stock_text, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                $row_2 = $resultscategory_2->fetch_assoc();
                $low_val = $row_2['date'];
               
                $data['details'] = $row_2;

                // Additional query for each value in the array
                $extra_details = array();
                $getcategories_2 = "
                    SELECT support, low, high, calc_trend, date
                    FROM monthly_calculation
                    WHERE date = ?
                        AND article_name = ?
                        AND article_id = ?
                ";

                $stmt_3 = $conn->prepare($getcategories_2);
                $stmt_3->bind_param("sss", $low_val, $stock_text, $stock_val);
                $stmt_3->execute();
                $resultscategory_3 = $stmt_3->get_result();

                while ($row_3 = $resultscategory_3->fetch_assoc()) {
                    $extra_details[] = $row_3;
                }
                $stmt_3->close();
                
                $data['extra_details'] = $extra_details; // Store all rows as an array
            }
            $stmt_2->close();
        }
    }

    // Close the statement
    $stmt->close();

    return $data;
}



function fetch_calc_details_high_get_table_put_call() {
    // Get `stock_text` and `stock_val` values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the `bottom_value` from POST, default to 0 if not provided
    $bottom_value = isset($_POST['bottom_value']) ? (float)$_POST['bottom_value'] : 0;

    // Query to get the minimum high value based on the conditions
    $getcategories = "
        SELECT MIN(high) AS low_value
                      FROM monthly_calculation
                      WHERE high > ?
                      AND calc_trend = 'UP'
                      AND article_name = ?
                      AND article_id = ?
    ";

    // Prepare the SQL statement
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dss", $bottom_value, $stock_text, $stock_val);
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the minimum high value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the minimum high value
            $getcategories_1 = "
                SELECT support, low, high, calc_trend, date
                FROM monthly_calculation
                WHERE high = ?
                  AND article_name = ?
                  AND article_id = ?
            ";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("dss", $low_value, $stock_text, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                $row_2 = $resultscategory_2->fetch_assoc();
                $low_val = $row_2['date'];
               
                $data['details'] = $row_2;

                // Additional query for each value in the array
                $extra_details = array();
                $getcategories_2 = "
                    SELECT support, low, high, calc_trend, date
                    FROM monthly_calculation
                    WHERE date = ?
                        AND article_name = ?
                        AND article_id = ?
                ";

                $stmt_3 = $conn->prepare($getcategories_2);
                $stmt_3->bind_param("sss", $low_val, $stock_text, $stock_val);
                $stmt_3->execute();
                $resultscategory_3 = $stmt_3->get_result();

                while ($row_3 = $resultscategory_3->fetch_assoc()) {
                    $extra_details[] = $row_3;
                }
                $stmt_3->close();
                
                $data['extra_details'] = $extra_details; // Store all rows as an array
            }
            $stmt_2->close();
        }
    }

    // Close the statement
    $stmt->close();

    return $data;
}

function get_stocks() {
    $conn = db_connect();
    $getcategories = "SELECT*FROM articles_details";
    $resultscategory = $conn->query($getcategories);
    $data = array();
    if ($resultscategory->num_rows > 0) {            
        while($row = $resultscategory->fetch_assoc()) {
            $data[] = $row;
        }
    } 
    return $data;
}

function add_new_stock() {
    $conn = db_connect();
    $stock_val = $_POST['stock_val'];
   
    $getcategories = "INSERT INTO articles_details (article_name) VALUES ('".$stock_val."')";

    if (mysqli_query($conn, $getcategories)) {
        return "Sucess";
    }
    else{
        return "Error";
    }
    

}

function edit_new_stock() {
    $conn = db_connect();
    $stock_val = $_POST['stock_val'];

    $getcategories = "SELECT * FROM articles_details WHERE id = '$stock_val'";
    $resultscategory = $conn->query($getcategories);
    $data = array();
    if ($resultscategory->num_rows > 0) {            
        while($row = $resultscategory->fetch_assoc()) {
            $data[] = $row;
        }
    } 
    return $data;
}

function edit_new_stock_details() {
    $conn = db_connect();
    $stock_val = $_POST['stock_val'];
    $stock_id = $_POST['stock_id'];

    $getcategories = "UPDATE articles_details SET article_name = '$stock_val' WHERE id = '$stock_id'";

    if (mysqli_query($conn, $getcategories)) {
        return "Sucess";
    }
    else{
        return "Error";
    }
    

}

function dele_new_stock_details() {
    $conn = db_connect();
    $stock_id = $_POST['stock_id'];

    $getcategories = "DELETE FROM articles_details WHERE id = '$stock_id'";

    if (mysqli_query($conn, $getcategories)) {
        return "Sucess";
    }
    else{
        return "Error";
    }
    

}

function get_data_stocks_dash() {
    $conn = db_connect();
    $getcategories = "SELECT*FROM monthly_details LIMIT 50";
    $resultscategory = $conn->query($getcategories);
    $data = array();
    if ($resultscategory->num_rows > 0) {            
        while($row = $resultscategory->fetch_assoc()) {
            $data[] = $row;
        }
    } 
    return $data;
}

function delete_details_trunc() {
    $stock_id = $_POST['stock_val'];

    $conn = db_connect();
    // $response = ["success" => false, "message" => ""];
    // $conn->begin_transaction();
    // try {
    //     // Delete from the first table
    //     $query1 = "DELETE FROM daily_details WHERE article_id = ?";
    //     $stmt1 = $conn->prepare($query1);
    //     $stmt1->bind_param("i", $stock_id);
    //     $stmt1->execute();

    //     // Check if the first deletion was successful
    //     if ($stmt1->affected_rows == 0) {
    //         throw new Exception("No record found in `daily_details` with id $stock_id.");
    //     }

    //     // Delete from the second table
    //     $query2 = "DELETE FROM daily_calculation WHERE article_id = ?";
    //     $stmt2 = $conn->prepare($query2);
    //     $stmt2->bind_param("i", $stock_id);
    //     $stmt2->execute();

    //     // Check if the second deletion was successful
    //     if ($stmt2->affected_rows == 0) {
    //         throw new Exception("No record found in `daily_calculation` with id $stock_id.");
    //     }

    //     // Commit the transaction
    //     $conn->commit();

    //     // Return success response
    //     $response["success"] = true;
    //     $response["message"] = "Records deleted successfully from both tables.";
    // } catch (Exception $e) {
    //     // Rollback the transaction in case of an error
    //     $conn->rollback();
    //     $response["message"] = "Error deleting records: " . $e->getMessage();
    // }
    $response = ["success" => false, "message" => ""];
    $getcategories = "DELETE FROM monthly_details WHERE article_id = '$stock_id'";

    if (mysqli_query($conn, $getcategories)) {
        $response["success"] = true;
        $response["message"] = "Records deleted successfully from both tables.";
        $getcategories2 = "DELETE FROM monthly_calculation WHERE article_id = '$stock_id'";
        if (mysqli_query($conn, $getcategories2)) {
            $response["success"] = true;
            $response["message"] = "Records deleted successfully from both tables.";
        }else{
            $response = ["success" => false, "message" => "No record found in `daily_calculation` with id $stock_id."];
    
        }
    }else{
        $response = ["success" => false, "message" => "No record found in `daily_calculation` with id $stock_id."];

    }

    return $response;

}


function dele_new_details_details() {
    $conn = db_connect();
    $stock_id = $_POST['stock_id'];

    $getcategories = "DELETE FROM monthly_details WHERE id = '$stock_id'";

    if (mysqli_query($conn, $getcategories)) {
        $getcategories1 = "DELETE FROM monthly_calculation WHERE monthly_id = '$stock_id'";

        if (mysqli_query($conn, $getcategories1)) {
            return "Sucess";
        }
        else{
            return "Error";
        }
    }
    else{
        return "Error";
    }
    

}

?>
