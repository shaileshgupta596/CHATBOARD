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