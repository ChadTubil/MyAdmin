<?php
	include 'db-controller.php';

	$id = $_GET['id'];
    
    $sqlCart = "SELECT * FROM cart_tbl WHERE cart_id = $id";
    $queryCart = mysqli_query($dbConString, $sqlCart);
    $fetchCart = mysqli_fetch_assoc($queryCart);
    echo $prodqty = $fetchCart['cart_prod_qty'];

    echo $plus = 1;
    echo $sum = $prodqty + $plus;

	echo $sqlAddQty = "UPDATE cart_tbl SET cart_prod_qty='$sum' WHERE cart_id=$id";
	mysqli_query($dbConString, $sqlAddQty);

	header("location: sales.php");
?>