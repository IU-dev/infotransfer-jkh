<?php
//register.php

require_once 'includes/global.inc.php';
$page = "z_counter.php";
require_once 'includes/header.inc.php';

$userTools = new UserTools();
//инициализируем php переменные, которые используются в форме

$error = "";
$login = "";
$bally = "";
$comment = "";
$phone = "";
$type = "";

if(isset($_POST['submit-addpoints'])) { 

$user = unserialize($_SESSION['user']);
$type = $_POST['type'];
$login = $_POST['login'];
$bally = $_POST['bally'];
$comment = $_POST['comment'];
$phone = $_POST['phone'];

$data['type'] = "'".$type."'";
$data['phone'] = "'".$phone."'";
$data['model'] = "'".$bally."'";
$data['address'] = "'".$login."'";
$data['placement'] = "'".$comment."'";
$data['state'] = "'0'";
$data['client_id'] = "'".$user->id."'";
$db->insert($data, 'counters');
$error = '<div class="alert alert-success" role="alert">Запрос выполнен.</div>';
}
?>
<html>
<head>
<title>Установка счетчика | Заявка | <?php echo $pname; ?></title>
</head>
<body>
<?php if(isset($_SESSION['logged_in'])) : ?>
<?php $user = unserialize($_SESSION['user']); ?>
<?php if($error) echo $error; 
	?>
	<h3>Заявка на установку счетчика</h3>
				<form class="form-vertical" action="z_counter.php" method="post">
				 <fieldset>
				 <div class="form-group">
					<label for="type" class="col-4 col-form-label">Тип счетчика</label> 
					<div class="col">
					  <select id="type" name="type" class="custom-select" required="required">
						<option value="EE">Электроэнергия</option>
						<option value="W">Вода</option>
					  </select>
					</div>
				  </div> 
				 <div class="form-group">
					  <label class="col control-label" for="login">Модель</label>  
					  <div class="col">
					  <input id="bally" name="bally" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $bally; ?>"/> 
					  </div>
					</div>
				  <div class="form-group">
					  <label class="col control-label" for="login">Адрес установки счетчика</label>  
					  <div class="col">
					  <input id="login" name="login" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $login; ?>"/> 
					  </div>
					  Адрес вводится по примеру: 426000 УР, г. Ижевск, ул. Ленина, д. 1, кв. 1
					</div>
					<div class="form-group">
					  <label class="col control-label" for="phone">Телефон</label>  
					  <div class="col">
					  <input id="phone" name="phone" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $phone; ?>"/> 
					  </div>
					</div>
					<div class="form-group">
					  <label class="col control-label" for="login">Удобное для установки дата и время</label>  
					  <div class="col">
					  <input id="comment" name="comment" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $comment; ?>"/> 
					  </div>
					</div>
					<div class="form-group">
					  <label class="col control-label" for="submit"></label>
					  <div class="col">
						<button value="submit-search" id="submit" name="submit-addpoints" class="btn btn-success">Выполнить запрос</button>
					  </div>
					</div>
					</fieldset>
					</form>
					
<br><br><h3>Активные заявки</h3>
<?php
    $counters = $db->select_desc_fs('counter', "client_id = '".$user->id."'");
	echo '<table class="table table-hover">' .
            '<thead>' .
            '<tr>' .
            '<th>№</th>' .
			'<th>ID счетчика</th>' .
			'<th>Данные счетчика</th>' .
			'<th>Адрес установки</th>' .
			'<th>Дата и время</th>' .
            '</tr>' .
            '</thead>';
	$i = 1;
	foreach($counters as $counter){
		if($counter['state'] == "0"){
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$counter['id'].'</td>';
			$sch = $db->select('counters', "id = '".$counter['counter']."'");
			echo '<td>'.$sch['serial'].' '.$sch['model'].'</td>';
			echo '<td>'.$counter['address'].'</td>';
			echo '<td>'.$counter['placement'].'</td>';
		echo '</tr>';
			$i = $i +1;
		}
	}
	echo '</table>';
?>
<?php else : ?>
Вы не авторизованы.
<?php endif; ?>
</body>
</html>