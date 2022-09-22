<?php include '../member/memberHeader.php'; ?>

	<?php 
		$memberID = $_SESSION['loggedInMemberID'];
		$sql = "SELECT * FROM members 
				INNER JOIN role ON members.role_id = role.role_id 
				WHERE member_id = $memberID";
		$result = $conn->query($sql);

		if ($result) { 
			//Data Found
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) { 
    ?>

    <form method="post" class="frmUpdateMember">
	    <h1>Account Information</h1>    
		<label for="memberName">Name</label><br>
			<input type="text" id="memberName" name="memberName" value="<?= $row['member_name'] ?>" class="form-control"><br>
        <label for="memberSurname">Surname</label><br>
			<input type="text" id="memberSurname" name="memberSurname" value="<?= $row['member_surname'] ?>" class="form-control"><br>
        <label for="memberEmail">Email</label><br>
			<input type="email" id="memberEmail" name="memberEmail" value="<?= $row['member_email'] ?>" class="form-control"><br>
		<label for="memberDob">Date of Birth</label><br>
			<input type="date" id="memberDob" name="memberDob" value="<?= $row['member_date_of_birth'] ?>" class="form-control"><br>
        <label for="memberContact">Contact Number</label><br>
			<input type="number" id="memberContact" name="memberContact" class="form-control" value="<?= $row['member_contact_number'] ?>" max="9999999999"><br>
		<label for="memberPassword">Password</label><br>
			<input type="password" id="memberPassword" name="memberPassword" value="<?= $row['member_password'] ?>" class="form-control"><br>
		<label for="memberReEnterPassword">Re-Enter Password</label><br>
			<input type="password" id="memberReEnterPassword" name="memberReEnterPassword" value="<?= $row['member_password'] ?>" class="form-control"><br>
		<input type="submit" id="btnSubmitUpdate" name="btnSubmitUpdate" value="Update" class="btn btn-success btnSubmitBook">
		<button id="btnCancelUpdate" name="btnCancelUpdate" value="Cancel" class="btn btn-danger btnCancelBook">Cancel</button>
	</form>

    <?php
                        }    
                    }
                }
                else {
                    //No Data Found
                }            
    ?>

<?php include '../member/memberFooter.php'; ?>