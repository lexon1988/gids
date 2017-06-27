<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table border=1>
	
<?php
set_time_limit(0);

$file=file("rez.txt");
$file_count=count($file);



for($i=0;$i<$file_count;$i++){
$item=json_decode(trim($file[$i]));
?>

	<tr>
		<td><?= $item[0] ?></td>
		<td><?= $item[1] ?></td>
		<td><?= $item[2] ?></td>
		<td><?= $item[3] ?></td>
		<td><?= $item[4] ?></td>
		<td><?= $item[5] ?></td>
		<td><?= $item[6] ?></td>
		<td><?= $item[7] ?></td>
		<td><?= $item[8] ?></td>
		<td><?= $item[9] ?></td>
	</tr>


<?php

}
?>
</table>
</body>
</html>