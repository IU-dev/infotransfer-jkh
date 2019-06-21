<?php

require_once 'includes/global.inc.php';
$page = "settings.php";
require_once 'includes/header.inc.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}

$user = unserialize($_SESSION['user']);

?>
<html>
<head>
    <title>Аккаунт | <?php echo $pname; ?></title>
</head>
<body>
<center>
    <h1><?php echo $user->displayname; ?></h1>
    <h3><?php echo $user->username; ?></h3>
    <br><br>
    <h3>Баланс счета: <?php echo number_format((float)$user->points, 2, '.', ''); ?> рублей.</h3>
</center>
<?php
echo '<table class="table table-sm table-hover">' .
    '<thead>' .
    '<tr>' .
    '<th>Дата, время</th>' .
    '<th>От кого</th>' .
    '<th>Содержание</th>' .
    '</tr>' .
    '</thead>';
$notifs = $db->select_desc_fs('logs', "userid = '" . $user->id . "'");
foreach ($notifs as $row) {
    echo '<tr>';
    if ($row['displayed'] == '0') {
        $data['displayed'] = '1';
        echo '<td class="table-warning">' . date("d.m.Y H:i:s", strtotime($row['datetime'] . " GMT")) . '</td>' .
            '<td class="table-warning">' . $row['ot'] . '</td>' .
            '<td class="table-warning">' . $row['text'] . '</td>' .
            '</tr>';
        $db->update($data, 'logs', "id = '" . $row['id'] . "'");
    } else {
        echo '<td>' . date("d.m.Y H:i:s", strtotime($row['datetime'] . " GMT")) . '</td>' .
            '<td>' . $row['ot'] . '</td>' .
            '<td>' . $row['text'] . '</td>' .
            '</tr>';
    }
}
echo '</table>';
?>

</body>
</html>