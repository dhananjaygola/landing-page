<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$mysqli = new mysqli("localhost", "acedirlb_user", "Pspace@123", "acedirlb_data");
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
// Escape user inputs for security
$name = $mysqli->real_escape_string($_REQUEST['name']);
$email = $mysqli->real_escape_string($_REQUEST['email']);
$mobile = $mysqli->real_escape_string($_REQUEST['mobile']);
$source = 'Risland';

 $url_new="http://148.66.133.154:7070/investmango-0.0.1-SNAPSHOT/add/google/leads";
     
            $data_new = array(
                                    'name' => $name,
                                    'email' => $email,
                                    'countryCode' => '+91',
                                    'phone' => $mobile,
                                    'projectName' =>'Risland Sky Mansion',
                                    'queryInfo' => 'fairpocket Leads',
                                    'source'    => 'fairpocket'
                            );
            $options_new= array(
                'http' => array(
                    'header'  => "Content-Type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => json_encode($data_new)
                )
            );
            $context_new = stream_context_create($options_new);
            $result_new = file_get_contents($url_new, false, $context_new);

 $resultData_new = json_decode($result_new, TRUE);



 
// attempt insert query execution
$sql = "INSERT INTO leads (name, email, mobile,source) VALUES ('$name', '$email', '$mobile','$source')";
if($mysqli->query($sql) === true){

header('location:https://www.therislandskymansion.com/thanks.php');


} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}
 
// Close connection
$mysqli->close();
?>