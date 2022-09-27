<?php include '../librarian/librarianHeader.php'; ?>

    <?php 
        $bookID = $_SESSION['bookHistoryID'];

        $sql = "SELECT * FROM books 
                WHERE book_id = '$bookID'";

        $result = $conn->query($sql);
                            
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <h1><?= $row['book_name'] ?>'s History</h1>
    <?php
                }
            }
        }
        else {
            echo "Error selecting table " . $conn->error;
        }
    ?>

	<form method='post'>
		<table class="bookTable">
			<thead class="bookTableHead">
				<th>Member</th>
				<th>Date Rented</th>
				<th>Return Date</th>
				<th>Date Returned</th>
			</thead>
			<tbody>
				<?php			
					$sql = "SELECT * FROM books_rented
                            INNER JOIN members ON books_rented.member_id = members.member_id 
                            WHERE book_id = '$bookID'";

					$result = $conn->query($sql);
					
					if ($result) {
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) { ?>
								<tr class="bookTableRow">
									<td><?= $row['member_name'] . " " . $row['member_surname'] ?></td>
									<td><?= $row['rented_date'] ?> </td>
									<td><?= $row['rented_return_date'] ?> </td>
                                <?php
                                    if ($row['rented_date_returned'] == NULL) { ?>
                                        <td>Ongoing</td>
                                <?php
                                    }
                                    else { ?>
                                        <td><?= $row['rented_date_returned'] ?> </td>
                            <?php   } ?>									
								</tr>					
					<?php	} ?>
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
