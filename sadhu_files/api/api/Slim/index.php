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
//User add APP function
function validateEmail($email, $domainCheck = false, $verify = false, $probe_address='', $helo_address='', $return_errors=false) {
    global $debug;
    
    /*
    Time-outs.
    Be sure to have set PHP's "max_execution_time" to some value greater than the total time of the
    communication. This means of course also (a fair amount) larger than any of the next two values.
    Of course, large timeouts will cause the verification to take alot of time. There are servers
    that have configured such large delays that they are unsuitable for verifcation with a web page.

    TCP connect timeout (seconds). Some servers deliberately wait a while before responding (tarpitting). */
    $tcp_connect_timeout = 18000;
    /*
    Some server (exim) can be configured to wait before acknowledging. If you issues the next command
    too soon, it will drop the SMTP conversation with stuff like: "554 SMTP synchronization error".
    */
    $smtp_timeout = 6000;

    

    if($debug) {echo "<pre>";}

    # Check email syntax with regex
    if (preg_match('/^([a-zA-Z0-9\'\._\+-]+)\@((\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,7}|[0-9]{1,3})(\]?))$/', $email, $matches)) {
        $user = $matches[1];
        $domain = $matches[2];
        
        /*
            Some MTAs do not like people ringing their door bell too much.
            If this is the case, sender    verification will get your IP address
            blacklisted. This is a problem when your web server is also a
            mail server. If you MTA is Postfix, you can whitelist addresses
            so that they are not verified any more:
            in Postfix, see    http://www.postfix.org/ADDRESS_VERIFICATION_README.html#sender_always
            This list should be taken into account by this script, otherwise 
            your IP address will get blacklisted anyway.
            The code below ONLY works when the access list is of type 'pcre', see
            http://www.postfix.org/pcre_table.5.html for how to construct this.
        */
        $whitelist= '/etc/postfix/sender_access'; 
        if($exluded = explode("\n", @file_get_contents($whitelist))) {
            $regexes=array();
            foreach ($exluded as $line) {
                preg_match('/^(\/.*?\/)\s+OK/', $line, $matches);
                if(@$matches[1]) {
                    array_push($regexes, $matches[1]);
                }
            }
            foreach ($regexes as $regex) {
                preg_match($regex, "$user@$domain", $m);
                if(@$m[0]) {
                    if($debug) { echo "$whitelist contains matching whitelist regex '".$regex."'\n"; }
                    if($return_errors) {
                        # Give back details about the error(s).
                        # Return FALSE if there are no errors.
                        if(isset($error)) return htmlentities($error); else return false;
                    } else {
                        # 'Old' behaviour, simple to understand
                        if(isset($error)) return false; else return true;
                    }
                }
            } 
        }
        
        
        # Check availability of  MX/A records
        if ($domainCheck) {
            if(function_exists('checkdnsrr')) {
                # Construct array of available mailservers
                getmxrr($domain, $mxhosts, $mxweight);
                if(count($mxhosts) > 0) {
                    for($i=0;$i<count($mxhosts);$i++){
                        $mxs[$mxhosts[$i]] = $mxweight[$i];
                    }
                    asort($mxs);
                    $mailers = array_keys($mxs);
                # No MX found, use A
                } elseif(checkdnsrr($domain, 'A')) {
                    $mailers[0] = gethostbyname($domain);
                } else {
                    $mailers=array();
            }
            } else {
            # DNS functions do not exist - we are probably on Win32.
            # This means we have to resort to other means, like the Net_DNS PEAR class.
            # For more info see http://pear.php.net
            # For this you also need to enable the mhash module (lib_mhash.dll).
            # Another way of doing this is by using a wrapper for Win32 dns functions like
            # the one descrieb at http://px.sklar.com/code.html/id=1304
                require_once 'Net/DNS.php';
                $resolver = new Net_DNS_Resolver();
                # Workaround for bug in Net_DNS, you have to explicitly tell the name servers
                #
                # ***********  CHANGE THIS TO YOUR OWN NAME SERVERS **************
                $resolver->nameservers = array ('217.149.196.6', '217.149.192.6');
                
                $mx_response = $resolver->query($domain, 'MX');
                $a_response  = $resolver->query($domain, 'A');
                if ($mx_response) {
                    foreach ($mx_response->answer as $rr) {
                            $mxs[$rr->exchange] = $rr->preference;
                    }
                    asort($mxs);
                    $mailers = array_keys($mxs);
                } elseif($a_response) {
                    $mailers[0] = gethostbyname($domain);
                } else {
                    $mailers = array();
                }
                
            }
            
            $total = count($mailers);
            # Query each mailserver
            if($total > 0 && $verify) {
                # Check if mailers accept mail
                for($n=0; $n < $total; $n++) {
                    # Check if socket can be opened
                    if($debug) { echo "Checking server $mailers[$n]...\n";}
                    $errno = 0;
                    $errstr = 0;
                    # Try to open up TCP socket
                    if($sock = @fsockopen($mailers[$n], 25, $errno , $errstr, $tcp_connect_timeout)) {
                        $response = fread($sock,8192);
                        if($debug) {echo "Opening up socket to $mailers[$n]... Succes!\n";}
                        stream_set_timeout($sock, $smtp_timeout);
                        $meta = stream_get_meta_data($sock);
                        if($debug) { echo "$mailers[$n] replied: $response\n";}
                        $cmds = array(
                            "HELO $helo_address",
                            "MAIL FROM: <$probe_address>",
                            "RCPT TO:<$email>",
                            "QUIT",
                            );
                            # Hard error on connect -> break out
                            # Error means 'any reply that does not start with 2xx '
                            if(!$meta['timed_out'] && !preg_match('/^2\d\d[ -]/', $response)) {
                                $error = "Error: $mailers[$n] said: $response\n";
                                break;
                            }
                            foreach($cmds as $cmd) {
                                $before = microtime(true);
                                fputs($sock, "$cmd\r\n");
                                $response = fread($sock, 4096);
                                $t = 1000*(microtime(true)-$before);
                                if($debug) {echo htmlentities("$cmd\n$response") . "(" . sprintf('%.2f', $t) . " ms)\n";}
                                if(!$meta['timed_out'] && preg_match('/^5\d\d[ -]/', $response)) {
                                    $error = "Unverified address: $mailers[$n] said: $response";
                                    break 2;
                                }
                            }
                            fclose($sock);
                            if($debug) { echo "Succesful communication with $mailers[$n], no hard errors, assuming OK";}
                            break;
                    } elseif($n == $total-1) {
                        $error = "None of the mailservers listed for $domain could be contacted";
                    }
                }
            } elseif($total <= 0) {
                $error = "No usable DNS records found for domain '$domain'";
            }
        }
    } else {
        $error = 'Address syntax not correct';
    }
    if($debug) { echo "</pre>";}
    if($return_errors) {
        # Give back details about the error(s).
        # Return FALSE if there are no errors.
        if(isset($error)) return nl2br(htmlentities($error)); else return false;
    } else {
        # 'Old' behaviour, simple to understand
        if(isset($error)) return false; else return true;
    }
}
function addAppUser(){
	global $app;
	$req = $app->request();
	$email_address = $req->params('email_address');
	$app_id	= $req->params('app_id');
	$password = $req->params('password');
	$register_with = $req->params('register_with');
	$device_id = $req->params('device_id');
	$social_id = $req->params('social_id'); 
    $login_type = $req->params('login_type'); 

	
	try{
		
			$dbCon = getConnection();
			
	
			if(!empty($social_id)){

					$sql_check = "SELECT user_id FROM app_users WHERE email_address='".$email_address."'";
					$stmt_check = $dbCon->prepare($sql_check);  
					$stmt_check->execute();
					$user_check = $stmt_check->fetchObject();
					if(!empty($user_check)){
						
						$sql_update = "UPDATE app_users SET 
										 login_type = '".$login_type."',
										 register_with = '".$register_with."',
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
									email_address = '".$email_address."',
									password = '".$password."',
									app_id = '".$app_id."',
									register_with = '".$register_with."',
									device_id = '".$device_id."',
									join_date = '".date("Y-m-d h:i:s")."',
									social_id = '".$social_id."',
									login_type = '".$login_type."'
									";
								
					
						$stmt   = $dbCon->query($sql_in);
						$user = new stdClass();
						$user->id = $dbCon->lastInsertId();	
						if(!empty($user->id)){	
							$user_array = getUserInfo($user->id);
							$user_array = array('success' => '1','user_array'=>$user_array);
							
						  }
						else{	
								$user_array = array('success' => '0','user_array'=>$user_array);
							}
						echo json_encode($user_array);

			}
			}else{
					
					$email_check = validateEmail($email_address,true, true, 'php@vardhamaninfotech.com', 'php@vardhamaninfotech.com', true );
					if(!empty($email_check)){
							$check_array = array('success' => '0','check_array'=>'This Email id appear to be incorrect');
							
							echo json_encode($check_array); 
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
										app_id = '".$app_id."',
										register_with = '".$register_with."',
										device_id = '".$device_id."',
										join_date = '".date("Y-m-d h:i:s")."',
									
										social_id = '".$social_id."',
										login_type = '".$login_type."'
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
//appuser info function
function getUserInfo($user_array){
			$sql_user="SELECT user_id,email_address,register_with,device_id,join_date,last_login,social_id,login_type,app_id,status FROM app_users WHERE user_id='".$user_array."' ";
			try{
				$dbCon = getConnection();
				$stmt= $dbCon->query($sql_user);  
				$stmt->execute();
				$user_array = $stmt->fetchObject();
				$dbCon = null;
				return $user_array;
    } 
	catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
					
}
// workouts add function
function Workouts(){
		global $app;
		$req = $app->request();
		$app_id = $req->params('app_id');
		$name = $req->params('name');
		$workout_image = $req->params('workout_image');
		$video_time = $req->params('video_time');
		$logo = $req->params('logo');
		$summarized_image = $req->params('summarized_image');
		$workout_audio = $req->params('workout_audio');
		
		try{
		
			
					$dbCon=getConnection();
					$sql_list="INSERT INTO workouts SET
					app_id ='".$app_id."',
					name ='".$name."',
					workout_image =  '".$workout_image."',
					video_time ='".$video_time."',
					logo = '".$logo."',
					summarized_image = '".$summarized_image."',
					workout_audio = '".$workout_audio."'
					";
					$stmt   = $dbCon->query($sql_list);
					$user = new stdClass();
					$user->id = $dbCon->lastInsertId();	
					$user_array = GetWorkInfo($user->id);
					$list = array('success' => '1','user_array' =>$user_array);
					$dbCon = null;
					echo json_encode($list);
	
	}
	catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 

	}
}
function GetWorkInfo($user_array){
		
			try{
					$dbCon = getConnection();
					$sql_user="SELECT work_id, name , app_id, workout_image, video_time ,logo,summarized_image,workout_audio from workouts WHERE work_id = '$user_array' ";
					$stmt= $dbCon->query($sql_user);  
					$stmt->execute();
					$user_array = $stmt->fetchObject();
					$dbCon = null;
					return $user_array;
    } 
	catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
//workout view 
function worklistView($app_id){
	
	try{
			$sql_view= "SELECT * FROM workouts  WHERE app_id = '".$app_id."' ";
			$dbCon = getConnection(); 
			$stmt = $dbCon->prepare($sql_view);  
			$stmt->execute();
			$user_work= $stmt->fetchALL(PDO::FETCH_OBJ);
			
			if(!empty($user_work)){
					
					foreach($user_work as $work){
						
						 $work->workout_image = BASE_URL.IMAGES_URL.$work->workout_image;
						 $work->logo = BASE_URL.IMAGES_URL.$work->logo;
						 $work->summarized_image =  BASE_URL.IMAGES_URL.$work->summarized_image;
							$time = explode(':', $work->video_time); 
							$milli_second = $time[0]*6000 + $time[1]*1000;
							$work->video_time = $milli_second ;
							$work->workout_audio = 	BASE_URL.AUDIO_URL.$work->workout_audio;

	  
					}
						$work_array = array('success' => '1','workout_array'=> $user_work );
						echo json_encode($work_array);
						
			}else{
						$work_array = array('success' => '0','workout_array'=> 'found empty' );
						echo json_encode($work_array);
			
			}
		}
	catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
//workout update function
function workoutUpdate(){
			global $app;
	 	$req = $app->request();
		$work_id = $req->params('work_id');
		$app_id = $req->params('app_id');
		$name = $req->params('name');
		$workout_image = $req->params('workout_image');
		$video_time = $req->params('video_time');
		$logo = $req->params('logo');
		$summarized_image = $req->params('summarized_image');
		$workout_audio = $req->params('workout_audio');
		try{
			$db=getConnection();
			$sql_update="UPDATE workouts SET
						app_id = '".$app_id."',
						name = '".$name."',
						workout_image = '".$workout_image."',
						video_time = '".$video_time."',
						logo = '".$logo."',
						summarized_image= '".$summarized_image."',
						workout_audio = '".$workout_audio."' WHERE work_id = '".$work_id."'
			  			";
			$res=$db->prepare($sql_update);
			$res->execute();
			$admin = new stdClass();
			$admin->id = $db->lastInsertId();
			$work_array = array('success' => '1');
			$dbCon = null;
			echo json_encode($work_array);
		}
		catch(PDOException $e){
		
				echo '{"error":{"text":'. $e->getMessage() .'}}';
				}	
}

//delete Workouts
function deleteWorkouts($work_id){

		 
	try{
				$sql_delete = "DELETE FROM workouts WHERE work_id = '".$work_id."' ";
				$dbCon = getConnection();
				$stmt= $dbCon->query($sql_delete);  
				$delete_array = array('success'=>'1');
				echo json_encode($delete_array); 
	
	}
	catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
   		}

	

}
function addWorkouts(){
		global $app;
		$req =$app->request();
		$user_id =$req->params('user_id');
		$work_id =$req->params('work_id');
		
			try{
				$dbCon = getConnection();
				$arr = explode(",",$work_id);			
				if(!empty($arr)){						
					foreach($arr as $items){
						$sql_check= "SELECT * FROM  user_workouts WHERE user_id = '".$user_id."' AND work_id = '".$items."' ";
									
							$stmt= $dbCon->query($sql_check);  
								$stmt->execute();
								$user_work= $stmt->fetchObject();
								
								if(!empty($user_work)){
							
									 
								}else{
										$sql_his = "INSERT INTO user_workouts SET 
													user_id = '".$user_id."',
													work_id = '".$items."',
													date_time = '".date('Y-m-d')."'
													";
										$res=$dbCon->prepare($sql_his);
										$res->execute();
										
										
								}
					}	
				
					  $work_array = getWorkoutsList($user_id);
					  $work_array = array('success' => '1','work_array'=> $work_array );
					  echo json_encode($work_array);
			
					}	
										
				}	
				
			catch(PDOException $e){
				
						echo '{"error":{"text":'. $e->getMessage() .'}}';
				}	

}

function getWorkoutsList($user_id){
		global $app;
		$req =$app->request();
		
		try{
				$sql= "Select * FROM user_workouts  WHERE user_id= '".$user_id."'  ORDER  BY date_time DESC ";
				$dbCon = getConnection();
				$stmt= $dbCon->query($sql);  
				$stmt->execute();
				$user_work= $stmt->fetchALL(PDO::FETCH_OBJ);
				
				return $user_work; 
		
		}
		catch(PDOException $e){
		
				echo '{"error":{"text":'. $e->getMessage() .'}}';
				}	

}
//user workout with id
function getUserWorkoutHistory($user_id){
		
		try{
				$sql_workout = " SELECT DISTINCT  date_time FROM user_workouts WHERE user_id = '".$user_id."' ORDER BY id DESC";
				$dbCon = getConnection();
				$stmt= $dbCon->query($sql_workout);  
				$stmt->execute();
				$workout_date = $stmt->fetchALL(PDO::FETCH_OBJ);
				$sql_work = "SELECT workouts.name,user_workouts.date_time,user_workouts.work_id,workouts.video_time, workouts.workout_image , workouts.logo , workouts.app_id FROM workouts INNER JOIN user_workouts ON  user_workouts.work_id = workouts.work_id WHERE user_id ='".$user_id."'  ORDER BY user_id DESC";
				$stmt1= $dbCon->query($sql_work);  
				$stmt1->execute();
				$workout = $stmt1->fetchALL(PDO::FETCH_OBJ);
				if(!empty($workout)){
					
					foreach($workout as $work){
						
						 $work->workout_image = BASE_URL.IMAGES_URL.$work->workout_image;
						 $work->logo = BASE_URL.IMAGES_URL.$work->logo;
						
					}
							$workout_array = array('success' => '1','workout_date'=>$workout);
							$dbCon = null;
							echo json_encode($workout_array);
								
			}else{
						$work_array = array('success' => '0','workout_array'=> 'found empty' );
						echo json_encode($work_array);
			
			}
		 } 
		catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
   		}
}
//user workouts as per date and id
function workoutByDate(){
		global $app ;
		$req = $app->request();
		$user_id = $req->params('user_id');
		$date_time = $req->params('date_time');
		try{
				$sql_get = "SELECT workouts.name,user_workouts.date_time,user_workouts.work_id,workouts.video_time, workouts.workout_image ,workouts.summarized_image, workouts.logo , workouts.app_id FROM workouts INNER JOIN user_workouts ON  user_workouts.work_id = workouts.work_id WHERE user_id ='".$user_id."' AND date_time = '".$date_time."' ORDER BY user_id DESC ";
				$dbCon = getConnection();
				
				$stmt1= $dbCon->query($sql_get);  
				$stmt1->execute();
				$workout = $stmt1->fetchALL(PDO::FETCH_OBJ);
				if(!empty($workout)){
					
					foreach($workout as $work){
						
						 $work->workout_image = BASE_URL.IMAGES_URL.$work->workout_image;
						 $work->logo = BASE_URL.IMAGES_URL.$work->logo;
						 $work->summarized_image = BASE_URL.IMAGES_URL.$work->summarized_image ;
						
					}
							$workout_array = array('success' => '1','workout_date'=>$workout);
							$dbCon = null;
							echo json_encode($workout_array);
								
			}else{
						$work_array = array('success' => '0','workout_array'=> 'found empty' );
						echo json_encode($work_array);
			
			}
				
  
		
		
		}
		catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
   		} 


}


//add clones or company
function addCompany(){
		global $app;
		$req = $app->request();
		$company_name = $req->params('company_name');
		$app_name	= $req->params('app_name');
		
		
		try{
			$db=getConnection();
			$sql_his="INSERT INTO app_clones SET
			company_name = '".$company_name."',
			app_name = '".$app_name."'
			
			";
			$res=$db->prepare($sql_his);
			$res->execute();
			$user = new stdClass();
			$user->id = $db->lastInsertId();
			$user_arr = array('success' => '1');
			$dbCon = null;
			echo json_encode($user_arr);
		}
		catch(PDOException $e){
		
				echo '{"error":{"text":'. $e->getMessage() .'}}';
				}	
}
function companyUpdate(){
		global $app;
	 	$req = $app->request();
		$app_id = $req->params('app_id');
		$company_name = $req->params('company_name');
		$app_name	= $req->params('app_name');
	;
		try{
			$db=getConnection();
			$sql_his="UPDATE app_clones SET
			company_name = '".$company_name."',
			app_name = '".$app_name."'
			WHERE  app_id ='".$app_id."'
			";
			$res=$db->prepare($sql_his);
			$res->execute();
			$admin = new stdClass();
			$admin->id = $db->lastInsertId();
			$admin_arr = array('success' => '1');
			$dbCon = null;
			echo json_encode($admin_arr);
		}
		catch(PDOException $e){
		
				echo '{"error":{"text":'. $e->getMessage() .'}}';
				}	
}
//view copnay by id
function viewCompanywithId($app_id){
		global $app;
		$req = $app->request();
		
	
		try{
				$sql_company = " SELECT * FROM app_clones WHERE app_id = '".$app_id."'  ";
				$dbCon = getConnection();
				
				$stmt= $dbCon->query($sql_company);  
				$stmt->execute();
				$company_view = $stmt->fetchObject();
				
				$company_array = array('success' => '1','company_array'=>$company_view);
				$dbCon = null;
				echo json_encode($company_array);
		   } 
		catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
   		}
}
function viewCompany($app_id){

			try{
				$sql_company = "SELECT * FROM app_clones ORDER BY app_id DESC ";
				$dbCon = getConnection();
				$stmt= $dbCon->query($sql_company);  
				$stmt->execute();
				$company_view = $stmt->fetchALL(PDO::FETCH_OBJ);
				$company_array = array('success' => '1','company_view'=>$company_view);
				$dbCon = null;
				echo json_encode($company_array);
		   } 
		catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
   		}
}	
function deleteCompany($app_id){

		 
	try{
				$sql_delete = "DELETE FROM app_clones WHERE app_id = '".$app_id."' ";
				$dbCon = getConnection();
				$stmt= $dbCon->query($sql_delete);  
				$delete_array = array('success'=>'1');
				echo json_encode($delete_array); 
	
	}
	catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
   		}
}

function viewWorkoutwithId($work_id){
		global $app;
		$req = $app->request();
		
	
		try{
				$sql_workout = " SELECT * FROM workouts WHERE work_id = '".$work_id."' ";
				$dbCon = getConnection();
				
				$stmt= $dbCon->query($sql_workout);  
				$stmt->execute();
				$workout_view = $stmt->fetchObject();
				
				$workout_array = array('success' => '1','workout_array'=>$workout_view);
				$dbCon = null;
				echo json_encode($workout_array);
		   } 
		catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
   		}
}

// api for view workout for admin panel
function workoutsWithName($user_id){


			try{

				$dbCon = getConnection();

					$sql_app = "SELECT app_id,admin_type FROM admin_user WHERE admin_id = '".$user_id."' ";
					$stmt= $dbCon->query($sql_app);  
					$stmt->execute();
					$app_array = $stmt->fetchObject();
					
					if($app_array->admin_type == 'super_admin'){

						$sql_workouts = "SELECT workouts.work_id ,app_clones.app_id , app_clones.app_name , workouts.name,workouts.video_time,workouts.workout_image,workouts.logo FROM workouts INNER JOIn app_clones ON app_clones.app_id = workouts.app_id  ORDER BY workouts.work_id DESC " ;
					
					}else{

						$sql_workouts = "SELECT workouts.work_id ,app_clones.app_id , app_clones.app_name , workouts.name,workouts.video_time,workouts.workout_image FROM workouts INNER JOIn app_clones ON app_clones.app_id = workouts.app_id WHERE app_clones.app_id = '".$app_array->app_id."' ORDER BY workouts.work_id DESC " ;
						
					}
				
					$stmt= $dbCon->query($sql_workouts);  
					$stmt->execute();
					
					$workouts_view = $stmt->fetchALL(PDO::FETCH_OBJ);
					
					$workouts_array= array('success' => '1','workouts_array'=>$workouts_view);
					$dbCon = null;
					echo json_encode($workouts_array);
		    } 
			catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
   			}
}

//app login function
function appLogin(){

	global $app;
	$req = $app->request();
	$app_id = $req->params('app_id');
	$email_address = $req->params('email_address');
	$password = $req->params('password');
	$device_id = $req->params('device_id');
	$register_with = $req->params('register_with');
	$social_id  =  $req->params('social_id');
	$login_type  =  $req->Params('login_type');
	
	
	$sql_app ="SELECT * FROM app_users Where 
				email_address = '".$email_address."'
				AND password = '".$password."' 
				AND app_id = '".$app_id."' 
				
				";
	try{ 

			$dbCon=getConnection();
			$stmt_check = $dbCon->prepare($sql_app);  
			$stmt_check->execute();
			$user_check = $stmt_check->fetchObject();
			
			if(!empty($user_check)){	
				$sql_update= "UPDATE app_users SET
						device_id ='".$device_id."',
						register_with = '".$register_with."',
						last_login = '".date("Y-m-d h:i:s")."',
						social_id = '".$social_id."',
						login_type = '".$login_type."' 
						Where user_id = '".$user_check->user_id."'
						 ";
				$stmt_update = $dbCon-> prepare($sql_update);
				$stmt_update->execute();
				$user_array= getUserInfo($user_check->user_id);			
				$user_arra= array('success' => '1','user_array' =>$user_array);
				echo json_encode($user_arra);
				}
			else{
			  $user_arr= array('success' => '0' ,'error' =>'Email Id or Password is incorrect');
			  echo json_encode($user_arr); 
			  			
			}		
	}
	catch(PDOException $e)
	{
		echo '{"error":{"text":'. $e->getMessage() .'}}';

	}
}


//view Admin
function viewAllAdmin($user_id){
 
			try{  
				$dbCon = getConnection();
				$sql_app = "SELECT app_id FROM admin_user WHERE admin_id = '".$user_id."' ";
				
				$stmt= $dbCon->query($sql_app);  
				$stmt->execute();
				$app_array = $stmt->fetchObject();
				
				  if(!empty($app_array->admin_id)){
				  
				  $sql_adminview = " SELECT admin_user.admin_id ,app_clones.app_id,app_clones.app_name,admin_user.username,admin_user.admin_type,app_clones.company_name FROM admin_user INNER JOIN app_clones ON app_clones.app_id = admin_user.app_id WHERE admin_user.admin_id ='".$app_array->admin_id."' ORDER BY admin_id DESC"; 
				  	
				  }else{
				  
							$sql_adminview = " SELECT admin_user.admin_id ,app_clones.company_name,app_clones.app_id,app_clones.app_name,admin_user.username,admin_user.admin_type,admin_user.status,admin_user.password FROM admin_user INNER JOIN app_clones ON app_clones.app_id = admin_user.app_id  ORDER BY admin_id DESC " ;
				  }			
							$dbCon = getConnection();
							$stmt= $dbCon->query($sql_adminview); 
							$stmt->execute();
							$workouts_view = $stmt->fetchALL(PDO::FETCH_OBJ);
							 if(!empty($workouts_view))
							$workouts_view = array('success' => '1','workouts_view'=>$workouts_view);
							else
							$workouts_view = array('success' => '0');
							$dbCon = null;
							echo json_encode($workouts_view);
			} 
			catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
			}
}
//delete Admin
function adminDelete($admin_id){
			try{
						$sql_delete = "DELETE FROM admin_user WHERE admin_id = '".$admin_id."' ";
						$dbCon = getConnection();
						$stmt= $dbCon->query($sql_delete);  
						$delete_admin = array('success'=>'1');
						echo json_encode($delete_admin); 
			
			
			}
			catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
			}

}
//admin details for edit
function adminDetails($admin_id){
 
			try{  
			
							$sql_adminview = " SELECT admin_user.admin_id ,app_clones.app_id,app_clones.app_name,admin_user.username,admin_user.admin_type,admin_user.status,admin_user.password FROM admin_user INNER JOIN app_clones ON app_clones.app_id = admin_user.app_id  WHERE admin_id = '".$admin_id."' " ;
							$dbCon = getConnection();
							$stmt= $dbCon->query($sql_adminview); 
							
							$stmt->execute();

							
							$admin_view = $stmt->fetchObject();
							
							$admin_view = array('success' => '1','admin_view'=>$admin_view);
							$dbCon = null;
							echo json_encode($admin_view);
			} 
			catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
			}
}


// add admin parser
function addAdmin(){
		
		global $app;
		$req = $app->request();
		$app_id = $req->params('app_id');
		$username = $req->params('username');
		$password = $req->params('password');
		$admin_type = $req->params('admin_type');
		$status = $req->params('status');
		try{
			
				$db = getConnection();
				$sql_check = "SELECT admin_user.app_id,app_clones.app_name,admin_user.username FROM admin_user INNER JOIN app_clones ON app_clones.app_id= admin_user.app_id  WHERE admin_user.app_id ='".$app_id."' ";
				$stmt= $db->query($sql_check);  
				$stmt->execute();
				$user_check = $stmt->fetchObject();
				
				if(!empty($user_check)){
						$user_array = array('success' => '0','error'=> 'Admin for "'.$user_check->app_name. '" already exist' );
						$dbCon = null;
						echo json_encode($user_array); 
								
				}
				else{
			 
						$sql_admin="INSERT INTO admin_user SET
						app_id = '".$app_id."',
						username = '".$username."',
						password = '".$password."',
						admin_type = 'company_admin',
						status = '1'";
						$res=$db->prepare($sql_admin);
						$res->execute();
						$admin_array = array('success' => '1');
						$db= null;
						echo json_encode($admin_array);
			 }
		}
		catch(PDOException $e) {
        	echo '{"error":{"text":'. $e->getMessage() .'}}'; 

		}
}

//Password Change for admin
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
										$password_array= array('success' => '1');
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
//update Password
function adminPasswordUpdate(){

		global $app;
		$req = $app->request();
		$password = $req->params('password');
		$admin_id = $req->params('admin_id');
		
		try{
			
					$db = getConnection();
					
					$sql_update = "UPDATE admin_user SET password = '".$password."' WHERE admin_id = '".$admin_id."' ";
					
					$stmt= $db->query($sql_update);  
					$stmt->execute();
					$password_array= array('success' => '1');
					echo json_encode($password_array);
			

		}
		catch(PDOException $e) {
        	echo '{"error":{"text":'. $e->getMessage() .'}}'; 

		
 		}



}

function viewAllUsers($user_id){
  
  try{
   
    $dbCon = getConnection();
    $sql_app = "SELECT app_id FROM admin_user WHERE admin_id = '".$user_id."' ";
    $stmt= $dbCon->query($sql_app);  
    $stmt->execute();
    $app_array = $stmt->fetchObject();
   
    if(!empty($app_array->app_id)){
    
     $sql = "SELECT user_id,email_address,join_date,app_name FROM app_users INNER JOIN app_clones ON  app_clones.app_id = app_users.app_id WHERE app_users.app_id ='".$app_array->app_id."' ORDER BY user_id DESC";
    
    }else{
     
     $sql = "SELECT user_id,email_address,join_date,app_name FROM app_users INNER JOIN app_clones ON  app_clones.app_id = app_users.app_id ORDER BY user_id DESC";
    
    }
    $stmt= $dbCon->query($sql);  
    $stmt->execute();
    $user_array = $stmt->fetchALL(PDO::FETCH_OBJ);
    if(!empty($user_array))
     $response = array('success' => '1','user_array'=>$user_array);
    else 
     $response = array('success' => '0');
   
    $dbCon = null;
    echo json_encode($response); 

  }
  catch(PDOException $e) {
         echo '{"error":{"text":'. $e->getMessage() .'}}'; 

  }
}
function viewAdmin($admin_id){
 
			try{  
				$dbCon = getConnection();
				$sql_app = "SELECT admin_id FROM admin_user WHERE admin_id = '".$admin_id."' ";
				
				$stmt= $dbCon->query($sql_app);  
				$stmt->execute();
				$app_array = $stmt->fetchObject();
				
				  if(!empty($app_array->admin_id)){
				  
				  $sql_adminview = " SELECT admin_user.admin_id ,app_clones.app_id,app_clones.app_name,admin_user.username,admin_user.admin_type,app_clones.company_name,app_clones.crashlatics_email,app_clones.crashlatics_password,app_clones.flurry_email,app_clones.flurry_password,app_clones.application_id_fb,app_clones.application_id_google,app_clones.aweber_userid,app_clones.aweber_userpassword FROM admin_user INNER JOIN app_clones ON app_clones.app_id = admin_user.app_id WHERE admin_user.admin_id ='".$app_array->admin_id."' ORDER BY admin_id DESC"; 
				  	
				  }else{
				  
							$sql_adminview = " SELECT admin_user.admin_id ,app_clones.company_name,app_clones.app_id,app_clones.app_name,admin_user.username,admin_user.admin_type,admin_user.status,admin_user.password,app_clones.crashlatics_email,app_clones.crashlatics_password,app_clones.flurry_email,app_clones.flurry_password,app_clones.application_id_fb,app_clones.application_id_google,app_clones.aweber_userid,app_clones.aweber_userpassword FROM admin_user INNER JOIN app_clones ON app_clones.app_id = admin_user.app_id  ORDER BY admin_id DESC " ;
				  }			
							$dbCon = getConnection();
							$stmt= $dbCon->query($sql_adminview); 
							$stmt->execute();
							$workouts_view = $stmt->fetchObject();
							 if(!empty($workouts_view))
							$workouts_view = array('success' => '1','workouts_view'=>$workouts_view);
							else
							$workouts_view = array('success' => '0');
							$dbCon = null;
							echo json_encode($workouts_view);
			} 
			catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
			}
}

//delete Admin
function userDelete($user_id){
 try{
    $sql_delete_1 = "DELETE FROM app_users WHERE user_id = '".$user_id."' ";
    $sql_delete_2 = "DELETE FROM user_workouts WHERE user_id = '".$user_id."' ";
    $dbCon = getConnection();
    $dbCon->query($sql_delete_1);  
    $dbCon->query($sql_delete_2);  
    $delete_admin = array('success'=>'1');
    echo json_encode($delete_admin); 
 }
 catch(PDOException $e){
     echo '{"error":{"text":'. $e->getMessage() .'}}'; 
 }
}
//check for crashlatices empty
function pageCheck($admin_id){
		
			try{
						$sql_check = "SELECT app_id FROM admin_user WHERE admin_id = '".$admin_id."' ";
						$dbCon = getConnection();
						$stmt = $dbCon->query($sql_check);
						$stmt->execute();
						$crash_view = $stmt->fetchObject();
						$sql_check1 = "SELECT crashlatics_email,crashlatics_password From app_clones WHERE app_id ='".$crash_view->app_id."' ";
						$stmt = $dbCon->query($sql_check1);
						$stmt->execute();
						$id_check = $stmt->fetchObject();
						
						if(!empty($id_check->crashlatics_password) && !empty($id_check->crashlatics_email)){
							
							$page_check = array('success'=>'0');
    						echo json_encode($page_check); 
						}else{
							$page_check = array('success'=>'1');
    						echo json_encode($page_check); 
						}
						
							
				}
			catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
			}


}
//function to add crashes
function adminAddCrash($admin_id){
		global $app;
		$req = $app->request(); 
		$crashlatics_email = $req->params('crashlatics_email');
		$crashlatics_password = $req->params('crashlatics_password');
		
		try{
		
				$sql_check = "SELECT app_id FROM admin_user WHERE admin_id = '".$admin_id."' ";
				$dbCon = getConnection();
				$stmt = $dbCon->query($sql_check);
				$stmt->execute();
				$id_check = $stmt->fetchObject();
						
				if(!empty($id_check)){
					$sql_update = "UPDATE  app_clones SET
					crashlatics_email ='".$crashlatics_email."', 
					 crashlatics_password = '".$crashlatics_password."' WHERE app_id = '".$id_check->app_id."'
					 ";
					 
					$stmt = $dbCon->query($sql_update);
					$stmt->execute();
					$response = array('success'=>'1');
    				echo json_encode($response); 
				}	
		
		}
		catch(PDOException $e){
				echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	

}
//function to add flurry
function adminAddflurry($admin_id){
		global $app;
		$req = $app->request(); 
		$flurry_email = $req->params('flurry_email');
		$flurry_password = $req->params('flurry_password');
		
		try{
		
				$sql_check = "SELECT app_id FROM admin_user WHERE admin_id = '".$admin_id."' ";
				$dbCon = getConnection();
				$stmt = $dbCon->query($sql_check);
				$stmt->execute();
				$id_check = $stmt->fetchObject();
				
						
				if(!empty($id_check)){
					$sql_update = "UPDATE  app_clones SET
					flurry_email ='".$flurry_email."', 
					 flurry_password = '".$flurry_password."' WHERE app_id = '".$id_check->app_id."'
					 ";
					 
					$stmt = $dbCon->query($sql_update);
					$stmt->execute();
					
					$response = array('success'=>'1');
    				echo json_encode($response); 
				}	
		
		}
		catch(PDOException $e){
				echo '{"error":{"text":'.$e->getMessage().'}}';
		}
}
//check for crashlatices empty
function pageCheckflurry($admin_id){
		
			try{
						$sql_check = "SELECT app_id FROM admin_user WHERE admin_id = '".$admin_id."' ";
						$dbCon = getConnection();
						$stmt = $dbCon->query($sql_check);
						$stmt->execute();
						$crash_view = $stmt->fetchObject();
						$sql_check1 = "SELECT flurry_email,flurry_password From app_clones WHERE app_id ='".$crash_view->app_id."' ";
						$stmt = $dbCon->query($sql_check1);
						$stmt->execute();
						$id_check = $stmt->fetchObject();
						
						if(!empty($id_check->flurry_password) && !empty($id_check->flurry_email)){
							
							$page_check = array('success'=>'0');
    						echo json_encode($page_check); 
						}else{
							$page_check = array('success'=>'1');
    						echo json_encode($page_check); 
						}
						
							
				}
			catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
			}


}
//checkfoe applicationid
function applicationIdCheck($admin_id){
		
			try{
						$sql_check = "SELECT app_id FROM admin_user WHERE admin_id = '".$admin_id."' ";
						$dbCon = getConnection();
						$stmt = $dbCon->query($sql_check);
						$stmt->execute();
						$crash_view = $stmt->fetchObject();
						$sql_check1 = "SELECT application_id_fb,application_id_google From app_clones WHERE app_id ='".$crash_view->app_id."' ";
						$stmt = $dbCon->query($sql_check1);
						$stmt->execute();
						$id_check = $stmt->fetchObject();
						
						if(!empty($id_check->application_id_fb) && !empty($id_check->application_id_google)){
							
							$page_check = array('success'=>'0');
    						echo json_encode($page_check); 
						}else{
							$page_check = array('success'=>'1');
    						echo json_encode($page_check); 
						}
						
							
				}
			catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
			}


}
function adminAddApplicationId($admin_id){
		global $app;
		$req = $app->request(); 
		$application_id_fb = $req->params('application_id_fb');
		$application_id_google = $req->params('application_id_google');
		
		try{
		
				$sql_check = "SELECT app_id FROM admin_user WHERE admin_id = '".$admin_id."' ";
				$dbCon = getConnection();
				$stmt = $dbCon->query($sql_check);
				$stmt->execute();
				$id_check = $stmt->fetchObject();
						
				if(!empty($id_check)){
					$sql_update = "UPDATE  app_clones SET
					application_id_fb ='".$application_id_fb."',
					application_id_google = '".$application_id_google."'
					 WHERE app_id = '".$id_check->app_id."'
					 ";
					 
					$stmt = $dbCon->query($sql_update);
					$stmt->execute();
					
					$response = array('success'=>'1');
    				echo json_encode($response); 
				}	
		
		}
		catch(PDOException $e){
				echo '{"error":{"text":'.$e->getMessage().'}}';
		}
}
//superAdmin view crash and flurry
function viewSAdminCrash($admin_id){
		try{
			 $dbCon = getConnection();

					$sql_admin = "SELECT app_id FROM admin_user WHERE admin_id = '".$admin_id."' ";
					$stmt= $dbCon->query($sql_admin);  
					$stmt->execute();
					$admin_array = $stmt->fetchObject();
					
					if(!empty($admin_array)){

						$sql_clones= "SELECT admin_user.admin_id,app_clones.app_id ,app_clones.crashlatics_email , app_clones.app_name , app_clones.crashlatics_password,app_clones.flurry_email,app_clones.flurry_email,app_clones.application_id_fb,app_clones.application_id_google,app_clones.aweber_userid,app_clones.aweber_userpassword FROM app_clones INNER JOIn admin_user ON app_clones.app_id = admin_user.app_id  ORDER BY admin_user.admin_id DESC	" ;
						
					}
					$stmt= $dbCon->query($sql_clones);  
					$stmt->execute();
					
					$clones_view = $stmt->fetchALL(PDO::FETCH_OBJ);
					
					$clones_array= array('success' => '1','clones_array'=>$clones_view);
					$dbCon = null;
					echo json_encode($clones_array);
		
		}
		catch(PDOException $e){
				echo '{"error":{"text":'.$e->getMessage().'}}';
		}
}
//get crash and flurry details 
function viewCrashFlurry($app_id){
		
		try{
				$sql_crash = " SELECT crashlatics_email,crashlatics_password,flurry_email,flurry_password,application_id_fb,application_id_google,aweber_userid,aweber_userpassword FROM app_clones WHERE app_id = '".$app_id."' ";
				$dbCon = getConnection();
				
				$stmt= $dbCon->query($sql_crash);  
				$stmt->execute();
				$crash_view = $stmt->fetchObject();
				
				$crash_array = array('success' => '1','crash_array'=>$crash_view);
				$dbCon = null;
				echo json_encode($crash_array);
		   } 
		catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
   		}
}
//crash& flurry update
function crashUpdate(){
		global $app;
	 	$req = $app->request();
		$app_id = $req->params('app_id');
		$crashlatics_email = $req->params('crashlatics_email');
		$crashlatics_password = $req->params('crashlatics_password');
		$flurry_email = $req->params('flurry_email');
		$flurry_password = $req->params('flurry_password');
		$application_id_fb = $req->params('application_id_fb'); 
		$application_id_google = $req->params('application_id_google');
		$aweber_userid = $req->params('aweber_userid');
		$aweber_userpassword = $req->params('aweber_userpassword');
		try{
			$db=getConnection();
			$sql_update="UPDATE app_clones SET
						crashlatics_email = '".$crashlatics_email."',
						crashlatics_password = '".$crashlatics_password."',
						flurry_email = '".$flurry_email."',
						flurry_password = '".$flurry_password."',
						application_id_fb = '".$application_id_fb."',
						application_id_google = '".$application_id_google."',
						aweber_userid = '".$aweber_userid."',
						aweber_userpassword = '".$aweber_userpassword."'
 						 WHERE app_id = '".$app_id."'
			  			";
			$res=$db->prepare($sql_update);
			$res->execute();
			$admin = new stdClass();
			$admin->id = $db->lastInsertId();
			$admin_array = array('success' => '1');
			$dbCon = null;
			echo json_encode($admin_array);
		}
		catch(PDOException $e){
		
				echo '{"error":{"text":'. $e->getMessage() .'}}';
				}	
} 
//check aweber
function aweberIdCheck($admin_id){
		
			try{
						$sql_check = "SELECT app_id FROM admin_user WHERE admin_id = '".$admin_id."' ";
						$dbCon = getConnection();
						$stmt = $dbCon->query($sql_check);
						$stmt->execute();
						$aweber_view = $stmt->fetchObject();
						
						$sql_check1 = "SELECT aweber_userid,aweber_userpassword From app_clones WHERE app_id ='".$aweber_view->app_id."' ";
						$stmt = $dbCon->query($sql_check1);
						$stmt->execute();
						$id_check = $stmt->fetchObject();
						
						if(!empty($id_check->aweber_userid) && !empty($id_check->aweber_userpassword)){
							
							$page_check = array('success'=>'0');
    						echo json_encode($page_check); 
						}else{
							$page_check = array('success'=>'1');
    						echo json_encode($page_check); 
						}
						
							
				}
			catch(PDOException $e){
							echo '{"error":{"text":'. $e->getMessage() .'}}'; 
			}


}

//add aweber setting 
function adminAddAweber($admin_id){
	
		global $app;
		$req = $app->request(); 
		$aweber_userid = $req->params('aweber_userid');
		$aweber_userpassword = $req->params('aweber_userpassword');
		
		try{
		
				$sql_check = "SELECT app_id FROM admin_user WHERE admin_id = '".$admin_id."' ";
				$dbCon = getConnection();
				$stmt = $dbCon->query($sql_check);
				$stmt->execute();
				$id_check = $stmt->fetchObject();
						
				if(!empty($id_check)){
					$sql_update = "UPDATE  app_clones SET
					aweber_userid ='".$aweber_userid."', 
					 aweber_userpassword = '".$aweber_userpassword."' WHERE app_id = '".$id_check->app_id."'
					 ";
					 
					$stmt = $dbCon->query($sql_update);
					$stmt->execute();
					$response = array('success'=>'1');
    				echo json_encode($response); 
				}	
		
		}
		catch(PDOException $e){
				echo '{"error":{"text":'.$e->getMessage().'}}';
		}
	

	
}
//aweber Settings
$app->post('/admin/sub/addaweber/:admin_id','adminAddAweber');
$app->get('/admin/aweberid/:admin_id','aweberIdCheck');
//superadmincrash
$app->get('/super/admin/viewcrash/:admin_id','viewSAdminCrash');
$app->get('/spuer/admin/editcrash/:app_id','viewCrashFlurry');
$app->post('/super/admin/update','crashUpdate');
//application id add
$app->post('/admin/sub/addapplication/:admin_id','adminAddApplicationId');
$app->get('/admin/sub/check/:admin_id','applicationIdCheck');
//crashes
$app->get('/admin/crashid/:admin_id','pageCheck');
$app->post('/admin/sub/addcrash/:admin_id','adminAddCrash');
//flurry
$app->post('/admin/sub/addflurry/:admin_id','adminAddflurry');
$app->get('/admin/check/flurry/:admin_id','pageCheckflurry');
//Manage user
$app->get('/admin/user/view/:user_id','viewAllUsers');
$app->get('/delete/app_users/:user_id','userDelete');

//Addadmin parser
$app->post('/admin/addadmin','addAdmin');
$app->get('/admin/adminview/:user_id','viewAllAdmin');
$app->get('/delete/admin_user/:user_id','adminDelete');
$app->post('/admin/changepassword','changePassword');
$app->get('/admin/viewbyId/:admin_id','adminDetails');
$app->post('/admin/updatepassword','adminPasswordUpdate');
$app->get('/admin/sub/info/:admin_id','viewAdmin');


//clone parser
$app->get('/admin/companyview/:app_id','viewCompanywithId');
$app->get('/admin/companieslist/:app_id','viewCompany');
$app->post('/admin/companiesupdate','companyUpdate');
$app->post('/admin/addcompanies','addCompany');
$app->get('/delete/app_clones/:app_id','deleteCompany');

//workout view
$app->get('/workoutlist/view/:app_id','worklistView');
$app->post('/user/worklist','getWorkoutsList');

//user workouts
$app->post ('/user/workoutlist/add','addWorkouts');
$app->get('/user/workouts/history/:user_id','getUserWorkoutHistory');
$app->post('/user/workoutbyname/date','workoutByDate');

//workouts parser
$app->post('/worklist/detalis','Workouts');
$app->get('/workouts/workoutview/:user_id','workoutsWithName');
$app->get('/workout/workoutbyid/:work_id','viewWorkoutwithId');

$app->post('/workout/updates','workoutUpdate');
$app->get('/delete/workouts/:work_id','deleteWorkouts');

//applicaation  Login parser
$app->post('/user/login','appLogin');
$app->post('/user/register','addAppUser');

$app->run();