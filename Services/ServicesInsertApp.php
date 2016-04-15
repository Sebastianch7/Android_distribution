<?php
	require('ControlApp.php');
		
	$DTO_app=new AppDTO();

	$img = "../uploads/";
	$apk = "../donwload/";


	if ($_FILES['newApk']['type'] == 'application/octet-stream' && $_FILES['newImage']['type'] == 'image/jpeg') 
	{
		if(isset($_POST['newNameApp']) && isset($_POST['newDescription']) && isset($_FILES['newImage']) && isset($_FILES['newApk']) && isset($_POST['newLaboratory']) && isset($_POST['newType']))
		{
			$DTO_app->setName($_POST['newNameApp']);
			$DTO_app->setDescription($_POST['newDescription']);
			$DTO_app->setImage($img.$_FILES['newImage']['name']);
			$DTO_app->setRoute($apk.$_FILES['newApk']['name']);
			$DTO_app->setaboratory($_POST['newLaboratory']);
			$DTO_app->setType($_POST['newType']);
			
			$ControlApp =new ControlApp();
			

			$DTO_app=$ControlApp->insertApp($DTO_app);

			if(count($DTO_app)>=1)
			{
				//echo json_encode($DTO_app);
				header('location: ../gestor.html?generateApp');
			}
			else
			{
				echo count($DTO_app);
			}
		}
	}
	else
	{
		header('location: ../gestor.html?generateApp_error');
	}
?>
