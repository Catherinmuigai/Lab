<?php
   include "crud.php";
   include "authenticator.php";
   class user implements Crud,Authenticator {
	   private $user_id;
     private $first_name;
	   private $last_name;
	   private $city_name;

     private $username;
     private $password;

	   //class constructor
	   function __construct ($first_name,$last_name,$city_name, $username,$password){
		   $this->first_name=$first_name;
		   $this->last_name=$last_name;
		   $this->city_name=$city_name;
       $this->username=$username;
       $this->password=$password;
	   }

     public static function create(){
       $instance =new self();
       return $instance;
     }

     public function setUsername($username){
      $this->username=$username;
    }

    public function getUsername(){
      return $this->username;

    }

    public function setPassword($password){
     $this->password=$password;
   }

   public function getPassword(){
     return $this->password;

   }

	   //user id setter
	   public function setUserId($user_id){
		   $this->user_id=$user_id;
	   }
	   //user id getter
	   public function getUserId(){
		   return $this->user_id;

	   }

#the save funtion saves the data to the database
	   public function save(){
		   $fn=$this->first_name;
		   $ln=$this->last_name;
		   $city=$this->city_name;
       $uname= $this->username;
       // $hash=$this->hashPassword;
       $pass= $this->password;
		   $conne=mysqli_connect('localhost','root','','btc3205');
       if (!$conne) {
    die("Connection failed: " . mysqli_connect_error());
}

		   $sql= mysqli_query($conne,"INSERT INTO `user`(first_name,last_name,user_city,username,password) VALUES('$fn','$ln','$city','$uname','$pass')");//or die("DB Error".mysqli_connect_error());

        if (mysqli_query($conne, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conne);
        }

          return $sql;
		  $conne->close();
	   }
     #this is an abstract method and must be declared abstract

	   // public function readAll(){
     //   $fn=$this->first_name;
     //  $ln=$this->last_name;
     //  $city=$this->city_name;
     //  $conne=mysqli_connect('localhost','root','','btc3205');
     //  $selc="SELECT *FROM user";
     //  $result=mysqli_query($conne,$selc);
     //
     //  while ($db_field=mysqli_fetch_assoc($result)){
     //    print $db_field ['first_name']."<br> ";
     //    print $db_field ['last_name']."<br> ";
     //    print $db_field ['user_city']."<br> ";
     //
     //  }

     //
     //
	   // }
     public function readAll(){
      return null;
    }

	    public function readUnique(){
		   return null;
	   }

	    public function search(){
		   return null;
	   }

        public function update(){
		   return null;
	   }

	    public function removeOne(){
		   return null;
	   }
	    public function removeAll(){
		   return null;
	   }
      public function validateForm(){
        $fn=$this->first_name;
        $ln =$this->last_name;
        $city=$this->city_name;

        if($fn == "" || $ln == "" || $city == ""){
          return false;

        }
        return true;
      }
      public function createFormErrorSessions(){
        session_start();
        $_SESSION ['form_errors'] ="All fields are required";
      }
      public function hashpassword(){
        $this->password=password_hash($this->password,PASSWORD_DEAFULT);

      }
      public function isPasswordCorrect(){
        $con = new DBConnector;
        $found=false;
        $res= mysqli_query("SELECT *FROM user") or die("Error".mysqli_error());


        while ($row=mysqli_fetch_array($res)){
          if(password_verify($this->getPassword(),$row['password']) && $this->getUsername()== $row['username']){
              $found =true;
          }
        }
        $con->closeDatabase();
        return $found;
      }
      public function login(){
        if($this->isPasswordCorrect()){
          header ("Location:private_page.php");
        }
      }
      public function createUserSession(){
        session_start();
        $_SESSION['username']=$this->getUsername();
      }
      public function logout(){
        session_start();
        unset($_SeSSION['username']);
        session_destroy();
        header("Location:lab1.php");
      }
   }

?>
