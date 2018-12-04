<?php
// all the php goes here
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  
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
<div id = "b1"><p>Male</p></div> <!--this is the button-->
<div id = "b2"><p>Female</p></div> <!--this is the button-->
<div id = "b3"><p>Other</p></div> <!--this is the button-->



<script>
$('#b1').click(function( event ){
console.log("button 1 clicked");

    //our function for sending data
    sendData("b1"); //the first button si being sent as data to php

});

// if we click on the button other stuff happens ...
  $( "#b2" ).click(function( event ) {
    //stop submit the form, we will post it manually. PREVENT THE DEFAULT behaviour ...
     event.preventDefault();
     console.log("button 2 clicked");
     sendData("b2"); //where do we define "theButton"?# HERE
   });

   $( "#b3" ).click(function( event ) {
     //stop submit the form, we will post it manually. PREVENT THE DEFAULT behaviour ...
      event.preventDefault();
      console.log("button 3 clicked");
      sendData("b3"); //where do we define "theButton"?# HERE
    });
</script>
   </body>
 </html>
