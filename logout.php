<?php
	require_once('config/Query.Inc.php');
	$Obj = new Query($dbname);
	unset($_SESSION['admin_id']);
	unset($_SESSION['firstname']);
	unset($_SESSION['email_address']);
	unset($_SESSION['admin_status']);

	$Obj->Redirect('login.php');

?>
