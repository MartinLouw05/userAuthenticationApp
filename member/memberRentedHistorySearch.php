<?php include '../member/memberHeader.php'; ?>

    <h1>Rented Books History
        <form method="post" class="frmRented">
            <input type='text' id="rentedSearch" name="rentedSearch" placeholder="Search for Books" class="rentedSearch">
            <button id="btnRentedHistorySearch" name="btnRentedHistorySearch" class="btn btn-secondary btnRentedSearch">&#128269</button>   
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
                    $memberSearch = $_SESSION['memberSearch'];
                
                    $sql = "SELECT * FROM books_rented 
                            INNER JOIN books ON books_rented.book_id = books.book_id 
                            INNER JOIN members ON books_rented.member_id = members.member_id 
                            WHERE book_name LIKE '%$memberSearch%'";
                            
                    $result = $conn->query($sql);
                    
                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { 
                                if ($row['member_id'] == $_SESSION['loggedInMemberID']) { ?>                                    
                                    <tr class="rentedTableRow">
                                        <td><?= $row['book_name'] ?></td>
                                        <td><?= $row['member_name'] . " " . $row['member_surname'] ?></td>
                                        <td><?= $row['rented_date'] ?></td>
                                        <td><?= $row['rented_return_date'] ?></td>
                                    </tr>	
                        <?php   }
                                else { 								
                                        //Do Not Show These Books
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
                                    window.location.href = './memberRentedHistory.php';
                                </script>";
                    }
                }
                else {
                    echo "Error selecting table " . $conn->error;
                }
        ?>
	</form>

<?php include '../member/memberFooter.php'; ?>