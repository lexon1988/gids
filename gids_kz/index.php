<?php


set_time_limit(59);

for($j=0;$j<1000;$j++){
	$counter=file_get_contents("counter.txt");
	$counter2=file_get_contents("counter2.txt");
	if($counter<$counter2){$counter=$counter2;}

	$start_step=$counter*100;
	$stop_step=$start_step+100;

	$list="";
	for($i=$start_step;$i<$stop_step;$i++){
	$list=$list.",".$i;

	}


	$users_arr= json_decode(file_get_contents("https://api.vk.com/method/groups.getById?group_ids=".substr($list, 1)."&fields=country,city"));


	
	for($i=0;$i<99;$i++){
		$gid= $users_arr->response[$i]->gid;
		$city= $users_arr->response[$i]->city;
	
		if($gid==""){exit();}

		if($city==183){
			$fp = fopen("rez.txt", "a");
			$mytext = $gid."\r\n";
			$test = fwrite($fp, $mytext);
			fclose($fp);	
		}
	}



	$counter++;
	file_put_contents("counter.txt", $counter);

	if(rand(0,10)==10){
		file_put_contents("counter2.txt", $counter);

	}


}


?>