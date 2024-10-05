<?php

require_once 'includes/database.php';

// Get movie ID from session or URL
$movie_id = isset($_SESSION['movie_id']) ? intval($_SESSION['movie_id']) : 0;
if ($movie_id <= 0) {
    http_response_code(400); // Bad Request
    echo "Invalid Movie ID";
    exit;
}

// Prepare SQL query to fetch comments
$sql = "SELECT user_id, comment, created_at FROM comments WHERE movie_id = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    http_response_code(500); // Internal Server Error
    echo "Error preparing statement for comments";
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $movie_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Fetch all comments
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    // Create a lookup array for usernames
    $usernames = [];

    // Only fetch usernames if there are comments
    if (!empty($comments)) {
        // Prepare SQL query to fetch usernames
        $sql_user = "SELECT id, username FROM users WHERE id IN (" . implode(',', array_column($comments, 'user_id')) . ")";
        $stmt_user = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt_user, $sql_user)) {
            http_response_code(500); // Internal Server Error
            echo "Error preparing statement for user query";
            exit();
        } else {
            mysqli_stmt_execute($stmt_user);
            $result_user = mysqli_stmt_get_result($stmt_user);

            // Fetch all users
            $users = mysqli_fetch_all($result_user, MYSQLI_ASSOC);
            mysqli_stmt_close($stmt_user);

            // Create a lookup array for usernames
            foreach ($users as $user) {
                $usernames[$user['id']] = htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8');
            }
        }
    }

    // Display all comments with usernames
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Comments</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="comments-container">
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <p class="username"><?php echo isset($usernames[$comment['user_id']]) ? $usernames[$comment['user_id']] : "Username not found"; ?></p>
                    <p class="meta"><strong>User ID:</strong> <?php echo htmlspecialchars($comment['user_id'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="content"><strong>Comment:</strong> <?php echo htmlspecialchars($comment['comment'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="date"><small><em>Posted on: <?php echo htmlspecialchars($comment['created_at']); ?></em></small></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-comments">No comments yet</p>
        <?php endif; ?>
    </div>
    </body>
    </html>
    <?php
}
?>
