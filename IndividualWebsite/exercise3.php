<?php
//check if there has been something posted to the server to be processed
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
  // if the form was submitted ...
  if($_GET['nameType']){
    //assign the variables
    $x = $_GET['nameType'];
    $y = $_GET['nameQuantity'];
    $z = $_GET['nameTime'];
    $w = $_GET['nameMood'];
    $h = $_GET['nameDuration'];

    // NEXT:: need to read the entire JSON file into an array
    //- append our new object AND then write back the contents to the file...

    //1: use an associative array to structure our shape data ...
    $newShapeArray = array(
                'x' => $x,
                'y' => $y,
                'z' =>$z,
				        'w' =>$w,
        	      'h' =>$h
            );

                //open or read json data
                $data_results = file_get_contents('teaTime.json');
                //put into an array (DECODE)
                $tempArray = json_decode($data_results);

                //append additional array to json file
                $tempArray[]=$newShapeArray;
                //save in JSON format (ENCODE)
                $jsonData = json_encode($tempArray);
                //save to the file
                file_put_contents('teaTime.json', $jsonData);
                // ***resend the headers and reload the page (to clear the GET request)
                header("Location: /exercise3.php");
                //NOW... everytime data is submitted
                //and the page reloads and reads from JSON file we have another shape...
  }
}
?>

<html>
  <head>
    <meta charset="utf-8">
   <title>CART 351 EXERCISE 3</title>
   <link rel="stylesheet" type="text/css" href="css/sub.css">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style>
  header{
    text-align: center;
    margin-top:7%;
  }
  label{
   font-size: 36px;
  }
  .searchBox{
  text-align: center;
  }

  .displayDay{
  text-align: center;
  }

  .displayNew{
  text-align: center;
  }

  .btn{
  display: flex;
  vertical-align: middle;
  }
  </style>

  <!--the navigation bar on top with drop down-->
  <div class="navigation">
     <button class="dropbtn"><a href="index.html">HOME</a></button>
    <div class="dropdown" style="float:right">
      <button class="dropbtn">EXERCISES</button>
      <div class="dropdown-content">
        <a href="exercise1a.html">0001A</a>
        <a href="exercise1b.html">0001B</a>
        <a href="exercise2.html">0002</a>
        <a href="exercise3.php">0003</a>
        <a href="exercise4.php">0004</a>
        <a href="exercise5.html">0005</a>
        <a href="exercise6.html">0006</a>
        <a href="exercise7.html">0007</a>
        <a href="exercise8.html">0008</a>
      </div>
    </div>
    <div class="dropdown"style="float:right">
      <button class="dropbtn">REFLECTIONS</button>
      <div class="dropdown-content">
        <a href="reflection1.html">0001</a>
        <a href="reflection2.html">0002</a>
        <a href="reflection3.html">0003</a>
        <a href="reflection4.html">0004</a>
      </div>
    </div>

    <div class="dropdown"style="float:right">
      <button class="dropbtn">PRESENTATIONS</button>
      <div class="dropdown-content">
        <a href="presentation1.html">TECHNICAL</a>
        <a href="presentation2.html">RESEARCH</a>
      </div>
    </div>

    <div class="dropdown"style="float:right">
      <button class="dropbtn">PROJECT</button>
      <div class="dropdown-content">
        <a href="proposal.html">PROPOSAL</a>
        <a href="prototype.html">PROTOTYPE</a>
        <a href="final.html">FINAL</a>
      </div>
    </div>

  </div>

  <script>

  $(document).ready(function(){
  console.log("ready");
  let days = [];
  let searchItem;
  let daysSingleDay;
  let daysSingle;
  let selectType;
  let selectQuantity;
  let selectTime;
  let selectMood;
  let selectDuration;
  let typeValue;
  let quantityValue;
  let timeValue;
  let moodValue;
  let durationValue;

  //assign call back to click event ...
  let firstTime = true;
  let pContainer = $(".wrapper")[0];
  $("#searchButton").click(getSearch);
  $("#searchButton").click(getTea);
  /**** function callback from button ***/

  function getSearch(){
    searchItem = $("#searchText").val();
    console.log(searchItem);
  }

function getTea(){
$.getJSON('teaTime.json', function(data){
 days = data;
 console.log(days);

for(let outer_index = 0; outer_index<days.length; outer_index++){
 daysSingle = days[outer_index];
 console.log(daysSingle);
 daysSingleDay = days[outer_index].Day;
 console.log(daysSingleDay);

 if(searchItem === daysSingleDay){
   console.log("yay");
   displaySingle(daysSingle);
}
}
})
}

function displaySingle(){
  selectType = (days[searchItem-1].Type).toString();
  $("#displayType").text(selectType);
  selectQuantity = (days[searchItem-1].Quantity).toString();
  $("#displayQuantity").text(selectQuantity);
  selectTime = (days[searchItem-1].Time).toString();
  $("#displayTime").text(selectTime);
  selectMood = (days[searchItem-1].Mood).toString();
  $("#displayMood").text(selectMood);
  selectDuration = (days[searchItem-1].Duration).toString();
  $("#displayDuration").text(selectDuration);
}

})


  </script>

 </head>
  <body>
    <div class=searchBox>
    <header>
      <label> MY TEA HABITS?</label>
    </header>
      <p> SEARCH 1 - 4 TO FIND OUT </p>
      <br>
    <input type="text" id="searchText" value="SEARCHITEM" />
    <input type="button" value="SEARCH!" id="searchButton" />
    </p>
    </div>
    <div class= "displayDay">
      <div id = "displayType"><p>Type</p>  </div>
      <div id = "displayQuantity"><p>Quantity</p> </div>
      <div id = "displayTime"> <p>Time </p> </div>
      <div id = "displayMood"> <p>Mood </p> </div>
      <div id = "displayDuration"> <p>Duration</p> </div>
    </div>
    <br>
    <div class= "displayNew">
      <label>DOCUMENT YOUR TEA:</label><br>
     <!-- new:: the form for adding new... -->
     <form method="get" action="exercise3.php">
       <p>TYPE:<input type="text" name="nameType" value="ENTER TYPE" /></p>
       <p>QUANTITY:<input type="text" name="nameQuantity" value="ENTER QUANTITY" /></p>
       <p>TIME:<input type="text" name="nameTime" value="ENTER TIME" /></p>
       <p>MOOD:<input type="text" name="nameMood" value="ENTER MOOD" /></p>
       <p>DURATION:<input type="text" name="nameDuration" value="ENTER DURATION" /></p>
       <p><input type="button" name="enter" value="ENTER!" id="enterButton" /></p>
     </form>
   </div>
</body>
</html>
