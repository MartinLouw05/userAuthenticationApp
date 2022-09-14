<!DOCTYPE html>
<html>
	<head>
		<title>Global Books</title>

		<?php session_start(); ?>
		<script src='./js/funcIndex.js' defer></script>
		<link rel='stylesheet' type='text/css' href='./css/index.css'>	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">	
	</head>
	<body>
		<header>
		</header>
		<main>
			<div id="signInDisplay" class="signInDisplay">
				<?php include './signIn/signIn.php'; ?>
			</div>
			<div id="forgotPasswordDisplay" class="forgotPasswordDisplay">
				<?php include './signIn/forgotPassword.php'; ?>
			</div>
			<div id="registerDisplay" class="registerDisplay">
				<?php include './signIn/registerUser.php'; ?>
			</div>			
		</main>
		<footer>

		</footer>
	</body>
</html>