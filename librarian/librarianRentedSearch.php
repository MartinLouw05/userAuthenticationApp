<?php include '../librarian/librarianHeader.php'; ?>

	<h1>Rented Books
		<form method="post" class="frmRented">
			<button id="btnCollections" name="btnCollections" class="btnRentedHistory">Collections</button>
			<button id="btnRentedHistory" name="btnRentedHistory" class="btnRentedHistory">Rented History</button>
			<input type='text' id="rentedSearch" name="rentedSearch" placeholder="Search Books" class="rentedSearch">
			<button id="btnRentedSearch" name="btnRentedSearch" class="btn btn-secondary btnRentedSearch">&#128269</button>
		</form>
	</h1>

	<form method="post">
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
                    $librarianSearch = $_SESSION['librarianSearch'];

					$sql = "SELECT * FROM books_rented 
							INNER JOIN books ON books_rented.book_id = books.book_id 
							INNER JOIN members ON books_rented.member_id = members.member_id
                            WHERE book_name LIKE '%$librarianSearch%'";

					$result = $conn->query($sql);
					
					if ($result) {
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) { 
								if ($row['books_rented_status_id'] == 2 || $row['books_rented_status_id'] == 3) {
									//Do Not Include These Entries
								}
								else { ?>									
									<tr class="rentedTableRow">
										<td><?= $row['book_name'] ?></td>
										<td><?= $row['member_name'] . " " . $row['member_surname'] ?></td>
										<td><?= $row['rented_date'] ?></td>
										<td><?= $row['rented_return_date'] ?></td>
										<td>
											<?php 
												if ($row['books_rented_status_id'] == 1 || $row['books_rented_status_id'] == 4) { ?>
													<button id="btnReturnBook" name="btnReturnBook" value="<?= $row['rented_id'] ?>" class="btn btn-warning">Returned</button>
										<?php	}
												elseif ($row['books_rented_status_id'] == 3) { ?>
													<button id="btnCollectBook" name="btnCollectBook" value="<?= $row['rented_id'] ?>" class="btn btn-warning">Collected</button>
										<?php	}	?>											
										</td>
									</tr>					
				<?php	
								}
							}	
				?>
			</tbody>
		</table>
		<?php
					}
                    else {
                        echo "  <script>  
                                    alert('No Books Found.  Please Try Again.'); 
                                    window.location.href = './librarianRented.php';
                                </script>";                            
                    }
				}
				else {
					echo "Error selecting table " . $conn->error;
				}
		?>
	</form>

<?php include '../librarian/librarianFooter.php'; ?>
