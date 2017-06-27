<?php
set_time_limit(59);

$counter1=file_get_contents("counter1.txt");
$counter2=file_get_contents("counter2.txt");

if($counter1<$counter2){
	$counter1=$counter2;
	
}

$file=file("rez.txt");


for($i=0;$i<9999; $i++){
    $fr_arr="";

    $item=json_decode($file[$counter1]);	
    $friends=file_get_contents("https://api.vk.com/method/friends.get?user_id=".$item[0]);

    $fr_arr[]=$item[0];
    $fr_arr[]=substr_count($friends,',');

	$save=json_encode($fr_arr);	
	
    $fp = fopen("friends.txt", "a");
    $mytext = $save."\r\n";
    $test = fwrite($fp, $mytext);
    fclose($fp);
	

	//----------	
	$counter1++;
	file_put_contents("counter1.txt",$counter1);

	$rand=rand(0,10);
	if($rand==10){
		$counter2=$counter1;
		file_put_contents("counter2.txt",$counter2);
		
	}

	
}







?>