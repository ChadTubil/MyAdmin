<?php
	include 'db-controller.php';

	$sqlDelete = "UPDATE cart_tbl SET cart_isdel=1, cart_status='Canceled' WHERE cart_isdel=0";
	mysqli_query($dbConString, $sqlDelete);

	header("location: sales.php");
?>