<?php
include '../Config/config.php';


function edit_members() {
    $conn = db_connect();
    $stock_id = $_POST['id'];
    $getcategories = "SELECT * FROM register_form WHERE id = ".$stock_id."";
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
