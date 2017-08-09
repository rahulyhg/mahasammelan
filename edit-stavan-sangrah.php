<?php
require_once('config/Query.Inc.php');
include_once("check-login.php");
$Obj = new Query(DB_NAME);
$error_msg = '';
if(isset($_POST['edit_stavan_sangrah_submit']) && !empty($_POST['edit_stavan_sangrah_submit'])){
	
	if(!empty($_FILES['audio_file']['tmp_name'])){
	
	$sourcePath = $_FILES['audio_file']['tmp_name'];
	$audio_file = time().'-'.str_replace(' ','-',$_FILES['audio_file']['name']);
	$targetPath = "uploads/".$audio_file;

		if(move_uploaded_file($sourcePath,$targetPath)) {
		
		}else{

			$audio_file = '';
		}
	}else{
	
			$audio_file = $_POST['edit_audio_file'];
	
	}	
	
	//print_R($_FILES["photo"]) ;die;
	$profile_photo = "";
if($_FILES["photo"]["name"]!="" && !empty($_FILES["photo"]["name"])){
	
	if ($_FILES["photo"]["error"] > 0) { 
			$error = $_FILES["photo"]["error"]; 
		} else if (($_FILES["photo"]["type"] == "image/gif") || ($_FILES["photo"]["type"] == "image/jpeg") || ($_FILES["photo"]["type"] == "image/png") || ($_FILES["photo"]["type"] == "image/pjpeg")){ 

			$temp = explode(".", $_FILES["photo"]["name"]);
			$extension = end($temp);
			$profile_photo = time().'-'.$_FILES["photo"]["name"];
			$url = UPLOAD_FOLDER.$profile_photo; 
			$Obj->compress_image($_FILES["photo"]["tmp_name"], $url, 80);
			//unlink(UPLOAD_FOLDER.$_POST['edit_profile_photo']);
		//print_r($profile_photo); die;
				if(empty($profile_photo)){
						$profile_photo = urlencode(trim($profile_photo));
					}			
		}else { 
			$error = "Uploaded image should be jpg or gif or png";  
		}
		}else{
			$profile_photo = $_POST['old_image'];;
		}
	
	
	//print_R($profile_photo) ;die;
	
			
	$result = $Obj->httpPost(ADMIN_URL.'api/stavansangrah/edit/'.$_POST['edit_id'],array('title'=>trim($_POST['title']),'lyrics'=>trim($_POST['lyrics']),'type'=>trim($_POST['type']),'audio_file'=>$audio_file,'image'=>$profile_photo));
	$result = json_decode($result);
	//print_R($result) ;die;
	 if($result->success=='1')
	{
		$msg = "Your file uploaded sucessfully";
	}
	else
	{
		$error_msg = " Error uploading  file!";
	}
	//$Obj->Redirect("stavan-sangrah.php");

}

if(!empty($_GET['id'])){
	$id = $Obj->decrypt($_GET['id']);
}
// Get group info
$result = $Obj->httpGet(ADMIN_URL.'api/stavansangrah/single/'.$id);
$stavan_result = json_decode($result);

$result = $Obj->httpGet(ADMIN_URL.'api/stavansangrah/type');
$stavan_type_result  = json_decode($result);


include_once('form-header.php');?>
<div class="content">

	<div class="page-header full-content">
			<div class="row">
			  <div class="col-sm-6">
				<h1>Stavan Sangrah</h1>
			  </div>
			</div>
		  </div>
		  
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<div class="panel-title"><h4>Edit Stavan Sangrah</h4></div>
				</div><!--.panel-heading-->
				<div class="panel-body">
					
				<?php
					if(!empty($error_msg)){
				?>
				<div class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>
				<?php }
				elseif(!empty($msg))
				{?>
					
					<div class="alert alert-success" role="alert"><?php echo $msg; ?></div>
					
					<?php }?>
					
					<div class="row">
						<form action="" class="form-horizontal parsley-validate" method="post" enctype="multipart/form-data">
							<input type="hidden" name="edit_id" value="<?php echo $id; ?>" />
							<input type="hidden" name="edit_audio_file" value="<?php echo $stavan_result->stavan_array->audio_file; ?>" />
							<input type="hidden" name="old_image"  class="form-control" value="<?php echo $edit_result->result_array->image ?>" />
 							<div class="form-body">
                                
								<div class="form-group">
									<label class="control-label col-md-3">Title</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" name="title" class="form-control" value="<?php echo $stavan_result->stavan_array->title; ?>"  required>
											</div>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-3">Lyrics</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<textarea name="lyrics" class="form-control" required><?php echo $stavan_result->stavan_array->lyrics; ?></textarea>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Type</label>
									<div class="col-md-5">
											<div class="inputer">
												<select name="type" class="selecter">
													<option value="">-Select-</option>
													<?php
														if(!empty($stavan_type_result->success)){
															foreach($stavan_type_result->stavan_type_array as $stavan_type_value){
													?>
															<option value="<?php echo $stavan_type_value->english_image; ?>" <?php if($stavan_type_value->english_image == $stavan_result->stavan_array->type){?>selected<?php } ?>><?php echo $stavan_type_value->name; ?></option>
													<?php
															}
														}
													?>
												</select>
										</div>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-md-3">Upload Audio File</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="file" name="audio_file" class="form-control" value="">
												<audio controls>
												  <source src="<?php echo 'uploads/'.$stavan_result->stavan_array->audio_file; ?>" type="audio/mpeg">
													Your browser does not support the audio element.
												</audio>
												
											</div>
										</div>
									</div>
								</div>   
								 <div class="form-group">
									<label class="control-label col-md-3">Image</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="file" name="photo" class="form-control "  parsley-required="true">
												<img src="<?php echo ADMIN_URL.'uploads/' .$stavan_result->stavan_array->image; ?>"  width = "150px" height = "150px"readonly />
											</div>
										</div>
									</div>
								</div>
							
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" name="edit_stavan_sangrah_submit" value="1"  class="btn btn-primary">Update</button>
										<a href="stavan-sangrah.php" class="btn btn-flat btn-default">Cancel</a>
									</div>
								</div>
							</div>
						</form>
					</div><!--.row-->

				</div><!--.panel-body-->
			</div><!--.panel-->
		</div><!--.col-md-12-->
	</div><!--.row-->


	
</div><!--.content-->

<div class="layer-container">

	<!-- BEGIN MENU LAYER -->
	<?php include_once('menu.php');?>
	<!-- END OF MENU LAYER -->


</div><!--.layer-container-->
<?php include_once('form-footer.php');?>

