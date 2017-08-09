
	<!-- BEGIN GLOBAL AND THEME VENDORS -->
	<script src="assets/globals/js/global-vendors.js"></script>
	<!-- END GLOBAL AND THEME VENDORS -->

	<!-- BEGIN PLUGINS AREA -->
	<!-- The Templates plugin is included to render the upload/download listings -->
	<script src="assets/globals/plugins/blueimp-tmpl/js/tmpl.min.js"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="assets/globals/plugins/blueimp-load-image/js/load-image.all.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="assets/globals/plugins/blueimp-canvas-to-blob/js/canvas-to-blob.min.js"></script>
	<!-- blueimp Gallery script -->
	<script src="assets/globals/plugins/blueimp-gallery/js/jquery.blueimp-gallery.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="assets/globals/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="assets/globals/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
	<!-- The File Upload processing plugin -->
	<script src="assets/globals/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
	<!-- The File Upload image preview & resize plugin -->
	<script src="assets/globals/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
	<!-- The File Upload audio preview plugin -->
	<script src="assets/globals/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
	<!-- The File Upload video preview plugin -->
	<script src="assets/globals/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
	<!-- The File Upload validation plugin -->
	<script src="assets/globals/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
	<!-- The File Upload user interface plugin -->
	<script src="assets/globals/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
	<!--[if (gte IE 8)&(lt IE 10)]>
	<script src="assets/globals/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js"></script>
	<![endif]-->
	<!-- END PLUGINS AREA -->

	<!-- PLUGINS INITIALIZATION AND SETTINGS -->
	<script src="assets/globals/scripts/forms-multiple-upload.js"></script>
	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->

	<!-- PLEASURE -->
	<script src="assets/globals/js/pleasure.js"></script>
	<!-- ADMIN 1 -->
	<script src="assets/admin1/js/layout.js"></script>

	<!-- BEGIN INITIALIZATION-->
	<script>
	$(document).ready(function () {
		Pleasure.init();
		Layout.init();
		FormsMultipleUpload.init();
	});
	

	 $('.delete-image').click(function(e) {	
			
			var delete_id = this.id;
			var image_name = $("#"+delete_id+"_image").val();
			var table_name = 'gallery_images';
			var field_name = 'id';
			
			//alert(image_name);
			
			if(confirm("Are you sure to delete?")){

				$.ajax({

				  type: 'POST',

				  url: 'ajax-delete.php',

				  data: {'action' : 'ajax_request', 'delete_id': delete_id,'table_name':table_name, 'field_name': field_name, 'image_name':image_name},

				  success: function(data) {

				  	//$("#"+delete_id+"_image").val(data);										  

				  }

				});     

				

			}else{

				return false;

			}
			

	});




	</script>


</body>



<!-- Mirrored from teamfox.co/themes/pleasure/app/admin1/forms-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Jul 2015 06:04:26 GMT -->

</html>
