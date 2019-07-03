<?php
	session_start();
	if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']===true){
		if(isset($_SESSION['username'])){
		header('Location:homepage.php');
		exit;
	}
	}
 ?>

<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Bilbo' rel='stylesheet'>
	<style>
	body{
		font-family: bilbo;
	}
	.chatboard{
		width:500%;
		height: 100px;
		position: absolute;
		top:40%;
		left:33%;
		
			

	}
	.chatboard_btn{
	position:absolute;
	top:20%;
	left:1%;

			width: 275px;
			height:40px;
			background-color: #ff4d4d;
			border-radius:3px;
			border: none;
			color:white;
			font-size: 25px;
			font-weight: bold;
			font-family: 'bilbo';
		box-shadow: 0px 0px 2px 2px rgb(0,0,0,0.1);}

		.upper_bar{
	width:100%;
	height:100px;
	background-color: #3399ff;
	position: absolute;
	border-radius: 5px;
			box-shadow: 0px 0px 2px 2px rgb(0,0,0,0.1);
}
.chatboard_title{
	left:45%;
	top:20px;
	position: absolute;
	color:white;
	font-size:40px;
	font-family: bilbo;
}
</style>
</head>
<body>
	<div class="upper_bar">
			<span class="chatboard_title"> chatboard</span>
	
			
			</div>
	<span class="chatboard"><a href="login.php"><button class="chatboard_btn">chatboard</button></a></span>
	</body>
</html>