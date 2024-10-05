<?php
require_once 'includes/header.php';
require_once 'includes/database.php';

// Get movie ID from URL and validate it
$movie_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($movie_id <= 0) {
    http_response_code(400); // Bad Request
    echo "Invalid Movie ID";
    exit;
}
$_SESSION['movie_id'] = $movie_id;

// Prepare SQL query to fetch movie details
$sql = "SELECT title, poster_url, date, plot_summary, director, video_url FROM filmi WHERE id = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    http_response_code(500); // Internal Server Error
    header("Location: viewMovies.php?error=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $movie_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $movie = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Check if movie was found
if (!$movie) {
    http_response_code(404); // Not Found
    echo "Movie not found";
    exit();
}

// Connect genres with film_genre
$sql_genres = "SELECT g.id, g.name FROM genre g                      
               JOIN film_genre fg ON g.id = fg.genre_id  
               WHERE fg.film_id = ?";
$stmt_genres = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_genres, $sql_genres)) {
    http_response_code(500); // Internal Server Error
    header("Location: viewMovies.php?error=sqlerror");
    exit();
}

mysqli_stmt_bind_param($stmt_genres, "i", $movie_id);
mysqli_stmt_execute($stmt_genres);
$result_genres = mysqli_stmt_get_result($stmt_genres);

// Fetch the genres
$genres = [];
while ($row = mysqli_fetch_assoc($result_genres)) {
    $genres[] = $row;
}

mysqli_stmt_close($stmt_genres);

// Include header

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Movie</title>
    <link rel="stylesheet" type="text/css" href="styles/mainBody.css">
    <link rel="stylesheet" type="text/css" href="styles/watchMoviesStyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    console.log("Document ready");

    // Set video URL from PHP
    var videoUrl = '<?php echo htmlspecialchars($movie["video_url"]); ?>'; //convert to html characters
    console.log("Video URL: " + videoUrl); // Debugging: Verify URL is correct

    // Click event for movie image
    $('.poster-container img').click(function() {
        console.log("Movie clicked"); // Debugging: Verify click event

        if (videoUrl) {
            $('#videoPlayer').attr('src', videoUrl); // Set the video source
            $('.video-container').fadeIn(); // Show the video container with fade-in effect
            $('#videoPlayer')[0].play(); // Play the video
        } else {
            console.error("No video URL found."); // Error handling
        }
    });

    // Hide the video player when clicking outside
    $('.video-container').click(function(e) {
        if (e.target !== this) return; // Do nothing if the click is inside the video player
        console.log("Video container clicked"); // Debugging: Verify click event
        $(this).fadeOut(); // Hide the video player container with fade-out effect
        $('#videoPlayer')[0].pause(); // Pause the video
        $('#videoPlayer')[0].currentTime = 0; // Reset video to the beginning
    });
});
</script>
</head>
<body class="main-body">

<div class="container"> <!-- Added container to center content -->
    <div class="poster-container"> 
        <img src="<?php echo htmlspecialchars($movie['poster_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
        <h2 class="poster-title"><?php echo htmlspecialchars($movie['title']); ?></h2>
        <p class="poster-plot-summary"><?php echo htmlspecialchars($movie['plot_summary']); ?></p>
        <p class="poster-info"><strong>Release Date:</strong> <?php echo htmlspecialchars($movie['date']); ?></p>
        <p class="poster-info"><strong>Director:</strong> <?php echo htmlspecialchars($movie['director']); ?></p>

        <div class="poster-info">
            <strong>Genres:</strong>
            <ul>
                <?php if (count($genres) > 0): ?>
                    <?php foreach ($genres as $genre): ?>
                        <li><?php echo htmlspecialchars($genre['name']); ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No genres associated with this movie.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

   
    <div class="comment-section">
        <h3>Comments</h3>
        <form action="includes/comment-inc.php" method="post" class="add-comment-form">
            <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie_id); ?>">
            <input type="text" name="comment" placeholder="Add your comment..." required>
            <button type="submit" name="submit">SUBMIT</button>
        </form>

        <div class="comments-display">
            <?php
            // Include the comments display file
            include 'includes/displayComments.php';
            ?>
        </div>
    </div>
</div>

<div class="video-container">
    <video id="videoPlayer" controls>
        <source src="" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>



<?php
require_once 'includes/footer.php';
?>
</body>
</html>
