<?php
// Include the data fetch function
include 'trade_query.php';

if (isset($_GET['function'])) {
    $functionName = $_GET['function'];
    switch ($functionName) {
        case 'fetch_trade_month':
            $data = fetch_trade_month();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'fetch_trade_daily':
            $data = fetch_trade_daily();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        case 'fetch_trade_weekly':
            $data = fetch_trade_weekly();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        
        default:
            // Handle invalid function name
            $data = array('error' => 'Invalid function name');
            break;
    }

}

?>