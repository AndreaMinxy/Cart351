<?php
//check if there has been something posted to the server to be processed
//let's add colour and size as a starting point
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
//here are the arrays for the word variables
    $sampleDataAsIfInAFile = array("smarties","twix","snickers","maltesers","flake","wunderbar","mars");
    $sampleDataAsIfInAFile2 = array("oranges","apples","peppers","carrots","grapes","grapefruits","kumquats");
// need to process -> we could save this data ...
 $xPos = $_POST['xpos'];
 $yPos = $_POST['ypos'];
 $action = $_POST['action'];
 //new code!
 $colour = $_POST['colour'];
 $size= $_POST['size'];
 //do some silly processing:
 $newPos = $xPos+$yPos;
 //lets choose a word from our "data file" based on the sum of the x and y pos...
 //there are 2 possible actions choose the word depending on action...
 if($action =="theButton"){
 $dataToSend =  $sampleDataAsIfInAFile[$newPos%count($sampleDataAsIfInAFile)];
}
else{
  $dataToSend =$sampleDataAsIfInAFile2[$newPos%count($sampleDataAsIfInAFile2)];;
}

    //package the data and echo back...
    $myPackagedData=new stdClass();
    $myPackagedData->word = $dataToSend;
     // Now we want to JSON encode these values to send them to $.ajax success.
    $myJSONObj = json_encode($myPackagedData);
    echo $myJSONObj;
    exit;
}//POST
?>

<!DOCTYPE html>
<html>
<head>
<title>USING JQUERY AND AJAX AND CANVAS </title>
<!-- get JQUERY -->
  <script src = "libs/jquery-3.3.1.min.js"></script>
<style>
body{
  margin:0;
  padding:0;
}
canvas{
  background:black;
  margin:0;
  padding:0;
}
#b{
  background:purple;
  color:white;
  margin:5px;
  text-align: center;
  padding: 5px;
  width:10%;
}
</style>
</head>


<body>
<div id = "b"><p>CLICK BUTTON</p></div> <!--this is the button-->

<canvas id="myCanvas" width=500 height=500></canvas> <!--we just defined our canvas id here-->
<!-- here we put our JQUERY -->
<script>
$(document).ready (function(){
  //declare some global vars ...
  //rectangle variables
  let x =10;
  let y =10;

  //Where is the array to fill these variables? Do the empty quotation marks mean that
  //anything can be put there?#
  let theWord = "";
  let theWord2 = "";
  //start ani
  goAni();
  // when we click on the canvas somewhere and the collision detection returns true ...

  $('#myCanvas').on("mousedown",function(event){
  //  console.log("mouseover on canvas");
    let truth = checkCollision(event); //check if the collision has happened i.e. it's true
    if(truth ===true){
      //our function for sending data
      sendData("theCanvas");
    }
  });
  // if we click on the button other stuff happens ...
    $( "#b" ).click(function( event ) {
      //stop submit the form, we will post it manually. PREVENT THE DEFAULT behaviour ...
       event.preventDefault();
       console.log("button clicked");
       sendData("theButton"); 

     });

     function sendData(typeOfClick){ //not sure how to read this code?# This obtains the data being clicked on and the other stuff
       let data = new FormData();
       data.append('action', typeOfClick);
       data.append('xpos', x);
       data.append('ypos', y);
       //new code!
       data.append('colour',fillStyle);
       data.append('size', width);

       $.ajax({
             type: "POST",
             enctype: 'multipart/form-data',
             url: "PHPEx.php",
             data: data,
             processData: false,//prevents from converting into a query string
             contentType: false,
             cache: false,
             timeout: 600000,
             success: function (response) {
             //reponse is a STRING (not a JavaScript object -> so we need to convert)
             console.log(response);
             //use the JSON .parse function to convert the JSON string into a Javascript object
             let parsedJSON = JSON.parse(response);
             console.log(parsedJSON);
             if(typeOfClick ==="theButton"){
             theWord = parsedJSON.word;
           }
           else {
              theWord2 = parsedJSON.word;
           }

         },
         error:function(){
           console.log("error occured");
         }
       });
     } //end sendData

    function goAni(){
      let canvas = document.getElementById('myCanvas');
      let canvasContext = canvas.getContext('2d');


      requestAnimationFrame(runAni);

     function runAni(){
     //need to reset the background :)
     // clear the canvas ...
     canvasContext.clearRect(0, 0, canvas.width, canvas.height);
     canvasContext.fillStyle = "#ff0000";
     canvasContext.beginPath();
     canvasContext.arc(x,y,20,0,2*Math.PI);
     canvasContext.stroke();
     canvasContext.fill();

     x+=0.2;
     y+=0.2;
     canvasContext.font = "40px Arial";
     canvasContext.fillStyle = "#B533FF";
     canvasContext.fillText(theWord,canvas.width/2 - (theWord.length/2*20),canvas.height/2);


     canvasContext.fillStyle = "#FF9033";
     canvasContext.fillText(theWord2,canvas.width/2 - (theWord2.length/2*20),canvas.height/4);
     requestAnimationFrame(runAni);
   }

 } //this is all animation guidelines

  function checkCollision(event){
    let domEll = document.getElementById("myCanvas").getBoundingClientRect();
     if(x>event.clientX-20 && x<event.clientX+20 && y >(event.clientY-domEll.top)-20 && y<((event.clientY-domEll.top)+20))
    {
      return true;
    }
    return false;
  }
}); //document ready
</script>
</body>
</html>
