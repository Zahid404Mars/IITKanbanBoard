<?php

        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";    
        $dbname = "Kanban_Board";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['project_id'])) {
          $project_id = $_GET['project_id'];

          $_SESSION['project_id'] = $project_id;
        }

        if (isset($_SESSION['project_id'])) {
          $stored_project_id = $_SESSION['project_id'];
        }

        $sql2 = "SELECT Project_Name FROM CreateProjectInfo WHERE Project_ID = '$stored_project_id'";
        $result = $conn->query($sql2);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    
                    $Project_Name =  $row['Project_Name'];
                    $_SESSION['Project_Name']=$Project_Name;


                }
              }
              $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Task Management</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Linear Gradient Background */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background: linear-gradient(to right,
                    #ff5733,
                    #ffc300,
                    #4caf50);
            /* Customize gradient colors */
            color: black;

        }

        /* Container */
        .container {
            max-width: 1400px;
            margin-left: 50px;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            text-align: center;
            padding: 20px;
            background-color: rgba(255,
                    255,
                    255,
                    0.2);
            /* Semi-transparent header background */
            border-radius: 8px 8px 0 0;
            /* Rounded top corners */
        }

        .header a {
            color: black;
            text-decoration: none;
            margin: 0 20px;
            font-size: 25px;
            transition: transform 0.3s, background-color 0.3s, font-size 0.3s;
            /* Smooth hover effect for transform, background, and font-size */
        }

        .header a:hover {
            transform: scale(2);
            /* Enlarge on hover */
            font-size: 30px;
            /* Larger font size on hover */
        }

        /* Background color and larger size for "List" link */
        .header a.board {
            background-color: skyblue;
            padding: 10px;
            border-radius: 10px;
        }





        /* Button Styles */
        .btn {
            background-color: darkgreen;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            /* Smooth hover effect */
        }

        .btn:hover {
            background-color: maroon;
            color: yellow;
        }



        /* Add this to your existing CSS */
        .alert {
            padding: 20px;
            background-color: green;
            color: white;
            margin-bottom: 15px;
            position: relative;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }

        .shadow-box {
            width: 1200px;
            padding: 20px;
            padding-bottom: 10px;
            margin: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            background-color: #f2f2f2;
            border-radius: 10px;
            /* text-align: center; */
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }

        .shadow-box .icon{
            text-align: center;
        }

        /* Add the hover effect */
        .shadow-box:hover {
            background-color: khaki;  /*#b3e0ff ,khaki,  lawngreen*/
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <header class="header">
    <a href="TaskCreateForm.php" class="list">List</a>
        <a href="TaskBoard.php" class="board">Board</a>
        <a href="Gantt-chart.php" class="gantt">Gantt-Chart</a>
        <a href="Report.php" class="report">Report</a>
    </header>
    <div class="container">
        <div class="main-section">
            <h2>Task Details : <?php echo $Project_Name; ?></h2>

            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Kanban_Board";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }


            if (isset($_SESSION['project_id'])) {
                $stored_project_id = $_SESSION['project_id'];
            }


            if (isset($_GET['project_id'])) {
                $project_id = $_GET['project_id'];
    
                $_SESSION['project_id'] = $project_id;
            }
            
            if (isset($_SESSION['project_id'])) {
                $stored_project_id = $_SESSION['project_id'];
                
            }

            if (isset($_SESSION['rfemail'])) {

                $rfemail = $_SESSION['rfemail'];
            }

            $sql = "SELECT Task_Title, Assign_Member, Due_Date, Set_Priority, Status FROM taskinfo WHERE Project_ID = '$stored_project_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<ol style="align:center;">';
                while ($row = $result->fetch_assoc()) {

                    echo '<div class="shadow-box">';
                    echo '<li>';
                    echo '<strong>Task Title:</strong> ' . $row['Task_Title'] . ' &nbsp;&nbsp;&nbsp;' .
                    '<strong>Assign Member:</strong> ' . $row['Assign_Member'] . ' &nbsp;&nbsp;&nbsp;' .
                    '<strong>Due Date:</strong> ' . $row['Due_Date'] . ' &nbsp;&nbsp;&nbsp;' .
                    '<strong>Set Priority:</strong> ' . $row['Set_Priority'] . ' &nbsp;&nbsp;&nbsp;' .
                    '<strong>Status:</strong> ' . $row['Status'] . '<br>';
                    
                    
                    echo '<div class="icon">';

                       echo '<a href="KanbanBoard_Comments\index.php?project_id=' .$rfemail. '"><i class="fas fa-comment invite-icon" style="color: blue; margin-right: 30px; margin-top:15px" ></i></a>';

                       echo '<a href="file_upload_download\index.php?project_id=' .$stored_project_id. '"><i class="fas fa-cloud-upload-alt invite-icon" style="color: green; margin-right: 30px; margin-top: 15px;"></i></a>';

                       echo '<a href="file_upload_download\download.php?project_id=' .$stored_project_id. '"><i class="fas fa-download invite-icon" style="color: blue; margin-right: 30px; margin-top: 15px;"></i></a>';

                       echo '<i class="fas fa-trash-alt" style="color: red;"></i>'; 
                    
                    echo '</div>';
                    
                echo '</div>';
                }
                echo '</ol>';
            } else {
                echo '<h2 style="color:darkblue;text-align:center;">No tasks found for this project.</h2>';
            }

            $conn->close();
            ?>

            <button type="submit" class="btn" onclick="window.location.href='TaskCreateForm.php'">Create Task</button>
        </div>
    </div>



    <script>
        // Function to close the alert
        function closeAlert() {
            var alert = document.getElementsByClassName("alert")[0];
            alert.style.display = "none";
        }
    </script>
</body>

</html>