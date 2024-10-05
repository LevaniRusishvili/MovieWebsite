
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search</title>
    <link rel="stylesheet" type="text/css" href="styles/searchStyle.css">
</head>
<body class="search-body">
    <div class="search">
        <div class="search-container">
            <form action="includes/searchBar-inc.php" method="post">
                <input type="text" name="movieName" placeholder="Search for movies..." required>    
                <button type="submit" name="submit" class="Search-button"></button>
               
            </form>
        </div>
    </div>
</body>
</html>
