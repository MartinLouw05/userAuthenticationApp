<?php include '../librarian/librarianHeader.php'; ?>

	<form method="post" class="frmAddBook">
		<h1>Add Book</h1>
		<label for="bookName">Name</label><br>
			<input type="text" id="bookName" name="bookName" class="form-control"><br>
		<label for="bookGenre">Genre</label><br>
		<select id="bookGenre" name="bookGenre" class="form-control">
			<option value="" selected hidden>Please Select a Genre</option>
			<?php 
				$sql = "SELECT * FROM genre";
				$result = $conn->query($sql);

				if ($result) {
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) { ?>								
							<option value="<?= $row['genre_id'] ?>"><?= $row['genre_name'] ?></option>	
			<?php   	}
					}
				}
				else {
					echo "Error selecting table " . $conn->error;
				} 
			?>
			</select>
		<br><label for="bookAuthor">Author</label><br>			
			<select id="bookAuthor" name="bookAuthor" class="form-control">
				<option value="" selected hidden>Please Select an Author</option>
				<?php 
					$sql = "SELECT * FROM authors";
					$result = $conn->query($sql);

					if ($result) {
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) { ?>
								<option value="<?= $row['author_id'] ?>"><?= $row['author_name'] . " " . $row['author_surname'] ?></option>
			
				<?php   	}
						}
					}
					else {
						echo "Error selecting table " . $conn->error;
					} 
				?>	
			</select><br>		
		<label for="bookPublishedDate">Published Date</label><br>
			<input type="date" id="bookPublishedDate" name="bookPublishedDate" class="form-control"><br>
		<label for="bookDesc">Description</label><br>
			<textarea id="bookDesc" name="bookDesc" class="form-control"></textarea><br>
		<input type="submit" id="btnSubmitBook" name="btnSubmitBook" value="Submit" class="btn btn-success btnSubmitBook">
		<button id="btnCancelBook" name="btnCancelBook" value="Cancel" class="btn btn-danger btnCancelBook">Cancel</button>
	</form>

<?php include '../librarian/librarianFooter.php'; ?>
