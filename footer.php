<!-- BEGIN GLOBAL AND THEME VENDORS -->
<script src="assets/globals/js/global-vendors.js"></script>
<!-- END GLOBAL AND THEME VENDORS -->
<!-- BEGIN PLUGINS AREA -->
<script src="assets/globals/plugins/d3/d3.min.js"></script>
<script src="assets/globals/plugins/c3js-chart/c3.min.js"></script>
<!-- END PLUGINS AREA -->
<!-- PLUGINS INITIALIZATION AND SETTINGS -->
<!--	<script src="assets/globals/scripts/charts-c3.js"></script>
-->
<script>
	var ChartsC3 = {
	
	
		barChart: function () {
			var chart = c3.generate({
				bindto: '.c3-bar',
				data: {
					 x : 'x',
					columns: [
						['x', 'This Week','This Month','This Year'],
						['Free Member', <?php echo $user_result->week_array[0]->free_user; ?>, <?php echo $user_result->month_array[0]->free_user; ?>, <?php echo $user_result->year_array[0]->free_user; ?>],
						['Paid Member', <?php echo $user_result->week_array[0]->paid_user; ?>, <?php echo $user_result->month_array[0]->paid_user; ?>, <?php echo $user_result->year_array[0]->paid_user; ?>],
						['Freeze Member', <?php echo $user_result->week_array[0]->freeze_user; ?>, <?php echo $user_result->month_array[0]->freeze_user; ?>, <?php echo $user_result->year_array[0]->freeze_user; ?>]
						['Expired Member', <?php echo $user_result->week_array[0]->freeze_user; ?>, <?php echo $user_result->month_array[0]->freeze_user; ?>, <?php echo $user_result->year_array[0]->freeze_user; ?>]
					],
					type: 'bar'
				},
				 axis: {
					x: {
						type: 'category' // this needed to load string x value
					}
				},
				bar: {
					width: {
						ratio: 0.5 // this makes bar width 50% of length between ticks
					}
					// or
					//width: 100 // this makes bar width 100px
				}
			});
		},
		init: function () {
			this.barChart();
		}
	}
	
	
	
	

	</script>
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
		ChartsC3.init();
	});
	</script>
<!-- END INITIALIZATION-->
<!-- BEGIN Google Analytics -->
<!-- END Google Analytics -->
</body>
<!-- Mirrored from teamfox.co/themes/pleasure/app/admin1/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Jul 2015 06:01:06 GMT -->
</html>
