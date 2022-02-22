<?php
	require_once 'assets/backend/config.php';


	if (!empty($maintaince)) {

		die($maintaince);

	}



	if (!isset($_SESSION['username']) || !(isset($_SERVER['HTTP_REFERER']))) {

		die();

	}

$username = $_SESSION['username'];

$IMPORTANT = $odb -> query("SELECT COUNT(*) FROM `logs` WHERE `user` = '$username'");
$anylogs = $IMPORTANT->fetchColumn(0);
if ($anylogs < 1) {
	die(error('You have no any attack logs yet!'));
}

$SQLFIRSTCHECK = $odb -> query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `user` = '$username'");
$areurunning = $SQLFIRSTCHECK->fetchColumn(0);
if ($areurunning > 0) {
	die(error('Please stop all attacks before!'));
}

$SQLKILLER = $odb -> query("DELETE FROM `logs` WHERE `user` = '$username'");

$SQLCHECKER = $odb -> query("SELECT COUNT(*) FROM `logs` WHERE `user` = '$username'");
$logsafter = $SQLCHECKER->fetchColumn(0);
if ($logsafter < 1) {
	die(success('Logs cleared!'));
}
?>