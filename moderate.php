<?php
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';


if (!isset($_GET['user'])) {
header("Location: /index.php");
exit;
}
	
if (!is_numeric($_GET['user'])) {
header("Location: /index.php");
exit;
}	
	

$ank3 = get_user((int)$_GET['user']);


if (!$ank3)
{
header("Location: /index.php");
exit;
}


if ($user['level']<4) {
	header("Location: /index.php");
	exit;
}



//mysql_query("INSERT INTO `user_level` (`access_type`, `user_id`) values('$name', '$ank3[id]')");

if (isset($_POST['Making'])) {


foreach ($_POST as $name => $value) {
    
    
    
$name = my_esc($name); 
$value = my_esc($value);

if ($name == "Making")continue;


//echo "$name =  $value";

//exit;

if (strlen2($value) == 1) {
	
mysql_query("DELETE FROM `user_level` WHERE `user_id` = '$ank3[id]' and `access_type` = '$name'");
	
} else {
	
	
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user_level` WHERE `access_type` = '$name' AND 
`user_id` = '$ank3[id]'"),0) == 0) {
mysql_query("INSERT INTO `user_level` (`access_type`, `user_id`) values('$name', '$ank3[id]')");


if ($name == 'guest')$hWhere = 'ჭირბიურო';
else if ($name == 'guest1')$hWhere = 'უკომპლექსო';
else if ($name == 'guest2')$hWhere = 'თინეიჯერები';
else if ($name == 'guest3')$hWhere = 'მარტოობა';
else if ($name == 'guest4')$hWhere = 'მეგობრობა';
else if ($name == 'guest5')$hWhere = 'გაცნობა';

$smstxt = my_esc(''.$ank3['nick'].'-ი გახდა მოდერატორი ოთახში '.$hWhere.', მიულოცეთ მას !');

mysql_query("INSERT INTO `guest` (`id_user`, `time`, `msg`, `pfile`) values('0', '".$time."', '".$smstxt."', '')");
mysql_query("INSERT INTO `guest1` (`id_user`, `time`, `msg`, `pfile`) values('0', '".$time."', '".$smstxt."', '')");
mysql_query("INSERT INTO `guest2` (`id_user`, `time`, `msg`, `pfile`) values('0', '".$time."', '".$smstxt."', '')");
mysql_query("INSERT INTO `guest3` (`id_user`, `time`, `msg`, `pfile`) values('0', '".$time."', '".$smstxt."', '')");
mysql_query("INSERT INTO `guest4` (`id_user`, `time`, `msg`, `pfile`) values('0', '".$time."', '".$smstxt."', '')");
mysql_query("INSERT INTO `guest5` (`id_user`, `time`, `msg`, `pfile`) values('0', '".$time."', '".$smstxt."', '')");



} 


	//echo '111111111111';
}	
    
    
}




//$_SESSION['message'] = "წარმატებით შესრულდა";
//header("Location: ?user=$ank[id]");
//exit;	


}






	

$set['title'] = 'მოდერატორის მიცემა - '.detect($ank3['nick']);
include_once '../sys/inc/thead.php';
title();
aut();

$qqwe = mysql_query("select * from `user_level_cat`"); 






?>





<style>

#pslqwek111 input[type='checkbox'] {
	height:20px;
	margin-top:4px;
}


.lwqeqw111dl1 {
	display:flex;
	flex-wrap:nowrap;
	gap:5px;
	flex-direction:column;
}

</style>



<div class="list-body">
<div class="list-menu">
	
	

<div class="nav1" id="pslqwek111">
<form method='post' action='?user=<?=$ank3['id'];?>'><div>





<div style="margin-bottom:15px;">მოდერირება</div>



<? while($wq = mysql_fetch_array($qqwe)):?>
<div class="lwqeqw111dl1">
	<div><label><?=detect($wq['desc']);?></label></div>
	<div>
	
<?

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user_level` WHERE `access_type` = '".my_esc($wq['level'])."' AND `user_id` = '".$ank3['id']."'"),0)>0) {
	$q1q1 = " selected";
	$q1q2 = "";
} else {
	$q1q1 = "";
	$q1q2 = " selected ";	
}
	

?>	

	<select name="<?=detect($wq['level']);?>">
		<option value="<?=detect($wq['level']);?>"<?=$q1q1;?>>მოდერატორი</option>
		<option value="0"<?=$q1q2;?>>არა</option>
	</select>
	
	
	</div>
	
	
	
</div>
<? endwhile;?>

<br/>
<input  type='submit' class="buttoni" name='Making' value='შეცვლა'>
</div></form></div>


</div>
</div>

<div style="margin-top:10px;"></div>

<a href="/info.php?id=<?=$ank3['id'];?>"><div class="list-menu hover">
  <i style="font-size: 21px; vertical-align: middle" class="fa fa-arrow-circle-left fa-fw"></i> პროფილში  </div></a>

<a href="/"><div class="list-menu hover">
  <i style="font-size: 21px; vertical-align: middle" class="fa fa-arrow-circle-left fa-fw"></i> მთავარზე  </div></a>



<?
include '../sys/inc/tfoot.php';
?>
