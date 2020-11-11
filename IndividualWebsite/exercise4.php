<?php
//check if there has been something posted to the server to be processed
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $subject = $_POST['a_subject'];
  $area = $_POST['a_area'];
  $description = $_POST['a_description'];

  if($_FILES){
    //echo "file name: ".$_FILES['filename']['name']."<br>";
    //echo "path to file uploaded: ".$_FILES['filename']['tmp_name']."<br>";
    $fname = $_FILES['filename']['name'];
    move_uploaded_file($_FILES['filename']['tmp_name'],"images/".$fname);
    //echo "<br>Stored in: ". "images/" .$fname."<br>";
    $myPackagedData = new stdClass();
    $myPackagedData->subject = $subject;
    $myPackagedData->area = $area;
    $myPackagedData->descrption = $description;
    $myPackagedData->fileName = $fname;
    $myJSONObj = json_encode($myPackagedData);
    echo $myJSONObj;
    exit;
  }

}
?>
<html>
  <head>
    <title>CART 351 EXERCISE 4</title>
    <link rel="stylesheet" type="text/css" href="css/sub.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>
  <style>
  header{
    text-align: center;
    margin-top:20%;
    margin-left: 30%;
  }

  .formContainer{
    position: relative;
    text-align: center;
  }

  label{
    font-size: 60px;
    text-align: center;

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


<body>
  <br>
  <div class="formContainer">
    <form id ="insertGallery">
        <label> SUBMIT YOUR TATTOO INQUIRY </label>
    <fieldset>
      <p>SUBJECT <input type="text" maxlength="40" name="a_subject" required></p>
      <p>SIZE <select name="size" id="size">
        <option value="3in">3 inch</option>
        <option value="5in">5 inch</option>
        <option value="7in">7 inch</option>
      </select> </p>
      <p>COLOR <select name="color" id="color">
        <option value="color">colors</option>
        <option value="black">black and grey</option>
      </select></p>
      <p>AREA <input type="text" maxlength="40" name="a_area" required></p>
      <p>DESCRIPTION <textarea type="text" rows="4" cols="50" name="a_description" required></textarea></p>
      <p>UPLOAD IMAGE <input type="file" name="filename" size=10 required/></p>
      <p class="sub"><input type="submit" name="submit" value="SUBMIT MY INFO" id=buttonS/></p>
    </fieldset>
  </form>
</div>
<div class="result">
</div>
</body>

<script>
    $(document).ready(function(){
      $("#insertGallery").submit(function(event){
        event.preventDefault();
        console.log("CLICKED");
        let form= $('#insertGallery')[0];
        let data = new FormData(form);

        $.ajax({
          type: "POST",
          enctype: 'multipart/form-data',
          url: "exercise4.php",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          tieout: 600000,
          success: function(response){
            console.log("SUCCESS!");
            console.log("response");
            let parsedJSON = JSON.parse(response);
            console.log(parsedJSON);
            displayResponse(parsedJSON);
          },
          error:function(){
            conosole.log("ERROR!");
          }
        });

      });

      function displayResponse(theResult){
        let container = $('<div>').addClass("outer");
        let title = $('<h3>');
        $(title).text("SUBMISSION FROM USER");
        $(title).appendTo(container);
        let contentContainer = $('<div>').addClass("content");
        for (let property in theResult){
          console.log(property);
          if (property === "fileName"){
            let img = $("<img>");
            $(img).attr('src','images/'+ theResult[property]);
            $(img).appendTo(contentContainer);
         }
          else{
            let para = $('<p>');
            $(para).text(property+"::" + theResult[property]);
           $(para).appendTo(contentContainer);
         }
        }
        $(contentContainer).appendTo(container);
        $(container).appendTo(".result");
      }

})


</script>

</html>
