<?php

session_start();
            
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $email = $_POST["email"];
    //$project_id =$_POST['project_id'];

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

            if (isset($_SESSION['project_creator_email'])) {
                
                $project_creator_email = $_SESSION['project_creator_email'];
            } 

            if (isset($_SESSION['projectID'])) {
                
                $project_id = $_SESSION['projectID'];
            } 


            $sql2 = "SELECT VerificationID FROM CreateProjectInfo WHERE Project_ID = '$project_id'";
            $result = $conn->query($sql2);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    
                    $referenceCode =  $row['VerificationID'];

                    $sql = "INSERT INTO ProjectMember (Project_ID,User_Email,Invited_Member_Email,Reference_Code) 
                    VALUES ('$project_id','$rfemail','$email','$row[VerificationID]')";
        
                    if ($conn->query($sql) === TRUE) {
                        sendVerificationEmail($email, $project_id, $referenceCode,$conn);
                        exit;
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                
                }
            }
            $conn->close();

}

function generateReferenceCode() {
    // Generate a random 6-character alphanumeric code
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $verificationCode = '';
    for ($i = 0; $i < 6; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $verificationCode .= $characters[$index];
    }
    return $verificationCode;
}

function sendVerificationEmail($to,$project_id,$referenceCode,$conn) {


    $subject = "Invitation mail for join Project";
    $message = "Use the Join ID and Verification to Join your project:\n";
    $message .= "Join ID: $project_id"  . "& Verification ID=" . urlencode($referenceCode);
    $headers = "From: ij.jhumu.nstu@gmail.com"; // 

    if(mail($to, $subject, $message, $headers)){
        $_SESSION['success'] = "Add Member Successful.";

        header("Location: AddMemberForm.php");

    }else{
        $_SESSION['success'] = "Add Member Failed.";
        header("Location: AddMemberForm.php");
    }

}
?>

