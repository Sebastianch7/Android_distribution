<?php 
	require('ControlUser.php');
		
	$ObjDTOUser=new UserDTO();
	if(isset($_POST['inp_mailUsuario']) && isset($_POST['inp_password']))
	{
		$ObjDTOUser->setMail($_POST['inp_mailUsuario']);
		$ObjDTOUser->setPassword($_POST['inp_password']);

		$ControlUser =new ControlUser();
		
		$DTO_user=$ControlUser->selectUser($ObjDTOUser);
		
		if(count($DTO_user)>=1){
		echo json_encode($DTO_user);
		}else{
			echo count($DTO_user);
		}
	}
	
?>