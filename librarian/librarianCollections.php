<?php include '../librarian/librarianHeader.php'; ?>

	<h1>Collections
		<form method="post" class="frmRented">
            <button id="btnRented" name="btnRented" class="btnRented">Outstanding Books</button>
			<button id="btnRentedHistory" name="btnRentedHistory" class="btnRentedHistory">Rented History</button>
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
                    $rentalStatus = 3; //Set Status as Reserved

					$sql = "SELECT * FROM books_rented 
							INNER JOIN books ON books_rented.book_id = books.book_id 
							INNER JOIN members ON books_rented.member_id = members.member_id
                            WHERE books_rented_status_id = '$rentalStatus'";

					$result = $conn->query($sql);
					
					if ($result) {
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) { ?>
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
                    <?php	} ?>
			</tbody>
		</table>
		<?php
					}
                    else { ?>
                        <tr class="rentedTableRow">
                            <td>No Collections Found</td>
                        </tr>
        <?php
                    }
				}
				else {
					echo "Error selecting table " . $conn->error;
				}
		?>
	</form>

<?php include '../librarian/librarianFooter.php'; ?>
