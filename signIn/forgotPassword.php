<?php require ('./php/funcForgotPassword.php'); ?>

<section class="signInGrid">
	<div class="gridImage">
		<img src="https://cdn.shopify.com/s/files/1/2329/3055/articles/ReadingToUnderstandOurWorld_2048x.jpg?v=1521864290">
	</div>
	<div class="gridForm">
		<form method="post" class="frmSignIn">
			<h3>Forgot Password</h3>

			<label for="forgotEmail">Email</label><br>
				<input type="email" id="forgotEmail" name="forgotEmail" class="form-control"><br>
			<label for="forgotDoB">Date of Birth</label><br>
				<input type="date" id="forgotDoB" name="forgotDoB" class="form-control"><br>
			<input type="submit" id="btnForgotSubmit" name="btnForgotSubmit" class="btn btn-success btnForgotSubmit">
			<button id="btnForgotCancel" name="btnForgotCancel" class="btn btn-warning btnForgotCancel">Cancel</button><br>
		</form>
	</div>
</section>
