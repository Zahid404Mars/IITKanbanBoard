<?php

session_start();


if (isset($_GET['email']) && isset($_GET['code'])) {
    $email = $_GET['email'];
    $code = $_GET['code'];


    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Kanban_Board";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email and code match
    $verification_query = "SELECT * FROM UserTable WHERE User_Email='$email' AND VerificationCode='$code' AND Status='Inactive'";
    $result = $conn->query($verification_query);




    if ($result->num_rows > 0) {
        // Update database to mark email as verified
        $update_query = "UPDATE UserTable SET Status='Active' WHERE User_Email='$email'";

        if ($conn->query($update_query)) {
            $_SESSION['success'] = "Email verification successful! You can now log in.";

           /* $cleanedEmail = preg_replace('/[^a-zA-Z0-9_]/', '', $email);
            $emailParts = explode('@', $cleanedEmail);
            $cleanedEmail = $emailParts[0];
            $inviteTable = trim($cleanedEmail);

            $_SESSION['inviteTable'] = $inviteTable;

            $create_table_query = "CREATE TABLE IF NOT EXISTS $inviteTable (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                Invited_Email VARCHAR(255) NOT NULL
            )";

            if ($conn->query($create_table_query)) {
                header("Location: 3rdLogin.php");
                exit;
            } else {
                $_SESSION['error'] = "Error creating invited members table.". $conn->error;
                header("Location: 3rdLogin.php");
                exit;
            }*/
            header("Location: 3rdLogin.php");
            exit;

        } else {
            $_SESSION['error'] = "Error updating verification status.";
            header("Location: verify.php?email=$email&code=$code");
            exit;
        }
    } else {
        $_SESSION['error'] = "Invalid verification link.";
        header("Location: 3rdLogin.php");
        exit;
    }
    
    $conn->close();
} else {
    $_SESSION['error'] = "Invalid verification link.";
    header("Location: 3rdLogin.php");
    exit;
}
?>
