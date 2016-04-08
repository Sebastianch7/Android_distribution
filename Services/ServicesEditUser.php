<?php 
	require('ControlUser.php');
		
	$ObjDTOUser=new UserDTO();

	if(isset($_POST['uName']) && isset($_POST['uPassword']) && isset($_POST['uMail']) && isset($_POST['uState']) && isset($_POST['uRoll']))
	{
		$ObjDTOUser->setName($_POST['uName']);
		$ObjDTOUser->setMail($_POST['uMail']);
		$ObjDTOUser->setPassword($_POST['uPassword']);
		$ObjDTOUser->setRoll($_POST['uRoll']);
		$ObjDTOUser->setState($_POST['uState']);
		
		//echo $ObjDTOUser->getState;
		$ControlUser =new ControlUser();
		
		$DTO_user=$ControlUser->editUser($ObjDTOUser);
		
		if(count($DTO_user)>=1){
		echo json_encode($DTO_user);
		}else{
			echo count($DTO_user);
		}
	}
	
?>