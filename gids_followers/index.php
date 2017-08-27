<?php


set_time_limit(59);

for($j=0;$j<100;$j++){
	$counter=file_get_contents("counter.txt");
	$counter2=file_get_contents("counter2.txt");
	
	if($counter<$counter2){$counter=$counter2;}
		$start_step=$counter*100;
		$stop_step=$start_step+100;

		$list="";
		for($i=$start_step;$i<$stop_step;$i++){
			$list=$list.",".$i;
		}

			$users_arr= "";
			$users_arr= json_decode(file_get_contents("https://api.vk.com/method/groups.getById?group_ids=".substr($list, 1)."&fields=members_count"));
				
			for($i=0;$i<99;$i++){
				$gid= $users_arr->response[$i]->gid;
				$followers_count= $users_arr->response[$i]->members_count;
			
				if($gid==""){exit();}

				if($followers_count>9999){
					$save_arr[]=$gid;
					$save_arr[]=$followers_count;

					$fp = fopen("rez.txt", "a");
					$mytext = json_encode($save_arr)."\r\n";
					$test = fwrite($fp, $mytext);
					fclose($fp);	

					$followers_count="";
					unset($save_arr);
					$save_arr="";
				}
			}


			$counter++;
			file_put_contents("counter.txt", $counter);
			if(rand(0,10)==10){
				file_put_contents("counter2.txt", $counter);

			}

sleep(1);
}


		?>