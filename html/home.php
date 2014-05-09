<?php include_once('header.php'); ?>
<div class="container" style = "background: none repeat scroll 0% 0% white; width: 100%;">
	<div  class = "col-xs-4">
		<p><b>Select Line</label></b></p>
		<form class="form-horizontal" role="form" name = "line_frm">
			<div class="form-group" >
				<input type = "hidden" name = "action" value = "stations">
				<select class="form-control" name="line" onchange = "document.line_frm.submit();">
				  <option value="">Select Line</option>
					<?php
					foreach ( $lines as $key => $value) {
						echo '<option value="' . $key . '">' . $value . '</option>';
					}
					?>
				</select>
			</div>
		</form>
		  <!-- <button type="button" class="btn btn-primary btn-lg">Next >></button> -->
	</div>
</div><!-- containter -->

<?php include_once('footer.php'); ?>
<?php include_once('disclaimer.php'); ?>
<!-- first time send a disclaimer -->
<script type = "text/javascript">
var first_time_visit = $.cookie("first_time_visit");
if(first_time_visit != 1){//first time visit
	$('#disclaimerModal').modal()
//	$.cookie("first_time_visit", 1, { expires : 3 });
	$.cookie("first_time_visit", 1);
}
</script>