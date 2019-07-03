<?php
require_once('database/database_config.php');
	$email=$_GET['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 	//check for user email in right format or not
  echo "Invalid email format";
}
else{ 
		$sql1="SELECT id FROM register_login WHERE phone_email=?";
			if($stmt = mysqli_prepare($link,$sql1)){
				mysqli_stmt_bind_param($stmt,'s',$p_phone_email);
				$p_phone_email=$email;//binding parameter
				if(mysqli_stmt_execute($stmt)){
					mysqli_stmt_store_result($stmt);
					if(mysqli_stmt_num_rows($stmt)==1){
						echo "email is alrady present!";
					}
					else{
						
					echo "email ok";
					}
				}
				else{
					echo "something went worng in execution try again";
				$error=True;
				}
			}
			else{
				echo "something went worng in mysqli_prepare try again";
				$error=True;
			}
			mysqli_stmt_close($stmt);
		
}
 ?>
