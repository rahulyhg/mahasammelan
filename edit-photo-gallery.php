<?php
require_once('config/Query.Inc.php');
//include_once("check-login.php");
$Obj = new Query(DB_NAME);
$error_msg = '';

if(isset($_POST['edit_photo_gallery_submit']) && !empty($_POST['edit_photo_gallery_submit'])){
	
	$result = $Obj->httpPost(ADMIN_URL.'api/gallery/edit/'.$_POST['edit_id'],array('title'=>trim($_POST['title']),'gallery_id'=>$_SESSION['gallery_id']));
	$result = json_decode($result);
	unset($_SESSION['gallery_id']);
	$_SESSION['gallery_id'] = '';
	if($result->success=='1')
	{
		$msg = "Your file uploaded sucessfully";
	}
	else
	{
		$error_msg = " Error uploading  file!";
	}				

	//$Obj->Redirect("photo-gallery.php");
	
}
if(!empty($_GET['id'])){
	$id = $Obj->decrypt($_GET['id']);
}
// Get group info
$result = $Obj->httpGet(ADMIN_URL.'api/gallery/single/'.$id);
$gallery_result = json_decode($result);
  //print_r($gallery_result); die;
$_SESSION['gallery_id'] = $gallery_result->gallery_array->gallery_id;

if(empty($_SESSION['gallery_id'])){
	$_SESSION['gallery_id'] = time();
}else{
	//$gallery_id = $_SESSION['inbox_id'];

}


include_once('form-header.php');?>
<!-- BEGIN PLUGINS CSS -->
<link rel="stylesheet" href="assets/globals/plugins/blueimp-gallery/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="assets/globals/plugins/jquery-file-upload/css/jquery.fileupload.css">
<link rel="stylesheet" href="assets/globals/plugins/jquery-file-upload/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="assets/globals/plugins/jquery-file-upload/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="assets/globals/plugins/jquery-file-upload/css/jquery.fileupload-ui-noscript.css"></noscript>

<div class="content">

	<div class="page-header full-content">
			<div class="row">
			  <div class="col-sm-6">
				<h1>Photo Gallery</h1>
			  </div>
			</div>
		  </div>
		  
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<div class="panel-title"><h4>Edit Photo Gallery</h4></div>
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

						<form action="" class="form-horizontal parsley-validate" method="post" id="Form1">
							<input type="hidden" name="edit_id" value="<?php echo $id; ?>" />
							<div class="form-body">
                                <div class="form-group">
									<label class="control-label col-md-3">Title</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" name="title" class="form-control" value="<?php echo $gallery_result->gallery_array->title; ?>"  required>
											</div>
										</div>
									</div>
								</div>

                                <div class="form-group">
									<label class="control-label col-md-3">Upload Images</label>
									<div class="col-md-9">
										<div class="inputer">

							</form>							
										<?php
											if(!empty($gallery_result->gallery_array->images_array)){
										?>
											<table role="presentation" class="table table-striped">
													<tbody class="files">
														<?php
															foreach($gallery_result->gallery_array->images_array as $images_value){
														?>
																<input type="hidden" id="<?php echo $images_value->id; ?>_image" value = "<?php echo $images_value->gallery_image_name; ?>"/>
																<tr class="template-download fade in">
																	<td>
																		<span class="preview">
																			<a href="<?php echo $images_value->gallery_image; ?>"  title="" download="" data-gallery><img src="<?php echo $images_value->gallery_image; ?>"></a>
																		</span>
																	</td>
																	<td>
																	<button class="btn btn-danger pull-right delete delete-image" id="<?php echo $images_value->id; ?>" data-type="DELETE" >
																		<i class="glyphicon glyphicon-trash"></i>
																		<span>Delete</span>
																	</button>
																	</td>
																</tr>
															<?php } ?>		
													</tbody>
												</table>				
											<?php } ?>
											<form id="fileupload" action="<?php echo ADMIN_URL; ?>assets/globals/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data">
												<!-- Redirect browsers with JavaScript disabled to the origin page -->
												<noscript><input type="hidden" name="redirect" value="#"></noscript>
												<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
												<div class="row fileupload-buttonbar">
													<div class="col-lg-12">
														<!-- The fileinput-button span is used to style the file input field as button -->
														<span class="btn btn-success fileinput-button">
															<i class="glyphicon glyphicon-plus"></i>
															<span>Add files...</span>
															<input type="file" name="files[]" multiple>
														</span>
														<button type="submit" class="btn btn-primary start">
															<i class="glyphicon glyphicon-upload"></i>
															<span>Start upload</span>
														</button>
														<button type="reset" class="btn btn-warning cancel">
															<i class="glyphicon glyphicon-ban-circle"></i>
															<span>Cancel upload</span>
														</button>
														<button type="button" class="btn btn-danger delete">
															<i class="glyphicon glyphicon-trash"></i>
															<span>Delete</span>
														</button>
														<input type="checkbox" class="toggle">
														<!-- The global file processing state -->
														<span class="fileupload-process"></span>
													</div>
													<!-- The global progress state -->
													<div class="col-lg-5 fileupload-progress fade">
														<!-- The global progress bar -->
														<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
															<div class="progress-bar progress-bar-success" style="width:0%;"></div>
														</div>
														<!-- The extended global progress state -->
														<div class="progress-extended">&nbsp;</div>
													</div>
												</div>
												<!-- The table listing the files available for upload/download -->
												<table role="presentation" class="table table-striped">
													<tbody class="files">
												</tbody></table>
											</form>											
											</div>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" name="edit_photo_gallery_submit" value="1" form="Form1"  class="btn btn-primary">Update</button>
										<a href="photo-gallery.php" class="btn btn-flat btn-default">Cancel</a>

									</div>
								</div>
							</div>
					</div><!--.row-->

				</div><!--.panel-body-->
			</div><!--.panel-->
		</div><!--.col-md-12-->
	</div><!--.row-->

<!-- The template to display files available for upload -->
		<script id="template-upload" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
			<tr class="template-upload fade">
				<td>
					<span class="preview"></span>
				</td>
				<td>
					<p class="name">{%=file.name%}</p>
					<strong class="error text-danger"></strong>
				</td>
				<td>
					<p class="size">Processing...</p>
					<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-primary" style="width:0%;"></div></div>
				</td>
				<td>
					{% if (!i) { %}
					<button class="btn btn-default pull-right cancel">
						<i class="glyphicon glyphicon-ban-circle"></i>
						<span>Cancel</span>
					</button>
					{% } %}
					{% if (!i && !o.options.autoUpload) { %}
					<button class="btn btn-primary pull-right start" disabled>
						<i class="glyphicon glyphicon-upload"></i>
						<span>Start</span>
					</button>
					{% } %}
				</td>
			</tr>
		{% } %}
		</script>
		<!-- End of The template to display files available for upload -->
		<!-- The template to display files available for download -->
		<script id="template-download" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
			<tr class="template-download fade">
				<td>
					<span class="preview">
						{% if (file.thumbnailUrl) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
						{% } %}
					</span>
				</td>
				<td>
					<p class="name">
						{% if (file.url) { %}
							<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
						{% } else { %}
							<span>{%=file.name%}</span>
						{% } %}
					</p>
					{% if (file.error) { %}
						<div><span class="label label-danger">Error</span> {%=file.error%}</div>
					{% } %}
				</td>
				<td>
					<span class="size">{%=o.formatFileSize(file.size)%}</span>
				</td>
				<td>
					{% if (file.deleteUrl) { %}
						<button class="btn btn-danger pull-right delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
							<i class="glyphicon glyphicon-trash"></i>
							<span>Delete</span>
						</button>
						<input type="checkbox" name="delete" value="1" class="toggle">
					{% } else { %}
						<button class="btn btn-warning pull-right cancel">
							<i class="glyphicon glyphicon-ban-circle"></i>
							<span>Cancel</span>
						</button>
					{% } %}
				</td>
			</tr>
		{% } %}
		</script>

	
</div><!--.content-->

<div class="layer-container">

	<!-- BEGIN MENU LAYER -->
	<?php include_once('menu.php');?>
	<!-- END OF MENU LAYER -->

</div><!--.layer-container-->
<?php include_once('form-file-footer.php');?>

