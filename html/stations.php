<?php include_once('header.php'); ?>

<div class="container" style = "background: none repeat scroll 0% 0% white; width: 100%;">
	<p><b>Line selected: <?php  echo $_SESSION['selected_line'] . " " . $lines[$_SESSION['selected_line']];?></b></p>
	<!-- :VARIABLE WAS SET IN index.php 'line' : WILL USE IN included file  -->
	<div  class = "col-xs-4">
		<form class="form-horizontal" role="form">
			<div class="form-group" >
				<input type = "hidden" name = "action" value = "trains">
				<select class="form-control" name="station">
					<?php					 
					foreach ( $stations as $station ) {
						print '<option value="' . $station[0] . '">' . $station[1] . '</option>';
						$_SESSION[$station[0]]=$station[1];
					}					
					?>
				</select>
			</div>
			<button type="submit" class="btn btn-primary btn-lg">Next >></button>
		</form>
	</div>
</div><!-- containter -->

<?php include_once('footer.php'); ?>
