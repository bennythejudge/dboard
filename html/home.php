<?php include_once('header.php'); ?>
<div class="container">
	<p/><p/>
		<form role="form" name = "line_frm">
		  <div class="form-group">
		  </div>
		  <div class="form-group">
			<input type = "hidden" name = "action" value = "stations">
			<select class="form-control" name="line" onchange = "document.line_frm.submit();">
			  <option value="">Select Line</option>
				<?php
				foreach ( $lines as $key => $value) {
					echo '<option value="' . $key . '">' . $value . '</option>';
				}
				?>
			</select>
		</form>
</div>
<!-- containter -->
<?php include_once('footer.php'); ?>
<?php include_once('disclaimer.php'); ?>
<!-- first time send a disclaimer -->
<script type = "text/javascript">
var first_time_visit = $.cookie("first_time_visit");
if(first_time_visit != 1){//first time visit
	$('#disclaimerModal').modal()
	$.cookie("first_time_visit", 1, { expires : 3 });
//	$.cookie("first_time_visit", 1);
}
</script>

