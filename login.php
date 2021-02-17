<?php
ob_start();
session_start();

//Message displayed to user
$msg = '';
require_once("file_functions.php");
$users = readArrayFromJSON("users.json");

//Handle form submission
if (
  isset($_POST['login']) && !empty($_POST['username'])
  && !empty($_POST['password'])
){
  $login_suceeded = false;
  for ($i = 0; $i < sizeOf($users); $i++){
    if (
      $users[$i]["username"] == $_POST['username'] &&
      password_verify($_POST['password'], $users[$i]["password_hash"])
    ){
      $_SESSION['valid'] = true;
      $_SESSION['timeout'] = time();
      $_SESSION['username'] = $users[$i]["username"];
      $_SESSION['real_name'] = $users[$i]["real_name"];
      $_SESSION['access'] = $users[$i]["access"];
      $login_suceeded = true;
      header("Location: admin.php");
      exit();
    } else {
      $msg = 'Wrong username or password';
    }
  }
} else {
  $msg = 'Please enter a username and/or password';
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

  <title>Login</title>

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
    if (!empty($msg)){
    echo
    "<div class=\"row\">
      <div class=\"col-sm-8 mx-auto\">
        <div class=\"alert alert-primary w-100 text-center\" role=\"alert\"> $msg </div>
      </div>
    </div>";
    };
    ?>
    <div class="text-center">
      <form class="form-signin" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
                                                    ?>" method="post">
        <img class="mb-4" src="images/emblem.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="username" class="sr-only">Email address</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Email address" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <!--<div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>-->
        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; Fairfield FFA 2020</p>
      </form>
    </div>
  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <!--<script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->


<!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["setCookieDomain", "*.fairfieldffa.org"]);
  _paq.push(["setDomains", ["*.fairfieldffa.org"]]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//jforseth.tech/matomo/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '2']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->


</body>

</html>
