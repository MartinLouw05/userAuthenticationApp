<?php include '../librarian/librarianHeader.php'; ?>

	<h1>Rented Books History
		<form method="post" class="frmRented">
			<button id="btnRented" name="btnRented" class="btnRented">Outstanding Books</button>
			<input type='text' id="rentedHistorySearch" name="rentedHistorySearch" placeholder="Search Books" class="rentedSearch">
			<button id="btnRentedHistorySearch" name="btnRentedHistorySearch" class="btn btn-secondary btnRentedSearch">&#128269</button>
		</form>
	</h1>

	<table class="rentedTable">
		<thead class="rentedTableHead">
			<th>Book</th>
			<th>Member</th>
			<th>Date Rented</th>
			<th>Return Date</th>			
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
                            if ($row['status_id'] == ) { ?>
							<tr class="rentedTableRow">
								<td><?= $row['book_name'] ?></td>
								<td><?= $row['member_name'] . " " . $row['member_surname'] ?></td>
								<td><?= $row['rented_date'] ?></td>
								<td><?= $row['rented_return_date'] ?></td>								
							</tr>					
				<?php	}
                }	?>
		</tbody>
	</table>
	<?php
				}
                else {
                    echo "  <script>  
                                alert('No Books Found.  Please Try Again.'); 
                                window.location.href = './librarianRentedHistory.php';
                            </script>";                            
                }
			}
			else {
				echo "Error selecting table " . $conn->error;
			}
	?>

<?php include '../librarian/librarianFooter.php'; ?>
