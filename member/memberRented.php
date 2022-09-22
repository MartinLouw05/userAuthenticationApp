<?php include '../member/memberHeader.php'; ?>

    <h1>Outstanding Books
        <form method="post" class="frmRented">
            <button id="btnRentedHistory" name="btnRentedHistory" class="btnRentedHistory">Rented History</button>
            <select id="rentedSelect" name="rentedSelect" class="rentedSelect">
                <option value="books">Books</option>
                <option value="members">Members</option>
            </select>
            <input type='text' id="rentedSearch" name="rentedSearch" class="rentedSearch">
        </form>
    </h1>

	<form method="post">
        <table class="rentedTable">
            <thead class="rentedTableHead">
                <th>Book</th>
                <th>Member</th>
                <th>Date Rented</th>
                <th>Return Date</th>
            </thead>
            <tbody>
                <?php			
                    $sql = "SELECT * FROM books_rented 
                            INNER JOIN books ON books_rented.book_id = books.book_id 
                            INNER JOIN members ON books_rented.member_id = members.member_id";
                    $result = $conn->query($sql);
                    
                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { 
                                if ($row['member_id'] == $_SESSION['loggedInMemberID']) { 
                                    if ($row['status_id'] == 1) {
                                        //These Books are Not Currently being Rented
                                    }
                                    else { ?>
                                        <tr class="rentedTableRow">
                                            <td><?= $row['book_name'] ?></td>
                                            <td><?= $row['member_name'] . " " . $row['member_surname'] ?></td>
                                            <td><?= $row['rented_date'] ?></td>
                                            <td><?= $row['rented_return_date'] ?></td>
                                        </tr>	
                        <?php       }
                                }
                                else { 								
                                        //Do Not Show These Books
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

<?php include '../member/memberFooter.php'; ?>