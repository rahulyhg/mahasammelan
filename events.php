<?php

require_once('config/Query.Inc.php');

include_once("check-login.php");

$Obj = new Query(DB_NAME);

$result = $Obj->httpGet(ADMIN_URL.'api/events');

$event_result  = json_decode($result);

include_once("table-header.php");


?>



	<div class="content">



		<div class="page-header full-content">

			<div class="row">

			  <div class="col-sm-6">

				<h1>Events</h1>

			  </div>

			</div>

		  </div><!--.page-header-->



		<div class="row">

			<div class="col-md-12">

				<div class="panel">

					<div class="panel-heading">

						<div class="panel-title">

							<h4>

								Events 

							</h4>

						</div>

					</div><!--.panel-heading-->

					<div class="panel-body">



						<div class="overflow-table">

						<table class="display datatables-basic">

							<thead>

								<tr>

									<th>Events Name</th>

									<th>Event Date & Time</th>

									<th>Actions</th>

								</tr>

							</thead>



							<tfoot>

								<tr>

									<th>Events Name</th>

									<th>Event Date & Time</th>

									<th>Actions</th>

							</tr>

							</tfoot>



							<tbody>

								<?php

									if(!empty($event_result->success)){

										foreach($event_result->event_array as $event_value){

								?>

								<tr>

									<td><?php echo $event_value->event_name; ?></td>

									<td><?php echo $event_value->event_date_time; ?></td>

									<td>

										<a class="" href="edit-event.php?id=<?php echo $Obj->encrypt($event_value->id); ?>">Edit</a>

										<a class="" href="#" onclick="deleteData('<?php echo $event_value->id; ?>','events','id','events.php')">Delete</a>


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


	</div><!--.layer-container-->

<?php

	include_once('table-footer.php');

?>	

