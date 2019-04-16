<?php 

require_once 'includes/global.inc.php';
$page = "make_calls.php";
require_once 'includes/header.inc.php';

if(!isset($_SESSION['logged_in'])) {
header("Location: login.php");
}

$user = unserialize($_SESSION['user']);

if(isset($_GET['ticket'])){
	$data['state'] = "'1'";
	$data['master'] = "'".$user->id."'";
	$db->update($data, 'tickets', "id = '".$_GET['ticket']."'");
	$error = '<div class="alert alert-success" role="alert">Заявка взята в работу</div>';
}

?>
<html>
<head>
<title>Все вызовы | А1 | <?php echo $pname; ?></title>
</head>
<body>
<center>
<?php if(isset($_SESSION['logged_in'])) : ?>
<?php $user = unserialize($_SESSION['user']); ?>
<?php if($user->admin > 0) : ?>
<?php if($error) echo $error; ?>
	<h3>Все вызовы</h3>
<?php
    $counters = $db->select_fs('tickets', "state = '0'");
	echo '<table class="table table-hover">' .
            '<thead>' .
            '<tr>' .
            '<th>№</th>' .
			'<th>ID счетчика</th>' .
			'<th>Сведения по клиенту</th>' .
			'<th>Дата и время</th>' .
			'<th>Описание проблемы</th>' .
			'<th>Действие</th>' .
            '</tr>' .
            '</thead>';
	$i = 1;
	foreach($counters as $counter){
			$sch = $db->select('counters', "id = '".$counter['counter']."'");
			$cli = $db->select('users', "id = '".$counter['user']."'");
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$sch['serial'].' '.$sch['model'].'</td>';
			echo '<td>'.$cli['displayname'].' ('.$sch['address'].')</td>';
			echo '<td>'.$counter['comment'].'</td>';
			echo '<td>'.$counter['problem'].'</td>';
			echo '<td><a href="make_calls.php?ticket='.$counter['id'].'">Взять в работу</a></td>';
			
		echo '</tr>';
			$i = $i +1;
	}
	echo '</table>';
?>
<br><br>
<?php else : ?>
Вы не авторизованы как мастер.ы
<?php endif; ?>
<?php else : ?>
Вы не авторизованы.
<?php endif; ?>
</center>


</body>
</html>