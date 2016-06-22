<?php
require 'info.php';

// Check the if there is a Database connection. Use $mysqli from info.php for this.
function checkDBCon($mysqli)
{

	// If it wasn't possible to connect, post the error

	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}
}

// Function to create a DataBase called 'litebasecms' and a table called 'articles'
function createDB($mysqli)
{

	// SQL query to create DB if it doesn't exist already

	$sql = "CREATE DATABASE IF NOT EXISTS litebasecms";

	// If the DB was created, continue if not, post the error

	if ($mysqli->query($sql) === TRUE) {
		echo "Database created successfully. Refresh to continue.";
	}
	else {
		echo "Error creating database.. " . $mysqli->error;
	}
}

function createTable($mysqli)
{
	// Check create table 'articles' if it doesn't exist already

	$table = "CREATE TABLE IF NOT EXISTS articles (
            id int NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(id),
            title TEXT NOT NULL,
            text TEXT NOT NULL,
            reg_date TIMESTAMP
    )";

	// If an error occurs, post the error

	if ($mysqli->query($table) === FALSE) {
		echo "Error creating table... " . $mysqli->error;
	}
}

function handlePosts($mysqli, $conn)
{
	// SQL query to get all the articles

	$getPost = "SELECT * FROM articles ORDER BY id DESC";
	$result = $mysqli->query($getPost);

	// If there are more than 0 results in the table, post the articles. If not display '0 results, with a link to add posts'

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {

			// Declaring some fars
			$id = $row['id']; // Get the ID of a post from the colum id in the DB
			$nameDel = 'del' . $id; // The HTML elements will have this name with the id number
			$nameEdit = 'edit' . $id; // The HTML elements will have this name with the id number

			// Echo a whole bunch of HTML stuff to make it look pretty
			echo "<div id='del'><form action='' method='post'><input type=submit name='$nameDel' value='Delete post'></form></div>";
			echo "<div id='edit'><form action='' method='post'><input type=submit name='$nameEdit' value='Edit post'></form></div><br />";
			echo "<div id='title'><h4> " . $row['title'] . "</h4></div>";
			echo "<div id='text'> " . $row['text'] . "</div><br />";
			echo "<div id='id'>ID:  " . $id . "</div>";
			echo "<div id='time'>Posted on: " . $row['reg_date'] . "</div><br />";
			echo "<br />";

			// If the delete button is clicked, run this SQL query.
			// The reason $nameDel is what it is, is so only if that button will be clicked, the command will run.
			// Otherwise, if a user clicks the del button on post 2, post 1 would be deleted. Now only post 2.
			if (isset($_POST[$nameDel])) {

				// SQL query to delete the row where the ID is the ID of the post where the delete button was pressed.

				$sql = "DELETE FROM articles WHERE id = $id LIMIT 1";
				if ($conn->query($sql)) {
					echo "Post deleted. -- Refresh to see changes.";
				}
				else {
					echo "Could not delete post";
				}
			}

			$edit = 'edit' . $id; // The HTML elements will have this name with the id number
			$editSubmit = 'editSubmit' . $id; // The HTML elements will have this name with the id number
			if (isset($_POST[$nameEdit])) {
				echo "<form action='' method='post'>
                        <input type='text' name='$edit' placeholder='Put in new text here...' autocomplete='no'>
                        <input type='submit' name='$editSubmit' value='Send'>
                    </form>";
			}

			// If the delete button is clicked, run a SQL query.
			// The reason the vars have $id in it, is to that only that button will run that specific SQL query
			// Otherwise, if a user clicker edit button on post 2, post 1 would be edited. Now only post 2.
			if (isset($_POST[$editSubmit])) {

				// Check if there is something filled in...

				if ($_POST[$edit] != '') {
					$input = htmlspecialchars($_POST[$edit]); //use htmlspecialchars to sanitise input
					$sql = "UPDATE articles SET text='$input' WHERE id=$id";

					// Run SQL query

					if ($conn->query($sql)) {
						echo "The post has been updated. Refresh to see the changes.";
					}
					else {
						echo "Something went wrong. Please try again.";
					}
				}
			}

			echo "<hr>";
		}
	}
	else {
		echo "0 results --- Click <a href='./admin.php'>here</a> to add an article";
		echo $mysqli->error;
	}
}

function addPost($conn)
{
	if (isset($_POST['submit'])) {
		$title = htmlspecialchars($_POST['title']); //Use htmlspecialchars to sanitze input
		$text = htmlspecialchars($_POST['text']); //Use htmlspecialchars to sanitze input

		// SQL query to insert the text the user put in, in to the DB
		$insert = "INSERT INTO articles (title, text) VALUES ('$title', '$text');";

		// If the user filled in text, then run the SQL query. If not, echo some text to say like hey fill something in.
		if ($title != "" && $text != "") {
			$conn->query($insert);
			echo "<div id='posts'>The article was added successfully! Click <a href='./index.php'>here</a> to view it.</div>";
		}
		else {
			echo "<div id='posts'>Something went wrong while posting the article. <br /> Have you filled in the title and text?</div>";
		}
	}
}
