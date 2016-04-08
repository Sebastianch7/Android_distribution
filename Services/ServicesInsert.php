<?php
	require('ControlUser.php');

	
	if(isset($_POST['uName']) && isset($_POST['uPassword']) && isset($_POST['uMail']) && isset($_POST['uState']) && isset($_POST['uRoll']))
	{		
		$ObjDTOUser=new UserDTO();
		$ObjDTOUser->setName($_POST['uName']);
		$ObjDTOUser->setMail($_POST['uMail']);
		$ObjDTOUser->setPassword($_POST['uPassword']);
		$ObjDTOUser->setRoll($_POST['uRoll']);
		$ObjDTOUser->setState($_POST['uState']);
		$ObjDTOUser->setDateInsert(date("Y/m/d"));
				
		$ObjControlUser=new ControlUser();

		$result=$ObjControlUser->insertUser($ObjDTOUser);
	}
	else 
	{
		$result='FALSE';
	}
	echo $result;
?>
