<?php include '../librarian/librarianHeader.php'; ?>

    <?php 
		$authorID = $_SESSION['authorID'];
		$sql = "SELECT * FROM authors WHERE author_id = $authorID";
		$result = $conn->query($sql);

		if ($result) { 
			//Data Found
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) { 
    ?>

    <form method="post" class="frmUpdateAuthor">
        <h1>Update Author Information</h1>
        <label for="authorName">Name</label><br>
            <input type="text" id="authorName" name="authorName" value="<?= $row['author_name'] ?>" class="form-control"><br>
        <label for="authorSurname">Surname</label><br>
            <input type="text" id="authorSurname" name="authorSurname" value="<?= $row['author_surname'] ?>" class="form-control"><br>
        <label for="authorDob">Date of Birth</label><br>
            <input type="number" id="authorDob" name="authorDob"  value="<?= $row['author_age'] ?>" class="form-control"><br>
        <label for="authorGenre">Genre</label><br>
            <?php 
                $sql = "SELECT * FROM genre";
                $genreResult = $conn->query($sql);

                if ($genreResult) {
                    if ($genreResult->num_rows > 0) {
                        while ($genreRow = $genreResult->fetch_assoc()) { 
                            $authorID = $row['author_id'];
                            $genreID = $genreRow['genre_id'];

                            $sql = "SELECT * FROM authors_genre 
                                    WHERE author_id = $authorID AND genre_id = $genreID";

                            $authorGenreResult = $conn->query($sql);                            

                            if ($authorGenreResult) {
                                if ($authorGenreResult->num_rows > 0) {
                                    while ($authorGenreRow = $authorGenreResult->fetch_assoc()) { ?>
                                            <input type="checkbox" id="checkbox<?= $genreRow['genre_id'] ?>" name="authorGenre[]" value="<?= $genreRow['genre_id'] ?>" checked="true"><?= $genreRow['genre_name'] ?><br>
            <?php

                                    }
                                }
                                else { 
            ?>
                                    <input type="checkbox" id="checkbox<?= $genreRow['genre_id'] ?>" name="authorGenre[]" value="<?= $genreRow['genre_id'] ?>"><?= $genreRow['genre_name'] ?><br>
            <?php               }
                            }	   
                        }
                    }
                    else {
                        echo "Error selecting table " . $conn->error;
                    }
                }
		    ?>
        <div> 
            <br>
            <input type="submit" id="btnSubmitUpdateAuthor" name="btnSubmitUpdateAuthor" value="Submit" class="btn btn-success btnSubmitAuthor">
            <button id="btnCancelUpdateAuthor" name="btnCancelUpdateAuthor" value="Cancel" class="btn btn-danger btnCancelAuthor">Cancel</button>
        </div>
    </form>

    <?php
                        }    
                    }
                }
                else {
                    //No Data Found
                }            
    ?>

<?php include '../librarian/librarianFooter.php'; ?>
