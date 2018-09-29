<?php
$connection =	mysqli_connect('localhost' , 'root' ,'Toothless521' ,'CS4380') or die("can not connect to database:".mysqli_connect_error());
error_reporting(0);




if(isset($_POST['email'])){
	
	$first_name = $_POST['first_name'];
	$lastName = $_POST['last_name'];
	$id = $_POST['id'];

	//  query to update data 
	 
	$result  = mysqli_query($connection , "UPDATE user SET first_name='$first_name' , last_name='$last_name' WHERE id='$id'");
	if($result){
		echo 'data updated';
	}

}
?>