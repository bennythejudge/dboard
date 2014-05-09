<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Train Predictor</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="css/navbar-fixed-top.css" >

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!-- to refresh the page as a workaround to refreshing the trains -->
<!-- 	<meta http-equiv="refresh" content="30">   -->

    <script src="http://code.jquery.com/jquery-latest.js"></script>
	<script>
	    $(document).ready(function(){
	        setInterval(function() {
	            $("#section01").load("html/update_trains.php");
	        }, 35000);
	    });
	</script>
  </head>

  <body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand">Train Predictor (beta)</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact me</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

