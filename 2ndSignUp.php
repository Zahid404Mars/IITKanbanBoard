<!DOCTYPE html>
<html>
<head>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
    body {
      background: linear-gradient(to right, green, blue, maroon);
      font-family: 'Roboto', sans-serif;
    }
    h1 {
      text-align: center;
      color: white;
      font-size: 36px;
      margin-top: 50px;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 10px;
    }
    .form-group label {
      color: #0083b0;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .form-group input {
      padding: 10px;
      border: 1px solid #0083b0;
      border-radius: 5px;
      outline: none;
    }
    .button {
      padding: 15px;
      border: none;
      border-radius: 5px;
      color: white;
      background-color: darkblue;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .button:hover {
      background-color: maroon;
    }
    .link-container {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin-top: 10px;
    }
    .link {
      color: maroon;
      text-decoration: none;
      transition: color 0.3s;
      margin-right: 10px;
    }
    .link:hover {
      color: green;
    }
    .login-button {
      padding: 5px 10px;
      border-radius: 5px;
      background-color: maroon;
      font-size: 14px;
      text-decoration: none;
      transition: background-color 0.3s;
    }
    .login-button:hover {
      background-color: darkorchid;
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
    
    @media (max-width: 600px) {
      .container {
        width: 90%;
        margin-top: 20px;
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <h1>IIT Kanban Board</h1>
  <div class="container">
      <?php
        session_start();
        if (isset($_SESSION['error'])) {
        echo '<div class="alert">';
        echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
        echo $_SESSION['error'];
        echo '</div>';
        unset($_SESSION['error']); // Clear the error message
        }
        ?>

    <form action="page2.php" method="post">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required placeholder="Enter the valid email format">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" required>
      </div>
      <button class="button" type="submit">Create Account</button>
    </form>
    
    <div class="link-container">
      <a class="link" href="3rdLogin.php">Already Have an Account?</a>
      <p class="login-button"><a href="3rdLogin.php" style="text-decoration: none; color: yellow;">Sign In</a></p>
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
