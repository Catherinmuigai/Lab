<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location:login.php");
  }
 ?>

 <html>
 <head>
   <title>Tiltle goes here</title>
   <script type ="text/javascript" src="validate.js"></script>
   <link rel="stylesheet" type="text/css" href="validate.css">
 </head>
 <body>
   <p>This ia a private page</p>
   <p>We want table to protect it</p>
   <p><a href="logout.php"></a></p>
 </body>
 </html>
