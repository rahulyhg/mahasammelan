<?php

require_once('config/Query.Inc.php');

include_once("check-login.php");

$Obj = new Query(DB_NAME);

$result = $Obj->httpGet(ADMIN_URL.'api/panchang');

$panchang_result  = json_decode($result);

include_once("table-header.php");



?>



	<div class="content">



		<div class="page-header full-content">

			<div class="row">

			  <div class="col-sm-6">

				<h1>Panchang</h1>

			  </div>

			</div>

		  </div><!--.page-header-->



		<div class="row">

			<div class="col-md-12">

				<div class="panel">

					<div class="panel-heading">

						<div class="panel-title">

							<h4>

								Panchang 

							</h4>

						</div>

					</div><!--.panel-heading-->

					<div class="panel-body">



						<div class="overflow-table">
	
						<table class="display datatables-basic">

							<thead>

								<tr>

									<th>Date</th>

									<th>Weekday</th>

									<th>Lunar Year</th>

									<th>Lunar Month</th>

									<th>Actions</th>

								</tr>

							</thead>



							<tfoot>

								<tr>

									<th>Date</th>

									<th>Weekday</th>

									<th>Lunar Year</th>

									<th>Lunar Month</th>

									<th>Actions</th>

							</tr>

							</tfoot>



							<tbody>

								<?php

									if(!empty($panchang_result->success)){
										
										$i=0;
										foreach($panchang_result->panchang_array as $panchang_value){

								?>

								<tr>

									<td><?php echo $panchang_value->date; ?></td>

									<td><?php echo $panchang_value->weekday; ?></td>

									<td><?php echo $panchang_value->lunar_year; ?></td>

									<td><?php echo $panchang_value->lunar_month; ?></td>
								

									<td>

										<a class="" href="edit-panchang.php?id=<?php echo $Obj->encrypt($panchang_value->id); ?>">Edit</a>

										<a class="" href="#" onclick="deleteData('<?php echo $panchang_value->id; ?>','panchang','id','panchang.php')">Delete</a>


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

