<?php
ob_start();
session_start();

//Message displayed to user
$msg = '';
require_once("file_functions.php");
require_once("alert.php");
$users = readArrayFromJSON("users.json");

//Handle form submission
if (
  isset($_POST['login']) && !empty($_POST['username'])
) {
  $username = $_POST['username'];
  $token = getRandomString(16);
  $resetArray = array(
    "username" => $username,
    "token" => $token
  );
  addNewRowJSON($resetArray, "reset_tokens.json");

  $link = "https://fairfieldffa.org/resetpassword.php?username=$username&token=$token";
  echoToAlert($link);
  mail("jforseth210@gmail.com", "Fairfield FFA Password Reset", "Here's the link to reset your Fairfield FFA password:\n$link");
}
//https://www.w3docs.com/snippets/php/how-to-generate-a-random-string-with-php.html
function getRandomString($n) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < $n; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $randomString .= $characters[$index];
  }

  return $randomString;
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
        <label for="username" class="sr-only">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Send Reset Link</button>
        <p class="mt-5 mb-3 text-muted">&copy; Fairfield FFA 2020</p>
      </form>
    </div>
  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  
</body>

</html>