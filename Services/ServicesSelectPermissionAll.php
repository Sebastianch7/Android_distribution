<?php 
	require('ControlPermission.php');
		
	$ControlPermission =new ControlPermission();
	
	$DTO_permission=$ControlPermission->selectPermissionAll();
	
	if(count($DTO_permission)>=1){
	echo json_encode($DTO_permission);
	}
	else
	{
		echo count($DTO_permission);
	}

?>