	<!-- BEGIN GLOBAL AND THEME VENDORS -->
	<script src="assets/globals/js/global-vendors.js"></script>
	<!-- END GLOBAL AND THEME VENDORS -->

	<!-- BEGIN PLUGINS AREA -->
	<script src="assets/globals/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="assets/globals/plugins/datatables/themes/bootstrap/dataTables.bootstrap.js"></script>
	<!-- END PLUGINS AREA -->

	<!-- PLUGINS INITIALIZATION AND SETTINGS -->
	<script src="assets/globals/scripts/tables-datatables.js"></script>
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
				  }
				});     
				
			}else{
				return false;
			}

		}
	</script>
	<!-- BEGIN INITIALIZATION-->
	<script>
	$(document).ready(function () {
		Pleasure.init();
		Layout.init();
		TablesDataTables.init();
	});
	</script>
	<!-- END INITIALIZATION-->


</body>
<!-- Mirrored from teamfox.co/themes/pleasure/app/admin1/table-datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Jul 2015 06:04:59 GMT -->
</html>
