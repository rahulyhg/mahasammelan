<?php
include_once("Slim/Slim.php");
\Slim\Slim::registerAutoloader();
require "NotORM.php";
$app = new \Slim\Slim();
include_once("../config/vi-config.php");


function getConnection() {
    try {

        $conn = new PDO('mysql:host=localhost;dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $conn;
}
// mobile no vefify
function mobileNoCheck(){
	
	global $app;
	$req = $app->request();
	$mobile_number = $req->params('mobile_number');
	$email_address = $req->params('email_address');
	try{
			$dbCon = getConnection();
			$sql_mobile = "SELECT mobile_number,email_address FROM app_users WHERE mobile_number = '".$mobile_number."' AND email_address = '".$email_address."' ";
			$stmt = $dbCon->prepare($sql_mobile);  
			$stmt->execute();
			$user_check = $stmt->fetchObject();
			if(!empty($user_check)){	
					
						$user_array = array('success' => '1','user_check'=>'User for  '.$mobile_number.' and '.$email_address.' already exist');
						echo json_encode($user_array);
				
			}else{
					$user_array = array('success' => '0');
						$dbCon = null;
						echo json_encode($user_array);
				
				}
		}catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
	
	
	}

//User add APP function
function appUser(){
	global $app;
	$req = $app->request();
	$username = $req->params('username');
	$email_address = $req->params('email_address');
	$mobile_number = $req->params('mobile_number');
	$password = $req->params('password');
	$device_id = $req->params('device_id');
	$social_id = $req->params('social_id'); 
	$user_type = $req->params('user_type');
	try{
		
			$dbCon = getConnection();
			if(!empty($social_id)){

					$sql_check = "SELECT user_id FROM app_users WHERE email_address='".$email_address."'";
					$stmt_check = $dbCon->prepare($sql_check);  
					$stmt_check->execute();
					$user_check = $stmt_check->fetchObject();
					if(!empty($user_check)){
						
						$sql_update = "UPDATE app_users SET 
										 social_id = '".$social_id."'
										 WHERE `email_address` = '".$email_address."'
									  ";
						$stmt_update = $dbCon->prepare($sql_update);  
						$stmt_update->execute();	
						$user_array = array('success' => '1','user_array'=>getUserInfo($user_check->user_id));
						$dbCon = null;
						echo json_encode($user_array); 
							
					}else{
			
					
						$sql_in="INSERT INTO app_users SET
									username = '".$username."',
									email_address = '".$email_address."',
									mobile_number = '".$mobile_number."',
									password = '".$password."',
									device_id = '".$device_id."',
									join_date = '".date("Y-m-d h:i:s")."',
									social_id = '".$social_id."',
									user_type = '".$user_type."',
									login_type = '".$login_type."'
									";
								
					
						$stmt   = $dbCon->query($sql_in);
						$user = new stdClass();
						$user->id = $dbCon->lastInsertId();	
						if(!empty($user->id)){	
							$user_array = getUserInfo($user->id);
							$user_array = array('success' => '1','user_array'=>$user_array);
							
						  }else{	
								$user_array = array('success' => '0','user_array'=>$user_array);
							}
						echo json_encode($user_array);

			}
			}elseif(!empty($mobile_number)){
			$sql_check = "SELECT user_id FROM app_users WHERE mobile_number='".$mobile_number."'";
					$stmt= $dbCon->query($sql_check);  
					$stmt->execute();
					$user_check = $stmt->fetchObject();
						if(!empty($user_check)){
								$user_array = array('success' => '0','error'=>'Mobile number is already exists');
								$dbCon = null;
								echo json_encode($user_array); 	
						}else{
							
								$sql_check = "SELECT user_id FROM app_users WHERE email_address='".$email_address."'";
								$stmt= $dbCon->query($sql_check);  
								$stmt->execute();
								$user_check = $stmt->fetchObject();
								
							// code for if user email id is already exists
								if(!empty($user_check)){
										$user_array = array('success' => '0','error'=>'Email id is already exists');
										$dbCon = null;
										echo json_encode($user_array); 
										//die;
								}else{
						
									$sql_in="INSERT INTO app_users SET
											email_address = '".$email_address."',
											password = '".$password."',
											username = '".$username."',
											mobile_number = '".$mobile_number."',
											device_id = '".$device_id."',
											join_date = '".date("Y-m-d h:i:s")."',
											social_id = '".$social_id."',
											user_type = '".$user_type."'
											";						
									
									$stmt   = $dbCon->query($sql_in);
									$user = new stdClass();
									$user->id = $dbCon->lastInsertId();	
									if(!empty($user->id)){	
										$user_array = getUserInfo($user->id);
										$user_array = array('success' => '1','user_array'=>$user_array);
										$dbCon = null;
										 echo json_encode($user_array);
										
									  }
									else{	
											$user_array = array('success' => '0','user_array'=>$user_array);
											$dbCon = null;
											 echo json_encode($user_array);
				
										}
					}
						}
			}
	}
	catch(PDOException $e)
	{
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getUserInfo($user_array){
	$sql_user="SELECT user_id,username,mobile_number,email_address,user_type,device_id,join_date,social_id FROM app_users WHERE user_id='".$user_array."' ";
	try{
		$dbCon = getConnection();
		$stmt= $dbCon->query($sql_user);  
		$stmt->execute();
		$user_array = $stmt->fetchObject();
		$dbCon = null;
		return $user_array;
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
					
}
//user login 
function loginUser(){
	global $app;
	$req = $app->request();
	$mobile_number = $req->params('mobile_number');
	$password = $req->params('password');
	
	
	try{ 
			$sql_app ="SELECT * FROM app_users Where 
				mobile_number = '".$mobile_number."'
				AND password = '".$password."' 
				";
			$dbCon=getConnection();
			$stmt_check = $dbCon->prepare($sql_app);  
			$stmt_check->execute();
			$user_check = $stmt_check->fetchObject();	
			if(!empty($user_check)){	
				    $user_arr= array('success' => '1','user_detial'=>$user_check);
					echo json_encode($user_arr); 
				
				}
			else{
				  $user_arr= array('success' => '0' ,'error' =>'Mobile number or Password is incorrect');
				  echo json_encode($user_arr); 
			  			
			}		
	}
	catch(PDOException $e)
	{
		echo '{"error":{"text":'. $e->getMessage() .'}}';

	}	
}
function UpdateSadhuLatLang($user_id){
		global $app;
		$req = $app->request();
		$lat = $req->params('lat');
		$lang = $req->params('lang');
		$location_string = $req->params('location_string');
		try{
			$dbCon = getConnection();
			$sql_check_user = "SELECT user_id FROM app_users WHERE user_id = '".$user_id."'AND user_type ='sadhu'";
			$stmt= $dbCon->query($sql_check_user);  
			$stmt->execute();
			$user = $stmt->fetchObject();
			if(!empty($user)){
				$sql = "Update app_users SET latitude = '".$lat."' ,longitude = '".$lang."',location_string = '".$location_string ."' WHERE user_id = '".$user_id."'";
				$stmt= $dbCon->query($sql);  
				$stmt->execute();
				$user_arr= array('success' => '1');
				echo json_encode($user_arr); 			
			}else{
				
				 $user_arr= array('success' => '0');
				  echo json_encode($user_arr); 	
			}
			
		}catch(PDOException $e){
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}	
}
// function show sadhu
function getSadhu(){
	try{
			$dbCon =getConnection();
			$sql = "SELECT location_string,user_id,username FROM `app_users` WHERE `user_type`='sadhu' ORDER BY user_id DESC  ";
			$stmt= $dbCon->query($sql);  
			$stmt->execute();
			$user_array = $stmt->fetchAll(PDO::FETCH_OBJ);
			$user_array = array('success' => '1','user_array'=>$user_array);
			$dbCon = null;
			 echo json_encode($user_array);			
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }	
}
function getLocation(){
	
	global $app;
		$miles = 5;
		$req = $app->request();
		
		$lat = $req->params('lat');
		$lang = $req->params('lang');
		try{
			$dbCon = getConnection();
		$sql= "SELECT *, 
( 6371 * acos( cos( radians('.$lat.') ) * 
cos( radians( latitude ) ) * 
cos( radians( longitude ) - 
radians('.$lang.') ) + 
sin( radians('.$lat.') ) * 
sin( radians( latitude ) ) ) ) 
AS distance FROM app_users WHERE ( 3959 * acos( cos( radians('.$lat.') ) * 
cos( radians( latitude ) ) * 
cos( radians( longitude ) - 
radians('.$lang.') ) + 
sin( radians('.$lat.') ) * 
sin( radians( latitude ) ) ) ) < '.$miles.' ORDER BY distance ASC LIMIT 0, 10";
			echo $sql;
			$stmt= $dbCon->query($sql);  
			$stmt->execute();
			$user_array = $stmt->fetchAll(PDO::FETCH_OBJ);
			
		}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
	
}

function forgetPassword($email_address) {
    $sql = "SELECT user_id FROM app_users WHERE email_address= '".$email_address."'";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("email_address", $email_address);
        $stmt->execute();
        $user = $stmt->fetchObject();  
		
		if($user == false){
			$user_array = array('success' => '0');
			echo json_encode($user_array);
		}else{
			
			$user_array = array('success' => '1','user_array'=>$user);
			echo json_encode($user_array);
			
			$chars = "0123456789";
			$password = substr( str_shuffle( $chars ), 0, 8 );
			$sql_update = "UPDATE app_users SET `password`= '".$password."' WHERE user_id='".$user->user_id."'";
			$stmt = $dbCon->prepare($sql_update);  
			$stmt->execute();
			//echo $sql_update;
			//$dbCon = null;			
			 $from = 'php@vardhamaninfotech.com';
			 $from_name = 'Saddhu App';
			 $subject = "Forget Password";
			 $email_to = $email_address;		 
			 $content = 'Your new password for jewelsapp account is: '.$password;
			 $content_text = strip_tags($content);
			 $uri = 'https://mandrillapp.com/api/1.0/messages/send.json';
			 $params = array(
			   "key" => "Y5yTxcexpL4pq6wmSpGEHQ",
			   "message" => array(
			   "html" => $content,
			   "text" => $content_text,
			   "to" => array(
				array("name" => $email_to, "email" => $email_to)
			   ),
			   "from_email" => $from,
			   "from_name" => $from_name,
			   "subject" => $subject,
			   "track_opens" => true,
			   "track_clicks" => true,
	 		   "preserve_recipients" => true,
			   "auto_text" => true,
			   "url_strip_qs" => true,
			  ),
			  "async" => false
			 );
			
			 $postString = json_encode($params);
			 //print_r($params);
			 //die; 
			 $ch = curl_init();
			 curl_setopt($ch, CURLOPT_URL, $uri);
			 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
			 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
			 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			 curl_setopt($ch, CURLOPT_POST, true);
			 curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
			 $result = curl_exec($ch);  
			 $result = json_decode($result);
			 //print_r($result);	
			// if($result[0]->status == 'sent')
			
		}
        
	} catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
//admin parser

//get users

function mangeUsersGet($user_id){
	
	try{
		$dbCon = getConnection();
		$sql = "SELECT * FROM app_users ORDER BY user_id DESC ";
		$stmt_check = $dbCon->prepare($sql);  
			 			$stmt_check->execute();
					 	$user_check = $stmt_check->fetchALL(PDO::FETCH_OBJ);
						$user_array = array('success' => '1','user_check' => $user_check);
						echo json_encode($user_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function appUserDelete($user_id){
	try{
$dbCon = getConnection();
		$sql_delete = "DELETE FROM app_users WHERE user_id = '".$user_id."'";
		$res=$dbCon->prepare($sql_delete);
		$res->execute();
		$delete_array = array('success' => '1');
		$dbCon = null;
		echo json_encode($delete_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
	
}
function getuserByid($user_id){
	try{
		
			$sql_user="SELECT user_id,username,mobile_number,email_address,device_id,join_date,social_id,user_type FROM app_users WHERE user_id='".$user_id."' ";
		$dbCon = getConnection();
		$stmt= $dbCon->query($sql_user);  
		$stmt->execute();
		$user_array = $stmt->fetchObject();
		if(!empty($user_array)){
			$template_array = array('success' => '1','user_array'=>$user_array);
				$dbCon = null;
		echo json_encode($template_array);
		}else{
			$template_array = array('success' => '0');
				$dbCon = null;
		echo json_encode($template_array);
			
		}
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
	
}

//profile update 
function userProfileUpdate(){
	global $app ;
	$req = $app->request();
	$user_id = $req->params('user_id');
	$username = $req->params('username');
	$user_type = $req->params('user_type');
	$mobile_number = $req->params('mobile_number');
	$email_address = $req->params('email_address');
	try{
		$dbCon =getConnection();
		$sql_check = "SELECT user_id FROM app_users WHERE user_id = '".$user_id."'";
			$stmt_check = $dbCon->prepare($sql_check);  
			$stmt_check->execute();
			$user_check = $stmt_check->fetchObject();
			
				if(!empty($user_check)){
						$profile_update = "UPDATE app_users SET 
											username = '".$username."',
											user_type = '".$user_type."',
											mobile_number = '".$mobile_number."',
											email_address = '".$email_address."'
											WHERE user_id = '".$user_check->user_id."'
							"; 
						$stmt_update = $dbCon->prepare($profile_update);  
						$stmt_update->execute();						
						$user_array = array('success' => '1','user_array'=>'profile updated sucessfully');
						$dbCon = null;
						echo json_encode($user_array);		
				}else{
					
					$user_array = array('success' => '0');
					$dbCon = null;
					echo json_encode($user_array);
					
				}		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
	
}
function changePassword(){
		global $app;
		$req = $app->request();
		$password = $req->params('password');
		$newpassword = $req->params('newpassword');
		$confirmpassword = $req->params('confirmpassword');
		
		try{
			
				$db = getConnection();
				$sql_select = "SELECT  password FROM admin_user WHERE password = '".$password."' ";
				$stmt= $db->query($sql_select);  
				$stmt->execute();
				$user_password = $stmt->fetchObject();
				
				
				if(!empty($user_password)){
				
						if($user_password->password == $password){
								
								if($newpassword == $confirmpassword){
										$sql_update = "UPDATE admin_user SET password = '".$newpassword."' WHERE password = '".$password."' ";
										
										$stmt= $db->query($sql_update);  
										$stmt->execute();
										$password_array= array('success' => '1','msg' =>'Successfully Password Changed');
										echo json_encode($password_array);
								}else{
								
										$password_array= array('success' => '0','msg'=>'New Password and Confirm Password does not match');
										echo json_encode($password_array);
									}
						}
						
				}else{
							$password_array= array('success' => '0' , 'msg' => 'Old Password is incorrect ');
							echo json_encode($password_array);
				}	
		}
		catch(PDOException $e) {
        	echo '{"error":{"text":'. $e->getMessage() .'}}'; 

		
 		}

}
//applicaation  parser
//app user parser
$app->post('/user/check/mobileno','mobileNoCheck');
$app->post('/user/register','appUser');
$app->post('/user/login','loginUser');
$app->get('/account/forget_password/:email_address', 'forgetPassword'); 
//sadhu information
$app->get('/sadhu/informtion/get','getSadhu');
$app->post('/update/saddhu/location/:user_id','UpdateSadhuLatLang');
$app->post('/get/saddhu/location','getLocation');

//admin 
$app->get('/admin/manageusers/:user_id','mangeUsersGet');
$app->get('/delete/app_users/:user_id','appUserDelete');
$app->get('/admin/get/userByid/:user_id','getuserByid');
$app->post('/user/profileupdate','userProfileUpdate');
$app->post('/admin/chnagepassword','changePassword');
$app->run();