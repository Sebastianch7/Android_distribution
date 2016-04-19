<?php 
	require('ControlPermission.php');
		
	$DTO_permission=new permissionDTO();

	if(isset($_POST['id']) && isset($_POST['finish']) && isset($_POST['state']))
	{
		$DTO_permission->setId($_POST['id']);
		$DTO_permission->setDateFinish($_POST['finish']);
		$DTO_permission->setState($_POST['state']);

		$ControlPermission =new ControlPermission();
		
		$DTO_permission=$ControlPermission->editPermission($DTO_permission);
		
		if(count($DTO_permission)>=1){
		echo json_encode($DTO_permission);
		}else{
			echo count($DTO_permission);
		}
	}
	
?>