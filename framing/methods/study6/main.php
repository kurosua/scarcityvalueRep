<?php

session_start();

	include 'funcs/init.php';		// includes session_start
	ipCheck();				// checks ip for duplicates
	init(4);				// initialize session variables, passing number of conditions
										// returns $cond (starts as 0) and $subj in the session
										
$_SESSION['pause']=true;
$_SESSION['practice']=1;

?>

<html>
<head>
	<title>Game Shell</title>
	<link rel="stylesheet" type="text/css" href="gscss.css" />
	<script type="text/javascript" src="gsconfig.js"></script>
	<script type="text/javascript" src="gameshell.js"></script>
</head>

<body>
	<div id="wrapper">
		<div id="main">

		</div>
		<div id="sidebar">
			Round:
			<div id="trialnumdiv"></div>
		</div>
	</div>
</body>
</html>