<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban_Board</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="assets/css/icons.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>

    <style>

        .shadow-box {
            width: 270px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            background-color: #f2f2f2;
            text-align: center;
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }

        .shadow-box:hover {
            background-color: #b3e0ff;
            transform: scale(1.05);
        }

        .invite-icon {
            color: green;
            margin-right: 10px;
        }

        .delete-icon {
            color: red;
        }

        .invite-icon,
        .delete-icon {
            cursor: pointer;
        }


        .btn {
            background-color: darkgreen;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;

        }

        .btn:hover {
            background-color: maroon;
            color: yellow;
        }
    </style>



</head>

<body>
    <div class="dashboard">
        <section class="navigation">
            <img src="assets/img/download.jpeg" alt="IIT Kanban_Board" class="logo">
            <div>
                <span style="text-decoration:none; color:darkblue;margin-top:20px;" href="#" class="material-icons-outlined"  title="HOME"> dashboard </span>

                <span style="text-decoration:none; color:maroon;margin-top:20px;" href="#" class="material-icons-outlined"  title="GANTT-CHART"> trending_up </span>
                
                
                <a href="invite_member.php" style="text-decoration:none; color:darkblue;margin-top:20px;" href="#" class="material-icons-outlined"  title="INVITE MEMBER"> people_alt </a>
                

                <span style="text-decoration:none; color:orange;margin-top:20px;" href="#" class="material-icons-outlined"  title="NOTE"> insert_invitation </span>

                <span style="text-decoration:none; color:#5A5A5A;margin-top:20px;" href="#"  class="material-icons-outlined"  title="SETTINGS">settings_suggest</span>

                <a style="text-decoration: none; color: green; margin-top: 20px;" href="JoinMyProject.php" class="material-icons-outlined" title="Join Your Project">group_add</a>

            </div>

        </section>


        <section class="main">
            <div class="search">
                <form action="">
                    <input type="text" name="search" id="searchProject" placeholder="Search Here">
                    <span class="material-icons-outlined"> search </span>
                </form>

                <div class="notification">
                    <span class="material-icons-outlined"> notifications </span>
                    <span class="material-icons-outlined"> edit </span>
                </div>
            </div>

            <div class="title">
            <h1 id="typewriter" style="color:darkblue; text-align:center; font-size:40px; margin-top:-50px; margin-left:90px;"></h1>
                <h1>My Project</h1>   

                <label for="projects">Sort By</label>
                <select name="projects" id="projectFilter">
                    <option value="">...</option>
                    <option value="recent">Recent Project</option>
                    <option value="finished">Finished Project</option>
                    <option value="ongoing">Ongoing Project</option>
                    <option value="stalled">Stalled Project</option>
                </select>

            </div>

            <div class="button">
                <button class="btn" onclick="window.location.href='CreateProjectForm.php'"> Create Project</button>
            </div>
            <br>

            <div class="project_list">

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

                $sql = "SELECT Project_ID, Project_Name, Supervisor_Name, Project_Description, Project_Creator_Eail FROM CreateProjectInfo WHERE User_Email = '$rfemail' ORDER BY Project_ID DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    
                        echo '<a style="text-decoration:none; color:black;" href="TaskCreateForm.php?project_id=' . $row['Project_ID'] . '">';
                        echo '<div class="shadow-box">';
                        echo '<h2 style="color:Green">' . $row['Project_Name'] . '</h2>';
                        echo '<p><strong>Project ID:</strong> ' . $row['Project_ID'] . '</p>';
                        echo '<p><strong>Supervisor:</strong> ' . $row['Supervisor_Name'] . '</p>';
                        echo '<p><strong>Description:</strong> ' . $row['Project_Description'] . '</p>';
                        echo '<p><strong>Creator Email:</strong> ' . $row['Project_Creator_Eail'] . '</p>';


                        echo '<a href="AddMemberForm.php?project_id=' . $row['Project_ID'] . '"><i class="fas fa-user-plus invite-icon" style="color:green; margin-right:30px;"></i></a>';


                        echo '<i class="fas fa-trash-alt" style="color: red;"></i>';
                        echo '</div>';
                    }
                } else {
                    echo '<h1 style="text-align:center; color:green;margin-left:40px">Create your first Project</h1>';
                }

                $conn->close();
                ?>
            </div>
        </section>



        <section class="secondary">
            <div class="chart">
                <h2>Total Project</h2>
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </section>

    </div>

    <script>
    const text = "Welcome To IIT Kanban Board";
    const speed = 100;

    let index = 0;
    const typewriter = document.getElementById("typewriter");

    function type() {
        if (index < text.length) {
            typewriter.innerHTML += text.charAt(index);
            index++;
            setTimeout(type, speed);
        } else {
            // Clear the text and start typing again
            setTimeout(function () {
                typewriter.innerHTML = "";
                index = 0;
                type();
            }, 2000); // Adjust the delay (in milliseconds) before starting again
        }
    }

    window.onload = type();
</script>


    <script src="assets/js/script.js"> </script>

</body>

</html>