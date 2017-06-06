<!DOCTYPE html>
<html>
<head>
	<title>Мертвые стены</title>

</head>
<body>


<?php
set_time_limit(60);

for($i=0;$i<1000;$i++){

	$counter=file_get_contents("counter.txt");
	$counter2=file_get_contents("counter2.txt");

	if($counter<$counter2){
		$counter=$counter2;
	}

	$gid_file=file("gids.txt");
	$gid=trim($gid_file[$counter]);


	$wall_arr=json_decode(file_get_contents("https://api.vk.com/method/wall.get?owner_id=-".$gid."&count=2"));

	$date=$wall_arr->response[2]->date;
	$date2 = mktime(0, 0, 0, date('m')-6, date('d'), date('Y'));

	//Убиваем скрипт
	if($gid==""){exit();}
	if($wall_arr==""){exit();}
	//==============	

	if($date<$date2) {

	$fp = fopen("rez.txt", "a"); // Открываем файл в режиме записи 
	$mytext = $gid."\r\n"; // Исходная строка
	$test = fwrite($fp, $mytext); // Запись в файл
	fclose($fp); //Закрытие файла

	}


	$counter++;

	if(rand(0,10)==10){
	file_put_contents("counter2.txt",$counter);

	};

	file_put_contents("counter.txt",$counter);

}

?>




</body>
</html>