<?php
//check if there has been something posted to the server to be processed
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $location = $_POST['a_location'];
  $choice = $_POST['a_choice'];

  if($_FILES){
    $fname = $_FILES['filename']['name'];
    $myPackagedData = new stdClass();
    $myPackagedData->location = $location;
    $myPackagedData->choice = $choice;
    $myJSONObj = json_encode($myPackagedData);
    echo $myJSONObj;
    exit;
  }
}
?>
