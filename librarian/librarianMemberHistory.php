<?php include '../librarian/librarianHeader.php'; ?>

    <?php
        $memberID = $_SESSION['memberHistoryID'];
        
        $sql = "SELECT * FROM members 
                WHERE member_id = '$memberID'";

        $result = $conn->query($sql);
        
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <h1><?= $row['member_name'] . " " . $row['member_surname'] ?>'s History</h1>
                        
    <?php       }
            }
        }
        else {
            echo "Error selecting table " . $conn->error;
        }
    ?>

	<table class="rentedTable">
		<thead class="rentedTableHead">
			<th>Book</th>
			<th>Author</th>
			<th>Date Rented</th>
			<th>Return Date</th>
			<th>Date Returned</th>			
		</thead>
		<tbody>
        <tr class="rentedTableRow">
			<?php			
				$sql = "SELECT * FROM books_rented 
						INNER JOIN books ON books_rented.book_id = books.book_id 
                        INNER JOIN authors ON books.author_id = authors.author_id 
                        WHERE member_id = '$memberID' AND books_rented_status_id = '2'";

				$result = $conn->query($sql);
				
				if ($result) {
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {  ?>							
                            <td><?= $row['book_name'] ?></td>
                            <td><?= $row['author_name'] . " " . $row['author_surname'] ?></td>
                            <td><?= $row['rented_date'] ?></td>
                            <td><?= $row['rented_return_date'] ?></td>								
                            <td><?= $row['rented_date_returned'] ?></td>							
                <?php	}
                    }
                    else { ?>                        
                        <td>No Books Found</td>                        
    <?php
                    }
                }
                else {
                    echo "Error selecting table " . $conn->error;
                }
	?>
            </tr>
        </tbody>
	</table>

<?php include '../librarian/librarianFooter.php'; ?>
