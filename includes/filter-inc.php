<?php

if (isset($_POST['submit'])) {
    require_once 'database.php';
    $selectedGenres = $_POST['genre'];  //array
    $placeholders = implode(',', array_fill(0, count($selectedGenres), '?')); //0 indexidan ramdeni elementicaa im indexamde chasvas ? da dasvas mdzime.
//davsvat imdeni kitxvisnishani, ramdeni genrec movnishnet
    $sql = "SELECT * FROM genre WHERE name IN ($placeholders)";     //tu gvinda bevri parametri gadavcet, IN gamoviyenot shemdegnairad, magalitad where name IN('comedy', 'drama');
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");   //home page  
        exit();  
    } else {
        $types = str_repeat('s', count($selectedGenres));  // ramdeni elementicaa mashivshi imdeni s
        mysqli_stmt_bind_param($stmt, $types, ...$selectedGenres); //... splat operatori php shi, romelic acalkevebs argumentebs, anu, sabolood eseti ragaca miigeba
        //mysqli_stmt_bind_param($stmt, 'sss', 'Comedy', 'Action') rasac amovirchevt
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $genreIds = [];

        while($row = mysqli_fetch_assoc($result)) {
       //     echo "genre".$row['id'];
            $genreIds[]=$row['id'];

        }
        mysqli_stmt_close($stmt);
        
           // Debugging output
      //  echo "<pre>";
      //  print_r($genreIds);
      //  echo "</pre>";
    
        
    }
    $placeholdersForFilmi = implode(',', array_fill(0, count($genreIds), '?'));
    $sqlForFilm = "SELECT film_id FROM film_genre WHERE genre_id IN ($placeholdersForFilmi)";
    $stmtForFilm = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmtForFilm, $sqlForFilm)) {
        header("Location: ../index.php?error=sqlerror");  
        exit();  
    } else {
        $typesForFilmi = str_repeat('i', count($genreIds));
        mysqli_stmt_bind_param($stmtForFilm, $typesForFilmi, ...$genreIds);
        mysqli_stmt_execute($stmtForFilm);
        $resultForFilm=mysqli_stmt_get_result($stmtForFilm);
        $filmIds = [];
        while($row = mysqli_fetch_assoc($resultForFilm)) {
         //   echo ("film Id ". $row['film_id']);
            $filmIds[] = (int)$row['film_id'];
        }
       
    }
    mysqli_stmt_close($stmtForFilm);
   // $_SESSION['film_ids'] = $filmIds;
    
    // Redirect to viewMovies.php
    //header("Location: ../viewMovies.php");
    //exit();
 
} else {
    header("Location: ../index.php?error=submiterror");
    exit();
}

//selectedGenres = ['Comedy', 'Action']
?>




