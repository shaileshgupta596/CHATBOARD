<?php 
$user_id=$_SESSION['user_id'];
require_once('database/database_config.php');

$sql="INSERT INTO login_details(id) VALUES('".$user_id."')";
if (mysqli_query($link, $sql)) {
	$_SESSION['login_details_id']=mysqli_insert_id($link);
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);

}
mysqli_close($link);

?>