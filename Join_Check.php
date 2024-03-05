<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user inputs from the form
    $rfemail = $_POST["reference-email"];
    $to = $_POST["invited-email"];
    $referenceCode = $_POST["reference-code"];

    $servername = "localhost";
    $username = "root";
    $password = "";    
    $dbname = "Kanban_Board";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to check for a match
    $sql = "SELECT * FROM joinTable WHERE Admin_Email = '$rfemail' AND Invited_Email = '$to' AND ReferenceCode = '$referenceCode'";
    $result = $conn->query($sql);

    // Check if there is a match
    if ($result->num_rows > 0) {
        // Match found, redirect to another page
        header("Location: board\board.html");
        exit;
    } else {
        // No match found, you can handle this case, e.g., display an error message
        echo "No matching records found.";
    }

    // Close the database connection
    $conn->close();
}
?>
