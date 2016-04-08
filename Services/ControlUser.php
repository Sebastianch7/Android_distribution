<?php
	require('Connection.php');
	require('iUser.php');
	require('UserDTO.php');

	class ControlUser implements iUser 
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
			
			public function insertUser(UserDTO $user){
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$validateInsert=FALSE;

				$SQl='INSERT INTO user (userName,userMail,userPassword,userState,rollId,userDateCreate) VALUES ("'.$user->getName().'","'.$user->getMail().'","'.$user->getPassword().'",'.$user->getState().','.$user->getRoll().',"'.$user->getDateInsert().'")';
				

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

				return $validateInsert;

			}

			public function selectUserAll()
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"SELECT userId,userName,userMail,userPassword,userState,rollId FROM user";
				$arrayUser=array();
				$resul=mysql_query($SQl) or die(mysql_error()."Error");

				while($row=mysql_fetch_object($resul))
				{
					$arrayUser[]=$row;
				}
				
				$this->mysql->disconnect($this->connection);
				return $arrayUser;
			}

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

			public function editUser(UserDTO $user)
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"UPDATE user 
				SET userName='".$user->getName()."',
				userPassword='".$user->getPassword()."',
				userState=".$user->getState().",
				rollId=".$user->getRoll()." 
				WHERE userMail = '".$user->getMail()."';";

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
			public function deletUser(UserDTO $user)
			{	
				$this->mysql=new Connection();
				$this->connection=$this->mysql->connection();
				$SQl=
				"DELETE FROM user	WHERE userMail = '".$user->getMail()."';";

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
			*/
			
			public function selectUser(UserDTO $user)
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
				
*/				
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
	} 
?>