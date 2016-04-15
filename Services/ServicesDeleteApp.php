<?php 
	require('ControlUser.php');
		
	$ObjDTOApp=new AppDTO();

	if(isset($_POST['id']))
	{
		$ObjDTOApp->setMail($_POST['uMail']);
		
		$ControlUser =new ControlUser();
		
		$DTO_user=$ControlUser->deletUser($ObjDTOApp);
		
		if(count($DTO_user)>=1){
		echo json_encode($DTO_user);
		}else{
			echo count($DTO_user);
		}
	}
	
?>