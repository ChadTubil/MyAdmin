<?php
	include '../db-controller.php';

	$id = $_GET['id'];

	$sqlDelete = "UPDATE suppliers_tbl SET supp_isdel=1 WHERE supp_id=$id";
	mysqli_query($dbConString, $sqlDelete);

	header("location: suppliers.php");
?>