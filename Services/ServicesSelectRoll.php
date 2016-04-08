<?php 
	require('ControlUser.php');
		
	$ControlUser =new ControlUser();
	
	$DTO_user=$ControlUser->selectUserRoll();
	
	if(count($DTO_user)>=1){
	echo json_encode($DTO_user);
	}
	else
	{
		echo count($DTO_user);
	}

?>