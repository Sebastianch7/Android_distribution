<?php 
	require('ControlApp.php');

	$DTO_app=new AppDTO();
		
	$ControlApp =new ControlApp();
	
	$DTO_app=$ControlApp->selectAppLaboratory();
	
	if(count($DTO_app)>=1){
	echo json_encode($DTO_app);
	}
	else
	{
		echo count($DTO_app);
	}

?>