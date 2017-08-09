<?php
	if(empty($_SESSION['admin_id'])){
//		header('location:login.php');
		echo '<script>window.location.href="login.php"</script>';
	}	
?>