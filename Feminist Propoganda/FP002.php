<?php
// all the php goes here
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
//we need to assign the data being pushed to a key that can be used to generate an output
//for now let's use colour arrays
$colourList = array("red","green","blue","orange");
$colourList2 = array("#ffff99","#ff3399","#e6e6ff","#ffebcc");

$action = $_POST['action'];
//lets choose a colour from our "data file" based on
//there are 2 possible actions choose the word depending on action...
if($action =="b1"){
$dataToSend =  $colourList[($colourList)]; //how do I decide which colour I want to choose?#
}
else{
 $dataToSend =$colourList2[$newPos%count($colourList2)];
}

}
 ?>

 <!-- end of php -->

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title> Feminist Propaganda</title>
     <!-- get JQUERY -->
       <script src = "libs/jquery-3.3.1.min.js"></script>
       <link rel="stylesheet" href="style.css">

       </script>
   </head>

    <!-- end of head-->
   <body>
<h2> What is your gender?</h2>
<div id = "b1"><p>Male</p></div>
<div id = "b2"><p>Female</p></div>
<div id = "b3"><p>Other</p></div>



<script>
//define some variables
//defines the colour that will change
let theColour = "";
let theColour2 = "";

$('#b1').click(function( event ){
console.log("button 1 clicked");
//stop submit the form, we will post it manually. PREVENT THE DEFAULT behaviour ...
   event.preventDefault();
    //our function for sending data
    sendData("b1"); //the first button si being sent as data to php

});

// if we click on the button other stuff happens ...
  $( "#b2" ).click(function( event ) {
    //Can we go over this event again?#
    //stop submit the form, we will post it manually. PREVENT THE DEFAULT behaviour ...
     event.preventDefault();
     console.log("button 2 clicked");
     sendData("b2"); //where do we define "theButton"?# HERE
   });

   $( "#b3" ).click(function( event ) {
     //stop submit the form, we will post it manually. PREVENT THE DEFAULT behaviour ...
      event.preventDefault();
      console.log("button 3 clicked");
      sendData("b3");
    });

    function sendData(typeOfClick){ // This obtains the data being clicked on
      let data = new FormData();
      data.append('action', typeOfClick);

//translation to AJAX
      $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "FP002.php",
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
            //how can I incorporate this if I have three options?#
            if(typeOfClick ==="b1"){
            theColour = parsedJSON.word; //this is all ouput and needs to be changed
          }
          else {
             theColour2 = parsedJSON.word;
          }

        },
        error:function(){
          console.log("error occured");
        }
      });
    } //end sendData
</script>
   </body>
 </html>
