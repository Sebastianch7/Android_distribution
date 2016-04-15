<?php
	require('Connection.php');
	require('iApp.php');
	require('AppDTO.php');

	class ControlApp implements iApp 
	{
			private $connection;
			private $mysql;
			private $SQl;
			private $DTO_user;
			private $resul;
			
			public function __construct(){
				$this->connection=null;
				$this->mysql=null;
				$this->DTO_user=null;
				
			}

			public function insertApp(AppDTO $app){
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$validateInsert=FALSE;

				$SQl='INSERT INTO aplication (appName,appDescription,appImage,appRoute,labId,typeId) VALUES ("'.$app->getName().'","'.$app->getDescription().'","'.$app->getImage().'","'.$app->getRoute().'",'.$app->getLaboratory().','.$app->getType().')';
				

				$resul=mysql_query($SQl) or die(mysql_error()."Error");
				
				//echo $SQL;

				if($resul)
				{
			 		$img = "../uploads/";
					$apk = "../donwload/";
					
					$ruta = $img. $_FILES['newImage']['name'];
					move_uploaded_file($_FILES['newImage']['tmp_name'],$ruta);

					$ruta2 = $apk. $_FILES['newApk']['name'];
					move_uploaded_file($_FILES['newApk']['tmp_name'],$ruta2);

					return true;

				}

				else
				{
					return false;
				}
				$this->mysql->disconnect($this->connection);

				return $resul;

			}

			public function selectAppAll()
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"SELECT appId,appName,appDescription,appImage,appRoute,labId,typeId FROM aplication";
				$arrayUser=array();
				$resul=mysql_query($SQl) or die(mysql_error()."Error");

				while($row=mysql_fetch_object($resul))
				{
					$arrayUser[]=$row;
				}
				
				$this->mysql->disconnect($this->connection);
				return $arrayUser;
			}
/*
			public function selectUserRoll()
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"SELECT rolId,rolName FROM roll";
				$arrayUser=array();
				$resul=mysql_query($SQl) or die(mysql_error()."Error");

				while($row=mysql_fetch_object($resul))
				{
					$arrayUser[]=$row;
				}
				
				$this->mysql->disconnect($this->connection);
				return $arrayUser;
			}
*/
			public function editApp(AppDTO $app)
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"UPDATE aplication 
				SET appName='".$app->getName()."',
				appDescription='".$app->getDescription()."',
				appImage='".$app->getImage()."',
				appRoute='".$app->getRoute()."',
				labId=".$app->getLaboratory().",
				typeId=".$app->getType()."
				WHERE appId = '".$app->getId()."';";

				$resul=mysql_query($SQl) or die(mysql_error()."Error");
				
				if($resul)
				{
					return true;
				}
				else
				{
					return false;
				}
				$this->mysql->disconnect($this->connection);
			}

			public function selectAppType()
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"SELECT typeId,typeName FROM typeaplication";

				$resul=mysql_query($SQl) or die(mysql_error()."Error");
				
				while($row=mysql_fetch_object($resul))
				{
					$arrayUser[]=$row;
				}
				
				$this->mysql->disconnect($this->connection);
				return $arrayUser;
			}

			public function selectAppLaboratory()
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"SELECT labId,labName FROM laboratory";

				$resul=mysql_query($SQl) or die(mysql_error()."Error");
				
				while($row=mysql_fetch_object($resul))
				{
					$arrayUser[]=$row;
				}
				
				$this->mysql->disconnect($this->connection);
				return $arrayUser;
			}
			/*
			public function selectApp(UserDTO $user)
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"SELECT userId,userName,rollId
				FROM user 
				WHERE userMail = '".$user->getMail()."' 
				AND userPassword = '".$user->getPassword()."'
				AND user.userState = 1;";
				$arrayUser=array();
				$resul=mysql_query($SQl) or die(mysql_error()."Error");
	/*			
				//$resul=$this->connection->query($SQl);
				
				if($resul->num_rows >0){
					//output data of each row
					while($row=$resul->fetch_object()){
						
						$arrayUser[]=$row;
					}
					
				}
				
**				
				while($row=mysql_fetch_object($resul)){
					$arrayUser[]=$row;
					}
				
				$this->mysql->disconnect($this->connection);
				return $arrayUser;
			}
				
			public function selectTypeData(UserDTO $user,$selection){

				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				switch($selection)
				{
					case 0:
					$SQl="SELECT FIRSTNAME AS NAME,LASTNAME AS SURNAME,MAIL FROM USER WHERE FIRSTNAME="."'".$user->getFirstname()."'";
					break;
					case 1:
					$SQl="SELECT FIRSTNAME AS NAME,LASTNAME AS SURNAME,MAIL FROM USER WHERE LASTNAME="."'".$user->getLastname()."'";
					break;
					case 2:
					$SQl="SELECT FIRSTNAME AS NAME,LASTNAME AS SURNAME,MAIL FROM USER WHERE MAIL="."'".$user->getMail()."'";
					break;
				}
				$arrayUser=array();
				$resul=$this->connection->query($SQl);
				if($resul->num_rows >0){
					//output data of each row
					while($row=$resul->fetch_object()){
						
						$arrayUser[]=$row;
					}
					
				}

				$this->mysql->disconnect();
				return $arrayUser;
				}
				*/
	}
?>