<?php
require_once('config/Query.Inc.php');
//include_once("check-login.php");
$Obj = new Query(DB_NAME);
$error_msg = '';
if(isset($_POST['add_group_submit']) && !empty($_POST['add_group_submit'])){
	
	$result = $Obj->httpPost(ADMIN_URL.'api/group/add',array('group_name'=>$_POST['group_name'],
	'group_name_hindi'=>$_POST['group_name_hindi'],
	'group_head'=>$_POST['group_head']));
	$result = json_decode($result);
	$Obj->Redirect("groups.php");
	
	
}
// for all user list
$result = $Obj->httpGet(ADMIN_URL.'api/admin/users/status/all');
$user_result = json_decode($result);

include_once('form-header.php');?>
<div class="content">

	<div class="page-header full-content">
			<div class="row">
			  <div class="col-sm-6">
				<h1>Groups</h1>
			  </div>
			</div>
		  </div>
		  
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<div class="panel-title"><h4>Add Group</h4></div>
				</div><!--.panel-heading-->
				<div class="panel-body">
				<?php
					if(!empty($error_msg)){
				?>
				<div class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>
				<?php } ?>
					<div class="row">
						<form action="" class="form-horizontal parsley-validate" method="post">
							<div class="form-body">

								
                                <div class="form-group">
									<label class="control-label col-md-3">Group Name</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" name="group_name" class="form-control" value=""  required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Group Name (Hindi)</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" name="group_name_hindi" class="form-control" value=""  required>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-md-3">Head of Group</label>
									<div class="col-md-5">
											<div class="input-wrapper">
												<select name="group_head" class="selecter" required>
													<option value="">-Select-</option>
													<?php
														if(!empty($user_result->success)){
															foreach($user_result->user_array as $user_value){
													?>
															<option value="<?php echo $user_value->user_id; ?>"><?php echo $user_value->username." (".$user_value->user_type.")"; ?></option>
													<?php
															}
														}
													?>
												</select>
											</div>
										</div>
								</div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" name="add_group_submit" value="1"  class="btn btn-primary">Submit</button>
										<a href="groups.php" class="btn btn-flat btn-default">Cancel</a>

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

