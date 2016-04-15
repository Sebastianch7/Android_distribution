<?php
	class AppDTO{
		private $id;
		private $name;
		private $description;
		private $image;
		private $route;
		private $laboratory;
		private $type;
		
		public function __construct(){
			$this->id="";
			$this->description="";
			$this->image="";
			$this->route="";
			$this->laboratory="";
			$this->type="";
		}/*
		public function __construct($name,$surname,$mail,$date){
			$this->firstname=$name;
			$this->lastname=$surname;
			$this->age=$mail;
			$this->dateInsert=$date;
		} */
		public function getId(){
			return $this->id;	
		}	
		public function setId($id){
			$this->id=$id;	
		}
		public function getName(){
			return $this->name;	
		}	
		public function setName($name){
			$this->name=$name;	
		}
		public function getDescription(){
			return $this->description;	
		}	
		public function setDescription($description){
			$this->description=$description;	
		}
		public function getImage(){
			return $this->image;	
		}	
		public function setImage($image){
			$this->image=$image;	
		}
		public function getRoute(){
			return $this->route;	
		}	
		public function setRoute($route){
			$this->route=$route;	
		}
		public function getLaboratory(){
			return $this->laboratory;	
		}	
		public function setaboratory($laboratory){
			$this->laboratory=$laboratory;	
		}
		public function getType(){
			return $this->type;	
		}	
		public function setType($type){
			$this->type=$type;	
		}
	}
?>
