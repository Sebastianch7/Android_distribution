<?php 
	require('ControlUser.php');
		
	$ObjDTOUser=new UserDTO();

	if(isset($_POST['uMail']))
	{
		$ObjDTOUser->setMail($_POST['uMail']);
		
		$ControlUser =new ControlUser();
		
		$DTO_user=$ControlUser->deletUser($ObjDTOUser);
		
		if(count($DTO_user)>=1){
		echo json_encode($DTO_user);
		}else{
			echo count($DTO_user);
		}
	}
	
?>