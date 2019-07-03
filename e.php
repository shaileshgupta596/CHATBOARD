<?php 
/*
date_default_timezone_set("Asia/Kolkata");
echo date("Y-m-d H:i:s");
$current_timestamp = strtotime(date("Y-m-d H:i:s")."-10 second");
echo "\n$current_timestamp";
$current_timestamp2 = strtotime(date('Y-m-d H:i:s'));
echo "\n$current_timestamp2";
*/
?>

<html>
<script>
	function show(){
		var box='<div class="chat_box"style="width:400px;height:400px;background-color: red;">';
	box+='</div>';
	document.getElementById('chat_box_container').innerHTML=box;
	}
	</script>
<body>
	<button onclick="show()">click</button>
	<div Id="chat_box_container"></div>
	</body>
</html>