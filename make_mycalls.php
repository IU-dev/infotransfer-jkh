<?php 

require_once 'includes/global.inc.php';
$page = "make_mycalls.php";
require_once 'includes/header.inc.php';

if(!isset($_SESSION['logged_in'])) {
header("Location: login.php");
}

$user = unserialize($_SESSION['user']);

if(isset($_GET['ticket'])){
	$data['state'] = "'2'";
	$data['master'] = "'".$user->id."'";
	$db->update($data, 'tickets', "id = '".$_GET['ticket']."'");
	$error = '<div class="alert alert-success" role="alert">Заявка закрыта.</div>';
	$userTools->notify_id($_GET['user'], "Система", "Заявка с ID ".$_GET['ticket']." выполнена мастером ".$user->displayname);
}

?>
<html>
<head>
<title>Мои вызовы | А1 | <?php echo $pname; ?></title>
</head>
<body>
<center>
<?php if(isset($_SESSION['logged_in'])) : ?>
<?php $user = unserialize($_SESSION['user']); ?>
<?php if($user->admin > 0) : ?>
<?php if($error) echo $error; ?>
	<h3>Мои вызовы</h3>
<?php
    $counters = $db->select_fs('tickets', "state = '1' AND master = '".$user->id."'");
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
			echo '<td><a href="make_mycalls.php?user='.$cli['id'].'&ticket='.$counter['id'].'">Закончить работу</a></td>';
			
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