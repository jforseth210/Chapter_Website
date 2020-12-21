<?php
ob_start();
session_start();
?>

<?
   //error_reporting(E_ALL);
   //ini_set("display_errors", 1);
?>


<!doctype html>
<html lang="en">

<head>
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: -webkit-box;
      display: flex;
      -ms-flex-align: center;
      -ms-flex-pack: center;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }

    .form-signin .checkbox {
      font-weight: 400;
    }

    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }

    .form-signin .form-control:focus {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;

      .alert-fixed {
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        z-index: 9999;
        border-radius: 0px
      }
    }
  </style>
  <!--Don't worry about any of this...-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website for the Fairfield FFA Chapter.">
  <meta name="author" content="Justin Forseth">
  <!--The title at the top of the tab.-->
  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">
  <link href="css/gallery.css" rel="stylesheet">
  <!--Swiper CSS for photo gallery-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/css/swiper.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/emblem_favicon.png" type="image/x-icon">
</head>

<body>
  <?php
  $msg = '';
  if (
    isset($_POST['login']) && !empty($_POST['inputEmail'])
    && !empty($_POST['inputPassword'])
  ) {

    if (
      $_POST['inputEmail'] == 'park@fairfieldffa.org' &&
      $_POST['inputPassword'] == 'parkparkparkpark'
    ) {
      $_SESSION['valid'] = true;
      $_SESSION['timeout'] = time();
      $_SESSION['username'] = 'park';
      $msg = "Logged in!";
      
      header("Location: https://fairfieldffa.org/admin.php");
      exit();
    } else {
      $msg = 'Wrong username or password';
    }
  } else {
  }
  ?>
  <div class="container">
    <?php
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
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
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
