<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member</title>
    <style>
        body {
            background: linear-gradient(to right, #ff6b6b, #ff7e75, #ff8e7f);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #ff6b6b;
        }

        .icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .email-input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-bottom: 2px solid #ff6b6b;
            outline: none;
            font-size: 18px;
        }

        .invite-button {
            background-color: #ff6b6b;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .invite-button:hover {
            background-color: #ff7e75;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
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
    </style>

</head>
<body>
    
    <div class="container">
        <form action="InvitationTable.php" method="post">
        <h1><i class="icon">📧</i> Invite Members</h1>
        <?php
                session_start();
                if (isset($_SESSION['success'])) {
                echo '<div class="alert">';
                echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
                echo $_SESSION['success'];
                echo '</div>';
                unset($_SESSION['success']); // Clear the error message
                }
        ?>

        <?php
                if (isset($_SESSION['successconnection'])) {
                echo '<div class="alert">';
                echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
                echo $_SESSION['successconnection'];
                echo '</div>';
                unset($_SESSION['successconnection']); // Clear the error message
                }

                
                if (isset($_GET['project_id'])) {
                    $project_id = $_GET['project_id'];

                    $_SESSION['projectID']=$project_id;
                    
                } else {
                    
                }


        ?>
        <p>Enter the email addresses of the members you want to invite:</p>
        <input  id="invitemail" type="email" class="email-input" name="email" placeholder="Email Address" required>
        <br>
        <button type="submit" class="invite-button">Invite</button>
        
        </form>
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
