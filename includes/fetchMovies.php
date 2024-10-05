<?php
require_once 'database.php';

//----------------------------DataRetrive------------------------------------------------------------
//If the query is a SELECT statement, this result is a set of rows from the database.
// For other types of queries (like INSERT, UPDATE, DELETE), 
//it returns a success or error status.

//type : result is an instance of the mysqli_result class
//purpose: It provides methods to access the rows and columns of the result set returned by your SQL query.
//row is an associative arrat with column names as keys
//row[title]=>The Matrix [poster_url]=>... 


$sql_select_movies = "SELECT id, title, poster_url, date, plot_summary, director, video_url FROM filmi";
$result = $conn->query($sql_select_movies);     //executes sql_select_movies command

if($result->num_rows>0) {
    $movies = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array. abrunebs masivs
   
} else {
    $movies = [];
}



//$conn->close();
//-----------------------------------------------------------------------------------------------------
?>