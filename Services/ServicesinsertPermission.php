<?php
require('ControlPermission.php');
		
	$DTO_permission=new permissionDTO();

	$img = "../uploads/";
	$apk = "../donwload/";

	if(isset($_POST['newNameApp']) && isset($_POST['newAplication']) && isset($_POST['dateInitial']) && isset($_POST['dateFinish']) && isset($_POST['state']))
	{
		$DTO_permission->setName($_POST['newNameApp']);
		$DTO_permission->setAplication($_POST['newAplication']);
		$DTO_permission->setDateInitial($_POST['dateInitial']);
		$DTO_permission->setDateFinish($_POST['dateFinish']);
		$DTO_permission->setState($_POST['state']);
		
		$ControlPermission =new ControlPermission();
		

		$DTO_permission=$ControlPermission->insertPermision($DTO_permission);

		if(count($DTO_permission)>=1)
		{
			//echo json_encode($DTO_permission);
			//header('location: ../gestor.html?permission');
		}
		else
		{
			echo count($DTO_permission);
		}
	}

?>
