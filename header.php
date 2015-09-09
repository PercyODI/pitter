<?php
	$SERVER = 'localhost';
	$USER = 'phutson';
	$PASS = 'nostuhP2';
	$DATABASE = 'phptesting';

	$mylink = mysqli_connect( $SERVER, $USER, $PASS, $DATABASE) or die("<h3>Sorry, could not connect to database.</h3><br/>
		Please contact your system's admin for more help\n");

	$_SESSION['link'] = $mylink;
?>