<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ...

    $project_id = $_POST["project-Id"];
    $project_name = $_POST["project-name"];
    $supervisor = $_POST["supervisor-name"];
    $project_des = $_POST["project-description"];
    $creator_mail = $_POST["project-creator-mail"];

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

    $_SESSION['project_creator_email']=$creator_mail;


    $verificationID = generateVerificationID();

    $_SESSION['verificationID'] =$verificationID;


    

    $sql = "INSERT INTO CreateProjectInfo (User_Email,Project_ID, Project_Name, Supervisor_Name, Project_Description, Project_Creator_Eail,VerificationID) 
    VALUES ('$rfemail','$project_id', '$project_name', '$supervisor','$project_des', '$creator_mail','$verificationID')";


    if ($conn->query($sql) === TRUE) {

            $subject = "Your are invited as supervisor in project ".$project_name;
            $message = "Use the join ID and Verification ID to Join Your Project:\n";
            $message .= "Join ID: $project_id"  . "& Verification ID=" . urlencode($verificationID);
            $headers = "From: ij.jhumu.nstu@gmail.com";
        
            if(mail($creator_mail, $subject, $message, $headers)){
            
                $sql2 = "INSERT INTO ProjectMember (Project_ID,User_Email,Invited_Member_Email,Reference_Code) 
                VALUES ('$project_id','$rfemail','$creator_mail','$verificationID')";
    
                if ($conn->query($sql2) === TRUE) {
                    header("Location: home.php");
                    exit;
                } else {
                    header("Location: home.php");
                    exit;
                }
            }else{
                // $_SESSION['success'] = "Verification Email sending failed.";
                header("Location: home.php");
                exit;
            }
        }else {
        $_SESSION['projectidbooked']="Try different Project ID";
        header("Location: CreateProjectForm.php");
        }

$conn->close();
}




function generateVerificationID() {
    // Generate a random 6-character alphanumeric code
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $verificationCode = '';
    for ($i = 0; $i < 6; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $verificationCode .= $characters[$index];
    }
    return $verificationCode;
}

?>