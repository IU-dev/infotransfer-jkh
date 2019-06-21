<?php 

require_once 'includes/global.inc.php';
$page = "counters.php";
require_once 'includes/header.inc.php';

if(!isset($_SESSION['logged_in'])) {
header("Location: login.php");
}

if(!isset($_GET['id'])){
	$error = "Неверный запрос!";
}

$user = unserialize($_SESSION['user']);

?>
<html>
<head>
<title>Счетчик | <?php echo $pname; ?></title>
</head>
<body>
<center>
<?php if($error) echo $error; echo '<br>'; ?>
<?php if(isset($_SESSION['logged_in']) && isset($_GET['id'])) : ?>
<?php $user = unserialize($_SESSION['user']); ?>
	<?php
	$info = $db->select('counters', "id = '".$_GET['id']."'");
	if($info['client_id'] != $user->id){ echo 'Попытка обхода - Вы пытаетесь получить информацию по чужому счетчику.'; }
	else{ if($info['type'] == "EE") echo '<h3>Счетчик электроэнергии '.$info['model'].'&nbsp;&nbsp;&nbsp;<span class="badge badge-secondary">CTR-'.$info['id'].'</span></h3>';
	else if($info['type'] == "W") echo '<h3>Счетчик воды '.$info['model'].'</h3>';
	echo '<br><strong>Поставщик услуг: </strong>'.$info['provider'];
	echo '<br><strong>Серийный номер: </strong>'.$info['serial'];
	echo '<br><strong>Лицевой счет поставщика: </strong>'.$info['licevoy'];
	echo '<br><strong>Адрес размещения: </strong>'.$info['address'];
	$ms = $db->select('users', "id = '".$info['master']."'");
	echo '<br><strong>Установил мастер: </strong>'.$ms['displayname'].'<br><br>';
	/* echo '<h4>Пул показаний</h4>';
    $pool = $db->select_desc_fs('pool', "counter_id = '".$info['id']."'");
	echo '<strong>Последнее показание: </strong>'.$pool[0]['data'];
	echo '<table class="table table-hover table-sm">' .
            '<thead>' .
            '<tr>' .
			'<th>Дата отправки</th>' .
			'<th>Показание</th>' .
            '</tr>' .
            '</thead>';
	$i = 1;
	foreach($pool as $counter){
			echo '<tr>';
			echo '<td>'.date("d.m.Y H:i:s", strtotime($counter['send_date'] . " GMT")).'</td>';
			echo '<td>'.$counter['data'].'</td>';
			echo '</tr>';
			$i = $i +1;
	}
	echo '</table>'; */ }
	?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Дата, время', 'Показание'],
                <?php
                $pool = $db->select_fs('pool', "counter_id = '".$info['id']."'");
                $i = 1;
                for($i = 0; $i <= count($pool); $i = $i + 1){
                    echo "['".date("d.m.Y H:i:s", strtotime($pool[$i]['send_date'] . " GMT"))."',  ".$pool[$i]['data'].",],";
                }
                echo "['".date("d.m.Y H:i:s", strtotime($pool[$i]['send_date'] . " GMT"))."',  ".$pool[$i]['data'].",],";
                ?>
            ]);

            var options = {
                title: 'История показаний счетчика',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
    <div id="curve_chart"></div>
<br><br>
<?php else : ?>
Вы не авторизованы, или проведен неверный запрос.
<?php endif; ?>
</center>


</body>
</html>