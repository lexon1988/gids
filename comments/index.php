<?php
set_time_limit(0);

for($j=0;$j<2500;$j++){


	$counter=file_get_contents("comments_counter.txt");
	$check_file=file("comments_check.txt");
	$gid= trim($check_file[$counter]);
	$api="https://api.vk.com/method/wall.get?owner_id=-".$gid."&count=30";

	$api_reg=file_get_contents($api);
	$rez=json_decode($api_reg);

		$cc=0;
		for($i=1;$i<31;$i++){


			if($rez->response[$i]->comments->count>2){


				$cc++;
				if($cc>3){


					$fp = fopen("comments_rez.txt", "a"); // Открываем файл в режиме записи 
					$mytext = $gid."\r\n"; // Исходная строка
					$test = fwrite($fp, $mytext); // Запись в файл
					fclose($fp); //Закрытие файла

					break;
				}


			}


		}


		$counter++;
		file_put_contents("comments_counter.txt", $counter);
}

?>