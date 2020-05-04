<?php

include_once 'DBConnector.php';
include_once 'user.php';
$con=new DBConnector;//database connection

 if(isset($_POST['btn-save'])){
	 $first_name=$_POST['first_name'];
	 $last_name=$_POST['last_name'];
	 $city=$_POST['city_name'];
   $username= $_POST['username'];
   $password= $_POST['password'];
###########################################################
   $instance= new User($first_name,$last_name,$city,$username,$password);
   if($instance->isPasswordCorrect()){
     $instance->createUserSession();
     $instance->login();
     die();
   }else{
     $error=3;
     $instance->createFormErrorSessions($error);
     header "Refresh:0");
     die();
   }

################################################################


	 //create new user
	 $user = new User($first_name,$last_name,$city,$username,$password);
   if(!$user->validateForm()){
     $user->createFormErrorSessions();
     header("Refresh:0");
     die();
   }
	 $res=$user->save();


	 if($res){
		 echo "save operation was succesfull";

	 }
	 else{
		 echo "An error has occured!";
	 }
$con->closeDatabase();
 }
 // $user=new User($first_name,$last_name,$city);
 //  $res=$user->readAll();

?>




	<html>
        <head>
         <title>UserDetails</title>
         <script type ="text/javascript" src="validate.js"></script>
         <link rel="stylesheet" type="text/css" href="validate.css">
       </head>
       <body>
           <form method ="post" name ="user_details" id="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
	            <table align="center">
                <tr>
                  <td>
                    <div id ="form-errors">
                      <?php
                      session_start();
                      if(!empty($_SESSION['form_errors'])){
                        echo " ". $_SESSION['from_errors'];
                        unset($_SESSION['form_errors']);
                      }
                       ?>
                  </td>
                </tr>
	              <tr>
		               <td><input type="text" name="first_name"required placeholder="First Name"/></td>
                 </tr>
		            <tr>
		                <td><input type="text" name="last_name"placeholder="Last Name"/></td>
	                </tr>
		            <tr>
		                <td><input type="text" name="city_name" placeholder="City"/></td>
	                </tr>

                  <tr>
  		                <td><input type="text" name="username" placeholder="Username"/></td>
  	                </tr>
                      <tr>
      		                <td><input type="password" name="password"placeholder="Password"/></td>
      	                </tr>

  		            <tr>
		                <td><button type="submit" name="btn-save"><strong>SAVE</button></td>
	                </tr>
                    <tr>
    		                <td><a href="Login.php"</a></td>
    	                </tr>

	            </table>
             </form>
	    </body>
	</html>
