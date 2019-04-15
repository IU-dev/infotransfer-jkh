<?php 

require_once 'includes/global.inc.php';
$page = "settings.php";
require_once 'includes/header.inc.php';

if(!isset($_SESSION['logged_in'])) {
header("Location: login.php");
}

$user = unserialize($_SESSION['user']);

?>
<html>
<head>
<title>Счетчики | <?php echo $pname; ?></title>
</head>
<body>
<center>
<?php if(isset($_SESSION['logged_in'])) : ?>
<?php $user = unserialize($_SESSION['user']); ?>
<?php if($error) echo $error; ?>
	<h3>Счетчики клиента</h3>
	<?php
    $counters = $db->select_fs('counters', "client_id = '".$user->id."'");
	echo '<table class="table table-hover">' .
            '<thead>' .
            '<tr>' .
            '<th>№</th>' .
			'<th>ID</th>' .
			'<th>Тип</th>' .
            '<th>Серийный номер</th>' .
            '<th>Модель</th>' .
			'<th>Адрес</th>' .
			'<th>Действие</th>' .
            '</tr>' .
            '</thead>';
	$i = 1;
	foreach($counters as $counter){
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$counter['id'].'</td>';
			if($counter['type'] == "EE") echo '<td>Э/э</td>'; 
			else if($counter['type'] == "W") echo '<td>Вода</td>'; 
			echo '<td>'.$counter['serial'].'</td>';
			echo '<td>'.$counter['model'].'</td>';
			echo '<td>'.$counter['address'].'</td>';
			echo '<td><a href="counter?id='.$counter['id'].'">Сведения</a></td>';
			echo '</tr>';
			$i = $i +1;
	}
	echo '</table>';
?>
<br><br>
<?php else : ?>
Вы не авторизованы.
<?php endif; ?>
</center>


</body>
</html>