<?php
include '../Config/config.php';



function fetch_trade_daily() {
    // Get stock_text, stock_val, and other values from POST request
    $stock_val = $_POST['stock_val'];
    // Establish the database connection
    $conn = db_connect();

    // Get the bottom value from POST and ensure it is sanitized
    $up_support = isset($_POST['up_support']) ? (float) $_POST['up_support'] : 0;
    $low_support = isset($_POST['low_support']) ? (float) $_POST['low_support'] : 0;
    
    $array_down_support = [];
    $data = array();

    ########################## First Query ##############################################
   

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(support) AS low_value
                      FROM daily_calculation
                      WHERE support < ?
                      AND calc_trend = 'UP'
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("ds", $low_support, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['Targett_CE_1'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("ds", $low_value, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['Targett_CE_Daily'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(low) AS low_value
                FROM daily_calculation
                WHERE low < ?
                AND calc_trend = 'DOWN'
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("ds", $low_value_mon, $stock_val); // Bind parameters: d = double, s = string
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
                        AND article_id = ?
                    ";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_val = $row_2['date'];
                    
                        $data['Targett_CE_2'] = $row_2["support"];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MIN(support) AS low_value
                 FROM daily_calculation
                 WHERE support > ?
                 AND calc_trend = 'DOWN'
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("ds", $high_value, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['Targett_CE_3'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
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
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("ds", $low_value3, $stock_val); // Bind parameters: d = double, s = string
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
                                                    WHERE high = ?
                                                    AND article_id = ?
                                                    LIMIT 1";
                    
                                $stmt_2 = $conn->prepare($getcategories_1);
                                $stmt_2->bind_param("ds", $low_value, $stock_val);
                                $stmt_2->execute();
                                $resultscategory_2 = $stmt_2->get_result();
                    
                                if ($resultscategory_2->num_rows > 0) {
                                    // Fetch the additional details and add them to the data array
                                    $row_2 = $resultscategory_2->fetch_assoc();
                                    $data['Targett_CE_4'] = $row_2["support"];
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

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM daily_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("ds", $low_support, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['Low_value_5'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("ds", $low_value, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['Targett_CE_5'] = $row_2["support"];



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM daily_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("ds", $high_value, $stock_val); // Bind parameters: d = double, s = string
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
                        AND article_id = ?
                    ";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_val = $row_2['date'];
                    
                        $data['Targett_CE_6'] = $row_2["support"];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM daily_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("ds", $low_value_mon, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['Targett_CE_7'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM daily_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
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
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("ds", $low_value3, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high,low, calc_trend, date
                                                    FROM daily_calculation
                                                    WHERE low = ?
                                                    AND article_id = ?
                                                    LIMIT 1";
                    
                                $stmt_2 = $conn->prepare($getcategories_1);
                                $stmt_2->bind_param("ds", $low_value, $stock_val);
                                $stmt_2->execute();
                                $resultscategory_2 = $stmt_2->get_result();
                    
                                if ($resultscategory_2->num_rows > 0) {
                                    // Fetch the additional details and add them to the data array
                                    $row_2 = $resultscategory_2->fetch_assoc();
                                    $data['Targett_CE_8'] = $row_2["support"];
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









    ################################ Weekly Details #################################################

    ########################## First Query ##############################################
   

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(support) AS low_value
                      FROM weekly_calculation
                      WHERE support < ?
                      AND calc_trend = 'UP'
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("ds", $low_support, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['Targett_WEEK_1'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("ds", $low_value, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['Targett_WEEK'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(low) AS low_value
                FROM weekly_calculation
                WHERE low < ?
                AND calc_trend = 'DOWN'
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("ds", $low_value_mon, $stock_val); // Bind parameters: d = double, s = string
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
                        AND article_id = ?
                    ";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_val = $row_2['date'];
                    
                        $data['Targett_WEEK_2'] = $row_2["support"];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MIN(support) AS low_value
                 FROM weekly_calculation
                 WHERE support > ?
                 AND calc_trend = 'DOWN'
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("ds", $high_value, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['Targett_WEEK_3'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
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
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("ds", $low_value3, $stock_val); // Bind parameters: d = double, s = string
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
                                                    WHERE high = ?
                                                    AND article_id = ?
                                                    LIMIT 1";
                    
                                $stmt_2 = $conn->prepare($getcategories_1);
                                $stmt_2->bind_param("ds", $low_value, $stock_val);
                                $stmt_2->execute();
                                $resultscategory_2 = $stmt_2->get_result();
                    
                                if ($resultscategory_2->num_rows > 0) {
                                    // Fetch the additional details and add them to the data array
                                    $row_2 = $resultscategory_2->fetch_assoc();
                                    $data['Targett_WEEK_4'] = $row_2["support"];
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

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM weekly_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("ds", $low_support, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['Low_value_WEEK'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("ds", $low_value, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['Targett_WEEK_5'] = $row_2["support"];



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM weekly_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("ds", $high_value, $stock_val); // Bind parameters: d = double, s = string
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
                        AND article_id = ?
                    ";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_val = $row_2['date'];
                    
                        $data['Targett_WEEK_6'] = $row_2["support"];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM weekly_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("ds", $low_value_mon, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['Targett_WEEK_7'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM weekly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
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
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("ds", $low_value3, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high,low, calc_trend, date
                                                    FROM weekly_calculation
                                                    WHERE low = ?
                                                    AND article_id = ?
                                                    LIMIT 1";
                    
                                $stmt_2 = $conn->prepare($getcategories_1);
                                $stmt_2->bind_param("ds", $low_value, $stock_val);
                                $stmt_2->execute();
                                $resultscategory_2 = $stmt_2->get_result();
                    
                                if ($resultscategory_2->num_rows > 0) {
                                    // Fetch the additional details and add them to the data array
                                    $row_2 = $resultscategory_2->fetch_assoc();
                                    $data['Targett_WEEK_8'] = $row_2["support"];
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





    ################################ Monthly Details #################################################

    ########################## First Query ##############################################
   

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(support) AS low_value
                      FROM monthly_calculation
                      WHERE support < ?
                      AND calc_trend = 'UP'
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("ds", $low_support, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['Targett_Month_1'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM monthly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("ds", $low_value, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['Targett_Month'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(low) AS low_value
                FROM monthly_calculation
                WHERE low < ?
                AND calc_trend = 'DOWN'
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("ds", $low_value_mon, $stock_val); // Bind parameters: d = double, s = string
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
                        AND article_id = ?
                    ";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_val = $row_2['date'];
                    
                        $data['Targett_Month_2'] = $row_2["support"];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MIN(support) AS low_value
                 FROM monthly_calculation
                 WHERE support > ?
                 AND calc_trend = 'DOWN'
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("ds", $high_value, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['Targett_Month_3'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM monthly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
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
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("ds", $low_value3, $stock_val); // Bind parameters: d = double, s = string
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
                                                    WHERE high = ?
                                                    AND article_id = ?
                                                    LIMIT 1";
                    
                                $stmt_2 = $conn->prepare($getcategories_1);
                                $stmt_2->bind_param("ds", $low_value, $stock_val);
                                $stmt_2->execute();
                                $resultscategory_2 = $stmt_2->get_result();
                    
                                if ($resultscategory_2->num_rows > 0) {
                                    // Fetch the additional details and add them to the data array
                                    $row_2 = $resultscategory_2->fetch_assoc();
                                    $data['Targett_Month_4'] = $row_2["support"];
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

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM monthly_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("ds", $low_support, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['Low_value_Month'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM monthly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("ds", $low_value, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['Targett_Month_5'] = $row_2["support"];



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM monthly_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("ds", $high_value, $stock_val); // Bind parameters: d = double, s = string
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
                        AND article_id = ?
                    ";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_val = $row_2['date'];
                    
                        $data['Targett_Month_6'] = $row_2["support"];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM monthly_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("ds", $low_value_mon, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['Targett_Month_7'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM monthly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
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
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("ds", $low_value3, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high,low, calc_trend, date
                                                    FROM monthly_calculation
                                                    WHERE low = ?
                                                    AND article_id = ?
                                                    LIMIT 1";
                    
                                $stmt_2 = $conn->prepare($getcategories_1);
                                $stmt_2->bind_param("ds", $low_value, $stock_val);
                                $stmt_2->execute();
                                $resultscategory_2 = $stmt_2->get_result();
                    
                                if ($resultscategory_2->num_rows > 0) {
                                    // Fetch the additional details and add them to the data array
                                    $row_2 = $resultscategory_2->fetch_assoc();
                                    $data['Targett_Month_8'] = $row_2["support"];
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




    ################################ 15 MIN Details #################################################

    ########################## First Query ##############################################
   

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(support) AS low_value
                      FROM fifteen_min_calculation
                      WHERE support < ?
                      AND calc_trend = 'UP'
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("ds", $low_support, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['Targett_FIF_1'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM fifteen_min_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("ds", $low_value, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['Targett_FIF'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(low) AS low_value
                FROM fifteen_min_calculation
                WHERE low < ?
                AND calc_trend = 'DOWN'
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("ds", $low_value_mon, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM fifteen_min_calculation
                        WHERE low = ?
                        AND article_id = ?
                    ";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_val = $row_2['date'];
                    
                        $data['Targett_FIF_2'] = $row_2["support"];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MIN(support) AS low_value
                 FROM fifteen_min_calculation
                 WHERE support > ?
                 AND calc_trend = 'DOWN'
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("ds", $high_value, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['Targett_FIF_3'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM fifteen_min_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        // Fetch the additional details and add them to the data array
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_value3 = $row_2["high"];

                        $getcategories = "SELECT MIN(high) AS low_value
                                        FROM fifteen_min_calculation
                                        WHERE high > ?
                                        AND calc_trend = 'UP'
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("ds", $low_value3, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high, calc_trend, date
                                                    FROM fifteen_min_calculation
                                                    WHERE high = ?
                                                    AND article_id = ?
                                                    LIMIT 1";
                    
                                $stmt_2 = $conn->prepare($getcategories_1);
                                $stmt_2->bind_param("ds", $low_value, $stock_val);
                                $stmt_2->execute();
                                $resultscategory_2 = $stmt_2->get_result();
                    
                                if ($resultscategory_2->num_rows > 0) {
                                    // Fetch the additional details and add them to the data array
                                    $row_2 = $resultscategory_2->fetch_assoc();
                                    $data['Targett_FIF_4'] = $row_2["support"];
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

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM fifteen_min_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("ds", $low_support, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['Low_value_FIF'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM fifteen_min_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("ds", $low_value, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['Targett_FIF_5'] = $row_2["support"];



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM fifteen_min_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("ds", $high_value, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM fifteen_min_calculation
                        WHERE high = ?
                        AND article_id = ?
                    ";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_val = $row_2['date'];
                    
                        $data['Targett_FIF_6'] = $row_2["support"];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM fifteen_min_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("ds", $low_value_mon, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['Targett_FIF_7'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM fifteen_min_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        // Fetch the additional details and add them to the data array
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_value3 = $row_2["low"];

                        $getcategories = "SELECT MAX(low) AS low_value
                                        FROM fifteen_min_calculation
                                        WHERE low < ?
                                        AND calc_trend = 'DOWN'
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("ds", $low_value3, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high,low, calc_trend, date
                                                    FROM fifteen_min_calculation
                                                    WHERE low = ?
                                                    AND article_id = ?
                                                    LIMIT 1";
                    
                                $stmt_2 = $conn->prepare($getcategories_1);
                                $stmt_2->bind_param("ds", $low_value, $stock_val);
                                $stmt_2->execute();
                                $resultscategory_2 = $stmt_2->get_result();
                    
                                if ($resultscategory_2->num_rows > 0) {
                                    // Fetch the additional details and add them to the data array
                                    $row_2 = $resultscategory_2->fetch_assoc();
                                    $data['Targett_FIF_8'] = $row_2["support"];
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






    ################################ Hourly Details #################################################

    ########################## First Query ##############################################
   

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MAX(support) AS low_value
                      FROM hourly_calculation
                      WHERE support < ?
                      AND calc_trend = 'UP'
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("ds", $low_support, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();


    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['Targett_HOUR_1'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM hourly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("ds", $low_value, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['Targett_HOUR'] = $row_2;



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MAX(low) AS low_value
                FROM hourly_calculation
                WHERE low < ?
                AND calc_trend = 'DOWN'
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("ds", $low_value_mon, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM hourly_calculation
                        WHERE low = ?
                        AND article_id = ?
                    ";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_val = $row_2['date'];
                    
                        $data['Targett_HOUR_2'] = $row_2["support"];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MIN(support) AS low_value
                 FROM hourly_calculation
                 WHERE support > ?
                 AND calc_trend = 'DOWN'
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("ds", $high_value, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['Targett_HOUR_3'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM hourly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        // Fetch the additional details and add them to the data array
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_value3 = $row_2["high"];

                        $getcategories = "SELECT MIN(high) AS low_value
                                        FROM hourly_calculation
                                        WHERE high > ?
                                        AND calc_trend = 'UP'
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("ds", $low_value3, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high, calc_trend, date
                                                    FROM hourly_calculation
                                                    WHERE high = ?
                                                    AND article_id = ?
                                                    LIMIT 1";
                    
                                $stmt_2 = $conn->prepare($getcategories_1);
                                $stmt_2->bind_param("ds", $low_value, $stock_val);
                                $stmt_2->execute();
                                $resultscategory_2 = $stmt_2->get_result();
                    
                                if ($resultscategory_2->num_rows > 0) {
                                    // Fetch the additional details and add them to the data array
                                    $row_2 = $resultscategory_2->fetch_assoc();
                                    $data['Targett_HOUR_4'] = $row_2["support"];
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

    // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
    $getcategories = "SELECT MIN(support) AS low_value
                      FROM hourly_calculation
                      WHERE support > ?
                      AND calc_trend = 'DOWN'
                      AND article_id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($getcategories);
    $stmt->bind_param("ds", $low_support, $stock_val); // Bind parameters: d = double, s = string
    $stmt->execute();
    $resultscategory = $stmt->get_result();

    if ($resultscategory->num_rows > 0) {
        // Fetch the row with the maximum low value
        $row = $resultscategory->fetch_assoc();
        $low_value = $row['low_value'];
        $data['Low_value_HOUR'] = $low_value;
        $array_down_support[] = $low_value;

        if ($low_value !== null) {
            // Query to fetch additional details for the low value based on the stock_text, stock_val
            $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM hourly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

            $stmt_2 = $conn->prepare($getcategories_1);
            $stmt_2->bind_param("ds", $low_value, $stock_val);
            $stmt_2->execute();
            $resultscategory_2 = $stmt_2->get_result();

            if ($resultscategory_2->num_rows > 0) {
                // Fetch the additional details and add them to the data array
                $row_2 = $resultscategory_2->fetch_assoc();
                $high_value = $row_2['high'];
                $low_value_mon = $row_2['low'];
                $data['Targett_HOUR_5'] = $row_2["support"];



                // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                $getcategories3 = "SELECT MIN(high) AS low_value
                FROM hourly_calculation
                WHERE high > ?
                AND calc_trend = 'UP'
                AND article_id = ?";

                // Prepare the statement to prevent SQL injection
                $stmt = $conn->prepare($getcategories3);
                $stmt->bind_param("ds", $high_value, $stock_val); // Bind parameters: d = double, s = string
                $stmt->execute();
                $resultscategory3 = $stmt->get_result();


                if ($resultscategory3->num_rows > 0) {
                    // Fetch the row with the maximum low value
                    $row = $resultscategory3->fetch_assoc();
                    $low_value = $row['low_value'];

                    $getcategories_1 = "
                        SELECT support, low, high, calc_trend, date
                        FROM hourly_calculation
                        WHERE high = ?
                        AND article_id = ?
                    ";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_val = $row_2['date'];
                    
                        $data['Targett_HOUR_6'] = $row_2["support"];

                    }
                }


                 // Query to get the maximum low value based on stock_text, stock_val, and bottom_value
                 $getcategories4 = "SELECT MAX(support) AS low_value
                 FROM hourly_calculation
                 WHERE support < ?
                 AND calc_trend = 'UP'
                 AND article_id = ?";
 
                 // Prepare the statement to prevent SQL injection
                 $stmt = $conn->prepare($getcategories4);
                 $stmt->bind_param("ds", $low_value_mon, $stock_val); // Bind parameters: d = double, s = string
                 $stmt->execute();
                 $resultscategory4 = $stmt->get_result();
 
 
                 if ($resultscategory4->num_rows > 0) {
                     // Fetch the row with the maximum low value
                     $row = $resultscategory4->fetch_assoc();
                     $low_value = $row['low_value'];
                     $data['Targett_HOUR_7'] = $low_value;


                     $getcategories_1 = "SELECT support,low, high, calc_trend, date
                                FROM hourly_calculation
                                WHERE support = ?
                                AND article_id = ?
                                LIMIT 1";

                    $stmt_2 = $conn->prepare($getcategories_1);
                    $stmt_2->bind_param("ds", $low_value, $stock_val);
                    $stmt_2->execute();
                    $resultscategory_2 = $stmt_2->get_result();

                    if ($resultscategory_2->num_rows > 0) {
                        // Fetch the additional details and add them to the data array
                        $row_2 = $resultscategory_2->fetch_assoc();
                        $low_value3 = $row_2["low"];

                        $getcategories = "SELECT MAX(low) AS low_value
                                        FROM hourly_calculation
                                        WHERE low < ?
                                        AND calc_trend = 'DOWN'
                                        AND article_id = ?";

                        // Prepare the statement to prevent SQL injection
                        $stmt = $conn->prepare($getcategories);
                        $stmt->bind_param("ds", $low_value3, $stock_val); // Bind parameters: d = double, s = string
                        $stmt->execute();
                        $resultscategory = $stmt->get_result();

                        if ($resultscategory->num_rows > 0) {
                            // Fetch the row with the maximum low value
                            $row = $resultscategory->fetch_assoc();
                            $low_value = $row['low_value'];
                    
                            if ($low_value !== null) {
                                // Query to fetch additional details for the low value based on the stock_text, stock_val
                                $getcategories_1 = "SELECT support, high,low, calc_trend, date
                                                    FROM hourly_calculation
                                                    WHERE low = ?
                                                    AND article_id = ?
                                                    LIMIT 1";
                    
                                $stmt_2 = $conn->prepare($getcategories_1);
                                $stmt_2->bind_param("ds", $low_value, $stock_val);
                                $stmt_2->execute();
                                $resultscategory_2 = $stmt_2->get_result();
                    
                                if ($resultscategory_2->num_rows > 0) {
                                    // Fetch the additional details and add them to the data array
                                    $row_2 = $resultscategory_2->fetch_assoc();
                                    $data['Targett_HOUR_8'] = $row_2["support"];
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

    // Close the statements
    $stmt->close();

    return $data;
}



