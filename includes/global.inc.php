<?php
require_once 'classes/User.class.php';
require_once 'classes/UserTools.class.php';
require_once 'classes/DB.class.php';

$pname = "ИнфоТрансфер: ЖКХ";
//connect to the database
$db = new DB();
$db->connect();

//initialize UserTools object
$userTools = new UserTools();
//start the session

session_start();

//refresh session variables if logged in
if (isset($_SESSION['logged_in'])) {
    $user = unserialize($_SESSION['user']);
    $_SESSION['user'] = serialize($userTools->get($user->id));
}
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="main.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>