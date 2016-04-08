<?php 
	require('ControlUser.php');
	$ObjDTOUser=new UserDTO();
	$Validate=FALSE;
	$type=0;
	if(isset($_REQUEST['name'])){
		
		$ObjDTOUser->setFirstname($_REQUEST['name']);
		$Validate=TRUE;
		$type=0;
	}
	else if(isset($_REQUEST['surname'])){

		$ObjDTOUser->setLastname($_REQUEST['surname']);
		$Validate=TRUE;
		$type=1;
	}
	else if(isset($_REQUEST['mail'])){
	
		$ObjDTOUser->setMail($_REQUEST['mail']);
		$Validate=TRUE;
		$type=2;
	}
	else{
		echo 'FALSE';
	}
	if($Validate){
		$ControlUser =new ControlUser();
		
		$DTO_user=$ControlUser->selectTypeData($ObjDTOUser,$type);
		
		if(count($DTO_user)>=1){
		echo json_encode($DTO_user);
		}else{
			echo 'FALSE';
		}
	}
	
?>