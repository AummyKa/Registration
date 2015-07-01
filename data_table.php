<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
  	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	
	</script>

    <title>Register</title>
    
        

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <!-- import your css file by coping the <link href="yourcssfilename.css" rel="stylesheet"> and paste it under this comment -->
    <!-- http://designmodo.com/audio-player/ -->


    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/myCss.css" rel="stylesheet">


    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

	</head>

	<body>

	<div class="container">
  		<h3>List</h2>


<?php
	
	include('connect_database.php');

	function notice($text,$action = 'add'){
		static $notices;
		if($action = 'add'){
			$notices[] = $text;
		}else if($action == 'get'){
			if(count($notices) > 0){
				$output = '<strong><ul><li>' . implode('</li><li>', $notices).'</li></ul></strong>';
				unset($notices);
				return $output;

			}
		}
	}

	function get_notices(){
		return notice(''.'get');
	}

	function user_display(){
		
		$output = '';
		$result = connect_db()->query("SELECT * FROM user ORDER BY name DESC");

		foreach($result->fetchAll() as $val){
		//while($row as $key=>$val){

			$output .= '
    			<tr>
					<td>' . $val['name'].'</td>
					<td>' . $val['lastname'].'</td>
					<td>' . $val['username'].'</td>
					<td>' . $val['sex'].'</td>
					<td>' . $val['date_of_birth'].'</td>
					<td>' . $val['interest'].'</td>
					<td><a href="update-form.php?action=delete&id=' . $val['id'] . '">Delete</a></td>>
					<td><a href="edit_form.php?action=edit&id=' . $val['id'] . '">Edit</a></td>>
					

				</tr>';
		}

		if($output != ''){
			$output = '
				<table id="table_display" class="table table-striped table-bordered" cellspacing="0" width="100%">
    			<thead>
					<tr>
						<th>Name</th>
						<th>Lastname</th>
						<th>Username</th>
						<th>Sex</th>
						<th>Birthday</th>
						<th>Interest</th>
						<th></th>
						<th></th>
					</tr></thead>
					<tbody>
					'. $output . '
					</tbody>
					</table>';
				}else{
					$output = '<p> There are no register to display.</p>';
				}
				return $output;
		}
		
	
	
	if(isset($_GET['action'])){

		switch($_GET['action']){
			case 'delete':
				$sql = "DELETE FROM user WHERE id = :id";
				$stmt = connect_db()->prepare($sql);

				$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
				$affected = $stmt->execute();
			    	
			    if($affected > 0)
			    {
			    	echo "Record deleted successfully";
			    }

				break;
	


		}
	}

	print get_notices() . user_display();

?>
	
	<button type="button" class="btn btn-primary" onclick="window.location.href='register_page.html'" >Add New User</button>

 <!-- Load JS here for greater good =============================-->
   	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- <script src="js/jquery-1.8.3.min.js"></script> -->
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/jquery.ui.touch-punch.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <!-- <script src="js/bootstrap-switch.js"></script>-->
    <script src="js/flatui-checkbox.js"></script>
    <script src="js/flatui-radio.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/jquery.placeholder.js"></script>

    <!-- it works the same with all jquery version from 1.x to 2.x -->
    <!-- <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>-->
    <!-- use jssor.slider.mini.js (39KB) or jssor.sliderc.mini.js (31KB, with caption, no slideshow) or jssor.sliders.mini.js (26KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
    <script type="text/javascript" src="js/jssor.core.js"></script>
    <script type="text/javascript" src="js/jssor.utils.js"></script>
    <script type="text/javascript" src="js/jssor.slider.js"></script>
	<script src="validate.js"></script>
	




<script>
		$(document).ready(function() {
			console.log($('#table_display'));
    		$('#table_display').dataTable( {
				"bFilter": false, // Disable searching
				// "bPaginate": false, // Disable pagination
				// "bInfo": false,   // Disable info texts


    		"aoColumnDefs": [
        		{ 	        			
        		 	'bSortable': false, 'aTargets': [3,5,6,7], //Disable sorting
        		 },
        		
    		],

        	}


      );
});
	</script>
</body>
  

</html>
