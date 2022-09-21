<?php include '../librarian/librarianHeader.php'; ?>

	<h1>Authors
		<form method="post" class="frmAuthors">
			<button id="btnAddAuthor" name="btnAddAuthor" class="btnAddAuthor">Add New Author</button>
			<input type='text' id="authorSearch" name="authorSearch" class="authorSearch">
		</form>
	</h1>
	<form method="post">
		<table class="authorTable">
			<thead class="authorTableHead">
				<th>Name</th>
				<th>Age</th>
				<th>Genre</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php			
					$sql = "SELECT * FROM authors";
					$result = $conn->query($sql);
					
					if ($result) {
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) { ?>
								<tr class="authorTableRow">
									<td><?= $row['author_name'] . " " . $row['author_surname'] ?></td>
									<td><?= $row['author_age'] ?> y/o</td>
									<td><?= $row['genre_name'] ?> FIX ME</td>
									<td>
										<button id="btnUpdateAuthor" name="btnUpdateAuthor" value="<?= $row['author_id'] ?>" class="btn btn-warning">Update</button>
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