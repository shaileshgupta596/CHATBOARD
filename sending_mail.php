<?php
	session_start();
	$_SESSION['otp']=rand(111111,999999);
	require_once 'sendMailD.php';
	$email=$_GET['email'];
	//$email="shaileshgupta596@gmail.com";
	
	$mailforward=new sendMailD();

	try{
		$user_rec_otp_code=$_SESSION['otp'];
		$user_email=$email;
		$message= "
                           Hello , $user_email
                           <br /><br />
                           We got request to rgister your email id for  if you have requested  then use the one time verfification code to verify your email id, if not just ignore this email,
                           <br /><br />
                           Your one time verification code is  $user_rec_otp_code
                           <br /><br />
                           
                           <br /><br />
                           Thank you 
                           <br /><br />
                           Chatboard.com
                           ";
        $subject="User verification";
        $Recevied_verification=$mailforward->sendMail($user_email,$message,$subject);

        if($Recevied_verification == "OK"){
        	echo "mail sent.";
        }
        else{
        	echo "mail not sent!";
        }
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

 ?>