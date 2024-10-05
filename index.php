<body class = "main-body">
<!--<link rel="stylesheet" type="text/css" href="style.css"> -->

<?php
session_start();
require_once 'includes/header.php';
?>


<?php 
require_once 'viewMovies.php'; 
?>

<?php 
if(isset($_SESSION['sessionId'])): 
?>
 <div class="main-content">
     <p>You are logged in! Your session ID is: <?php echo htmlspecialchars($_SESSION['sessionId']); ?></p>
 
    <form action="includes/index-inc.php" method="post">
        <button type="submit" name="logout-submit">Log out</button>
    </form>
 </div>
<?php elseif(isset($_SESSION['logout_status']) && $_SESSION['logout_status'] == 'logged_out'): ?>
  <p>You have been logged out successfully. Your session ID is: <?php echo htmlspecialchars($_SESSION['sessionId']); ?></p>  
<?php else:     ?>
    
    

<?php endif; ?>

<?php
require_once 'includes/footer.php';
?>
</body>