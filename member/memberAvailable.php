<?php include '../member/memberHeader.php'; ?>

    <h1>
		Available Books	
		<form method="post" class="frmBooks">	
			<input type='text' id="bookSearch" name="bookSearch" class="bookSearch">
		</form>
	</h1>
    <form method='post'>
		<table class="bookTable">
			<thead class="bookTableHead">
				<th>Name</th>
				<th>Genre</th>
				<th>Author</th>
				<th>Published</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php			
					$sql = "SELECT * FROM books
							INNER JOIN genre ON books.genre_id = genre.genre_id
							INNER JOIN authors ON books.author_id = authors.author_id
							INNER JOIN books_status ON books.status_id = books_status.status_id";

					$result = $conn->query($sql);
					
					if ($result) {
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) { 
								if ($row['status_id'] == 1) { ?>
									<tr class="bookTableRow">
										<td><?= $row['book_name'] ?></td>
										<td><?= $row['genre_name'] ?></td>
										<td><?= $row['author_name'] . " " . $row['author_surname'] ?></td>
										<td><?= $row['book_published_date'] ?></td>
										<td>										
											<button id="btnMoreInfo" name="btnMoreInfo" value="<?= $row['book_id'] ?>" class="btn btn-warning">More Info</button>
										</td>
									</tr>					
					<?php		}							
								else {
									//These Books are Currently Being Rented
								}	
							}
					?>
			</tbody>
		</table>
		<?php					
					}
					else {
						echo "Error selecting table " . $conn->error;
					}
				}
		?>
	</form>

<?php include '../member/memberFooter.php'; ?>