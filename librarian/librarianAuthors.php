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
									<td><?php
											$today = date('Y-m-d');
											$diff = date_diff(date_create($row['author_dob']), date_create($today));
											$authorAge = $diff->format('%y');
									 	?>	
										<?= $authorAge ?> y/o</td>
									<td>
										<?php 
											$authorID = $row['author_id'];

											$sql = "SELECT * FROM authors_genre 
													INNER JOIN genre ON authors_genre.genre_id = genre.genre_id
													WHERE author_id = $authorID";
											$genreResult = $conn->query($sql);

											if ($genreResult) {
												if ($genreResult->num_rows > 0) {
													while ($genreRow = $genreResult->fetch_assoc()) { ?>
														<?= $genreRow['genre_name'] ?><br>
										<?php
													}
												}
												else {
													echo "Error selecting table " . $conn->error;
												}
											}
										?>
									</td>
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