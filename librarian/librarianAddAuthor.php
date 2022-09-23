<?php include '../librarian/librarianHeader.php'; ?>

	<form method="post" class="frmAddAuthor">
        <h1>Add Author</h1>
        <label for="authorName">Name</label><br>
            <input type="text" id="authorName" name="authorName" class="form-control"><br>
        <label for="authorSurname">Surname</label><br>
            <input type="text" id="authorSurname" name="authorSurname" class="form-control"><br>
        <label for="authorDob">Date of Birth</label><br>
            <input type="date" id="authorDob" name="authorDob" class="form-control"><br>
        <label for="authorGenre">Genre</label><br>
            <?php 
                $sql = "SELECT * FROM genre";
                $result = $conn->query($sql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <input type="checkbox" id="checkbox<?= $row['genre_id'] ?>" name="authorGenre[]" value="<?= $row['genre_id'] ?>"><?= $row['genre_name'] ?><br>
            <?php	    }	   
                    }
                }
                else {
                    echo "Error selecting table " . $conn->error;
                }
		    ?>
        <div> 
            <br>
            <input type="submit" id="btnSubmitAuthor" name="btnSubmitAuthor" value="Submit" class="btn btn-success btnSubmitAuthor">
            <button id="btnCancelAuthor" name="btnCancelAuthor" value="Cancel" class="btn btn-danger btnCancelAuthor">Cancel</button>
        </div>
    </form>

<?php include '../librarian/librarianFooter.php'; ?>
