
<?php 

if(isset($_POST['submit'])) {
    require_once 'database.php';
    $title=$_POST['title'];
    $poster_url=$_POST['poster_url'];
    $date=$_POST['date'];
    $plot_summary=$_POST['plot_summary'];
    $director = $_POST['director'];
    $video_url = $_POST['video_url'];
    $genres = isset($_POST['genres'])? $_POST['genres']: [];  //condition ? value_if_true : value_if_false.
    if(empty($title) || empty($poster_url) || empty($date) || empty($plot_summary) || empty($director)) {          //tu romelimeshi araferi chagviweria
        header("Location: ../index.php?error=emptyfields");   //home page  
        exit();   
    } else {
        if (empty($genres)) {
            header("Location: ../movie.php?error=no_genres_checked"); // Redirect if no genres are checked
            exit();   
        } else {
    
        $sql = "SELECT * FROM filmi WHERE title = ?";
        $stmt = mysqli_stmt_init($conn); 
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");   //home page  
            exit();  
        } else {
            mysqli_stmt_bind_param($stmt, "s", $title);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_store_result($stmt);
            $rowCount=mysqli_stmt_num_rows($stmt);
            if($rowCount>0) {
                header("Location: ../movie.php?error=titletaken");   
                exit(); 
            } else {
                $sql="INSERT INTO filmi (title, poster_url, date,plot_summary, director, video_url) VALUES (?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../movie.php?error=sqlerror");     
                    exit(); 
                } else {
                    mysqli_stmt_bind_param($stmt, "ssssss",$title, $poster_url, $date, $plot_summary,$director, $video_url);
                    mysqli_stmt_execute($stmt);

                    $movie_id = mysqli_insert_id($conn);
                    foreach($genres as $genre) {
                        $sql_genre = "INSERT INTO film_genre (film_id, genre_id) VALUES (?,?)";
                        $stmt_genre = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt_genre, $sql_genre)) {
                            header("Location: ../movie.php?error=sqlerror"); // Redirect for SQL error
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt_genre, "ii", $movie_id, $genre);
                            mysqli_stmt_execute($stmt_genre);
                            mysqli_stmt_close($stmt_genre);
                        }
                    }
                    header("Location: ../movie.php?success=movieadded");     
                        exit(); 
                }
            }           
        }
    }
}
    mysqli_stmt_close($stmt);  
    mysqli_close($conn);
}

?>
