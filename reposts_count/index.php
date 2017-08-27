<?php
set_time_limit(59);

for($j<0;$j<1000;$j++){

	$counter=file_get_contents("counter.txt");
	$counter2=file_get_contents("counter2.txt");
	if($counter<$counter2){$counter=$counter2;}

	$file=file("gids.txt");
	$gid=trim($file[$counter]);
	if(count($file)==$counter){exit();}	
	
	$wall_arr= json_decode(file_get_contents("https://api.vk.com/method/wall.get?owner_id=-".$gid."&count=30&access_token=99343d316d230c4e0832e4f13627bce859372fae2b5a83884a531cc9b8b60ad619b7a5620df1bd9bca59e"));
	
	
	$repost_sum=0;
	for($i=10;$i<30;$i++){
		$repost_sum=$repost_sum + $wall_arr->response[$i]->reposts->count;
	}
	
	$rez_arr="";
	$rez_arr[]=$gid;
	$rez_arr[]=$repost_sum;
	
	$fp = fopen("rez.txt", "a"); // Открываем файл в режиме записи 
	$mytext = json_encode($rez_arr)."\r\n"; // Исходная строка
	$test = fwrite($fp, $mytext); // Запись в файл
	fclose($fp); //Закрытие файла
	
	$counter++;
	file_put_contents("counter.txt", $counter);

	if(rand(0,10)==10){
	file_put_contents("counter2.txt", $counter);
	}

}	
	

?>