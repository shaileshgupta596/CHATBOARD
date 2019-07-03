<?php
session_start();
require_once('database/database_config.php');


//declare the varibale intially
$fname=$lname=$gender=$dob=$phone_email=$password=$cnf_password=$otp="";
$email_present_error="";
$otp_error="";
$password_not_match="";
$error = False;
//getting the form element data using 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty(trim($_POST['fname']))){
		$error=True;
			}
	else{
		$fname=test_input($_POST['fname']);
			}
	if(empty(trim($_POST['lname']))){$error=True;}
		else{$lname=test_input($_POST['lname']);
	}

	if(empty(trim($_POST['gender']))){$error=True;}
		else{$gender=test_input($_POST['gender']);
	}

	if(empty(trim($_POST['dob']))){$error=True;}
		else{$dob=test_input($_POST['dob']);
	}

	if(empty(trim($_POST['phone_email']))){$error=True;}
	else{
			
			$sql1="SELECT id FROM register_login WHERE phone_email=?";
			//for sql prevention using prepare statement
			//first we are executing a statement without value
			if($stmt = mysqli_prepare($link,$sql1)){
				//here we are binding the parameters ie values
				mysqli_stmt_bind_param($stmt,'s',$p_phone_email);
				$p_phone_email=trim($_POST['phone_email']);//binding parameter
				//excuting a total statement
				if(mysqli_stmt_execute($stmt)){
					//we are storing the result into this $result
					mysqli_stmt_store_result($stmt);
					//cheaking there is only one email is exixting
					if(mysqli_stmt_num_rows($stmt)==1){
						//cheaking the email that user has enter is already present or not
						$email_present_error="email is alrady present!";
						$error=True;
					}
					else{
						
					$phone_email=test_input($_POST['phone_email']);
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

	if(empty(trim($_POST['password']))){
			$error=True;
	}
		else{$password=test_input($_POST['password']);
	}

	if(strlen(trim($_POST['password']))<8){
			$error=True;
		}

	if(empty(trim($_POST['cnf_password']))){	
			$error=True;
	}
		else{
			$cnf_password=test_input($_POST['cnf_password']);
	}
	if(strlen(trim($_POST['cnf_password']))<8){
			$error=True;
		}

if($password!=$cnf_password){
		$error=True;
		$password_not_match="password not match";

	}



	if(empty(trim($_POST['otp']))){$error=True;}
		else{$otp=test_input($_POST['otp']);
	}


	$otp_generated=$_SESSION['otp'];//retriving the otp from session
	//condition for otp matching

	if($otp !=$otp_generated){
		$otp_error="*******otp not match********";
		$error=True;
	}

	if(!($error)){
		//prepairing a statement to insert data
		$sql = "INSERT INTO register_login(fname,lname,gender,dob,phone_email,password,cnf_password) VALUES(?,?,?,?,?,?,?)";


		//passing a statement without value
		if($stmt = mysqli_prepare($link, $sql)){
			//after that binding a variable
			mysqli_stmt_bind_param($stmt,'sssssss',$p_fname,$p_lname,$p_gender,$p_dob,$p_phone_email,$p_password,$p_cnf_password);
			//binding variable
			$p_fname=$fname;
			$p_lname=$lname;
			$p_gender=$gender;
			$p_dob=$dob;
			$p_phone_email=$phone_email;
			$p_password=$password;
			$p_cnf_password=$cnf_password;
			//excuting the overall operation
			if(mysqli_stmt_execute($stmt)){
				//if resistration process complete it will go to login page
				header('location:login.php');
				exit();
			}
			else{
				echo "please check all the filled are fill.";
			}

		}
		//closing statement
		mysqli_stmt_close($stmt);
	}



}
//closing connection
mysqli_close($link);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<html>
<head>
<title>registration</title>
<link href='https://fonts.googleapis.com/css?family=Bilbo' rel='stylesheet'>
<link rel="stylesheet" href="css/registration.css">

<script type="text/javascript" src="registration1.js"></script>

<script type="text/javascript" src="registration.js"></script>
</head>
<body>
	<div class="upper_bar">
			<span class="chatboard_title"> chatboard</span>
	
			
			</div>
	<div class="registration_container">
		<div class="top_animation_container" >
			<div Id="animation1">
			</div>
		</div>

		<span class="ChatBoard">ChatBoard</span>
		<span class="registration_title">Registration</span>

		<form method="POST" name="registration_form">
			<div Id="First_last_gender_dob">
				<input type="text" Id="f_name" required="required" name="fname"><br>
				<label class="fname_label">first Name</label><br>
				
				<input type="text" Id="l_name" required="required" name="lname"><br>
				<label class="lname_label">last name</label>
				<br>
				<div class="gender_container">
				<input type="radio" name="gender" value="male" required="required"><label class="label_gen_male">male</label>
				<input type="radio" name="gender" value="female" required=""><label class="label_gen_female">female</label><br>
				</div>
				
				<input type="date" name="dob" required="required" Id="dob_box"><br>
				<label class="dob_label">DoB</label>

				<input type="email" Id="user_email" required="required" name="phone_email" onkeyup="email_validation(this.value)"><br>
				<label class="email_label"> Email</label>
				<label Id="email_details" class="email_details"><?php echo $email_present_error; ?></label>
				<button  id="send_otp" class="otp_btn" disabled onclick="return sending_otp(this)">send Otp</button><br>
				<label class="otp_message" Id="otp_message"></label>
			</div>

			<div Id="pass_cnfpass_container">
				<input type="password" Id="pass" required="required" name="password" onkeyup="password_length(this.value)"><br>
				<label class="pass_label">password</label>
				<label class="password_length" Id="password_length"></label>


				<input type="password" Id="Cnf_pass" required="required" name="cnf_password" onkeyup=" password_checking(this.value)"><br>
				<label class="cnf_pass_label">confirm password</label>
				<label class="password_check" Id="info"></label>


				<input type="text" Id="otp_box" required="required" name="otp"><br>
				<label class="otp_label">Otp</label>
				<input type="submit" Id="submit_btn" value="Submit">
				<button onclick="show_1st_container()" id="back_btn">back</button>


				<p style="bottom:2%;left:40%;position: absolute;font-size: 25px;color:#3399ff;"><u>need a help?</u></p>
			</div>			
		</form>
		<button onclick="to_password_container()" value="next" Id="next_btn1" required>Next</button>
		<label class="error"><?php echo $otp_error; ?></label>

		<div class="bottom_animation_container" >
			<div Id="animation2">
			</div>
		</div>
	</div>
	</body>
</html>