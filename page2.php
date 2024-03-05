<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
    $password1 = $_POST["password"];
    $correct_password = md5($_POST["confirm-password"]);
    $status="Inactive";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email format is not correct.";
        header("Location: 2ndSignUp.php"); 
        exit;
    } else {

        if (md5($_POST["password"]) === $correct_password) {

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";    
            $dbname = "Kanban_Board";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Generate a random verification code
            $verificationCode = generateVerificationCode();

            // Insert data into database
            $sql = "INSERT INTO UserTable (User_Email, First_Password, Correct_password, Status, VerificationCode) 
                    VALUES ('$email', '$password1', '$correct_password', '$status', '$verificationCode')";

            if ($conn->query($sql) === TRUE) {
                // Send verification email
                sendVerificationEmail($email, $verificationCode);
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

        } else {
            $_SESSION['error'] = "Confirm password not matched.";
            header("Location: 2ndSignUp.php");
            exit;
        }
    }
}

function generateVerificationCode() {
    // Generate a random 6-character alphanumeric code
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $verificationCode = '';
    for ($i = 0; $i < 6; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $verificationCode .= $characters[$index];
    }
    return $verificationCode;
}

function sendVerificationEmail($to, $verificationCode) {


    $subject = "Email Verification for Your App";
    $message = "Click the following link to verify your email:\n";
    $message .= "http://localhost/verify.php?email=" . urlencode($to) . "&code=" . urlencode($verificationCode);
    $headers = "From: ij.jhumu.nstu@gmail.com"; // Replace with your actual email address

    //mail($to, $subject, $message, $headers);

    if(mail($to, $subject, $message, $headers)){
        $_SESSION['success'] = "Account created successfully. Please check your email for verification.";
        header("Location: verify1.php");
    }else{
        $_SESSION['success'] = "Verification Email sending failed.";
        header("Location: verify1.php");
    }

}
?>



