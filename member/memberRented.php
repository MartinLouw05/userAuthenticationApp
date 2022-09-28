<?php include '../member/memberHeader.php'; ?>

    <h1>Active Rentals
        <form method="post" class="frmRented">
            <button id="btnRentedHistory" name="btnRentedHistory" class="btnRentedHistory">Rented History</button>            
            <input type='text' id="rentedSearch" name="rentedSearch" placeholder="Search Books" class="rentedSearch">
            <button id="btnRentedSearch" name="btnRentedSearch" class="btn btn-secondary btnRentedSearch">&#128269</button>            
        </form>
    </h1>

	<form method="post">
        <table class="rentedTable">
            <thead class="rentedTableHead">
                <th>Book</th>
                <th>Author</th>
                <th>Date Rented</th>
                <th>Return Date</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php			
                    $memberID = $_SESSION['loggedInMemberID'];

                    $sql = "SELECT * FROM books_rented 
                            INNER JOIN books ON books_rented.book_id = books.book_id  
                            INNER JOIN authors ON books.author_id = authors.author_id 
                            WHERE NOT books_rented_status_id = '2' AND member_id = '$memberID' 
                            ORDER BY rented_return_date ASC";

                    $result = $conn->query($sql);
                    
                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr class="rentedTableRow">
                                    <td><?= $row['book_name'] ?></td>
                                    <td><?= $row['author_name'] . " " . $row['author_surname'] ?></td>
                                    <td><?= $row['rented_date'] ?></td>
                                    <td><?= $row['rented_return_date'] ?></td>
                                    <td>
                                        <?php
                                            $statusID = $row['books_rented_status_id']; 

                                            if ($statusID == 1) { ?>
                                                Ongoing
                                        <?php    
                                            }
                                            elseif ($statusID == 3) { ?>
                                                Collect
                                        <?php
                                            }
                                            else { ?>
                                                Overdue
                                    <?php   } ?>
                                    </td>
                                </tr>	
                    <?php   } ?>
            </tbody>
        </table>
        <?php       }
                }
                else {
                    echo "Error selecting table " . $conn->error;
                }
        ?>
	</form>

<?php include '../member/memberFooter.php'; ?>