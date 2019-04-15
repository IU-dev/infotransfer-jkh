<?php 

require_once 'includes/global.inc.php';
$page = "make_counters.php";
require_once 'includes/header.inc.php';

if(!isset($_SESSION['logged_in'])) {
header("Location: login.php");
}

$user = unserialize($_SESSION['user']);

?>
<html>
<head>
<title>Установить счетчик | А1 | <?php echo $pname; ?></title>
</head>
<body>
<center>
<?php if(isset($_SESSION['logged_in'])) : ?>
<?php $user = unserialize($_SESSION['user']); ?>
<?php if($user->admin > 0) : ?>
<?php if($error) echo $error; ?>
	<h3>Счетчики на установку</h3>
	<?php
    $counters = $db->select_fs('counters', "state = '0'");
	echo '<table class="table table-hover">' .
            '<thead>' .
            '<tr>' .
            '<th>№</th>' .
			'<th>ID счетчика</th>' .
			'<th>Клиент</th>' .
			'<th>Тип</th>' .
            '<th>Модель</th>' .
            '<th>Адрес</th>' .
			'<th>Действие</th>' .
            '</tr>' .
            '</thead>';
	$i = 1;
	foreach($counters as $counter){
		if($counter['state'] == "0"){
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$counter['id'].'</td>';
			$client = $db->select('users', "id = '".$counter['client_id']."'");
			echo '<td>'.$counter['client_id'].' ('.$client['displayname'].')</td>';
			if($counter['type'] == "EE") echo '<td>Э/э</td>'; 
			else if($counter['type'] == "W") echo '<td>Вода</td>'; 
			echo '<td>'.$counter['model'].'</td>';
			echo '<td>'.$counter['address'].'</td>';
			echo '<td><a href="make_counter?id='.$counter['id'].'">Установить</a></td>';
		echo '</tr>';}
			$i = $i +1;
	}
	echo '</table>';
?>
<br><br>
<?php else : ?>
Вы не авторизованы как администратор.
<?php endif; ?>
<?php else : ?>
Вы не авторизованы.
<?php endif; ?>
</center>


</body>
</html>