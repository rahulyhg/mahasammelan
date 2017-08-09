	<!-- BEGIN GLOBAL AND THEME VENDORS -->

	<script src="assets/globals/js/global-vendors.js"></script>

	<!-- END GLOBAL AND THEME VENDORS -->



	<!-- BEGIN PLUGINS AREA -->

	<script src="assets/globals/plugins/components-summernote/dist/summernote.min.js"></script>

	<script src="assets/globals/plugins/parsleyjs/dist/parsley.min.js"></script>

	<!-- END PLUGINS AREA -->



	<!-- PLUGINS INITIALIZATION AND SETTINGS -->

	<script src="assets/globals/scripts/forms-validations-parsley.js"></script>

	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->





	<!-- BEGIN PLUGINS AREA -->

	<script src="assets/globals/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

	<script src="assets/globals/plugins/datatables/themes/bootstrap/dataTables.bootstrap.js"></script>

	<!-- END PLUGINS AREA -->



	<!-- PLUGINS INITIALIZATION AND SETTINGS -->

	<script src="assets/globals/scripts/tables-datatables.js"></script>

	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->





	<script src="assets/globals/plugins/chosen/chosen.jquery.min.js"></script>



	<script src="assets/globals/scripts/forms-select.js"></script>



	<script src="assets/globals/plugins/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>




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



	<!-- PLUGINS INITIALIZATION AND SETTINGS -->

	<script src="assets/globals/scripts/forms-multiple-upload.js"></script>

	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->

	<script src="assets/globals/plugins/jquery-progress-bar-file-upload/jquery.form.min.js"></script>

	<!-- BEGIN PLUGINS AREA -->

<!--	<script src="assets/globals/plugins/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
-->
	<!-- END PLUGINS AREA -->



	<!-- BEGIN PLUGINS AREA -->
	<script src="assets/globals/plugins/pnikolov-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/globals/plugins/minicolors/jquery.minicolors.min.js"></script>
	<script src="assets/globals/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- END PLUGINS AREA -->

	<!-- PLUGINS INITIALIZATION AND SETTINGS -->
	<script src="assets/globals/scripts/forms-pickers.js"></script>
	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->






	<!-- PLEASURE -->

	<script src="assets/globals/js/pleasure.js"></script>

	<!-- ADMIN 1 -->

	<script src="assets/admin1/js/layout.js"></script>




<script>

		function deleteData(delete_id,table_name,field_name,redirect_url){

		

			if(confirm("Are you sure to delete?")){

				$.ajax({

				  type: 'POST',

				  url: 'ajax-delete.php',

				  data: {'action' : 'ajax_request', 'delete_id': delete_id,'table_name':table_name, 'field_name': field_name},

				  success: function(data) {

				  	

					window.location.href = redirect_url;

			

					//alert(data);										  

				  }

				});     

				

			}else{

				return false;

			}



		}

	</script>



	<script>

		
	$('.note-editable').summernote({
		enterHtml: '<body><br></body>' // '<br>', '<p>&nbsp;</p>', '<p><br></p>', '<div><br></div>'
	});
	

	var FormsSelect = {



	chosenSelect: function () {

		$('.chosen-select').chosen({

			width: '100%'

		});

	},

	init: function () {

		this.chosenSelect();

	}

}





	

	var FormsTools = {

		inputMaskDate3: function () {

			$('.inputmask-date3').inputmask('d-m-y', {

				'placeholder': 'dd-mm-yyyy'

			});



		},



		init: function () {

			this.inputMaskDate3();

		}

	}

	</script>

<script>

 $(document).ready(function(){

		 $('input[name="date"]').change(function(){

			var date = this.value;
			var a = date.split("/") ;
			date = new Date( a[2], (a[0] - 1), a[1] ) ;
			var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
			var weekday = weekdays[date.getDay()];
			$('input[name="weekday"]').val(weekday);

		});

		 $('#edit_page_submit').submit(function(){

			$('#page_content').val($('.note-editable').html());

		});



		 $('#edit_plan_submit').submit(function(){

			$('#description').val($('.note-editable').html());

		});

		 $('#edit_slider_submit').submit(function(){

			$('#content').val($('.note-editable').html());

		});



		 $('#add_slider_submit').submit(function(){

			$('#content').val($('.note-editable').html());

		});

		

		

		

		

});



$(document).ready(function() { 

	 $('#uploadForm').submit(function(e) {	

		if($('#userImage').val()) {

			e.preventDefault();

			$('#loader-icon').show();

			$(this).ajaxSubmit({ 

				target:   '#targetLayer', 

				beforeSubmit: function() {

				  $("#progress-bar").width('0%');

				  $('#progress-div').css('display','block');

				},

				uploadProgress: function (event, position, total, percentComplete){	

					$("#progress-bar").width(percentComplete + '%');

					$("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')

					if(percentComplete == 100){

						  $('#progress-div').css('display','none');

					}

				},

				success:function (){

					$('#loader-icon').hide();

				},

				resetForm: true 

			}); 

			return false; 

		}

	});



	 $('#uploadForm').change(function(e) {	

			$('#uploadForm').submit();

  	 }); 



}); 





</script>



	<!-- BEGIN INITIALIZATION-->

	<script>

	$(document).ready(function () {

		Pleasure.init();

		Layout.init();

		FormsTools.init();

		FormsSelect.init();

		FormsMultipleUpload.init();

		TablesDataTables.init();
		
		<?php
			if(basename($_SERVER['PHP_SELF']) == 'edit-panchang.php' || basename($_SERVER['PHP_SELF']) == 'add-panchang.php' || basename($_SERVER['PHP_SELF']) == 'add-event.php' || basename($_SERVER['PHP_SELF']) == 'edit-event.php' || basename($_SERVER['PHP_SELF']) == 'add-user.php'  || basename($_SERVER['PHP_SELF']) == 'edit-user.php'){
		?>
			FormsPickers.init();

		<?php
			}
		?>
		
		FormsValidationsParsley.init();

		

	});
	

	</script>

	<!-- END INITIALIZATION-->



	<!-- BEGIN Google Analytics -->

	

	<!-- END Google Analytics -->



</body>



<!-- Mirrored from teamfox.co/themes/pleasure/app/admin1/forms-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Jul 2015 06:04:26 GMT -->

</html>
