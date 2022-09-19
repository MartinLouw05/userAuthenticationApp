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
			<h1>Librarian Home
				<button class="btn btn-danger btnLogOut">Log Out</button>
			</h1>
			<section class="buttonGrid">
				<div class="gridButton"><button id="btnDisplayBooks" class="btnNavigate">Books</button></div>
				<div class="gridButton"><button id="btnDisplayRented" class="btnNavigate">Rented</button></div>
				<div class="gridButton"><button id="btnDisplayMembers" class="btnNavigate">Members</button></div>
				<div class="gridButton"><button id="btnDisplayAuthors" class="btnNavigate">Authors</button></div>
			</section>			
		</header>
		<main>
			<div id="viewBooks" class="viewBooks">
				<?php include '../librarian/librarianBooks.php'; ?>
			</div>
			<div id="viewRentedBooks" class="viewRentedBooks">
				<?php include '../librarian/librarianRented.php'; ?>
			</div>
			<div id="viewMembers" class="viewMembers">
				<?php include '../librarian/librarianMembers.php'; ?>
			</div>
			<div id="viewAuthors" class="viewAuthors">
				<?php include '../librarian/librarianAuthor.php'; ?>
			</div>
		</main>
		<footer class="container-fluid">
			<label>&copy; Created by Martin Louw</label>
		</footer>
	</body>
</html>