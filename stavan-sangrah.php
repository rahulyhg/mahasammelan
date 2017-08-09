<?php

require_once('config/Query.Inc.php');

include_once("check-login.php");

$Obj = new Query(DB_NAME);

$result = $Obj->httpGet(ADMIN_URL.'api/stavansangrah');

$stavan_result  = json_decode($result);

include_once("table-header.php");


?>



	<div class="content">



		<div class="page-header full-content">

			<div class="row">

			  <div class="col-sm-6">

				<h1>Stavan Sangrah</h1>

			  </div>

			</div>

		  </div><!--.page-header-->



		<div class="row">

			<div class="col-md-12">

				<div class="panel">

					<div class="panel-heading">

						<div class="panel-title">

							<h4>

								Stavan Sangrah 

							</h4>

						</div>

					</div><!--.panel-heading-->

					<div class="panel-body">



						<div class="overflow-table">

						<table class="display datatables-basic">

							<thead>

								<tr>

									<th>Title</th>

									<th>Type</th>

									<th>Audio File</th>

									<th>Actions</th>

								</tr>

							</thead>



							<tfoot>

								<tr>

									<th>Title</th>

									<th>Type</th>

									<th>Audio File</th>

									<th>Actions</th>

							</tr>

							</tfoot>



							<tbody>

								<?php

									if(!empty($stavan_result->success)){

										foreach($stavan_result->stavan_array as $stavan_value){

								?>

								<tr>

									<td><?php echo $stavan_value->title; ?></td>

									<td><?php echo $stavan_value->type; ?></td>

									<td>
										<?php if(!empty($stavan_value->audio_file)){ 
										 
										?>
										<audio controls>
										  <source src="<?php echo 'uploads/'.$stavan_value->audio_file; ?>" type="audio/mpeg">
											Your browser does not support the audio element.
										</audio>
										
										<?php
										}else{ 
											echo 'Not Available'; 
										
										} ?></td>

									<td>

										<a class="" href="edit-stavan-sangrah.php?id=<?php echo $Obj->encrypt($stavan_value->id); ?>">Edit</a>

										<a class="" href="#" onclick="deleteData('<?php echo $stavan_value->id; ?>','stavansangrah','id','stavan-sangrah.php')">Delete</a>


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

