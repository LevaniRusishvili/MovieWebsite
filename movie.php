<body class="main-body">
<?php
require_once 'includes/header.php';
?>
<link rel="stylesheet" type="text/css" href="styles/mainBody.css">
<link rel="stylesheet" type="text/css" href="styles/addMoviesStyle.css">
    <div class="add-movie-container">
        <h1 class="add-movie-title">Add a New Movie</h1>
        <form action="includes/add-movie-inc.php" method="post" class="add-movie-form">
            <input type="text" name="title" placeholder="Title" required class="add-movie-input">
            <input type="text" name="poster_url" placeholder="Poster URL" required class="add-movie-input">
            <input type="date" name="date" placeholder="Date" required class="add-movie-input">
            <input type="text" name="plot_summary" placeholder="Movie Description" required class="add-movie-input">
            <input type="text" name="director" placeholder="Movie Director" required class="add-movie-input">
            <input type="text" name="video_url" placeholder="Video URL" required class="add-movie-input">
            <!-- Genre Dropdown -->
            <div class="dropdown">
                <button type="button" class="dropdown-button" onclick="toggleDropdown()">Select Genres</button>
                <div class="dropdown-content" id="genreDropdown">
                    <label><input type="checkbox" name="genres[]" value="1"> Action</label>
                    <label><input type="checkbox" name="genres[]" value="2"> Drama</label>
                    <label><input type="checkbox" name="genres[]" value="3"> Comedy</label>
                    <label><input type="checkbox" name="genres[]" value="4"> Horror</label>
                    <label><input type="checkbox" name="genres[]" value="5"> Sci-Fi</label>
                </div>
            </div>
            <button type="submit" name="submit" class="add-movie-button">Add Movie</button>
        </form>
    </div>

    <script>
    function toggleDropdown() {
        var dropdown = document.getElementById("genreDropdown");
        // Toggle display of dropdown content
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        var dropdown = document.getElementById("genreDropdown");
        var button = document.querySelector(".dropdown-button");
        // Check if the click was outside of the dropdown and the button
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = "none"; // Close the dropdown
        }
    }
    </script>
<?php
require_once 'includes/footer.php';
?>
</body>
