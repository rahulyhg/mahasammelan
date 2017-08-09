<?php

require_once('../config/Query.Inc.php');

include_once("check-login.php");

$Obj = new Query(DB_NAME);



if(!empty($_FILES)) {

	if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {

		$sourcePath = $_FILES['userImage']['tmp_name'];

		$terms_document = time().'-'.$_FILES['userImage']['name'];

		$result = $Obj->httpGet(BASE_URL.'api/user/info/'.$_POST['doc_user_id']);

		$user_result = json_decode($result);

		unlink('../uploads/documents/'.$user_result->terms_document);


		$targetPath = "../uploads/documents/".$terms_document;

		$result = $Obj->httpPost(BASE_URL.'api/user/updatedoc/'.$_POST['doc_user_id'],array('terms_document'=>trim($terms_document)));

		

		if(move_uploaded_file($sourcePath,$targetPath)) {

			?>

			<a href="<?php echo $targetPath; ?>" target="_blank">Click here for download T&amp;C Document</a>

			<?php

		}

	}

}

?>