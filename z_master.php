<?php
//register.php

require_once 'includes/global.inc.php';
$page = "z_master.php";
require_once 'includes/header.inc.php';

$userTools = new UserTools();
//инициализируем php переменные, которые используются в форме

$error = "";
$user = "";
$problem = "";
$datetime = "";
$counter = "";
$comment = "";

if(isset($_POST['submit-addpoints'])) { 

$user = unserialize($_SESSION['user']);
$user = $_POST['user'];
$problem = $_POST['problem'];
$comment = $_POST['comment'];
$datetime = $_POST['datetime'];
$counter = $_POST['counter'];
$data['user'] = "'".$user."'";
$data['problem'] = "'".$problem."'";
$data['comment'] = "'".$comment."'";
$data['datetime'] = "'".$datetime."'";
$data['counter'] = "'".$counter."'";
$data['state'] = "'0'";
$data['master'] = "'0'";
$db->insert($data, 'tickets');
$error = '<div class="alert alert-success" role="alert">Запрос выполнен.</div>';
}
?>
<html>
<head>
<title>Вызов мастера | Заявка | <?php echo $pname; ?></title>
</head>
<body>
<?php if(isset($_SESSION['logged_in'])) : ?>
<?php $user = unserialize($_SESSION['user']); ?>
<?php if($error) echo $error; 
	?>
	<h3>Заявка на вызов мастера</h3>
				<form class="form-vertical" action="z_master.php" method="post">
				 <fieldset>
				 <div class="form-group">
					<label for="counter" class="col-4 col-form-label">Счетчик</label> 
					<div class="col">
					  <select id="counter" name="counter" class="custom-select" required="required">
					  <?php 
					  $counters = $db->select_fs('counters', "client_id = '".$user->id."'");
					  foreach($counters as $counter){
						echo '<option value="'.$counter['id'].'">'.$counter['serial'].' '.$counter['model'].'</option>';
					  }
						?>
					  </select>
					</div>
				  </div> 
					<div class="form-group">
					  <label class="col control-label" for="comment">Удобное для выезда дата и время</label>  
					  <div class="col">
					  <input id="comment" name="comment" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $comment; ?>"/> 
					  </div>
					</div>
					<div class="form-group">
					  <label class="col control-label" for="problem">Описание проблемы</label>  
					  <div class="col">
					  <input id="problem" name="problem" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $problem; ?>"/> 
					  </div>
					</div>
					<input type="hidden" id="user" name="user" value="<?php echo $user->id; ?>">
					<div class="form-group">
					  <label class="col control-label" for="submit"></label>
					  <div class="col">
						<button value="submit-search" id="submit" name="submit-addpoints" class="btn btn-success">Выполнить запрос</button>
					  </div>
					</div>
					</fieldset>
					</form>
					<br><br><h3>Заявки</h3>
<?php
    $counters = $db->select_desc_fs('tickets', "user = '".$user->id."'");
	echo '<table class="table table-hover">' .
            '<thead>' .
            '<tr>' .
            '<th>№</th>' .
			'<th>ID счетчика</th>' .
			'<th>Описание проблемы</th>' .
			'<th>Статус</th>' .
            '</tr>' .
            '</thead>';
	$i = 1;
	foreach($counters as $counter){
		if($counter['state'] == "0"){
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$counter['counter'].'</td>';
			echo '<td>'.$counter['comment'].'</td>';
			if($counter['state'] = "0") echo '<td>Новая</td>';
			$master = $db->select('users', "id = '".$counter['master']."'");
			if($counter['state'] = "1") echo '<td>Взята мастером '.$master['displayname'].'</td>';
			if($counter['state'] = "2") echo '<td>Выполнена мастером '.$master['displayname'].'</td>';
		echo '</tr>';}
			$i = $i +1;
	}
	echo '</table>';
?>
<?php else : ?>
Вы не авторизованы.
<?php endif; ?>
</body>
</html>