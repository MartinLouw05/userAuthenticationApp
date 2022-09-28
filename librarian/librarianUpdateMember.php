<?php include '../librarian/librarianHeader.php'; ?>

    <?php 
		$memberID = $_SESSION['memberID'];
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
	    <h1>Update Member's Information</h1>    
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
        <label for="memberRole">Role</label><br>
        <select id="memberRole" name="memberRole" class="form-control" disabled>
			<option value="<?= $row['role_id'] ?>" selected hidden><?= $row['role_name'] ?></option>
			<?php 
				$sql = "SELECT * FROM role";
				$result = $conn->query($sql);

				if ($result) {
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) { ?>								
							<option value="<?= $row['role_id'] ?>"><?= $row['role_name'] ?></option>	
			<?php   	}
					}
				}
				else {
					echo "Error selecting table " . $conn->error;
				} 
			?>
			</select><br>
		<input type="submit" id="btnSubmitUpdateMember" name="btnSubmitUpdateMember" value="Submit" class="btn btn-success btnSubmitBook">
		<button id="btnCancelUpdateMember" name="btnCancelUpdateMember" value="Cancel" class="btn btn-danger btnCancelBook">Cancel</button>
	</form>

    <?php
                        }    
                    }
                }
                else {
                    //No Data Found
                }            
    ?>

<?php include '../librarian/librarianFooter.php'; ?>
