<?php
include '../Config/config.php';


function fetch_trade_month() {
    // Get stock_text, stock_val, and other values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the bottom value from POST and ensure it is sanitized
    $up_support = isset($_POST['up_support']) ? (float) $_POST['up_support'] : 0;
    $low_support = isset($_POST['low_support']) ? (float) $_POST['low_support'] : 0;
    

    ########################## First Query ##############################################
    $array_down_support = [];
    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM monthly_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $low_support, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;
        $array_down_support[] = $low_value;

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
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['details'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM monthly_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

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
                    
                        $data['low_value1'] = $row_2['support'];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM monthly_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_name = ?
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("dds", $low_value_mon, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['low_value2'] = $low_value;


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
                        $low_value3 = $row_2["low"];

                        $getcategories = "SELECT MAX(low) AS low_value
                                        FROM monthly_calculation
                                        WHERE low < ?
                                        AND calc_trend = 'DOWN'
                                        AND article_name = ?
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("dds", $low_value3, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
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
                                    $data['low_value3'] = $row_2["support"];
                                    $array_down_support[] = $row_2["support"];
                                }
                            }
                        }

                        
                    }

                    
                    $stmt_2->close();
                    

                     
                 }

            }


        }
    }
    

    ########################## Second Query ##############################################

    $array_up_support = [];
    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(support) AS low_value
                      FROM monthly_calculation
                      WHERE support < ?
                      AND calc_trend = 'UP'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $up_support, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value4'] = $low_value;
        $array_up_support[] = $low_value;

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
                $high_value = $row_2['low'];
                $low_value_mon = $row_2['high'];
                $data['details1'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(low) AS low_value
                FROM monthly_calculation
                WHERE low < ?
                AND calc_trend = 'DOWN'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM monthly_calculation
                        WHERE low = ?
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
                    
                        $data['low_value5'] = $row_2['support'];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MIN(support) AS low_value
                 FROM monthly_calculation
                 WHERE support > ?
                 AND calc_trend = 'DOWN'
                 AND article_name = ?
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("dds", $low_value_mon, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['low_value6'] = $low_value;


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
                        $low_value3 = $row_2["high"];

                        $getcategories = "SELECT MIN(high) AS low_value
                                        FROM monthly_calculation
                                        WHERE high > ?
                                        AND calc_trend = 'UP'
                                        AND article_name = ?
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("dds", $low_value3, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high, calc_trend, date,low
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
                                    $data['low_value7'] = $row_2["support"];
                                    $array_up_support[] = $row_2["support"];
                                }
                            }
                        }

                        
                    }

                    
                    $stmt_2->close();
                    

                     
                 }

            }


        }
    }
    #########################################################################################


    ######################### Third Query #############################################
    $minValue = min($array_up_support);
    $maxValue = max($array_up_support);
    print($maxValue);
    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(low) AS low_value
                      FROM monthly_calculation
                      WHERE low < ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $minValue, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
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
                $data['low_value8'] = $row_2['support'];
                $data['details2'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(support) AS low_value
                FROM monthly_calculation
                WHERE support < ?
                AND calc_trend = 'UP'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $maxValue, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];
                    $data['low_value9'] = $row['low_value'];

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
                        $high_value = $row_2['high'];
                        $data['low_value9'] = $row_2['support'];

                        // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                        $getcategories4 = "SELECT MIN(support) AS low_value
                        FROM monthly_calculation
                        WHERE support > ?
                        AND calc_trend = 'DOWN'
                        AND article_name = ?
                        AND article_id = ?";
        
                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories4);
                        $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory4 = $stmt->get_result();
                        if ($resultscategory4->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory4->fetch_assoc();
                            $low_value = $row['low_value'];
                            $data['low_value10'] = $low_value;

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
                                $low_value3 = $row_2["high"];
                                $getcategories = "SELECT MIN(high) AS low_value
                                                FROM monthly_calculation
                                                WHERE high > ?
                                                AND calc_trend = 'UP'
                                                AND article_name = ?
                                                AND article_id = ?";
        
                                // Prepare the statement to prevent SQL injection
                                $stmt = $conn->prepare($getcategories);
                                $stmt->bind_param("dds", $low_value3, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                                $stmt->execute();
                                $resultscategory = $stmt->get_result();
        
                                if ($resultscategory->num_rows > 0) {
                                    // Fetch the row with the maximum low value
                                    $row = $resultscategory->fetch_assoc();
                                    $low_value = $row['low_value'];

                                    if ($low_value !== null) {
                                        // Query to fetch additional details for the low value based on the stock_text, stock_val
                                        $getcategories_1 = "SELECT support, high, calc_trend, date,low
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
                                            $data['low_value11'] = $row_2["low"];
                                        }
                                    }
                                }
                            }

                        }

                    }
                }

            }


        }
    }
    #########################################################################################


    ########################## Fourth Query ####################################################

    $minValue_data = min($array_down_support);
    $maxValue_data = max($array_down_support);

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM monthly_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $minValue_data, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value12'] = $low_value;

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
                $high_value = $row_2['low'];
                $low_value_mon = $row_2['high'];
                $data['details3'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM monthly_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $maxValue_data, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

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
                    
                        $data['low_value13'] = $row_2['support'];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM monthly_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_name = ?
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value_final = $row['low_value'];
                     $data['low_value14'] = $low_value_final;

                     // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                    $getcategories3 = "SELECT MAX(low) AS low_value
                    FROM monthly_calculation
                    WHERE low < ?
                    AND calc_trend = 'DOWN'
                    AND article_name = ?
                    AND article_id = ?";

                    // Prepare the statement to prevent SQL injection
                    $stmt = $conn->prepare($getcategories3);
                    $stmt->bind_param("dds", $low_value_final, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                    $stmt->execute();
                    $resultscategory3 = $stmt->get_result();
                    
                    if ($resultscategory3->num_rows > 0) {
                        // Fetch the row with the maximum low value
                        $row = $resultscategory3->fetch_assoc();
                        $low_value = $row['low_value'];
    
                        $getcategories_1 = "
                            SELECT support, low, high, calc_trend, date
                            FROM monthly_calculation
                            WHERE low = ?
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
                        
                            $data['low_value15'] = $row_2['high'];
    
                        }
                    }
                    
                    $stmt_2->close();
                    

                     
                 }

            }


        }
    }

    // Close the statements
    $stmt->close();

    return $data;
}





function fetch_trade_daily() {
    // Get stock_text, stock_val, and other values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the bottom value from POST and ensure it is sanitized
    $up_support = isset($_POST['up_support']) ? (float) $_POST['up_support'] : 0;
    $low_support = isset($_POST['low_support']) ? (float) $_POST['low_support'] : 0;
    

    ########################## First Query ##############################################
    $array_down_support = [];
    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM daily_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $low_support, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
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
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['details'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM daily_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM daily_calculation
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
                    
                        $data['low_value1'] = $row_2['support'];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM daily_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_name = ?
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("dds", $low_value_mon, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['low_value2'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
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
                        $low_value3 = $row_2["low"];

                        $getcategories = "SELECT MAX(low) AS low_value
                                        FROM daily_calculation
                                        WHERE low < ?
                                        AND calc_trend = 'DOWN'
                                        AND article_name = ?
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("dds", $low_value3, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high, calc_trend, date
                                                    FROM daily_calculation
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
                                    $data['low_value3'] = $row_2["support"];
                                    $array_down_support[] = $row_2["support"];
                                }
                            }
                        }

                        
                    }

                    
                    $stmt_2->close();
                    

                     
                 }

            }


        }
    }
    

    ########################## Second Query ##############################################

    $array_up_support = [];
    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(support) AS low_value
                      FROM daily_calculation
                      WHERE support < ?
                      AND calc_trend = 'UP'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $up_support, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value4'] = $low_value;
        $array_up_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
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
                $high_value = $row_2['low'];
                $low_value_mon = $row_2['high'];
                $data['details1'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(low) AS low_value
                FROM daily_calculation
                WHERE low < ?
                AND calc_trend = 'DOWN'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM daily_calculation
                        WHERE low = ?
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
                    
                        $data['low_value5'] = $row_2['support'];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MIN(support) AS low_value
                 FROM daily_calculation
                 WHERE support > ?
                 AND calc_trend = 'DOWN'
                 AND article_name = ?
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("dds", $low_value_mon, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['low_value6'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
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
                        $low_value3 = $row_2["high"];

                        $getcategories = "SELECT MIN(high) AS low_value
                                        FROM daily_calculation
                                        WHERE high > ?
                                        AND calc_trend = 'UP'
                                        AND article_name = ?
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("dds", $low_value3, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high, calc_trend, date,low
                                                    FROM daily_calculation
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
                                    $data['low_value7'] = $row_2["support"];
                                    $array_up_support[] = $row_2["support"];
                                }
                            }
                        }

                        
                    }

                    
                    $stmt_2->close();
                    

                     
                 }

            }


        }
    }
    #########################################################################################


    ######################### Third Query #############################################
    $minValue = min($array_up_support);
    $maxValue = max($array_up_support);

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(low) AS low_value
                      FROM daily_calculation
                      WHERE low < ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $minValue, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
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
                $data['low_value8'] = $row_2['support'];
                $data['details2'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(support) AS low_value
                FROM daily_calculation
                WHERE support < ?
                AND calc_trend = 'UP'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $maxValue, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];
                    $data['low_value9'] = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM daily_calculation
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
                        $high_value = $row_2['high'];
                        $data['low_value9'] = $row_2['support'];

                        // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                        $getcategories4 = "SELECT MIN(support) AS low_value
                        FROM daily_calculation
                        WHERE support > ?
                        AND calc_trend = 'DOWN'
                        AND article_name = ?
                        AND article_id = ?";
        
                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories4);
                        $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory4 = $stmt->get_result();
                        if ($resultscategory4->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory4->fetch_assoc();
                            $low_value = $row['low_value'];
                            $data['low_value10'] = $low_value;

                            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
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
                                $low_value3 = $row_2["high"];
                                $getcategories = "SELECT MIN(high) AS low_value
                                                FROM daily_calculation
                                                WHERE high > ?
                                                AND calc_trend = 'UP'
                                                AND article_name = ?
                                                AND article_id = ?";
        
                                // Prepare the statement to prevent SQL injection
                                $stmt = $conn->prepare($getcategories);
                                $stmt->bind_param("dds", $low_value3, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                                $stmt->execute();
                                $resultscategory = $stmt->get_result();
        
                                if ($resultscategory->num_rows > 0) {
                                    // Fetch the row with the maximum low value
                                    $row = $resultscategory->fetch_assoc();
                                    $low_value = $row['low_value'];

                                    if ($low_value !== null) {
                                        // Query to fetch additional details for the low value based on the stock_text, stock_val
                                        $getcategories_1 = "SELECT support, high, calc_trend, date,low
                                                            FROM daily_calculation
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
                                            $data['low_value11'] = $row_2["low"];
                                        }
                                    }
                                }
                            }

                        }

                    }
                }

            }


        }
    }
    #########################################################################################


    ########################## Fourth Query ####################################################

    $minValue_data = min($array_down_support);
    $maxValue_data = max($array_down_support);

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM daily_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $minValue_data, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value12'] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
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
                $high_value = $row_2['low'];
                $low_value_mon = $row_2['high'];
                $data['details3'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM daily_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $maxValue_data, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM daily_calculation
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
                    
                        $data['low_value13'] = $row_2['support'];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM daily_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_name = ?
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value_final = $row['low_value'];
                     $data['low_value14'] = $low_value_final;

                     // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                    $getcategories3 = "SELECT MAX(low) AS low_value
                    FROM daily_calculation
                    WHERE low < ?
                    AND calc_trend = 'DOWN'
                    AND article_name = ?
                    AND article_id = ?";

                    // Prepare the statement to prevent SQL injection
                    $stmt = $conn->prepare($getcategories3);
                    $stmt->bind_param("dds", $low_value_final, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                    $stmt->execute();
                    $resultscategory3 = $stmt->get_result();
                    
                    if ($resultscategory3->num_rows > 0) {
                        // Fetch the row with the maximum low value
                        $row = $resultscategory3->fetch_assoc();
                        $low_value = $row['low_value'];
    
                        $getcategories_1 = "
                            SELECT support, low, high, calc_trend, date
                            FROM daily_calculation
                            WHERE low = ?
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
                        
                            $data['low_value15'] = $row_2['high'];
    
                        }
                    }
                    
                    $stmt_2->close();
                    

                     
                 }

            }


        }
    }

    // Close the statements
    $stmt->close();

    return $data;
}






function fetch_trade_weekly() {
    // Get stock_text, stock_val, and other values from POST request
    $stock_text = $_POST['stock_text'];
    $stock_val = $_POST['stock_val'];

    // Establish the database connection
    $conn = db_connect();

    // Get the bottom value from POST and ensure it is sanitized
    $up_support = isset($_POST['up_support']) ? (float) $_POST['up_support'] : 0;
    $low_support = isset($_POST['low_support']) ? (float) $_POST['low_support'] : 0;
    

    ########################## First Query ##############################################
    $array_down_support = [];
    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM weekly_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $low_support, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    $data = array();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
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
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['details'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM weekly_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM weekly_calculation
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
                    
                        $data['low_value1'] = $row_2['support'];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM weekly_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_name = ?
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("dds", $low_value_mon, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['low_value2'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
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
                        $low_value3 = $row_2["low"];

                        $getcategories = "SELECT MAX(low) AS low_value
                                        FROM weekly_calculation
                                        WHERE low < ?
                                        AND calc_trend = 'DOWN'
                                        AND article_name = ?
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("dds", $low_value3, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high, calc_trend, date
                                                    FROM weekly_calculation
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
                                    $data['low_value3'] = $row_2["support"];
                                    $array_down_support[] = $row_2["support"];
                                }
                            }
                        }

                        
                    }

                    
                    $stmt_2->close();
                    

                     
                 }

            }


        }
    }
    

    ########################## Second Query ##############################################

    $array_up_support = [];
    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(support) AS low_value
                      FROM weekly_calculation
                      WHERE support < ?
                      AND calc_trend = 'UP'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $up_support, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value4'] = $low_value;
        $array_up_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
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
                $high_value = $row_2['low'];
                $low_value_mon = $row_2['high'];
                $data['details1'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(low) AS low_value
                FROM weekly_calculation
                WHERE low < ?
                AND calc_trend = 'DOWN'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM weekly_calculation
                        WHERE low = ?
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
                    
                        $data['low_value5'] = $row_2['support'];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MIN(support) AS low_value
                 FROM weekly_calculation
                 WHERE support > ?
                 AND calc_trend = 'DOWN'
                 AND article_name = ?
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("dds", $low_value_mon, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['low_value6'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
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
                        $low_value3 = $row_2["high"];

                        $getcategories = "SELECT MIN(high) AS low_value
                                        FROM weekly_calculation
                                        WHERE high > ?
                                        AND calc_trend = 'UP'
                                        AND article_name = ?
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("dds", $low_value3, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high, calc_trend, date,low
                                                    FROM weekly_calculation
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
                                    $data['low_value7'] = $row_2["support"];
                                    $array_up_support[] = $row_2["support"];
                                }
                            }
                        }

                        
                    }

                    
                    $stmt_2->close();
                    

                     
                 }

            }


        }
    }
    #########################################################################################


    ######################### Third Query #############################################
    $minValue = min($array_up_support);
    $maxValue = max($array_up_support);

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(low) AS low_value
                      FROM weekly_calculation
                      WHERE low < ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $minValue, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
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
                $data['low_value8'] = $row_2['support'];
                $data['details2'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(support) AS low_value
                FROM weekly_calculation
                WHERE support < ?
                AND calc_trend = 'UP'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $maxValue, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];
                    $data['low_value9'] = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM weekly_calculation
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
                        $high_value = $row_2['high'];
                        $data['low_value9'] = $row_2['support'];

                        // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                        $getcategories4 = "SELECT MIN(support) AS low_value
                        FROM weekly_calculation
                        WHERE support > ?
                        AND calc_trend = 'DOWN'
                        AND article_name = ?
                        AND article_id = ?";
        
                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories4);
                        $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory4 = $stmt->get_result();
                        if ($resultscategory4->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory4->fetch_assoc();
                            $low_value = $row['low_value'];
                            $data['low_value10'] = $low_value;

                            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
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
                                $low_value3 = $row_2["high"];
                                $getcategories = "SELECT MIN(high) AS low_value
                                                FROM weekly_calculation
                                                WHERE high > ?
                                                AND calc_trend = 'UP'
                                                AND article_name = ?
                                                AND article_id = ?";
        
                                // Prepare the statement to prevent SQL injection
                                $stmt = $conn->prepare($getcategories);
                                $stmt->bind_param("dds", $low_value3, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                                $stmt->execute();
                                $resultscategory = $stmt->get_result();
        
                                if ($resultscategory->num_rows > 0) {
                                    // Fetch the row with the maximum low value
                                    $row = $resultscategory->fetch_assoc();
                                    $low_value = $row['low_value'];

                                    if ($low_value !== null) {
                                        // Query to fetch additional details for the low value based on the stock_text, stock_val
                                        $getcategories_1 = "SELECT support, high, calc_trend, date,low
                                                            FROM weekly_calculation
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
                                            $data['low_value11'] = $row_2["low"];
                                        }
                                    }
                                }
                            }

                        }

                    }
                }

            }


        }
    }
    #########################################################################################


    ########################## Fourth Query ####################################################

    $minValue_data = min($array_down_support);
    $maxValue_data = max($array_down_support);

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM weekly_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_name = ?
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("dds", $minValue_data, $stock_text, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['low_value12'] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
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
                $high_value = $row_2['low'];
                $low_value_mon = $row_2['high'];
                $data['details3'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM weekly_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_name = ?
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("dds", $maxValue_data, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM weekly_calculation
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
                    
                        $data['low_value13'] = $row_2['support'];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM weekly_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_name = ?
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("dds", $high_value, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value_final = $row['low_value'];
                     $data['low_value14'] = $low_value_final;

                     // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                    $getcategories3 = "SELECT MAX(low) AS low_value
                    FROM weekly_calculation
                    WHERE low < ?
                    AND calc_trend = 'DOWN'
                    AND article_name = ?
                    AND article_id = ?";

                    // Prepare the statement to prevent SQL injection
                    $stmt = $conn->prepare($getcategories3);
                    $stmt->bind_param("dds", $low_value_final, $stock_text, $stock_val); // Bind parameters: d = double, s = string
                    $stmt->execute();
                    $resultscategory3 = $stmt->get_result();
                    
                    if ($resultscategory3->num_rows > 0) {
                        // Fetch the row with the maximum low value
                        $row = $resultscategory3->fetch_assoc();
                        $low_value = $row['low_value'];
    
                        $getcategories_1 = "
                            SELECT support, low, high, calc_trend, date
                            FROM weekly_calculation
                            WHERE low = ?
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
                        
                            $data['low_value15'] = $row_2['high'];
    
                        }
                    }
                    
                    $stmt_2->close();
                    

                     
                 }

            }


        }
    }

    // Close the statements
    $stmt->close();

    return $data;
}

?>