<?php
	session_start();
	//if user has logged in himself than it will redirected to homepage untill he logout.
	if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']===true){
		if(isset($_SESSION['username'])){
		header('Location:homepage.php');
		exit;
	}
	}
 ?>

<?php 

require_once('database/database_config.php');

	//declaring a variable
	$username=$password="";
	$error=False;
	//using $_SERVER method use to check from data is of which type
if($_SERVER["REQUEST_METHOD"] == "POST"){
		//fetching username from form
		if(empty($_POST["username"])){
			$error=True;
		}
		else{
			$username=test_input($_POST["username"]);
		}

		//fetching password from form
		if(empty($_POST["password"])){
			$passErr="pass is reqd.";
		}
		else{
			$password=test_input($_POST["password"]);
		}

		if(!($error)){
			//preparing a sql statement
			$sql= "SELECT id,phone_email,password FROM register_login WHERE phone_email=? ";
			//for sql prevention using prepare statement
			//first we are executing a statement without value
			if($stmt = mysqli_prepare($link,$sql)){
				//here we are binding the parameters ie values
				mysqli_stmt_bind_param($stmt,'s',$param_username);
				$param_username=$username;//binding parameter
				//excuting a total statement
				if(mysqli_stmt_execute($stmt)){
					//we are storing the result into this $result
					mysqli_stmt_store_result($stmt);
					//cheaking there is only one email is exixting
					if(mysqli_stmt_num_rows($stmt)==1){
						//retriving the result
						mysqli_stmt_bind_result($stmt,$user_id,$email,$stored_password);
						//fetching the result from database
						if(mysqli_stmt_fetch($stmt)){
							//comparing the password
							if($password==$stored_password){
								session_start();

								$_SESSION["username"]=$username;
								$_SESSION["user_id"]=$user_id;
								$_SESSION['user_logged_in']=true;
								require_once('insert_login_details.php');
								header("Location:homepage/homepage.php?username=".$username);
							}
							else{
								echo "check credential once again!";
							}
						}
					}
					else{
						echo "email is not found";
					}

				}
				else{
					echo "somthing is wromg at time of execution try once more>>";
				}
			}
			 // Close statement
        	mysqli_stmt_close($stmt);
		}
mysqli_close($link);
}
	
function test_input($data){
		$data=trim($data);
		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	} 	
?>

<html>
<head>
	<title>login</title>
	<link href='https://fonts.googleapis.com/css?family=Bilbo' rel='stylesheet'>
	<script>
		function to_password_box(){
			var x=document.getElementById('userid_container');
			 x.style.animationPlayState="running";
			 document.getElementById('next_button').style.display="none";
			 var y=document.getElementById('password_login_container');
			y.style.display="block";

			var a=document.getElementById('animation1');
			var b=document.getElementById('animation2');
			a.style.animationPlayState="running";
			b.style.animationPlayState="running";

		}

		function to_username_box(){
			var x=document.getElementById('userid_container');
			var y=document.getElementById('password_login_container');
			document.getElementById('next_button').style.display="block";
			x.style.display="block";
			y.style.display="none";
		}
	</script>
	<link rel="stylesheet" href="css/login.css">
	</head>
<body>
	<div class="upper_bar">
			<span class="chatboard_title"> chatboard</span>
	
			
	</div>



	<div class="login_container">

		<div class="top_animation_container" >
			<div Id="animation1">
			</div>
		</div>

		<span class="ChatBoard">ChatBoard</span>

		<span class="login_title">Login</span>

		<form class="login_form" method="post">
			<div Id="userid_container">
			
				<input type="text" required="" Id="userid" name="username"><br>			
			<label>Phone or Email</label>
			</div>

			
			<div Id="password_login_container">
				<input type="password" id="password_box" name="password">
				<label>Password</label><br>
				<input type="submit" value="Login" Id="login_btn">
				<button onclick="to_username_box()" id="back_btn">back</button>
			</div>
		
		</form>
		
		<button onclick="to_password_box()" id="next_button">Next</button>

		<div class="newacc_forpass">
			<ul>
			<li><p><u>Forgot Password?</u></p></li>
			<li><a href="registration.php" style="text-decoration: none;"><p><u>Create an Account</u></p></a></li>
			</ul>
		</div>


		<div class="bottom_animation_container" >
			<div Id="animation2">
			</div>
		</div>

	</div>

</body>
</html>

