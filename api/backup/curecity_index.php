<?php
include_once("Slim/Slim.php");
\Slim\Slim::registerAutoloader();
require "NotORM.php";
$app = new \Slim\Slim();
require_once("../constants/filenames.php");
$mcrypt = new MCrypt();

 
// for admin
$app->get('/admin/login/username/:username/password/:password', 'adminLogin');
// for user
$app->post('/user/add', 'addUser');
$app->get('/users', 'getUsers');
$app->get('/users/:usertype', 'getUsersByType');
// for doctors
$app->post('/doctor/add', 'addDoctor');
$app->get('/doctors', 'getDoctors');
$app->get('/doctor/single/:user_id', 'getSingleDoctor');
$app->delete('/app_users/delete/:id', 'deleteDoctor');
$app->post('/doctor/edit/:edit_id', 'editDoctor');
// for hospitals
$app->post('/hospital/add', 'addHospital');
$app->get('/hospitals', 'getHospitals');
$app->get('/hospital/single/:id', 'getSingleHospital');
$app->post('/hospital/edit/:edit_id', 'editHospital');
$app->delete('/user_images/delete/:id', 'deleteUserImage');
// for category type
$app->get('/categorytype', 'getCategoryType');

// for category
$app->get('/categories', 'getCategory');
$app->get('/categories/all', 'getCategoryAll');
$app->get('/categories/type/:type_id', 'getCategoryByType');
$app->get('/category/single/:id', 'getSingleCategory');
$app->post('/category/add', 'addCategory');
$app->post('/category/edit/:edit_id', 'editCategory');
$app->delete('/category/delete/:id', 'deleteCategory');
$app->get('/category/keywords/:id', 'getCategoryKeywords');
// for facility
$app->post('/facility/add', 'addFacility');
$app->post('/facility/edit/:edit_id', 'editFacility');
$app->get('/facilities/all', 'getFacilityAll');
$app->get('/facility/single/:id', 'getSingleFacility');
$app->delete('/facility/delete/:id', 'deleteFacility');
$app->get('/facility/categorytype/:id', 'getCategorytypeFacility');
// for locations
$app->post('/location/add', 'addLocation');
$app->get('/locations/all', 'getLocationAll');
$app->post('/location/edit/:edit_id', 'editLocation');
$app->get('/location/single/:id', 'getSingleLocation');
$app->delete('/location/delete/:id', 'deleteLocation');
// for subareas
$app->post('/subarea/add', 'addSubarea');
$app->get('/subareas/all', 'getSubareaAll');
$app->post('/subarea/edit/:edit_id', 'editSubarea');
$app->get('/subarea/single/:id', 'getSingleSubarea');
$app->delete('/subarea/delete/:id', 'deleteSubarea');
$app->get('/subareas/location/:location_id', 'getLocationSubareas');
// for health services
$app->post('/healthservice/add', 'addHealthService');
$app->get('/healthservices', 'getHealthServices');
$app->get('/healthservice/single/:id', 'getSingleHealthService');
$app->post('/healthservice/edit/:edit_id', 'editHealthService');
// for frequent keywords
$app->post('/keywords/add', 'addKeywords');
$app->get('/keywords/all', 'getKeywordsAll');
$app->get('/keywords/single/:id', 'getSingleKeywords');
$app->post('/keywords/edit/:edit_id', 'editKeywords');
$app->delete('/keywords/delete/:id', 'deleteKeywords');
// for education center
$app->post('/education/add', 'addEducation');
$app->get('/education/all', 'getEducation');
$app->get('/education/single/:id', 'getSingleEducation');
$app->post('/education/edit/:edit_id', 'editEducation');
// for dynamic emails
$app->post('/message/add', 'addMessage');
$app->get('/message/:message_type/all', 'getMessages');
$app->get('/message/single/:id', 'getSingleMessage');
$app->post('/message/edit/:edit_id', 'editMessage');
$app->delete('/message/delete/:id', 'deleteMessage');
// for newsletter update
$app->get('/newletter_update/:user_id/:status', 'updateNewsletterStatus');
####################################### ADDED BY SUNIL ##################################
$app->post('/substitutes_moderator', 'SubstituteModerator');
$app->get('/singleuser/:user_id', 'getSingleUsers');
$app->get('/getusermoderator/:user_id', 'getSingleUserModerator');
$app->delete('/substitute_moderator/delete/:id', 'deleteSubstituteModerator');
$app->get('/moderatorsingle/:user_id', 'getSingleModerator');
$app->post('/editsubstitutes_moderator/edit/:edit_id', 'editsubstitutesmoderator');
/************ FOR UsER PROFile *****/
$app->get('/profile/single/:id', 'getSingleProfile');
$app->post('/profile/edit/:edit_id', 'editProfile');
$app->post('/profile/changepassword/:edit_id', 'editProfileChangePassword');
/***********manage review criteras ******/
$app->get('/criteriareview/all', 'getAllcriterias');
$app->post('/addcriteria_review/add', 'addReviewCriteria');
$app->get('/reviewsingle/single/:id', 'getSingleCriteria');
$app->post('/reviewedit/edit/:edit_id', 'editReviews');
$app->delete('/review_criteria/delete/:id', 'deleteReviews');
/***********manage-newsboard*/
$app->post('/news/add', 'addNews');
$app->get('/news/:user_id', 'getNews');
$app->get('/news/single/:id', 'getNewsSingle');
$app->post('/news/edit/:edit_id', 'editNews');
$app->delete('/news_board/delete/:id', 'deleteNewsBoard');
/********* Comment by news ID *******/
$app->get('/newscomment/single/:id', 'getNewsSingleComment');
$app->get('/newscomments/single/:id', 'getSingleComment');
$app->post('/newscomments/edit/:edit_id', 'editNewsComment');
$app->delete('/news_comment/delete/:id', 'deleteNewsBoardComment');
/********* User COmments *******/
$app->get('/usercomment', 'getSingleUsercom');
$app->post('/usercomment/add', 'addUserComment');
$app->get('/usercommentall', 'GetUserComment');
$app->get('/usercomments/single/:id', 'getSingleUserComment');
$app->post('/userscomments/edit/:edit_id', 'editUsersComment');
$app->delete('/user_review/delete/:id', 'deleteUserComment');
/*********************     Date 1/22/2016     ****************************/
$app->post('/review_to_vendor/add', 'addReviewVendor');
$app->post('/review_to_vendor/edit/:userid', 'editReviewVendor');
$app->delete('/user_review/delete/:id', 'deleteUserReview');

$app->get('/getusercommentall/:slug_name', 'getUserCommentSingle');
$app->get('/vendor_user/single/:slug_name/userid/:userid', 'getSingleVendorUser');
$app->get('/fullratings/all/:vendor_id', 'GetFullRatingsVendor');
$app->get('/getusersclick/singleip/:vendor_id', 'GetUsersClickSingle');
$app->get('/vendorhistory/add/:vendor_id', 'AddVendorHistory');
$app->post('/changeservicelogo', 'ChangeServiceLogo');
$app->post('/user/uploadprofileimage/:user_id', 'uploadProfileImage');

$app->get('/user/single/:user_id', 'getSingleUser');
$app->get('/getmyreviews/:id', 'getMyReviews');
$app->get('/getmysinglereviews/single/:review_id/userid/:user_id', 'getMySingleReviews');
$app->get('/getvendorreviews/:id', 'getVendorReviews');

 
$app->get('/getusersclick/all/:vendor_id', 'GetUsersClick');
$app->get('/secondopinionusers/single/:user_id', 'SecondOpinionUsers');
$app->post('/reviewcomment/add', 'addReviewComment');
$app->post('/reviewcomment/edit/:id', 'reviewcommentEdit');
$app->post('/front_doctor/edit/:edit_id', 'editFrontDoctor');
$app->post('/front_hospital/edit/:edit_id', 'editHospitalUser');
$app->post('/front_health/edit/:edit_id', 'editHealthUser');
$app->post('/front_education/edit/:edit_id', 'editEducationUser');
$app->post('/front_useredit/edit/:edit_id', 'editFrontUser');
$app->post('/notification/edit/:edit_id', 'editNotification');
$app->post('/registervendor/add', 'AddRegisterVendor');
$app->delete('/user_images_delete/delete/:id', 'deleteUserImageDelete');

$app->post('/reviewreply/add', 'addReviewReply');
$app->post('/reviewlike/add', 'addReviewLike');
$app->post('/reviewlike/remove', 'removeRevewliked');
$app->post('/replylike/add', 'addReplyLike');
$app->post('/replylike/remove', 'removeReplyLike');

$app->post('/usercheck/single', 'UserCheckSocial');

$app->get('/favourite/edit/vendorid/:vendorid/userid/:userid', 'editFavourite');

$app->get('/favourite/remove/vendorid/:vendorid/userid/:userid', 'removeFavourite');


$app->post('/account/register', 'addFrontUser');
$app->post('/consumerLogin', 'ConsumerLogin');
$app->post('/consumerSocialLogin', 'consumerSocialLogin');


$app->get('/consumercheck/:email_id', 'ConsumerCheck');
$app->post('/frontLogin', 'FrontLogin');

$app->get('/categorytype/all', 'getCategoryTypeAll');
$app->get('/search/global/:search_key', 'getGlobalSearch');

// for vendor list page
$app->post('/search/specific', 'getSearch'); 
$app->get('/account/forgot_password/:email_address', 'webForgotPassword'); 
$app->get('/user/wishlist/:user_id', 'getWishlist'); 
$app->get('/forgotpassword/:email_address', 'forgotPassword');
$app->post('/resetpassword', 'resetPassword');
$app->post('/follower/add', 'addFollowerList');
$app->post('/follower/remove', 'removeFollowerList');

$app->post('/document/add', 'addDocument');
 
$app->delete('/medical_documents/delete/:delete_id/userid/:user_id', 'deleteDocument');



// for verify doctor app
$app->post('/verify/userlogin', 'verifyUserLogin');
$app->get('/verify/unverifiedDoctors/:user_id', 'getUnverifiedDoctors');
$app->post('/verify/user/add', 'verifyAddUser');
$app->get('/verify/cities', 'verifyCity');
$app->get('/verify/subareas', 'verifySubareas');
$app->get('/verify/states', 'verifyStates');
$app->get('/verify/cities/filter/:state_id', 'verifyFilterCity');
$app->get('/verify/subareas/filter/:city_id', 'verifyFilterSubarea');
$app->get('/verify/users/filter/:subarea_id', 'verifyFilterUsers');
$app->get('/verify/users/filter/bycity/:city_id', 'verifyFilterUsersByCity');
$app->post('/verify/user/delete', 'verifyDeleteUsers');
$app->post('/verify/users/search', 'verifySearchUser');
$app->get('/verify/filter/clinics/:subarea_id', 'verifyFilterClinics');
$app->post('/verify/allot/location', 'verifyAllotLocation');
$app->get('/verify/users/filter/doctors/:user_id/status/:status', 'getVerifyUsersDoctors');
$app->get('/verify/users/map', 'getUserMap');
$app->post('/verify/doctor/add/:user_id', 'verifyAddInreviewDoctor');
$app->post('/verify/doctor/pics/add/:doctor_id', 'verifyAddInreviewDoctorPics');

function verifyAddInreviewDoctorPics($doctor_id){

   global $app;
    $req           = $app->request();

    $image  = $req->params('image');
    $image_type       = $req->params('image_type');


	$photo = time().'.png';
	$path = $_SERVER["DOCUMENT_ROOT"] ."/curecity/uploads/".$photo;
	file_put_contents($path,base64_decode($image));

    try {
        $dbCon = getConnection();
		$sql  = "INSERT INTO inreview_doctor_pics SET `doctor_id`= '" . $doctor_id . "',`image` = '" . $photo . "' ,`image_type` = '" . $image_type . "'";
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$user     = new stdClass();
		$user->id = $dbCon->lastInsertId();
		if (!empty($user->id)) {
			$user_array = array(
				'success' => '1',
				'insert_id' => $user->id,
				'sql' => $sql
			);
		} else {
			$user_array = array(
				'success' => '0'
			);
		}
	
        $dbCon = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }

}


function verifyAddInreviewDoctor($user_id){

   global $app;
    $req           = $app->request();

    $verify_user_id  = $req->params('verify_user_id');
    $firstname       = $req->params('firstname');
    $email_address      = $req->params('email_address');
    $gender     = $req->params('gender');
    $dob  = $req->params('dob');
    $phone       = $req->params('phone');
    $mobile      = $req->params('mobile');
    $res_address     = $req->params('res_address');
    $clinic_name  = $req->params('clinic_name');
    $clinic_address       = $req->params('clinic_address');
    $category_type_id      = $req->params('category_type_id');
    $specialization     = $req->params('specialization');
    $degree  = $req->params('degree');
    $practicing_since       = $req->params('practicing_since');
    $subarea_id      = $req->params('subarea_id');
    $website     = $req->params('website');
    $timings  = $req->params('timings');
    $timings_residence       = $req->params('timings_residence');
    $second_opinion       = $req->params('second_opinion');
    $beds      = $req->params('beds');
    $year_of_establishment     = $req->params('year_of_establishment');
    $operation_hours  = $req->params('operation_hours');
    $certification_photo       = $req->params('certification_photo');
    $media_claim_facility      = $req->params('media_claim_facility');
    $contact_person     = $req->params('contact_person');
    $other_details  = $req->params('other_details');
    
	$photo = time().'.png';
	$path = $_SERVER["DOCUMENT_ROOT"] ."/curecity/uploads/".$photo;
	file_put_contents($path,base64_decode($certification_photo));

    try {
        $dbCon = getConnection();
		$sql  = "INSERT INTO inreview_doctors SET `user_id`= '" . $user_id . "',`verify_user_id` = '" . $verify_user_id . "' ,`firstname` = '" . $firstname . "',`email_address` = '" . $email_address . "', `gender`= '" . $gender . "',`gender` = '" . $gender . "' ,`phone` = '" . $phone . "',`mobile` = '" . $mobile . "',`res_address`= '" . $res_address . "',`clinic_name` = '" . $clinic_name . "' ,`clinic_address` = '" . $clinic_address . "',`category_type_id` = '" . $category_type_id . "', `specialization`= '" . $specialization . "',`degree` = '" . $degree . "' ,`practicing_since` = '" . $practicing_since . "',`subarea_id` = '" . $subarea_id . "',`website`= '" . $website . "',`timings` = '" . $timings . "' ,`timings_residence` = '" . $timings_residence . "',`second_opinion` = '" . $second_opinion . "', `beds`= '" . $beds . "',`year_of_establishment` = '" . $year_of_establishment . "' ,`operation_hours` = '" . $operation_hours . "',`certification_photo` = '" . $photo . "',`media_claim_facility`= '" . $media_claim_facility . "',`contact_person` = '" . $contact_person . "' ,`other_details` = '" . $other_details . "'  `date` = '" . TODAY_DATE_TIME . "'";
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();
		$user     = new stdClass();
		$user->id = $dbCon->lastInsertId();
		if (!empty($user->id)) {
			$user_array = array(
				'success' => '1',
				'insert_id' => $user->id,
				'sql' => $sql
			);
		} else {
			$user_array = array(
				'success' => '0'
			);
		}
	
        $dbCon = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }

}



function getUserMap()
{
	
    try {
        $dbCon          = getConnection();
        
		$sql_query = "SELECT name,latitude,longitude FROM verify_users ";
		$stmt           = $dbCon->query($sql_query);
		$user_array  = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		if(!empty($user_array)){
			
           $user_array = array(
				'success' => '1',
				'user_array' => $user_array
			);
			
		}else{
		
           $user_array = array(
				'success' => '0'
			);
		}
		
        $dbCon          = null;
        echo json_encode($user_array);
        
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}

function getVerifyUsersDoctors($user_id,$status)
{
	
    try {
        $dbCon          = getConnection();
        
		$sql_query = "SELECT au.user_id,au.firstname,au.email_address,au.status FROM allotted_doctors AS ad INNER JOIN app_users AS au ON au.user_id =  ad.user_id WHERE ad.verify_user_id = '".$user_id."' AND au.status = '".$status."'";
		$stmt           = $dbCon->query($sql_query);
		$user_array  = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		if(!empty($user_array)){
			
           $user_array = array(
				'success' => '1',
				'user_array' => $user_array
			);
			
		}else{
		
           $user_array = array(
				'success' => '0'
			);
		}
		
        $dbCon          = null;
        echo json_encode($user_array);
        
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}



function verifyFilterUsersByCity($city_id)
{
	
    try {
        $dbCon          = getConnection();
        
		$sql_query = "SELECT subarea_id FROM subareas WHERE city_id = '".$city_id."'";
		$stmt           = $dbCon->query($sql_query);
		$subarea_array  = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		$subarea_ids = '';
		if(!empty($subarea_array)){
			foreach($subarea_array as $subarea_value){
				
				$subarea_ids .= $subarea_value->subarea_id.',';
				
			}
		}
		if(!empty($subarea_ids)){
			
			 $subarea_ids = rtrim($subarea_ids,',');
			 $subarea_ids = "'".str_replace(',',"','",$subarea_ids)."'";

			$sql_query = "SELECT id,name,phone_number,subarea_id FROM verify_users WHERE subarea_id IN (".$subarea_ids.") ORDER BY name";
			$stmt           = $dbCon->query($sql_query);
			$user_array       = $stmt->fetchAll(PDO::FETCH_OBJ);

           $user_array = array(
				'success' => '1',
				'user_array' => $user_array
			);
			
		}else{
		
           $user_array = array(
				'success' => '0'
			);
		}
		
        $dbCon          = null;
        echo json_encode($user_array);
        
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}

function verifyAllotLocation()
{
	global $app;
    $req = $app->request();

	$users = $req->params('users');
	$subarea = $req->params('subarea');
	$allot_no = $req->params('allot_no');
	
    try {
        $dbCon          = getConnection();

		$sql_query = "SELECT user_id FROM app_users WHERE subarea_id = '".$subarea."' AND status IN ('Unallotted','Unverified') LIMIT 0,".$allot_no;
		$stmt           = $dbCon->query($sql_query);
        $user_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		if(!empty($user_array)){

			foreach($user_array as $user_value){
				$sql  = "INSERT INTO allotted_doctors SET `subarea_id`= '" . $subarea . "',`user_id` = '" . $user_value->user_id . "' ,`verify_user_id` = '" . $users . "',`allotted_date` = '" . TODAY_DATE_TIME . "'";
				$stmt  = $dbCon->prepare($sql);
				$stmt->execute();
				$user     = new stdClass();
				$user->id = $dbCon->lastInsertId();

				$sql_update = "UPDATE app_users SET `status` = 'Allotted' WHERE `user_id` = '".$user_value->user_id."'";
				$stmt_update = $dbCon->prepare($sql_update);  
				$stmt_update->execute();

			}
		}
		
		if (!empty($user->id)) {
			$user_array = array(
				'success' => '1',
				'sql' => $sql
			);
		}else{
			$user_array = array(
				'success' => '0'
			);
		
		} 

 
       $dbCon          = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}

function verifyFilterClinics($subarea_id)
{
	
    try {
        $dbCon          = getConnection();
		$sql_query 		= "SELECT COUNT(user_id) AS unverified_clinic,(SELECT COUNT(user_id) AS verified_clinic FROM `app_users` WHERE status IN ('Verified') AND subarea_id = '".$subarea_id."') AS verified_clinic FROM `app_users` WHERE status IN ('Unallotted','Unverified') AND subarea_id = '".$subarea_id."'";
        $stmt           = $dbCon->query($sql_query);
        $clinics_array     = $stmt->fetchObject();
        $dbCon          = null;

        $clinics_array = array(
            'success' => '1',
            'clinics_array' => $clinics_array
        );
        echo json_encode($clinics_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}


function verifySearchUser()
{
	global $app;
    $req = $app->request();
	$user_ids = $req->params('user_ids');

	$user_ids = "'".str_replace(",","','",$user_ids)."'";
	
    $sql_query = "SELECT vu.id,vu.name,vu.phone_number,vu.subarea_id,s.subarea_name,vu.join_date,password FROM verify_users AS vu LEFT JOIN subareas AS s ON s.subarea_id = vu.subarea_id WHERE vu.id IN (".$user_ids.") ORDER BY vu.name";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $user_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $user_array = array(
            'success' => '1',
            'user_array' => $user_array
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}

function verifyDeleteUsers()
{
    global $app;
    $req = $app->request();
	$user_ids = $req->params('user_ids');
	$user_ids = "'".str_replace(',',"','",$user_ids)."'";

    $sql = "DELETE FROM verify_users WHERE `id` IN (".$user_ids.") ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $response = array(
            'success' => '1',
            'sql' => $sql,
            'user_ids' => $user_ids
        );
        $dbCon    = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
    

function verifyFilterUsers($subarea_id)
{
    $sql_query = "SELECT id,name,phone_number,subarea_id FROM verify_users WHERE subarea_id = '".$subarea_id."' ORDER BY name";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $user_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $user_array = array(
            'success' => '1',
            'user_array' => $user_array
        );
        echo json_encode($user_array	);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}


function verifyFilterSubarea($city_id)
{
    $sql_query = "SELECT * FROM subareas WHERE city_id = '".$city_id."' ORDER BY subarea_name";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $subarea_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $subarea_array = array(
            'success' => '1',
            'subarea_array' => $subarea_array
        );
        echo json_encode($subarea_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}


function verifyFilterCity($state_id)
{
    $sql_query = "SELECT * FROM cities WHERE state_id = '".$state_id."' ORDER BY city_name";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $city_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $city_array = array(
            'success' => '1',
            'city_array' => $city_array
        );
        echo json_encode($city_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}


function verifyStates()
{
    $sql_query = "SELECT * FROM states ORDER BY state_name";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $state_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $state_array = array(
            'success' => '1',
            'state_array' => $state_array
        );
        echo json_encode($state_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}



function verifySubareas()
{
    $sql_query = "SELECT * FROM subareas ORDER BY subarea_name";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $subarea_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $subarea_array = array(
            'success' => '1',
            'subarea_array' => $subarea_array
        );
        echo json_encode($subarea_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}


function verifyCity()
{
    $sql_query = "SELECT * FROM cities ORDER BY city_name";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $city_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $city_array = array(
            'success' => '1',
            'city_array' => $city_array
        );
        echo json_encode($city_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}

function verifyAddUser()
{
    global $app;
    $req           = $app->request();
    $name     = $req->params('name');
    $subarea_id  = $req->params('subarea_id');
    $password       = $req->params('password');
    $phone_number      = $req->params('phone_number');

        
        
    try {
        $dbCon = getConnection();
		$sql_query = "SELECT id FROM verify_users WHERE phone_number = '".trim($phone_number)."'";
		$stmt           = $dbCon->query($sql_query);
		$check_array  = $stmt->fetchObject();
		
		if(!empty($check_array)){

			$user_array = array(
				'success' => '0',
				'msg' => 'Sorry, this phone number already exists. Please use another phone number.'
			);
		
		}else{
		
			$sql  = "INSERT INTO verify_users SET `name`= '" . $name . "',`subarea_id` = '" . $subarea_id . "' ,`password` = '" . $password . "',`phone_number` = '" . $phone_number . "',`join_date` = '" . TODAY_DATE_TIME . "'";
			$stmt  = $dbCon->prepare($sql);
			$stmt->execute();
			$user     = new stdClass();
			$user->id = $dbCon->lastInsertId();
			if (!empty($user->id)) {
				$user_array = array(
					'success' => '1',
					'sql' => $sql
				);
			} else {
				$user_array = array(
					'success' => '0'
				);
			}
		}
        $dbCon = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}



function getLatlog($address) {

	$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response);
	$lat = $response_a->results[0]->geometry->location->lat;
	$long = $response_a->results[0]->geometry->location->lng;

	$result_new['latitude'] = $lat;
	$result_new['longitude'] = $long;
	
	return $result_new;
}



function getUnverifiedDoctors($user_id)
{
    $sql_query = "SELECT au.user_id,au.firstname,au.lastname,au.address FROM allotted_doctors AS ad LEFT JOIN app_users AS au ON au.user_id = ad.user_id  WHERE verify_user_id = '".$user_id."'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $doctors_array  = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        if(!empty($doctors_array)){
			foreach($doctors_array as $doctors_value){
				$lat_long_array = getLatlog(urlencode($doctors_value->address));
				
				if(is_null($lat_long_array['latitude'])){
					$doctors_value->latitude = '';
				}else{
					$doctors_value->latitude = $lat_long_array['latitude'];
				}
				if(is_null($lat_long_array['longitude'])){
					$doctors_value->longitude = '';
				}else{
					$doctors_value->longitude = $lat_long_array['longitude'];
				}
				
			}
		}
		

        $dbCon          = null;
        $doctors_array = array(
            'success' => '1',
            'doctors_array' => $doctors_array
        );
        echo json_encode($doctors_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}

function getVerifyUserInfo($user_id)
{
    $sql_user = "SELECT id,name,current_city,phone_number FROM verify_users WHERE id = '" . $user_id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->query($sql_user);
        $stmt->execute();
        $user_array = $stmt->fetchObject();
        $dbCon      = null;
        return $user_array;
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function verifyUserLogin(){

	global $app;
    $req = $app->request();
	
	$phone_number = $req->params('phone_number');
    $password = $req->params('password');
    $device_id = $req->params('device_id');
	$password = md5($password);

    $sql = "SELECT id FROM verify_users WHERE phone_number= '".$phone_number."'  AND password = '".$password."' AND status = '1'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->query($sql);
        $user = $stmt->fetchObject();
		  if(empty($user)){
		   $user_array = array('success' => '0');
		   echo json_encode($user_array);
		  }else{
			
			if(!empty($device_id)){

			   $sql_update = "UPDATE verify_users SET `device_id` = '".$device_id."' WHERE `id` = '".$user->id."'";
			   $stmt_update = $dbCon->prepare($sql_update);  
			   $stmt_update->execute();

			}

			$user_array = getVerifyUserInfo($user->id);
		
		   $user_array = array('success' => '1','user_array'=>$user_array);
		   echo json_encode($user_array);
		  }
        $dbCon = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}






function removeFollowerList()
{
    global $app;
    $req = $app->request();
    $user_id     = $req->params('user_id');
    $vendor_id   = $req->params('vendor_id');

    $sql = "DELETE FROM vendor_followers WHERE `vendor_id` = '" . $vendor_id . "' AND `user_id` = '" . $user_id . "'";
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


function deleteDocument($delete_id,$user_id)
{
    global $app;
    $req = $app->request();

    $sql = "SELECT filename FROM medical_documents WHERE `id` = '" . $delete_id . "' AND user_id = '".$user_id."'";
    try {
        $dbCon = getConnection();
		$stmt       = $dbCon->query($sql);
        $doc      = $stmt->fetchObject();
		unlink('../../' . UPLOAD_FOLDER . $doc->filename);
		
		$sql = "DELETE FROM medical_documents WHERE `id` = '" . $delete_id . "' AND user_id = '".$user_id."'";
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

function addReviewLike()
{
    global $app;
    $req           = $app->request();
    
    $user_id     = $req->params('user_id');
    $review_id   = $req->params('review_id');

    $sql = "SELECT id FROM user_review WHERE  FIND_IN_SET('".$user_id."',`review_likes`)  AND id = '".$review_id."'";

    try {
        $dbCon = getConnection();
		$stmt       = $dbCon->query($sql);
		$check_array  = $stmt->fetchObject();

		
		if(empty($check_array)){
			$sql = "UPDATE user_review SET `review_likes` =  CONCAT(`review_likes`, '".$user_id.",')  WHERE id  = '".$review_id."'";
			$stmt  = $dbCon->prepare($sql);
			$stmt->execute();

			$response = array(
				'success' => '1',
			);
		
		}else{
			$response = array(
				'success' => '0',
				'msq' => 'Already added'
			);
		
		}
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}



function removeReplyLike($id)
{
   
    global $app;
    $req           = $app->request();
    
    $user_id     = $req->params('user_id');
    $review_id   = $req->params('review_id');

    $sql = "SELECT reply_likes FROM review_reply  WHERE id  = '".$review_id."'";
    try {
        $dbCon = getConnection();
	
		$stmt               = $dbCon->query($sql);
		$reply_array       = $stmt->fetchObject();
	
		if(!empty($reply_array)){
		
			$reply_likes = str_replace($user_id.',','',$reply_array->reply_likes);
		}else{
		
			$reply_likes = $reply_array->reply_likes;
		}

		$sql = "UPDATE review_reply SET `reply_likes` =  '".$reply_likes."' WHERE id  = '".$review_id."'";

        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();	

		$response = array(
			'success' => '1'
		);
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
   
}



function addReplyLike()
{
    global $app;
    $req           = $app->request();
    
    $user_id     = $req->params('user_id');
    $reply_id   = $req->params('reply_id');

	$sql = $test = "SELECT id FROM review_reply WHERE  FIND_IN_SET('".$user_id."',`reply_likes`)  AND id = '".$reply_id."'";

    try {
        $dbCon = getConnection();
		$stmt       = $dbCon->query($sql);
		$check_array  = $stmt->fetchObject();

		
		if(empty($check_array)){
			$sql = "UPDATE review_reply SET `reply_likes` =  CONCAT(`reply_likes`, '".$user_id.",')  WHERE id  = '".$reply_id."'";
			$stmt  = $dbCon->prepare($sql);
			$stmt->execute();

			$response = array(
				'success' => '1'
			);
		
		}else{
			$response = array(
				'success' => '0',
				'msq' => 'Already added'
			);
		
		}
        $dbCon = null;
        echo json_encode($response);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function addReviewReply()
{
    global $app;
    $req           = $app->request();
    
    $user_id     = $req->params('user_id');
    $review_id   = $req->params('review_id');
    $reply_text  = $req->params('reply_text');

    $sql = "INSERT INTO review_reply SET `user_id`= '" . $user_id . "',`review_id` = '".$review_id."',`reply_text` = :reply_text,`time` = '".TODAY_DATE_TIME."' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->bindParam("reply_text", $reply_text);
        $stmt->execute();
        $reply     = new stdClass();
        $reply->id = $dbCon->lastInsertId();
        if (!empty($reply->id)){
            $response = array(
                'success' => '1',
            );
       }else
            $response = array(
                'success' => '0'
            );
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function addDocument()
{
    global $app;
    $req           = $app->request();
    
    $user_id     = $req->params('user_id');
    $filename 	 = $req->params('filename');

    $sql = "INSERT INTO medical_documents SET `user_id`= '" . $user_id . "',`filename` = '" . $filename . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $document     = new stdClass();
        $document->id = $dbCon->lastInsertId();
        if (!empty($document->id)){
        
			$sql_photo           		 = "SELECT *  FROM medical_documents WHERE user_id  = '".$user_id."'";
			$stmtn              		 = $dbCon->query($sql_photo);
			$docuements_array 			 = $stmtn->fetchAll(PDO::FETCH_OBJ);
		   
		   if(empty($docuements_array))
				$users->docuements_array = array();
			else
				$users->docuements_array = $docuements_array;

            $response = array(
                'success' => '1',
                'docuements_array' => $docuements_array
                
            );
       }else
            $response = array(
                'success' => '0'
            );
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

 
function addFollowerList()
{
    global $app;
    $req           = $app->request();
    
    $user_id     = $req->params('user_id');
    $vendor_id = $req->params('vendor_id');

    try {
        $dbCon = getConnection();

		$sql  = "SELECT id FROM vendor_followers WHERE `user_id`= '" . $user_id . "' AND `vendor_id` = '" . $vendor_id . "'";
		$stmtn  = $dbCon->query($sql);
		$check_array = $stmtn->fetchObject();
		if(empty($check_array)){

			$sql  = "INSERT INTO vendor_followers SET `user_id`= '" . $user_id . "',`vendor_id` = '" . $vendor_id . "' ";
			$stmt  = $dbCon->prepare($sql);
			$stmt->execute();
			$category     = new stdClass();
			$category->id = $dbCon->lastInsertId();
			if (!empty($category->id))
				$response = array(
					'success' => '1'
				);
			else
				$response = array(
					'success' => '0'
				);
		}else{
				$response = array(
					'success' => '0',
					'msg' => 'You have already followed this vendor'
					
				);
		
		}
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}




function webForgotPassword($email_address)
{
    $sql           = "SELECT user_id,email_address FROM app_users WHERE email_address = '" . $email_address . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetchObject();
        if ($user == false) {
            $user_array = array(
                'success' => '0',
				); 
            echo json_encode($user_array);
        } else {
            $code       = mt_rand();
            $message    = "Please use the following link to reset your password: ".IMG_URL."reset-password.php?email=$email_address&code=$code";
            $uri        = 'https://mandrillapp.com/api/1.0/messages/send.json';
            $postString = '{

			"key": "Y5yTxcexpL4pq6wmSpGEHQ",

			"message": {

				"html": "' . $message . '",

				"text": "",

				"subject": "Forgot Password",

				"from_email": "info@curecity.com",

				"from_name": "Curecity",

				"to": [

					{

						"email": "' . $email_address . '",

						"name": ""

					}

				],

				"headers": {

				},

				"track_opens": true,

				"track_clicks": true,

				"auto_text": true,

				"url_strip_qs": true,

				"preserve_recipients": true,		

				"merge": true,

				"global_merge_vars": [

				],

				"merge_vars": [

				],

				"tags": [

				],

				"google_analytics_domains": [

				],

				"google_analytics_campaign": "...",

				"metadata": [

				],

				"recipient_metadata": [		

				],

				"attachments": [			

				]

			},

			"async": false

			}';
            $ch         = curl_init();
            curl_setopt($ch, CURLOPT_URL, $uri);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
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
                echo json_encode($user_array);
            }
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


function resetPassword(){
	
    global $app;
    $req  = $app->request();
    $email_address = $req->params('email_address');
    $forgot_code = $req->params('code');
    $password = $req->params('password');


    try {
        $dbCon       = getConnection();
		$sql = "SELECT user_id FROM app_users WHERE email_address = '".$email_address."' AND forgot_code = '".$forgot_code."'";
        $stmt = $dbCon->prepare($sql);  
        $stmt->execute();
        $user = $stmt->fetchObject();  
			
		if($user == false){
			$user_array = array('success' => '0','user'=>$sql);
			echo json_encode($user_array);
		}else{
 		
			$sql  = "UPDATE app_users SET password ='" . md5($password) . "',forgot_code = '' WHERE email_address='" . $email_address . "'";
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


function getWishlist($user_id) {


    $sql             = "SELECT favourite FROM app_users WHERE user_id = '" . $user_id . "'";

    try {
        $dbCon = getConnection();
		$stmt   = $dbCon->query($sql);
		$user_array  = $stmt->fetchObject();
	
		$favourite = unserialize($user_array->favourite);	
			
			
		if(!empty($favourite)){
			
			$user_id_array = implode("','",$favourite);
			$sql             = "SELECT slug_name,firstname FROM app_users WHERE user_id IN ('" . $user_id_array . "')";
			$stmt   = $dbCon->query($sql);
			$favourite_array  = $stmt->fetchAll(PDO::FETCH_OBJ);


			$favourite_array = array(
				'success' => '1',
				'favourite_array' => $favourite_array,
			);
		
		}else{
		
			$favourite_array = array(
				'success' => '0',
			);
		
		}
		
        echo json_encode($favourite_array); 

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}





function removeFavourite($vendor_id,$user_id)
{

    try {
        $dbCon = getConnection();

		$sql             = "SELECT favourite FROM app_users WHERE user_id = '" . $user_id . "'";
		$stmt   = $dbCon->query($sql);
		$user_array  = $stmt->fetchObject();
	
		if(!empty($user_array)){
		
			$favourite = unserialize($user_array->favourite);	
			unset($favourite[array_search($vendor_id,$favourite)]);
			$favourite = serialize($favourite);

			$sql             = "UPDATE app_users SET `favourite`= '" . $favourite . "' WHERE user_id = '" . $user_id . "'";
			$stmt  = $dbCon->prepare($sql);
			$stmt->execute();


		}

        $user_array = array(
            'success' => '1',
        );

        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function editFavourite($vendor_id,$user_id)
{

    try {
        $dbCon = getConnection();

		$sql             = "SELECT favourite FROM app_users WHERE user_id = '" . $user_id . "'";
		$stmt   = $dbCon->query($sql);
		$user_array  = $stmt->fetchObject();
	
		if(!empty($user_array)){
		
			$favourite = unserialize($user_array->favourite);	
			$favourite[] =  $vendor_id;
			$favourite = serialize($favourite);	

		}else{

			$favourite = serialize(array($vendor_id));	
		
		}
		$sql             = "UPDATE app_users SET `favourite`= '" . $favourite . "' WHERE user_id = '" . $user_id . "'";
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();

		//$vendor_array = array('12','12');
		//$vendor_array = serialize($vendor_array);

		//print_r(unserialize($vendor_array));
		//die;


        $user_array = array(
            'success' => '1',
            'user_array' => $user_array
        );
		//$sql             = "UPDATE user_review SET `comment`= '" . $review_comments . "' WHERE id = '" . $review_comment_id . "'";


        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

/* api for front end user start here */

function getSearch(){

    global $app;
    $req = $app->request(); 

	// filter option's value
	
    $second_opinion = $req->params('second_opinion'); 
    $frequent_search = $req->params('frequent_search'); 
    $search_key = $req->params('search_key'); 
    $search_key = trim($search_key);
    $category = $req->params('category'); 
    $category = trim($category);
	$search_subareas = $req->params('search_subareas'); 
	$search_locations = $req->params('search_locations'); 
    $search_speciality = $req->params('search_speciality'); 
    $search_experience = $req->params('search_experience'); 
    $search_gender = $req->params('search_gender'); 
    $search_rating = $req->params('search_rating'); 
    $page_position = $req->params('page_position'); 
    $item_per_page = $req->params('item_per_page'); 
    $sort = $req->params('sort'); 
    $order = $req->params('order'); 

	if ($category == 'Doctor') {
		
		$where_condition = "AND category_type_id = '".DOCTOR_ID."'";
		
	}else if($category == 'Clinic') {

		$where_condition = "AND category_type_id = '".CLINIC_HOSPITAL_ID."' ";
	
	}else if ($category == 'Health') {

		$where_condition = "AND category_type_id = '".HEALTH_SERVICES_ID."' ";
	
	}else if ($category == 'Education') {

		$where_condition = "AND category_type_id = '".EDU_CENTER_ID."' ";
	
	}
	if(!empty($search_key)){
	
		$where_condition .= " AND firstname LIKE '%".$search_key."%' OR lastname LIKE '%".$search_key."%'";
	
	}
	if(!empty($second_opinion)){
	
		$where_condition .= " AND second_opinion = '1' ";
	
	}


    try {
        $dbCon = getConnection();
		$category_type = $search_category_type = '';
		
		/* code for frequent search start here */
			if(!empty($frequent_search)){

	 			$sql_query = "SELECT * FROM frequent_keywords WHERE display_text LIKE  '%".$frequent_search."%' ";
				$stmt   = $dbCon->query($sql_query);
				$frequent_search_array  = $stmt->fetchObject();
				if(!empty($frequent_search_array)){
						
						$keywords_array = explode(',',$frequent_search_array->keywords);
						// if keyword in global
						$where_condition .= " AND "; 
						$len = count($keywords_array);
						$j = 0;	
						foreach($keywords_array as $keywords_value){

							if ($j == $len - 1) {
								$where_condition .= " FIND_IN_SET('".trim($keywords_value)."',au.keywords) "; 
							}else{
								$where_condition .= " FIND_IN_SET('".trim($keywords_value)."',au.keywords) OR"; 
							}
						
						$j++;
						}

						// else if keyword not in global
						if(!empty($frequent_search_array->is_global)){
							
						}else{
								 
								$category_type_id_string = str_replace(',',"','",$frequent_search_array->category_type_ids);
								$where_condition .= "AND category_type_id IN ('".$category_type_id_string."')"; 
						
						}
						
						// else if keyword not in global
						if(!empty($frequent_search_array->category_ids)){
								 
								 	
								$category_id_string = str_replace(',',"','",$frequent_search_array->category_ids);
								$where_condition .= " OR category_id IN ('".$category_id_string."')"; 
						
						}
						
					
				}

			}
		/* code for frequent search end here */

		/* code for where condition start here */
			if(!empty($search_locations)){
				
				$search_locations_array = explode(",",$search_locations);
				$search_locations = "'".implode("','",$search_locations_array)."'";

				
	 			$sql_query = "SELECT GROUP_CONCAT(id) AS current_location_id FROM location WHERE location_name IN (".$search_locations.") ";
				$stmt   = $dbCon->query($sql_query);
				$location_array  = $stmt->fetchObject();
				$current_location_id = "'".str_replace(',',"','",$location_array->current_location_id)."'";
	
				//if(!empty($where_condition))
				//	$where_condition .= " OR current_location_id IN (".$current_location_id.")";
				//else
					$where_condition .= " AND current_location_id IN (".$current_location_id.")";
				
			}
			
			if(!empty($search_subareas)){
				
				$search_subareas_array = explode(",",$search_subareas);
				$search_subareas = "'".implode("','",$search_subareas_array)."'";

	 			$sql_query = "SELECT GROUP_CONCAT(id) AS subarea_id FROM subarea WHERE subarea_name IN (".$search_subareas.") ";
				$stmt   = $dbCon->query($sql_query);
				$subarea_array  = $stmt->fetchObject();
				$current_subarea_id = "'".str_replace(',',"','",$subarea_array->subarea_id)."'";
	
				//if(!empty($where_condition))
				//	$where_condition .= " OR current_location_id IN (".$current_location_id.")";
				//else
					$where_condition .= " AND subarea_id IN (".$current_subarea_id.")";
				
			}
			

			if(!empty($search_speciality)){
			
				$search_speciality_array = explode(",",$search_speciality);
				$search_speciality = "'".implode("','",$search_speciality_array)."'";

				$sql_query = "SELECT GROUP_CONCAT(id) AS category_id FROM category WHERE category_name IN (".$search_speciality.") ";
				$stmt   = $dbCon->query($sql_query);
				$category_array  = $stmt->fetchObject();
				$category_id = "'".str_replace(',',"','",$category_array->category_id)."'";

				//if(!empty($where_condition))
				//	$where_condition .= " OR category_id IN (".$category_id.")";
				//else
					$where_condition .= " AND category_id IN (".$category_id.")";
			}
			
			if(!empty($search_experience)){
		
				$exp_search_range = explode(',',urldecode($search_experience));
				$filter_min_exp = (int)$exp_search_range[0];
				$filter_max_exp = (int)$exp_search_range[1];
				
				if(!empty($filter_min_exp) && !empty($filter_max_exp)){					
					$filter_max_exp	 = date('Y',strtotime(TODAY_DATE)) - $filter_max_exp;
					$filter_min_exp	 = date('Y',strtotime(TODAY_DATE)) - $filter_min_exp;
	
					//if(!empty($where_condition))
					//	$where_condition .= " OR practicing_since BETWEEN ".$filter_max_exp." AND ".$filter_min_exp." ";
					//else
						$where_condition .= " AND practicing_since BETWEEN ".$filter_max_exp." AND ".$filter_min_exp." ";
				}
			}				

			if(!empty($search_gender)){

				//if(!empty($where_condition))
				//	$where_condition .= " OR gender = '".$search_gender."'";
				//else
					$where_condition .= " AND gender = '".$search_gender."'";
				
			}				


		if(!empty($search_rating))
			$search_rating = explode(',',$search_rating);

			
		/* code for where condition end here */

			$sql_query = $sql_search =  "SELECT au.user_id,au.role,au.firstname,au.lastname,au.slug_name,au.category_id,c.category_name,au.profile_photo,au.degree,au.practicing_since,au.current_location_id,au.subarea_id,au.timing_weeks,au.timing_clinic,au.timing_residence,au.category_type_id,l.location_name,s.subarea_name FROM app_users AS au LEFT JOIN location AS l ON l.id = au.current_location_id LEFT JOIN subarea AS s ON s.id = au.subarea_id LEFT JOIN category AS c ON c.id = au.category_id WHERE au.status = '1' AND role = 'Vendor' ".$where_condition;

			if(!empty($sort) && !empty($order)){
				if($sort == 'name'){
					$sort_by = 'au.firstname';
				
					$sql_query	  .= " ORDER BY ".$sort_by." ".$order;
				}
			}else{
			
					$sql_query	  .= " ORDER BY user_id ASC ";
			}
			
			if(isset($page_position) && isset($item_per_page))
				$sql_query	  .= " LIMIT ".$page_position.", ".$item_per_page;

			$sql_search = $sql_query;
			//echo $sql_query;
			//die;		
			$stmt   = $dbCon->query($sql_query);
			$user_array  = $stmt->fetchAll(PDO::FETCH_OBJ);
			
			$rating_value_array = array();
			$establishment = array();


			
			// check if vendor array empty
			if(!empty($user_array)){
		
				$subarea_array = $array_unset_keys =  array();		
				$speciality_array = $speciality_array_new = array();		
				// vendor array loop
				$k = 0;
				foreach($user_array as $user_value){

					$sql_query = "SELECT AVG(ur.ratings) AS rating FROM user_review AS u LEFT JOIN user_ratings  AS ur ON ur.vendor_id = u.vendor_id WHERE u.vendor_id = '".$user_value->user_id."'";
					$stmt   = $dbCon->query($sql_query);
					$rating_array  = $stmt->fetchObject();
				
				
					if(!empty($rating_array)){
					
						if(!empty($rating_array->rating))
							$user_value->rating = $rating_array->rating;
						else
							$user_value->rating = 0;
						
					}else{

						$user_value->rating = 0;
					 
					}	
					

					/* code for check user rating start here */
					if(is_array($search_rating)){
							
						foreach($search_rating as $rating_filter_value){
							
							if(floor($user_value->rating) >= $rating_filter_value){
								$is_visible = true;
							}else{
								//$user_result_check[] = 	floor($user_value->rating);
								$is_visible = false;
								$array_unset_keys[] = 	$k;
							}
						}	
					
					}
					/* code for check user rating end here */

			
					 
					// check if vendor id doctor
					if($user_value->category_type_id != DOCTOR_ID){
				
							$sql_query = " SELECT image FROM user_images  WHERE user_id =  ".$user_value->user_id." ORDER BY id ASC LIMIT 1 ";
							$stmt   = $dbCon->query($sql_query);
							$user_image_array  = $stmt->fetchObject();
						
							if(!empty($user_image_array)){
						
								$user_value->profile_photo = $user_image_array->image;
							}

					}

					if(empty($user_value->profile_photo))
						$user_value->profile_photo = IMG_URL."images/img.jpg";
					else
						$user_value->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$user_value->profile_photo."&w=96&h=96&zc=0";

						
					
					$establishment['rating'] = (int)$rating_array->rating;
					$rating_value_array = array_map('json_encode', $rating_value_array);
					$rating_value_array = array_unique($rating_value_array);
					$rating_value_array = array_map('json_decode', $rating_value_array);
					array_push($rating_value_array, $establishment);

							
					$experience_array[]  = $user_value->practicing_since;
				
				
					$speciality_name_value['id'] = $user_value->category_id;
					$speciality_name_value['category_name'] = $user_value->category_name;
					
					// for Speciality filter
					array_push($speciality_array_new, $speciality_name_value);
				
				
					$speciality_array_new = array_map('json_encode', $speciality_array_new);
					$speciality_array_new = array_unique($speciality_array_new);
					$speciality_array_new = array_map('json_decode', $speciality_array_new);
	 
	 
					// for subarea's value	
					if(!empty($user_value->subarea_name)){
						$subarea_name_value['subarea_name'] = $user_value->subarea_name;
						//if(!in_array($user_value->subarea_name,$subarea_array)
						array_push($subarea_array, $subarea_name_value);
					}
			
					$k++;
				}	
				
				/* code for unset user array for rating start here */
				/*
				if(!empty($array_unset_keys)){
					
						foreach($array_unset_keys as $key_value){
								 
								unset($user_array[$key_value]);
						
						}
					
				} */  
				/* code for unset user array for rating end here */
				
				/* code for user array sorting by rating ASC/DESC  start here */
				
				if(!empty($sort) && !empty($order)){
						if($sort == 'rating' &&  $order == 'ASC'){
							function compare_some_objects($a, $b) { 
								return $a->rating - $b->rating;
							}

							usort($user_array, 'compare_some_objects');
						
						}else if($sort == 'rating' &&  $order == 'DESC'){
						
							function compare_some_objects($a, $b) { 
								return $b->rating - $a->rating;
							}

							usort($user_array, 'compare_some_objects');
						
						}
				}
				 
				/* code for user array sorting by rating ASC/DESC  end here */
						
			
				//$rating_value_array = asort($rating_value_array);
				
				$subarea_array = array_map('json_encode', $subarea_array);
				$subarea_array = array_unique($subarea_array);
				$subarea_array = array_map('json_decode', $subarea_array);

				$speciality_array_new = array_map('json_encode', $speciality_array_new);
				$speciality_array_new = array_unique($speciality_array_new);
				$speciality_array_new = array_map('json_decode', $speciality_array_new);
 

				// for experience filter
				$experience_array = array_unique($experience_array);
				$experience_max = max($experience_array);
				$experience_min = min($experience_array);
				
				$d1 = new DateTime($experience_max.'-01-01');
				$d2 = new DateTime(date('Y-m-d'));
				$experience_max = $d2->diff($d1);


				$d1 = new DateTime($experience_min.'-01-01');
				$d2 = new DateTime(date('Y-m-d'));
				$experience_min = $d2->diff($d1);

				$experience_filter['min_exp'] = $experience_max->y;
				$experience_filter['max_exp'] = $experience_min->y;
				
				//unset($user_array[2]);
				//print_r($speciality_array_new);
				//die;
							
						
				$user_array = array('success' => '1','user_array'=>$user_array,'speciality_array'=>$speciality_array_new,'experience_filter'=>$experience_filter,'rating_filter'=>$rating_value_array,'subarea_array'=>$subarea_array,'sql_search'=>$sql_search);
			
			}else{
		
				$user_array = array('success' => '0','msg'=>"No record found!",'sql_search'=>$sql_search);
			
			}

		$dbCon = null;
		
		echo json_encode($user_array);
	
	}
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
		echo '{"success": ' . json_encode('0') . '}';
    }    

}


function getGlobalSearch($search_key)
{
    $establishment = $response = array();
    $sql_query     = "SELECT ct.name,ct.id,au.user_id,au.role FROM app_users AS au INNER JOIN category_type AS ct ON ct.id = au.category_type_id WHERE au.status = '1' AND au.role = 'Vendor' AND
					 au.firstname LIKE '%" . $search_key . "%' OR 
					 au.lastname LIKE '%" . $search_key . "%' OR 
					 au.keywords LIKE '%" . $search_key . "%'
					 GROUP BY ct.id
				";
    try {
        $dbCon        = getConnection();
        $stmt         = $dbCon->query($sql_query);
        $search_array = $stmt->fetchAll(PDO::FETCH_OBJ);
        // for case 1	
        if (!empty($search_array)) {
            foreach ($search_array as $search_value) {
                $establishment['id']               = $search_value->user_id;
                $establishment['name']             = $search_key . " in " . $search_value->name;
                $establishment['is_category_type'] = $search_value->id;
                $establishment['is_profile']       = '0';
                if($search_value->role == 'Vendor')
					array_push($response, $establishment);
            }
            if (!empty($response)) {
                // for case 2	
                $sql_query    = "SELECT user_id,firstname,lastname,slug_name,role FROM app_users AS au WHERE au.status = '1' AND au.role = 'Vendor' AND
							 au.firstname LIKE '%" . $search_key . "%' OR 
							 au.lastname LIKE '%" . $search_key . "%' OR 
							 au.keywords LIKE '%" . $search_key . "%'
						";
                $stmt         = $dbCon->query($sql_query);
                $search_array = $stmt->fetchAll(PDO::FETCH_OBJ);
                if (!empty($search_array)) {
                    foreach ($search_array as $search_value) {
                        if (!empty($search_value->firstname) && !empty($search_value->lastname)) {
                            $establishment['name'] = $search_value->firstname . " " . $search_value->lastname;
                        } else {
                            $establishment['name'] = $search_value->firstname;
                        }
                        $establishment['is_category_type'] = '0';
                        $establishment['is_profile']       = $search_value->slug_name;
						if($search_value->role == 'Vendor')
							array_push($response, $establishment);
                    }
                }
            }
        } else {
            // for case 2	
            $sql_query  = $query_2  = "SELECT user_id,firstname,lastname,role FROM app_users AS au WHERE au.status = '1' AND au.role = 'Vendor' AND
						 au.firstname LIKE '%" . $search_key . "%' OR 
						 au.lastname LIKE '%" . $search_key . "%' OR 
						 au.keywords LIKE '%" . $search_key . "%'
					";
            $stmt         = $dbCon->query($sql_query);
            $search_array = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (!empty($search_array)) {
                foreach ($search_array as $search_value) {
                    if (!empty($search_value->firstname) && !empty($search_value->lastname)) {
                        $establishment['name'] = $search_value->firstname . " " . $search_value->lastname;
                    } else {
                        $establishment['name'] = $search_value->firstname;
                    }
                    $establishment['is_category_type'] = '0';
                    $establishment['is_profile']       = $search_value->user_id;
					if($search_value->role == 'Vendor')
						array_push($response, $establishment);
                }
            }
        }
        $dbCon = null;
        if (!empty($search_array)) {
            $search_array = array(
                'success' => '1',
                'search_result_array' => $response,
                'sql' => $query_2
            );
        } else {
            $search_array = array(
                'success' => '0'
            );
        }
        echo json_encode($search_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}

function getCategoryTypeAll()
{
    $sql_query = "SELECT * FROM category_type ";
    try {
        $dbCon             = getConnection();
        $stmt              = $dbCon->query($sql_query);
        $category          = $stmt->fetchAll(PDO::FETCH_OBJ);
        // for Frequent Keyword
        $sql_query         = "SELECT * FROM frequent_keywords ORDER BY id DESC ";
        $stmt              = $dbCon->query($sql_query);
        $frequent_keywords = $stmt->fetchAll(PDO::FETCH_OBJ);
       
		/*$frequent_extra_key    	   = (object) array(
						"id" => '0',
						"display_text" => '-Select-', 
						"is_global" => '',  
						"category_ids" => '', 
						"category_type_ids" => '', 
						"keywords" => ''
						
					);
		array_unshift($frequent_keywords, $frequent_extra_key); */
	
        
        // for Second opinion
        $sql_query         = "SELECT * FROM app_users WHERE second_opinion = '1' ";
        $stmt              = $dbCon->query($sql_query);
        $second_opinion    = $stmt->fetchAll(PDO::FETCH_OBJ);

        $name_array        = array();
        if (!empty($second_opinion)) {
            foreach ($second_opinion as $second_opinion_value) {
                $location_array[]          = $second_opinion_value->current_location_id;
                $speciality_array[]        = $second_opinion_value->category_id;
                $username_array['user_id'] = $second_opinion_value->user_id;
                if (!empty($second_opinion_value->firstname) && !empty($second_opinion_value->lastname)) {
                    $username_array['firstname'] = $second_opinion_value->firstname . " " . $second_opinion_value->lastname;
                } else {
                    $username_array['firstname'] = $second_opinion_value->firstname;
                }
                array_push($name_array, $username_array);
            }
            if (!empty($location_array)) {
                $locations      = "'" . implode("','", $location_array) . "'";
                $sql_query      = "SELECT id,location_name FROM location WHERE id IN (" . $locations . ")";
                $stmt           = $dbCon->query($sql_query);
                $location_array = $stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                $location_array = array();
            }
            if (!empty($speciality_array)) {
                $speciality       = "'" . implode("','", $speciality_array) . "'";
                $sql_query        = "SELECT id,category_name FROM category WHERE id IN (" . $speciality . ")";
                $stmt             = $dbCon->query($sql_query);
                $speciality_array = $stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                $speciality_array = array();
            }

			$location_extra_key    	   = (object) array(
							"id" => '0',
							"location_name" => '-Select-', 
							
						);
			array_unshift($location_array, $location_extra_key); 


			$speciality_extra_key    	   = (object) array(
							"id" => '0',
							"category_name" => '-Select-', 
							 
						);
			array_unshift($speciality_array, $speciality_extra_key); 

			$name_extra_key    	   = (object) array(
							"user_id" => '0',
							"firstname" => '-Select-', 
							
						);
			array_unshift($name_array, $name_extra_key); 

            $second_opinion_array['location']   = $location_array;
            $second_opinion_array['speciality'] = $speciality_array;
            $second_opinion_array['name']       = $name_array;
 


        } else {
            $second_opinion_array['location']   = array();
            $second_opinion_array['speciality'] = array();
            $second_opinion_array['name']       = array();
        }
        if (!empty($category)) {
            $i = 0;
            foreach ($category as $category_value) {
                // for exp, location, speciality  
                // for location
				 
                $sql_query                 = "SELECT id,location_name FROM app_users AS au INNER JOIN location AS l ON l.id = au.current_location_id WHERE au.status = '1' AND au.category_type_id = '" . $category_value->id . "' AND l.status = '1' GROUP BY id";
                $stmt                      = $dbCon->query($sql_query);
                $location_array            = $stmt->fetchAll(PDO::FETCH_OBJ);
                $location_extra_key    	   = (object) array(
												"id" => '0',
												"location_name" => '-Select-',
											);
				 array_unshift($location_array, $location_extra_key); 
                 
                // for speciality
                $sql_query                 = "SELECT id,category_name FROM app_users AS au INNER JOIN category AS c ON c.id = au.category_id WHERE au.status = '1' AND au.category_type_id = '" . $category_value->id . "' GROUP BY id ";
                $stmt                      = $dbCon->query($sql_query);
                $speciality_array          = $stmt->fetchAll(PDO::FETCH_OBJ);
                $speciality_extra_key    	   = (object) array(
												"id" => '0',
												"category_name" => '-Select-',
											);
				 array_unshift($speciality_array, $speciality_extra_key); 
                // for name
                $sql_query                 = "SELECT user_id,firstname FROM app_users WHERE status = '1' AND category_type_id = '" . $category_value->id . "'";
                $stmt                      = $dbCon->query($sql_query);
                $name_array                = $stmt->fetchAll(PDO::FETCH_OBJ);
                $name_extra_key    	   = (object) array(
												"user_id" => '0',
												"firstname" => '-Select-', 
											);
				 array_unshift($name_array, $name_extra_key); 

                // for exp
                $sql_query                 = "SELECT MAX(practicing_since) AS exp_max ,MIN(practicing_since) AS exp_min FROM app_users WHERE status = '1' AND category_type_id = '" . $category_value->id . "' ";
                $stmt                      = $dbCon->query($sql_query);
                $experience_array          = $stmt->fetchObject();
                $temp_max                  = $experience_array->exp_max;
                $temp_min                  = $experience_array->exp_min;
                $experience_array->exp_min = date('Y', strtotime(TODAY_DATE)) - $temp_max;
                $experience_array->exp_max = date('Y', strtotime(TODAY_DATE)) - $temp_min;
                if ($category_value->id == DOCTOR_ID) {
                    $doctor_category_array['location']   = $location_array;
                    $doctor_category_array['speciality'] = $speciality_array;
                    $doctor_category_array['name']       = $name_array;
                    $doctor_category_array['experience'] = $experience_array;
                }
                if ($category_value->id == CLINIC_HOSPITAL_ID) {
                    $clinic_category_array['location']   = $location_array;
                    $clinic_category_array['speciality'] = $speciality_array;
                    $clinic_category_array['name']       = $name_array;
                    $clinic_category_array['experience'] = $experience_array;
                }
                if ($category_value->id == HEALTH_SERVICES_ID) {
                    $health_category_array['location']   = $location_array;
                    $health_category_array['speciality'] = $speciality_array;
                    $health_category_array['name']       = $name_array;
                    $health_category_array['experience'] = $experience_array;
                }
                if ($category_value->id == EDU_CENTER_ID) {
                    $education_category_array['location']   = $location_array;
                    $education_category_array['speciality'] = $speciality_array;
                    $education_category_array['name']       = $name_array;
                    $education_category_array['experience'] = $experience_array;
                }
                $i++;
            }
            $dbCon          = null;
          


            $category_array = array(
                'success' => '1',
                'doctor_category_array' => $doctor_category_array,
                'clinic_category_array' => $clinic_category_array,
                'health_category_array' => $health_category_array,
                'education_category_array' => $education_category_array,
                'frequent_keywords' => $frequent_keywords,
                'second_opinion_array' => $second_opinion_array
            );
            echo json_encode($category_array);
        } else if (!empty($frequent_keywords)) {
            $category_array = array(
                'success' => '1',
                'frequent_keywords' => $frequent_keywords
            );
            echo json_encode($category_array);
        } else {
            $dbCon          = null;
            $category_array = array(
                'success' => '0'
            );
            echo json_encode($category_array);
        }
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}



function ConsumerCheck($email_id)
{
    global $app;
    $req           = $app->request();
    $email_address = $req->params('vendor_email');
    $password      = $req->params('password');
    $sql           = "SELECT * FROM app_users WHERE email_address= '" . $email_id . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetchObject();
        if (empty($user)) {
            $user_array = array(
                'success' => '0',	
                'msg' => 'Your email id is not registered with us'
            );
            echo json_encode($user_array);
        } else {
            $user_array = array(
                 'success' => '1',
                'msg' => 'Sorry, this email address already exists. Please use another email address.'
            );
            echo json_encode($user_array);
        }
        $dbCon = null;
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function addFrontUser()
{
    global $app;
    $req           = $app->request();
    $firstname     = $req->params('firstname');
    $lastname      = $req->params('lastname');
    $email_address = $req->params('email_address');
    $password      = $req->params('password');
    $social_id     = $req->params('social_id');
    /*$join_date = $req->params('join_date');
    $modified_date = $req->params('modified_date');*/
    $role          = $req->params('role');
    $category_id   = $req->params('category_id');
    $login_type    = $req->params('login_type');
    $device_id     = $req->params('device_id');
    $device_type   = $req->params('device_type');
    $mobile   	   = $req->params('mobile');
	$password = md5($password);
    try {
        $dbCon      = getConnection();
        
        
        if(!empty($social_id)){
			
			
			$sql_check = "SELECT user_id FROM app_users WHERE email_address='".$email_address."'";
			$stmt_check = $dbCon->prepare($sql_check);  
	        $stmt_check->execute();
			$user_check = $stmt_check->fetchAll(PDO::FETCH_OBJ);
			
			// code for if user email id is already exists
			if(!empty($user_check)){
				
				$user_array = getUserInfo($user_check[0]->user_id);
				$response   = array(
					'success' => '1',
					'user_array' => $user_array
				);
					echo json_encode($response); 
					
			}else{

				$sql  = "INSERT INTO app_users SET `mobile` = '".$mobile."',`firstname` = '" . $firstname . "',`lastname` = '" . $lastname . "', `email_address`= '" . $email_address . "', `password`= '" . $password . "', `social_id`= '" . $social_id . "',`join_date` = '" . TODAY_DATE_TIME . "',`modified_date` = '" . TODAY_DATE_TIME . "',`role`= '" . $role . "',`category_id`= '" . $category_id . "',`login_type` = '" . $login_type . "',`device_type` = '" . $device_type . "',`device_id` = '" . $device_id . "',`status` = '1' ";
				$stmt = $dbCon->prepare($sql);  
				$stmt->execute();
				$user = new stdClass();
				$user->id = $dbCon->lastInsertId();
				$user_array = getUserInfo($user->id);

				$response = array('success' => '1','user_array'=>$user_array);


				$dbCon = null;
				echo json_encode($response); 
			}
		// code for check user not login with social web 
		}else{
			// code for check email address is exists or not 
			$sql_check  = "SELECT user_id FROM app_users WHERE email_address = '" . $email_address . "'";
			$stmt_check = $dbCon->prepare($sql_check);
			$stmt_check->execute();
			$user_check = $stmt_check->fetchAll(PDO::FETCH_OBJ);
			// code for if user email id OR phone is already exists
			if (!empty($user_check)) {
				$dbCon      = null;
				$user_array = array(
					'success' => '0',
					'msg' => 'Sorry, this email address already exists. Please use another email address.'
				);
				echo json_encode($user_array);
				exit;
			} else {
				$sql  = "INSERT INTO app_users SET `mobile` = '".$mobile."',`firstname` = '" . $firstname . "',`lastname` = '" . $lastname . "', `email_address`= '" . $email_address . "', `password`= '" . $password . "', `social_id`= '" . $social_id . "',`join_date` = '" . TODAY_DATE_TIME . "',`modified_date` = '" . TODAY_DATE_TIME . "',`role`= '" . $role . "',`category_id`= '" . $category_id . "',`login_type` = '" . $login_type . "',`device_type` = '" . $device_type . "',`device_id` = '" . $device_id . "',`status` = '1' ";
				$stmt = $dbCon->prepare($sql);
				$stmt->execute();
				$user       = new stdClass();
				$user->id   = $dbCon->lastInsertId();
				$user_array = getUserInfo($user->id);
				$response   = array(
					'success' => '1',
					'user_array' => $user_array
				);
				$dbCon      = null;
				echo json_encode($response);
			}
		}

    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function getUserInfoBySlug($slug_name)
{
    $sql_user = "SELECT user_id,firstname,lastname,email_address,role,category_id FROM app_users WHERE slug_name='" . $slug_name . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->query($sql_user);
        $stmt->execute();
        $user_array = $stmt->fetchObject();
        $dbCon      = null;
        return $user_array; 
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function getUserInfo($user_id)
{
    $sql_user = "SELECT user_id,firstname,lastname,email_address,device_id,join_date,social_id,login_type,device_type,status,role,category_id,category_type_id,profile_photo FROM app_users WHERE user_id='" . $user_id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->query($sql_user);
        $stmt->execute();
        $user_array = $stmt->fetchObject();
        
        if(!empty($user_array)){
			if(!empty($user_array->profile_photo))
				$user_array->profile_photo = IMG_URL.'uploads/'.$user_array->profile_photo;
			else
				$user_array->profile_photo = IMG_URL.'images/default-200x200.jpg';
			
		}
		// demo url for wishlist
		$user_array->wishlist_share_url = IMG_URL;

        
        $dbCon      = null;
        return $user_array;
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function consumerSocialLogin()
{

	global $app;
    $req = $app->request();
	
	$email_address = $req->params('email_address');
    $social_id = $req->params('social_id');
    $device_id = $req->params('device_id');
	$device_type = $req->params('device_type');
	
	$sql = "SELECT user_id FROM app_users WHERE ( email_address= '".$email_address."' ) AND social_id != ''";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->execute();
        $user = $stmt->fetchObject();  

		  if(empty($user)){
			   $user_array = array('success' => '0','sql'=>$sql);
			   echo json_encode($user_array);
			   exit;
		  }else{
			
			if(!empty($device_type) && !empty($device_id)){

			   $sql_update = "UPDATE app_users SET `device_type` = '".$device_type."',`device_id` = '".$device_id."' WHERE `user_id` = '".$user->user_id."'";
			   $stmt_update = $dbCon->prepare($sql_update);  
			   $stmt_update->execute();

			}

			$user_array = getUserInfo($user->user_id);
		
		   $user_array = array('success' => '1','user_array'=>$user_array);
		   echo json_encode($user_array);
		  }
        $dbCon = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function ConsumerLogin()
{

	global $app;
    $req = $app->request();
	
	$email_address = $req->params('email_address');
    $password = $req->params('password');
    $device_id = $req->params('device_id');
	$device_type = $req->params('device_type');
	$password = md5($password);
    $sql = "SELECT user_id,firstname,lastname,email_address,status AS profile_status FROM app_users WHERE email_address= '".$email_address."'  AND password = '".$password."'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->query($sql);
        $user = $stmt->fetchObject();
		  if(empty($user)){
		   $user_array = array('success' => '0','sql'=>$sql);
		   echo json_encode($user_array);
		  }else{
			
			if(!empty($device_type) && !empty($device_id)){

			   $sql_update = "UPDATE app_users SET `device_type` = '".$device_type."',`device_id` = '".$device_id."' WHERE `user_id` = '".$user->user_id."'";
			   $stmt_update = $dbCon->prepare($sql_update);  
			   $stmt_update->execute();

			}

			$user_array = getUserInfo($user->user_id);
		
		   $user_array = array('success' => '1','user_array'=>$user_array,'sql'=>$sql);
		   echo json_encode($user_array);
		  }
        $dbCon = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
function FrontLogin()
{

	global $app;
    $req = $app->request();
	
	$email_address = $req->params('vendor_email');
    $password = $req->params('password');

	$password = md5($password);
	
    	$sql = "SELECT user_id,firstname,lastname,role,email_address,status AS profile_status FROM app_users WHERE (email_address= '".$email_address."') AND password = '".$password."'";
		
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->execute();
        $user = $stmt->fetchObject();  

		  if(empty($user)){
		   $user_array = array('success' => '0','sql'=>$sql);
		   echo json_encode($user_array);
		  }
		  else{
		   $user_array = array('success' => '1','user_array'=>$user,'userid'=>$user->user_id);
		   echo json_encode($user_array);
		 }
        $dbCon = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
####################################### END HERRE ADDED BY SUNIL ##################################
/****************** ADDED BY SUNIL ********/
/*********************     Date 1/22/2016     ****************************/


function deleteUserReview($id)
{
    try {
        $dbCon       = getConnection();
        $sql  = "DELETE FROM user_review WHERE `id` = '" . $id . "'";
        $stmt = $dbCon->prepare($sql);
        $stmt->execute();
 
        $sql  = "DELETE FROM user_ratings WHERE `user_review_id` = '" . $id . "'";
        $stmt = $dbCon->prepare($sql);
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

function editReviewVendor($user_id)
{
    global $app;
    $req            = $app->request();

    $review_id      = $req->params('review_id');
    $review_title   = $req->params('review_title');
    $criteria_ids   = $req->params('criteria_ids');
    $ratings        = $req->params('ratings');
    $review_text    = $req->params('review_text');
    $user_visit_date   = $req->params('user_visit_date');
	

    $sql  = "UPDATE user_review SET `review_title` = '".$review_title."',`user_visit_date` = '".$user_visit_date."',`user_id`= '" . $user_id . "',`comment` = '" . $review_text . "',`comment_modify`='" . $today_date . "',`status` = '0' WHERE `id`= '" . $review_id . "'";
    try {
        $dbCon = getConnection();
		$stmt  = $dbCon->prepare($sql);
        $stmt->execute();

        $rateexp        = array_filter(explode(',', $ratings));
        $reviewcriteria = array_filter(explode(',', $criteria_ids));
        $review_counts  = count($reviewcriteria);
        $rateexpl       = explode(',', $ratings);
        $rateexp_count  = count($rateexpl);
        $i              = 0;
        if ($rateexp_count > 0) {
            foreach ($reviewcriteria as $criterias) {
                $sql_query = "UPDATE user_ratings SET `ratings`= '" . $rateexp[$i] . "' WHERE  user_review_id = '".$review_id."' AND `review_criteria_id`= '" . $criterias . "'";
                $stmtr     = $dbCon->prepare($sql_query);
                $stmtr->execute();
                $i++;
            }
            $response = array(
                'success' => '1',
                'sql' => $sql,
                'sql_query' => $sql_query
            );
        } else {
            $response = array(
                'success' => '0',
            );
        }
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function addReviewVendor()
{
    global $app;
    $req            = $app->request();
    $slug_name      = $req->params('slug_name');

    $review_title      = $req->params('review_title');
    $user_visit_date   = $req->params('user_visit_date');

    $criteria_ids   = $req->params('criteria_ids');
    $ratings        = $req->params('ratings');
    $review_text    = $req->params('review_text');
    $review_user_id = $req->params('review_user_id');
    $today_date     = TODAY_DATE_TIME;
    /***************** Decrypt Data *********/
    /*$vendor_id = AesCtr::decrypt($vendor_id, PW, 256);
    $criteria_ids = AesCtr::decrypt($criteria_ids, PW, 256);
    $ratings = AesCtr::decrypt($ratings, PW, 256);
    $review_text = AesCtr::decrypt($review_text, PW, 256);
    $review_user_id = AesCtr::decrypt($review_user_id, PW, 256);*/


	$vendor_array = getUserInfoBySlug($slug_name);
	$vendor_id = $vendor_array->user_id;
	

    $sql  = "INSERT INTO user_review SET `review_title` = '".$review_title."',`user_visit_date` = '".$user_visit_date."',`user_id`= '" . $review_user_id . "',`vendor_id`= '" . $vendor_id . "',`comment` = '" . $review_text . "',`comment_published`='" . $today_date . "',`comment_modify`='" . $today_date . "',`status` = '0'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $category       = new stdClass();
        $userLastInsert = $dbCon->lastInsertId();
        $rateexp        = array_filter(explode(',', $ratings));
        $reviewcriteria = array_filter(explode(',', $criteria_ids));
        $review_counts  = count($reviewcriteria);
        $rateexpl       = explode(',', $ratings);
        $rateexp_count  = count($rateexpl);
        $i              = 0;
        if ($rateexp_count > 0) {
            foreach ($reviewcriteria as $criterias) {
                $sql_query = "INSERT INTO user_ratings SET `user_review_id`= '" . $userLastInsert . "',`vendor_id`= '" . $vendor_id . "',`review_criteria_id`= '" . $criterias . "',`ratings`= '" . $rateexp[$i] . "',`status`=2";
                $stmtr     = $dbCon->prepare($sql_query);
                $stmtr->execute();
                $i++;
            }
            $response = array(
                'success' => '1',
                
                'counts' => $review_counts
            );
        } else {
            $response = array(
                'success' => '0',
                
                'counts' => $review_counts
            );
        }
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function getSingleVendorUser($slug_name,$check_user_id) 
{
	global $mcrypt;
    $sql_query =  "SELECT au.user_id,au.profile_photo,au.firstname,au.slug_name,au.address,au.phone,au.mobile,au.category_type_id,au.timing_clinic,au.results,au.seats,au.courses,au.description,au.category_id,au.facility_ids,au.map_location,au.second_opinion,au.second_opinion_charges,l.location_name,s.subarea_name FROM app_users AS au LEFT JOIN location AS l ON l.id = au.current_location_id  LEFT JOIN subarea AS s ON s.id = au.subarea_id WHERE slug_name = '" . $slug_name . "' ORDER BY user_id DESC";
    try {
        $dbCon                = getConnection();
        $stmt                 = $dbCon->query($sql_query);
        $users                = $stmt->fetchObject();
         
         //for user follow
        $sql =  "SELECT id FROM vendor_followers WHERE user_id = '" . $check_user_id . "' AND vendor_id = '" . $vendor_id . "'";
		$stmt                 = $dbCon->query($sql);
        $check_follower       = $stmt->fetchObject();
		if(!empty($check_follower)){
	
				$users->is_follow = '1';
		}else{
				$users->is_follow = '0';
		
		}
         
		//for vendor images
		$sql_photo            = "SELECT * FROM user_images WHERE user_id=" . $users->user_id;
        $stmtn                = $dbCon->query($sql_photo);
        $review_photo_object  = $stmtn->fetchAll(PDO::FETCH_OBJ);
        if(!empty($review_photo_object)){
			foreach($review_photo_object as $review_photo_value){
				$review_photo_value->user_images = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$review_photo_value->image."&w=200&h=200&zc=0";
			} 
			$users->user_photo = $review_photo_object;
		}else{ 
			$users->user_photo    = array();
		}
		//for vendor review criteria images
        $sql_criteria         = "SELECT id,criteria_name FROM review_criteria WHERE status  = '1' AND category_type= " . $users->category_type_id;
        $stmtc                = $dbCon->query($sql_criteria);
        $sql_criteria_names   = $stmtc->fetchAll(PDO::FETCH_OBJ);
        $users->user_criteria = $sql_criteria_names;

 
		//for vendor review's
		$sql_query = "SELECT ur.id AS review_id,ur.user_id, ur.comment, ur.comment_published,ur.review_likes FROM user_review AS ur INNER JOIN app_users au ON au.user_id = ur.vendor_id WHERE au.slug_name = '" . $slug_name . "' AND ur.status='1'  ORDER BY ur.id ";
        $dbCon        = getConnection();
        $stmt         = $dbCon->query($sql_query);
        $review_array = $stmt->fetchAll(PDO::FETCH_OBJ);




		//for is vendor favourite 
		$sql_query = "SELECT favourite FROM app_users  WHERE user_id = '" . $check_user_id . "'";
        $dbCon        = getConnection();
        $stmt         = $dbCon->query($sql_query);
        $check_user_array = $stmt->fetchObject();
		
		if(!empty($check_user_array)){
		
			$favourite = unserialize($check_user_array->favourite);
			if(in_array($users->user_id,$favourite))
				$users->is_favourite = '1';
			else 
				$users->is_favourite = '0';
			
		}else{
		
				$users->is_favourite = '0';

		}

		
		if(!empty($review_array)){
			foreach ($review_array as $review_array_value) {
				
				

				$sql                            = "SELECT firstname,lastname,profile_photo FROM app_users  WHERE user_id = " . $review_array_value->user_id;
				$stmts                          = $dbCon->query($sql);
				$user_array     			    = $stmts->fetchObject();
				
				$review_array_value->firstname = $user_array->firstname;
				$review_array_value->lastname = $user_array->lastname;
				//$review_array_value->profile_photo = '';
				
				if(empty($review_array_value->profile_photo))
						$review_array_value->profile_photo = IMG_URL."images/img.jpg";
				else
					$review_array_value->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$review_array_value->profile_photo."&w=96&h=96&zc=0";

					


				$sql                            = "SELECT r.id AS rate_id,r.ratings,r.review_criteria_id,rc.criteria_name FROM user_ratings r LEFT JOIN review_criteria rc ON rc.id=r.review_criteria_id WHERE user_review_id=" . $review_array_value->review_id;
				$stmts                          = $dbCon->query($sql);
				$review_ratings_array           = $stmts->fetchAll(PDO::FETCH_OBJ);
				$review_array_value->ratingsall = $review_ratings_array;
				
				
				// for review likes
				if(!empty($review_array_value->review_likes)){
					
					$review_like_array = array_filter(explode(',',$review_array_value->review_likes));
					$reivew_like_count = count($review_like_array);
					$review_array_value->review_like_count = $reivew_like_count;
				
					$review_like_users = implode("','",$review_like_array);
	
	
					// check if like or not
					if(in_array($check_user_id,$review_like_array))
						$review_array_value->is_review_like = '1'; 
					else
						$review_array_value->is_review_like = '0'; 
					

					$sql_query = "SELECT au.firstname,au.lastname FROM app_users AS au  WHERE user_id IN ('".$review_like_users."') ";
					$stmt = $dbCon->query($sql_query);
					$review_user_info_array = $stmt->fetchAll(PDO::FETCH_OBJ);
					$review_array_value->review_user_info_array = $review_user_info_array;
				
				}else{
					$review_array_value->is_review_like = '0'; 
					$review_array_value->review_like_count = 0;
					$review_array_value->review_user_info_array = array();

				}	
					 
					// for review reply
					$sql_query = "SELECT rr.id AS reply_id,au.firstname,au.lastname,au.profile_photo,rr.reply_likes,rr.reply_text,rr.time FROM review_reply AS rr LEFT JOIN app_users AS au ON au.user_id = rr.user_id WHERE review_id = '".$review_array_value->review_id."' ";
					$stmt = $dbCon->query($sql_query);
					$reply_array = $stmt->fetchAll(PDO::FETCH_OBJ);
		
					if(!empty($reply_array)){
					
						foreach($reply_array as $reply_value){
						
						
								if(empty($reply_value->profile_photo))
									$reply_value->profile_photo =  IMG_URL."images/default.jpg";
								else
									$reply_value->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$reply_value->profile_photo;



								if(!empty($reply_value->reply_likes)){
									$reply_like_array = array_filter(explode(',',$reply_value->reply_likes));
									$reply_like_count = count($reply_like_array);
									$reply_value->reply_like_count = $reply_like_count;
								
									$reply_like_users = implode("','",$reply_like_array);
						
									// check if like or not
									if(in_array($check_user_id,$reply_like_array))
										$reply_value->is_reply_like = '1'; 
									else
										$reply_value->is_reply_like = '0'; 
										
										
									$sql_query = "SELECT au.firstname,au.lastname FROM app_users AS au  WHERE user_id IN ('".$reply_like_users."') ";
									$stmt = $dbCon->query($sql_query);
									$reply_user_info_array = $stmt->fetchAll(PDO::FETCH_OBJ);

									//$reply_value->reply_like_count = 0;
									$reply_value->reply_user_info_array = $reply_user_info_array;
								
								}else{
									$reply_value->is_reply_like = '0'; 
									$reply_value->reply_like_count = 0;
									$reply_value->reply_user_info_array = array();

								}			
											
											
						}
						$review_array_value->reply_array = $reply_array;
				
					}else{
					
						$review_array_value->reply_array = array();
					
					}
				
				
			}

		$users->review_array = $review_array ;


		}else{
			$users->review_array = array();

		}

		
		if(!empty($users->facility_ids)){
			
				$facility_array = explode(',',$users->facility_ids);
				$facility_ids = "'".implode("','",$facility_array)."'";
				
				$sql                            = "SELECT facility_name FROM facility WHERE id IN (".$facility_ids.")";
				$stmts                          = $dbCon->query($sql);
				$users->facility_name_array	    = $stmts->fetchAll(PDO::FETCH_OBJ);
			
		
		}


		$sql_query = "SELECT AVG(ur.ratings) AS rating_average FROM user_ratings ur LEFT JOIN review_criteria rc ON rc.id=ur.review_criteria_id WHERE vendor_id = '" . $users->user_id . "' ORDER BY ur.id DESC LIMIT 0,50";
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $avg_rating_array      = $stmt->fetchObject();
		
		if(!empty($avg_rating_array)){

			$users->rating_average = number_format((float)$avg_rating_array->rating_average,1,'.','');
		
		}else{
		
			$users->rating_average = 0;
		}

		$users->share_info_url = IMG_URL.'vendor.php?slug_name='.$users->slug_name;
		$users->share_wishlist_url = IMG_URL;
		

	   // $content              = serialize($users);
        $encrypted            = $mcrypt->encrypt(json_encode($users));
        $dbCon                = null;
        $user_array           = array(
            'success' => '1',
            'user_array' => $encrypted,
            'user_array_iphone' => $users,
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getUserCommentSingle($slug_name)
{
    $sql_query = "SELECT au.id AS review_id, au.comment,au.comment, au.comment_published,au.status, au.comment_modify, au.status, u.user_id, u.firstname, u.lastname,u.profile_photo FROM user_review au LEFT JOIN app_users u ON u.user_id = au.user_id WHERE u.slug_name='" . $slug_name . "' AND au.status='1' AND ref_id=0 ORDER BY id DESC LIMIT 0,8";
    try {
        $dbCon        = getConnection();
        $stmt         = $dbCon->query($sql_query);
        $review_array = $stmt->fetchAll(PDO::FETCH_OBJ);
        $queryvalues  = '';
        foreach ($review_array as $review_array_value) {
            $review_ids .= "'" . $review_array_value->review_id . "',";
            $sql                            = "SELECT r.id AS rate_id,r.ratings,r.review_criteria_id,rc.criteria_name FROM user_ratings r LEFT JOIN review_criteria rc ON rc.id=r.review_criteria_id WHERE user_review_id=" . $review_array_value->review_id;
            $stmts                          = $dbCon->query($sql);
            $review_ratings_array           = $stmts->fetchAll(PDO::FETCH_OBJ);
            $review_array_value->ratingsall = $review_ratings_array;
        }

        $review_array_serilize    = serialize($review_array);
        $review_ratings_serilize  = serialize($review_ratings_array);
        $encrypted_review_array   = AesCtr::encrypt($review_array_serilize, PW, 256);
        $encrypted_review_ratings = AesCtr::encrypt($review_ratings_serilize, PW, 256);
        $dbCon                    = null;
        $hospital_array           = array(
            'success' => '1',
            'newssingle_array' => $encrypted_review_array
        );
        echo json_encode($hospital_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function GetFullRatingsVendor($vendor_id)
{
    $sql_query = "SELECT ur.id,ur.user_review_id,ur.vendor_id,ur.review_criteria_id,AVG(ur.ratings) AS rates,ur.status, rc.id,rc.category_type,rc.criteria_name FROM user_ratings ur LEFT JOIN review_criteria rc ON rc.id=ur.review_criteria_id WHERE vendor_id = '" . $vendor_id . "' ORDER BY ur.id DESC LIMIT 0,50";
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchObject();
        $content    = serialize($users);
        $encrypted  = AesCtr::encrypt($content, PW, 256);
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'reviews_array' => $encrypted,
            "sql" => $sql_query
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function GetUsersClickSingle($vendor_id)
{
    $ip              = IP_ADDRESS;
    $today           = TODAY_DATE;
    $sql_query_today = "SELECT * FROM vendor_history WHERE vendor_id=" . $vendor_id . " AND published_date='" . $today . "' AND ip_address='" . $ip . "'";
    try {
        $dbCon            = getConnection();
        /***********  get today *********/
        $stmt             = $dbCon->query($sql_query_today);
        $users_history    = $stmt->fetchAll(PDO::FETCH_OBJ);
        $user_visit_count = count($users_history);
        $dbCon            = null;
        $user_array       = array(
            'success' => '1',
            'visits_array' => $users_history,
            "sql" => $sql_query_today,
            "counts" => $user_visit_count
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function AddVendorHistory($vendor_id)
{
    global $app;
    $req = $app->request();
    $ip  = IP_ADDRESS;
    /*$vendor_id = $req->params('vendor_id');
    /********************* Decrypt Data ***************/
    /**$vendor_id = AesCtr::decrypt($vendor_id, PW, 256);**/
    $sql = "INSERT INTO vendor_history SET `vendor_id` = '" . $vendor_id . "',`ip_address` = '" . IP_ADDRESS . "',`published_date`='" . TODAY_DATE . "',`modified_date`='" . TODAY_DATE . "'";
    //echo $sql;die;	
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function uploadProfileImage($user_id)
{
    global $app;
    $req           = $app->request();
    $data = $req->params('profile_photo');
    //echo $sql;die;	
    try {
        $dbCon = getConnection();
		//$data = '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';

		$profile_photo = time().'.png';
		$path = $_SERVER["DOCUMENT_ROOT"] ."/curecity/uploads/".$profile_photo;
		file_put_contents($path,base64_decode($data));
	
		$sql   = "UPDATE app_users SET `profile_photo`= '" . $profile_photo . "' WHERE user_id = '" . $user_id . "'";
		$stmt  = $dbCon->prepare($sql);
		$stmt->execute();

		$user_array = array(
			'success' => '1',
			'profile_image' =>IMG_URL.'uploads/'.$profile_photo,
			'data' => $data
		);
			
		
       
        $dbCon      = null;
        echo json_encode($user_array);

    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function ChangeServiceLogo()
{
    global $app;
    $req           = $app->request();
    $user_id = $req->params('user_id');
    $profile_photo = $req->params('profile_photo');

    $sql           = "UPDATE app_users SET `profile_photo` = '" . $profile_photo . "' WHERE user_id = '" . $user_id . "'";
    //echo $sql;die;	
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user_array = array(
            'success' => '1',
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getSingleUser($user_id)
{
	global $mcrypt;
	
    $sql_query = "SELECT au.*, l.location_name,s.subarea_name FROM app_users AS au LEFT JOIN location AS l ON l.id = au.current_location_id  LEFT JOIN subarea AS s ON s.id = au.subarea_id WHERE au.user_id = '" . $user_id . "' ";
    try {
        $dbCon               = getConnection();
        $stmt                = $dbCon->query($sql_query);
        $users               = $stmt->fetchObject();
		
		if(empty($users->gender))
			$users->gender = '';
		
		if(empty($users->profile_photo))
			$users->profile_photo =  IMG_URL."images/default.jpg";
		else
			$users->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$users->profile_photo;
		
		
		// for user images
        $sql_photo           = "SELECT * FROM user_images WHERE user_id=" . $user_id;
        $stmtn               = $dbCon->query($sql_photo);
        $review_photo_object = $stmtn->fetchAll(PDO::FETCH_OBJ);
        $users->user_photo   = $review_photo_object;

		// for followers 
        $sql_photo 				     = "SELECT firstname,lastname,email_address,slug_name,profile_photo FROM app_users WHERE user_id IN (SELECT user_id FROM vendor_followers WHERE vendor_id = '".$user_id."') ";
        $stmtn              		 = $dbCon->query($sql_photo);
        $followers_array 			 = $stmtn->fetchAll(PDO::FETCH_OBJ);
       
	   if(!empty($followers_array)){
	   		foreach($followers_array as $followers_value){
				
					if(empty($followers_value->profile_photo))
						$followers_value->profile_photo = IMG_URL."images/img.jpg";
					else
						$followers_value->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$followers_value->profile_photo."&w=48&h=48&zc=0";

				
			}
	   		
			$users->followers_array = $followers_array;

	   }else{
	   		$users->followers_array = array();
	   }

		// for medical docuements
        $sql_photo           		 = "SELECT *  FROM medical_documents WHERE user_id  = '".$user_id."'";
        $stmtn              		 = $dbCon->query($sql_photo);
        $docuements_array 			 = $stmtn->fetchAll(PDO::FETCH_OBJ);
	   
	   if(empty($docuements_array))
			$users->docuements_array = array();
		else
			$users->docuements_array = $docuements_array;
	
		// for visit count
      
      
      	$ip                = IP_ADDRESS;
		$week_array        = StartAndEndDate(date('W'), date('Y'));
		$week_sd           = $week_array[week_start];
		$week_ed           = $week_array[week_end];
		$monthsd           = date('Y-m-01');
		$monthed           = date('Y-m-t');
		$sql_query_today   = "SELECT * FROM vendor_history WHERE vendor_id=" . $user_id . " AND published_date='" . TODAY_DATE . "'";
		$sql_query_weekly  = "SELECT * FROM vendor_history WHERE vendor_id=" . $user_id . " AND published_date BETWEEN '" . $week_sd . "' AND '" . $week_ed . "'";
		$sql_query_monthly = "SELECT * FROM vendor_history WHERE vendor_id=" . $user_id . " AND published_date BETWEEN '" . $monthsd . "' AND '" . $monthed . "'";


		/***********  get today *********/
        $stmt                     = $dbCon->query($sql_query_today);
        $users_history            = $stmt->fetchAll(PDO::FETCH_OBJ);
        $user_visit_count         = count($users_history);
        /**********  get week visits ********/
        $stmt_week                = $dbCon->query($sql_query_weekly);
        $users_weekly             = $stmt_week->fetchAll(PDO::FETCH_OBJ);
        $user_visit_count_week    = count($users_weekly);
        /**********  get Monthly visits ********/
        $stmt_month               = $dbCon->query($sql_query_monthly);
        $users_monthly            = $stmt_month->fetchAll(PDO::FETCH_OBJ);
        $user_visit_count_monthly = count($users_monthly);
        
        $users->count_today = $user_visit_count;
        $users->count_week = $user_visit_count_week;
        $users->count_month = $user_visit_count_monthly;
	

	   // for my reviews
        $dbCon               = null;
        $encrypted            = $mcrypt->encrypt(json_encode($users));
        $dbCon                = null;
        $user_array           = array(
            'success' => '1',
            'user_array' => $encrypted,
            'user_array_iphone' => $users,
            
        );

        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}


function getMyReviewSingle($id)
{
    $sql_query = "SELECT au.id AS review_id,au.review_title, au.user_id, au.vendor_id AS vendor_id, au.comment,au.status, au.comment_published,au.status, au.comment_modify, au.status, u.user_id, u.category_type_id,u.firstname, u.lastname,u.profile_photo,s.subarea_name,l.location_name FROM user_review au LEFT JOIN app_users u ON u.user_id = au.vendor_id LEFT JOIN subarea AS s ON s.id = u.subarea_id LEFT JOIN location AS l ON l.id = u.current_location_id WHERE au.id='" . $id . "' AND ref_id = '' ";
    try {
        $dbCon              = getConnection();
        $stmt               = $dbCon->query($sql_query);
        $review_array       = $stmt->fetchObject();

		if(!empty($review_array)){

					// for review criteria rating
					$sql_query = "SELECT ur.ratings,ur.review_criteria_id,rc.criteria_name,rc.status FROM user_ratings As ur LEFT JOIN review_criteria AS rc ON rc.id = ur.review_criteria_id WHERE ur.user_review_id ='" . $id . "' ";
					$stmt               = $dbCon->query($sql_query);
					$review_rating_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
					
					if(!empty($review_rating_array))
						$review_array->review_rating_array = $review_rating_array;
					else
						$review_array->review_rating_array = array();					
					

				
					if(empty($review_array->profile_photo))
						$review_array->profile_photo =  IMG_URL."images/img.jpg";
					else
						$review_array->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$review_array->profile_photo;
						

					$review_array           = array(
						'success' => '1',
						'review_array' => $review_array,
						'sql' => $sql_query
					);
	
		}else{
	
			$review_array           = array(
				'success' => '0',
			);
		
		}	
        $dbCon                    = null;
        echo json_encode($review_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function removeRevewliked($id)
{
   
    global $app;
    $req           = $app->request();
    
    $user_id     = $req->params('user_id');
    $review_id   = $req->params('review_id');

    $sql = "SELECT review_likes FROM user_review  WHERE id  = '".$review_id."'";
    try {
        $dbCon = getConnection();
	
		$stmt               = $dbCon->query($sql);
		$review_array       = $stmt->fetchObject();
	
		if(!empty($review_array)){
		
			$review_likes = str_replace($user_id.',','',$review_array->review_likes);
		}else{
		
			$review_likes = $review_array->review_likes;
		}

		$sql = "UPDATE user_review SET `review_likes` =  '".$review_likes."' WHERE id  = '".$review_id."'";

        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();	

		$response = array(
			'success' => '1'
		);
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
   
}




function getVendorReviews($id)
{
    $sql_query = "SELECT au.id AS review_id,au.review_title, au.user_id, au.vendor_id AS vendor_id, au.comment,au.status, au.comment_published,au.status, au.comment_modify, au.status, u.user_id, u.category_type_id,u.firstname, u.lastname,u.profile_photo,s.subarea_name,l.location_name FROM user_review au LEFT JOIN app_users u ON u.user_id = au.user_id LEFT JOIN subarea AS s ON s.id = u.subarea_id LEFT JOIN location AS l ON l.id = u.current_location_id WHERE au.vendor_id='" . $id . "' AND ref_id = '' ";
   
    try {
        $dbCon              = getConnection();
        $stmt               = $dbCon->query($sql_query);
        $review_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
      

		if(!empty($review_array)){

			foreach($review_array  as $review_value){

					// for review criteria rating
					$sql_query = "SELECT ur.ratings,ur.review_criteria_id,rc.criteria_name,rc.status FROM user_ratings As ur LEFT JOIN review_criteria AS rc ON rc.id = ur.review_criteria_id WHERE ur.user_review_id ='" . $review_value->review_id . "' ";
					$stmt               = $dbCon->query($sql_query);
					$review_rating_array       = $stmt->fetchAll(PDO::FETCH_OBJ);

					$review_value->review_rating_array = $review_rating_array;

					// for review criteria
					//$sql_query = "SELECT * FROM review_criteria WHERE category_type ='" . $review_value->category_type_id . "' ";
					//$stmt               = $dbCon->query($sql_query);
					//$review_criteria_array       = $stmt->fetchAll(PDO::FETCH_OBJ);			
					//$review_value->review_criteria_array = $review_criteria_array;
					
				
					if(empty($review_value->profile_photo))
						$review_value->profile_photo =  IMG_URL."images/default.jpg";
					else
						$review_value->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$review_value->profile_photo;
						

			
			}

			$review_array           = array(
				'success' => '1',
				'review_array' => $review_array,
			);
	
		}else{
	
			$review_array           = array(
				'success' => '0',
			);
	
		
		}	
        $dbCon                    = null;
        echo json_encode($review_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}



function getMySingleReviews($review_id,$user_id)
{
    $sql_query = "SELECT au.id AS review_id,au.review_title, au.user_id, au.vendor_id AS vendor_id, au.comment,au.status, au.comment_published,au.status, au.comment_modify, au.status, u.user_id, u.category_type_id,u.firstname, u.lastname,u.profile_photo,s.subarea_name,l.location_name,au.review_likes FROM user_review au LEFT JOIN app_users u ON u.user_id = au.user_id LEFT JOIN subarea AS s ON s.id = u.subarea_id LEFT JOIN location AS l ON l.id = u.current_location_id WHERE  au.id  = '".$review_id."' ";
   
    try {
        $dbCon              = getConnection();
        $stmt               = $dbCon->query($sql_query);
        $review_array       = $stmt->fetchObject();
      

		if(!empty($review_array)){


			//foreach($review_array  as $review_value){

					// for review criteria rating
					$sql_query = "SELECT ur.ratings,ur.review_criteria_id,rc.criteria_name,rc.status FROM user_ratings As ur LEFT JOIN review_criteria AS rc ON rc.id = ur.review_criteria_id WHERE ur.user_review_id ='" . $review_array->review_id . "' ";
					$stmt               = $dbCon->query($sql_query);
					$review_rating_array       = $stmt->fetchAll(PDO::FETCH_OBJ);

					$review_array->review_rating_array = $review_rating_array;
				
					if(empty($review_array->profile_photo))
						$review_array->profile_photo =  IMG_URL."images/default.jpg";
					else
						$review_array->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$review_array->profile_photo;
						
					// for review likes
					if(!empty($review_array->review_likes)){
						
						$review_like_array = array_filter(explode(',',$review_array->review_likes));
						$review_like_count = count($review_like_array);
						$review_array->review_like_count = $review_like_count;
					
						$review_like_users = implode("','",$review_like_array);
						
						// check if like or not
						if(in_array($user_id,$review_like_array))
							$review_array->is_review_like = '1'; 
						else
							$review_array->is_review_like = '0'; 
						
						$sql_query = "SELECT au.firstname,au.lastname FROM app_users AS au  WHERE user_id IN ('".$review_like_users."') ";
						$stmt = $dbCon->query($sql_query);
						$review_user_info_array = $stmt->fetchAll(PDO::FETCH_OBJ);
						$review_array->review_user_info_array = $review_user_info_array;
					
					}else{
						$review_array->is_review_like = '0'; 
						$review_array->review_like_count = 0;
						$review_array->review_user_info_array = array();

					}			
						
	 
						
					// for review reply
					$sql_query = "SELECT rr.id AS reply_id, au.firstname,au.lastname,au.profile_photo,rr.reply_likes,rr.reply_text,rr.time FROM review_reply AS rr LEFT JOIN app_users AS au ON au.user_id = rr.user_id WHERE review_id = '".$review_array->review_id."' ";
					$stmt = $dbCon->query($sql_query);
					$reply_array = $stmt->fetchAll(PDO::FETCH_OBJ);
		
					if(!empty($reply_array)){
					
						foreach($reply_array as $reply_value){
						
						
								if(empty($reply_value->profile_photo))
									$reply_value->profile_photo =  IMG_URL."images/default.jpg";
								else
									$reply_value->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$reply_value->profile_photo;



								if(!empty($reply_value->reply_likes)){
									$reply_like_array = array_filter(explode(',',$reply_value->reply_likes));
									$reply_like_count = count($reply_like_array);
									$reply_value->reply_like_count = $reply_like_count;
								
									$reply_like_users = implode("','",$reply_like_array);
					
									// check if like or not
										if(in_array($user_id,$reply_like_array))
											$reply_value->is_reply_like = '1'; 
										else
											$reply_value->is_reply_like = '0'; 
										
										
									$sql_query = "SELECT au.firstname,au.lastname FROM app_users AS au  WHERE user_id IN ('".$reply_like_users."') ";
									$stmt = $dbCon->query($sql_query);
									$reply_user_info_array = $stmt->fetchAll(PDO::FETCH_OBJ);

									//$reply_value->reply_like_count = 0;
									$reply_value->reply_user_info_array = $reply_user_info_array;
								
								}else{
									$reply_value->is_reply_like = '0'; 
									$reply_value->reply_like_count = 0;
									$reply_value->reply_user_info_array = array();

								}			
											
											
						} 
						$review_array->reply_array = $reply_array;
				
					}else{
					
						$review_array->reply_array = array();
					
					}
			//}

			$review_array           = array(
				'success' => '1',
				'review_array' => $review_array
			);
	
		}else{
	
			$review_array           = array(
				'success' => '0',
			);
	
		
		}	
        $dbCon                    = null;
        echo json_encode($review_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}

function getMyReviews($id)
{
    $sql_query = "SELECT au.id AS review_id,au.review_title, au.user_id, au.vendor_id AS vendor_id, au.comment,au.status, au.comment_published,au.status, au.comment_modify, au.status, u.user_id, u.category_type_id,u.firstname, u.lastname,u.profile_photo,s.subarea_name,l.location_name,au.review_likes FROM user_review au LEFT JOIN app_users u ON u.user_id = au.vendor_id LEFT JOIN subarea AS s ON s.id = u.subarea_id LEFT JOIN location AS l ON l.id = u.current_location_id WHERE au.user_id='" . $id . "' AND ref_id = '' ";
   
    try {
        $dbCon              = getConnection();
        $stmt               = $dbCon->query($sql_query);
        $review_array       = $stmt->fetchAll(PDO::FETCH_OBJ);
      

		if(!empty($review_array)){

			foreach($review_array  as $review_value){

					// for review criteria rating
					$sql_query = "SELECT ur.ratings,ur.review_criteria_id,rc.criteria_name,rc.status FROM user_ratings As ur LEFT JOIN review_criteria AS rc ON rc.id = ur.review_criteria_id WHERE ur.user_review_id ='" . $review_value->review_id . "' ";
					$stmt               = $dbCon->query($sql_query);
					$review_rating_array       = $stmt->fetchAll(PDO::FETCH_OBJ);

					$review_value->review_rating_array = $review_rating_array;
				
					if(empty($review_value->profile_photo))
						$review_value->profile_photo =  IMG_URL."images/default.jpg";
					else
						$review_value->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$review_value->profile_photo;
						
					// for review likes
					if(!empty($review_value->review_likes)){
						
						$review_like_array = array_filter(explode(',',$review_value->review_likes));
						$review_like_count = count($review_like_array);
						$reivew_value->review_like_count = $review_like_count;
					
						$review_like_users = implode("','",$review_like_array);
		
						$sql_query = "SELECT au.firstname,au.lastname FROM app_users AS au  WHERE user_id IN ('".$review_like_users."') ";
						$stmt = $dbCon->query($sql_query);
						$review_user_info_array = $stmt->fetchAll(PDO::FETCH_OBJ);
						$review_value->review_user_info_array = $review_user_info_array;
					
					}else{
						$review_value->review_like_count = 0;
						$review_value->review_user_info_array = array();

					}			
						
	
						
					// for review reply
					$sql_query = "SELECT au.firstname,au.lastname,au.profile_photo,rr.reply_likes,rr.reply_text,rr.time FROM review_reply AS rr LEFT JOIN app_users AS au ON au.user_id = rr.user_id WHERE review_id = '".$review_value->review_id."' ";
					$stmt = $dbCon->query($sql_query);
					$reply_array = $stmt->fetchAll(PDO::FETCH_OBJ);
		
					if(!empty($reply_array)){
					
						foreach($reply_array as $reply_value){
						
						
								if(empty($reply_value->profile_photo))
									$reply_value->profile_photo =  IMG_URL."images/default.jpg";
								else
									$reply_value->profile_photo = IMG_URL."timthumb.php?src=".IMG_URL.UPLOAD_FOLDER.$reply_value->profile_photo;



								if(!empty($reply_value->reply_likes)){
									$reply_like_array = array_filter(explode(',',$reply_value->reply_likes));
									$reply_like_count = count($reply_like_array);
									$reply_value->reply_like_count = $reply_like_count;
								
									$reply_like_users = implode("','",$reply_like_array);
					
									$sql_query = "SELECT au.firstname,au.lastname FROM app_users AS au  WHERE user_id IN ('".$reply_like_users."') ";
									$stmt = $dbCon->query($sql_query);
									$reply_user_info_array = $stmt->fetchAll(PDO::FETCH_OBJ);

									//$reply_value->reply_like_count = 0;
									$reply_value->reply_user_info_array = $reply_user_info_array;
								
								}else{
									$reply_value->reply_like_count = 0;
									$reply_value->reply_user_info_array = array();

								}			
											
											
						}
						$review_value->reply_array = $reply_array;
				
					}else{
					
						$review_value->reply_array = array();
					
					}
			}

			$review_array           = array(
				'success' => '1',
				'review_array' => $review_array,
			);
	
		}else{
	
			$review_array           = array(
				'success' => '0',
			);
	
		
		}	
        $dbCon                    = null;
        echo json_encode($review_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}

function StartAndEndDate($week, $year)
{
    $dto = new DateTime();
    $dto->setISODate($year, $week);
    $ret['week_start'] = $dto->format('Y-m-d');
    $dto->modify('+6 days');
    $ret['week_end'] = $dto->format('Y-m-d');
    return $ret;
}
function GetUsersClick($vendor_id)
{
    $ip                = IP_ADDRESS;
    $week_array        = StartAndEndDate(date('W'), date('Y'));
    $week_sd           = $week_array[week_start];
    $week_ed           = $week_array[week_end];
    $monthsd           = date('Y-m-01');
    $monthed           = date('Y-m-t');
    $sql_query_today   = "SELECT * FROM vendor_history WHERE vendor_id=" . $vendor_id . " AND published_date='" . TODAY_DATE . "'";
    $sql_query_weekly  = "SELECT * FROM vendor_history WHERE vendor_id=" . $vendor_id . " AND published_date BETWEEN '" . $week_sd . "' AND '" . $week_ed . "'";
    $sql_query_monthly = "SELECT * FROM vendor_history WHERE vendor_id=" . $vendor_id . " AND published_date BETWEEN '" . $monthsd . "' AND '" . $monthed . "'";
    try {
        $dbCon                    = getConnection();
        /***********  get today *********/
        $stmt                     = $dbCon->query($sql_query_today);
        $users_history            = $stmt->fetchAll(PDO::FETCH_OBJ);
        $user_visit_count         = count($users_history);
        /**********  get week visits ********/
        $stmt_week                = $dbCon->query($sql_query_weekly);
        $users_weekly             = $stmt_week->fetchAll(PDO::FETCH_OBJ);
        $user_visit_count_week    = count($users_weekly);
        /**********  get Monthly visits ********/
        $stmt_month               = $dbCon->query($sql_query_monthly);
        $users_monthly            = $stmt_month->fetchAll(PDO::FETCH_OBJ);
        $user_visit_count_monthly = count($users_monthly);
        $content                  = serialize($users_history);
        $encrypted                = AesCtr::encrypt($content, PW, 256);
        $dbCon                    = null;
        $user_array               = array(
            'success' => '1',
            'visits_array' => $encrypted,
            "sql" => $sql_query,
            "count_today" => $user_visit_count,
            "count_week" => $user_visit_count_week,
            "count_month" => $user_visit_count_monthly
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function SecondOpinionUsers($user_id)
{
    $sql_query = "SELECT so.id, so.vendor_id,so.user_id AS souser,so.vendor_charges,so.status,au.user_id,au.firstname,au.profile_photo,au.lastname,au.username FROM second_opinion so LEFT JOIN app_users au ON au.user_id=so.user_id WHERE so.vendor_id = '" . $user_id . "'";
    try {
        $dbCon                = getConnection();
        $stmt                 = $dbCon->query($sql_query);
        $second_opinion_users = $stmt->fetchAll(PDO::FETCH_OBJ);
        if(!empty($second_opinion_users)){
		
			foreach($second_opinion_users as $second_opinion_value){
					
					if(!empty($second_opinion_value->vendor_charges))
						$second_opinion_value->vendor_charges = 'Rs.'.$second_opinion_value->vendor_charges;

			}
		}
        $content              = serialize($second_opinion_users);
        $encrypted            = AesCtr::encrypt($content, PW, 256);
        $total_counts         = count($second_opinion_users);
        $dbCon                = null;
        $user_array           = array(
            'success' => '1',
            'users_array' => $encrypted,
            'counts' => $total_counts
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function addReviewComment()
{
    global $app;
    $req            = $app->request();
    $review_id      = $req->params('review_id');
    $review_comment = $req->params('review_comment');
    $vendor_id      = $req->params('vendor_id');
    $user_id        = $req->params('user_id');
    /***************** Decrypt Data *********/
    /*$review_id = AesCtr::decrypt($review_id, PW, 256);
    $review_comment = AesCtr::decrypt($review_comment, PW, 256);*/
    $sql            = "INSERT INTO user_review SET `ref_id`= '" . $review_id . "',`user_id`= '" . $user_id . "',`vendor_id`= '" . $vendor_id . "',`comment` = '" . $review_comment . "',`comment_published`=NOW(),`status` = '2'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $category = new stdClass();
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
function reviewcommentEdit($review_comment_id)
{
    global $app;
    $req             = $app->request();
    $review_comments = $req->params('review_comments');
    /**************** Decrypt Data **********/
    $review_comments = AesCtr::decrypt($review_comments, PW, 256);
    $sql             = "UPDATE user_review SET `comment`= '" . $review_comments . "' WHERE id = '" . $review_comment_id . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function editFrontDoctor($edit_id)
{
    global $app;  
    $req                   = $app->request();
    $firstname             = $req->params('firstname');
    $lastname              = $req->params('lastname');
    $category_id     	   = $req->params('category_id');
    $practicing_since      = $req->params('practicing_since');
    $mobile                = $req->params('mobile');
    $search_keywords       = $req->params('search_keywords');
    $description           = $req->params('description');
    $degree                = $req->params('degree');
    $website               = $req->params('website');
    $current_location_id   = $req->params('current_location_id');
    $subarea_id            = $req->params('subarea_id');
    $previous_location_id  = $req->params('previous_location_id');
    $timing_clinic         = $req->params('timing_clinic');
	$timing_residence      = $req->params('timing_residence');
	$dob                   = $req->params('dob');
    $facility_ids          = $req->params('facility_ids');
    $gender                = $req->params('gender');
    $second_openion        = $req->params('second_openion');
//    $second_opinion_charge = $req->params('second_opinion_charge');
    $newsletter            = $req->params('newsletter');
    $status            = $req->params('status');

    $sql                   = "UPDATE app_users SET 

			`firstname`= '" . $firstname . "',			
			`lastname`= '" . $lastname . "',
			`category_id` = '" . $category_id . "',";
    if (!empty($profile_photo))
        $sql .= "`profile_photo` = '" . $profile_photo . "',";
 
    $sql .= "`practicing_since` = '" . $practicing_since . "',
			`mobile` = '" . $mobile . "',
			`timing_clinic`= '" . $timing_clinic . "',
			`timing_residence`= '" . $timing_residence . "',
			`keywords`= '" . $search_keywords . "',
			`description` = '" . $description . "',
			`degree` = '" . $degree . "',			
			`current_location_id`= '" . $current_location_id . "',
			`subarea_id`= '" . $subarea_id . "',
			`website`= '" . $website . "',
			`previous_location_id`= '" . $previous_location_id . "',
			`dob` = '" . date('Y-m-d', strtotime($dob)) . "',
			`facility_ids` = '" . $facility_ids . "',
			`gender` = '" . $gender . "',
			`second_opinion` = '" . $second_openion . "',
			`newsletter` = '" . $newsletter . "',";
	
	if(!empty($status))			
			$sql .=	"`status` = '" . $status . "',";

	$sql .=	"`second_opinion_charges` = '" . $second_opinion_charge . "',
			`modified_date`= '" . TODAY_DATE_TIME . "'
			WHERE user_id = '" . $edit_id . "'";
    //echo $sql;die;		
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user_array = array(
            'success' => '1',
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function editHospitalUser($edit_id)
{
    global $app;
    $req                   = $app->request();
    $firstname             = $req->params('firstname');
    $category_id           = $req->params('category_id');
    $profile_photo         = $req->params('profile_photo');
    $address               = $req->params('address');
    $beds                  = $req->params('beds');
    $mobile                = $req->params('mobile');
    $description           = $req->params('description');
    $current_location_id   = $req->params('current_location_id');
    $subarea_id            = $req->params('subarea_id');
    $website               = $req->params('website');
    $media_claim_facility  = $req->params('media_claim_facility');
    $phone                 = $req->params('phone');
    $facility_ids          = $req->params('facility_ids');
    $certifications        = $req->params('certifications');
    $keywords		       = $req->params('keywords');
    $year_of_establishment = $req->params('year_of_establishment');
    $operation_hours       = $req->params('operation_hours');
    $contact_person        = $req->params('contact_person');
    $other_details         = $req->params('other_details');
    $map_location          = $req->params('map_location');
    $newsletter            = $req->params('newsletter');

    $sql                   = "UPDATE app_users SET 

			`firstname`= '" . $firstname . "',
			`category_id` = '" . $category_id . "',";
    $sql .= "`address` = '" . $address . "',
			`beds` = '" . $beds . "',	
			`mobile` = '" . $mobile . "',
			`phone` = '" . $phone . "',
			`description`= '" . $description . "',
			`current_location_id`= '" . $current_location_id . "',
			`subarea_id`= '" . $subarea_id . "',
			`website`= '" . $website . "',
			`facility_ids`= '" . $facility_ids . "',
			`media_claim_facility`= '" . $media_claim_facility . "',
			`keywords`= '" . $keywords . "',
			`dob` = '" . date('Y-m-d', strtotime($dob)) . "',
			`facility_ids` = '" . $facility_ids . "',
			`certifications` = '" . $certifications . "',
			`map_location` = '" . $map_location . "',
			`year_of_establishment` = '" . $year_of_establishment . "',
			`operation_hours` = '" . $operation_hours . "',
			`contact_person` = '" . $contact_person . "',
			`other_details` = '" . $other_details . "',
			`newsletter` = '" . $newsletter . "',
			`modified_date`= '" . TODAY_DATE_TIME . "'
			WHERE user_id = '" . $edit_id . "'";
    //echo $sql;die;	
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        if (!empty($profile_photo)) {
            $profile_photo_array = array_filter(explode(',', $profile_photo));
            foreach ($profile_photo_array as $image) {
                $sql_query = "INSERT INTO user_images SET `user_id`= '" . $edit_id . "',`image` = '" . $image . "' ";
                $stmtq     = $dbCon->prepare($sql_query);
                $stmtq->execute();
            }
        }
        $user_array = array(
            'success' => '1',
            'sql' => $sql,
            "sql_query" => $sql_query
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function editHealthUser($edit_id)
{
    global $app;
    $req                   = $app->request();
    $firstname             = $req->params('firstname');
    $category_id           = $req->params('category_id');
    $profile_photo         = $req->params('profile_photo');
    $address               = $req->params('address');
    $mobile                = $req->params('mobile');
    $phone                 = $req->params('phone');
    $description           = $req->params('description');
    $current_location_id   = $req->params('current_location_id');
    $subarea_id            = $req->params('subarea_id');
    $website               = $req->params('website');
    $facility_ids          = $req->params('facility_ids');
    $certifications        = $req->params('certifications');
    $keywords       = $req->params('keywords');
    $year_of_establishment = $req->params('year_of_establishment');
    $operation_hours       = $req->params('operation_hours');
    $contact_person        = $req->params('contact_person');
    $other_details         = $req->params('other_details');
    $map_location          = $req->params('map_location');
    $newsletter            = $req->params('newsletter');

    $sql                   = "UPDATE app_users SET 

			`firstname`= '" . $firstname . "',
			`category_id` = '" . $category_id . "',";
    $sql .= "`address` = '" . $address . "',
			`mobile` = '" . $mobile . "',
			`phone` = '" . $phone . "',
			`facility_ids`= '" . $facility_ids . "',
			`keywords`= '" . $keywords . "',
			`description`= '" . $description . "',
			`current_location_id`= '" . $current_location_id . "',
			`subarea_id`= '" . $subarea_id . "',
			`website`= '" . $website . "',
			`dob` = '" . date('Y-m-d', strtotime($dob)) . "',
			`facility_ids` = '" . $facility_ids . "',
			`map_location` = '" . $map_location . "',
			`certifications` = '" . $certifications . "',
			`year_of_establishment` = '" . $year_of_establishment . "',
			`operation_hours` = '" . $operation_hours . "',
			`contact_person` = '" . $contact_person . "',
			`other_details` = '" . $other_details . "',
			`newsletter` = '" . $newsletter . "',
			`modified_date`= '" . TODAY_DATE_TIME . "'
			WHERE user_id = '" . $edit_id . "'";
    //echo $sql;die;	
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        if (!empty($profile_photo)) {
            $profile_photo_array = array_filter(explode(',', $profile_photo));
            foreach ($profile_photo_array as $image) {
                $sql_query = "INSERT INTO user_images SET `user_id`= '" . $edit_id . "',`image` = '" . $image . "' ";
                $stmtq     = $dbCon->prepare($sql_query);
                $stmtq->execute();
            }
        }
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function editEducationUser($edit_id)
{
    global $app;
    $req                   = $app->request();
    $firstname             = $req->params('firstname');
    $category_id           = $req->params('category_id');
    $profile_photo         = $req->params('profile_photo');
    $address               = $req->params('address');
    $mobile                = $req->params('mobile');
    $phone                 = $req->params('phone');
    $facility_ids          = $req->params('facility_ids');
    $certifications        = $req->params('certifications');
    $search_keywords       = $req->params('search_keywords');
    $year_of_establishment = $req->params('year_of_establishment');
    $operation_hours       = $req->params('operation_hours');
    $contact_person        = $req->params('contact_person');
    $other_details         = $req->params('other_details');
    $description           = $req->params('description');
    $year_of_establishment = $req->params('year_of_establishment');
    $operation_hours       = $req->params('operation_hours');
    $training_tie_up       = $req->params('training_tie_up');
    $results               = $req->params('results');
    $seats                 = $req->params('seats');
    $courses               = $req->params('courses');
    $website               = $req->params('website');
    $map_location          = $req->params('map_location');
    $contact_person        = $req->params('contact_person');
    $other_details         = $req->params('other_details');
    $newsletter            = $req->params('newsletter');
    /********************* Decrypt Data ***************/
    /*$firstname = AesCtr::decrypt($firstname, PW, 256);
    $category_id = AesCtr::decrypt($category_id, PW, 256);
    $profile_photo = AesCtr::decrypt($profile_photo, PW, 256);
    $address = AesCtr::decrypt($address, PW, 256);
    $mobile = AesCtr::decrypt($mobile, PW, 256);
    $phone = AesCtr::decrypt($phone, PW, 256);	
    $facility_ids = AesCtr::decrypt($facility_ids, PW, 256);
    $certifications = AesCtr::decrypt($certifications, PW, 256);
    $search_keywords = AesCtr::decrypt($search_keywords, PW, 256);
    $year_of_establishment = AesCtr::decrypt($year_of_establishment, PW, 256);
    $operation_hours = AesCtr::decrypt($operation_hours, PW, 256);
    $training_tie_up = AesCtr::decrypt($training_tie_up, PW, 256);
    $results = AesCtr::decrypt($results, PW, 256);
    $seats = AesCtr::decrypt($seats, PW, 256);
    $courses = AesCtr::decrypt($courses, PW, 256);
    $contact_person = AesCtr::decrypt($contact_person, PW, 256);
    $other_details = AesCtr::decrypt($other_details, PW, 256);*/
    $sql                   = "UPDATE app_users SET 

			`firstname`= '" . $firstname . "',
			`category_id` = '" . $category_id . "',";
    $sql .= "`address` = '" . $address . "',
			`mobile` = '" . $mobile . "',
			`facility_ids`= '" . $facility_ids . "',
			`keywords`= '" . $search_keywords . "',
			`dob` = '" . date('Y-m-d', strtotime($dob)) . "',
			`facility_ids` = '" . $facility_ids . "',
			`certifications` = '" . $certifications . "',
			`year_of_establishment` = '" . $year_of_establishment . "',
			`operation_hours` = '" . $operation_hours . "',
			`training_tie_up` = '" . $training_tie_up . "',
			`map_location` = '" . $map_location . "',
			`results` = '" . $results . "',
			`seats` = '" . $seats . "',
			`description` = '" . $description . "',
			`website` = '" . $website . "',
			`courses` = '" . $courses . "',
			`contact_person` = '" . $contact_person . "',
			`newsletter` = '" . $newsletter . "',
			`other_details` = '" . $other_details . "',
			`modified_date`= '" . TODAY_DATE_TIME . "'
			WHERE user_id = '" . $edit_id . "'";
    //echo $sql;die;	
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        if (!empty($profile_photo)) {
            $profile_photo_array = array_filter(explode(',', $profile_photo));
            foreach ($profile_photo_array as $image) {
                $sql  = "INSERT INTO user_images SET `user_id`= '" . $edit_id . "',`image` = '" . $image . "' ";
                $stmt = $dbCon->prepare($sql);
                $stmt->execute();
            }
        }
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function editNotification($edit_id)
{
    global $app;
    $req                 = $app->request();
    $review_notify       = $req->params('review_notify');
    $photo_notify		 = $req->params('photo_notify');
    $follow_notify       = $req->params('follow_notify');
    $update_notify 		 = $req->params('update_notify');
    $social_notify       = $req->params('social_notify');
	
    $sql                 = "UPDATE app_users SET `review_notify`= '" . $review_notify . "',`photo_notify` = '" . $photo_notify . "',`follow_notify` = '" . $follow_notify . "',`update_notify` = '" . $update_notify . "',`social_notify` = '" . $social_notify . "' WHERE user_id = '" . $edit_id . "'";

    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user_array = array(
            'success' => '1',
			'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function editFrontUser($edit_id)
{
    global $app;
    $req                 = $app->request();
    $firstname           = $req->params('firstname');
    $lastname		     = $req->params('lastname');
    $address             = $req->params('address');
    $company 			 = $req->params('company');
    $mobile              = $req->params('mobile');
    $gender				 = $req->params('gender');
    $dob         		 = $req->params('dob');
    $newsletter          = $req->params('newsletter');
	
    $sql                 = "UPDATE app_users SET `firstname`= :firstname,`lastname` = :lastname,`address` = :address,`company` = :company,`mobile` = :mobile,`gender` = :gender,`dob` = :dob,`newsletter` = :newsletter,`modified_date`= '" . TODAY_DATE_TIME . "' WHERE user_id = '" . $edit_id . "'";
    //echo $sql;die;	 
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);

        $stmt->bindParam("firstname", $firstname);
        $stmt->bindParam("lastname", $lastname);
        $stmt->bindParam("address", $address);
        $stmt->bindParam("company", $company);
        $stmt->bindParam("mobile", $mobile);
        $stmt->bindParam("gender", $gender);
        $stmt->bindParam("dob", $dob);
        $stmt->bindParam("newsletter", $newsletter);
        
        $stmt->execute();
        $user_array = array(
            'success' => '1',
			'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function AddRegisterVendor()
{
    global $app;
    $req          = $app->request();
    $vendor_email = $req->params('vendor_email');
    $vendor_type  = $req->params('vendor_type');
    $password     = $req->params('password');
    $phone        = $req->params('phone');
    $role         = $req->params('role');
    $accept_terms = $req->params('accept_terms');
    /*********** Decrypt data ****************/
    /*$vendor_name = AesCtr::decrypt($vendor_name, PW, 256);
    $phone = AesCtr::decrypt($phone, PW, 256);
    $vendor_email = AesCtr::decrypt($vendor_email, PW, 256);
    $vendor_type = AesCtr::decrypt($vendor_type, PW, 256);
    $password = AesCtr::decrypt($password, PW, 256);*/
    $sql_query    = "SELECT email_address FROM app_users WHERE email_address='" . $vendor_email . "'";
    $sql          = "INSERT INTO app_users SET `email_address` = '" . $vendor_email . "',`category_type_id` = '" . $vendor_type . "',`phone` = '" . $phone . "', `role` = '" . $role . "',`join_date`= '" . TODAY_DATE_TIME . "',`status` = '0',`device_type` = '" . $device_type . "'";
    try {
        $dbCon              = getConnection();
        $stmt_email         = $dbCon->query($sql_query);
        $check_email_exists = $stmt_email->fetchAll(PDO::FETCH_OBJ);
        $email_count        = count($check_email_exists);
        if ($email_count < 1) {
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
            $user     = new stdClass();
            $user->id = $dbCon->lastInsertId();
            $dbCon    = null;
            if (!empty($user->id)) {
                $user_array = array(
                    'success' => '1',
                    'userid' => $user->id,
                    'sql' => $sql,
                    'sql_query' => $sql_query,
                    'counts' => $email_count
                );
            } else {
                $user_array = array(
                    'success' => '0',
                    'userid' => $user->id,
                    'sql' => $sql,
                    'sql_query' => $sql_query,
                    'counts' => $email_count
                );
            }
        } else {
            $user_array = array(
                'success' => '0',
                'userid' => $user->id,
                'sql' => $sql,
                'sql_query' => $sql_query,
                'counts' => $email_count,
                "user_exist" => 'This E-mail Already Exists'
            );
        }
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function deleteUserImageDelete($id)
{
    global $app;
    $req = $app->request();
    $sql = "SELECT image FROM user_images WHERE id = '" . $id . "'";
    try {
        $dbCon       = getConnection();
        $stmt        = $dbCon->query($sql);
        $image_array = $stmt->fetchObject();
        unlink('../' . UPLOAD_FOLDER . $image_array->image);
        $sql  = "DELETE FROM user_images WHERE `id` = '" . $id . "'";
        $stmt = $dbCon->prepare($sql);
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

function UserCheckSocial()
{
    global $app;
    $req              = $app->request();
    $username         = $req->params('username');
    $email_address    = $req->params('email_address');
    $login_type       = $req->params('login_type');
    $role             = $req->params('role');
    $category_type_id = $req->params('category_type_id');
    $uid              = $req->params('uid');
    $sql_query        = "SELECT user_id,email_address FROM app_users WHERE `email_address`='" . $email_address . "'";
    $sql              = "INSERT INTO app_users SET `role`='" . $role . "',`email_address` = '" . $email_address . "', `category_type_id`='" . $category_type_id . "'";
    try {
        $dbCon = getConnection();
        if (!empty($email_address)) {
            $stmt         = $dbCon->query($sql_query);
            $social_check = $stmt->fetchObject();
            //print_r($social_check);die;
            //$social_check_count = count($social_check);
            if (empty($social_check)) {
                $stmt_social = $dbCon->prepare($sql);
                $stmt_social->execute();
                $user_social        = new stdClass();
                $user_social        = $dbCon->lastInsertId();
                $content            = serialize($social_check);
                $encrypted          = AesCtr::encrypt($content, PW, 256);
                $review_reply_array = array(
                    'success' => '1',
                    'social_check' => $encrypted,
                    'sql_query' => $sql,
                    'counts' => $social_check_count,
                    'user_id' => $user_social,
                    'msg' => 'User Register Successfully'
                );
            } else {
                $review_reply_array = array(
                    'success' => '1',
                    'social_check' => $social_check,
                    'sql' => $sql_query,
                    'counts' => $social_check_count,
                    'msg' => 'You have already register'
                );
            }
        } else {
            $review_reply_array = array(
                'success' => '0',
                'social_check' => $encrypted,
                'counts' => $social_check_count,
                'msg' => 'Please Select Email'
            );
        }
        $dbCon = null;
        echo json_encode($review_reply_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
/*********************     Date 1/22/2016     ****************************/
function getAllcriterias()
{
    $sql_query = "SELECT s.id AS criteria_id,s.category_type,s.criteria_name,s.status,c.id,c.name FROM review_criteria AS s LEFT JOIN category_type AS c ON c.id = s.category_type ORDER BY id DESC";
    try {
        $dbCon         = getConnection();
        $stmt          = $dbCon->query($sql_query);
        $subarea       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon         = null;
        $subarea_array = array(
            'success' => '1',
            'criteria_array' => $subarea
        );
        echo json_encode($subarea_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function addReviewCriteria()
{
    global $app;
    $req           = $app->request();
    $category_type = $req->params('category_type');
    $criteriaName  = $req->params('criteriaName');
    $ratings       = $req->params('ratings');
    $status        = $req->params('status');
    $sql           = "INSERT INTO review_criteria SET 

			`category_type`= '" . $category_type . "',

			`criteria_name` = '" . $criteriaName . "' ,

			`status`= '" . $status . "'

			";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user         = new stdClass();
        $user->id     = $dbCon->lastInsertId();
        $review_array = array(
            'success' => '1',
            'sql' => $sql,
            'msg' => 'You have added a New criteria'
        );
        $dbCon        = null;
        echo json_encode($news_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getSingleCriteria($edit_id)
{
    $sql_query = "SELECT s.id AS criteria_id,s.category_type,s.criteria_name,s.status,c.id,c.name FROM review_criteria AS s LEFT JOIN category_type AS c ON c.id = s.category_type WHERE s.id=" . $edit_id;
    try {
        $dbCon         = getConnection();
        $stmt          = $dbCon->query($sql_query);
        $subarea       = $stmt->fetchObject();
        $dbCon         = null;
        $subarea_array = array(
            'success' => '1',
            'criteria_array' => $subarea
        );
        echo json_encode($subarea_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editReviews($edit_id)
{
    global $app;
    $req           = $app->request();
    $category_type = $req->params('category_type');
    $criteriaName  = $req->params('criteriaName');
    $status        = $req->params('status');
    $sql           = "UPDATE review_criteria SET 

			`category_type`= '" . $category_type . "',

			`criteria_name` = '" . $criteriaName . "' ,

			`status`= '" . $status . "' WHERE id = '" . $edit_id . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function deleteReviews($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM review_criteria WHERE `id` = '" . $id . "'";
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
function addNews()
{
    global $app;
    $req         = $app->request();
    $news_title   = $req->params('news_title');
    $news_source = $req->params('news_source');
    $news_description = $req->params('news_description');
    $user_id     = $req->params('user_id');
    $news_user_type   = $req->params('news_user_type');
    $status      = $req->params('status');
    
    $sql  = "INSERT INTO news_board SET 

			`news_user_id`= '" . $user_id . "',

			`news_user_type` = '" . $user_type . "' ,

			`news_title` = :news_title,

			`news_description` = :news_description,

			`news_source` = :news_source,

			`news_published` = '" . TODAY_DATE_TIME . "',

			`news_modified_date` = '" . TODAY_DATE_TIME . "',

			`status`= '" . $status . "'

			";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
		$stmt->bindParam("news_title", $news_title);
        $stmt->bindParam("news_description", $news_description);
        $stmt->bindParam("news_source", $news_source);

        $stmt->execute();
        $user       = new stdClass();
        $user->id   = $dbCon->lastInsertId();
        $news_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($news_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getNews($user_id)
{
    $sql_query = "SELECT nb.id,nb.news_user_id,nb.news_user_type,nb.news_title,nb.news_description,nb.news_published,nb.news_source,nb.news_modified_date,nb.status FROM news_board AS nb WHERE news_user_id = '".$user_id."' ORDER BY id DESC";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $news     		= $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        if(!empty($news)){
			$news_array = array(
				'success' => '1',
				'news_array' => $news
			);
		}else{
			$news_array = array(
				'success' => '0',
			);
		}			
        echo json_encode($news_array);

    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getNewsSingle($news_id)
{
    $sql_query = "SELECT au.id,au.news_user_id,au.news_user_type,au.news_title,au.news_description,au.news_source,au.news_published,au.news_modified_date,au.status,u.admin_id,u.username FROM news_board AS au LEFT JOIN admin_users AS u ON u.admin_id = au.news_user_id WHERE au.id = '" . $news_id . "'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $hospitals      = $stmt->fetchObject();
        $dbCon          = null;
        $hospital_array = array(
            'success' => '1',
            'newssingle_array' => $hospitals
        );
        echo json_encode($hospital_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editNews($edit_id)
{
    global $app;
    $req         = $app->request();
    $news_name   = $req->params('news_name');
    $news_source = $req->params('news_source');
    $description = $req->params('description');
    $news_date   = $req->params('news_date');
    $newsdate    = date('Y-m-d', strtotime($news_date));
    $user_id     = $req->params('user_id');
    $user_type   = $req->params('user_type');
    $status      = $req->params('status');
    $sql         = "UPDATE news_board SET 

			`news_title`= :news_name,

			`news_description` = :description ,

			`news_source` = :news_source,

			`news_published` = '" . $newsdate . "',

			`news_user_id` = '" . $user_id . "' ,

			`news_user_type` = '" . $user_type . "',

			`status` = '" . $status . "' WHERE id = '" . $edit_id . "'	

		  ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        
		$stmt->bindParam("description", $description);
        $stmt->bindParam("news_source", $news_source);
        $stmt->bindParam("news_name", $news_name);

        $stmt->execute();
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function deleteNewsBoard($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM news_board WHERE `id` = '" . $id . "'";
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
function getNewsSingleComment($news_id)
{
    $sql_query = "SELECT au.id AS comment_id,au.news_id,au.user_id,au.news_comment,au.status,au.comment_modify,au.reject,n.id,n.news_title,n.news_description,n.news_source,c.user_id ,c.firstname FROM news_comment AS au LEFT JOIN news_board AS n ON n.id = au.news_id LEFT JOIN app_users AS c ON c.user_id = au.user_id WHERE n.id = '" . $news_id . "' AND au.news_id='" . $news_id . "'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $hospitals      = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $hospital_array = array(
            'success' => '1',
            'newscomment_array' => $hospitals
        );
        echo json_encode($hospital_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getSingleComment($news_id)
{
    $sql_query = "SELECT au.id AS comment_id,au.news_id,au.user_id,au.ratings,au.news_comment,au.status,au.comment_modify,au.reject,n.id,n.news_title,n.news_description,n.news_source FROM news_comment AS au LEFT JOIN news_board AS n ON n.id = au.news_id WHERE au.id='" . $news_id . "'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $hospitals      = $stmt->fetchObject();
        $dbCon          = null;
        $hospital_array = array(
            'success' => '1',
            'newssingle_array' => $hospitals
        );
        echo json_encode($hospital_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editNewsComment($edit_id)
{
    global $app;
    $req            = $app->request();
    $news_id        = $req->params('news_id');
    $comment_id     = $req->params('comment_id');
    $comment        = $req->params('comment');
    $rates          = $req->params('rates');
    $comment_status = $req->params('comment_status');
    $status         = $req->params('status');
    $edit_id        = $req->params('comment_id');
    $sql            = "UPDATE news_comment SET `news_id`= '" . $news_id . "',`news_comment` = '" . $news_comment . "',`news_comment` = '" . $comment . "',`ratings` = '" . $rates . "',`reject` = '" . $comment_status . "',`status` = '" . $status . "' WHERE id = '" . $edit_id . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function deleteNewsBoardComment($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM news_comment WHERE `id` = '" . $id . "'";
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
function getSingleUsercom($news_id)
{
    $sql_query = "SELECT * FROM app_users";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $hospitals      = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $hospital_array = array(
            'success' => '1',
            'usercomment_array' => $hospitals
        );
        echo json_encode($hospital_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function addUserComment()
{
    global $app;
    $req               = $app->request();
    $user_id           = $req->params('user_id');
    $user_type         = $req->params('user_type');
    $description       = $req->params('description');
    $user_comment_id   = $req->params('user_comment_id');
    $user_comment_type = $req->params('user_comment_type');
    $status            = $req->params('status');
    $sql               = "INSERT INTO user_review SET 

			`user_type_id`= '" . $user_id . "',

			`user_id` = '" . $user_type . "' ,

			`comment` = '" . $description . "',

			`user_comment_id` = '" . $user_comment_id . "',

			`user_comment_type` = '" . $user_comment_type . "',

			`status`= '" . $status . "'

			";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user       = new stdClass();
        $user->id   = $dbCon->lastInsertId();
        $news_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($news_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function GetUserComment()
{
    $sql_query = "SELECT au.id AS review_id, au.user_id,au.comment, au.vendor_id AS vendor_id,k.firstname AS vendor_name,k.user_id, au.comment_published, au.comment_modify, au.status, u.user_id, u.firstname, u.lastname FROM user_review au LEFT JOIN app_users k ON k.user_id = au.vendor_id LEFT JOIN app_users u ON u.user_id = au.user_id";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $hospitals      = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $hospital_array = array(
            'success' => '1',
            'usercomment_array' => $hospitals
        );
        echo json_encode($hospital_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getSingleUserComment($news_id)
{
    $sql_query = "SELECT au.id AS review_id, au.user_id, au.vendor_id AS vendor_id, k.firstname AS vendor_name,k.user_id, au.comment, au.comment_published, au.comment_modify, au.status, u.user_id, u.firstname, u.lastname FROM user_review au LEFT JOIN app_users k ON k.user_id = au.vendor_id LEFT JOIN app_users u ON u.user_id = au.user_id WHERE au.id='" . $news_id . "'";
    try {
        $dbCon                 = getConnection();
        $stmt                  = $dbCon->query($sql_query);
        $hospitals             = $stmt->fetchObject();
        $vendor_id             = $hospitals->vendor_id;
        $sql                   = "SELECT *, c.id AS review_id FROM user_ratings ur LEFT JOIN review_criteria c ON c.id=ur.review_criteria_id WHERE vendor_id=" . $vendor_id;
        $stmts                 = $dbCon->query($sql);
        $user_criteria_ratings = $stmts->fetchAll(PDO::FETCH_OBJ);
        $dbCon                 = null;
        $hospital_array        = array(
            'success' => '1',
            'newssingle_array' => $hospitals,
            'user_criteria_ratings' => $user_criteria_ratings
        );
        echo json_encode($hospital_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editUsersComment($edit_id)
{
    global $app;
    $req                 = $app->request();
    $ratings             = $req->params('ratings');
    $review_criteria_id  = $req->params('category_ids');
    $description         = $req->params('description');
    $vendor_id           = $req->params('vendor_id');
    $user_id             = $req->params('user_id');
    $status              = $req->params('status');
    $review_criteria_ids = explode(',', $review_criteria_id);
    $allratings          = explode(',', $ratings);
    $allrateslen         = count($categories);
    try {
        $dbCon = getConnection();
        $i     = 0;
        foreach ($review_criteria_ids as $review_criteria) {
            $sql  = "UPDATE user_ratings SET `ratings`= '" . $allratings[$i] . "' WHERE review_criteria_id = '" . $review_criteria_ids[$i] . "' AND vendor_id='" . $vendor_id . "'";
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
            $i++;
        }
        $sql_query = "UPDATE user_review SET `comment`='" . $description . "',`status`='" . $status . "' WHERE id='" . $edit_id . "'";
        $stmt      = $dbCon->prepare($sql_query);
        $stmt->execute();
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function deleteUserComment($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM user_review WHERE `id` = '" . $id . "'";
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
function SubstituteModerator()
{
    global $app;
    $req          = $app->request();
    $assigned_id  = $req->params('assigned_id');
    $assigning_id = $req->params('assigning_id');
    $dates        = $req->params('dates');
    $datesexp     = explode("-", $dates);
    $start_date   = $datesexp[0];
    $newStartDate = date("Y-m-d", strtotime(str_replace('/', '-', $start_date)));
    $end_date     = $datesexp[1];
    $newEndDate   = date("Y-m-d", strtotime(str_replace('/', '-', $end_date)));
    $status       = $req->params('status');
    $sql          = "INSERT INTO substitute_moderator SET 

			`assigning_id`= '" . $assigning_id . "',

			`assigned_id` = '" . $assigned_id . "' ,

			`start_date` = '" . $newStartDate . "',

			`end_date` = '" . $newEndDate . "',

			`status`= '" . $status . "'

			";
    try {
        $dbCon         = getConnection();
        $sql_query     = "SELECT * FROM substitute_moderator WHERE assigned_id='" . $assigned_id . "' AND start_date BETWEEN '" . $newStartDate . "' AND '" . $newEndDate . "' OR end_date BETWEEN '" . $newStartDate . "' AND '" . $newEndDate . "' ";
        $stmt          = $dbCon->query($sql_query);
        $allreadyadded = $stmt->fetchAll(PDO::FETCH_OBJ);
        $num_rows      = count($allreadyadded);
        if ($num_rows > 0) {
            $news_array = array(
                'success' => '0',
                'msg' => 'You have already assigned a moderator for this date range',
                'numofrows' => $num_rows
            );
        } else {
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
            $user       = new stdClass();
            $user->id   = $dbCon->lastInsertId();
            $news_array = array(
                'success' => '1',
                'sql' => $sql
            );
        }
        $dbCon = null;
        echo json_encode($news_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function editsubstitutesmoderator($edit_id)
{
    global $app;
    $req          = $app->request();
    $assigned_id  = $req->params('assigned_id');
    $assigning_id = $req->params('assigning_id');
    $dates        = $req->params('dates');
    $datesexp     = explode("-", $dates);
    $start_date   = $datesexp[0];
    $newStartDate = date("Y-m-d", strtotime($start_date));
    $end_date     = $datesexp[1];
    $newEndDate   = date("Y-m-d", strtotime($end_date));
    $status       = $req->params('status');
    $sql          = "UPDATE substitute_moderator SET 

			`assigning_id`= '" . $assigning_id . "',

			`assigned_id` = '" . $assigned_id . "' ,

			`start_date` = '" . $newStartDate . "',

			`end_date` = '" . $newEndDate . "',

			`status`= '" . $status . "' WHERE id='" . $edit_id . "'";
    try {
        $dbCon         = getConnection();
        $sql_query     = "SELECT * FROM substitute_moderator WHERE assigned_id='" . $assigned_id . "' AND start_date BETWEEN '" . $newStartDate . "' AND '" . $newEndDate . "' OR end_date BETWEEN '" . $newStartDate . "' AND '" . $newEndDate . "'";
        $stmt          = $dbCon->query($sql_query);
        $allreadyadded = $stmt->fetchAll(PDO::FETCH_OBJ);
        $num_rows      = count($allreadyadded);
        if ($num_rows > 0) {
            $news_array = array(
                'success' => '0',
                'msg' => 'You Have Already Assigned In Between Time',
                'numofrows' => $num_rows
            );
        } else {
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
            $user       = new stdClass();
            $user->id   = $dbCon->lastInsertId();
            $news_array = array(
                'success' => '1',
                'sql' => $sql,
                'msg' => 'You Have Assigned User to Access'
            );
        }
        $dbCon = null;
        echo json_encode($news_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getSingleUsers($user_id)
{
    $sql_query = "SELECT user_id,firstname,lastname,email_address,join_date,role,status FROM app_users WHERE user_id=" . $user_id;
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchObject();
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'user_array' => $users
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getSingleUserModerator($user_id)
{
    $sql_query = "SELECT sa.id,sa.assigning_id,sa.assigned_id,sa.start_date,sa.end_date,ap.user_id,ap.firstname,ap.lastname,ap.email_address FROM substitute_moderator sa LEFT JOIN app_users ap ON sa.assigned_id=ap.user_id WHERE sa.assigning_id=" . $user_id;
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'assigned_array' => $users
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getSingleModerator($user_id)
{
    $sql_query = "SELECT sa.id,sa.assigning_id,sa.assigned_id,sa.start_date,sa.end_date,sa.status,ap.user_id,ap.firstname,ap.lastname,ap.email_address FROM substitute_moderator sa LEFT JOIN app_users ap ON sa.assigned_id=ap.user_id WHERE sa.id=" . $user_id;
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchObject();
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'assigned_array' => $users
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getSingleProfile($profile_id)
{
    $sql_query = "SELECT * FROM app_users WHERE user_id = '" . $profile_id . "'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $hospitals      = $stmt->fetchObject();
        $dbCon          = null;
        $hospital_array = array(
            'success' => '1',
            'newssingle_array' => $hospitals
        );
        echo json_encode($hospital_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editProfile($edit_id)
{
    global $app;
    $req       = $app->request();
    $firstname = $req->params('firstname');
    $lastname  = $req->params('lastname');
    $gender    = $req->params('gender');
    $dob       = $req->params('dob');
    $address   = $req->params('address');
    $company   = $req->params('company');
    $mobile    = $req->params('mobile');
    $sql       = "UPDATE app_users SET 

				`firstname`= '" . $firstname . "',

				`lastname`= '" . $lastname . "',

				`gender`= '" . $gender . "',

				`dob`= '" . $dob . "',

				`address`= '" . $address . "',

				`company`= '" . $company . "',

				`mobile`= '" . $mobile . "'

				WHERE user_id = '" . $edit_id . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function editProfileChangePassword($edit_id)
{
    global $app;
    $req              = $app->request();
    $current_password = $req->params('current_password');
    $password         = $req->params('newpassword');
    $sql_query        = "SELECT * FROM app_users WHERE user_id='" . $edit_id . "' AND password='" . md5($current_password) . "'";
    $sql              = "UPDATE app_users SET `password`= '" . md5($password) . "' WHERE user_id = '" . $edit_id . "'";
    try {
        $dbCon     = getConnection();
        $stmt      = $dbCon->query($sql_query);
        $hospitals = $stmt->fetchAll(PDO::FETCH_OBJ);
        $num_rows  = count($hospitals);
        if ($num_rows == 0) {
            $user_array = array(
                'success' => '0',
                'msg' => 'Please enter correct password',
                'sql' => $sql_query
            );
            echo json_encode($user_array);
        } else {
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
            $user_array = array(
                'success' => '1',
                'sql' => $sql
            );
            $dbCon      = null;
            echo json_encode($user_array);
        }
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function deleteSubstituteModerator($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM substitute_moderator WHERE `id` = '" . $id . "'";
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
/************************** ADDED BY SUNIL ************/
function updateNewsletterStatus($user_id, $status)
{
    $sql = "UPDATE app_users SET `newsletter`= '" . $status . "'  WHERE `user_id`= '" . $user_id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $status = new stdClass();
        $dbCon  = null;
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function deleteMessage($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM message_templates WHERE `id` = '" . $id . "'";
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
function getSingleMessage($id)
{
    $sql_query = "SELECT * FROM message_templates  WHERE id = '" . $id . "'";
    try {
        $dbCon         = getConnection();
        $stmt          = $dbCon->query($sql_query);
        $message       = $stmt->fetchObject();
        $dbCon         = null;
        $message_array = array(
            'success' => '1',
            'message_array' => $message
        );
        echo json_encode($message_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editMessage($edit_id)
{
    global $app;
    $req             = $app->request();
    $message_subject = $req->params('message_subject');
    $message_text    = $req->params('message_text');
    $schedule_date   = $req->params('schedule_date');
    //$message_for = create_url_slug($message_subject);
    $sql             = "UPDATE message_templates SET `message_subject`= '" . $message_subject . "',`message_text` = '" . $message_text . "',`schedule_date` = '" . $schedule_date . "' WHERE id = '" . $edit_id . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $message_array = array(
            'success' => '1'
        );
        $dbCon         = null;
        echo json_encode($message_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getMessages($message_type)
{
    $sql_query = "SELECT * FROM message_templates WHERE message_type = '" . $message_type . "' ORDER BY id DESC";
    try {
        $dbCon         = getConnection();
        $stmt          = $dbCon->query($sql_query);
        $emails        = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon         = null;
        $message_array = array(
            'success' => '1',
            'message_array' => $emails
        );
        echo json_encode($message_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function addMessage()
{
    global $app;
    $req             = $app->request();
    $message_subject = $req->params('message_subject');
    $message_text    = $req->params('message_text');
    $message_type    = $req->params('message_type');
    $schedule_date   = $req->params('schedule_date');
    $message_for     = create_url_slug($message_subject);
    $sql             = "INSERT INTO message_templates SET `message_for`= '" . $message_for . "',`message_subject`= '" . $message_subject . "',`message_text` = '" . $message_text . "',`message_type` = '" . $message_type . "',`schedule_date` = '" . $schedule_date . "' ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $email     = new stdClass();
        $email->id = $dbCon->lastInsertId();
        if (!empty($email->id)) {
            $message_array = array(
                'success' => '1'
            );
        } else {
            $message_array = array(
                'success' => '0'
            );
        }
        $dbCon = null;
        echo json_encode($message_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function addEducation()
{
    global $app;
    $req                   = $app->request();
    $firstname             = $req->params('firstname');
    $category_id           = $req->params('category_id');
    $profile_photo         = $req->params('profile_photo');
    $keywords              = $req->params('keywords');
    $description           = $req->params('description');
    $year_of_establishment = $req->params('year_of_establishment');
    $address               = $req->params('address');
    $current_location_id   = $req->params('current_location_id');
    $subarea_id            = $req->params('subarea_id');
    $map_location          = $req->params('map_location');
    $certifications        = $req->params('certifications');
    $training_tie_up       = $req->params('training_tie_up');
    $results               = $req->params('results');
    $seats                 = $req->params('seats');
    $courses               = $req->params('courses');
    $facility_ids          = $req->params('facility_ids');
    $website               = $req->params('website');
    $mobile                = $req->params('mobile');
    $phone                 = $req->params('phone');
    $contact_person        = $req->params('contact_person');
    $status                = $req->params('status');
    $other_details         = $req->params('other_details');
    $sql                   = "INSERT INTO app_users SET 

			`firstname`= '" . $firstname . "',

			`category_id` = '" . $category_id . "' ,

			`keywords` = '" . $keywords . "',

			`description` = '" . $description . "',

			`year_of_establishment` = '" . $year_of_establishment . "',

			`address` = '" . $address . "',

			`current_location_id`= '" . $current_location_id . "',

			`subarea_id` = '" . $subarea_id . "' ,

			`map_location` = '" . $map_location . "',

			`certifications`= '" . $certifications . "',

			`training_tie_up` = '" . $training_tie_up . "',

			`results` = '" . $results . "',

			`seats` = '" . $seats . "',

			`courses` = '" . $courses . "',

			`facility_ids` = '" . $facility_ids . "',

			`website` = '" . $website . "',

			`mobile` = '" . $mobile . "',

			`phone` = '" . $phone . "',

			`contact_person` = '" . $contact_person . "',

			`other_details` = '" . $other_details . "',

			`status` = '" . $status . "',

			`category_type_id` = '" . EDU_CENTER_ID . "',

			`join_date`= '" . TODAY_DATE_TIME . "',

			`device_type`= 'web',

			`modified_date`= '" . TODAY_DATE_TIME . "',

			`role`= 'Vendor',

			`login_type` = 'email'

		  ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user     = new stdClass();
        $user->id = $dbCon->lastInsertId();
        if (!empty($user->id)) {
            if (!empty($profile_photo)) {
                $profile_photo_array = array_filter(explode(',', $profile_photo));
                foreach ($profile_photo_array as $image) {
                    $sql  = "INSERT INTO user_images SET `user_id`= '" . $user->id . "',`image` = '" . $image . "' ";
                    $stmt = $dbCon->prepare($sql);
                    $stmt->execute();
                }
            }
            $user_array = array(
                'success' => '1',
                'sql' => $sql
            );
        } else {
            $user_array = array(
                'success' => '0',
                'sql' => $sql
            );
        }
        $dbCon = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getSingleEducation($user_id)
{
    $sql_query = "SELECT user_id,firstname,category_id,profile_photo,keywords,description,year_of_establishment,address,current_location_id,subarea_id,map_location,training_tie_up,courses,seats,results,facility_ids,certifications,website,mobile,phone,contact_person,status,other_details FROM app_users  WHERE category_type_id = '" . EDU_CENTER_ID . "' AND user_id = '" . $user_id . "' ORDER BY user_id DESC";
    try {
        $dbCon     = getConnection();
        $stmt      = $dbCon->query($sql_query);
        $education = $stmt->fetchObject();
        if (!empty($education)) {
            $sql                    = "SELECT id,image FROM user_images WHERE user_id = '" . $user_id . "' ORDER BY id DESC";
            $stmt                   = $dbCon->query($sql);
            $image                  = $stmt->fetchAll(PDO::FETCH_OBJ);
            $education->image_array = $image;
        } else {
            $education->image_array = array();
        }
        $dbCon           = null;
        $education_array = array(
            'success' => '1',
            'education_array' => $education
        );
        echo json_encode($education_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editEducation($edit_id)
{
    global $app;
    $req                   = $app->request();
    $firstname             = $req->params('firstname');
    $category_id           = $req->params('category_id');
    $profile_photo         = $req->params('profile_photo');
    $keywords              = $req->params('keywords');
    $description           = $req->params('description');
    $year_of_establishment = $req->params('year_of_establishment');
    $address               = $req->params('address');
    $current_location_id   = $req->params('current_location_id');
    $subarea_id            = $req->params('subarea_id');
    $map_location          = $req->params('map_location');
    $operation_hours       = $req->params('operation_hours');
    $facility_ids          = $req->params('facility_ids');
    $certifications        = $req->params('certifications');
    $website               = $req->params('website');
    $mobile                = $req->params('mobile');
    $phone                 = $req->params('phone');
    $contact_person        = $req->params('contact_person');
    $status                = $req->params('status');
    $other_details         = $req->params('other_details');
    $profile_photo         = $req->params('profile_photo');
    $sql                   = "UPDATE app_users SET 

			`firstname`= '" . $firstname . "',

			`category_id` = '" . $category_id . "' ,

			`keywords` = '" . $keywords . "',

			`description` = '" . $description . "',

			`year_of_establishment` = '" . $year_of_establishment . "',

			`address` = '" . $address . "',

			`current_location_id`= '" . $current_location_id . "',

			`subarea_id` = '" . $subarea_id . "' ,

			`map_location` = '" . $map_location . "',

			`operation_hours` = '" . $operation_hours . "',

			`facility_ids` = '" . $facility_ids . "',

			`certifications`= '" . $certifications . "',

			`website` = '" . $website . "',

			`mobile` = '" . $mobile . "',

			`phone` = '" . $phone . "',

			`contact_person` = '" . $contact_person . "',

			`other_details` = '" . $other_details . "',

			`status` = '" . $status . "',

			`modified_date`= '" . TODAY_DATE_TIME . "'

			WHERE user_id = '" . $edit_id . "'	

		  ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        if (!empty($profile_photo)) {
            $profile_photo_array = array_filter(explode(',', $profile_photo));
            foreach ($profile_photo_array as $image) {
                $sql  = "INSERT INTO user_images SET `user_id`= '" . $edit_id . "',`image` = '" . $image . "' ";
                $stmt = $dbCon->prepare($sql);
                $stmt->execute();
            }
        }
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getEducation()
{
    $sql_query = "SELECT au.user_id,au.firstname,au.join_date,au.status,c.category_name AS specialty FROM app_users AS au LEFT JOIN category AS c ON c.id = au.category_id WHERE category_type_id = '" . EDU_CENTER_ID . "' ORDER BY user_id DESC";
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'user_array' => $users
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function deleteKeywords($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM frequent_keywords WHERE `id` = '" . $id . "'";
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
function getSingleKeywords($id)
{
    $sql_query = "SELECT * FROM frequent_keywords  WHERE id = '" . $id . "'";
    try {
        $dbCon    = getConnection();
        $stmt     = $dbCon->query($sql_query);
        $keywords = $stmt->fetchObject();
        $dbCon    = null;
        if (empty($keywords))
            $keywords_array = array(
                'success' => '0'
            );
        else
            $keywords_array = array(
                'success' => '1',
                'keywords_array' => $keywords
            );
        echo json_encode($keywords_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editKeywords($edit_id)
{
    global $app;
    $req               = $app->request();
    $display_text      = $req->params('display_text');
    $is_global         = $req->params('is_global');
    $category_ids      = $req->params('category_ids');
    $category_type_ids = $req->params('category_type_ids');
    $keywords          = $req->params('keywords');
    $sql               = "UPDATE frequent_keywords SET 

			`display_text`= '" . $display_text . "',

			`is_global` = '" . $is_global . "' ,

			`category_ids` = '" . $category_ids . "',

			`category_type_ids` = '" . $category_type_ids . "',

			`keywords` = '" . $keywords . "'

			WHERE id = '" . $edit_id . "'	

		  ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $response = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon    = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getKeywordsAll()
{
    $sql_query = "SELECT id,display_text,keywords FROM frequent_keywords ORDER BY id DESC";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $keywords       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $keywords_array = array(
            'success' => '1',
            'keywords_array' => $keywords
        );
        echo json_encode($keywords_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function addKeywords()
{
    global $app;
    $req               = $app->request();
    $display_text      = $req->params('display_text');
    $is_global         = $req->params('is_global');
    $category_ids      = $req->params('category_ids');
    $category_type_ids = $req->params('category_type_ids');
    $keywords          = $req->params('keywords');
    $sql               = "INSERT INTO frequent_keywords SET 

			`display_text`= '" . $display_text . "',

			`is_global` = '" . $is_global . "' ,

			`category_ids` = '" . $category_ids . "',

			`category_type_ids` = '" . $category_type_ids . "',

			`keywords` = '" . $keywords . "'

		  ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $keyword     = new stdClass();
        $keyword->id = $dbCon->lastInsertId();
        if (!empty($keyword->id)) {
            $response = array(
                'success' => '1'
            );
        } else {
            $response = array(
                'success' => '0'
            );
        }
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function addHealthService()
{
    global $app;
    $req                   = $app->request();
    $firstname             = $req->params('firstname');
    $category_id           = $req->params('category_id');
    $profile_photo         = $req->params('profile_photo');
    $keywords              = $req->params('keywords');
    $description           = $req->params('description');
    $year_of_establishment = $req->params('year_of_establishment');
    $address               = $req->params('address');
    $current_location_id   = $req->params('current_location_id');
    $subarea_id            = $req->params('subarea_id');
    $map_location          = $req->params('map_location');
    $operation_hours       = $req->params('operation_hours');
    $facility_ids          = $req->params('facility_ids');
    $certifications        = $req->params('certifications');
    $website               = $req->params('website');
    $mobile                = $req->params('mobile');
    $phone                 = $req->params('phone');
    $contact_person        = $req->params('contact_person');
    $status                = $req->params('status');
    $other_details         = $req->params('other_details');
    $profile_photo         = $req->params('profile_photo');
    $sql                   = "INSERT INTO app_users SET 

			`firstname`= '" . $firstname . "',

			`category_id` = '" . $category_id . "' ,

			`keywords` = '" . $keywords . "',

			`description` = '" . $description . "',

			`year_of_establishment` = '" . $year_of_establishment . "',

			`address` = '" . $address . "',

			`current_location_id`= '" . $current_location_id . "',

			`subarea_id` = '" . $subarea_id . "' ,

			`map_location` = '" . $map_location . "',

			`operation_hours` = '" . $operation_hours . "',

			`facility_ids` = '" . $facility_ids . "',

			`certifications`= '" . $certifications . "',

			`website` = '" . $website . "',

			`mobile` = '" . $mobile . "',

			`phone` = '" . $phone . "',

			`contact_person` = '" . $contact_person . "',

			`other_details` = '" . $other_details . "',

			`status` = '" . $status . "',

			`category_type_id` = '" . HEALTH_SERVICES_ID . "',

			`join_date`= '" . TODAY_DATE_TIME . "',

			`device_type`= 'web',

			`modified_date`= '" . TODAY_DATE_TIME . "',

			`role`= 'Vendor',

			`login_type` = 'email'

		  ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user     = new stdClass();
        $user->id = $dbCon->lastInsertId();
        if (!empty($user->id)) {
            if (!empty($profile_photo)) {
                $profile_photo_array = array_filter(explode(',', $profile_photo));
                foreach ($profile_photo_array as $image) {
                    $sql  = "INSERT INTO user_images SET `user_id`= '" . $user->id . "',`image` = '" . $image . "' ";
                    $stmt = $dbCon->prepare($sql);
                    $stmt->execute();
                }
            }
            $user_array = array(
                'success' => '1',
                'sql' => $sql
            );
        } else {
            $user_array = array(
                'success' => '0',
                'sql' => $sql
            );
        }
        $dbCon = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getSingleHealthService($user_id)
{
    $sql_query = "SELECT user_id,firstname,category_id,profile_photo,keywords,description,year_of_establishment,address,current_location_id,subarea_id,map_location,operation_hours,facility_ids,certifications,website,mobile,phone,contact_person,status,other_details FROM app_users  WHERE category_type_id = '" . HEALTH_SERVICES_ID . "' AND user_id = '" . $user_id . "' ORDER BY user_id DESC";
    try {
        $dbCon     = getConnection();
        $stmt      = $dbCon->query($sql_query);
        $hospitals = $stmt->fetchObject();
        if (!empty($hospitals)) {
            $sql                    = "SELECT id,image FROM user_images WHERE user_id = '" . $user_id . "' ORDER BY id DESC";
            $stmt                   = $dbCon->query($sql);
            $image                  = $stmt->fetchAll(PDO::FETCH_OBJ);
            $hospitals->image_array = $image;
        } else {
            $hospitals->image_array = array();
        }
        $dbCon          = null;
        $hospital_array = array(
            'success' => '1',
            'hospital_array' => $hospitals
        );
        echo json_encode($hospital_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editHealthService($edit_id)
{
    global $app;
    $req                   = $app->request();
    $firstname             = $req->params('firstname');
    $category_id           = $req->params('category_id');
    $profile_photo         = $req->params('profile_photo');
    $keywords              = $req->params('keywords');
    $description           = $req->params('description');
    $year_of_establishment = $req->params('year_of_establishment');
    $address               = $req->params('address');
    $current_location_id   = $req->params('current_location_id');
    $subarea_id            = $req->params('subarea_id');
    $map_location          = $req->params('map_location');
    $operation_hours       = $req->params('operation_hours');
    $facility_ids          = $req->params('facility_ids');
    $certifications        = $req->params('certifications');
    $website               = $req->params('website');
    $mobile                = $req->params('mobile');
    $phone                 = $req->params('phone');
    $contact_person        = $req->params('contact_person');
    $status                = $req->params('status');
    $other_details         = $req->params('other_details');
    $profile_photo         = $req->params('profile_photo');
    $sql                   = "UPDATE app_users SET 

			`firstname`= '" . $firstname . "',

			`category_id` = '" . $category_id . "' ,

			`keywords` = '" . $keywords . "',

			`description` = '" . $description . "',

			`year_of_establishment` = '" . $year_of_establishment . "',

			`address` = '" . $address . "',

			`current_location_id`= '" . $current_location_id . "',

			`subarea_id` = '" . $subarea_id . "' ,

			`map_location` = '" . $map_location . "',

			`operation_hours` = '" . $operation_hours . "',

			`facility_ids` = '" . $facility_ids . "',

			`certifications`= '" . $certifications . "',

			`website` = '" . $website . "',

			`mobile` = '" . $mobile . "',

			`phone` = '" . $phone . "',

			`contact_person` = '" . $contact_person . "',

			`other_details` = '" . $other_details . "',

			`status` = '" . $status . "',

			`modified_date`= '" . TODAY_DATE_TIME . "'

			WHERE user_id = '" . $edit_id . "'	

		  ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        if (!empty($profile_photo)) {
            $profile_photo_array = array_filter(explode(',', $profile_photo));
            foreach ($profile_photo_array as $image) {
                $sql  = "INSERT INTO user_images SET `user_id`= '" . $edit_id . "',`image` = '" . $image . "' ";
                $stmt = $dbCon->prepare($sql);
                $stmt->execute();
            }
        }
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getHealthServices()
{
    $sql_query = "SELECT au.user_id,au.firstname,au.join_date,au.status,c.category_name AS specialty FROM app_users AS au LEFT JOIN category AS c ON c.id = au.category_id WHERE category_type_id = '" . HEALTH_SERVICES_ID . "' ORDER BY user_id DESC";
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'user_array' => $users
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function deleteUserImage($id)
{
    global $app;
    $req = $app->request();
    $sql = "SELECT image FROM user_images WHERE id = '" . $id . "'";
    try {
        $dbCon       = getConnection();
        $stmt        = $dbCon->query($sql);
        $image_array = $stmt->fetchObject();
        unlink('../' . UPLOAD_FOLDER . $image_array->image);
        $sql  = "DELETE FROM user_images WHERE `id` = '" . $id . "'";
        $stmt = $dbCon->prepare($sql);
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
function addHospital()
{
    global $app;
    $req                   = $app->request();
    $firstname             = $req->params('firstname');
    $category_id           = $req->params('category_id');
    $profile_photo         = $req->params('profile_photo');
    $keywords              = $req->params('keywords');
    $description           = $req->params('description');
    $beds                  = $req->params('beds');
    $year_of_establishment = $req->params('year_of_establishment');
    $address               = $req->params('address');
    $current_location_id   = $req->params('current_location_id');
    $subarea_id            = $req->params('subarea_id');
    $map_location          = $req->params('map_location');
    $operation_hours       = $req->params('operation_hours');
    $facility_ids          = $req->params('facility_ids');
    $certifications        = $req->params('certifications');
    $website               = $req->params('website');
    $media_claim_facility  = $req->params('media_claim_facility');
    $mobile                = $req->params('mobile');
    $phone                 = $req->params('phone');
    $contact_person        = $req->params('contact_person');
    $status                = $req->params('status');
    $other_details         = $req->params('other_details');
    $profile_photo         = $req->params('profile_photo');
    $sql                   = "INSERT INTO app_users SET 

			`firstname`= '" . $firstname . "',

			`category_id` = '" . $category_id . "' ,

			`keywords` = '" . $keywords . "',

			`description` = '" . $description . "',

			`beds` = '" . $beds . "',

			`year_of_establishment` = '" . $year_of_establishment . "',

			`address` = '" . $address . "',

			`current_location_id`= '" . $current_location_id . "',

			`subarea_id` = '" . $subarea_id . "' ,

			`map_location` = '" . $map_location . "',

			`operation_hours` = '" . $operation_hours . "',

			`facility_ids` = '" . $facility_ids . "',

			`certifications`= '" . $certifications . "',

			`website` = '" . $website . "',

			`media_claim_facility` = '" . $media_claim_facility . "' ,

			`mobile` = '" . $mobile . "',

			`phone` = '" . $phone . "',

			`contact_person` = '" . $contact_person . "',

			`other_details` = '" . $other_details . "',

			`status` = '" . $status . "',

			`category_type_id` = '" . CLINIC_HOSPITAL_ID . "',

			`join_date`= '" . TODAY_DATE_TIME . "',

			`device_type`= 'web',

			`modified_date`= '" . TODAY_DATE_TIME . "',

			`role`= 'Vendor',

			`login_type` = 'email'

		  ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user     = new stdClass();
        $user->id = $dbCon->lastInsertId();
        if (!empty($user->id)) {
            if (!empty($profile_photo)) {
                $profile_photo_array = array_filter(explode(',', $profile_photo));
                foreach ($profile_photo_array as $image) {
                    $sql  = "INSERT INTO user_images SET `user_id`= '" . $user->id . "',`image` = '" . $image . "' ";
                    $stmt = $dbCon->prepare($sql);
                    $stmt->execute();
                }
            }
            $user_array = array(
                'success' => '1',
                'sql' => $sql
            );
        } else {
            $user_array = array(
                'success' => '0',
                'sql' => $sql
            );
        }
        $dbCon = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getSingleHospital($user_id)
{
    $sql_query = "SELECT user_id,firstname,category_id,profile_photo,keywords,description,beds,year_of_establishment,address,current_location_id,subarea_id,map_location,operation_hours,facility_ids,certifications,website,media_claim_facility,mobile,phone,contact_person,status,other_details FROM app_users  WHERE category_type_id = '" . CLINIC_HOSPITAL_ID . "' AND user_id = '" . $user_id . "' ORDER BY user_id DESC";
    try {
        $dbCon     = getConnection();
        $stmt      = $dbCon->query($sql_query);
        $hospitals = $stmt->fetchObject();
        if (!empty($hospitals)) {
            $sql                    = "SELECT id,image FROM user_images WHERE user_id = '" . $user_id . "' ORDER BY id DESC";
            $stmt                   = $dbCon->query($sql);
            $image                  = $stmt->fetchAll(PDO::FETCH_OBJ);
            $hospitals->image_array = $image;
        } else {
            $hospitals->image_array = array();
        }
        $dbCon          = null;
        $hospital_array = array(
            'success' => '1',
            'hospital_array' => $hospitals
        );
        echo json_encode($hospital_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function deleteHospital($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM app_users WHERE `user_id` = '" . $id . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $sql         = "SELECT id,image FROM user_images WHERE user_id = '" . $id . "'";
        $stmt        = $dbCon->query($sql);
        $image_array = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($image_array)) {
            foreach ($image_array as $image_value) {
                unlink('../' . UPLOAD_FOLDER . $image_value->image);
                $sql  = "DELETE FROM user_images WHERE `id` = '" . $image_value->id . "'";
                $stmt = $dbCon->prepare($sql);
                $stmt->execute();
            }
        }
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
function getHospitals()
{
    $sql_query = "SELECT au.user_id,au.firstname,au.join_date,au.status,c.category_name AS specialty FROM app_users AS au LEFT JOIN category AS c ON c.id = au.category_id WHERE category_type_id = '" . CLINIC_HOSPITAL_ID . "' ORDER BY user_id DESC";
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'user_array' => $users
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editHospital($edit_id)
{
    global $app;
    $req                   = $app->request();
    $firstname             = $req->params('firstname');
    $category_id           = $req->params('category_id');
    $profile_photo         = $req->params('profile_photo');
    $keywords              = $req->params('keywords');
    $description           = $req->params('description');
    $beds                  = $req->params('beds');
    $year_of_establishment = $req->params('year_of_establishment');
    $address               = $req->params('address');
    $current_location_id   = $req->params('current_location_id');
    $subarea_id            = $req->params('subarea_id');
    $map_location          = $req->params('map_location');
    $operation_hours       = $req->params('operation_hours');
    $facility_ids          = $req->params('facility_ids');
    $certifications        = $req->params('certifications');
    $website               = $req->params('website');
    $media_claim_facility  = $req->params('media_claim_facility');
    $mobile                = $req->params('mobile');
    $phone                 = $req->params('phone');
    $contact_person        = $req->params('contact_person');
    $status                = $req->params('status');
    $other_details         = $req->params('other_details');
    $profile_photo         = $req->params('profile_photo');
    $sql                   = "UPDATE app_users SET 

			`firstname`= '" . $firstname . "',

			`category_id` = '" . $category_id . "' ,

			`keywords` = '" . $keywords . "',

			`description` = '" . $description . "',

			`beds` = '" . $beds . "',

			`year_of_establishment` = '" . $year_of_establishment . "',

			`address` = '" . $address . "',

			`current_location_id`= '" . $current_location_id . "',

			`subarea_id` = '" . $subarea_id . "' ,

			`map_location` = '" . $map_location . "',

			`operation_hours` = '" . $operation_hours . "',

			`facility_ids` = '" . $facility_ids . "',

			`certifications`= '" . $certifications . "',

			`website` = '" . $website . "',

			`media_claim_facility` = '" . $media_claim_facility . "' ,

			`mobile` = '" . $mobile . "',

			`phone` = '" . $phone . "',

			`contact_person` = '" . $contact_person . "',

			`other_details` = '" . $other_details . "',

			`status` = '" . $status . "',

			`modified_date`= '" . TODAY_DATE_TIME . "'

			WHERE user_id = '" . $edit_id . "'	

		  ";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        if (!empty($profile_photo)) {
            $profile_photo_array = array_filter(explode(',', $profile_photo));
            foreach ($profile_photo_array as $image) {
                $sql  = "INSERT INTO user_images SET `user_id`= '" . $edit_id . "',`image` = '" . $image . "' ";
                $stmt = $dbCon->prepare($sql);
                $stmt->execute();
            }
        }
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null; 
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getSingleDoctor($user_id)
{
    $sql_query = "SELECT au.user_id,au.firstname,au.profile_photo,au.keywords,au.description,au.degree,au.practicing_since,au.status,au.current_location_id,au.subarea_id,au.previous_location_id,au.mobile,au.email_address,au.website,au.timing_clinic,au.timing_residence,au.dob,au.facility_ids,au.gender,au.status,au.second_opinion,au.second_opinion_charges,au.category_id  FROM app_users AS au WHERE category_type_id = '" . DOCTOR_ID . "' AND user_id = '" . $user_id . "' ORDER BY user_id DESC";
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchObject();
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'user_array' => $users
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function deleteDoctor($id)
{
    global $app;
    $req = $app->request();
    try {
        $dbCon     = getConnection();
        /* code for delete user images start here */
        $sql_query = "SELECT profile_photo FROM app_users WHERE `user_id` = '" . $id . "'";
        $stmt      = $dbCon->query($sql_query);
        $user_info = $stmt->fetchObject();
        if (!empty($user_info)) {
            unlink('../' . UPLOAD_FOLDER . $user_info->profile_photo);
        }
        $sql_query   = "SELECT image FROM user_images WHERE `user_id` = '" . $id . "'";
        $stmt        = $dbCon->query($sql_query);
        $user_images = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($user_images)) {
            foreach ($user_images as $user_value) {
                unlink('../' . UPLOAD_FOLDER . $user_value->image);
            }
        }
        /* code for delete user images end here */
        $sql  = "DELETE FROM app_users WHERE `user_id` = '" . $id . "'";
        $stmt = $dbCon->prepare($sql);
        $stmt->execute();
        $sql  = "DELETE FROM user_images WHERE `user_id` = '" . $id . "'";
        $stmt = $dbCon->prepare($sql);
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
function getDoctors()
{
    $sql_query = "SELECT au.user_id,au.firstname,au.email_address,au.join_date,au.status,c.category_name AS specialty FROM app_users AS au LEFT JOIN category AS c ON c.id = au.category_id WHERE category_type_id = '1' ORDER BY user_id DESC";
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'user_array' => $users
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editDoctor($edit_id)
{
    global $app;
    $req                  = $app->request();
    $firstname            = $req->params('firstname');
    $category_id          = $req->params('category_id');
    $profile_photo        = $req->params('profile_photo');
    $keywords             = $req->params('keywords');
    $description          = $req->params('description');
    $degree               = $req->params('degree');
    $practicing_since     = $req->params('practicing_since');
    $current_location_id  = $req->params('current_location_id');
    $subarea_id           = $req->params('subarea_id');
    $previous_location_id = $req->params('previous_location_id');
    $mobile               = $req->params('mobile');
    $email_address        = $req->params('email_address');
    $website              = $req->params('website');
    $timing_clinic        = $req->params('timing_clinic');
    $timing_residence     = $req->params('timing_residence');
    $dob                  = $req->params('dob');
    $facility_ids         = $req->params('facility_ids');
    $gender               = $req->params('gender');
    $status               = $req->params('status');
    $second_opinion       = $req->params('second_opinion');
    $second_opinion_charges  = $req->params('second_opinion_charges');


	if(empty($second_opinion))
		$second_opinion_charges = '';

	
    try {
        $dbCon = getConnection();

		//$slug_name = create_url_slug($firstname);	

		$sql_check = "SELECT slug_name FROM app_users WHERE user_id = '".$user_id."'";
		$stmt           = $dbCon->query($sql_check);
		$slug_count_array       = $stmt->fetchObject();
		

/*		$sql_check = "SELECT COUNT(user_id) AS slug_count FROM app_users WHERE slug_name = '" . $slug_name . "' AND user_id = '".$user_id."'";
		$stmt           = $dbCon->query($sql_check);
		$slug_count_array       = $stmt->fetchObject();
	
		if($slug_count_array->slug_count >0 ){
			
		}else{

			$sql_check = "SELECT COUNT(user_id) AS slug_count FROM app_users WHERE slug_name = '" . $slug_name . "'";
			$stmt           = $dbCon->query($sql_check);
			$slug_count_array       = $stmt->fetchObject();

			$slug_name = $slug_name.'-'.$slug_count_array->slug_count;
		}
*/	

	    $sql                  = "UPDATE app_users SET 

			`slug_name`= '" . $slug_name . "',

			`firstname`= '" . $firstname . "',

			`category_id` = '" . $category_id . "',";
    if (!empty($profile_photo))
        $sql .= "`profile_photo` = '" . $profile_photo . "',";
    $sql .= "`keywords` = '" . $keywords . "',

			`description` = '" . $description . "',

			`degree` = '" . $degree . "',

			`practicing_since` = '" . $practicing_since . "',

			`current_location_id`= '" . $current_location_id . "',

			`subarea_id` = '" . $subarea_id . "' ,

			`previous_location_id` = '" . $previous_location_id . "',

			`mobile` = '" . $mobile . "',

			`email_address` = '" . $email_address . "',

			`website` = '" . $website . "',

			`timing_clinic`= '" . $timing_clinic . "',

			`timing_residence` = '" . $timing_residence . "' ,

			`dob` = '" . date('Y-m-d', strtotime($dob)) . "',

			`facility_ids` = '" . $facility_ids . "',

			`gender` = '" . $gender . "',

			`status` = '" . $status . "',

			`second_opinion` = '" . $second_opinion . "',
			
			`second_opinion_charges` = '" . $second_opinion_charges . "',
	
			`modified_date`= '" . TODAY_DATE_TIME . "'

			WHERE user_id = '" . $edit_id . "'	

		  ";

        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user_array = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon      = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function addDoctor()
{
    global $app;
    $req                  = $app->request();
    $firstname            = $req->params('firstname');
    $category_id          = $req->params('category_id');
    $profile_photo        = $req->params('profile_photo');
    $keywords             = $req->params('keywords');
    $description          = $req->params('description');
    $degree               = $req->params('degree');
    $practicing_since     = $req->params('practicing_since');
    $current_location_id  = $req->params('current_location_id');
    $subarea_id           = $req->params('subarea_id');
    $previous_location_id = $req->params('previous_location_id');
    $mobile               = $req->params('mobile');
    $email_address        = $req->params('email_address');
    $website              = $req->params('website');
    $timing_clinic        = $req->params('timing_clinic');
    $timing_residence     = $req->params('timing_residence');
    $dob                  = $req->params('dob');
    $facility_ids         = $req->params('facility_ids');
    $gender               = $req->params('gender');
    $status               = $req->params('status');
    $second_opinion       = $req->params('second_opinion');
    $second_opinion_charges       = $req->params('second_opinion_charges');
	
	if(empty($second_opinion))
		$second_opinion_charges = '';

    try {
        $dbCon = getConnection();

		$slug_name = create_url_slug($firstname);	
		$sql_check = "SELECT COUNT(user_id) AS slug_count FROM app_users WHERE slug_name = '" . $slug_name . "'";
        $stmt           = $dbCon->query($sql_check);
        $slug_count_array       = $stmt->fetchObject();
	
		if($slug_count_array >0 ){
			
			$slug_name = $slug_name.'-'.$slug_count_array->slug_count;
		}

	    $sql                  = "INSERT INTO app_users SET 

			`slug_name` = '".$slug_name."',

			`firstname`= '" . $firstname . "',

			`category_id` = '" . $category_id . "' ,

			`profile_photo` = '" . $profile_photo . "',

			`keywords` = '" . $keywords . "',

			`description` = '" . $description . "',

			`degree` = '" . $degree . "',

			`practicing_since` = '" . $practicing_since . "',

			`current_location_id`= '" . $current_location_id . "',

			`subarea_id` = '" . $subarea_id . "' ,

			`previous_location_id` = '" . $previous_location_id . "',

			`mobile` = '" . $mobile . "',

			`email_address` = '" . $email_address . "',

			`website` = '" . $website . "',

			`timing_clinic`= '" . $timing_clinic . "',

			`timing_residence` = '" . $timing_residence . "' ,

			`dob` = '" . date('Y-m-d', strtotime($dob)) . "',

			`facility_ids` = '" . $facility_ids . "',

			`gender` = '" . $gender . "',

			`status` = '" . $status . "',

			`second_opinion` = '" . $second_opinion . "',

			`second_opinion_charges` = '" . $second_opinion_charges . "',

			`category_type_id` = '" . DOCTOR_ID . "',

			`join_date`= '" . TODAY_DATE_TIME . "',

			`device_type`= 'web',

			`modified_date`= '" . TODAY_DATE_TIME . "',

			`role`= 'Vendor',

			`login_type` = 'email'

			

		  ";

        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user     = new stdClass();
        $user->id = $dbCon->lastInsertId();
        if (!empty($user->id)) {
            $user_array = array(
                'success' => '1'
            );
        } else {
            $user_array = array(
                'success' => '0'
            );
        }
        $dbCon = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getCategoryKeywords($id)
{
    $sql_query = "SELECT keywords FROM category WHERE id = '" . $id . "'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $keywords       = $stmt->fetchObject();
        $dbCon          = null;
        $keywords_array = array(
            'success' => '1',
            'keywords_array' => $keywords
        );
        echo json_encode($keywords_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getCategorytypeFacility($id)
{
    $sql_query = "SELECT * FROM facility WHERE parent_id = '" . $id . "'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $facility       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $facility_array = array(
            'success' => '1',
            'facility_array' => $facility
        );
        echo json_encode($facility_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getLocationSubareas($location_id)
{
    $sql_query = "SELECT * FROM subarea WHERE location_id = '" . $location_id . "'";
    try {
        $dbCon         = getConnection();
        $stmt          = $dbCon->query($sql_query);
        $subarea       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon         = null;
        $subarea_array = array(
            'success' => '1',
            'subarea_array' => $subarea
        );
        echo json_encode($subarea_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function addSubarea()
{
    global $app;
    $req          = $app->request();
    $subarea_name = $req->params('subarea_name');
    $location_id  = $req->params('location_id');
    $description  = $req->params('description');
    $status       = $req->params('status');
    $sql          = "SELECT id FROM subarea WHERE subarea_name LIKE  '%" . $subarea_name . "%' AND location_id = '" . $location_id . "'";
    try {
        $dbCon         = getConnection();
        $stmt          = $dbCon->query($sql);
        $check_subarea = $stmt->fetchObject();
        if (!empty($check_subarea)) {
            $response = array(
                'success' => '0',
                'msg' => "'" . $subarea_name . "' is already exists!"
            );
        } else {
            $sql  = "INSERT INTO subarea SET `location_id`= '" . $location_id . "',`subarea_name`= '" . $subarea_name . "',`description` = '" . $description . "' ,`status` = '" . $status . "'";
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
            $location     = new stdClass();
            $location->id = $dbCon->lastInsertId();
            if (!empty($location->id))
                $response = array(
                    'success' => '1'
                );
            else
                $response = array(
                    'success' => '0',
                    'msg' => 'An error occurred, Please try again!'
                );
        }
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getSubareaAll()
{
    $sql_query = "SELECT s.id,s.subarea_name,s.status,l.location_name  FROM subarea AS s LEFT JOIN location AS l ON l.id = s.location_id ORDER BY id DESC";
    try {
        $dbCon         = getConnection();
        $stmt          = $dbCon->query($sql_query);
        $subarea       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon         = null;
        $subarea_array = array(
            'success' => '1',
            'subarea_array' => $subarea
        );
        echo json_encode($subarea_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editSubarea($edit_id)
{
    global $app;
    $req          = $app->request();
    $location_id  = $req->params('location_id');
    $subarea_name = $req->params('subarea_name');
    $description  = $req->params('description');
    $status       = $req->params('status');
    try {
        $dbCon         = getConnection();
        $sql           = "SELECT id FROM subarea WHERE id != '" . $edit_id . "' AND subarea_name = '" . $subarea_name . "' AND location_id = '" . $location_id . "'";
        $stmt          = $dbCon->query($sql);
        $check_subarea = $stmt->fetchObject();
        if (!empty($check_subarea)) {
            $check_subarea = array(
                'success' => '0',
                'msg' => "'" . $subarea_name . "' is already exists!"
            );
        } else {
            $sql  = "UPDATE subarea SET `location_id`= '" . $location_id . "',`subarea_name`= '" . $subarea_name . "',`description` = '" . $description . "' ,`status` = '" . $status . "' WHERE id = '" . $edit_id . "'";
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
            $response = array(
                'success' => '1'
            );
        }
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getSingleSubarea($id)
{
    $sql_query = "SELECT * FROM subarea WHERE id = '" . $id . "'";
    try {
        $dbCon         = getConnection();
        $stmt          = $dbCon->query($sql_query);
        $subarea       = $stmt->fetchObject();
        $dbCon         = null;
        $subarea_array = array(
            'success' => '1',
            'subarea_array' => $subarea
        );
        echo json_encode($subarea_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function deleteSubarea($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM subarea WHERE `id` = '" . $id . "'";
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
function addLocation()
{
    global $app;
    $req           = $app->request();
    $location_name = $req->params('location_name');
    $description   = $req->params('description');
    $status        = $req->params('status');
    $sql           = "SELECT id FROM location WHERE location_name LIKE  '%" . $location_name . "%'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql);
        $check_location = $stmt->fetchObject();
        if (!empty($check_location)) {
            $response = array(
                'success' => '0',
                'msg' => "'" . $location_name . "' is already exists!"
            );
        } else {
            $sql  = "INSERT INTO location SET `location_name`= '" . $location_name . "',`description` = '" . $description . "' ,`status` = '" . $status . "'";
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
            $location     = new stdClass();
            $location->id = $dbCon->lastInsertId();
            if (!empty($location->id))
                $response = array(
                    'success' => '1'
                );
            else
                $response = array(
                    'success' => '0',
                    'msg' => 'An error occurred, Please try again!'
                );
        }
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getLocationAll()
{
    $sql_query = "SELECT id,location_name,status FROM location ORDER BY id DESC";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $location       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $location_array = array(
            'success' => '1',
            'location_array' => $location
        );
        echo json_encode($location_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function editLocation($edit_id)
{
    global $app;
    $req           = $app->request();
    $location_name = $req->params('location_name');
    $description   = $req->params('description');
    $status        = $req->params('status');
    $sql           = "SELECT id FROM location WHERE id != '" . $edit_id . "' AND location_name = '" . $location_name . "'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql);
        $check_location = $stmt->fetchObject();
        if (!empty($check_location)) {
            $response = array(
                'success' => '0',
                'msg' => "'" . $location_name . "' is already exists!"
            );
        } else {
            $sql  = "UPDATE location SET `location_name`= '" . $location_name . "',`description` = '" . $description . "' ,`status` = '" . $status . "' WHERE id = '" . $edit_id . "'";
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
            $response = array(
                'success' => '1'
            );
        }
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getSingleLocation($id)
{
    $sql_query = "SELECT * FROM location WHERE id = '" . $id . "'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $location       = $stmt->fetchObject();
        $dbCon          = null;
        $location_array = array(
            'success' => '1',
            'location_array' => $location
        );
        echo json_encode($location_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function deleteLocation($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM location WHERE `id` = '" . $id . "'";
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
function editFacility($edit_id)
{
    global $app;
    $req           = $app->request();
    $parent_id     = $req->params('parent_id');
    $facility_name = $req->params('facility_name');
    $status        = $req->params('status');
    $keywords      = $req->params('keywords');
    $sql           = "UPDATE facility SET `parent_id`= '" . $parent_id . "',`facility_name` = '" . $facility_name . "' ,`status` = '" . $status . "',`keywords` = '" . $keywords . "' WHERE id = '" . $edit_id . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $response = array(
            'success' => '1',
            'sql' => $sql
        );
        $dbCon    = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function addFacility()
{
    global $app;
    $req           = $app->request();
    $parent_id     = $req->params('parent_id');
    $facility_name = $req->params('facility_name');
    $status        = $req->params('status');
    $keywords      = $req->params('keywords');
    $sql           = "INSERT INTO facility SET `parent_id`= '" . $parent_id . "',`facility_name` = '" . $facility_name . "' ,`status` = '" . $status . "',`keywords` = '" . $keywords . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $category     = new stdClass();
        $category->id = $dbCon->lastInsertId();
        if (!empty($category->id))
            $response = array(
                'success' => '1'
            );
        else
            $response = array(
                'success' => '0'
            );
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getFacilityAll()
{
    $sql_query = "SELECT f.*,ct.name AS facility_type FROM facility AS f LEFT JOIN category_type AS ct ON ct.id = f.parent_id  ORDER BY f.id DESC";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $facility       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $facility_array = array(
            'success' => '1',
            'facility_array' => $facility
        );
        echo json_encode($facility_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getSingleFacility($id)
{
    $sql_query = "SELECT * FROM facility WHERE id = '" . $id . "'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $facility       = $stmt->fetchObject();
        $dbCon          = null;
        $facility_array = array(
            'success' => '1',
            'facility_array' => $facility
        );
        echo json_encode($facility_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function deleteFacility($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM facility WHERE `id` = '" . $id . "'";
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
function deleteCategory($id)
{
    global $app;
    $req = $app->request();
    $sql = "DELETE FROM category WHERE `id` = '" . $id . "'";
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
function editCategory($edit_id)
{
    global $app;
    $req           = $app->request();
    $parent_id     = $req->params('parent_id');
    $category_name = $req->params('category_name');
    $status        = $req->params('status');
    $keywords      = $req->params('keywords');
    $sql           = "UPDATE category SET `parent_id`= '" . $parent_id . "',`category_name` = '" . $category_name . "' ,`status` = '" . $status . "',`keywords` = '" . $keywords . "' WHERE id = '" . $edit_id . "'";
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
function addCategory()
{
    global $app;
    $req           = $app->request();
    $parent_id     = $req->params('parent_id');
    $category_name = $req->params('category_name');
    $status        = $req->params('status');
    $keywords      = $req->params('keywords');
    $sql           = "INSERT INTO category SET `parent_id`= '" . $parent_id . "',`category_name` = '" . $category_name . "' ,`status` = '" . $status . "',`keywords` = '" . $keywords . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $category     = new stdClass();
        $category->id = $dbCon->lastInsertId();
        if (!empty($category->id))
            $response = array(
                'success' => '1'
            );
        else
            $response = array(
                'success' => '0'
            );
        $dbCon = null;
        echo json_encode($response);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function getCategoryByType($type_id)
{
    $sql_query = "SELECT c.id,c.category_name,c.status,c.parent_id,ct.name AS category_type FROM category AS c LEFT JOIN category_type AS ct ON ct.id = c.parent_id WHERE parent_id = '" . $type_id . "' ORDER BY id DESC";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $category       = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		$extra_key     = (object) array(

            "id" => '0',
            "category_name" => '-Select-',
            "status" => '1',
            "parent_id" => '0',
            "category_type" => '0'

        );
		 array_unshift($category, $extra_key);

        $dbCon          = null;
        $category_array = array(
            'success' => '1',
            'category_array' => $category
        );
        echo json_encode($category_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getCategoryAll()
{
    $sql_query = "SELECT c.id,c.category_name,c.status,c.parent_id,ct.name AS category_type FROM category AS c LEFT JOIN category_type AS ct ON ct.id = c.parent_id ORDER BY id DESC";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $category       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $category_array = array(
            'success' => '1',
            'category_array' => $category
        );
        echo json_encode($category_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getSingleCategory($id)
{
    $sql_query = "SELECT * FROM category WHERE id = '" . $id . "'";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $category       = $stmt->fetchObject();
        $dbCon          = null;
        $category_array = array(
            'success' => '1',
            'category_array' => $category
        );
        echo json_encode($category_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getCategoryType()
{
    $sql_query = "SELECT id,name FROM category_type ORDER BY name";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $category       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $category_array = array(
            'success' => '1',
            'category_type_array' => $category
        );
        echo json_encode($category_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getCategory()
{
    $sql_query = "SELECT id,category_name FROM category WHERE parent_id = '0' AND status = '1' ORDER BY category_name";
    try {
        $dbCon          = getConnection();
        $stmt           = $dbCon->query($sql_query);
        $category       = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon          = null;
        $category_array = array(
            'success' => '1',
            'category_array' => $category
        );
        echo json_encode($category_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getUsersByType($user_type)
{
    $sql_query = "SELECT user_id,firstname,lastname,email_address,join_date,status,role,newsletter,phone,mobile,address FROM app_users WHERE role = '" . $user_type . "' ORDER BY user_id DESC";
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'user_array' => $users
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function getUsers()
{
    $sql_query = "SELECT user_id,firstname,lastname,email_address,join_date,status,role,newsletter FROM app_users ORDER BY user_id DESC";
    try {
        $dbCon      = getConnection();
        $stmt       = $dbCon->query($sql_query);
        $users      = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon      = null;
        $user_array = array(
            'success' => '1',
            'user_array' => $users
        );
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        echo '{"success": ' . json_encode('0') . '}';
    }
}
function addUser()
{
    global $app;
    $req           = $app->request();
    $firstname     = $req->params('firstname');
    $lastname      = $req->params('lastname');
    $address       = $req->params('address');
    $company       = $req->params('company');
    $email_address = $req->params('email_address');
    $phone         = $req->params('phone');
    $gender        = $req->params('gender');
    $dob           = $req->params('dob');
    $role          = $req->params('role');
    $login_type    = $req->params('login_type');
    $device_type   = $req->params('device_type');
    $sql           = "INSERT INTO app_users SET `firstname`= '" . $firstname . "',`lastname` = '" . $lastname . "' ,`address` = '" . $address . "',`company` = '" . $company . "',`email_address` = '" . $email_address . "',`phone` = '" . $phone . "',`gender` = '" . $gender . "',`dob` = '" . $dob . "',`role` = '" . $role . "',`join_date`= '" . TODAY_DATE_TIME . "',`status` = '0',`login_type` = '" . $login_type . "',`device_type` = '" . $device_type . "'";
    try {
        $dbCon = getConnection();
        $stmt  = $dbCon->prepare($sql);
        $stmt->execute();
        $user     = new stdClass();
        $user->id = $dbCon->lastInsertId();
        if (!empty($user->id)) {
            if (!empty($device_id) && !empty($device_type)) {
                $sql  = "UPDATE app_users SET device_id = '" . $device_id . "' , device_type = '" . $device_type . "' WHERE user_id  = '" . $user->id . "'";
                $stmt = $dbCon->prepare($sql);
                $stmt->execute();
            }
            /*				
            
            $from = 'curecity@gmail.com';
            
            $from_name = 'Curecity';
            
            $subject = "Welcome to curecity";
            
            $email_to = $email_address;
            
            
            
            $activation = SITE_URL.'activation.php?email='.$email_address.'&hash='.md5($email_address."Cech4tHe");
            
            
            
            $content = 'Hi '.$firstname.'<br/><br/>';
            
            $content .= "Please click the button below to verify your account.<br /><br /><br />";
            
            $content .= "<a href='".$activation."' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";
            
            $content .= "Kind regards,<br />";
            
            $content .= "<a href='#' target='_blank'>Hero Team</a><br />";
            
            
            
            
            
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
            
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $uri);
            
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            curl_setopt($ch, CURLOPT_POST, true);
            
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
            
            $result = curl_exec($ch);  
            
            $result = json_decode($result);
            
            
            
            */
            //$user_array = getProviderInfo($user->id);
            $user_array = array(
                'success' => '1',
                'sql' => $sql
            );
        } else {
            $user_array = array(
                'success' => '0'
            );
        }
        $dbCon = null;
        echo json_encode($user_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function adminLogin($username, $password)
{
    $sql = "SELECT user_id,username,role,status FROM app_users WHERE username = '" . $username . "' AND password = '" . $password . "' ";
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
                'sql' => $sql
            );
        }
        $dbCon = null;
        echo json_encode($admin_array);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
function create_url_slug($string)
{
    $string = strtolower($string);
    $slug   = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return $slug;
}
function getConnection()
{
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
