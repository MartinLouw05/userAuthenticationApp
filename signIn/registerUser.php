<?php require ('./php/funcRegister.php'); ?>

<section class="signInGrid">
	<div class="gridImage">
		<img src="https://cdn.shopify.com/s/files/1/2329/3055/articles/ReadingToUnderstandOurWorld_2048x.jpg?v=1521864290">
	</div>
	<div class="gridForm">
		<form method="post" class="frmRegister">
			<h3>Register</h3>
			<div>
				<label for="registerName">First Name</label><br>
					<input type="text" id="registerName" name="registerName" class="form-control">
			</div>
			<div>
			<label for="registerSurname">Last Name</label><br>
				<input type="text" id="registerSurname" name="registerSurname" class="form-control">
			</div>
			<div>
			<label for="registerEmail">Email</label><br>
				<input type="email" id="registerEmail" name="registerEmail" class="form-control">
			</div>
			<div>
			<label for="registerDoB">Date of Birth</label><br>
				<input type="date" id="registerDoB" name="registerDoB" class="form-control">
			</div>
			<div>
			<label for="registerNumber">Contact Number</label><br>
				<input type="number" id="registerNumber" name="registerNumber" class="form-control">
			</div>
			<div>
			<label for="registerPassword">Password</label><br>
				<input type="password" id="registerPassword" name="registerPassword" class="form-control">
			</div>
			<div>
			<label for="registerReEnterPassword">Re-Enter Password</label><br>
				<input type="password" id="registerReEnterPassword" name="registerReEnterPassword" class="form-control">
			</div>
			<input type="submit" id="btnRegisterSubmit" name="btnRegisterSubmit" class="btn btn-success btnRegisterSubmit">
			<button id="btnRegisterCancel" name="btnRegisterCancel" class="btn btn-warning btnRegisterCancel">Cancel</button><br>
		</form>
	</div>
</section>
