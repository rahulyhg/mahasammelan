<?php
require_once('config/Query.Inc.php');
//include_once("check-login.php");
$Obj = new Query(DB_NAME);
$error_msg = '';
if(isset($_POST['add_event_submit']) && !empty($_POST['add_event_submit'])){
	
	
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
			$profile_photo = $_POST['old_image'];;
		}

	$result = $Obj->httpPost(ADMIN_URL.'api/event/add',array('event_name'=>trim($_POST['event_name']),'event_description'=>trim($_POST['event_description']),
	'event_date_time'=>trim($_POST['event_date_time']),'image'=>$profile_photo));
	$result = json_decode($result);
	
	 if($result->success=='1')
	{
		$msg = "Your file uploaded sucessfully";
	}
	else
	{
		$error_msg = " Error uploading  file!";
	}
	
	$Obj->Redirect("events.php");
	
	
}
include_once('form-header.php');?>
<!-- BEGIN PLUGINS CSS -->
<link rel="stylesheet" href="assets/globals/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">

<div class="content">

	<div class="page-header full-content">
			<div class="row">
			  <div class="col-sm-6">
				<h1>Events</h1>
			  </div>
			</div>
		  </div>
		  
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<div class="panel-title"><h4>Add Event</h4></div>
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
									<label class="control-label col-md-3">Event Date & Time</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
													<input type="text" style="width: 400px" name="event_date_time" class="form-control bootstrap-daterangepicker-date-time" value="" required readonly>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-md-3">Event Name</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" name="event_name" class="form-control" value=""  required>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-md-3">Event Description</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<textarea name="event_description" class="form-control" required></textarea>
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
										<button type="submit" name="add_event_submit" value="1"  class="btn btn-primary">Submit</button>
										<a href="events.php" class="btn btn-flat btn-default">Cancel</a>

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
