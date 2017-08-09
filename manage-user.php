<?php

require_once('config/Query.Inc.php');

include_once("check-login.php");

$Obj = new Query(DB_NAME);

$result = $Obj->httpGet(ADMIN_URL.'api/admin/users/status/'.'User');
$user_result = json_decode($result);

include_once("table-header.php");



?>



	<div class="content">



		<div class="page-header full-content">

			<div class="row">

			  <div class="col-sm-6">

				<h1>Users</h1>

			  </div>

			</div>

		  </div>

<!--			<button class="btn btn-default" data-toggle="modal" data-target="#defaultModal">Launch Default Modal</button>

-->  

			  <div class="modal scale fade" id="defaultModal" tabindex="-1" role="dialog" aria-hidden="true">

					<div class="modal-dialog">

						<div class="modal-content">

							<div class="modal-header">

								<h4 class="modal-title">&nbsp;</h4>

							</div>

							<div class="modal-body">

								Are you sure to delete this user?

							</div>

							<div class="modal-footer">

								<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>

								<button type="button" class="btn btn-flat btn-primary">Delete</button>

							</div>

						</div><!--.modal-content-->

					</div><!--.modal-dialog-->

				</div>



		<!--<div class="page-header full-content bg-blue-grey">

			<div class="row">

				<div class="col-sm-6">

					<h1>Users</h1>

				</div>

				<div class="col-sm-6">

					<ol class="breadcrumb">

						<li><a href="#"><i class="ion-home"></i></a></li>

						<li><a href="#">Tables</a></li>

						<li><a href="#" class="active">Datatables</a></li>

					</ol>

				</div>

			</div>

		</div>-->

		



		<div class="row">

			<div class="col-md-12">

				<div class="panel">

					<div class="panel-heading">

						<div class="panel-title">

							<h4>

									<?php

										if(empty($_GET['user_type']) || $_GET['user_type'] == 'all' )

											echo 'All Users'; 

										else if($_GET['user_type'] == 'sadhu')

											echo "All Sadhu's"; 

										else if($_GET['user_type'] == 'shravak')

											echo "All Shravak's"; 


									?>

									

							

							</h4>

						</div>

					</div><!--.panel-heading-->

					<div class="panel-body">



						<div class="overflow-table">

						<table class="display datatables-basic">

							<thead>

								<tr>

									<th>ID</th>

									<th>User Type</th>

									<th>Username</th>

									<th>Email</th>

									<th>Mobile Number</th>

									<th>Group Name</th>

									<th>Join Date</th>

									<th>Actions</th>

								</tr>

							</thead>



							<tfoot>

								<tr>

									<th>ID</th>

									<th>User Type</th>

									<th>Username</th>

									<th>Email</th>

									<th>Mobile Number</th>

									<th>Group Name</th>

									<th>Join Date</th>

									<th>Actions</th>
								</tr>

							</tfoot>



							<tbody>

								<?php

									if(!empty($user_result->success)){

										foreach($user_result->user_array as $user_value){

								?>

								<tr>

									<td><?php echo $user_value->user_id; ?></td>
									
									<td><?php if(empty($user_value->user_type)) { echo 'Not Available'; }else{echo $user_value->user_type;} ?></td>

									<td><?php echo $user_value->username; ?></td>

									<td><?php echo $user_value->email_address; ?></td>

									<td><?php echo $user_value->mobile_number; ?></td>

									<td><?php echo $user_value->group_name; ?></td>

									<td>
										
									  <span style="display:none">

									  	<?php 

												$date = date_create($user_value->join_date);

												echo date_format($date,"Y/m/d");

										?>

									 </span>
										<?php
											echo date('d-M-Y H:i:s ',strtotime($user_value->join_date));
										?>
									
									</td>

									<td>
										<a class="" href="edit-user.php?id=<?php echo $Obj->encrypt($user_value->user_id); ?>">Edit</a>
										&nbsp;&nbsp;&nbsp;	
										<a class="" href="#" onclick="deleteData('<?php echo $user_value->user_id; ?>','app_users','user_id','users.php?user_type=<?php echo $_GET['user_type']; ?>')">Delete</a>
									</td>									


								</tr>

								<?php

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

