<?php 
	require('ControlApp.php');
		
	$DTO_app=new AppDTO();


	if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['image']) && isset($_POST['route']) && isset($_POST['laboratory']) && isset($_POST['type']))
	{
		$DTO_app->setId($_POST['id']);
		$DTO_app->setName($_POST['name']);
		$DTO_app->setDescription($_POST['description']);
		$DTO_app->setImage($_POST['image']);
		$DTO_app->setRoute($_POST['route']);
		$DTO_app->setaboratory($_POST['laboratory']);
		$DTO_app->setType($_POST['type']);
		$ControlApp =new ControlApp();
		
		$DTO_app=$ControlApp->editApp($DTO_app);
		
		if(count($DTO_app)>=1){
		echo json_encode($DTO_app);
		}else{
			echo count($DTO_app);
		}
	}
	
?>