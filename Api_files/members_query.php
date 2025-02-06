<?php
// Include the data fetch function
include 'members_data.php';

if (isset($_GET['function'])) {
    $functionName = $_GET['function'];
    switch ($functionName) {
        case 'edit_members':
            $data = edit_members();
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