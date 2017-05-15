<table border=1;>


<?php
set_time_limit(0);

for($j=7000;$j<10000;$j++){


	$check_file=file("comments_check.txt");
	$gid= trim($check_file[$j]);
	$api="https://api.vk.com/method/wall.get?owner_id=-".$gid."&count=30";

	$api_reg=file_get_contents($api);
	$rez=json_decode($api_reg);

	//print_r($rez);
	echo "<tr>";
	
	echo "<td>".$gid."</td>";
	
	echo "<td>";
	echo $rez->response[1]->reposts->count + 
		$rez->response[5]->reposts->count +
		$rez->response[10]->reposts->count +
		$rez->response[15]->reposts->count +
		$rez->response[20]->reposts->count +
		$rez->response[25]->reposts->count +
		$rez->response[30]->reposts->count 
	;
	echo "</td>";
	
	echo "</tr>";


}

?>



</table>