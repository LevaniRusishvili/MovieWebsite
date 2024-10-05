<?php

if(isset($_POST['submit'])) {               //tu submits davachiret

    require 'database.php';
    $username=$_POST['username'];           //usernameshi vinaxavt rasac chavwert
    $password=$_POST['password'];           //passwordshii vinaxavt rac chavweret

    if(empty($username) || empty($password)) {          //tu romelimeshi araferi chagviweria
        header("Location: ../index.php?error=emptyfields");   //home page  
        exit();   
    } else {
//Here, we should check if input parameters matches database users
        $sql = "SELECT * FROM users WHERE username = ?";     //sql statement to select all users from users table, where username matches '?' 
        $stmt = mysqli_stmt_init($conn);    //conn gadaeca argumentad radgan statement objectma unda icodes romeb databases ukavshirdeba
        if(!mysqli_stmt_prepare($stmt, $sql)) {         //if there is some problems in $sql statement
            header("Location: ../index.php?error=sqlerror");   //home page  
            exit();  
        } else {                                        
           mysqli_stmt_bind_param($stmt, "s", $username); 
           mysqli_stmt_execute($stmt);
           $result = mysqli_stmt_get_result($stmt);

           if($row = mysqli_fetch_assoc($result)) {
             $passCheck = password_verify($password, $row['password']);
             if($passCheck==false) {
                header("Location: ../index.php?error=wrongpass");   //home page  
                exit(); 
             } elseif($passCheck == true) {
                session_start();
                $_SESSION['sessionId']=$row['id'];
                $_SESSION['sessionUser']=$row['username'];
                header("Location: ../index.php?success=loggedin"); //home page  
               
                exit();
                
             } else {
                header("Location: ../index.php?error=wrongpass");   //home page  
                exit(); 
             }
           } else {
            header("Location: ../index.php?error=nouser");   //home page  
            exit(); 
           }
        }
    }

} else {
    header("Location: ../index.php?error=accessforbidden");   //home page  
    exit();
}
?>