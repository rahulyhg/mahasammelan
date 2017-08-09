<?php

require_once('config/Query.Inc.php');

//include_once("check-login.php");

$Obj = new Query(DB_NAME);

$error_msg = '';


if(isset($_POST['add_user_submit']) && !empty($_POST['add_user_submit'])){
	//echo "<pre>";
	//print_r($_POST);
	//print_r($_FILES);
	//die;
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
			$profile_photo = $_POST['old_image'];;
		}
	   
	  
	$postfields = array('group_id'=>$_POST['group_id'],'username'=>trim($_POST['username']),
	'username_hindi'=> urlencode(trim($_POST['username_hindi'])),
	'email_address'=>trim($_POST['email_address']),
	'address'=>trim($_POST['address']),
	'mobile_number'=>$_POST['mobile_number'],'password'=>$_POST['password'],
	'user_type'=>$_POST['user_type'],
	
	'image'=>$profile_photo,'diksha_date'=>$_POST['diksha_date']);
	
	
	
	$result = $Obj->httpPost(ADMIN_URL.'api/user/add',$postfields);
	$result = json_decode($result);
	// print_r($result); //die;
	$_SESSION['user_id_check'] = $result->user_array->user_id ;
	$USER_ID = $result->user_array->user_id ; 
	
	     $Obj->Redirect("add-user.php#tab_panel-tab4");
	    
}
   $result = $Obj->httpGet(ADMIN_URL.'api/groups');

$group_result  = json_decode($result);

     

if(isset($_POST['add_note_submit']) && !empty($_POST['add_note_submit'])){

	
  
	
    $postfields = array('user_id'=>$_POST['user_id'],'sadhu_name_hindi'=>trim($_POST['sadhu_name_hindi']),
								'sadhu_name_eng'=>$_POST['sadhu_name_eng'],
								'diksha_parada_hindi'=>$_POST['diksha_parada_hindi'],
								'diksha_parada_eng'=>$_POST['diksha_parada_eng'],
								'guru_hindi'=>$_POST['guru_hindi'], 
								'guru_eng'=>$_POST['guru_eng'],
								 'guru_hindi'=>$_POST['guru_hindi'], 
								 'sadhu_mandal_hindi'=>$_POST['sadhu_mandal_hindi'] ,
								 'sadhu_mandal_eng'=>$_POST['sadhu_mandal_eng'],
								  'dikhha_date'=>$_POST['dikhha_date'],
								 'dikhsa_place_hindi'=>$_POST['dikhsa_place_hindi'], 
								 'dikhsa_place_eng'=>$_POST['dikhsa_place_eng'], 
								 'badi_diksha_pradata_hindi'=>$_POST['badi_diksha_pradata_hindi'] ,
								  'badi_diksha_pradata_eng'=>$_POST['badi_diksha_pradata_eng'],
								   'badi_dikhsa_date'=>$_POST['badi_dikhsa_date'],
								   'badi_diksha_place_hindi'=>$_POST['badi_diksha_place_hindi'],
								   'badi_diksha_place_eng'=>$_POST['badi_diksha_place_eng'] ,
								   
								   'sadhu_person_first_hindi'=>trim($_POST['sadhu_person_first_hindi']),
								'sadhu_person_first_eng'=>$_POST['sadhu_person_first_eng'],
								'relation_first_hindi'=>$_POST['relation_first_hindi'],
								'relation_first_eng'=>$_POST['relation_first_eng'],
								'sadhu_person_secondt_eng'=>$_POST['sadhu_person_secondt_eng'], 
								'sadhu_person_secondt_hindi'=>$_POST['sadhu_person_secondt_hindi'],
								 'relation_second_hindi'=>$_POST['relation_second_hindi'], 
								 'relation_second_eng'=>$_POST['relation_second_eng'] ,
								 'sadhu_person_third_hind'=>$_POST['sadhu_person_third_hind'],
								  'sadhu_person_third_eng'=>$_POST['sadhu_person_third_eng'],
								 'relation_third_hindi'=>$_POST['relation_third_hindi'], 
								 'relation_third_eng'=>$_POST['relation_third_eng'], 
								 'sadhu_person_fourth_hindi'=>$_POST['sadhu_person_fourth_hindi'] ,
								  'sadhu_person_fourth_eng'=>$_POST['sadhu_person_fourth_eng'],
								   'relation_fourth_hindi'=>$_POST['relation_fourth_hindi'],
								   'relation_fouth_eng'=>$_POST['relation_fouth_eng'],
								   'sadhu_person_fifth_hindi'=>$_POST['sadhu_person_fifth_hindi'] ,
								   
								   'sadhu_person_fifth_eng'=>$_POST['sadhu_person_fifth_eng'],
								   'relation_fifth_hindi'=>$_POST['relation_fifth_hindi'],
								   'relation_fifth_eng'=>$_POST['relation_fifth_eng'],
								   
								   
								   
								    'user_name_hindi'=>trim($_POST['user_name_hindi']),
								'user_name_eng'=>$_POST['user_name_eng'],
								'dob'=>$_POST['dob'],
								'birth_place_hindi'=>$_POST['birth_place_hindi'],
								'birth_place_eng'=>$_POST['birth_place_eng'], 
								'father_name_hindi'=>$_POST['father_name_hindi'],
								 'father_name_eng'=>$_POST['father_name_eng'], 
								 'gotra_hindi'=>$_POST['gotra_hindi'] ,
								 'gotra_eng'=>$_POST['gotra_eng'],
								  'mother_name_hindi'=>$_POST['mother_name_hindi'],
								 'mother_name_eng'=>$_POST['mother_name_eng'],
								
								   
								    'degree_eng'=> $_POST['degree_eng'],
								'degree_hindi'=>$_POST['degree_hindi'],
								'sadhana_place_eng'=>$_POST['sadhana_place_eng'],
								'sadhana_place_hindi'=>$_POST['sadhana_place_hindi'],
								'vihar_place_eng'=>$_POST['vihar_place_eng'], 
								'vihar_place_hindi'=>$_POST['vihar_place_hindi'],
								 'chaturmars_vivran_eng'=>$_POST['chaturmars_vivran_eng'], 
								 'chaturmars_vivran_hindi'=>$_POST['chaturmars_vivran_hindi'] ,
								 'aagam_gyan_eng'=>$_POST['aagam_gyan_eng'],
								  'aagam_gyan_hindi'=>$_POST['aagam_gyan_hindi'],
								 'tatv_gyan_eng'=>$_POST['tatv_gyan_eng'],
								 'tatv_gyan_hindi'=>$_POST['tatv_gyan_hindi'],
								'tap_vivran_eng'=>$_POST['tap_vivran_eng'],
								'language_gyan_eng'=>$_POST['language_gyan_eng'],
								'pratistha_vivran_eng'=>$_POST['pratistha_vivran_eng'], 
								'tap_vivran_hindi'=>$_POST['tap_vivran_hindi'],
								 'language_gyan_hindi'=>$_POST['language_gyan_hindi'], 
								 'pratistha_vivran_hindi'=>$_POST['pratistha_vivran_hindi'] ,
								 'diksha_sadhu_eng'=>$_POST['diksha_sadhu_eng'],
								  'diksha_sadhu_hindi'=>$_POST['diksha_sadhu_hindi']);
								 
			
				$result = $Obj->httpPost(ADMIN_URL.'api/user/add/New/diksha/form',$postfields);
	              //print_r($result); die;
	              $Obj->Redirect("users.php?user_type=all");
	 
			unset($_SESSION['user_id_check']);
}







// Get user info

$result = $Obj->httpGet(ADMIN_URL.'api/user/info/'.$user_id);

$user_result = json_decode($result);
print_r($user_result);
// Get group info

$result = $Obj->httpGet(ADMIN_URL.'api/groups');

$group_result  = json_decode($result);

include_once('form-header.php');?>

<div class="content">



	<div class="page-header full-content">

		<div class="row">

		  <div class="col-sm-6">

			<h1>Users</h1>

		  </div>

		</div>

	  </div>

		  

		<div class="row">



			<div class="col-md-12">

				<div class="panel">

					<div class="panel-heading">

						<div class="panel-title"><h4>&nbsp;</h4></div>

						

						<ul class="nav nav-tabs with-panel">
                   
							<li class="active"><a href="#panel-tab1" data-toggle="tab" class="btn-ripple">Add User</a></li>
							
						<?php if($user_result->user_array->user_type == 'User'){?>
										
											<?php }else{?>
								
							<li><a href="#panel-tab4" data-toggle="tab" class="btn-ripple">Diksha Vivran</a></li>
								<?php  }?>
						</ul>

					</div>

					<div class="panel-body">

						<div class="tab-content with-panel">

							<div id="panel-tab1" class="tab-pane active">

		

		

								<?php

									if(!empty($error_msg)){

								?>

								<div class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>

								<?php } ?>

									<form action="" class="form-horizontal parsley-validate" method="post" enctype="multipart/form-data">
								<input type="hidden" name="old_image"  class="form-control" value="<?php echo $edit_result->result_array->image ?>" />
							<div class="form-body">

								<div class="form-group">
									<label class="control-label col-md-3">Group Name</label>
									<div class="col-md-5">
											<div class="input-wrapper">
												<select name="group_id" class="selecter">
													<option value="">-Select-</option>
													<?php
														if(!empty($group_result->success)){
															foreach($group_result->group_array as $group_value){
													?>
															<option value="<?php echo $group_value->id; ?>"><?php echo $group_value->group_name.' ('.$group_value->group_head.')'; ?></option>
													<?php
															}
														}
													?>
												</select>
										</div>
									</div>
								</div>
			
								<div class="form-group">
									<label class="control-label col-md-3">Date of Diksha</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" style="width: 200px" name="diksha_date" class="form-control bootstrap-daterangepicker-basic" value="<?php if(!empty($_POST['diksha_date'])){ echo $_POST['diksha_date']; } ?>" readonly />
											</div>
										</div>
									</div>
								</div>
			
								<div class="form-group">
									<label class="control-label col-md-3">Username</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" name="username" class="form-control" value="<?php if(!empty($_POST['username'])){ echo $_POST['username']; } ?>"  required>
											</div>
										</div>
									</div>
								</div>
			
			
			
			<div class="form-group">
									<label class="control-label col-md-3">Username (Hindi)</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" name="username_hindi" class="form-control" value="<?php if(!empty($_POST['username_hindi'])){ echo $_POST['username_hindi']; } ?>"  required>
											</div>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-3">Email Address</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="email" name="email_address" class="form-control" placeholder="someone@exmail.org" value="<?php if(!empty($_POST['email_address'])){ echo $_POST['email_address']; } ?>"  required>
											</div>
										</div>
									</div>
								</div>
                                   <div class="form-group">
									<label class="control-label col-md-3">Address</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" name="address" class="form-control" value="<?php if(!empty($_POST['address'])){ echo $_POST['address']; } ?>"  required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Mobile Number</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="number" name="mobile_number" class="form-control"  value="<?php if(!empty($_POST['mobile_number'])){ echo $_POST['mobile_number']; } ?>"  required>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">Password</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="password" name="password" id="password" class="form-control"  value="<?php if(!empty($_POST['password'])){ echo $_POST['password']; } ?>"  required>
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
								<div class="form-group">
									<label class="control-label col-md-3">User Type</label>
									<div class="col-md-5">
											<div class="input-wrapper">
												<select name="user_type" class="selecter" required="required">
													<option value="">-Select-</option>
													<option value="Sadhu" <?php if($_POST['user_type'] == 'Sadhu') { ?>selected="selected"<?php } ?>>Sadhu</option>
													<option value="Sadhvi" <?php if($_POST['user_type'] == 'Sadhvi') { ?>selected="selected"<?php } ?>>Sadhvi</option>
												</select>
											</div>
									</div>
								</div>
								
								
								
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" name="add_user_submit" value="1"  class="btn btn-primary">Submit</button>
										<button type="button" class="btn btn-default bv-reset">Cancel</button>
									</div>
								</div>
							</div>
						</form>
					
								<?php
									if($_SESSION['admin_status'] == '1'){
								?>
                                   	<div class="form-buttons form-group clearfix">

									<div class="pull-right">

										<button type="submit" name="edit_user_submit" value="1" class="btn btn-blue" form="user_edit_from">Update</button>

										<a href="users.php?user_type=all" class="btn btn-flat btn-default">Cancel</a>

									</div>

								</div>

		

							
                                <?php } ?>

		

							</div>

							<div id="panel-tab3" class="tab-pane">





							</div>

							<div id="panel-tab4" class="tab-pane">

			

		

		

									<form action="" class="parsley-validate" method="post" id="">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id_check']; ?>" />
										

										<div class="form-content">

			

											<div class="row">

										  <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Name (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_name_hindi" class="form-control " value="<?php echo ($user_result->user_array->sadhu_name_hindi); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Name (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_name_eng" class="form-control " value="<?php echo ($user_result->user_array->sadhu_name_eng); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Diksha Parada (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

							<input type="text" style="width: 200px" name="diksha_parada_hindi" class="form-control " value="<?php echo ($user_result->user_array->diksha_parada_hindi); ?>"  />


														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Diksha Parada (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="diksha_parada_eng" class="form-control " value="<?php echo ($user_result->user_array->diksha_parada_eng); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">guru (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="guru_hindi" class="form-control " value="<?php echo ($user_result->user_array->guru_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Guru (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="guru_eng" class="form-control " value="<?php echo ($user_result->user_array->guru_eng); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Mandal (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_mandal_hindi" class="form-control " value="<?php echo ($user_result->user_array->sadhu_mandal_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Mndal (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_mandal_eng" class="form-control " value="<?php echo ($user_result->user_array->sadhu_mandal_eng); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Date of Diksha</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="diksha_date" class="form-control bootstrap-daterangepicker-basic" value="<?php echo date('d/m/Y',strtotime($user_result->user_array->diksha_date)); ?>" readonly />


														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Dikhsa Place (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="dikhsa_place_hindi" class="form-control " value="<?php echo($user_result->user_array->dikhsa_place_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Dikhsa Place (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="dikhsa_place_eng" class="form-control " value="<?php echo ($user_result->user_array->dikhsa_place_eng); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Badi Diksha Pradata (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="badi_diksha_pradata_hindi" class="form-control " value="<?php echo ($user_result->user_array->badi_diksha_pradata_hindi); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Badi Diksha Pradata (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="badi_diksha_pradata_eng" class="form-control " value="<?php echo ($user_result->user_array->badi_diksha_pradata_eng); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Badi Dikhsa Date</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="dikhha_date" class="form-control bootstrap-daterangepicker-basic" value="<?php echo date('m/d/Y',strtotime($user_result->user_array->dikhha_date)); ?>" readonly />

														</div>

													</div>

												</div>
                                                 </div> 
									
												  <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Badi Diksha Place (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="badi_diksha_place_hindi" class="form-control " value="<?php echo ($user_result->user_array->badi_diksha_place_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                  <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Badi Diksha Place (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="badi_diksha_place_eng" class="form-control" value="<?php echo ($user_result->user_array->badi_diksha_place_eng); ?>"   />

														</div>

													</div>

												</div>
                                                 </div> 
                                      <!--for 2-->
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Person First (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_person_first_hindi" class="form-control " value="<?php echo($user_result->user_array->sadhu_person_first_hindi); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Person First (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_person_first_eng" class="form-control " value="<?php echo($user_result->user_array->sadhu_person_first_eng); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Relation First (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="relation_first_hindi" class="form-control " value="<?php echo($user_result->user_array->relation_first_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Relation First (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="relation_first_eng" class="form-control " value="<?php echo($user_result->user_array->relation_first_eng); ?>" />

														</div>

													</div>
    
												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Person Secondt (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_person_secondt_hindi" class="form-control " value="<?php echo($user_result->user_array->sadhu_person_secondt_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                  <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Person Second (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_person_secondt_eng" class="form-control " value="<?php echo($user_result->user_array->sadhu_person_secondt_eng); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Relation Second (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="relation_second_hindi" class="form-control " value="<?php echo($user_result->user_array->relation_second_hindi); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Relation Second (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="relation_second_eng" class="form-control " value="<?php echo($user_result->user_array->relation_second_eng); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Person Third (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_person_third_hind" class="form-control " value="<?php echo($user_result->user_array->sadhu_person_third_hind); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Person Third (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_person_third_eng" class="form-control " value="<?php echo($user_result->user_array->sadhu_person_third_eng); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Relation Third (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="relation_third_hindi" class="form-control " value="<?php echo($user_result->user_array->relation_third_hindi); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Relation Third (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="relation_third_eng" class="form-control " value="<?php echo($user_result->user_array->relation_third_eng); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Person Fourth (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_person_fourth_hindi" class="form-control " value="<?php echo($user_result->user_array->sadhu_person_fourth_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Person Fourth (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_person_fourth_eng" class="form-control " value="<?php echo($user_result->user_array->sadhu_person_fourth_eng); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Relation Fourth (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="relation_fourth_hindi" class="form-control " value="<?php echo($user_result->user_array->relation_fourth_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Relation Fouth (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="relation_fouth_eng" class="form-control " value="<?php echo($user_result->user_array->relation_fouth_eng); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Person Fifth (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_person_fifth_hindi" class="form-control " value="<?php echo($user_result->user_array->sadhu_person_fifth_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhu Person Fifth (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhu_person_fifth_eng" class="form-control " value="<?php echo($user_result->user_array->sadhu_person_fifth_eng); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                  <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Relation Fifth (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="relation_fifth_hindi" class="form-control " value="<?php echo($user_result->user_array->relation_fifth_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                  <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Relation Fifth (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="relation_fifth_eng" class="form-control " value="<?php echo($user_result->user_array->relation_fifth_eng); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 
                                                 
                    <!--for 3-->                                 
                                                 
                                                 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sansarik Name (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="user_name_hindi" class="form-control " value="<?php echo($user_result->user_array->user_name_hindi); ?>"  />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sansarik Name (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="user_name_eng" class="form-control " value="<?php echo($user_result->user_array->user_name_eng); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Date Of Birth</label>

													<div class="inputer">

														<div class="input-wrapper">

			<input type="text" style="width: 200px" name="dob" class="form-control bootstrap-daterangepicker-basic" value="<?php echo date('m/d/Y',strtotime($user_result->user_array->dob)); ?>" required />
														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Birth Place (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="birth_place_hindi" class="form-control " value="<?php echo($user_result->user_array->birth_place_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Birth Place (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="birth_place_eng" class="form-control " value="<?php echo($user_result->user_array->birth_place_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Father Name (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="father_name_hindi" class="form-control " value="<?php echo($user_result->user_array->father_name_hindi); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Father Name (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="father_name_eng" class="form-control " value="<?php echo($user_result->user_array->father_name_eng); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Gotra (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="gotra_hindi" class="form-control " value="<?php echo($user_result->user_array->gotra_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Gotra (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="gotra_eng" class="form-control " value="<?php echo($user_result->user_array->gotra_eng); ?>" />

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Mother Name (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="mother_name_hindi" class="form-control " value="<?php echo($user_result->user_array->mother_name_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Mother Name (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="mother_name_eng" class="form-control " value="<?php echo($user_result->user_array->mother_name_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Degree (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="degree_eng" class="form-control " value="<?php echo($user_result->user_array->degree_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                
												<div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Degree (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="degree_hindi" class="form-control " value="<?php echo($user_result->user_array->degree_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">sadhana Place (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhana_place_eng" class="form-control " value="<?php echo($user_result->user_array->sadhana_place_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Sadhana Place (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="sadhana_place_hindi" class="form-control " value="<?php echo($user_result->user_array->sadhana_place_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Vihar Place(English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="vihar_place_eng" class="form-control " value="<?php echo($user_result->user_array->vihar_place_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Vihar Place (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="vihar_place_hindi" class="form-control " value="<?php echo($user_result->user_array->vihar_place_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Chaturmars Vivran (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="chaturmars_vivran_eng" class="form-control " value="<?php echo($user_result->user_array->chaturmars_vivran_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Chaturmars Vivran (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="chaturmars_vivran_hindi" class="form-control " value="<?php echo($user_result->user_array->chaturmars_vivran_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Aagam Gyan (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="aagam_gyan_eng" class="form-control " value="<?php echo($user_result->user_array->aagam_gyan_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Aagam Gyan (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="aagam_gyan_hindi" class="form-control " value="<?php echo($user_result->user_array->aagam_gyan_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Tatv Gyan (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="tatv_gyan_eng" class="form-control " value="<?php echo($user_result->user_array->tatv_gyan_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Tatv Gyan (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="tatv_gyan_hindi" class="form-control " value="<?php echo($user_result->user_array->tatv_gyan_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Tap Vivran (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="tap_vivran_eng" class="form-control " value="<?php echo($user_result->user_array->tap_vivran_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Tap Vivran (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="tap_vivran_hindi" class="form-control " value="<?php echo($user_result->user_array->degree_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Language Gyan (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="language_gyan_eng" class="form-control " value="<?php echo($user_result->user_array->language_gyan_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Pratistha Vivran (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="pratistha_vivran_eng" class="form-control " value="<?php echo($user_result->user_array->pratistha_vivran_eng); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 
                                                 
                                                 
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Language Gyan (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="language_gyan_hindi" class="form-control " value="<?php echo($user_result->user_array->language_gyan_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                
                                                
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Pratistha Vivran (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="pratistha_vivran_hindi" class="form-control " value="<?php echo($user_result->user_array->pratistha_vivran_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                
                                                
                                                 <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Diksha Sadhu (Hindi)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="diksha_sadhu_hindi" class="form-control " value="<?php echo($user_result->user_array->language_gyan_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                
                                                <div class="col-md-6">

												<div class="form-group">

													<label class="control-label">Diksha Sadhu (English)</label>

													<div class="inputer">

														<div class="input-wrapper">

															<input type="text" style="width: 200px" name="diksha_sadhu_eng" class="form-control " value="<?php echo($user_result->user_array->language_gyan_hindi); ?>"/>

														</div>

													</div>

												</div>
                                                 </div> 
                                                 

												<div class="col-md-6">

													<div class="form-group">

														<div class="pull-right">

															

																<button type="submit" name="add_note_submit" value="1" class="btn btn-blue">Add</button>
                                                                      <a href="users.php?user_type=all" class="btn btn-flat btn-default">Cancel</a>
    
															

														</div>

													</div>

												</div>														

														

											</div>

													

										</div>

		

								

								</form>

								

											

								
			

							</div>

						
						</div>

					</div>

				</div>

			</div>





			<!--.panel-body-->

				</div><!--.panel-->



			</div><!--.col-md-12-->

		</div>

	

</div><!--.content-->



<div class="layer-container">



	<!-- BEGIN MENU LAYER -->

	<?php include_once('menu.php');?>

	<!-- END OF MENU LAYER -->



	<!-- BEGIN SEARCH LAYER -->

	<div class="search-layer">

		<div class="search">

			<form action="http://localhost/andyw-material/manager-area/pages-search-results.html">

				<div class="form-group">

					<input type="text" id="input-search" class="form-control" placeholder="type something">

					<button type="submit" class="btn btn-default disabled"><i class="ion-search"></i></button>

				</div>

			</form>

		</div><!--.search-->



		<div class="results">

			<div class="row">

				<div class="col-md-4">

					<div class="result result-users">

						<h4>USERS <small>(3)</small></h4>



						<ul class="list-material">

							<li class="has-action-left">

								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

								<a href="#" class="visible">

									<div class="list-action-left">

										<img src="assets/globals/img/faces/1.jpg" class="face-radius" alt="">

									</div>

									<div class="list-content">

										<span class="title">Pari Subramanium</span>

										<span class="caption">Legacy Response Assistant</span>

									</div>

								</a>

							</li>

							<li class="has-action-left">

								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

								<a href="#" class="visible">

									<div class="list-action-left">

										<img src="assets/globals/img/faces/10.jpg" class="face-radius" alt="">

									</div>

									<div class="list-content">

										<span class="title">Andrew Fox</span>

										<span class="caption">National Branding Technician</span>

									</div>

								</a>

							</li>

							<li class="has-action-left">

								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

								<a href="#" class="visible">

									<div class="list-action-left">

										<img src="assets/globals/img/faces/11.jpg" class="face-radius" alt="">

									</div>

									<div class="list-content">

										<span class="title">Lieke Vermeulen</span>

										<span class="caption">Global Tactics Consultant</span>

									</div>

								</a>

							</li>

						</ul>



					</div><!--.results-user-->

				</div><!--.col-->

				<div class="col-md-4">

					<div class="result result-posts">

						<h4>POSTS <small>(5)</small></h4>



						<ul class="list-material">

							<li class="has-action-left">

								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

								<a href="#" class="visible">

									<div class="list-action-left">

										<img src="assets/globals/img/picjumbo/1.jpg" class="img-radius" alt="">

									</div>

									<div class="list-content">

										<span class="title">Mobile Trends for 2015</span>

										<span class="caption">Collaboratively administrate empowered markets via plug-and-play networks.</span>

									</div>

								</a>

							</li>

							<li class="has-action-left">

								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

								<a href="#" class="visible">

									<div class="list-action-left">

										<img src="assets/globals/img/picjumbo/10.jpg" class="img-radius" alt="">

									</div>

									<div class="list-content">

										<span class="title">Interview with Phillip Riley</span>

										<span class="caption">Dynamically procrastinate B2C users after installed base benefits.</span>

									</div>

								</a>

							</li>

							<li class="has-action-left">

								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

								<a href="#" class="visible">

									<div class="list-action-left">

										<img src="assets/globals/img/picjumbo/11.jpg" class="img-radius" alt="">

									</div>

									<div class="list-content">

										<span class="title">Workspaces</span>

										<span class="caption">Dramatically visualize customer directed convergence without revolutionary ROI.</span>

									</div>

								</a>

							</li>

							<li class="has-action-left">

								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

								<a href="#" class="visible">

									<div class="list-action-left">

										<img src="assets/globals/img/picjumbo/5.jpg" class="img-radius" alt="">

									</div>

									<div class="list-content">

										<span class="title">Graphics &amp; Multimedia</span>

										<span class="caption">Efficiently unleash cross-media information without cross-media value.</span>

									</div>

								</a>

							</li>

							<li class="has-action-left">

								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

								<a href="#" class="visible">

									<div class="list-action-left">

										<img src="assets/globals/img/picjumbo/6.jpg" class="img-radius" alt="">

									</div>

									<div class="list-content">

										<span class="title">Interactive Storytelling</span>

										<span class="caption">Quickly maximize timely deliverables for real-time schemas.</span>

									</div>

								</a>

							</li>

						</ul>



					</div><!--.results-posts-->

				</div><!--.col-->

				<div class="col-md-4">

					<div class="result result-files">

						<h4>FILES <small>(0)</small></h4>

						<p>No results were found</p>

					</div><!--.results-files-->

				</div><!--.col-->



			</div>

		</div><!--.results-->

	</div><!--.search-layer-->

	<!-- END OF SEARCH LAYER -->



	<!-- BEGIN USER LAYER -->

	<div class="user-layer">

		<ul class="nav nav-tabs nav-justified" role="tablist">

			<li class="active"><a href="#messages" data-toggle="tab">Messages</a></li>

			<li><a href="#notifications" data-toggle="tab">Notifications <span class="badge">3</span></a></li>

			<li><a href="#settings" data-toggle="tab">Settings</a></li>

		</ul>



		<div class="row no-gutters tab-content">



			<div class="tab-pane fade in active" id="messages">

				<div class="col-md-4">

					<div class="message-list-overlay"></div>



					<ul class="list-material message-list">

						<li class="has-action-left has-action-right">

							<a href="#" class="visible" data-message-id="1">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/1.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="title">Pari Subramanium</span>

									<span class="caption">Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.</span>

								</div>

								<div class="list-action-right">

									<span class="top">15 min</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right">

							<a href="#" class="visible" data-message-id="2">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/10.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="title">Andrew Fox</span>

									<span class="caption">Dramatically visualize customer directed convergence without revolutionary ROI. Efficiently unleash cross-media information without cross-media value.</span>

								</div>

								<div class="list-action-right">

									<span class="top">2 hr</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right">

							<a href="#" class="visible" data-message-id="3">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/11.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="title">Lieke Vermeulen</span>

									<span class="caption">Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.</span>

								</div>

								<div class="list-action-right">

									<span class="top">Yesterday</span>

									<i class="ion-android-volume-off bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right">

							<a href="#" class="visible" data-message-id="4">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/2.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="title">Benjamin Beck</span>

									<span class="caption">Completely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.</span>

								</div>

								<div class="list-action-right">

									<span class="top">1 week ago</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right">

							<a href="#" class="visible" data-message-id="5">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/12.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="title">Joshua Harris</span>

									<span class="caption">Dynamically innovate resource-leveling customer service for state of the art customer service. Objectively innovate empowered manufactured products whereas parallel platforms.</span>

								</div>

								<div class="list-action-right">

									<span class="top">Jan 10, 2015</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right">

							<a href="#" class="visible" data-message-id="1">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/13.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="title">Lisa Cooper</span>

									<span class="caption">Holisticly predominate extensible testing procedures for reliable supply chains. Dramatically engage top-line web services vis-a-vis cutting-edge deliverables.</span>

								</div>

								<div class="list-action-right">

									<span class="top">Jan 5, 2015</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right">

							<a href="#" class="visible" data-message-id="2">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/16.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="title">Matthew Harris</span>

									<span class="caption">Globally incubate standards compliant channels before scalable benefits. </span>

								</div>

								<div class="list-action-right">

									<span class="top">Jan 4, 2015</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right">

							<a href="#" class="visible" data-message-id="3">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/17.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="title">Diana Nguyen</span>

									<span class="caption">Happy new yeaar!!</span>

								</div>

								<div class="list-action-right">

									<span class="top">Jan 1, 2015</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

					</ul>

				</div><!--.col-->

				<div class="col-md-8">

					<div class="message-send-container">



						<div class="messages">

							<div class="message left">

								<div class="message-text">Hello!</div>

								<img src="assets/globals/img/faces/1.jpg" class="user-picture" alt="">

							</div>

							<div class="message right">

								<div class="message-text">Hi!</div>

								<div class="message-text">Credibly innovate granular internal or "organic" sources whereas high standards in web-readiness. Energistically scale future-proof core competencies vis-a-vis impactful experiences.</div>

								<img src="assets/globals/img/faces/tolga-ergin.jpg" class="user-picture" alt="">

							</div>

							<div class="message left">

								<div class="message-text">Dramatically synthesize integrated schemas with optimal networks.</div>

								<img src="assets/globals/img/faces/1.jpg" class="user-picture" alt="">

							</div>

							<div class="message right">

								<div class="message-text">Interactively procrastinate high-payoff content</div>

								<img src="assets/globals/img/faces/tolga-ergin.jpg" class="user-picture" alt="">

							</div>

							<div class="message left">

								<div class="message-text">Globally incubate standards compliant channels before scalable benefits. Quickly disseminate superior deliverables whereas web-enabled applications. Quickly drive clicks-and-mortar catalysts for change before vertical architectures.</div>

								<div class="message-text">Credibly reintermediate backend ideas for cross-platform models. Continually reintermediate integrated processes through technically sound intellectual capital. Holistically foster superior methodologies without market-driven best practices.</div>

								<img src="assets/globals/img/faces/1.jpg" class="user-picture" alt="">

							</div>

							<div class="message right">

								<div class="message-text">Distinctively exploit optimal alignments for intuitive bandwidth</div>

								<img src="assets/globals/img/faces/tolga-ergin.jpg" class="user-picture" alt="">

							</div>

							<div class="message left">

								<div class="message-text">Quickly coordinate e-business applications through</div>

								<img src="assets/globals/img/faces/1.jpg" class="user-picture" alt="">

							</div>

						</div><!--.messages-->



						<div class="send-message">

							<div class="input-group">

								<div class="inputer inputer-blue">

									<div class="input-wrapper">

										<textarea rows="1" id="send-message-input" class="form-control js-auto-size" placeholder="Message"></textarea>

									</div>

								</div><!--.inputer-->

								<span class="input-group-btn">

									<button id="send-message-button" class="btn btn-blue" type="button">Send</button>

								</span>

							</div>

						</div><!--.send-message-->



					</div><!--.message-send-container-->

				</div><!--.col-->



				<div class="mobile-back">

					<div class="mobile-back-button"><i class="ion-android-arrow-back"></i></div>

				</div><!--.mobile-back-->

			</div><!--.tab-pane #messages-->



			<div class="tab-pane fade" id="notifications">



				<div class="col-md-6 col-md-offset-3">



					<ul class="list-material has-hidden">

						<li class="has-action-left has-action-right has-long-story">

							<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

							<a href="#" class="visible">

								<div class="list-action-left">

									<i class="ion-bag icon text-indigo"></i>

								</div>

								<div class="list-content">

									<span class="caption">Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.</span>

								</div>

								<div class="list-action-right">

									<span class="top">2 hr</span>

									<i class="ion-record text-green bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right has-long-story">

							<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

							<a href="#" class="visible">

								<div class="list-action-left">

									<i class="ion-image text-green icon"></i>

								</div>

								<div class="list-content">

									<span class="caption">Dramatically visualize customer directed convergence without revolutionary ROI. Efficiently unleash cross-media information without cross-media value.</span>

								</div>

								<div class="list-action-right">

									<span class="top">16:55</span>

									<i class="ion-record text-green bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right has-long-story">

							<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

							<a href="#" class="visible">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/13.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="caption">Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.</span>

								</div>

								<div class="list-action-right">

									<span class="top">Yesterday</span>

									<i class="ion-record text-green bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right has-long-story">

							<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

							<a href="#" class="visible">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/14.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="caption">Completely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.</span>

								</div>

								<div class="list-action-right">

									<span class="top">2 days ago</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right has-long-story">

							<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

							<a href="#" class="visible">

								<div class="list-action-left">

									<i class="ion-location text-light-blue icon"></i>

								</div>

								<div class="list-content">

									<span class="caption">Dynamically innovate resource-leveling customer service for state of the art customer service. Objectively innovate empowered manufactured products whereas parallel platforms.</span>

								</div>

								<div class="list-action-right">

									<span class="top">1 week ago</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right has-long-story">

							<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

							<a href="#" class="visible">

								<div class="list-action-left">

									<i class="ion-bookmark text-deep-orange icon"></i>

								</div>

								<div class="list-content">

									<span class="caption">Holisticly predominate extensible testing procedures for reliable supply chains. Dramatically engage top-line web services vis-a-vis cutting-edge deliverables.</span>

								</div>

								<div class="list-action-right">

									<span class="top">10 Jan</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right has-long-story">

							<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

							<a href="#" class="visible">

								<div class="list-action-left">

									<i class="ion-locked icon"></i>

								</div>

								<div class="list-content">

									<span class="caption">Phosfluorescently engage worldwide methodologies with web-enabled technology.</span>

								</div>

								<div class="list-action-right">

									<span class="top">9 Jan</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right has-long-story">

							<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

							<a href="#" class="visible">

								<div class="list-action-left">

									<img src="assets/globals/img/faces/17.jpg" class="face-radius" alt="">

								</div>

								<div class="list-content">

									<span class="caption">Synergistically evolve 2.0 technologies rather than just in time initiatives. Quickly deploy strategic networks with compelling e-business. Credibly pontificate highly efficient manufactured products and enabled data.</span>

								</div>

								<div class="list-action-right">

									<span class="top">7 Jan</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

						<li class="has-action-left has-action-right has-long-story">

							<a href="#" class="hidden"><i class="ion-android-delete"></i></a>

							<a href="#" class="visible">

								<div class="list-action-left">

									<i class="ion-navigate text-indigo icon"></i>

								</div>

								<div class="list-content">

									<span class="caption">Objectively pursue diverse catalysts for change for interoperable meta-services. Dramatically mesh low-risk high-yield alignments before transparent e-tailers.</span>

								</div>

								<div class="list-action-right">

									<span class="top">7 Jan</span>

									<i class="ion-android-done bottom"></i>

								</div>

							</a>

						</li>

					</ul>



				</div><!--.col-->

			</div><!--.tab-pane #notifications-->



			<div class="tab-pane fade" id="settings">

				<div class="col-md-6 col-md-offset-3">



					<div class="settings-panel">

						<p class="text-grey">Here's where you can check your settings of Pleasure Admin Panel. If you need an extra information from us, do not hesitate to contact.</p>



						<div class="legend">Privacy Controls</div>

						<ul>

							<li>

								Show my profile on search results

								<div class="switcher switcher-indigo pull-right">

									<input id="settings1" type="checkbox" hidden="hidden" checked="checked">

									<label for="settings1"></label>

								</div><!--.switcher-->

							</li>

							<li>

								Only God can judge me

								<div class="switcher switcher-indigo pull-right">

									<input id="settings2" type="checkbox" hidden="hidden" checked="checked">

									<label for="settings2"></label>

								</div><!--.switcher-->

							</li>

							<li>

								Review tags people add to your own posts

								<div class="switcher switcher-indigo pull-right">

									<input id="settings3" type="checkbox" hidden="hidden">

									<label for="settings3"></label>

								</div><!--.switcher-->

							</li>

						</ul>



						<div class="legend">Notifications</div>

						<ul>

							<li>

								Activity that involves you

								<div class="switcher switcher-indigo pull-right">

									<input id="settings4" type="checkbox" hidden="hidden" checked="checked">

									<label for="settings4"></label>

								</div><!--.switcher-->

							</li>

							<li>

								Birthdays

								<div class="switcher switcher-indigo pull-right">

									<input id="settings5" type="checkbox" hidden="hidden">

									<label for="settings5"></label>

								</div><!--.switcher-->

							</li>

							<li>

								Calendar events

								<div class="switcher switcher-indigo pull-right">

									<input id="settings6" type="checkbox" hidden="hidden">

									<label for="settings6"></label>

								</div><!--.switcher-->

							</li>

						</ul>



						<div class="legend">Newsletter</div>

						<ul>

							<li>

								Friend requests

								<div class="checkboxer checkboxer-indigo pull-right">

									<input type="checkbox" id="checkboxSettings1" value="option1" checked="checked">

									<label for="checkboxSettings1"></label>

								</div>

							</li>

							<li>

								People you may know

								<div class="checkboxer checkboxer-indigo pull-right">

									<input type="checkbox" id="checkboxSettings2" value="option1">

									<label for="checkboxSettings2"></label>

								</div>

							</li>

						</ul>



					</div><!--.settings-panel-->



				</div><!--.col-->

			</div><!--.tab-pane #settings-->



		</div>

	</div><!--.user-layer-->

	<!-- END OF USER LAYER -->



</div><!--.layer-container-->
<script type="text/javascript">
$(function() {
    $('input[id="birthdate"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    }, 
    function(start, end, label) {
        var years = moment().diff(start, 'years');
        alert("You are " + years + " years old.");
    });
});
</script>
<?php include_once('form-footer.php');?>



