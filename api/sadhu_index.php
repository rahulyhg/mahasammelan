<?php
include_once("Slim/Slim.php");
\Slim\Slim::registerAutoloader();
require "NotORM.php";
$app = new \Slim\Slim();
require_once("../config/filenames.php");
//$mcrypt = new MCrypt();


// for admin
$app->post('/admin/login', 'adminLogin');

// for users
$app->get('/admin/users/status/:user_type', 'getAllUsers');
$app->get('/user/info/:user_id', 'getSingleUser');
$app->post('/user/add', 'addUser');
$app->post('/user/edit/:user_id', 'editUser');
$app->get('/user/checkemail/:email/:return_type', 'checkEmailExists');
$app->post('/deletedata', 'deleteData');
$app->post('/user/login', 'userLogin');
$app->get('/user/search/:search_key/:type', 'searchShadhuShadhvi');
$app->post('/user/edit/location/:user_id', 'editlatitude');

// for groups
$app->post('/group/add', 'addGroup');
$app->get('/groups', 'getGroups');
$app->get('/group/single/:group_id', 'getSingleGroup');
$app->post('/group/edit/:group_id', 'editGroup');

// for dadawadi
$app->post('/religiousplaces/add', 'addReligiousPlaces');
$app->get('/religiousplaces/:type', 'getReligiousPlaces');
$app->get('/religiousplaces/single/:id', 'getSingleReligiousplaces');
$app->post('/religiousplaces/edit/:id', 'editReligiousplaces');
$app->get('/dadawadi/search/:search_key/:type', 'searchDadawadi');

//for Religious imges
$app->post('/religiousimages/add', 'addMultiimage');
$app->post('edit/religiousimages/:id', 'editmultiimage');
$app->get('/religiousimage/:id', 'getsingleReligiousimage');


// for events
$app->post('/event/add', 'addEvent');
$app->get('/event/single/:id', 'getSingleEvent');
$app->get('/events', 'getEvents');
$app->post('/event/edit/:id', 'editEvent');
$app->get('/get/previous/events','previousevents');
$app->get('/event/bydate/single/:event_date', 'getSingleeventBydate');




// for states
$app->get('/states', 'getStates');

// for stavansangrah
$app->post('/stavansangrah/add', 'addStavansangrah');
$app->get('/stavansangrah/single/:id', 'getSingleStavansangrah');
$app->get('/stavansangrah', 'getStavansangrah');
$app->post('/stavansangrah/edit/:id', 'editStavansangrah');
$app->get('/stavansangrah/type', 'getStavansangrahType');
$app->get('/stavansangrah/search/:search_key', 'searchStavansangrah');


// for gallery
$app->post('/gallery/add', 'addGallery');
$app->get('/gallery/single/:id', 'getSingleGallery');
$app->get('/gallery', 'getGallery');
$app->post('/gallery/edit/:id', 'editGallery');

// for video
$app->post('/video/add', 'addVideo');
$app->get('/video_gallery/single/:v_id', 'getsinglevideo');
$app->get('/video', 'getVideo');
$app->post('/video/edit/:id', 'editVideo');
$app->post('/deleteVideo', 'deleteVideo');


// for panchang
$app->post('/panchang/add', 'addPanchang');
$app->get('/panchang/single/:id', 'getSinglePanchang');
$app->get('/panchang', 'getPanchang');
$app->post('/panchang/edit/:id', 'editPanchang');
$app->get('/panchang/months', 'panchangMonths');
$app->get('/panchang/bydate/single/:date', 'getSinglePanchangBydate');
$app->get('/panchang/search/:search_key', 'searchPanchang');

$app->post('/Months/date/ALL', 'GetMonthsDate');

//$app->post('/day/panchang', 'addPanchangday');


$app->get('/panchang/event/manglik/:date', 'PanchangBydate');
// for panchang
$app->get('/forgotpassword/:email_address', 'forgotPassword');
$app->post('/resetpassword', 'resetPassword');

//diksh form

$app->post('/user/add/New/diksha/form','Newdikshaform');
$app->get('/user/Info/get/dikshaform', 'getAlldikshaformInfo');
$app->get('/user/Info/singlget/dikshaform/:user_id', 'getSingledikshaformInfo');
$app->post('/user/edit/diksha/form','editdikshaform');


$app->get('/user/all/trithi','Gettrithi');
// for email
$app->post('/askquestion', 'askQuestion');










function GetMonthsDate(){
	
	 global $app;
    $req  = $app->request();
    
	$date = $req->params('date');
             
     $month = date("m",strtotime($date));
     $Year = date("Y",strtotime($date)); 
   
     $start_date = $Year .'-'.$month.'-'. 01;
    $end_date =   $Year .'-'.$month.'-'. 31;
      
	try{
		$dbCon = getConnection();
		
		
		 $sql = "select * from panchang where date between '".$start_date."' and '".$end_date."'";
	       $stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$user_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		
		//print_r($user_array); die;
		if(!empty($user_array)){
			$user_array = array('success' => '1','user_array' => $user_array);
		}
		    else{
			$user_array = array('success' => '0','sql' =>$sql);
		}
		echo json_encode($user_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}








function askQuestion(){
	
    global $app;
    $req  = $app->request();
    $question = $req->params('question');
    $user_id = $req->params('user_id');
 
    try {
        $dbCon       = getConnection();
		$sql = "SELECT username,email_address FROM app_users WHERE user_id = '".$user_id."' ";
        $stmt = $dbCon->prepare($sql);  
        $stmt->execute();
        $user = $stmt->fetchObject();  
			
		if($user == false){
			$user_array = array('success' => '0');
			echo json_encode($user_array);
		}else{

			 $from = $user->email_address;
			 $from_name = $user->username;
			 $subject = "Sadhu - Contact Us";
			 $email_to = "android@vardhamaninfotech.com";
			 
			 $content = "Name: ".$user->username;
			 $content .= "<br/>Email Address: ".$user->username;
			 $content .= "<br/>Question: ".$question;
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



			$user_array = array('success' => '1');
			echo json_encode($user_array);

		}
	
        $dbCon = null;
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function Gettrithi(){
	$sql_query = "SELECT id ,name_hindi FROM  tithi  ";
	
    try {
        $dbCon = getConnection();
        $stmt   = $dbCon->query($sql_query);
        $users  = $stmt->fetchAll(PDO::FETCH_OBJ);
		 $dbCon = null;
		$user_array = array('success' => '1','user_array'=>$users);
		echo json_encode($user_array);
	
	}
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
		echo '{"success": ' . json_encode('0') . '}';
    }    	
}

function editdikshaform(){
	
	
	 global $app;
    $req  = $app->request();
    

    
    //diksha_vivran details
    $user_id = $req->params('user_id');
    $sadhu_name_hindi = $req->params('sadhu_name_hindi');
    $sadhu_name_eng = $req->params('sadhu_name_eng');
	$diksha_parada_hindi = $req->params('diksha_parada_hindi');
    $diksha_parada_eng	 = $req->params('diksha_parada_eng');
    $guru_hindi = $req->params('guru_hindi');
		
	$guru_eng = $req->params('guru_eng');
    $sadhu_mandal_hindi = $req->params('sadhu_mandal_hindi');
    $sadhu_mandal_eng = $req->params('sadhu_mandal_eng');
	$dikhha_date	 = $req->params('dikhha_date');
    $dikhsa_place_hindi	 = $req->params('dikhsa_place_hindi');
    $dikhsa_place_eng = $req->params('dikhsa_place_eng');
		
	$badi_diksha_pradata_hindi	 = $req->params('badi_diksha_pradata_hindi');
    $badi_diksha_pradata_eng = $req->params('badi_diksha_pradata_eng');
    $badi_dikhsa_date = $req->params('badi_dikhsa_date');
	$badi_diksha_place_hindi = $req->params('badi_diksha_place_hindi');
    $badi_diksha_place_eng	 = $req->params('badi_diksha_place_eng');
   // sansari_jivan details
     
    $user_name_hindi = $req->params('user_name_hindi');
    $user_name_eng = $req->params('user_name_eng');
    $dob = $req->params('dob');
	$birth_place_hindi	 = $req->params('birth_place_hindi');
    $birth_place_eng	 = $req->params('birth_place_eng');
    $father_name_hindi = $req->params('father_name_hindi');
		
	$father_name_eng	 = $req->params('father_name_eng');
    $gotra_hindi = $req->params('gotra_hindi');
    $gotra_eng = $req->params('gotra_eng');
	$mother_name_hindi = $req->params('mother_name_hindi');
    $mother_name_eng	 = $req->params('mother_name_eng');
    
    //dikshit_sankarik_pariwar
    $sadhu_person_first_hindi = $req->params('sadhu_person_first_hindi');
    $sadhu_person_first_eng = $req->params('sadhu_person_first_eng');
    $relation_first_hindi = $req->params('relation_first_hindi');
	$relation_first_eng	 = $req->params('relation_first_eng');
    $sadhu_person_secondt_eng	 = $req->params('sadhu_person_secondt_eng');
    $sadhu_person_secondt_hindi = $req->params('sadhu_person_secondt_hindi');
		
	$relation_second_hindi	 = $req->params('relation_second_hindi');
    $relation_second_eng = $req->params('relation_second_eng');
    $sadhu_person_third_hind = $req->params('sadhu_person_third_hind');
	$sadhu_person_third_eng = $req->params('sadhu_person_third_eng');
    $relation_third_hindi	 = $req->params('relation_third_hindi');
    
    
    $relation_third_eng = $req->params('relation_third_eng');
    $sadhu_person_fourth_hindi 	 = $req->params('sadhu_person_fourth_hindi');
    $sadhu_person_fourth_eng = $req->params('sadhu_person_fourth_eng');
	$relation_fourth_hindi	 = $req->params('relation_fourth_hindi');
    $relation_fouth_eng	 = $req->params('relation_fouth_eng');
    $sadhu_person_fifth_hindi = $req->params('sadhu_person_fifth_hindi');
		
	$sadhu_person_fifth_eng	 = $req->params('sadhu_person_fifth_eng');
    $relation_fifth_hindi = $req->params('relation_fifth_hindi');
    $relation_fifth_eng = $req->params('relation_fifth_eng');
    
    
    
     // for sadhana
    $degree_eng = $req->params('degree_eng');
    $degree_hindi = $req->params('degree_hindi');
    $sadhana_place_eng	 = $req->params('sadhana_place_eng');
	$sadhana_place_hindi	 = $req->params('sadhana_place_hindi');
    $vihar_place_eng		 = $req->params('vihar_place_eng');
    $vihar_place_hindi		 = $req->params('vihar_place_hindi');
    $chaturmars_vivran_eng	 = $req->params('chaturmars_vivran_eng');
		
	$chaturmars_vivran_hindi	 = $req->params('chaturmars_vivran_hindi');
    $aagam_gyan_eng	 = $req->params('aagam_gyan_eng');
    $aagam_gyan_hindi = $req->params('aagam_gyan_hindi');
	$tatv_gyan_eng	 = $req->params('tatv_gyan_eng');
    $tatv_gyan_hindi	 = $req->params('tatv_gyan_hindi');
    
    $tap_vivran_eng		 = $req->params('tap_vivran_eng');
    $language_gyan_eng		 = $req->params('language_gyan_eng');
    $pratistha_vivran_eng	 = $req->params('pratistha_vivran_eng');
	
    $tap_vivran_hindi	 = $req->params('tap_vivran_hindi');
    $language_gyan_hindi	 = $req->params('language_gyan_hindi');
    $pratistha_vivran_hindi = $req->params('pratistha_vivran_hindi');
	$diksha_sadhu_eng		 = $req->params('diksha_sadhu_eng');
    $diksha_sadhu_hindi	 = $req->params('diksha_sadhu_hindi');
	
    try{
		
		 $dbCon = getConnection();
		
		 $sql_diksha_vivran=  "UPDATE diksha_vivran SET 
		 `sadhu_name_hindi`='".$sadhu_name_hindi."',
		 `sadhu_name_eng` = '".$sadhu_name_eng."', 
		 `diksha_parada_hindi` = '".$diksha_parada_hindi."',
		 
		 `diksha_parada_eng`=  '".$diksha_parada_eng."' ,
		 `guru_hindi` = '".$guru_hindi."',
		 `guru_eng` = '".$guru_eng."',
		 `sadhu_mandal_hindi` = '".$sadhu_mandal_hindi."',
		 `sadhu_mandal_eng` = '".$sadhu_mandal_eng."',
		 `dikhsa_place_hindi`= '".$dikhsa_place_hindi."',
		 `dikhsa_place_eng` = '".$dikhsa_place_eng."',
		 `badi_diksha_pradata_hindi` = '".$badi_diksha_pradata_hindi."',
		 `badi_diksha_pradata_eng` = '".$badi_diksha_pradata_eng."', 
		 `badi_diksha_place_eng` = '".$badi_diksha_place_eng."',
		 `badi_diksha_place_hindi` = '".$badi_diksha_place_hindi."',
		 `badi_dikhsa_date` = '".date('Y-m-d',strtotime($badi_dikhsa_date)) ."',
		 `dikhha_date` = '".date('Y-m-d',strtotime($dikhha_date)) ."'  WHERE user_id = '".$user_id."'";
		     
		     
   
     $sql_sansari_jivan=  "UPDATE  sansari_jivan SET 
		   `user_name_hindi`= '".$user_name_hindi."' ,
		 `user_name_eng` = '".$user_name_eng."',
		 
		 `birth_place_hindi`= '".$birth_place_hindi."',
		 `birth_place_eng` = '".$birth_place_eng."',
		 `father_name_hindi` = '".$father_name_hindi."',
		 `father_name_eng` = '".$father_name_eng."',
		 `gotra_hindi` = '".$gotra_hindi."',
		 `gotra_eng`= '".$gotra_eng."' ,
		 `mother_name_hindi` = '".$mother_name_hindi."',
		 `mother_name_eng` = '".$mother_name_eng."',
		 `dob` = '".date('Y-m-d',strtotime($dob)) ."'  WHERE user_id = '".$user_id."' ";
		  
		  
		  
		   $sql_dikshit_sankarik_pariwar=  "update dikshit_sankarik_pariwar  SET 
		   `sadhu_person_first_hindi`= '".$sadhu_person_first_hindi."',
		 `sadhu_person_first_eng` = '".$sadhu_person_first_eng."', `relation_first_hindi` = '".$relation_first_hindi."' ,
		 `relation_first_eng`= '".$relation_first_eng."' ,`sadhu_person_secondt_eng` = '".$sadhu_person_secondt_eng."',
		 `sadhu_person_secondt_hindi` = '".$sadhu_person_secondt_hindi."',`relation_second_hindi`='".$relation_second_hindi."',
		 `relation_second_eng` = '".$relation_second_eng."',`sadhu_person_third_hind` = '".$sadhu_person_third_hind."' ,
		 `sadhu_person_third_eng`= '".$sadhu_person_third_eng."' ,`relation_third_hindi` = '".$relation_third_hindi."',`relation_third_eng` = '".$relation_third_eng."',
		 `sadhu_person_fourth_hindi` = '".$sadhu_person_fourth_hindi."',`sadhu_person_fourth_eng` = '".$sadhu_person_fourth_eng."',
		 `relation_fourth_hindi` = '".$relation_fourth_hindi."',`relation_fouth_eng`	= '".$relation_fouth_eng."', 
		 `sadhu_person_fifth_hindi`= '".$sadhu_person_fifth_hindi."',`sadhu_person_fifth_eng` = '".$sadhu_person_fifth_eng."',
		 `relation_fifth_hindi` = '".$relation_fifth_hindi."',`relation_fifth_eng`	 = '".$relation_fifth_eng."' WHERE user_id = '".$user_id."' ";  




 $sql_sadhana=  "UPDATE  sadhana_achivement SET 
		   `degree_eng`= '".$degree_eng."' ,
		 `sadhana_place_eng` = '".$sadhana_place_eng."',
		 
		 `vihar_place_eng`= '".$vihar_place_eng."',
		 `chaturmars_vivran_eng` = '".$chaturmars_vivran_eng."',
		 `aagam_gyan_eng` = '".$aagam_gyan_eng."',
		 `tatv_gyan_eng` = '".$tatv_gyan_eng."',
		 `tap_vivran_eng` = '".$tap_vivran_eng."',
		 `language_gyan_eng`= '".$language_gyan_eng."' ,
		 `pratistha_vivran_eng` = '".$pratistha_vivran_eng."',
		 `diksha_sadhu_eng` = '".$diksha_sadhu_eng."',
		  
			 `degree_hindi`= '".$degree_hindi."',
		 `sadhana_place_hindi` = '".$sadhana_place_hindi."',
		 `vihar_place_hindi` = '".$vihar_place_hindi."',
		 `chaturmars_vivran_hindi` = '".$chaturmars_vivran_hindi."',
		 `aagam_gyan_hindi` = '".$aagam_gyan_hindi."',
		 `tatv_gyan_hindi`= '".$tatv_gyan_hindi."' ,
		 `tap_vivran_hindi` = '".$tap_vivran_hindi."',
		 `language_gyan_hindi` = '".$language_gyan_hindi."', 
		 `pratistha_vivran_hindi` = '".$pratistha_vivran_hindi."',
		 `diksha_sadhu_hindi` = '".$diksha_sadhu_hindi."'
		 WHERE user_id = '".$user_id."'
		 ";

               


               $stmt  = $dbCon->prepare($sql_sadhana);
			$stmt->execute();
		 $user_array = array( 'success' => '1');
               echo json_encode($user_array);
              $stmt  = $dbCon->prepare($sql_dikshit_sankarik_pariwar);
			$stmt->execute();
		 $user_array = array( 'success' => '1');
      
                   echo json_encode($user_array);
			$stmt  = $dbCon->prepare($sql_sansari_jivan);
			$stmt->execute();
			 $user_array = array( 'success' => '1');
      
                   echo json_encode($user_array);


			$stmt  = $dbCon->prepare($sql_diksha_vivran);
			$stmt->execute();
			 $user_array = array( 'success' => '1');
      
                   echo json_encode($user_array);
	
	
	
	}
			//print_R($USER_INFO->id);
	catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
    
	
}



function Newdikshaform() {
	
	 global $app;
    $req  = $app->request();
    

    
    //diksha_vivran details
    $user_id = $req->params('user_id');
    $sadhu_name_hindi = $req->params('sadhu_name_hindi');
    $sadhu_name_eng = $req->params('sadhu_name_eng');
	$diksha_parada_hindi = $req->params('diksha_parada_hindi');
    $diksha_parada_eng	 = $req->params('diksha_parada_eng');
    $guru_hindi = $req->params('guru_hindi');
		
	$guru_eng = $req->params('guru_eng');
    $sadhu_mandal_hindi = $req->params('sadhu_mandal_hindi');
    $sadhu_mandal_eng = $req->params('sadhu_mandal_eng');
	$dikhha_date	 = $req->params('dikhha_date');
    $dikhsa_place_hindi	 = $req->params('dikhsa_place_hindi');
    $dikhsa_place_eng = $req->params('dikhsa_place_eng');
		
	$badi_diksha_pradata_hindi	 = $req->params('badi_diksha_pradata_hindi');
    $badi_diksha_pradata_eng = $req->params('badi_diksha_pradata_eng');
    $badi_dikhsa_date = $req->params('badi_dikhsa_date');
	$badi_diksha_place_hindi = $req->params('badi_diksha_place_hindi');
    $badi_diksha_place_eng	 = $req->params('badi_diksha_place_eng');
   // sansari_jivan details
     
    $user_name_hindi = $req->params('user_name_hindi');
    $user_name_eng = $req->params('user_name_eng');
    $dob = $req->params('dob');
	$birth_place_hindi	 = $req->params('birth_place_hindi');
    $birth_place_eng	 = $req->params('birth_place_eng');
    $father_name_hindi = $req->params('father_name_hindi');
		
	$father_name_eng	 = $req->params('father_name_eng');
    $gotra_hindi = $req->params('gotra_hindi');
    $gotra_eng = $req->params('gotra_eng');
	$mother_name_hindi = $req->params('mother_name_hindi');
    $mother_name_eng	 = $req->params('mother_name_eng');
    
    //dikshit_sankarik_pariwar
    $sadhu_person_first_hindi = $req->params('sadhu_person_first_hindi');
    $sadhu_person_first_eng = $req->params('sadhu_person_first_eng');
    $relation_first_hindi = $req->params('relation_first_hindi');
	$relation_first_eng	 = $req->params('relation_first_eng');
    $sadhu_person_secondt_eng	 = $req->params('sadhu_person_secondt_eng');
    $sadhu_person_secondt_hindi = $req->params('sadhu_person_secondt_hindi');
		
	$relation_second_hindi	 = $req->params('relation_second_hindi');
    $relation_second_eng = $req->params('relation_second_eng');
    $sadhu_person_third_hind = $req->params('sadhu_person_third_hind');
	$sadhu_person_third_eng = $req->params('sadhu_person_third_eng');
    $relation_third_hindi	 = $req->params('relation_third_hindi');
    
    
    $relation_third_eng = $req->params('relation_third_eng');
    $sadhu_person_fourth_hindi 	 = $req->params('sadhu_person_fourth_hindi');
    $sadhu_person_fourth_eng = $req->params('sadhu_person_fourth_eng');
	$relation_fourth_hindi	 = $req->params('relation_fourth_hindi');
    $relation_fouth_eng	 = $req->params('relation_fouth_eng');
    $sadhu_person_fifth_hindi = $req->params('sadhu_person_fifth_hindi');
		
	$sadhu_person_fifth_eng	 = $req->params('sadhu_person_fifth_eng');
    $relation_fifth_hindi = $req->params('relation_fifth_hindi');
    $relation_fifth_eng = $req->params('relation_fifth_eng');
    
    
    
     // for sadhana
    $degree_eng = $req->params('degree_eng');
    $degree_hindi = $req->params('degree_hindi');
    $sadhana_place_eng	 = $req->params('sadhana_place_eng');
	$sadhana_place_hindi	 = $req->params('sadhana_place_hindi');
    $vihar_place_eng		 = $req->params('vihar_place_eng');
    $vihar_place_hindi		 = $req->params('vihar_place_hindi');
    $chaturmars_vivran_eng	 = $req->params('chaturmars_vivran_eng');
		
	$chaturmars_vivran_hindi	 = $req->params('chaturmars_vivran_hindi');
    $aagam_gyan_eng	 = $req->params('aagam_gyan_eng');
    $aagam_gyan_hindi = $req->params('aagam_gyan_hindi');
	$tatv_gyan_eng	 = $req->params('tatv_gyan_eng');
    $tatv_gyan_hindi	 = $req->params('tatv_gyan_hindi');
    
    $tap_vivran_eng		 = $req->params('tap_vivran_eng');
    $language_gyan_eng		 = $req->params('language_gyan_eng');
    $pratistha_vivran_eng	 = $req->params('pratistha_vivran_eng');
	
    $tap_vivran_hindi	 = $req->params('tap_vivran_hindi');
    $language_gyan_hindi	 = $req->params('language_gyan_hindi');
    $pratistha_vivran_hindi = $req->params('pratistha_vivran_hindi');
	$diksha_sadhu_eng		 = $req->params('diksha_sadhu_eng');
    $diksha_sadhu_hindi	 = $req->params('diksha_sadhu_hindi');
	
    try{
		
		 $dbCon = getConnection();
		
		 $sql_diksha_vivran=  "INSERT INTO diksha_vivran SET user_id = '".$user_id . "',
		 `sadhu_name_hindi`='".$sadhu_name_hindi."',
		 `sadhu_name_eng` = '".$sadhu_name_eng."', 
		 `diksha_parada_hindi` = '".$diksha_parada_hindi."',
		 
		 `diksha_parada_eng`=  '".$diksha_parada_eng."' ,
		 `guru_hindi` = '".$guru_hindi."',
		 `guru_eng` = '".$guru_eng."',
		 `sadhu_mandal_hindi` = '".$sadhu_mandal_hindi."',
		 `sadhu_mandal_eng` = '".$sadhu_mandal_eng."',
		 `dikhsa_place_hindi`= '".$dikhsa_place_hindi."',
		 `dikhsa_place_eng` = '".$dikhsa_place_eng."',
		 `badi_diksha_pradata_hindi` = '".$badi_diksha_pradata_hindi."',
		 `badi_diksha_pradata_eng` = '".$badi_diksha_pradata_eng."', 
		 `badi_diksha_place_eng` = '".$badi_diksha_place_eng."',
		 `badi_diksha_place_hindi` = '".$badi_diksha_place_hindi."',
		 `badi_dikhsa_date` = '".date('Y-m-d',strtotime($badi_dikhsa_date)) ."',
		 `dikhha_date` = '".date('Y-m-d',strtotime($dikhha_date)) ."' ";
		     
		     
   
     $sql_sansari_jivan=  "INSERT INTO sansari_jivan SET user_id = '".$user_id . "',
		   `user_name_hindi`= '".$user_name_hindi."' ,
		 `user_name_eng` = '".$user_name_eng."',
		 
		 `birth_place_hindi`= '".$birth_place_hindi."',
		 `birth_place_eng` = '".$birth_place_eng."',
		 `father_name_hindi` = '".$father_name_hindi."',
		 `father_name_eng` = '".$father_name_eng."',
		 `gotra_hindi` = '".$gotra_hindi."',
		 `gotra_eng`= '".$gotra_eng."' ,
		 `mother_name_hindi` = '".$mother_name_hindi."',
		 `mother_name_eng` = '".$mother_name_eng."',
		 `dob` = '".date('Y-m-d',strtotime($dob)) ."' ";
		  
		  
		  
		   $sql_dikshit_sankarik_pariwar=  "INSERT INTO dikshit_sankarik_pariwar  SET user_id = '".$user_id . "',
		   `sadhu_person_first_hindi`= '".$sadhu_person_first_hindi."',
		 `sadhu_person_first_eng` = '".$sadhu_person_first_eng."', `relation_first_hindi` = '".$relation_first_hindi."' ,
		 `relation_first_eng`= '".$relation_first_eng."' ,`sadhu_person_secondt_eng` = '".$sadhu_person_secondt_eng."',
		 `sadhu_person_secondt_hindi` = '".$sadhu_person_secondt_hindi."',`relation_second_hindi`='".$relation_second_hindi."',
		 `relation_second_eng` = '".$relation_second_eng."',`sadhu_person_third_hind` = '".$sadhu_person_third_hind."' ,
		 `sadhu_person_third_eng`= '".$sadhu_person_third_eng."' ,`relation_third_hindi` = '".$relation_third_hindi."',`relation_third_eng` = '".$relation_third_eng."',
		 `sadhu_person_fourth_hindi` = '".$sadhu_person_fourth_hindi."',`sadhu_person_fourth_eng` = '".$sadhu_person_fourth_eng."',
		 `relation_fourth_hindi` = '".$relation_fourth_hindi."',`relation_fouth_eng`	= '".$relation_fouth_eng."', 
		 `sadhu_person_fifth_hindi`= '".$sadhu_person_fifth_hindi."',`sadhu_person_fifth_eng` = '".$sadhu_person_fifth_eng."',
		 `relation_fifth_hindi` = '".$relation_fifth_hindi."',`relation_fifth_eng`	 = '".$relation_fifth_eng."'  ";  




 $sql_sadhana=  "INSERT INTO sadhana_achivement SET user_id = '".$user_id . "',
		   `degree_eng`= '".$degree_eng."' ,
		 `sadhana_place_eng` = '".$sadhana_place_eng."',
		 
		 `vihar_place_eng`= '".$vihar_place_eng."',
		 `chaturmars_vivran_eng` = '".$chaturmars_vivran_eng."',
		 `aagam_gyan_eng` = '".$aagam_gyan_eng."',
		 `tatv_gyan_eng` = '".$tatv_gyan_eng."',
		 `tap_vivran_eng` = '".$tap_vivran_eng."',
		 `language_gyan_eng`= '".$language_gyan_eng."' ,
		 `pratistha_vivran_eng` = '".$pratistha_vivran_eng."',
		 `diksha_sadhu_eng` = '".$diksha_sadhu_eng."',
		  
			 `degree_hindi`= '".$degree_hindi."',
		 `sadhana_place_hindi` = '".$sadhana_place_hindi."',
		 `vihar_place_hindi` = '".$vihar_place_hindi."',
		 `chaturmars_vivran_hindi` = '".$chaturmars_vivran_hindi."',
		 `aagam_gyan_hindi` = '".$aagam_gyan_hindi."',
		 `tatv_gyan_hindi`= '".$tatv_gyan_hindi."' ,
		 `tap_vivran_hindi` = '".$tap_vivran_hindi."',
		 `language_gyan_hindi` = '".$language_gyan_hindi."', 
		 `pratistha_vivran_hindi` = '".$pratistha_vivran_hindi."',
		 `diksha_sadhu_hindi` = '".$diksha_sadhu_hindi."'
		 ";

               


               $stmt  = $dbCon->prepare($sql_sadhana);
			$stmt->execute();
		 $user_array = array( 'success' => '1');
               echo json_encode($user_array);
              $stmt  = $dbCon->prepare($sql_dikshit_sankarik_pariwar);
			$stmt->execute();
		 $user_array = array( 'success' => '1');
      
                   echo json_encode($user_array);
			$stmt  = $dbCon->prepare($sql_sansari_jivan);
			$stmt->execute();
			 $user_array = array( 'success' => '1');
      
                   echo json_encode($user_array);


			$stmt  = $dbCon->prepare($sql_diksha_vivran);
			$stmt->execute();
			 $user_array = array( 'success' => '1');
      
                   echo json_encode($user_array);
			
			
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }

}



function getAlldikshaformInfo() {

	$sql_query = "SELECT * FROM diksha_vivran ";
	
	$sql = "SELECT * FROM dikshit_sankarik_pariwar ";
	
	$sql_in = "SELECT * FROM sansari_jivan ";
	
	$sql_sadhana = "SELECT * FROM sadhana_achivement ";
	
	

    try {
        $dbCon = getConnection();
        $stmt   = $dbCon->query($sql_query);
        $users  = $stmt->fetchAll(PDO::FETCH_OBJ);
		 $dbCon = null;
        
		  $dbCon = getConnection();
        $stmt   = $dbCon->query($sql);
        $users_1  = $stmt->fetchAll(PDO::FETCH_OBJ);
		 $dbCon = null;
		 
		 
		  $dbCon = getConnection();
        $stmt   = $dbCon->query($sql_in);
        $users_2  = $stmt->fetchAll(PDO::FETCH_OBJ);
		 $dbCon = null;
		 
		$user_array = array('success' => '1','user_array'=>$users,'users_1'=>$users_2,'users_1'=>$users_1);
		echo json_encode($user_array);
	
	}
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
		echo '{"success": ' . json_encode('0') . '}';
    }    

}

function getSingledikshaformInfo($user_id){
	
	
	try{
		$dbCon = getConnection();
		$test_array = array();
		
		$sql = "SELECT * FROM diksha_vivran WHERE user_id = '".$user_id."' ";
		
		//print_r($sql);  //die;
		
		$sql_in = "SELECT * FROM dikshit_sankarik_pariwar WHERE user_id = '".$user_id."' ";
		//print_r($sql_in);  die;
		$sql_query = "SELECT * FROM sansari_jivan WHERE user_id = '".$user_id."' ";
		//print_r($sql_query);  die;
		
		$sql_sadhana = "SELECT * FROM sadhana_achivement WHERE user_id = '".$user_id."' ";
		//print_r($sql_sadhana);  die;
		
		$stmt = $dbCon->prepare($sql_sadhana);  
		$stmt->execute();
		$sadhana = $stmt->fetchObject();
		//print_r($sadhana); die;
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$stavan = $stmt->fetchObject();																																																																																															
		  //print_r($stavan); die;
		
		$stmt = $dbCon->prepare($sql_in);  
		$stmt->execute();
		$stavan_query = $stmt->fetchObject();
		 //print_r($stavan_query); die;
		 $stmt = $dbCon->prepare($sql_query);  
							$stmt->execute();
							$stavan_in = $stmt->fetchObject();
		 // print_r($stavan_in); die;
		
		 
		
		
			$stavan_array = array('success' => '1','stavan_array' => $stavan,'stavan1' => $stavan_query,'stavan2' => $stavan_in,'stavan3' =>$sadhana);
			
		
			
		
		
		
		echo json_encode($stavan_array);
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}



function searchDadawadi($search_key,$type){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT id,name_hindi,address,type,description,state_id FROM religious_places WHERE name LIKE '%$search_key%' AND type = '".$type."' ";
	       
		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$user_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		if(!empty($user_array)){
			$user_array = array('success' => '1','user_array' => $user_array);
		}
		    else{
			$user_array = array('success' => '0','sql' =>$sql);
		}
		echo json_encode($user_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}



function searchPanchang($search_key){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT date,weekday,lunar_year,lunar_month,lunar_tithi,shubh_din,lunar_cycle,description FROM panchang WHERE lunar_month LIKE '%$search_key%' ";
	       
		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$user_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		if(!empty($user_array)){
			$user_array = array('success' => '1','user_array' => $user_array);
		}
		    else{
			$user_array = array('success' => '0','sql' =>$sql);
		}
		echo json_encode($user_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}




function searchShadhuShadhvi($search_key,$type){
	

			 
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT user_id,group_id,user_type,username,email_address,username_hindi,mobile_number,join_date,group_name,group_head,latitude FROM app_users AS au LEFT JOIN groups AS g ON g.id = au.group_id WHERE user_type != 'admin' AND username LIKE '%".$search_key."%' AND user_type='".$type."' ORDER BY username ";

		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$user_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		if(!empty($user_array)){
			foreach($user_array as $user_value){
				if(!empty($user_value->group_id)){	
					$sql = "SELECT au.username,au.latitude,au.longitude ,au.username_hindi,au.address FROM app_users AS au LEFT JOIN groups AS g ON g.id = au.user_id WHERE user_type != 'admin' AND au.user_id = '".$user_value->group_head."' ";
					$stmt_check = $dbCon->prepare($sql);  
					$stmt_check->execute();
					$group_array = $stmt_check->fetchObject();
					
					if(!empty($group_array)){
						$user_value->group_name = $user_value->group_name." (<b>".$group_array->username."</b>)";
						$user_value->latitude =  $group_array->latitude ;
						//$user_value->username_hindi =  $group_array->username_hindi ;
						$user_value->longitude =  $group_array->longitude ;
						$user_value->address =  $group_array->address ;
						
					}
					else{
						$user_value->group_name = 'Not Available';
					}	
				}else{
						$user_value->group_name = 'Not Available';
				}	
			
			}
			$user_array = array('success' => '1','user_array' => $user_array);
		}else 
			$user_array = array('success' => '0','sql' =>$sql);
		
		echo json_encode($user_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function resetPassword(){
	
    global $app;
    $req  = $app->request();
    $email_address = $req->params('email_address');
    $code = $req->params('code');
    $password = $req->params('password');


    try {
        $dbCon       = getConnection();
		$sql = "SELECT user_id FROM app_users WHERE email_address = '".$email_address."' AND forgot_code = '".$code."'";
        $stmt = $dbCon->prepare($sql);  
        $stmt->execute();
        $user = $stmt->fetchObject();  
			
		if($user == false){
			$user_array = array('success' => '0','user'=>$sql);
			echo json_encode($user_array);
		}else{
		

			$sql  = "UPDATE app_users SET password ='" . md5($password) . "' WHERE email_address='" . $email_address . "'";
			$stmt = $dbCon->prepare($sql);
			$stmt->execute();
			$user_array = array('success' => '1');
			echo json_encode($user_array);

		}
	
        $dbCon = null;
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}



function forgotPassword($email_address) {

    $sql = "SELECT user_id FROM app_users WHERE email_address = '".$email_address."'";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->execute();
        $user = $stmt->fetchObject();  
			
		if($user == false){
			$user_array = array('success' => '0');
			echo json_encode($user_array);
		}else{
			
			$string = '0123456789';
			$string_shuffled = str_shuffle($string);
			$code = substr($string_shuffled, 1, 5);

 			 $from = 'design@vardhamaninfotech.com';
			 $from_name = 'Sadhu';
			 $subject = "Forgot Password";
			 $email_to = $email_address;
			 
			 $content = "Please use the following code to reset your password: ".$code;
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
				if ($result) {
					$sql  = "UPDATE app_users SET forgot_code ='" . $code . "' WHERE email_address='" . $email_address . "'";
					$stmt = $dbCon->prepare($sql);
					$stmt->execute();
					$user_array = array(
						'success' => '1'
					);
					$user_array = array('success' => '1','user_array'=>$user,'result'=>$result);
					echo json_encode($user_array);
			
				}
			
			
		}

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getSinglePanchangBydate($date){
	
	
	try{
		$dbCon = getConnection();
		
		$date =  date('Y-m-d',strtotime($date));
		
		$sql = "SELECT * FROM panchang WHERE date = '".$date."' AND id = '".$id."' ";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$panchang_array = $stmt->fetchObject();
		
		$sql = "SELECT * FROM events WHERE event_date = '".$date."' ";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$event_array = $stmt->fetchObject();
		
		 //$panchang_array = array_merge($panchang_array,$event_array);
		// print_r($panchang_array); die;
		if(!empty($panchang_array))
			$panchang_array = array('success' => '1','panchang_array' => $panchang_array);
		else
			$panchang_array = array('success' => '0');
		
		echo json_encode($panchang_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}



function PanchangBydate($date){
	
	
	try{
		$dbCon = getConnection();
		
		$date =  date('Y-m-d',strtotime($date));
		
		$sql = "SELECT  * FROM panchang  WHERE date = '".$date."' ";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$panchang = $stmt->fetchObject();
		
		
	  $sql_in = "SELECT event_name,event_date,image FROM events  ORDER BY event_date DESC ";

		$stmt_check = $dbCon->prepare($sql_in);  
		$stmt_check->execute();
		$event_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);               
		//print_r($event_array);
		
		
		 $sql_query = "SELECT name as religious_name,image as religious_image,type FROM religious_places  ORDER BY id DESC ";

		$stmt_check = $dbCon->prepare($sql_query);  
		$stmt_check->execute();
		$religious_array = $stmt_check->fetchALL(PDO::FETCH_OBJ); 
		//print_r($religious_array); 
		   
		$sql_q = "SELECT manglik_text,image as manglik_image FROM manglik  ORDER BY id DESC ";

		$stmt_check = $dbCon->prepare($sql_q);  
		$stmt_check->execute();
		$manglik_array = $stmt_check->fetchALL(PDO::FETCH_OBJ); 
		
		$value = array_merge($event_array,$religious_array);
		//print_r($value);  die;
		$array_value = array_merge($value,$manglik_array);
		    //print_r($array_value);  die;
		if(!empty($panchang))
			$panchang_array = array('success' => '1','panchang_array' => $panchang,$array_value);
		else
			$panchang_array = array('success' => '1', $array_value);
		
		echo json_encode($panchang_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}










function getSingleGallery($id){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT * FROM gallery WHERE id = '".$id."'";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$gallery_array = $stmt->fetchObject();
		if(!empty($gallery_array)){

				$sql = "SELECT id,gallery_image FROM gallery_images WHERE gallery_id = '".$gallery_array->gallery_id."' ";
				
				
				$stmt = $dbCon->prepare($sql);  
				$stmt->execute();
				$images_array = $stmt->fetchALL(PDO::FETCH_OBJ);
				
				if(!empty($images_array)){		
					foreach($images_array as $images_value){
						
						$images_value->gallery_image_name = $images_value->gallery_image;
						$images_value->gallery_image = IMG_URL.'thumbnail/'.$images_value->gallery_image;
						
					}
					$gallery_array->images_array = $images_array;
					
					

				}else
					$gallery_array->images_array = array();
					
				
					
				$gallery_array = array('success' => '1','gallery_array' => $gallery_array);
		}else
			$gallery_array = array('success' => '0');
		
		
		echo json_encode($gallery_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}




function deleteVideo(){
    global $app;
    $req        = $app->request(); // Getting parameter with names
    $delete_id  = $req->params('delete_id');
    $table_name = $req->params('table_name');
    $field_name = $req->params('field_name');
   
	$sql        = "DELETE FROM " . $table_name . " WHERE " . $field_name . " = '" . $delete_id . "' ";
		
    try {
        $dbCon = getConnection();
		$stmt  = $dbCon->prepare($sql);
        $stmt->execute();


        $user       = new stdClass();
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}






function getSingleVideo($v_id){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT * FROM video WHERE v_id = '".$v_id."'";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$gallery_array = $stmt->fetchObject();
		
		
		if(!empty($gallery_array)){
                 $sql = "SELECT v_id,video_store FROM video_store WHERE video_id = '".$gallery_array->video_id."' ";
				
				  //print_r($sql); die;
				$stmt = $dbCon->prepare($sql);  
				$stmt->execute();
				$images_array = $stmt->fetchALL(PDO::FETCH_OBJ);
				 //print_r($images_array); die;
				if(!empty($images_array)){		
					foreach($images_array as $images_value){
						
						$images_value->gallery_image_name = $images_value->video_store;
						$images_value->video_store =VIDEO_URL.$images_value->video_store;
						
					}
					$gallery_array->images_array = $images_array;

				}else
					$gallery_array->images_array = array();
					
				
					
				$gallery_array = array('success' => '1','gallery_array' => $gallery_array);
		}else
			$gallery_array = array('success' => '0');
		
		
		echo json_encode($gallery_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getGallery(){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT * FROM gallery WHERE status = '1'";
		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$gallery_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		
	//	print_r($gallery_array); die;
		if(!empty($gallery_array)){
			
			foreach($gallery_array as $gallery_value){
				$sql = "SELECT id,gallery_image FROM gallery_images WHERE gallery_id = '".$gallery_value->gallery_id."' ";
				$stmt = $dbCon->prepare($sql);  
				$stmt->execute();
				$images_array = $stmt->fetchALL(PDO::FETCH_OBJ);
				if(!empty($images_array)){		
					foreach($images_array as $images_value){
						
						$images_value->gallery_image_name = $images_value->gallery_image;
						$images_value->gallery_image = IMG_URL.'thumbnail/'.$images_value->gallery_image;
						
					}
					$gallery_value->images_array = $images_array;
					//print_R($gallery_value);DIE;	

				}else
					$gallery_value->images_array = array();
			}		
					
			
			$gallery_array = array('success' => '1','gallery_array' => $gallery_array);
		}else
			$gallery_array = array('success' => '0');
		
		echo json_encode($gallery_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getSingleeventBydate($event_date){
	
	
	try{
		$dbCon = getConnection();
		
		$event_date =  date('Y/m/d',strtotime($event_date));
		
		$sql = "SELECT * FROM events WHERE event_date = '".$event_date."' ";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$event_array = $stmt->fetchObject();
		if(!empty($event_array))
			$event_array = array('success' => '1','event_array' => $event_array);
		else
			$event_array = array('success' => '0');
		
		echo json_encode($event_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}




function editlatitude($user_id){
    global $app;
    $req = $app->request();
    $longitude = $req->params('longitude');
    $latitude = $req->params('latitude');
    

    $sql = "UPDATE app_users SET longitude  = '" . $longitude . "',latitude= '" . $latitude . "'  WHERE user_id = '" . $user_id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user       = new stdClass();
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}






function getVideo(){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT * FROM video WHERE status = '1' ";
		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$gallery_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		//print_r($gallery_array);
		if(!empty($gallery_array)){
			
			foreach($gallery_array as $gallery_value){
				$sql = "SELECT video_id,video_store FROM video_store WHERE video_id = '".$gallery_value->video_id."'";
				//print_r($sql);die;
				$stmt = $dbCon->prepare($sql);  
				$stmt->execute();
				$images_array = $stmt->fetchALL(PDO::FETCH_OBJ);
				
				if(!empty($images_array)){		
					foreach($images_array as $images_value){
						
						$images_value->video_name = $images_value->video_store;
						$images_value->video_store = IMG_URL.'thumbnail/'.$images_value->video_store;
						
					}
					$gallery_value->images_array = $images_array;
					//print_R($gallery_value);DIE;	

				}else
					$gallery_value->images_array = array();
			}		
					
			
			$gallery_array = array('success' => '1','gallery_array' => $gallery_array);
		}else
			$gallery_array = array('success' => '0');
		
		echo json_encode($gallery_array);
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}



function panchangMonths(){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT * FROM panchang_months";

		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$panchang_month_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		if(!empty($panchang_month_array)){
			$panchang_month_array = array('success' => '1','panchang_month_array' => $panchang_month_array);
		}else
			$panchang_month_array = array('success' => '0');
		
		echo json_encode($panchang_month_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function editPanchang($id){
    global $app;
    $req = $app->request();
	
	$date = $req->params('date');
    $weekday = $req->params('weekday');
    $lunar_year = $req->params('lunar_year');
    $lunar_month = $req->params('lunar_month');
    $lunar_tithi = $req->params('lunar_tithi');
    $lunar_cycle = $req->params('lunar_cycle');
    $description = $req->params('description');
    $shubh_din = $req->params('shubh_din');



	$sql = "UPDATE panchang SET date = '" . date('Y-m-d',strtotime($date)) . "',weekday= '" . $weekday . "',lunar_year = '".$lunar_year."',lunar_tithi = '" . $lunar_tithi . "',lunar_cycle= '" . $lunar_cycle . "',description = '".$description."',lunar_month = '".$lunar_month."',shubh_din = '".$shubh_din."' WHERE id = '" . $id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user       = new stdClass();
        $dbCon      = null;
        $panchang = array(
            'success' => '1'
        );
        echo json_encode($panchang);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function getSinglePanchang($id){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT * FROM panchang WHERE id = '".$id."' ";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$panchang_array = $stmt->fetchObject();
		if(!empty($panchang_array))
			$panchang_array = array('success' => '1','panchang_array' => $panchang_array);
		else
			$panchang_array = array('success' => '0');
		
		echo json_encode($panchang_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getPanchang(){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT * FROM panchang  ORDER BY id DESC ";

		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$panchang_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		if(!empty($panchang_array)){
			$panchang_array = array('success' => '1','panchang_array' => $panchang_array);
		}else
			$panchang_array = array('success' => '0');
		
		echo json_encode($panchang_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function addPanchang(){
	
    global $app;
    $req  = $app->request();
    $date = $req->params('date');
    $weekday = $req->params('weekday');
    $lunar_year = $req->params('lunar_year');
    $lunar_month = $req->params('lunar_month');
    $lunar_tithi = $req->params('lunar_tithi');
    $lunar_cycle = $req->params('lunar_cycle');
    $description = $req->params('description');
    $shubh_din = $req->params('shubh_din');


    try {
        $dbCon       = getConnection();
	
		$sql = "INSERT INTO panchang SET date = '" . date('Y-m-d',strtotime($date)) . "',weekday= '" . $weekday . "',lunar_year = '".$lunar_year."',lunar_tithi = '" . $lunar_tithi . "',lunar_cycle= '" . $lunar_cycle . "',description = '".$description."',lunar_month = '".$lunar_month."',shubh_din = '".$shubh_din."' ";
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$panchang     = new stdClass();
		$panchang->id = $dbCon->lastInsertId();


		if (!empty($panchang->id)) {

			$panchang_array = array(
				'success' => '1',
			);
		}else {
			$panchang_array = array(
				'success' => '0',
			);
		}
		
        $dbCon = null;
        echo json_encode($panchang_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

/*
function addPanchangday(){
	
    global $app;
    $req  = $app->request();
    
    $name = $req->params('name');
    $month_hindi = $req->params('month_hindi');
    
    try {
        $dbCon       = getConnection();
	
		$sql = "UPDATE panchang_months SET name= '" . $name . "',month_hindi = '".$month_hindi."' WHERE id = '10' ";
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$panchang     = new stdClass();
		$panchang->id = $dbCon->lastInsertId();


		if (!empty($panchang->id)) {

			$panchang_array = array(
				'success' => '1',
			);
		}else {
			$panchang_array = array(
				'success' => '0',
			);
		}
		
        $dbCon = null;
        echo json_encode($panchang_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
*/


function addvideo(){
	
    global $app;
    $req  = $app->request();
    $title = $req->params('title');
    $video_id = $req->params('video_id');
    $video_store = $req->params('video_store');
    try {
        $dbCon       = getConnection();
	    
		$sql = "INSERT INTO video SET title = '".$title."',video_id= '".$video_id."',status = '1'";
		  //print_r($sql); die;
		   
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$video    = new stdClass();
		$video->v_id = $dbCon->lastInsertId();
		
		if(!empty($video->v_id)){
			
			$sql = "SELECT video_id FROM `video` WHERE v_id ='".$video->v_id."'";
			     // print_r($sql); die;
             $stmt_check = $dbCon->prepare($sql);  
		   $stmt_check->execute();
		$video_array->video_id =$stmt_check->fetchObject();
				   //print_r($video_array); die;
		   $insert = "INSERT INTO video_store SET  video_id = '".$video_id."', video_store = '".$video_store."'";
		       //print_r($insert); die;
			$stmt_check  = $dbCon->prepare($insert);
		   $stmt_check->execute();
		   $video_array = $stmt_check->fetchObject;
		   
	}   
			
           
		if (!empty($video->v_id)) {

			$video_array = array(
				'success' => '1',
			);
		}else {
			$video_array = array(
				'success' => '0',
			);
		}
		
        $dbCon = null;
        echo json_encode($video_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}



function addGallery(){
	
    global $app;
    $req  = $app->request();
    $title = $req->params('title');
    $gallery_id = $req->params('gallery_id');
    
		
    try {
        $dbCon       = getConnection();
	
		$sql = "INSERT INTO gallery SET title = '" . $title . "',gallery_id= '" . $gallery_id . "', status = '1'";
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$gallery     = new stdClass();
		$gallery->id = $dbCon->lastInsertId();


		if (!empty($gallery->id)) {

			$gallery_array = array(
				'success' => '1',
			);
		}else {
			$gallery_array = array(
				'success' => '0',
			);
		}
		
        $dbCon = null;
        echo json_encode($gallery_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function editGallery($id){
    global $app;
    $req = $app->request();
    $title = $req->params('title');

    $sql = "UPDATE gallery SET title  = '" . $title . "' WHERE id = '" . $id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user       = new stdClass();
        $dbCon      = null;
        $audio_file = array(
            'success' => '1',
            'sql' => $sql
        );
        echo json_encode($audio_file);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function editVideo($v_id){
    global $app;
    $req = $app->request();
    $title = $req->params('title');
     $video_id = $req->params('video_id');
    $video_store = $req->params('video_store');

    $sql = "UPDATE video SET title  = '" . $title . "' WHERE v_id = '" .$v_id ."'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
       // print_r($sql); die;
       
      $sql = "SELECT video_id FROM video WHERE v_id = '".$v_id."' ";
			     
             $stmt_check = $dbCon->prepare($sql);  
		   $stmt_check->execute();
		$video_array->video_id =$stmt_check->fetchObject();
          //print_r($video_array); die;
          
      $update = "UPDATE  video_store  SET video_store = '" . $video_store. "' WHERE video_id = '" .$video_id."' ";
      
            //print_r($update); die;
          $dbCon = getConnection();
        $stmt  = $dbCon->prepare($update);
        $stmt->execute();
          
            
          $video_file = array(
            'success' => '1','sql'=> $update
          
        );
         echo json_encode( $video_file);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}



function searchStavansangrah($search_key){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT id,title,type,lyrics,audio_file,image FROM stavansangrah WHERE type LIKE '%$search_key%' ";
	       
		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$user_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		
		if(!empty($user_array)){
			 foreach($user_array as $images){
			  $images->image =   ADMIN_URL.'uploads/'.$images->image; 
			   }}
			   
		if(!empty($user_array)){
			$user_array = array('success' => '1','user_array' => $user_array);
		}
		    else{
			$user_array = array('success' => '0','sql' =>$sql);
		}
		echo json_encode($user_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}



function editStavansangrah($id){
    global $app;
    $req = $app->request();
    $title = $req->params('title');
    $lyrics = $req->params('lyrics');
    $type = $req->params('type');
    $audio_file = $req->params('audio_file');
    $image = $req->params('image');


    $sql = "UPDATE stavansangrah SET title  = '" . $title . "',lyrics= '" . $lyrics . "',type= '" . $type . "',audio_file = '".$audio_file."',image = '".$image."'  WHERE id = '" . $id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user       = new stdClass();
        $dbCon      = null;
        $audio_file = array(
            'success' => '1',
            'sql' => $sql
        );
        echo json_encode($audio_file);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function getSingleStavansangrah($id){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT id,title,lyrics,type,audio_file,image FROM stavansangrah WHERE id = '".$id."' ";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$stavan_array = $stmt->fetchObject();
		   if(!empty($stavan_array)){
			   
			   $stavan_array->audio_file_url =   ADMIN_URL.'uploads/'.$stavan_array->audio_file; 
			    $stavan_array->image_file_url =   ADMIN_URL.'uploads/'.$stavan_array->image; 
			   }
		
		if(!empty($stavan_array))
			$stavan_array = array('success' => '1','stavan_array' => $stavan_array);
		else
			$stavan_array = array('success' => '0');
		
		echo json_encode($stavan_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getStavansangrahType(){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT id,name,english_image FROM stavansangrah_type  ORDER BY id DESC ";

		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$stavan_type_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		if(!empty($stavan_type_array)){
			$stavan_type_array = array('success' => '1','stavan_type_array' => $stavan_type_array);
		}else
			$stavan_type_array = array('success' => '0');
		
		echo json_encode($stavan_type_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getStavansangrah(){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT id,title,type,audio_file,image FROM stavansangrah  ORDER BY id DESC ";
		
     $stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$stavan_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		
		if(!empty($stavan_array)){
			 foreach($stavan_array as $images){
			  $images->image =   ADMIN_URL.'uploads/'.$images->image; 
			   }}
			   
		if(!empty($stavan_array)){
			$stavan_array = array('success' => '1','stavan_array' => $stavan_array);
		}else
			$stavan_array = array('success' => '0');
		
		echo json_encode($stavan_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function addStavansangrah(){
	
    global $app;
    $req  = $app->request();
    $title = $req->params('title');
    $lyrics = $req->params('lyrics');
    $type = $req->params('type');
    $audio_file = $req->params('audio_file');
    $image = $req->params('image');

    try {
        $dbCon       = getConnection();
	
		$sql = "INSERT INTO stavansangrah SET title = '" . $title . "',lyrics= '" . $lyrics . "',type= '" . $type . "',audio_file = '".$audio_file."',image = '".$image."' ";
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$stavan     = new stdClass();
		$stavan->id = $dbCon->lastInsertId();


		if (!empty($stavan->id)) {

			$stavan_array = array(
				'success' => '1',
				'sql' => $sql
			);
		}else {
			$stavan_array = array(
				'success' => '0',
			);
		}
		
        $dbCon = null;
        echo json_encode($stavan_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function getStates(){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT state_id,name FROM states ORDER BY name ";
		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$states_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		if(!empty($states_array)){
			$states_array = array('success' => '1','states_array' => $states_array);
		}else
			$states_array = array('success' => '0');
		
		echo json_encode($states_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}



function editEvent($id){
    global $app;
    $req = $app->request();
    $event_name = $req->params('event_name');
    $event_description = $req->params('event_description');
    $event_date_time = $req->params('event_date_time');
    $image = $req->params('image');

    $sql = "UPDATE events SET event_name  = '" . $event_name . "',event_description= '" . $event_description . "',image= '" . $image . "',event_date_time = '".$event_date_time."'  WHERE id = '" . $id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user       = new stdClass();
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function getSingleEvent($id){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT id,event_name,event_description,event_date_time,image FROM events WHERE id = '".$id."' ";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$event_array = $stmt->fetchObject();
		if(!empty($event_array))
			$event_array = array('success' => '1','event_array' => $event_array);
		else
			$event_array = array('success' => '0');
		
		echo json_encode($event_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getEvents(){
	
	
	try{
		$dbCon = getConnection();
		
		$todat_date = date("Y/m/d");
		//$sql = "SELECT id,event_name,event_date_time,image FROM events  ORDER BY id DESC ";

               
	     $sql = "SELECT * FROM events where event_date >= '".$todat_date."'";
	      
	    
	      
		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$event_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		if(!empty($event_array)){
			$event_array = array('success' => '1','event_array' => $event_array);
		}else
			$event_array = array('success' => '0');
		
		echo json_encode($event_array);
		
     }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function previousevents(){
       try{
			$dbCon       = getConnection();
		   
		    $date = date("Y/m/d");
		    $pevious_date=date('Y/m/d', strtotime('-30 day', strtotime($date)));
		   $today_date =date('Y/m/d');
		   
		    $select = "select *from events where event_date Between  '".$pevious_date."' AND '".$today_date."' ";
		    $stmt_check = $dbCon->prepare($select);  
		      $stmt_check->execute();
		$past_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		$future_event = "select *from events where event_date  >='".$today_date."' ";
		    
		   $stmt_check = $dbCon->prepare($future_event);  
		      $stmt_check->execute();
		$future_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		     //print_r( $event_array);die;
		     $event_array = array('success' => '1','past_array' => $past_array,'future_array' => $future_array);
		    
		
		
		}catch (PDOException $e) {
			echo '{"error":{"text":' . $e->getMessage() . '}}';
		}		
    		
}	


function addEvent(){
	
    global $app;
    $req             = $app->request();
    $event_name = $req->params('event_name');
    $event_description = $req->params('event_description');
    $event_date_time = $req->params('event_date_time');
    $image = $req->params('image');

    try {
        $dbCon       = getConnection();
	     
	      $event_date = explode("-","$event_date_time");
	     
	      $event_date= date('Y/m/d',strtotime($event_date['1']));
				 
 	     
		$sql = "INSERT INTO events SET event_name = '" . $event_name . "',
		event_description= '" . $event_description . "',event_date_time = '".$event_date_time."',
		image = '".$image."',
		event_date = '".$event_date."' ";
		
		
		
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$event     = new stdClass();
		$event->id = $dbCon->lastInsertId();

		if (!empty($event->id)) {

			$event_array = array(
				'success' => '1',
			);
		}else {
			$event_array = array(
				'success' => '0',
			);
		}
		
        $dbCon = null;
        echo json_encode($event_array	);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}



function editReligiousplaces($id){
    global $app;
    $req = $app->request();
    $name = $req->params('name');
    $name_hindi = $req->params('name_hindi');
    $address = $req->params('address');
    $address_hindi = $req->params('address_hindi');
    $state_id = $req->params('state_id');
    $description = $req->params('description');
    $description_hindi = $req->params('description_hindi');
    $image = $req->params('image');

    $sql = "UPDATE religious_places SET `name`= '".trim($name)."',`name_hindi`= '".trim($name_hindi)."',
    `description`= '".trim($description)."',
     `description_hindi`= '".trim($description_hindi)."',
    `address`= '".trim($address)."',
    `address_hindi`= '".trim($address_hindi)."',
    `state_id`= '".trim($state_id)."',`image`= '".$image."' WHERE id = '" . $id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user       = new stdClass();
        $dbCon      = null;
        $user_array = array(
            'success' => '1'
            
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function getSingleReligiousplaces($id){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT id,name,name_hindi,address,address_hindi,description,description_hindi,state_id,image FROM religious_places WHERE id = '".$id."' ";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$place_array = $stmt->fetchObject();
		
		
		if(!empty($place_array)){		
					
						$place_array->image =$place_array->image;
						$place_array->images =ADMIN_URL.'uploads/'.$place_array->image;
						
					}
		
	
	
			$place_array = array('success' => '1','place_array' => $place_array);
		
		echo json_encode($place_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getReligiousPlaces($type){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT rp.id,rp.name,rp.name_hindi,rp.address_hindi,rp.description_hindi,rp.address,rp.type,rp.image,s.name,s.name AS state_name,rp.description,rp.name FROM religious_places AS rp LEFT JOIN states AS s ON s.state_id = rp.state_id WHERE type = '".$type."' ORDER BY id DESC ";
		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$place_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		
		if(!empty($place_array)){		
			
					foreach($place_array as $photo)	{
						$photo->image =$photo->image;
						$photo->images =ADMIN_URL.'uploads/'.$photo->image;
						
						
					}}
		
	
	
			$place_array = array('success' => '1','place_array' => $place_array);
		
		echo json_encode($place_array);
		//print_r($place_array); die;
		
	} catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}



function addReligiousPlaces(){
    global $app;
    $req = $app->request();
    $name = $req->params('name');
    $name_hindi = $req->params('name_hindi');
    $address = $req->params('address');
    $address_hindi = $req->params('address_hindi');
	$type = $req->params('type');
	$state_id = $req->params('state_id');
	$description = $req->params('description');
	$description_hindi = $req->params('description_hindi');
	$image = $req->params('image');

    try {
        $dbCon = getConnection();
		$sql = "INSERT INTO religious_places SET name = '" . $name . "',name_hindi = '" . $name_hindi . "',address= '" . $address . "',address_hindi = '" . $address_hindi . "',image= '" . $image . "',
		description = '".$description."',description_hindi = '".$description_hindi."',type = '".$type."',state_id = '".$state_id."' ";
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$group     = new stdClass();
		$place->id = $dbCon->lastInsertId();
		

		if (!empty($place->id)) {

			$place_array = array(
				'success' => '1','id'=>$place->id
			);
		}else {
			$place_array = array(
				'success' => '0',
				'msg' => $msg
			);
		}


        echo json_encode($place_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function addMultiimage(){
    global $app;
    $req = $app->request();
    $religious_id = $req->params('religious_id');
	$image = $req->params('image');

    try {
        $dbCon = getConnection();
		
		
			$image=rtrim($image,',');
          $res=explode(",",$image);
          
           
       //print_r($res) ; //die;
           foreach($res as $results){
			   $sql = "INSERT INTO  religious_images SET religious_id = '" . $religious_id . "',image= '" . $results . "' ";
		
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
			   
			   
		  }

			$place_array = array(
				'success' => '1',
			);
		
		

        echo json_encode($place_array);
	}
    
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function editmultiimage($id){
    global $app;
    $req = $app->request();
   
    $image = $req->params('image');

    $sql = "UPDATE religious_images SET `image`= '".$image."' WHERE id = '" . $id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user       = new stdClass();
        $dbCon      = null;
        $user_array = array(
            'success' => '1'
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function getSingleReligiousimage($id){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT religious_id,image,id As image_ids FROM religious_images WHERE religious_id = '".$id."' ";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$images_array = $stmt->fetchALL(PDO::FETCH_OBJ);
		
				
		if(!empty($images_array)){
			$images_array = array('success' => '1','place_array' => $images_array);}
		else{
			$images_array = array('success' => '0');
	}
		echo json_encode($images_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function deleteimage($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM religious_images WHERE `id` = '" . $id . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $response = array(
            'success' => '1'
        );
        $dbCon    = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function editGroup($id){
    global $app;
    $req = $app->request();
    $group_name = $req->params('group_name');
    $group_name_hindi = $req->params('group_name_hindi');
    $group_head = $req->params('group_head');

    $sql = "UPDATE groups SET `group_name`= '".trim($group_name)."',`group_name_hindi`= '".trim($group_name_hindi)."',`group_head`= '".trim($group_head)."' WHERE id = '" . $id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user       = new stdClass();
        $dbCon      = null;
        $user_array = array(
            'success' => '1'
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function getSingleGroup($id){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT id,group_name,group_name_hindi,group_head FROM groups WHERE id = '".$id."' ";
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$group_array = $stmt->fetchObject();
		if(!empty($group_array))
			$group_array = array('success' => '1','group_array' => $group_array);
		else
			$group_array = array('success' => '0');
		
		echo json_encode($group_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getGroups(){
	
	
	try{
		$dbCon = getConnection();
		
		$sql = "SELECT g.id,g.group_name,g.group_name_hindi,g.created_date,au.username AS group_head,au.user_type FROM groups AS g INNER JOIN app_users AS au ON au.user_id = g.group_head ORDER BY id DESC ";

		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$group_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		if(!empty($group_array)){
		
			foreach($group_array as $group_value){

				$sql = "SELECT au.username FROM app_users AS au WHERE group_id = '".$group_value->id."' ORDER BY user_id DESC ";

				$stmt_check = $dbCon->prepare($sql);  
				$stmt_check->execute();
				$member_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
				
				$group_value->member_array = $member_array;
					
					
			}	
			$group_array = array('success' => '1','group_array' => $group_array);
		
		}else
			$group_array = array('success' => '0');
		
		echo json_encode($group_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function addGroup(){
	
    global $app;
    $req             = $app->request();
    $group_name = $req->params('group_name');
    $group_name_hindi = $req->params('group_name_hindi');
    $group_head = $req->params('group_head');

    try {
        $dbCon       = getConnection();
	
		$sql = "INSERT INTO groups SET group_name = '" . $group_name . "',group_name_hindi = '" . $group_name_hindi . "',group_head= '" . $group_head . "',created_date = '".TODAY_DATE_TIME."' ";
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$group     = new stdClass();
		$group->id = $dbCon->lastInsertId();


		if (!empty($group->id)) {

			$group_array = array(
				'success' => '1',
				'sql' => $sql
			);
		}else {
			$group_array = array(
				'success' => '0',
				'msg' => $msg
			);
		}
		
        $dbCon = null;
        echo json_encode($group_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function deleteData(){
    global $app;
    $req        = $app->request(); // Getting parameter with names
    $delete_id  = $req->params('delete_id');
    $table_name = $req->params('table_name');
    $field_name = $req->params('field_name');
   
	$sql        = "DELETE FROM " . $table_name . " WHERE " . $field_name . " = '" . $delete_id . "' ";
		
    try {
        $dbCon = getConnection();
		$stmt  = $dbCon->prepare($sql);
        $stmt->execute();


        $user       = new stdClass();
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function getUserInfo($user_id){
    $sql = "SELECT user_id,user_type,username,email_address,mobile_number FROM app_users WHERE user_id = '" . $user_id . "'";
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql);
        $user_array = $stmt->fetchObject();
        $dbCon      = null;
        return $user_array;
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
/*
function editUser($user_id){
	
    global $app;
    $req             = $app->request();
    

    try {
       
	
	echo	$sql = "UPDATE app_users SET group_id = '".$group_id."',diksha_date = '".$diksha_date."',username = '" . $username . "',username_hindi = '" . $username_hindi . "',
		mobile_number = '" . $mobile_number . "', password = '" . md5($password) ."',image ='".$image."',user_type = '".$user_type."', modified_date = '".TODAY_DATE_TIME."' WHERE user_id = '".$user_id."' "; 
		 $dbCon       = getConnection();
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$user_array = array(
			'success' => '1'
			);
	//print_r($user_array); die;
       $dbCon = null;
        echo json_encode($user_array); 
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
*/


function editUser($user_id) {

    global $app;
    $req = $app->request(); 

    
   $group_id = $req->params('group_id');
   $username = $req->params('username');
    $username_hindi = $req->params('username_hindi');
    $mobile_number = $req->params('mobile_number');
    $password = $req->params('password');
    $user_type = $req->params('user_type');
    $diksha_date = $req->params('diksha_date');
    $image = $req->params('image');
	$diksha_date = date("Y-m-d", strtotime($diksha_date));
    
    
	
    $sql = "UPDATE app_users SET group_id = '".$group_id."',diksha_date = '".$diksha_date."',username = '" . $username . "',username_hindi = '" . $username_hindi . "',
		mobile_number = '" . $mobile_number . "', password = '" . md5($password) ."',image ='".$image."',user_type = '".$user_type."', modified_date = '".TODAY_DATE_TIME."' WHERE user_id = '".$user_id."' "; 

    try {
        $dbCon       = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->execute();
		
		$user_array = array('success' => '1');
        $dbCon = null;
        echo json_encode($user_array); 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }

}

function checkEmailExists($email, $return_type){
    $sql = "SELECT user_id FROM app_users WHERE email_address = '" . $email . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->query($sql);
        $user  = $stmt->fetchObject();
        if ($user == false) {
            $response = array(
                'success' => '0'
            );
        } else {
            $response = array(
                'success' => '1'
            );
        }
        $dbCon = null;
        if ($return_type == 'echo')
            echo json_encode($response);
        else
            return json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}


function addUser(){
	
    global $app;
    $req             = $app->request();
    $group_id = $req->params('group_id');
    $username = $req->params('username');
    $username_hindi = $req->params('username_hindi');
    $email_address = $req->params('email_address');
    $mobile_number = $req->params('mobile_number');
    $password = $req->params('password');
    $user_type = $req->params('user_type');
    $diksha_date = $req->params('diksha_date');
    $longitude = $req->params('longitude');
    $latitude = $req->params('latitude');
    $image = $req->params('image');


    if(!empty($diksha_date))
		$diksha_date = date("Y-m-d", strtotime($diksha_date));
	else
		$diksha_date = '0000-00-00';

    try {
        $dbCon       = getConnection();
		$check_email         = checkEmailExists($email_address, 'return');
		$check_result        = json_decode($check_email);

		
		

			$sql = "INSERT INTO app_users SET group_id = '".$group_id."',username = '" . $username . "',username_hindi = '" .$username_hindi. "',email_address = '" . $email_address . "'
			,mobile_number = '" . $mobile_number . "', password = '" . md5($password) . "',user_type = '".$user_type."',
			join_date = '".TODAY_DATE_TIME."',modified_date = '".TODAY_DATE_TIME."',diksha_date = '".$diksha_date."',
			longitude = '".$longitude."',image ='".$image."',latitude = '".$latitude."' ";
            $stmt  = $dbCon->prepare($sql);
		    $stmt->execute();
            $user     = new stdClass();
            $user->id = $dbCon->lastInsertId();


			if (!empty($user->id)) {

				$user_array = array(
					'success' => '1',
					'user_array' => getUserInfo($user->id)
				);
			}else {
				$user_array = array(
					'success' => '0',
					'msg' => $msg
				);
			}

		
		
        $dbCon = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function getSingleUser($user_id){
	
	
	try{
		$dbCon = getConnection();
		
		$sql_user = "SELECT app_users.user_id,app_users.group_id,app_users.user_type,app_users.address,app_users.username,app_users.username_hindi,app_users.email_address,app_users.mobile_number,app_users.join_date,app_users.diksha_date,app_users.image,app_users.modified_date  ,groups.group_name_hindi FROM app_users LEFT JOIN groups ON app_users.group_id = groups.id WHERE app_users.user_id = '".$user_id."' ";

		$sql = "SELECT * FROM diksha_vivran WHERE user_id = '".$user_id."' ";
		
		
		
		
		//print_r($sql);  //die;
		
		$sql_in = "SELECT * FROM dikshit_sankarik_pariwar WHERE user_id = '".$user_id."' ";
		//print_r($sql_in);  die;
		$sql_query = "SELECT * FROM sansari_jivan WHERE user_id = '".$user_id."' ";
		//print_r($sql_query);  die;
		
		$sql_sadhana = "SELECT * FROM sadhana_achivement WHERE user_id = '".$user_id."' ";
		
		$stmt = $dbCon->prepare($sql_user);  
		$stmt->execute();
		$user = $stmt->fetchObject();
		
		$user->image_url =  ADMIN_URL. 'uploads/'. $user->image;
		
		
		$stmt = $dbCon->prepare($sql_query);  
		$stmt->execute();
		$sansari_jivan = $stmt->fetchObject();
		if(!empty($sansari_jivan)){
			$sansari_jivan = $sansari_jivan ;
			
		}else{
			$sansari_jivan = '0';
		}
		
		$stmt = $dbCon->prepare($sql_sadhana);  
		$stmt->execute();
		$sadhana = $stmt->fetchObject();
		
		if(!empty($sadhana)){
			$sadhana = $sadhana ;
			
		}else{
			$sadhana = '0';
		}
		
		//print_r($sadhana); die;
		$stmt = $dbCon->prepare($sql);  
		$stmt->execute();
		$stavan = $stmt->fetchObject();	
																																																																																																
		  if(!empty($stavan)){
			$stavan = $stavan ;
			
		}else{
			$stavan = '0';
		}
		
		$stmt = $dbCon->prepare($sql_in);  
		$stmt->execute();
		$dikshit_sankarik_pariwar = $stmt->fetchObject();
		
																																																																																																
		  if(!empty($dikshit_sankarik_pariwar)){
			$dikshit_sankarik_pariwar = $dikshit_sankarik_pariwar ;
			
		}else{
			$dikshit_sankarik_pariwar = '0';
		}
		
		 //print_r($stavan_query); die;
		 
		if(!empty($user)){
			
		     $user_array = array('success' => '1','user_array'=>$user,'sadhana'=>$sadhana,'sansari_jivan'=>$sansari_jivan, 'stavan'=>$stavan, 'dikshit_sankarik_pariwar' => $dikshit_sankarik_pariwar);
		    } 
		     else{
		     
			$user_array = array('success' => '0');
		}
		echo json_encode($user_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getAllUsers($user_type){
	
	
	try{
		$dbCon = getConnection();
		
		if($user_type == 'all')
			$sql = "SELECT user_id,group_id,user_type,username,username_hindi,email_address,mobile_number,image,join_date,group_name,group_head,longitude,latitude,address,modified_date,image FROM app_users AS au LEFT JOIN groups AS g ON g.id = au.group_id WHERE user_type != 'admin' ORDER BY user_id DESC ";
		else
			$sql = "SELECT user_id,group_id,user_type,username,username_hindi,email_address,mobile_number,image,join_date,group_name,group_head,longitude,latitude,address,modified_date,image FROM app_users AS au LEFT JOIN groups AS g ON g.id = au.group_id WHERE user_type != 'admin' AND user_type = '".$user_type."' ORDER BY user_id DESC ";

		$stmt_check = $dbCon->prepare($sql);  
		$stmt_check->execute();
		$user_array = $stmt_check->fetchALL(PDO::FETCH_OBJ);
		if(!empty($user_array)){
			foreach($user_array as $user_value){
				
				if(empty($user_value->latitude))
					$user_value->latitude ='0.0';
				if(empty($user_value->longitude))
					$user_value->longitude ='0.0';	
				
				if(!empty($user_value->group_id)){	
					$sql = "SELECT au.username FROM app_users AS au LEFT JOIN groups AS g ON g.id = au.user_id WHERE user_type != 'admin' AND au.user_id = '".$user_value->group_head."' ";
					$stmt_check = $dbCon->prepare($sql);  
					$stmt_check->execute();
					$group_array = $stmt_check->fetchObject();
					
					if(!empty($group_array))
						$user_value->group_name = $user_value->group_name." (<b>".$group_array->username."</b>)";
					else
						$user_value->group_name = 'Not Available';
				}else{
						$user_value->group_name = 'Not Available';
				}	
			
			}
			$user_array = array('success' => '1','user_array' => $user_array);
		}else 
			$user_array = array('success' => '0','sql' =>$sql);
		
		echo json_encode($user_array);
		
		
	}catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function userLogin(){
	
    global $app;
    $req             = $app->request();
    $email_address = $req->params('email_address');
    $password = $req->params('password');
    

    $sql = "SELECT user_id,username,email_address FROM app_users WHERE (email_address = '" . $email_address . "' OR mobile_number = '" . $email_address . "') AND password = '" . md5($password) . "' ";
    try {
        $dbCon       = getConnection();
        $stmt        = $dbCon->query($sql);
        $user_array = $stmt->fetchObject();
        if (!empty($user_array)) {
            $user_array = array(
                'success' => '1',
                'user_array' => $user_array
            );
        } else {
            $user_array = array(
                'success' => '0',
				'msg' => 'Invalid email/password combination. Please try again'

            );
        }
        $dbCon = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function adminLogin($username, $password){
	
    global $app;
    $req             = $app->request();
    $email_address = $req->params('email_address');
    $password = $req->params('password');

    $sql = "SELECT user_id,username,email_address FROM app_users WHERE email_address = '" . $email_address . "' AND password = '" . md5($password) . "' AND user_type = 'Admin' ";
    try {
        $dbCon       = getConnection();
        $stmt        = $dbCon->query($sql);
        $admin_array = $stmt->fetchObject();
        if (!empty($admin_array)) {
            $admin_array = array(
                'success' => '1',
                'admin_array' => $admin_array
            );
        } else {
            $admin_array = array(
                'success' => '0',
				'msg' => 'Invalid email/password combination. Please try again'

            );
        }
        $dbCon = null;
        echo json_encode($admin_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function create_url_slug($string){
    $string = strtolower($string);
    $slug   = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return $slug;
}

function getConnection(){
    try {
        $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $conn;
}


$app->run();
