<?php
require_once "database.php";
$movieName = $_POST['movieName'];
if(isset($_POST['submit'])) {
    if(empty($movieName)) {
    header("Location: ../index.php?error=emptyfields");   
    exit();
    } else {
    $sql= "SELECT id FROM  filmi where title = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");     
        exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $movieName); 
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            if($row>0) {
                    echo 'ID: ' . htmlspecialchars($row['id']) . '<br>';   
                    header("Location: ../watchMovie.php?id=".$row['id']);   //home page  
                    exit();
            } else {
                echo "no movie found with that title";
            }
            
        }
    }
    mysqli_stmt_close($stmt);
} else {
    header("Location: ../index.php?error=accessforbidden");   
    exit();
}
?>
