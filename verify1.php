<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
            margin-top: 10px;
        }
        .error {
            color: green;
            font-weight: bold;
        }

        /* Add this to your existing CSS */
.alert {
  padding: 20px;
  background-color: GREEN;
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
        <h1>Email Verification</h1>
        <p>Enter your email and verification code:</p>
        <form action="verify2.php" method="GET">
            <div>
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
                if (isset($_SESSION['error'])) {
                echo '<div class="alert">';
                echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
                echo $_SESSION['error'];
                echo '</div>';
                unset($_SESSION['error']); // Clear the error message
                }
            ?>

            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
            </div>
            
            <div>
                <label for="code">Verification Code:</label>
                <input type="text" id="code" name="code" required><br><br>
            </div>
            
            
            <button type="submit">Verify</button>
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