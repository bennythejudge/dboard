<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TFL Trains Departure Board (beta)</title>

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
 	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">TFL Departures</a>
		</div>
		<div class="collapse navbar-collapse">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="index.php">Home</a></li>
			<li><a href="#about">About</a></li>
			<li><a href="#contact">Contact</a></li>
		  </ul>
		</div><!--/.nav-collapse -->
	  </div>
	</div>

