<?php

require_once('config/Query.Inc.php');

include_once("check-login.php");

$Obj = new Query(DB_NAME);

$result = $Obj->httpGet(ADMIN_URL.'api/religiousplaces/tirth');

$place_result  = json_decode($result);
    //print_r($place_result); die;

include_once("table-header.php");


?>



	<div class="content">



		<div class="page-header full-content">

			<div class="row">

			  <div class="col-sm-6">

				<h1>Tirth</h1>

			  </div>

			</div>

		  </div><!--.page-header-->



		<div class="row">

			<div class="col-md-12">

				<div class="panel">

					<div class="panel-heading">

						<div class="panel-title">

							<h4>

								Tirth 

							</h4>

						</div>

					</div><!--.panel-heading-->

					<div class="panel-body">



						<div class="overflow-table">

						<table class="display datatables-basic">

							<thead>

								<tr>

									<th>Tirth Name</th>

									<th>Tirth Address</th>

									<th>Actions</th>

								</tr>

							</thead>



							<tfoot>

								<tr>

									<th>Dadawadi Name</th>

									<th>Dadawadi Address</th>

									<th>Actions</th>

							</tr>

							</tfoot>



							<tbody>

								<?php

									if(!empty($place_result->success)){

										foreach($place_result->place_array as $place_value){

								?>

								<tr>

									<td><?php echo $place_value->name; ?></td>

									<td><?php echo $place_value->address; ?></td>

									<td>

										<a class="" href="edit-tirth.php?id=<?php echo $Obj->encrypt($place_value->id); ?>">Edit</a>

										<a class="" href="#" onclick="deleteData('<?php echo $place_value->id; ?>','religious_places','id','tirth.php')">Delete</a>


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

