<?php
	require('Connection.php');
	require('iPermission.php');
	require('permissionDTO.php');

	class ControlPermission implements iPermission
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

			public function insertPermission(permissionDTO $permission){
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$validateInsert=FALSE;

				$SQl='INSERT INTO useraplication (UserId,appId,UAdateCreate,UAdateFinish,UAstate) VALUES ("'.$app->getName().'","'.$app->getAplication().'","'.$app->getDateInitial().'",'.$app->getDateFinish().','.$app->getState().')';
				

				$resul=mysql_query($SQl) or die(mysql_error()."Error");
				
				//echo $SQL;

				if($resul)
				{
					return true;
				}

				else
				{
					return false;
				}
				$this->mysql->disconnect($this->connection);

				return $resul;

			}

			public function selectPermissionAll()
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"SELECT 
				useraplication.UAid,
				useraplication.UAstate,
				user.userName,
				aplication.appName,
				useraplication.UAdateCreate,
				useraplication.UAdateFinish
				FROM useraplication
				INNER JOIN user ON user.userId = useraplication.UserId
				INNER JOIN aplication on aplication.appId = useraplication.appId";
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
			public function editPermission(permissionDTO $permission)
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"UPDATE useraplication 
				SET	UAdateFinish='".$permission->getDateFinish()."',
				UAstate=".$permission->getState()."
				WHERE UAid = '".$permission->getId()."';";

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
/*
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