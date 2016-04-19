<?php
	class permissionDTO{
		private $id;
		private $name;
		private $aplication;
		private $DateInitial;
		private $DateFinish;
		private $state;
		
		public function __construct(){
			$this->id="";
			$this->name="";
			$this->aplication="";
			$this->DateInitial="";
			$this->DateFinish="";
			$this->state="";
		}

		public function setId($id){
			$this->id=$id;	
		}
		public function getId(){
			return $this->id;	
		}
		public function setName($name){
			$this->name=$name;		
		}	
		public function getName(){
			return $this->name;	
		}
		public function setAplication($aplication){
			$this->aplication=$aplication;	
		}
		public function getAplication(){
			return $this->aplication;
		}	
		public function setDateInitial($DateInitial){
			$this->DateInitial=$DateInitial;	
		}
		public function getDateInitial(){
			return $this->DateInitial;	
		}	
		public function setDateFinish($DateFinish){
			$this->DateFinish=$DateFinish;	
		}
		public function getDateFinish(){
			return $this->DateFinish;	
		}	
		public function setState($state){
			$this->state=$state;	
		}
		public function getState(){
			return $this->state;	
		}	
	}
?>
