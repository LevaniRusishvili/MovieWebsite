<body class="main-body">
<?php
require_once 'includes/header.php';
?>
  <link rel="stylesheet" type="text/css" href="styles/mainBody.css">
  <link rel="stylesheet" type="text/css" href="styles/loginStyle.css">
    <div class="login-container">
        <h1 class="login-title">Log in</h1>
        <p class="login-info">No account? <a href="register.php" class="login-link">Register here!</a></p>
        <form action="includes/login-inc.php" method="post" class="login-form">
            <input type="text" name="username" placeholder="Username" class="login-input">
            <input type="password" name="password" placeholder="Password" class="login-input">
            <button type="submit" name="submit" class="login-button">LOGIN</button>
        </form>
    </div>
<?php
require_once 'includes/footer.php';
?>
</body>
