<?php
class sendMailD
{	

	private $conn;
	
	
	
	function sendMail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		  
		$mail->Username="guptashhait16e@student.mes.ac.in";  
		$mail->Password="8976378042";   
		  
		$mail->SetFrom('support@Chatboard.com','Chatboard Team');
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		if(!$mail->send()) {
			  return "FAIL";
		} else {
  				return "OK";
		}
		

	}	
}

?>
