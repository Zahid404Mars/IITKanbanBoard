<?php

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get data from the form
    $task_title = $_POST["task_title"];
    $assign_member = $_POST["Assign_Member"];
    $due_date = $_POST["due_date"];
    $priority = $_POST["priority"];



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Kanban_Board";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if (isset($_SESSION['project_id'])) {
        $stored_project_id = $_SESSION['project_id'];
        
    }


    // Prepare and execute the SQL insert statement
    $sql = "INSERT INTO taskinfo (Project_ID,Task_Title, Assign_Member, Due_Date, Set_Priority, Status)
            VALUES ('$stored_project_id','$task_title', '$assign_member', '$due_date', '$priority','ToDo')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['tasksuccess'] = "Task Created";
        header("Location: TaskCreateForm.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
