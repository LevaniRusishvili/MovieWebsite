<?php
if(isset($_POST['submit'])) {
    //add database connection
    require 'database.php';    
    $username = $_POST['username'];     //taking information that is written in Username
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPassword'];

    if(empty($username) || empty($password) || empty($confirmPass)) {
      header("Location: ../register.php?error=emptyfields&username=".$username);     
      exit();
    } elseif(!preg_match("/^[a-zA-Z0-9]*/",$username)) {        //ra dasashvebi simboloebi sheidzleba iyos usernameshi esenia a-z A-Z 0-9
        header("Location: ../register.php?error=invalidusername&username=".$username);     
      exit();
    } elseif($password!==$confirmPass) {
        header("Location: ../register.php?error=passwordsdonotmatch&username=".$username);     
        exit();
    } else {
        $sql="SELECT username FROM users WHERE username = ?";  //This line defines what data we want to get from the database. It's like asking the database, "Please give me the username from the users table where the username matches something."
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {                //if somethings wrong with communication with database, connect error, syntax error... 
            header("Location: ../register.php?error=sqlerror");     
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s",$username);    //bind dakavshireba. exla gadavcemt strings, usernames. tu sxva stringsac gadavcemdit, magalitad emails, "ss" davwerdit
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount=mysqli_stmt_num_rows($stmt);

            if ($rowCount>0) {
                header("Location: ../register.php?error=usernametaken");     
                exit();
            } else {
                $sql="INSERT INTO users (username, password) VALUES (?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../register.php?error=sqlerror");     
                    exit(); 
                } else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss",$username,$hashedPass);    //bind dakavshireba. exla gadavcemt strings, usernames. tu sxva stringsac gadavcemdit, magalitad emails, "ss" davwerdit
                    mysqli_stmt_execute($stmt);
                        header("Location: ../register.php?success=registered");     
                        exit(); 
                   
                }
            }
        }
    }
    mysqli_stmt_close($stmt);  
    mysqli_close($conn);
}
?>