
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Form</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Add a link to FontAwesome CSS if you plan to use icons -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> -->

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ff8a00, #ff0080);
            margin: 0;
            padding: 0;
            text-align: center;
            color: black;
        }

        header {
            color: whitesmoke;
            padding: 5px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }

        header:hover {
            background: linear-gradient(135deg, #ff0080, #ff8a00);
        }

        main {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
        }

        form {
            background-color: yellowgreen;
            border: 2px solid blue;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 15px;
            margin-top: 5px
        }

        label {
            font-weight: bold;
        }

        #project-type {
            width: 104%;
        }

        input[type="number"],
        input[type="text"],
        select,
        input[type="email"] {
            width: 90%;
            padding: 10px;
            border: 2px solid;
            border-radius: 5px;
            /* Increased border radius for a rounded look */
            font-size: 18px;
            /* Increased font size for better readability */
            background-color: #f5f5f5;
            /* Light gray background color */
            color: #333;
            /* Dark text color */
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="number"]:focus,
        input[type="text"]:focus,
        select:focus,
        input[type="email"]:focus {
            border-color: #007BFF;
            /* Change border color on focus */
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Add a subtle box shadow on focus */
        }

        button {
            background-color: darkblue;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 7px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #800000;
        }

        footer {
            text-align: center;
            background: linear-gradient(135deg, #ff8a00, #ff0080);
            color: #fff;
            padding: 10px 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }

        footer:hover {
            background: linear-gradient(135deg, #ff0080, #ff8a00);
        }


        /* Add this to your existing CSS */
        .alert {
            padding: 20px;
            background-color: red;
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
    </style>

</head>

<body>
    <header>
        <h1>Create New Project</h1>
    </header>
    <main>
        <form id="project-form" action="createProjectAction.php" method="post">
            <div class="form-group">
                <?php
                
                        if (isset($_SESSION['projectidbooked'])) {
                            echo '<div class="alert">';
                            echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
                            echo $_SESSION['projectidbooked'];
                            echo '</div>';
                            unset($_SESSION['projectidbooked']); // Clear the error message
                        }
                        ?> 
                <label for="project-Id">Project ID</label>
                <input type="number" id="project-Id" name="project-Id" required>
            </div>
            <div class="form-group">
                <label for="project-name">Project Name</label>
                <input type="text" id="project-name" name="project-name" required>
            </div>
            <div class="form-group">
                <label for="supervisor-name">Supervisor Name</label>
                <input type="text" id="supervisor-name" name="supervisor-name" required>
            </div>
            <div class="form-group">
                <label for="project-description">Project Description</label>
                <input type="text" id="project-description" name="project-description" required>
            </div>
            <div class="form-group">
                <label for="project-creator-mail">Supervisor Email</label>
                <input type="email" id="project-creator-mail" name="project-creator-mail" required>
            </div>
            <button type="submit">Create Project</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2023 IIT Kanban Board</p>
    </footer>


    <script>
        // Function to close the alert
        function closeAlert() {
            var alert = document.getElementsByClassName("alert")[0];
            alert.style.display = "none";
        }
    </script>
</body>

</html>