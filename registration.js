function email_validation(email) {

	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();//for latest version of browsers
	}
	else{
		xmlhttp =new ActiveXObject("Microsoft.HTTP");//for previous version of browser
	}

	//if there is an any active the fuction will start 
	xmlhttp.onreadystatechange=function(){
		if(this.status==200 && this.readyState==4){
			//this.status =all ok  & this.ready state==no error
			document.getElementById('email_details').innerHTML=this.responseText;
		}
		//send otp button enabled only when email format is right
		if(this.responseText == "email ok"){
			document.getElementById('send_otp').removeAttribute('disabled');
		}
		else{
			document.getElementById('send_otp').setAttribute('disabled','disabled');
		}
	}
	//calling a sever for response quitely and passing required element
	xmlhttp.open("GET","email_validation.php?email="+email,true);
	xmlhttp.send();
}



function sending_otp(obj) {

	email=document.forms['registration_form']['phone_email'].value;
	alert(email);
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();//for latest version of browsers
	}
	else{
		xmlhttp =new ActiveXObject("Microsoft.HTTP");//for previous version of browser
	}

	//if there is an any active the fuction will start 
	xmlhttp.onreadystatechange=function(){
		if(this.status==200 && this.readyState==4){
			//this.status =all ok  & this.ready state==no error
			document.getElementById('otp_message').innerHTML=this.responseText;
		}		
	}
	xmlhttp.open("GET","sending_mail.php?email="+email,true);
	xmlhttp.send();
	return false;
}

function to_password_container(){
		var first_container=document.getElementById('First_last_gender_dob');
		
		var pos = 0;
  var id = setInterval(frame, 1);
  function frame() {
    if (pos == -450) {
      clearInterval(id);
      first_container.style.display="none";
    	} 
    else{
      pos=pos-5; 
      
      first_container.style.left = pos + "px"; 
    	}
  	}


		
		var next_btn=document.getElementById('next_btn1');
		next_btn.style.display="none";

		var x=document.getElementById('pass_cnfpass_container');
		x.style.display="block";

		



		var a=document.getElementById('animation1');
			var b=document.getElementById('animation2');
			a.style.animationPlayState="running";
			b.style.animationPlayState="running";
	}

function show_1st_container(){
	var second_container=document.getElementById('pass_cnfpass_container');
var first_container=document.getElementById('First_last_gender_dob');

first_container.style.display="block";
var pos = -450;
  var id = setInterval(frame, 1);
  function frame() {
    if (pos == 0) {
      clearInterval(id);
      second_container.style.display="none"
      
    } 
    else{
      pos=pos+5; 
      
      first_container.style.left = pos + "px"; 
    }
  }

var next_btn=document.getElementById('next_btn1');
		next_btn.style.display="block";

		

}

function password_checking(box2){
			var box1=document.forms['registration_form']['password'].value;
			if(box1==box2){
				document.getElementById('info').innerHTML="password match";
			}
			else{
				document.getElementById('info').innerHTML="*****password not match******";
			}
		}

function password_length(str) {
	// body...
	if(str.length >=8){
		document.getElementById('password_length').innerHTML="password character is OK";
	}
	else if(str.length>4){
		document.getElementById('password_length').innerHTML="*******password is short*******";

	}
	else{
		document.getElementById('password_length').innerHTML="*******password is too short*******";
	}
}
