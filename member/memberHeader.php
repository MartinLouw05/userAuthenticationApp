<!DOCTYPE html>
<html>
	<head>
		<title>Member Home</title>

		<?php session_start(); ?>
		<?php require('../php/funcMember.php'); ?>
		<script src='../js/funcMember.js' defer></script>
		<link rel='stylesheet' type='text/css' href='../css/member.css'>	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">	
	</head>
	<body>
		<header class="container-fluid">
			<form method="post">
				<h1>Member Home					
					<button id="btnLogOut" name="btnLogOut" class="btn btn-danger btnLogOut">Log Out</button>
					<button id="btnAccInfo" name="btnAccInfo" class="btn btn-success btnAccInfo">Account Information</button>
				</h1>
			
				<section class="buttonGrid">
					<div class="gridButton"><button id="btnRentedBooks" name="btnRentedBooks" class="btnNavigate">Rented Books</button></div>
					<div class="gridButton"><button id="btnAvailableBooks" name="btnAvailableBooks" class="btnNavigate">Available Books</button></div>
				</section>		
			</form>	
		</header>
		<main>