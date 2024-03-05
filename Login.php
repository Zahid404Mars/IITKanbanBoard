<?php

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ...

    $email = $_POST["email"];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";    
    $dbname = "Kanban_Board";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email exists
    $email_check_query = "SELECT * FROM UserTable WHERE User_Email='$email'";
    $result = $conn->query($email_check_query);


   // $email_check_query1 = "SELECT * FROM joinTable WHERE Email='$email'";
   // $result1 = $conn->query($email_check_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['Correct_password']; // Get the stored password hash from the database
        $EmailVerified=$row['Status'];

        // ...
        if (md5($_POST["password"]) === $stored_password) {

            if($EmailVerified==='Active'){
                // Password is correct & email is verified, redirect to the board page
                $cleanedEmail = preg_replace('/[^a-zA-Z0-9_]/', '', $email);
                $emailParts = explode('@', $cleanedEmail);
                $cleanedEmail = $emailParts[0];
                $inviteTable = trim($cleanedEmail);
                $_SESSION['inviteTable'] = $inviteTable;

                $_SESSION['rfemail'] = $email;
                
                header("Location: home.php");
                exit;
            }else{
                $_SESSION['error'] = "Verified the email.";
                header("Location: verify1.php");
            } 
        } else {
            $_SESSION['error'] = "Password is incorrect.";
            header("Location: 3rdLogin.php");
            //var_dump($_POST["password"]);
            //var_dump($stored_password);
            exit;
        }


    }else if($result1->num_rows > 0){

        $row = $result->fetch_assoc();
        $stored_password = $row['Correct_password']; // Get the stored password hash from the database
        $EmailVerified=$row['IsEmailVerified'];

        // ...
        if (md5($_POST["password"]) === $stored_password) {

            if($EmailVerified==='Active'){
                // Password is correct & email is verified, redirect to the board page
                $cleanedEmail = preg_replace('/[^a-zA-Z0-9_]/', '', $email);
                $emailParts = explode('@', $cleanedEmail);
                $cleanedEmail = $emailParts[0];
                $inviteTable = trim($cleanedEmail);
                $_SESSION['inviteTable'] = $inviteTable;
                
                header("Location: home.php");
                exit;
            }else{
                $_SESSION['error'] = "Verified the email.";
                header("Location: verify1.php");
            } 
        } else {
            $_SESSION['error'] = "Password is incorrect.";
            header("Location: 3rdLogin.php");
            //var_dump($_POST["password"]);
            //var_dump($stored_password);
            exit;
        }

    }
    
    else {
        $_SESSION['error'] = "Email not found. Please create an account or try a different email.";
        header("Location: 3rdLogin.php");
        exit;
    }

    $conn->close();
}
?>



