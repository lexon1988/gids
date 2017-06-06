<?php
set_time_limit(0);

include_once('db.php');
$db = new Database();

$members_ot=$_GET['members_ot'];
$members_do=$_GET['members_do'];
$country=$_GET['country'];
$city=$_GET['city'];
$search=$_GET['search'];
$limit=$_GET['limit'];


if($members_ot<>"" AND $members_do<>""){

	$mebers_sql="AND members_count>$members_ot AND members_count<$members_do";
}

if($country<>""){
	$country_sql="AND country=".$country;
}

if($city<>""){
	$city_sql="AND city=".$city;
}

if($limit<>""){
	$limit_sql=$limit;
	
	}else{
		$limit=1000;
		$limit_sql=1000;
	}

$items = $db->db_select("giddb","*","
	WHERE id<>0 
	$mebers_sql 
	$country_sql 
	$city_sql 
	ORDER BY members_count DESC 
	LIMIT $limit_sql 
	");
?>

<html>
<head>
	<title>Поиск по базе групп</title>
</head>
<body>
<style>



td{

	padding:5px;
	border:none;
	border-left:none;

}

.tabla{
	margin:0 auto;
	min-width: 50%;
	max-width: 100%;
	width: auto;
	
}

</style>



<form method="GET" action="index.php">
<table class='tabla'>
	<tr>
		<td><b>Кол-во подпис.: </b></td>
		<td><b>Поиск: </b></td>
		<td><b>Страна: </b></td>
		<td><b>Город: </b></td>
		<td><b>Лимит: </b></td>
		<td></td>
	</tr>
	<tr>
		<td>
			<input type='text' size='4' name='members_ot' value='<?= $members_ot ?>'> - <input type='text' size='4' name='members_do' value='<?= $members_do ?>'>
		</td>

		<td><input type='text' size='15' name='search'></td>
		<td><input type='text' size='3' name='country' value='<?= $country ?>'></td>
		<td><input type='text' size='3' name='city' value='<?= $city ?>'></td>
		<td><input type='text' size='3' name='limit' value='<?= $limit_sql ?>'></td>
		<td><input type="submit" value='Отправить' style="float:right;"></td>

</table>

</form>
<hr>


<table class='tabla'>
<tr>
	<td><b>№</b></td>
	<td><b>gids</b></td>
	<td><b>Кол-во п-ов</b></td>
	<td><b>name</b></td>
	<td><b>Страна</b></td>
	<td><b>Город</b></td>
	<td><b>c-1</b></td>
	<td><b>c-2</b></td>
	<td><b>c-3</b></td>
	<td><b>c-4</b></td>
	<td><b>c-5</b></td>
	<td><b>c-6</b></td>
</tr>

<?php


$i=0;
foreach ($items as $item) {
$i++;	
?>

<tr>
	<td><?= $i ?></td>
	<td><a href='<?= "https://vk.com/club".$item['gid'] ?>'><?= $item['gid'] ?></a></td>
	<td><?= $item['members_count'] ?></td>
	<td><?= substr($item['name'], 0,100) ?></td>
	<td><?= $item['country'] ?></td>
	<td><?= $item['city'] ?></td>
	<td><?= $item['contacts1'] ?></td>
	<td><?= $item['contacts2'] ?></td>
	<td><?= $item['contacts3'] ?></td>
	<td><?= $item['contacts4'] ?></td>
	<td><?= $item['contacts5'] ?></td>
</tr>	
<?php
}
?>

</table>

</body>

</html>