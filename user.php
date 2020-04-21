<?php
   include "Crud.php";
   class User implements Crud{
	   private $user_id;
       private $first_name;
	   private $last_name;
	   private $city_name;

	   //class constructor
	   function __construct ($first_name,$last_name,$city_name){
		   $this->first_name=$first_name;
		   $this->last_name=$last_name;
		   $this->city_name=$city_name;
	   }
	   //user id setter
	   public function setUserId($user_id){
		   $this->user_id=$user_id;
	   }
	   //user id getter
	   public function getUserId(){
		   return $this->$user_id;

	   }

#the save funtion saves the data to the database
	   public function save(){
		   $fn=$this->first_name;
		   $ln=$this->last_name;
		   $city=$this->city_name;
		   $conne=mysqli_connect('localhost','root','','btc3205');

		   $res= mysqli_query($conne,"INSERT INTO `user`(first_name,last_name,user_city) VALUES('$fn','$ln','$city')")or die("Not Error".mysqli_error());

          return $res;
		  $conne->close();
	   }
     #this is an abstract method and must be declared abstract

	   public function readAll(){
       $fn=$this->first_name;
      $ln=$this->last_name;
      $city=$this->city_name;
      $conne=mysqli_connect('localhost','root','','btc3205');
      $selc="SELECT *FROM user";
      $result=mysqli_query($conne,$selc);

      while ($db_field=mysqli_fetch_assoc($result)){
        print $db_field ['first_name']."<br> ";
        print $db_field ['last_name']."<br> ";
        print $db_field ['user_city']."<br> ";

      }



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
   }

?>
