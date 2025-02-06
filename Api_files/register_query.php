<?php
// Include the data fetch function
include 'register_data.php';

if (isset($_GET['function'])) {
    $functionName = $_GET['function'];
    switch ($functionName) {
        case 'fetch_data_register_details':
            $data = fetch_data_register_details();
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        
    }

}

?>