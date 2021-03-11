<?php
require_once("alert.php");
require_once("file_functions.php");

if (isset($_GET['username']) && isset($_GET['token'])){
    $username = $_GET['username'];
    $token = $_GET['token'];
}

if (isset($_POST["resetPassword"])){
    $username = $_POST["username"];
    $token = $_POST["token"];
    $password = $_POST["password"];
    $resetArray = readArrayFromJSON("reset_tokens.json");

    for ($i = 0; $i < sizeof($resetArray); $i++){
        if ($resetArray[$i]['token'] == $token){
            $currentResetItem = $resetArray[$i];
            deleteRowJSON($i,"reset_tokens.json");
        }
    }
    if (
        $currentResetItem['username'] == $username &&
        $currentResetItem['token'] == $token
    ){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $users = readArrayFromJSON("users.json");
        for ($i = 0; $i < sizeof($users); $i++){
            if ($users[$i]['username'] == $username){
                $users[$i]['password_hash'] = $hashed_password;
                updateRowJSON($i, $users[$i], "users.json");
                echoToAlert("Password reset successfully");
                break;
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
  <style>
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website for the Fairfield FFA Chapter.">
  <meta name="author" content="Justin Forseth">

  <title>Reset Password</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">
  <link href="css/gallery.css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">

</head>

<body>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <div class="container">
    <?php
    /*
    If there's a message for the user,
    "Wrong username/password", etc.
    display it here.
    */
    if (!empty($msg)) {

    ?>
      <div class="row">
        <div class="col-sm-8 mx-auto">
          <div class="alert alert-primary w-100 text-center" role="alert"><?php echo $msg; ?></div>
        </div>
      </div>
    <?php
    };
    ?>
    <div class="text-center">
      <form class="form-signin" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
                                                    ?>" method="post">
        <img class="mb-4" src="images/emblem.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Reset Password</h1>
        <label for="password" class="sr-only">New Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required autofocus>
        <input hidden name="username" value="<?php echo $username;?>" />
        <input hidden name="token" value="<?php echo $token;?>" />
        <button class="btn btn-lg btn-primary btn-block" name="resetPassword" type="submit">Submit</button>
        <p class="mt-5 mb-3 text-muted">&copy; Fairfield FFA 2020</p>
      </form>
    </div>
  </div>
  
</body>

</html>