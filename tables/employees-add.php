<?php
	include '../db-controller.php';

    $id = $_GET['id'];
    $lname = $_GET['lastname'];
    $fname = $_GET['firstname'];
    $mname = $_GET['middlename'];
    $email = $_GET['email'];
    $address = $_GET['address'];
    $contact = $_GET['contact'];
    $date = date('Y-m-d');
    $image = $_GET['image'];

	$sqlAddEmp = "INSERT INTO employees_tbl(emp_users_id, emp_users_lastname, emp_users_firstname, emp_users_middlename, 
    emp_users_email, emp_users_address, emp_users_contact, emp_datecreated, emp_image) VALUES ('$id', '$lname', '$fname', '$mname', '$email',
    '$address', '$contact', '$date', '$image')";
	mysqli_query($dbConString, $sqlAddEmp);

	header("location: employees.php");
?>