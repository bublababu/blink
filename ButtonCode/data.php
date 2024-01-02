<?php
// Get raw POST data
$jsonData = file_get_contents('php://input');

// Decode JSON data
$decodedData = json_decode($jsonData, true);
$txt='';
// Check if decoding was successful
if ($decodedData === null && json_last_error() !== JSON_ERROR_NONE) {
    // Handle JSON decoding error
    $txt=  'Error decoding JSON: ' . json_last_error_msg();
} else {
    // Process the received JSON data
    
  $txt= 'Received  data: <br/>';
   // print_r($decodedData);
   
   $txt.='Name : ' . $decodedData['name'] . ' <br/> Email : ' . $decodedData['email']; 
}

$myfile = fopen($decodedData['response_code'].'.txt', "w") or die("Unable to open file!");

fwrite($myfile, $txt);

fclose($myfile);
?>