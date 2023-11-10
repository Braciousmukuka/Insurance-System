<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Panel</title>
  <!-- Add Bootstrap CSS link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Add your custom styles here -->
  <style>
    body {
      background: url('bg.jpg') no-repeat center center fixed; 
      background-size: cover; /* Ensure the background image covers the entire screen */
      background-color: #f8f9fa; /* Fallback color if the image is not available */
    }
    .login-page {
      max-width: 600px; /* Increased max-width for a wider form */
      margin: auto;
      margin-top: 100px; /* Adjust as needed */
      background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background for better visibility */
      padding: 40px; /* Increased padding for a larger form */
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px #000000;
    }
    .login-page h1 {
      font-size: 2.5em; /* Larger font size for the h1 element */
      color: #28a745; /* Green color */
    }
    .login-page h4 {
      font-size: 1.5em; /* Larger font size for the h4 element */
      color: #495057;
    }
    .form-group {
      margin-bottom: 30px; /* Increased margin for form elements */
    }
    .form-control {
      font-size: 1.2em; /* Larger font size for the form control elements */
    }
    .btn-login {
      background-color: #28a745; /* Green color */
      color: #fff;
      border-radius: 0%;
      font-size: 1.2em; /* Larger font size for the button */
    }
    .btn-login:hover {
      background-color: #218838; /* Darker green on hover */
    }
  </style>
</head>
<body>
  <div class="login-page">
    <div class="text-center">
       <h1>Login Panel</h1>
       <h4>Online Insurance Agency Management System</h4>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="auth_v2.php" class="clearfix">
      <div class="form-group">
        <label for="username" class="control-label">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username" required>
      </div>
      <div class="form-group">
        <label for="Password" class="control-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-login btn-block">Login</button>
      </div>
    </form>
  </div>

  <!-- Add Bootstrap JS and Popper.js scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include_once('layouts/footer.php'); ?>
