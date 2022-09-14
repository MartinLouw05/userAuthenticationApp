<?php require ('./php/funcSignIn.php'); ?>

<section class="signInGrid">
	<div class="gridImage">
		<img src="https://cdn.shopify.com/s/files/1/2329/3055/articles/ReadingToUnderstandOurWorld_2048x.jpg?v=1521864290">
	</div>
	<div class="gridForm">
		<form method="post" class="frmSignIn">
			<h3>Sign In</h3>

			<label for="email">Email</label><br>
				<input type="email" id="email" name="email" class="form-control" required><br>
			<label for="password">Password</label><br>
				<input type="password" id="password" name="password" class="form-control" required><br>
			<input type="submit" id="submit" name="submit" class="btn btn-success btnSubmit">
			<button id="register" class="btn btn-warning btnRegister">Create New Account</button><br>
			<label id="forgotPassword" class="lblForgotPassword">Forgot Password</label><br>
		</form>
	</div>
</section>
