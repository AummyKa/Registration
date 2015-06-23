<?php 



	if (!empty($_POST)) {
		//print_r($_POST); exit();
		if(checkUserInTable())
		{
			addNewUser();
		}
	}

	function connect_db()
	{
		//Connect to database
		$str_server = "localhost";
		$str_username = "root";
		$str_password = "";
		$str_dbname = "n_database";

		$obj_con = mysql_connect($str_server,$str_username,$str_password,$str_dbname)
		or die("Failed to connect to MySQL: " . mysql_error());

		$db = mysql_select_db($str_dbname,$obj_con) or die("Failed to connect to MySQL: " . mysql_error());

		mysql_query("SET NAMES UTF8");


		if (mysqli_connect_errno($obj_con)) { 
		echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
		} else { 
		// echo "Successfully connected to your database…"; 
		}
	}

	//Connect the user
	function addNewUser() { 

		connect_db();
		
		$name = $_POST['name']; 
		$lastname = $_POST['lastname']; 
		$username = $_POST['username']; 
		$password = $_POST['password'];
		$sex = $_POST['sex'];
		$b_date = $_POST['date_of_birth'];
				
		$interest ="";
		foreach($_POST['interest'] as $check_itr){
			$interest .= $check_itr."  ";
		}
		
		
		$query = "INSERT INTO user (name,lastname,username,password,sex,date_of_birth,interest) 
		VALUES ('$name','$lastname','$username','$password','$sex','$b_date','$interest')"; 
		
		$data = mysql_query ($query)or die(mysql_error()); 

		if($data) { 
			echo "YOUR REGISTRATION IS COMPLETED..."; 
		} 

	} 
		
	function checkUserInTable() { 

		connect_db();
		if(!empty($_POST['name'])) //checking the 'user' name not to have same text and empty
		{ 
			$query = mysql_query("SELECT * FROM user WHERE username = '".$_POST['username']."'") 
			or die(mysql_error()); 

			if(!$row = mysql_fetch_array($query)) { 
				
				return true;
			} 
			else
			{ 
				echo "SORRY...YOU ARE ALREADY REGISTERED USER : ".$_POST['username'];
				return false; 
			} 
		} 
	} 
			
?>