<?php
session_start();

require_once 'database.php';

  
    
// Retrieve movie_id from POST data
$movie_id = isset($_POST['movie_id']) ? intval($_POST['movie_id']) : 0;
$comment = $_POST['comment'];
if ($movie_id <= 0) {
    http_response_code(400); // Bad Request
    echo "Invalid Movie ID";
    exit;
} else {

if (isset($_POST['submit'])) {
                                                //        $comment = $_POST['comment'];
                                                //        echo 'Successful : comment : ';
                                                //        echo htmlspecialchars($comment);
                                                //        echo 'Session data:<br>';
                                                //        echo '<pre>';
                                                //        print_r($_SESSION); // Print the session array
                                                //        echo '</pre>';
                                                //        echo 'Retrieved movie_id: ' . $movie_id;
if(!isset($_SESSION['sessionId'])) {
    header("Location: ../login.php?error=notLoggedIn");
    exit();
} else {
    echo 'loggedIn';
    if(empty($comment)) {
        header("Location: ../watchMovie.php?id=" . $movie_id . "&error=emptyfields&comment=" . urlencode($comment));
        exit();
    } else {
        $sql = "INSERT INTO comments (user_id, movie_id, comment) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../watchMovie.php?id=" . $movie_id . "&error=sqlerror");
            exit();
        } else {
            $userId = $_SESSION['sessionId'];
            mysqli_stmt_bind_param($stmt, "iis", $userId, $movie_id, $comment);
            mysqli_stmt_execute($stmt);
            header("Location: ../watchMovie.php?id=" . $movie_id . "&success=commentWritten");
            exit();
        }
    }
}

} else {
    header("Location: ../index.php?error=accessForbidden");
    exit();
}
mysqli_stmt_close($stmt);
} 
?>
