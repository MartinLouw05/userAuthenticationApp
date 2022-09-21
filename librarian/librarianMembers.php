<?php include '../librarian/librarianHeader.php'; ?>

	<h1>Members
		<form method="post" class="frmMembers">			
			<input type='text' id="memberSearch" name="memberSearch" class="memberSearch">
		</form>
	</h1>

	<form method="post">
		<table class="memberTable">
			<thead class="memberTableHead">
				<th>Name</th>
				<th>Date of Birth</th>
				<th>Contact Number</th>
				<th>Email</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php			
					$sql = "SELECT * FROM members";
					$result = $conn->query($sql);
					
					if ($result) {
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) { ?>
								<tr class="memberTableRow">
									<td><?= $row['member_name'] . " " . $row['member_surname'] ?></td>
									<td><?= $row['member_date_of_birth'] ?> </td>
									<td><?= $row['member_contact_number'] ?> </td>
									<td><?= $row['member_email'] ?> </td>
									<td>
										<button id="btnUpdateMember" name="btnUpdateMember" value="<?= $row['member_id'] ?>" class="btn btn-warning">Update</button>										
									</td>
								</tr>					
					<?php	}	?>
			</tbody>
		</table>
	</form>
	<?php
				}
			}
			else {
				echo "Error selecting table " . $conn->error;
			}
	?>

<?php include '../librarian/librarianFooter.php'; ?>