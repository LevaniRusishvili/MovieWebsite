<?php
require_once 'includes/fetchMovies.php';
require_once 'includes/header.php';
require_once 'filter.php';
require_once 'includes/searchBar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" type="text/css" href="styles/mainBody.css">
    <link rel="stylesheet" type="text/css" href="styles/viewMoviesStyle.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>


<body class ="movie-body">
<div class="movie-container">
    <?php if (!empty($movies)): ?>
        <?php foreach ($movies as $movie): ?>
            <div class="movie" data-id="<?php echo htmlspecialchars($movie['id']); ?>"> 
                <img src="<?php echo htmlspecialchars($movie['poster_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
              
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-movies">No movies found.</p>
    <?php endif; ?>
</div>

<script>
    $(document).ready(function() {
        $('.movie').click(function() {
            var movieId = $(this).data('id');  // Get the movie ID from the data-id attribute
            if (movieId) {
                window.location.href = 'watchMovie.php?id=' + movieId;  // Redirect to watchMovie.php with the movie ID
            } else {
                alert('Movie ID not found');
            }
        });
    });
</script>

<?php
require_once 'includes/footer.php';
?>

</body>
</html>
