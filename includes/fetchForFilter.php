<?php
require_once 'database.php';

$sql_select_director = "SELECT director FROM filmi";
$resultDirector = $conn->query($sql_select_director);
$directors = [];
if($resultDirector->num_rows>0) {
    while($row=$resultDirector->fetch_assoc()) {
        $directors[] = $row['director'];
    
    }
      
} else {
    echo "error, returned rows are 0";
}


$sql_select_genre = "SELECT name FROM genre";
$resultGenre = $conn->query($sql_select_genre);
$genres = [];
if($resultGenre->num_rows>0) {
    while($row=$resultGenre->fetch_assoc()) {
        $genres[] = $row['name'];     
    }
    //  foreach($genres as $genre) {
    //        echo $genre . '<br>';
    //    }  
} else {
    echo "error, returned rows are 0";
}

$conn->close();

?>