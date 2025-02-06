<?php
include '../Config/config.php';

session_start();

function user_details() {
    $conn = db_connect();
    $username = $_POST['user_name'];
    $password = $_POST['pass_word'];
    // $_SESSION[$_POST['key']] = $_POST['user_name'];
    // $_SESSION['authenticated'] = true;

    // $getcategories = "SELECT * FROM user_details WHERE username = '$username' AND password = '$password'";
    // $resultscategory = $conn->query($getcategories);
    // $data = array();
    // if ($resultscategory->num_rows > 0) {            
    //     while($row = $resultscategory->fetch_assoc()) {
    //         $data[] = $row;
    //     }
    // } 
    // return $data;


    $current_date = date("Y-m-d H:i:s", strtotime("+1 day"));


     // Example query to validate the username and password
     $stmt = $conn->prepare("SELECT * FROM register_form WHERE user_name = ? AND password = ?" );
     $stmt->bind_param("ss", $username, $password); // Use parameterized queries to avoid SQL injection
     $stmt->execute();
     $result = $stmt->get_result();
 
     if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
         
        $stmt = $conn->prepare("SELECT * FROM register_form WHERE user_name = ? AND password = ? AND enddate > ?" );
        $stmt->bind_param("sss", $username, $password,$current_date); // Use parameterized queries to avoid SQL injection
        $stmt->execute();
        $result = $stmt->get_result();
 
        if ($result->num_rows > 0) {
            // Set session variables
            $_SESSION['username'] = $user['user_name']; // Set session username
            $_SESSION['user_id'] = $user['id']; // Set any other session values if needed
            $_SESSION['members'] = $user['members']; // Set any other session values if needed

            $stmt = $conn->prepare("SELECT * FROM register_form WHERE user_name = ? AND password = ? AND enddate > ? AND current_status = '0'" );
            $stmt->bind_param("sss", $username, $password,$current_date); // Use parameterized queries to avoid SQL injection
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {

                $data_value =  [
                    "status" => "success",
                    "message" => "Login successful",
                    "redirect" => "index.php"
                ];
            }else{
                $data_value = [
                    "status" => "error",
                    "message" => "Already Used this account"
                ];
            }
        }else{
            $data_value = [
                "status" => "error",
                "message" => "Your Validity Expired"
            ];
        }
     } else {
        $data_value = [
             "status" => "error",
             "message" => "Invalid username or password"
         ];
     }
    //  $stmt->close();
    //  $conn->close();
     return $data_value;
}

?>
