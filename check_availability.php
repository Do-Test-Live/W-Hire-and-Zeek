<?php
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

$username = $_POST['username'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];

$usernameSuggestions = array();
for ($i = 0; $i < 3; $i++) {
    $usernameSuggestions[] = generateUsername($username);
}


// Function to generate username suggestions
function generateUsername($val)
{
    // Implement your own logic to generate username suggestions
    $username = strtolower($val . rand(11, 9999));
    return $username;
}

$usernamevalid = array();

if(isset($username)){
    $query="SELECT * FROM customer where username='$username'";
    $row_count = $db_handle->numRows($query);

    if($row_count>0){
        $usernamevalid[] = 'notvalid';
    }else{
        $usernamevalid[] = 'valid';
    }
}

// Encode and output username suggestions as JSON
echo json_encode(array('suggestions' => $usernameSuggestions,'usernamevalid' => $usernamevalid));
