<?php require ('./php/funcSignIn.php'); ?>

<?php include 'header.php'; ?>



<section class="signInGrid">
	<div class="gridImage">
		<img src="https://cdn.shopify.com/s/files/1/2329/3055/articles/ReadingToUnderstandOurWorld_2048x.jpg?v=1521864290">
	</div>
	<div class="gridForm">
		<form method="post" class="frmSignIn">
			<h3>Sign In</h3>

			<label for="email">Email</label><br>
				<input type="email" id="email" name="email" class="form-control"><br>
			<label for="password">Password</label><br>
				<input type="password" id="password" name="password" class="form-control"><br>
			<input type="submit" id="btnLogIn" name="btnLogIn" class="btn btn-success btnLogIn">
			<button id="btnRegister" name="btnRegister" class="btn btn-warning btnRegister">Create New Account</button><br>
			<button id="btnForgotPassword" name="btnForgotPassword" class="btnForgotPassword">Forgot Password</button><br>

			<label onclick="window.location.href='./member/memberRented.php'">member view</label><br>
			<label onclick="window.location.href='./librarian/librarianRented.php'">librarian view</label>
		</form>
	</div>
</section>

<?php include 'footer.php'; ?>
