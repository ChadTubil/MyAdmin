<?php
	include 'db-controller.php';
    session_start();

	$id = $_GET['id'];
    $userid = $_GET['userid'];
    

    $sqlSearchProd  = "SELECT * FROM products_tbl WHERE prod_id = '$id'";
    $querySearchProd = mysqli_query($dbConString, $sqlSearchProd);
    while ($rowProd = mysqli_fetch_array($querySearchProd)) {
        $prodid = $rowProd['prod_id'];
        $prodprice = $rowProd['prod_price'];
    }

    $date = date('Y-m-d');
    $sqlAddCart = "INSERT INTO cart_tbl() VALUES (NULL, '$userid', '$prodid', 1, '$prodprice', '$date', 'Pending', 0)";
    mysqli_query($dbConString, $sqlAddCart);
    header("location: sales.php");
	
?>