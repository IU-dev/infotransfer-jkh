<?php 

require_once 'includes/global.inc.php';
$page = "make_counter.php";
require_once 'includes/header.inc.php';


$user = unserialize($_SESSION['user']);

$noshow = 0;
if(!isset($_SESSION['logged_in'])) {
header("Location: login.php");
}

$userTools = new UserTools();

if(!isset($_GET['id']) && !isset($_POST['submit'])){
	$error = "Неверный запрос!";
}

if(isset($_POST['submit'])){
	$noshow = 1;
	$data['serial'] = "'".$_POST['serial']."'";
	$data['licevoy'] = "'".$_POST['licevoy']."'";
	$data['provider'] = "'".$_POST['provider']."'";
	$data['state'] = "'1'";
	$data['master'] = "'".$user->id."'";
	$db->update($data, 'counters', "id = '".$_POST['counterid']."'");
	$error = "<strong>Регистрация прошла успешно.</strong><br>";
	$userTools->notify_id($_POST['userid'], "Система", "Произведена установка счетчика (ID ".$_POST['counterid'].") мастером ".$user->displayname);
}

$user = unserialize($_SESSION['user']);

?>
<html>
<head>
<title>Установка счетчика | A2 | <?php echo $pname; ?></title>
</head>
<body>
<center>
<?php if($error) echo $error; ?>
<?php if(isset($_SESSION['logged_in']) && isset($_GET['id'])) : ?>
<?php if($user->admin > 0 && noshow != 1) : ?>
<?php $user = unserialize($_SESSION['user']); ?>
	<?php
	$info = $db->select('counters', "id = '".$_GET['id']."'");
	if($info['type'] == "EE") echo '<h3>Счетчик электроэнергии '.$info['model'].'</h3>';
	else if($info['type'] == "W") echo '<h3>Счетчик воды '.$info['model'].'</h3>';
	echo '<h4>Сведения по установке:</h4>';
	echo '<strong>Адрес: </strong>'.$info['address'];
	echo '<br><strong>Телефон: </strong>'.$info['phone'];
	echo '<br><strong>Комментарий к установке: </strong>'.$info['placement'];
?>
<form class="form-vertical" action="make_counter.php" method="post">
  <div class="form-group row">
    <label for="serial" class="col-4 col-form-label">Серийный номер</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-sort-numeric-asc"></i>
          </div>
        </div> 
        <input id="serial" name="serial" type="text" class="form-control" required="required">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="licevoy" class="col-4 col-form-label">Лицевой счет</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-database"></i>
          </div>
        </div> 
        <input id="licevoy" name="licevoy" type="text" class="form-control" required="required">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="provider" class="col-4 col-form-label">Поставщик услуг</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-building"></i>
          </div>
        </div> 
        <input id="provider" name="provider" type="text" class="form-control" required="required">
      </div>
    </div>
  </div> 
   <input type="hidden" id="counterid" name="counterid" value="<?php echo $_GET['id']; ?>">
   <input type="hidden" id="userid" name="userid" value="<?php echo $info['client_id']; ?>">
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Установить</button>
    </div>
  </div>
</form>
<br><br>
<?php else : ?>
Вы не авторизованы как мастер.
<?php endif; ?>
<?php else : ?>
Вы не авторизованы, или проведен неверный запрос.
<?php endif; ?>
</center>


</body>
</html>