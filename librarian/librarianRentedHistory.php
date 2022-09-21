<?php include '../librarian/librarianHeader.php'; ?>

	<h1>Rented Books History
		<form method="post" class="frmRented">
			<button id="btnRented" name="btnRented" class="btnRented">Outstanding Books</button>
			<select id="rentedSelect" name="rentedSelect" class="rentedSelect">
				<option value="books">Books</option>
				<option value="members">Members</option>
			</select>
			<input type='text' id="rentedSearch" name="rentedSearch" class="rentedSearch">
		</form>
	</h1>

	<table class="rentedTable">
		<thead class="rentedTableHead">
			<th>Book</th>
			<th>Member</th>
			<th>Date Rented</th>
			<th>Return Date</th>
			<th>Actions</th>
		</thead>
		<tbody>
			<?php			
				$sql = "SELECT * FROM books_rented INNER JOIN books ON books_rented.book_id = books.book_id INNER JOIN members ON books_rented.member_id = members.member_id";
				$result = $conn->query($sql);
				
				if ($result) {
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) { ?>
							<tr class="rentedTableRow">
								<td><?= $row['book_name'] ?></td>
								<td><?= $row['member_name'] . " " . $row['member_surname'] ?></td>
								<td><?= $row['rented_date'] ?></td>
								<td><?= $row['rented_return_date'] ?></td>
								<td><button></button></td>
							</tr>					
				<?php	}	?>
		</tbody>
	</table>
	<?php
				}
			}
			else {
				echo "Error selecting table " . $conn->error;
			}
	?>

<?php include '../librarian/librarianFooter.php'; ?>
