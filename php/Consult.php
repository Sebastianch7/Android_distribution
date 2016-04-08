<?php
	require ('Connection.php');

	class Consult{

		private $sql = "";
		private $usermail = "";
		private $password = "";
		private $user = "";
		private $resultado = "";
		private $mysql = "";
		private $con = "";

		public function __construct($usermail,$password)
		{
			
			$this->sql="";
			$this->usermail = $usermail;
			$this->password = $password;
			$this->resultado = "";			
		}

		public function searchUser()
		{
			$con = new Connection();
			$mysql = $con->connection();
			$this->sql = 
				"SELECT
				userId,userName,rollId
				FROM
				user
				WHERE
				user.userMail = '".$this->usermail."'
				AND
				user.userPassword = '".$this->password."'
				AND user.userState = 1;";

					$arrayUser=array();


				$resultado=mysql_query($this->sql) or die(mysql_error()."Error");
	/*			
				//$resul=$this->connection->query($SQl);
				
				if($resul->num_rows >0){
					//output data of each row
					while($row=$resul->fetch_object()){
						
						$arrayUser[]=$row;
					}
					
				}
				
*/				
				
				while($row=mysql_fetch_object($resultado)){
					$arrayUser[]=$row;
					}
				
				$con->disconnect($this->mysql);
				return $arrayUser;
		}


		function descargaApk($array)
		{
			try
			{
				if($array != NULL)
				{

					$con = new Connection();
					$mysql = $con->connection();
					$this->sql = 
					"SELECT 
					aplication.appName,
					aplication.appDescription,
					aplication.appDescription,
					aplication.appImage,
					aplication.appRoute
					FROM
					aplication
					INNER JOIN useraplication on useraplication.appId = aplication.appId
					WHERE useraplication.UserId = ".$array['userId']."
					AND UAstate = 1;";
					$resultado = mysql_query($this->sql);
					$fila = mysql_fetch_array($resultado);
				}
				else
				{
					$fila = $array;
				}			
			}
			catch(Exception $e)
			{

				 echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			}
			return $fila;
		}

	}

	//inicioDeSesion

	$usuario = $_POST['inp_mailUsuario'];
	$password = $_POST['inp_password'];
	$respuesta = null;
	if($usuario && !empty($password)) 
	{
		$obj_consult = null;
	    $action = $_POST['action'];
	    if($action == 'searchUser')
	    {
	    	$obj_consult = new Consult($usuario,$password);
	    	$row = $obj_consult->searchUser();
	    	/*
	    	if(count($row) > 0)
	    	{
	    		$row2 =	$obj_consult->descargaApk($row);
	    		
	    		if($row2)
	    		{
	    			$respuesta = $row2;
	    			//echo $respuesta;
	    		}
	    		else
	    		{
	    			$respuesta = 'No hay datos';
	    		}
	    	}
	    	else
	    	{
	    		$respuesta = '';
	    	}

	    	print_r($respuesta);
	    	*/
	    }
	}
?>