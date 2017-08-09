<?php
require_once('config/Query.Inc.php');
include_once("check-login.php");
$Obj = new Query(DB_NAME);
$error_msg = '';

if($_POST['table_name'] == 'gallery_images'){
	unlink(IMG_URL.$_POST['image_name']);
	unlink(IMG_URL.'thumbnail/'.$_POST['image_name']);
}	
	
$result = $Obj->httpPost(ADMIN_URL.'api/deletedata',array('delete_id'=>trim($_POST['delete_id']),'table_name'=>$_POST['table_name'],'field_name'=>$_POST['field_name']));
$result = json_decode($result);


?>
