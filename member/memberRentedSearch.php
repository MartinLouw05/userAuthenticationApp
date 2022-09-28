<?php include '../member/memberHeader.php'; ?>

    <h1>Outstanding Books
        <form method="post" class="frmRented">       
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
                    $memberSearch = $_SESSION['memberSearch'];
                
                    $sql = "SELECT * FROM books_rented 
                            INNER JOIN books ON books_rented.book_id = books.book_id                              
                            INNER JOIN members ON books_rented.member_id = members.member_id 
                            INNER JOIN authors ON books.author_id = authors.author_id 
                            WHERE book_name LIKE '%$memberSearch%'";

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
                        <?php       }
                                }
                                else { 								
                                        //Do Not Show These Books
                                }
                            }	
                ?>
            </tbody>
        
        <?php
                    }
                    else { 
                        echo "  <script>  
                                    alert('No Books Found.  Please Try Again.'); 
                                    window.location.href = './memberRented.php';
                                </script>";
                    }
                }
                else { 
                    echo "Error selecting table " . $conn->error;
                }
        ?>
        </table>
	</form>

<?php include '../member/memberFooter.php'; ?>