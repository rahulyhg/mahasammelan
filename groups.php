<?php

require_once('config/Query.Inc.php');

include_once("check-login.php");

$Obj = new Query(DB_NAME);

$result = $Obj->httpGet(ADMIN_URL.'api/groups');

$group_result  = json_decode($result);

include_once("table-header.php");



?>



	<div class="content">



		<div class="page-header full-content">

			<div class="row">

			  <div class="col-sm-6">

				<h1>Groups</h1>

			  </div>

			</div>

		  </div><!--.page-header-->



		<div class="row">

			<div class="col-md-12">

				<div class="panel">

					<div class="panel-heading">

						<div class="panel-title">

							<h4>

								Groups 

							</h4>

						</div>

					</div><!--.panel-heading-->

					<div class="panel-body">



						<div class="overflow-table">
	
						<table class="display datatables-basic">

							<thead>

								<tr>

									<th>Group Name</th>

									<th>Head of Group</th>

									<th>Group Members</th>

									<th>Created Date</th>

									<th>Actions</th>

								</tr>

							</thead>



							<tfoot>

								<tr>

									<th>Group Name</th>

									<th>Head of Group</th>

									<th>Group Members</th>

									<th>Created Date</th>

									<th>Actions</th>

							</tr>

							</tfoot>



							<tbody>

								<?php

									if(!empty($group_result->success)){
										
										$i=0;
										foreach($group_result->group_array as $group_value){

								?>

								<tr>

									<td><?php echo $group_value->group_name;//print_r($group_value->member_array); ?></td>

									<td><?php echo $group_value->group_head." (".$group_value->user_type.")"; ?></td>

									<td>
										<a class="btn btn-default" data-toggle="modal" data-target="#defaultModal<?php echo $i; ?>">View</a>
										<div class="modal scale fade" id="defaultModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title"><?php echo $group_value->group_name; ?></h4>
													</div>
													<div class="modal-body">

														<table class="display datatables-basic">

															<thead>

																<tr>

																	<th><center>Username</center></th>

																</tr>

															</thead>



															<tfoot>

																<tr>

																	<th><center>Username</center></th>

																</tr>

															</tfoot>



															<tbody>

																<?php

																	if(!empty($group_value->member_array)){

																		foreach($group_value->member_array as $member_value){

																?>

																			<tr>

																				<td><center><?php echo $member_value->username; ?></center></td>

																			</tr>

																<?php

																	}

																}

																?>	

															</tbody>

														</table>


													</div>
													<div class="modal-footer">
													</div>
												</div><!--.modal-content-->
											</div><!--.modal-dialog-->
										</div><!--.modal-->


										
									</td>

									<td><?php echo date('d-M-Y h:i:s',strtotime($group_value->created_date)); ?></td>

									<td>

										<a class="" href="edit-group.php?id=<?php echo $Obj->encrypt($group_value->id); ?>">Edit</a>

										<a class="" href="#" onclick="deleteData('<?php echo $group_value->id; ?>','groups','id','groups.php')">Delete</a>


									</td>									

									

								</tr>

								<?php
										$i++;
									}

								}

								?>	

							</tbody>

						</table>

						</div><!--.overflow-table-->



					</div><!--.panel-body-->

				</div><!--.panel-->

			</div><!--.col-md-12-->

		</div><!--.row-->



		<!--.row-->



		<!--.footer-links-->



	</div><!--.content-->



	<div class="layer-container">



		<!-- BEGIN MENU LAYER -->

		<?php

			include_once("menu.php");

		?>		

		<!-- END OF MENU LAYER -->



	</div><!--.layer-container-->

<?php

	include_once('table-footer.php');

?>	

