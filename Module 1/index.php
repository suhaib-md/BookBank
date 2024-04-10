<html>

<head>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Sign in</title>
</head>

<body>
  <?php
      require('db.php');
      session_start();
      // When form submitted, check and create user session.
      if (isset($_POST['username'])) {
          $username = stripslashes($_REQUEST['username']);    // removes backslashes
          $username = mysqli_real_escape_string($con, $username);
          $password = stripslashes($_REQUEST['password']);
          $password = mysqli_real_escape_string($con, $password);
          // Check if the user is an admin
        $query_admin = "SELECT * FROM `values` WHERE UserName='$username' AND Password='$password' AND role='admin'";
        $result_admin = mysqli_query($con, $query_admin) or die("Unable to connect");

        // Check if the user is a regular user
        $query_user = "SELECT * FROM `values` WHERE UserName='$username' AND Password='$password' AND role='user'";
        $result_user = mysqli_query($con, $query_user) or die("Unable to connect");

        if (mysqli_num_rows($result_admin) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['role'] = 'admin';
          // Redirect admin to admin dashboard
          header("Location: ../Module 3/admin_dashboard.html");
      } elseif (mysqli_num_rows($result_user) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['role'] = 'user';
          // Redirect regular user to user dashboard
          header("Location: ../Module 3/dashboard1.html");
      } else {
              echo "<div class='error-msg'>
                    <h3 style='text-align:center;'>Incorrect Username/password.</h3><br/>
                    <p class='link'>Click here to <a href='index.php' style='text-decoration:none;'>Login</a> again.</p>
                    </div>";
          }
      } else {
    ?>
  <div class="main">
    <p class="sign" align="center">Login</p>
    <form class="form1" action="" method="post">
      <input class="un " type="text" name="username" placeholder="Username" required></input>
      <input class="pass" type="password" name="password" placeholder="Password" required></input>
      <button class="submit" align="center"  type="submit">Sign in</button>
      <p class="Register" align="center">Not a user? <a class="Register" href="../Module 2/registration.php"><b>Register now.</b></p>
    </div>
    <?php
        }
    ?>
</body>
</html>
