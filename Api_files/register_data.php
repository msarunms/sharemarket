<?php
include '../Config/config.php';


function fetch_data_register_details() {
    $conn = db_connect();
    $getcategories = "SELECT*FROM register_form";
    $resultscategory = $conn->query($getcategories);
    $data = array();
    if ($resultscategory->num_rows > 0) {            
        while($row = $resultscategory->fetch_assoc()) {
            $data[] = $row;
        }
    } 
    return $data;
}

?>
