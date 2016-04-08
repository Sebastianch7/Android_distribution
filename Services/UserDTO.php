<?php
	class UserDTO{
		private $firstname;
		private $mailUser;
		private $password;
		private $state;
		private $dateInsert;
		private $roll;
		
		public function __construct(){
			$this->firstname="";
			$this->mailUser="";
			$this->password="";
			$this->state="";
			$this->dateInsert="";
			$this->roll="";
		}
		/*public function __construct($name,$surname,$mail,$date){
			$this->firstname=$name;
			$this->lastname=$surname;
			$this->age=$mail;
			$this->dateInsert=$date;
		} */
		public function getName(){
			return $this->firstname;	
		}	
		public function setName($name){
			$this->firstname=$name;	
		}
		public function getMail(){
			return $this->mailUser;	
		}	
		public function setMail($mail){
			$this->mailUser=$mail;	
		}
		public function getDateInsert(){
			return $this->dateInsert;	
		}	
		public function setDateInsert($dateInsert){
			$this->dateInsert=$dateInsert;	
		}
		public function getPassword(){
			return $this->password;	
		}	
		public function setPassword($password){
			$this->password=$password;	
		}
		public function getRoll(){
			return $this->roll;	
		}	
		public function setRoll($roll){
			$this->roll=$roll;	
		}
		public function getState(){
			return $this->state;	
		}	
		public function setState($state){
			$this->state=$state;	
		}
	}
?>
