<?php


set_time_limit(60);

$time = mktime(date("H"), date("i"), 0, date("m")-2, date("d"), date("Y"));

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



	$users_arr= json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=".substr($list, 1)."&fields=followers_count,can_post,last_seen"));
	

	for($i=0;$i<100;$i++){

	$uid= $users_arr->response[$i]->uid;
	$followers_count= $users_arr->response[$i]->followers_count;
	$last_seen= $users_arr->response[$i]->last_seen->time;
	$can_post= $users_arr->response[$i]->can_post;

	$save_arr="";
	
	if($uid==""){exit();}

		if($can_post>0 AND $last_seen<$time AND $followers_count>20){
			$save_arr[]=$uid;
			$save_arr[]=$followers_count;
			$save_arr[]=$last_seen;
			$save_arr[]=$can_post;
			
			$fp = fopen("rez.txt", "a"); // Открываем файл в режиме записи 
			$mytext = json_encode($save_arr)."\r\n"; // Исходная строка
			$test = fwrite($fp, $mytext); // Запись в файл
			fclose($fp); //Закрытие файла
		}


	}


	$counter++;
	file_put_contents("counter.txt", $counter);

	if(rand(0,10)==10){
		file_put_contents("counter2.txt", $counter);

	}


}

?>