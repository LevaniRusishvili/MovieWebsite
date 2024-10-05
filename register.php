<body class="main-body">
    <?php
    require_once 'includes/header.php';
    ?>
    <link rel="stylesheet" type="text/css" href="styles/mainBody.css">
    <link rel="stylesheet" type="text/css" href="styles/registerStyle.css">
    <div class="registration-container">
        <h1 class="registration-title">Register</h1>
        <p class="registration-info">Already have an account? <a href="Login.php" class="registration-link">Login here!</a></p>
        <form action="includes/register-inc.php" method="post" class="registration-form">
            <input type="text" name="username" placeholder="Username" class="registration-input">
            <input type="password" name="password" placeholder="Password" class="registration-input">
            <input type="password" name="confirmPassword" placeholder="Confirm Password" class="registration-input">
            <button type="submit" name="submit" class="registration-button">REGISTER</button>
        </form>
    </div>
    <?php
    require_once 'includes/footer.php';
    ?>
</body>
