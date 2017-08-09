<?php
require_once('config/Query.Inc.php');
//include_once("check-login.php");
$Obj = new Query(DB_NAME);
$error_msg = '';
if(isset($_POST['add_panchang_submit']) && !empty($_POST['add_panchang_submit'])){
	
	$result = $Obj->httpPost(ADMIN_URL.'api/panchang/add',array('date'=>$_POST['date'],'weekday'=>$_POST['weekday'],'lunar_year'=>$_POST['lunar_year'],'lunar_tithi'=>$_POST['lunar_tithi'],'shubh_din'=>$_POST['shubh_din'],'lunar_cycle'=>$_POST['lunar_cycle'],'description'=>$_POST['description'],'lunar_month'=>$_POST['lunar_month']));
	$result = json_decode($result);
	$Obj->Redirect("panchang.php");
	
	
}
$month_result = $Obj->httpGet(ADMIN_URL.'api/panchang/months');
$month_result = json_decode($month_result);


$trith_result = $Obj->httpGet(ADMIN_URL.'api/user/all/trithi');
$trith_result = json_decode($trith_result);



include_once('form-header.php');?>
<link rel="stylesheet" href="assets/globals/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">

<div class="content">

	<div class="page-header full-content">
			<div class="row">
			  <div class="col-sm-6">
				<h1>Panchang</h1>
			  </div>
			</div>
		  </div>
		  
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<div class="panel-title"><h4>Add panchang</h4></div>
				</div><!--.panel-heading-->
				<div class="panel-body">
				<?php
					if(!empty($error_msg)){
				?>
				<div class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>
				<?php } ?>
				
						<form action="" class="parsley-validate" method="post">
							<div class="form-content">

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Date</label>
											<div class="inputer">
												<div class="input-wrapper">
													<input type="text" name="date" class="form-control bootstrap-daterangepicker-basic" value="" required readonly/>
												</div>
											</div>
										</div><!--.form-group-->
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Weekday</label>
											<div class="inputer">
												<div class="input-wrapper">
													<input type="text" name="weekday" class="form-control" readonly>
												</div>
											</div>
										</div><!--.form-group-->
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Lunar Year</label>
											<div class="inputer">
												<div class="input-wrapper">
													<input type="text"  name="lunar_year" class="form-control" required>
												</div>
											</div>
										</div><!--.form-group-->
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Lunar Month</label>
											<div class="inputer">
												<div class="input-wrapper">
													<select name="lunar_month" class="form-control" required>
														<option value="">-Select-</option>
														<?php
															foreach($month_result->panchang_month_array as $month_value){
														?>
															<option value="<?php echo $month_value->month_hindi;?>"><?php echo $month_value->month_hindi;?></option>
														<?php } ?>
													</select>
													
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Lunar Tithi</label>
											<div class="inputer">
												<div class="input-wrapper">
													<select name="lunar_tithi" class="form-control" required>
														<option value="">-Select-</option>
														<?php
															foreach($trith_result->user_array as $trith_value){
														?>
															<option value="<?php echo $trith_value->name_hindi;?>"><?php echo $trith_value->name_hindi;?></option>
														<?php } ?>
														
													</select>
													
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Shubh Din?</label>
											<div class="clearfix">
												<div class="radioer form-inline">
													<input type="radio" name="shubh_din" id="radioColor15" value="Yes" checked="checked">
													<label for="radioColor15">Yes</label>
												</div>
												<div class="radioer form-inline">
													<input type="radio" name="shubh_din" id="radioColor16" value="No">
													<label for="radioColor16">No</label>
												</div>
											</div>
										</div><!--.form-group-->
									</div>
								
									
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Lunar Cycle</label>
											<div class="clearfix">
												<div class="radioer form-inline">
													<input type="radio" name="lunar_cycle" id="radioColor17" value="Shukla" checked="checked">
													<label for="radioColor17">Shukla</label>
												</div>
												<div class="radioer form-inline">
													<input type="radio" name="lunar_cycle" id="radioColor18" value="Krushna">
													<label for="radioColor18">Krushna</label>
												</div>
										</div><!--.form-group-->
									</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Description</label>
											<div class="inputer">
												<div class="input-wrapper">
													<textarea name="description" class="form-control"></textarea>
												</div>
											</div>
											</div>
										</div><!--.form-group-->
									</div>
								</div><!--.row-->

							</div><!--.form-content-->

							<div class="form-buttons form-group clearfix">
								<div class="pull-left">
									<button type="submit" name="add_panchang_submit" value="1"  class="btn btn-blue">Submit</button>
									<button type="button" class="btn btn-flat btn-default">Cancel</button>
								</div>
							</div>
						</form>
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

