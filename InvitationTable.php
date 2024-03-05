<?php

session_start();
            
if ($_SERVER["REQUEST_METHOD"] == "POST") {


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

        
            if (isset($_SESSION['rfemail'])) {
                
                $rfemail = $_SESSION['rfemail'];
            } 
              
        
           // $referenceCode = generateReferenceCode();
            
            // Insert data into database
            $sql = "INSERT INTO invitemeberinfo (User_Email,Invited_Member_Email) 
                    VALUES ('$rfemail','$email')";

            if ($conn->query($sql) === TRUE) {
                // Send verification email
                sendInvitationEmail($email,$rfemail,$conn);
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();

}


function sendInvitationEmail($to, $rfemail,$conn) {


    $subject = "Invitation for join IIT Kanban Board.";
    $message = "Please Creat Account For Join to IIT Kanban Board for manage your Software Project Lab(SPL).\n";
    $message .= "Reference mail: $rfemail";
    $headers = "From: ij.jhumu.nstu@gmail.com"; // 

    if(mail($to, $subject, $message, $headers)){
        $_SESSION['success'] = "Invitation Successful.";

        header("Location: invite_member.php");

    }else{
        $_SESSION['success'] = "Invitation failed.";
        header("Location: invite_member.php");
    }

}
?>

