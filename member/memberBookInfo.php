<?php include '../member/memberHeader.php'; ?>

    <?php 
		$bookID = $_SESSION['bookID'];
		$sql = "SELECT * FROM books 
				INNER JOIN genre ON books.genre_id = genre.genre_id 
				INNER JOIN authors ON books.author_id = authors.author_id
				WHERE book_id = $bookID";
		$result = $conn->query($sql);

		if ($result) { 
			//Data Found
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) { 
    ?>

	<form method="post" class="frmAddBook">
		<h1>Book Information</h1>
		<label for="bookName">Name</label><br>
			<input type="text" id="bookName" name="bookName" value="<?= $row['book_name'] ?>" class="form-control" disabled><br>
		<label for="bookGenre">Genre</label><br>
		<select id="bookGenre" name="bookGenre" class="form-control" disabled>
			<option value="<?= $row['genre_id'] ?>" selected hidden><?= $row['genre_name'] ?></option>
			<?php 
				$sql = "SELECT * FROM genre";
				$genreResult = $conn->query($sql);

				if ($genreResult) {
					if ($genreResult->num_rows > 0) {
						while ($genreRow = $genreResult->fetch_assoc()) { ?>								
							<option value="<?= $genreRow['genre_id'] ?>"><?= $genreRow['genre_name'] ?></option>	
			<?php   	}
					}
				}
				else {
					echo "Error selecting table " . $conn->error;
				} 
			?>
			</select>
		<br><label for="bookAuthor">Author</label><br>			
			<select id="bookAuthor" name="bookAuthor" class="form-control" disabled>
				<option value="<?= $row['author_id'] ?>" selected hidden><?= $row['author_name'] . " " . $row['author_surname'] ?></option>
				<?php 
					$sql = "SELECT * FROM authors";
					$authorResult = $conn->query($sql);

					if ($authorResult) {
						if ($authorResult->num_rows > 0) {
							while ($authorRow = $authorResult->fetch_assoc()) { ?>
								<option value="<?= $authorRow['author_id'] ?>"><?= $authorRow['author_name'] . " " . $authorRow['author_surname'] ?></option>
			
				<?php   	}
						}
					}
					else {
						echo "Error selecting table " . $conn->error;
					} 
				?>	
			</select><br>		
		<label for="bookPublishedDate">Published Date</label><br>
			<input type="date" id="bookPublishedDate" name="bookPublishedDate" value="<?= $row['book_published_date'] ?>" class="form-control" disabled><br>
		<label for="bookDesc">Description</label><br>
			<textarea id="bookDesc" name="bookDesc" class="form-control txtBookDesc" rows="5" disabled><?= $row['book_desc'] ?></textarea><br>
		<input type="submit" id="btnRentBook" name="btnRentBook" value="Rent Book" class="btn btn-success btnRentBook">
		<button id="btnCancelRentBook" name="btnCancelRentBook" value="Cancel" class="btn btn-danger btnCancelBook">Cancel</button>
	</form>

	<?php
                        }    
                    }
                }
                else {
                    //No Data Found
                }            
    ?>

<?php include '../member/memberFooter.php'; ?>