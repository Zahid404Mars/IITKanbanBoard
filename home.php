<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Massier</title>
  <link rel="stylesheet" href="assets\css\homepage.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>


  <style>
    /* Style for the dropdown button */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    background-color: maroon;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 10px;
}
.dropbtn:hover{
    background-color: darkgreen;
}

/* Style for the dropdown content */
.dropdown-content {
    display: none;
    position: absolute;
    min-width: 160px;
    z-index: 1;
    margin-left:10px;
}

/* Style for dropdown links */
.dropdown-content a {
    margin-top: 1px;
    padding: 5px;
    text-decoration: none;
    display: block;
    color: black;
    border-radius: 5px;
    box-shadow: 0px 8px 16px 0px rgba(87, 82, 82, 0.2);
    border-color: gray;
}

/* Change color of links on hover */
.dropdown-content a:hover {
    color:darkblue;
    background-color:aquamarine;
}

/* Show the dropdown content when the button is hovered */
.dropdown:hover .dropdown-content {
    display: block;
}


.shadow-box {
            width: 270px;
            padding: 20px;
            margin-left: 0px; 
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

/* Responsive design */
@media screen and (max-width: 768px) {
    .dropdown-content {
        min-width: 100%;
    }
}

  </style>
</head>
<body>

   <input type="checkbox" id="menu-toggle"> 
    <div class="sidebar">
        <div class="side-header">
            <h3><img src="assets\img\raju.png" height="35px" width="35px"><span>Kanban Board</span></h3>
        </div>
        
        <div class="side-content">
            <div class="profile">
            <div class="profile-img bg-img" style="background-image: url('assets\\img\\download.jpg'); background-position: top;"></div>
                <h4>IIT</h4>
              
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="" class="active">
                            <span class="las la-home"></span>
                            <small>Home Page</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                            <span class="las la-users"></span>
                            <small>Mess</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                            <span class="las la-user-alt"></span>
                            <small>Members</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                            <span class="las la-clipboard-list"></span>
                            <small>Report</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                
                            <span class="las la-sliders-h"></span>
                            <small>Settings</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                            <span class="las la-sign-out-alt"></span>
                            <small>Signout</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        
        <header style="background-color:bisque;">
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                
                <div class="header-menu">
                   

                    <div class="notify-icon">
                        <span class="las la-clipboard-check"></span>
                        <span class="notify">1</span>
                    </div>

                    <div class="notify-icon">
                        <span class="las la-envelope"></span>
                        <span class="notify">4</span>
                    </div>
                    
                    <div class="notify-icon">
                        <span class="las la-bell"></span>
                        <span class="notify">3</span>
                    </div>
                    
                    <div class="user">
                        <div class="bg-img" style="background-image: url()"></div>
                    </div>
                </div>
            </div>

        <div class="page-header">
            <h2>Hi, Username,   <h1 id="typewriter" style="color:white; font-size:35px; margin-left:250px; "></h1></h2>
        </div>
        
        <div style="margin-top:1px; margin-left:3px;" class="dropdown">
            <button class="dropbtn">Create Project</button>
                <div class="dropdown-content">
                    <a href="#">As Supervisor</a>
                    <a href="#">As Member</a>
                </div>
        </div>

        </header>

        
        <main>
            <div class="page-content">  

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
            
        </main>
        <div id="extra-section" style="background-color:aquamarine">
            <section class="secondary">
                <div class="chart">
                    <h2 style="text-align:center">Total Project</h2>
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </section>     
        </div>

        
    </div>


    <script>
        // JavaScript to close the dropdown when clicking outside of it
window.addEventListener("click", function(event) {
    var dropdowns = document.querySelectorAll(".dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
        var dropdown = dropdowns[i];
        if (dropdown.classList.contains('show') && !event.target.closest('.dropdown')) {
            dropdown.classList.remove('show');
        }
    }
});

    </script>

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