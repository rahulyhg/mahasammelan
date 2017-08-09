<?php
require_once('config/Query.Inc.php');
//include_once("check-login.php");
$Obj = new Query(DB_NAME);
$error_msg = '';
if(isset($_POST['add_stavan_sangrah_submit']) && !empty($_POST['add_stavan_sangrah_submit'])){
	
	   
	$sourcePath = $_FILES['audio_file']['tmp_name'];
	$audio_file = time().'-'.str_replace(' ','-',$_FILES['audio_file']['name']);
	$targetPath = "uploads/".$audio_file;
      // print_r($_FILES['audio_file']['name']); die;
	if(move_uploaded_file($sourcePath,$targetPath)) {
	
	}else{

		$audio_file = '';
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
		
				if(empty($profile_photo)){
						$profile_photo = urlencode(trim($profile_photo));
					}			
		}else { 
			$error = "Uploaded image should be jpg or gif or png";  
		}
		}else{
			$profile_photo = $_POST['old_image'];
		}
		
		//print_R($profile_photo) ;die;
	$result = $Obj->httpPost(ADMIN_URL.'api/stavansangrah/add',array('title'=>trim($_POST['title']),'lyrics'=>trim($_POST['lyrics']),
	'type'=>trim($_POST['type']),
	'image'=>$profile_photo,'audio_file'=>$audio_file));
	$result = json_decode($result);
	 if($result->success=='1')
	{
		$msg = "Your file uploaded sucessfully";
	}
	else
	{
		$error_msg = " Error uploading  file!";
	}
	//print_r($result); die;
	//$Obj->Redirect("stavan-sangrah.php");
	    
	
}

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
					<div class="panel-title"><h4>Add Stavan Sangrah</h4></div>
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
							<div class="form-body">
                                <div class="form-group">
									<label class="control-label col-md-3">Title</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" name="title" class="form-control" value=""  required>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-md-3">Lyrics</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<textarea name="lyrics" class="form-control" required></textarea>
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
															<option value="<?php echo $stavan_type_value->english_image; ?>"><?php echo $stavan_type_value->name; ?></option>
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
												<input type="file" name="audio_file" class="form-control" value=""  required>
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
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" name="add_stavan_sangrah_submit" value="1"  class="btn btn-primary">Submit</button>
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
<script>
	 $("input[name='audio_file']").change(function(){

		var filename = $("input[name='audio_file']").val();
        var extension = filename.replace(/^.*\./, '');
		
		if (extension == filename) {
            extension = '';
        } else {
            extension = extension.toLowerCase();
        }

	});
	
</script>


