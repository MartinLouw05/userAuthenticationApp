<?php include '../librarian/librarianHeader.php'; ?>

	<h1>Members
		<form method="post" class="frmMembers">			
			<input type='text' id="memberSearch" name="memberSearch" placeholder="Search Members" class="memberSearch">
			<button id="btnMemberSearch" name="btnMemberSearch" class="btn btn-secondary btnMemberSearch">&#128269</button>
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
                    $librarianSearch = $_SESSION['librarianSearch'];

					$sql = "SELECT * FROM members 
                            WHERE member_name LIKE '%$librarianSearch%' OR member_surname LIKE '%$librarianSearch%' AND NOT role_id = 2 
							ORDER BY member_name ASC";
                            
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
										<button id="btnMemberHistory" name="btnMemberHistory" value="<?= $row['member_id'] ?>" class="btn btn-danger">History</button>
									</td>
								</tr>					
					<?php	}	?>
			</tbody>
		</table>
	</form>
	<?php
				}
                else {
                    echo "  <script>  
                                alert('No Members Found.  Please Try Again.'); 
                                window.location.href = './librarianMembers.php';
                            </script>";                            
                }
			}
			else {
				echo "Error selecting table " . $conn->error;
			}
	?>

<?php include '../librarian/librarianFooter.php'; ?>