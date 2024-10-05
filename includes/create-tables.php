
<?php

// aq vamateb xolme cxrilebs

// Include database connection file
/*
require_once 'database.php';

// SQL to add a new column 'poster_url' to the 'movies' table
$sql_add_column = "ALTER TABLE filmi ADD COLUMN date DATE";

// Execute SQL query to add column
if ($conn->query($sql_add_column) === TRUE) {
    echo "Column 'date' added successfully<br>";
} else {
    echo "Error adding column: " . $conn->error . "<br>";
}

// Close database connection
$conn->close();
*/




// Execute the SQL query to create the table


/*

// Include database connection file
require_once 'database.php';

// SQL queries to create tables
$sql_genre = "CREATE TABLE IF NOT EXISTS genre (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
)";

$sql_nationality = "CREATE TABLE IF NOT EXISTS nationality (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
)";

$sql_director = "CREATE TABLE IF NOT EXISTS director (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    nationality_id int,
    birthdate date,
    biography text,
    website_url varchar(255),
    PRIMARY KEY (id),
    FOREIGN KEY (nationality_id) REFERENCES nationality(id)
)";

$sql_actor = "CREATE TABLE IF NOT EXISTS actor (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    nationality_id int,
    birthdate date,
    biography text,
    website_url varchar(255),
    PRIMARY KEY (id),
    FOREIGN KEY (nationality_id) REFERENCES nationality(id)
)";

$sql_movie = "CREATE TABLE IF NOT EXISTS movie (
    id int NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    release_date date NOT NULL,
    genre_id int,
    director_id int,
    plot_summary text,
    rating decimal(3,1),
    duration_minutes int,
    poster_url varchar(255),
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (genre_id) REFERENCES genre(id),
    FOREIGN KEY (director_id) REFERENCES director(id)
)";


$sql_movie_actor = "CREATE TABLE IF NOT EXISTS movie_actor (
    movie_id int,
    actor_id int,
    role varchar(255),
    PRIMARY KEY (movie_id, actor_id),
    FOREIGN KEY (movie_id) REFERENCES movie(id),
    FOREIGN KEY (actor_id) REFERENCES actor(id)
)";

$sql_review = "CREATE TABLE IF NOT EXISTS review (
    id int NOT NULL AUTO_INCREMENT,
    movie_id int,
    reviewer_name varchar(255),
    rating decimal(3,1),
    review_text text,
    review_date date,
    PRIMARY KEY (id),
    FOREIGN KEY (movie_id) REFERENCES movie(id)
)";

// Array of SQL queries
$sql_queries = [
    'genre' => $sql_genre,
    'nationality' => $sql_nationality,
    'director' => $sql_director,
    'actor' => $sql_actor,
    'movie' => $sql_movie,
    'movie_actor' => $sql_movie_actor,
    'review' => $sql_review
];

// Execute queries
foreach ($sql_queries as $table => $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Table $table created successfully<br>";
    } else {
        echo "Error creating table $table: " . $conn->error . "<br>";
    }
}

// Close database connection
$conn->close();
*/
?>





