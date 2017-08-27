<?php
set_time_limit(59);

$time = mktime(date("H"), date("i"), 0, date("m"), date("d")-2, date("Y"));


for($j<0;$j<1000;$j++){

	$counter=trim(file_get_contents("counter.txt"));
	$counter2=trim(file_get_contents("counter2.txt"));
	if($counter<$counter2){$counter=$counter2;}

	$file=file("gids.txt");
	$gid=trim($file[$counter]);
	if(count($file)==$counter){exit();}	
	
	$api=file_get_contents("https://api.vk.com/method/wall.get?owner_id=-".(int)$gid."&count=30&access_token=83650e4bf8158c0aacf430b5661c520ca74c41e625b04f8b766113c2fdfe2a3ca3e714dfc207d2191a651");
	
	
	$wall_arr= json_decode($api);
	/*
	print_r($wall_arr);
	echo "<hr>";
	echo "https://api.vk.com/method/wall.get?owner_id=-".(int)$gid."&count=30&access_token=83650e4bf8158c0aacf430b5661c520ca74c41e625b04f8b766113c2fdfe2a3ca3e714dfc207d2191a651";
	*/
	
	$bad_club=0;
	if($like_sum=$like_sum + $wall_arr->response[2]->date<$time){$bad_club=1;}
	
	if($bad_club<>1){
		$like_sum=0;
		for($i=10;$i<30;$i++){
			$like_sum=$like_sum + $wall_arr->response[$i]->likes->count;
		}
		
		$rez_arr="";
		$rez_arr[]=$gid;
		$rez_arr[]=$like_sum;
		
		$fp = fopen("rez.txt", "a"); // Открываем файл в режиме записи 
		$mytext = json_encode($rez_arr)."\r\n"; // Исходная строка
		$test = fwrite($fp, $mytext); // Запись в файл
		fclose($fp); //Закрытие файла
	}
	
	if($api<>""){
		$counter++;
		file_put_contents("counter.txt", $counter);
		if(rand(0,10)==10){
		file_put_contents("counter2.txt", $counter);
		}
	}
}	
	

?>