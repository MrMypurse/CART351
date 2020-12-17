<?php
//check if there has been something posted to the server to be processed
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $location = $_POST['a_location'];
  $choice = $_POST['a_choice'];

    $myPackagedData = new stdClass();
    $myPackagedData->LocationInCanada = $location;
    $myPackagedData->ChoiceOfCompost = $choice;
    $myJSONObj = json_encode($myPackagedData);
    echo $myJSONObj;
    exit;
}
?>

<html>
<head>
  <title>CART 351 FINAL PROJECT HOME PAGE</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
</head>

<style>
body{
  width: 100%;
  height: auto;
}
#headerImage {
  display: grid;
  position: relative;
  width: 100%;
  height: auto;
}

.column {
  position: relative;
  float: left;
  width: 33.33%;
  height: 500px;
  align-items: center;
  background-color: #effaea;
}

#geoLogo, #statLogo, #gameLogo{
  position: relative;
  top: 15%;
  left: 15%;
  box-shadow: 5px 5px 5px #ccc;
  width: 300px;
  height: 300px;
}
#geoLogo:hover{
  content: url("images/logo_geospacial_hover.png");
  width: 300px;
  height: 300px;
}

#statLogo:hover{
  content: url("images/logo_statistical_hover.png");
  width: 300px;
  height: 300px;
}

#gameLogo:hover{
  content: url("images/logo_game_hover.png");
  width: 300px;
  height: 300px;
}

#popupForm{
  color: black;
  background-color: #D0F0C0;
  text-align: center;
  display: none;
}

#enterButton{
  color: white;
  background-color: #2C5F2D;
  width: 70px;
  height: 30px;
}

#enterButton:hover{
  background-color: white;
  color: black;
}
footer{
  height: auto;
}

#result{
  color: #684b3c;
  font-size: 20px;
  position: relative;
  left: 10%;

}
</style>



<body>

  <!--the navigation bar on top with drop down -->
  <div class="navigation">
    <button class="dropbtn"><a href="index.php">HOME</a></button>
    <div class="dropdown" style="float:right">
      <button class="dropbtn">Data Visualization</button>
      <div class="dropdown-content">
        <a href="study.php">In Canada</a>
      </div>
    </div>
    <div class="dropdown" style="float:right">
      <button class="dropbtn">How to Compost</button>
      <div class="dropdown-content">
        <a href="howto.html">Compost Tips</a>
        <a href="game.html">Mini Game</a>
      </div>
    </div>
    <div class="dropdown" style="float:right">
      <button class="dropbtn">About</button>
      <div class="dropdown-content">
        <a href="aboutproject.html">This Project</a>
        <a href="aboutcreator.html">The Creator</a>
      </div>
    </div>
  </div>

  <!-- the pop up div -->
  <div id="popupBox">
    <!-- new:: the form for adding new... -->
    <form id="popupForm" action = "">
    <fieldset>
      <label> Welcome. Please answer the questions below to start: </label>
      <p>Which province/territory are you currently resident in Canada?
      <input type="text" maxlength="40" name="a_location" required></p>
      <!--<p><select name="a_location" id="location">
        <option value="al">Alberta</option>
        <option value="bc">British Columbia</option>
        <option value="mb">Manitoba</option>
        <option value="nb">New Brunswick</option>
        <option value="nl">Newfoundland and Labrador</option>
        <option value="ns">Nova Scotia</option>
        <option value="nt">Northwest Territories</option>
        <option value="nu">Nunavut</option>
        <option value="on">Ontario</option>
        <option value="pe">Prince Edward Island</option>
        <option value="qc">Quebec</option>
        <option value="sk">Saskatchewan</option>
        <option value="yt">Yukon</option>
      </select> </p>-->
      <p>Does your household compost organic wastes regularly?
      <input type="text" maxlength="200" name="a_choice" required></p>
      <!--<p><select name="a_choice" id="choice">
        <option value="yes">Yes, we compost our waste regularly.</option>
        <option value="maybe">Yes, but only occasionaly.</option>
        <option value="no">No, we do not compost at all.</option>
      </select> </p>-->
      <p><input type="submit" name="enter" value="Enter" id="enterButton" dismiss="#popupForm"></p>
    </fieldset>
    </form>
  </div>


  <!-- the header div -->
  <header id="headerImage">
    <img id="soil" src="images/Home_soil.svg">
  </header>
  <div id="result"></div>
  <div>
  <div class="column">
    <a href="study.php"><img id="geoLogo" src="images/logo_geospacial.png">
    </a>
  </div>
  <div class="column">
    <a href="howto.html"><img id="statLogo" src="images/logo_statistical.png">
    </a>
  </div>
  <div class="column">
    <a href="game.html"><img id="gameLogo" src="images/logo_game.png" >
    </a>
  </div>
</div>
<!-- the footer div -->
<footer>
  <div>
  <p>Created by Janet Sun. Concordia University. Fall 2020. </p>
</div>
</footer>
</body>


<script>
$(document).ready(function(){
  setTimeout(popUp, 500);
  console.log("in script");

  $("#popupForm").submit(function(event){
    event.preventDefault();
    console.log("CLICKED");
    let form= $('#popupForm')[0];
    let data = new FormData(form);
    $(this).closest(".ui-dialog-content").dialog("close");

    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "index.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      tieout: 600000,
      success: function(response){
        console.log("SUCCESS!");
        console.log(response);
        let parsedJSON = JSON.parse(response);
        console.log(parsedJSON);
        displayResponse(parsedJSON);
      },
      error:function(){
        conosole.log("ERROR!");
      }
    });
  });

function popUp(){
  console.log("formLoaded");
  $( "#popupForm" ).dialog({
    modal: true
});
}


function displayResponse(theResult){
      let container = $('<div>').addClass("outer");
      let title = $('<h1>');
      $(title).text("You answered:");
      $(title).appendTo(container);
      let contentContainer = $('<div>').addClass("content");
      for (let property in theResult){
        console.log(property);
          let para = $('<p>');
          $(para).text(property+ ":  " + theResult[property]);
         $(para).appendTo(contentContainer);
       }
      $(contentContainer).appendTo(container);
      $(container).appendTo("#result");
    }
});

</script>

</html>
