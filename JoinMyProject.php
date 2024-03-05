<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $joinID = $_POST["join_id"];
    $verificationID = $_POST["verificationID"];

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


    $sql = "SELECT Project_Name, Supervisor_Name, Project_Description, Project_Creator_Eail FROM CreateProjectInfo WHERE Project_ID = '$joinID' AND VerificationID='$verificationID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // echo '<a style="text-decoration:none; color:black;" href="TaskBoard.php?project_id=' . $joinID . '">';

            // echo '<div class="shadow-box">';
            // echo '<h2 style="color:Green">' . $row['Project_Name'] . '</h2>';
            // echo '<p><strong>Supervisor:</strong> ' . $row['Supervisor_Name'] . '</p>';
            // echo '<p><strong>Description:</strong> ' . $row['Project_Description'] . '</p>';
            // echo '<p><strong>SuperVisor Email:</strong> ' . $row['Project_Creator_Eail'] . '</p>';

            // echo '<i class="fas fa-trash-alt" style="color: red;"></i>';
            // echo '</div>';


            $sql1 = "INSERT INTO userjoininfo (User_Email,Join_ID, Project_Name, Project_Description, Supervisor_Name, Supervisor_Email) 
            VALUES ('$rfemail','$joinID','$row[Project_Name]','$row[Project_Description]', '$row[Supervisor_Name]', '$row[Project_Creator_Eail]')";

            if ($conn->query($sql1) === TRUE) {
                header("Location: JoinMyProject.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    } else {
        echo '<h1 style="text-align:center; color:green;margin-left:40px">There is no project. Check your join ID.</h1>';
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Project</title>
    <style>
        /* Linear Gradient Background */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background: linear-gradient(to right, #FF5733, #FFC300, #4CAF50);
            /* Customize gradient colors */
            color: black;
        }

        /* Center the form */
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }


            *{
            box-sizing: border-box;
            font-family: 'Nunito', sans-serif;
        }

        /* body {
            margin: 0px;
            background-color: aliceblue;
        } */

        /* Input Field Styles */
        input[type="number"],
        input[type="text"] {
            width: 100%;
            font-size: 18px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        /* Submit Button Styles */
        input[type="submit"] {
            background-color: maroon;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            /* Smooth hover effect */
        }

        input[type="submit"]:hover {
            background-color: green;
        }

        .shadow-box {
            width: 350px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            background-color: #f2f2f2;
            /* text-align: center; */
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }

        .shadow-box:hover {
            background-color: #b3e0ff;
            transform: scale(1.05);
        }


        /* Project List */
        .main .project_list .h2 {
            font-size: 20px;
            line-height: 0;
        }

        .main .project_list .p {
            color: #727272;
        }

        @media only screen and (min-width: 768px) {


            section.main .project_list {
                display: flex;
                flex-wrap: wrap;
                /* justify-content: space-between; */
            }
        }

        @media only screen and (min-width: 1024px) {

            section.main {
                width: 100%;
                /* margin-left: 20px;
                margin-right: 20px;  */
            }

        }

        @media only screen and (min-width: 1111px) {

            section.main {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Join Project</h2>
        <form action="JoinMyProject.php" method="POST">
            <input type="number" name="join_id" placeholder="Enter Join ID" required>
            <input type="text" name="verificationID" placeholder="Enter Verification ID" required>
            <input type="submit" value="Join">
        </form>
    </div>
    <h1 style="color:darkblue; text-align:center; font-size:50px;">YOU ARE IN PROJECT</h1>

    <section class="main" style="margin-left:50px;">
        <div class="project_list"> <!-- main section-->
            <?php

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


            $sql2 = "SELECT Join_ID, Project_Name,  Project_Description, Supervisor_Name, Supervisor_Email FROM userjoininfo WHERE User_Email = '$rfemail'";
            $result1 = $conn->query($sql2);


            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {

                    echo '<a style="text-decoration:none; color:black;" href="TaskBoard.php?project_id=' . $row['Join_ID'] . '">';

                    echo '<div class="shadow-box">';
                    echo '<h2 style="color:Green">' . $row['Project_Name'] . '</h2>';

                    echo '<p><strong>Description:</strong> ' . $row['Project_Description'] . '</p>';

                    echo '<p><strong>Supervisor:</strong> ' . $row['Supervisor_Name'] . '</p>';

                    echo '<p><strong>SuperVisor Email:</strong> ' . $row['Supervisor_Email'] . '</p>';

                    echo '<i class="fas fa-trash-alt" style="color: red;"></i>';
                    echo '</div>';
                }
            } else {
                echo '<h1 style="text-align:center; color:green;margin-left:40px">There is no project. Check your join ID.</h1>';
            }
            $conn->close();
            ?>

        </div>
    </section>


    <div> <!-- footer section-->

    </div>


</body>

</html>