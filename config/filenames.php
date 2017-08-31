<?php
	error_reporting(0);
	//require_once('MCrypt.php');
	
	$amNY = new DateTime('Asia/Kolkata');
	$today_datetime_gmt = $amNY->format('Y-m-d H:i:s');
	$today_time_gmt = $amNY->format('Y-m-d');
 
	define('PW','vardhamaninfotech');
	$pw = 'vardhamaninfotech';
	define('IP_ADDRESS',$_SERVER['REMOTE_ADDR']);
	define('CURECITY_EMAIL', 'php@vardhaman.com');
	define("TODAY_DATE_TIME",$today_datetime_gmt,true);
	define("TODAY_DATE",$today_time_gmt,true);

	define("ITEM_PER_PAGE",5,true);


/* */
	define("DOCTOR_ID",'1',true);
	define("CLINIC_HOSPITAL_ID",'2',true);
	define("HEALTH_SERVICES_ID",'3',true);
	define("EDU_CENTER_ID",'4',true);
	define("MED_UNIVERCITY_ID",'5',true);
/* */

/* Folder name start here */
	define("UPLOAD_FOLDER",'uploads/',true);
	define("MANAGERAREA_FOLDER",'managerarea/',true);
/* Folder name end here */


	$whitelist = array('127.0.0.1', "::1");
	if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
		//dbname: mahasammelan
		//Mahasammelan!@#123
		//password: Vardhaman!@#12
		//db user: vardhaman

		define("ADMIN_URL","http://localhost/core/mahasammelan/",true);
		define("IMG_URL","http://localhost/core/mahasammelan/assets/globals/plugins/jquery-file-upload/server/php/files/",true);
		define("VIDEO_URL","http://localhost/core/mahasammelan/uploads/",true);
		define("DB_HOST","localhost",true);
		define("DB_NAME","sadhu",true);
		define("DB_USERNAME","root",true);
		define("DB_PASSWORD","",true);

	}else{
		define("ADMIN_URL","http://mahasammelan.in/",true);
		define("IMG_URL","http://mahasammelan.in/assets/globals/plugins/jquery-file-upload/server/php/files/",true);
		define("VIDEO_URL","http://mahasammelan.in//uploads/",true);
		define("DB_HOST","localhost",true);
		define("DB_NAME","dbsadhu",true);
		define("DB_USERNAME","dbsadhu",true);
		define("DB_PASSWORD","Shravak@sadhu123",true);
	}

?>
