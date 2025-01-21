<?php
// Include the data fetch function
include 'login_data.php';

if (isset($_GET['function'])) {
    $functionName = $_GET['function'];
    switch ($functionName) {
        case 'user_details':
            $data = user_details();
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