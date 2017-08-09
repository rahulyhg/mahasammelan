<?php

require_once('config/Query.Inc.php');

include_once("check-login.php");

$Obj = new Query(DB_NAME);

$result = $Obj->httpGet(ADMIN_URL.'api/video');

$gallery_result  = json_decode($result);

include_once("table-header.php");


?>



	<div class="content">



		<div class="page-header full-content">

			<div class="row">

			  <div class="col-sm-6">

				<h1>Video Gallery</h1>

			  </div>

			</div>

		  </div><!--.page-header-->



		<div class="row">

			<div class="col-md-12">

				<div class="panel">

					<div class="panel-heading">

						<div class="panel-title">

							<h4>

								Video Gallery 

							</h4>

						</div>

					</div><!--.panel-heading-->

					<div class="panel-body">



						<div class="overflow-table">

						<table class="display datatables-basic">

							<thead>

								<tr>

									<th>Title</th>

									<th>Actions</th>

								</tr>

							</thead>



							<tfoot>

								<tr>

									<th>Title</th>

									<th>Actions</th>

							</tr>

							</tfoot>



							<tbody>

								<?php

									if(!empty($gallery_result->success)){

										foreach($gallery_result->gallery_array as $gallery_value){

								?>

								<tr>

									<td><?php echo $gallery_value->title; ?></td>

									<td>

										<a class="" href="edit_video_gallery.php?id=<?php echo $Obj->encrypt($gallery_value->v_id); ?>">Edit</a>



										<a class="" href="#" onclick="deleteData('<?php echo $gallery_value->v_id; ?>','video','v_id','video_gallery.php')">Delete</a>


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

