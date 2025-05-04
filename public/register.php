<?php
// File: public/register.php
session_start();

// Check if user is already logged in
// if (isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>DAMS - Register</title>
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <img src="../images/logo.svg" alt="logo">
              </div>
              <h4 class="text-center">Document Archive Management System</h4>
              <h6 class="font-weight-light text-center mb-4">Create a new account</h6>
              
              <?php
              // Display error message if any
              if (isset($_SESSION['error'])) {
                  echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['error']) . '</div>';
                  unset($_SESSION['error']);
              }
              ?>
              
              <form class="pt-3" action="process-register.php" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="firstName" name="firstName" placeholder="First Name" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="lastName" name="lastName" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
                  <small class="form-text text-muted">Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.</small>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" name="agreeTerms" required>
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.php" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
</body>
</html>