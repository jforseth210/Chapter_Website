<?php
   error_reporting(E_ALL);
   ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!--Don't worry about any of this...-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website for the Fairfield FFA Chapter.">
  <meta name="author" content="Justin Forseth">
  <!--The title at the top of the tab.-->
  <title>Fairfield FFA</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">
  <link href="css/gallery.css" rel="stylesheet">
  <!--Swiper CSS for photo gallery-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/css/swiper.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/emblem_favicon.png" type="image/x-icon">
  <!--Cookie Notice-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">
  <style>
    .youtube-player {
        position: relative;
        padding-bottom: 56.23%;
        height: 0;
        overflow: hidden;
        max-width: 100%;
        background: #000;
        margin: 5px;
    }

    .youtube-player iframe,
    .youtube-player object,
    .youtube-player embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 100;
        background: transparent;
    }

    .youtube-player img {
        bottom: 0;
        display: block;
        left: 0;
        margin: auto;
        max-width: 100%;
        width: 100%;
        position: absolute;
        right: 0;
        top: 0;
        border: none;
        height: auto;
        cursor: pointer;
        -webkit-transition: .4s all;
        -moz-transition: .4s all;
        transition: .4s all;
    }

    .youtube-player img:hover {
        -webkit-filter: brightness(75%);
    }

    .youtube-player .play {
        height: 72px;
        width: 72px;
        left: 50%;
        top: 50%;
        margin-left: -36px;
        margin-top: -36px;
        position: absolute;
        background: url("//i.imgur.com/TxzC70f.png") no-repeat;
        cursor: pointer;
    }
.wrapper {
    min-height: calc(100vh - 50px);
}
footer {
    height: 50px;
}
</style>
</head>

<body id="page-top">

  <!-- Links and stuff at the top of the page -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-ffablue fixed-top" id="mainNav">
    <div class="container">
      <img src="images/emblem.png" class="mx-1" style="height:32px"></img>
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Fairfield FFA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        </ul>
      </div>
    </div>
  </nav>

  <header class="wrapper bg-ffablue text-white">
    <div class="container text-center">
      <h1>UNDER CONSTRUCTION</h1>
        <p class="lead">We're working hard on getting FairfieldFFA.org up and running, but we're not quite ready yet.</p>
    </div>
  </header>
<!--   <br /> -->
  <!-- Footer -->
  <footer class="py-5 bg-ffablue">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Fairfield FFA 2020.</p>
      <p class="m-0 text-center text-white">Template by startbootstrap.com.</p>
      <p class="m-0 text-center text-white">Designed by Justin Forseth.</p>
      <p class="m-0 text-center text-white"><a href="admin_console.php">Login</a> to access admin page.</p>
    </div>
    <!-- /.container -->
  </footer>
    <!-- START Bootstrap-Cookie-Alert -->
    <div class="alert bg-ffablue text-center cookiealert" role="alert">
        This site uses cookies. By continuing to use this site, we assume you're okay with that. For enhanced privacy, you are encouraged to block third-party cookies. <a href="https://cookiesandyou.com/" target="_blank">Learn More</a>

        <button type="button" class="btn btn-primary btn-sm acceptcookies">
            I agree
        </button>
    </div>
    <!-- END Bootstrap-Cookie-Alert -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>
  <script src="js/gallery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.min.js"></script>
  <!--Cookie notice-->
  <script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script>
  

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


  <script>
    /* Light YouTube Embeds by @labnol */

    /* Web: http://labnol.org/?p=27941 */

    document.addEventListener("DOMContentLoaded",
        function() {
            var div, n,
                v = document.getElementsByClassName("youtube-player");
            for (n = 0; n < v.length; n++) {
                div = document.createElement("div");
                div.setAttribute("data-id", v[n].dataset.id);
                div.innerHTML = labnolThumb(v[n].dataset.id);
                div.onclick = labnolIframe;
                v[n].appendChild(div);
            }
        });

    function labnolThumb(id) {
        var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg">',
            play = '<div class="play"></div>';
        return thumb.replace("ID", id) + play;
    }

    function labnolIframe() {
        var iframe = document.createElement("iframe");
        iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.id + "?autoplay=1");
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("allowfullscreen", "1");
        this.parentNode.replaceChild(iframe, this);
    }

</script>
</body>

</html>
