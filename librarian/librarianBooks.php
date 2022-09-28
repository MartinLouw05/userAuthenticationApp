<?php include '../librarian/librarianHeader.php'; ?>

	<h1>
		Books	
		<form method="post" class="frmBooks">	
			<button id="btnAddBook" name="btnAddBook" class="btnAddBook">Add New Book</button>
			<select id="searchSelect" name="searchSelect" class="searchSelect">
				<option value="book">Book</option>
				<option value="author">Author</option>
			</select>
			<input type='text' id="searchInput" name="searchInput" placeholder="Search by Book or Author" class="searchInput">
			<button id="btnBookSearch" name="btnBookSearch" class="btn btn-secondary btnBookSearch">&#128269</button>
		</form>
	</h1>
	<form method='post'>
		<table class="bookTable">
			<thead class="bookTableHead">
				<th>Name</th>
				<th>Genre</th>
				<th>Author</th>
				<th>Published</th>
				<th>Status</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php			
					$sql = "SELECT * FROM books
							INNER JOIN genre ON books.genre_id = genre.genre_id
							INNER JOIN authors ON books.author_id = authors.author_id
							INNER JOIN books_status ON books.status_id = books_status.status_id 
							ORDER BY book_name ASC";
							
					$result = $conn->query($sql);
					
					if ($result) {
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) { 
								if ($row['status_id'] == 1 || $row['status_id'] == 2) { ?>
								<tr class="bookTableRow">
									<td><?= $row['book_name'] ?></td>
									<td><?= $row['genre_name'] ?> </td>
									<td><?= $row['author_name'] . " " . $row['author_surname'] ?> </td>
									<td><?= $row['book_published_date'] ?> </td>
									<td><?= $row['status_name'] ?> </td>
									<td>										
										<button id="btnUpdateBook" name="btnUpdateBook" value="<?= $row['book_id'] ?>" class="btn btn-warning">Update</button>
										<button id="btnDeleteBook" name="btnDeleteBook" value="<?= $row['book_id'] ?>" class="btn btn-danger">Remove</button>
										<button id="btnBookHistory" name="btnBookHistory" value="<?= $row['book_id'] ?>" class="btn btn-info">History</button>
									</td>
								</tr>					
					<?php		
								}
								else {
									//These Books Are No Longer Active
								}
							}	
					?>
			</tbody>
		</table>
		<?php
						}
					}
					else {
						echo "Error selecting table " . $conn->error;
					}
		?>
	</form>

<?php include '../librarian/librarianFooter.php'; ?>
