<!DOCTYPE html>
<html>
	<head>
		<title>Librarian Home</title>

		<?php session_start(); ?>
		<?php require('../php/funcLibrarian.php'); ?>
		<script src='../js/funcLibrarian.js' defer></script>
		<link rel='stylesheet' type='text/css' href='../css/librarian.css'>	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">	
	</head>
	<body>
		<header class="container-fluid">
			<form method="post">
				<?php 
					$memberID = $_SESSION['loggedInMemberID'];
					$sql = "SELECT * FROM members 
							WHERE member_id = $memberID";
					
					$result = $conn->query($sql);

					if ($result) {
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) { ?>
								<h1>Welcome <?= $row['member_name'] . " " . $row['member_surname'] ?>
				<?php
							}
						}
					}
					else {
						echo "Error selecting table " . $conn->error;
					}
				?>				
					<button id="btnLogOut" name="btnLogOut" class="btn btn-danger btnLogOut">Log Out</button>
					<button id="btnHome" name="btnHome" class="btn btn-success btnHome">&#127968;</button>
				</h1>
			
				<section class="buttonGrid">
					<div class="gridButton"><button id="btnDisplayRented" name="btnDisplayRented" class="btnNavigate">Rented</button></div>
					<div class="gridButton"><button id="btnDisplayBooks" name="btnDisplayBooks" class="btnNavigate">Books</button></div>
					<div class="gridButton"><button id="btnDisplayMembers" name="btnDisplayMembers" class="btnNavigate">Members</button></div>
					<div class="gridButton"><button id="btnDisplayAuthors" name="btnDisplayAuthors" class="btnNavigate">Authors</button></div>
				</section>		
			</form>	
		</header>
		<main>