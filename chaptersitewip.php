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
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#resources">Resources</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#shared-files">Shared Files</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#officers">Officers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#videos">Videos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#photos">Photos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#calendar">Calendar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://fairfield.k12.mt.us">School Website</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-ffablue text-white">
    <div class="container text-center">
      <h1>Fairfield FFA</h1>
      <!--
        <p class="lead">We've got a lot of squirrels on the treadmill!</p>
        This was a Bedordism. We briefly entertained the idea of putting it 
        on the site, but decided against it, for obivous reasons. 
      -->
    </div>
  </header>

  <section id="about">
    <!--
      To update the about section:
      Simply modify the text below. 
      <p> represents paragraph. 
        <br/> represents line break. 

      To update the photo gallery, 
      use "Gallery Slide Generator"
      in maintainer tools. 
      -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>About Fairfield FFA</h2>
          <div class=container-fluid>
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
              <div class="carousel-inner" style="max-height: 60vh !important; max-width: 100vw; width:100">
                <!--Paste "Code for About Us Image Gallery"-->
                <div class="carousel-item active">
                  <img class="mx-auto d-block w-100" src="images/chapter_photos/20190403_141609(0).jpg"
                    style="max-height: 60vh !important;" alt="First slide">
                </div>
                <div class="carousel-item"> 
                  <img class="mx-auto d-block" src="images\chapter_photos\IMG_2410.JPG"
                    style="max-height: 60vh !important;" alt="First slide"> 
                </div>
                <div class="carousel-item">
                  <img class="mx-auto d-block" src="images/chapter_photos/IMG_20190910_131815992_HDR.jpg"
                    style="max-height: 60vh !important;" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="mx-auto d-block" src="images/chapter_photos/20200729_135041.jpg"
                    style="max-height: 60vh !important;" alt="Third slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <p class="lead">
                    <?php
                    $aboutFile = fopen("aboutUsText.txt","r");
                    $aboutUsText = fread($aboutFile,filesize("aboutUsText.txt"));
                    fclose($aboutFile);
                    $aboutUsText = str_replace("\n", "<br/>", $aboutUsText);
                    echo $aboutUsText;
                    ?>
            </p>
          </div>
        </div>
      </div>
  </section>

  <section id="resources" class="bg-ffablue">
    <!--
      How to update resources:
      1: Go to maintainer tools
      2: Go to the resource card creator
          A: Title: The name of the resource.
          B: Image URL: The URL of the image itself.
          C: Alt-text: The alt text is displayed if the image doesn't load correctly.
          It's also used by blind people and text to speech software.
          D: Body-Text: A quick summary of what the resource is, and what it's used for. 
          E: Link: The URL to the resource.
      3. Click "Generate"
      4. Copy/Paste the output underneath "<div class="row">"
    -->
    <div class="container">
      <div class="row">
        <div class="mx-auto">
          <h2 class="text-light">Student Resources</h2>
          <div class="container my-5">
            <div class="row">
              <!--Paste resource code here!-->
              <div class="col-md-4 mx-auto my-5 d-flex">
                <div class="card zoom d-flex">
                  <img class="card-img-top" src="images/aet.jpg" alt="AET Logo">
                  <div class="d-flex flex-column">
                    <h3><a class="card-title px-3" href="https://theaet.com">The AET</a></h3>
                    <p class="card-text px-3">The Ag Experience Tracker is your one stop shop for SAE records, class
                      records,
                      and chapter information.</p>
                  </div>
                  <a href="https://theaet.com" class="mt-auto mx-auto w-75 btn btn-primary">Open AET</a>
                  <p></p>
                </div>
              </div>
              <div class="col-md-4 mx-auto my-5 d-flex">
                <div class="card zoom d-flex">
                  <img class="card-img-top" src="images/judging_card.png" alt="AET Logo">
                  <div class="d-flex flex-column">
                    <h3><a class="card-title px-3" href="https://judgingcard.com">JudgingCard</a></h3>
                    <p class="card-text px-3">JudgingCard.com has results, placings and score breakdowns for FFA events
                      and
                      competitions.</p><br />
                    <a href="https://judgingcard.com" class="mt-auto mx-auto w-75 btn btn-primary">Open JudgingCard</a>
                  </div>
                  <p></p>
                </div>
              </div>
              <div class="col-md-4 mx-auto my-5 d-flex">
                <div class="card zoom d-flex">
                  <img class="card-img-top" src="images/mt_ffa.png" alt="Montana FFA Logo">
                  <div class="d-flex flex-column">
                    <h3><a class="card-title px-3" href="https://montanaffa.org">MontanaFFA</a></h3>
                    <p class="card-text px-3">State FFA website. Includes competition information, calendar, and
                      statewide
                      information.</p>
                  </div>
                  <a href="https://montanaffa.org" class="mt-auto mx-auto w-75 btn btn-primary">Open MontanaFFA</a>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  <section id="shared-files">
    <!--
      To update shared-files:
      Update the folder in Google Drive. 
      Ask Mr. Park for access if you don't have it already.
      If you need it, original code is from:
      https://thomas.vanhoutte.be/miniblog/embed-add-google-drive-folder-file-website/
    -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Shared Documents</h2>
          <iframe src="https://drive.google.com/embeddedfolderview?id=1HN_rfRhqeXCohLGArZ33A2OhedS8ft9d#list"
            width="100%" height="500" frameborder="0"></iframe>
        </div>
      </div>
  </section>
  <section id="officers" class=bg-ffablue>
    <!--
      To update officers:
      1: Go to the maintainer tools.
          A: Type in the URL of the image. 
          (Usually something like images/someone.jpg)

          B: Type the alt text.
          The alt text is displayed if the image doesn't load correctly.
          It's also used by blind people and text to speech software.
          Something like: So and so's profile photo

          C: Type in the name of the office: (President, VP, etc.)

          D: Type the name of the Officer.

          E: Type in their bio, or a short blurb of information about them. 

      2. Click "Generate"]
      3: Copy/paste the code underneath "<div class="row h-100">".
    -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-10 mx-auto text-light my-5">
          <h2>Meet the chapter officers</h2>
          <div class="container y-5 text-dark">
            <div class="row h-100">
              <!--Paste new officer cards here!-->
              <div class="col-md-4 mx-auto d-flex">
                <div class="card my-5 d-flex zoom d-flex">
                  <img class="card-img-top" src="images/rylan.jpg" alt="Profile Photo">
                  <div class="card-body">
                    <h3>President:</h3>
                    <h5>Rylan Signalness</h5>
                    <p class="card-text px-3"> Howdy, I am so excited to be serving as your chapter president! I have
                      been in
                      FFA Leadership positions since Freshman year! Outside of school I can be found Fly Fishing,
                      Rodeoing, or playing with my great dane Harper.</p>
                  </div>
                  <p></p>
                </div>
              </div>
              <div class="col-md-4 mx-auto d-flex">
                <div class="card my-5 d-flex zoom">
                  <img class="card-img-top" src="images/luke.jpg" alt="Profile Photo">
                  <div class="card-body">
                    <h3>Vice President:</h3>
                    <h5>Luke Ostberg</h5>
                    <p class="card-text px-3">As a first-year member, I am both excited and nervous to be serving as
                      Vice
                      President. I have held many leadership positions throughout my life, but this leadership position
                      will be one
                      that tests me the most. I look forward to assisting everyone and finding ways to help this year!
                    </p>
                  </div>
                  <p></p>
                </div>
              </div>
              <div class="col-md-4 mx-auto d-flex">
                <div class="card my-5 d-flex zoom">
                  <img class="card-img-top" src="images/nolan.jpg" alt="Profile Photo">
                  <div class="card-body">
                    <h3>Secretary:</h3>
                    <h5>Nolan Forseth</h5>
                    <p class="card-text px-3"> Hello, I am very excited to be an officer this year and I can't wait to
                      be
                      involved in our chapter this year.</p>
                  </div>
                  <p></p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mx-auto h-75">
                <div class="card my-5 d-flex zoom">
                  <img class="card-img-top" src="images/sarah.jpg" alt="Profile Photo">
                  <div class="card-body">
                    <h3>Treasurer:</h3>
                    <h5>Sarah Berglund</h5>
                    <p class="card-text px-3"> Hey everyone! I am so happy that I get to be this years treasurer. I have
                      lots
                      of plans and goals for this year that I can hopefully see happen. For those of you who do not know
                      me I moved here last summer in 2019. I am originally from North Dakota. I have always love
                      agriculture and I can not wait to learn more about it with all my fellow chapter members!</p>
                  </div>
                  <p></p>
                </div>
              </div>
              <div class="col-md-4 mx-auto d-flex">
                <div class="card my-5 d-flex zoom">
                  <img class="card-img-top" src="images/justin.jpg" alt="Profile Photo">
                  <div class="card-body">
                    <h3>Reporter:</h3>
                    <h5>Justin Forseth</h5>
                    <p class="card-text px-3">I'm excited to be serving as this year's Fairfield FFA reporter.
                      Agriculture
                      has been a part of my life for as long as I can remember, and as an active member of 4-H and FFA,
                      I look forward to being a leader for youth in ag for our community. </p>
                  </div>
                  <p></p>
                </div>
              </div>
              <div class="col-md-4 mx-auto d-flex">
                <div class="card my-5 d-flex zoom">
                  <img class="card-img-top" src="images/alexis.jpg" alt="Profile Photo">
                  <div class="card-body">
                    <h3>Sentinal:</h3>
                    <h5>Alexis Morris</h5>
                    <p class="card-text px-3"> Hey Everyone! I am so exited to be serving as your chapter Sentinel! I
                      have
                      been in FFA for 2 years. This is my first year being a chapter officer. Outside of school I can be
                      found by working with my animals or in the mountains riding horses, or playing with my cow dog
                      Bruno!</p>
                  </div>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <section id="videos">
    <!--
      To update videos:
      1: Upload you video to YouTube.
      (Technically, you can also use a video from GDrive, but YT is easier).
      2: Right click, and click "Copy embed code"
      3: Paste your embed code into a div, like this:
         <div class="col-lg-5 my-4 mx-auto" style="height: 50vh">
            <iframe width="955" height="537" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
         </div>
      4: To prevent things from breaking (especially on mobile) replace width="955" with width="100%" and height="537" with height="100%".
      5: If there are an odd number of videos, the last one will center-align automatically. To fix this, just add am empty div:
        <div class="col-lg-5 my-4 mx-auto" style="height: 50vh"></div>

        Make sure to remove it again when you have an even number!
    -->
    <div class="container-fluid">
      <h1>Videos</h1>
      <div class="row">
        <div class="col-lg-5 my-4 mx-auto" style="height: 50vh">
          <iframe height="100%" width="100%" src="https://www.youtube.com/embed/6X8uVDnx37M" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="col-lg-5 my-4 mx-auto" style="height: 50vh">
          <iframe height="100%" width="100%" src="https://www.youtube.com/embed/sY5oVFlZVsM" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="col-lg-5 my-4 mx-auto" style="height: 50vh">
          <iframe height="100%" width="100%"
            src="https://drive.google.com/file/d/1HwA9OXCjJ02YlC9fhoBhbzd0CLy5hUo8/preview" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="col-lg-5 my-4 mx-auto" style="height: 50vh">

        </div>
      </div>
    </div>
  </section>

  <section id="photos" class=bg-ffablue>
    <!--
      To update these photos:
      1: Go to the maintainer tools.
      2: Enter the URL of the image you want to add.
      (Probably something like images/chapter_photos/something.jpg)
      3. Click "Generate".
      4. Copy/paste the code from the generator into the
      "swiper-wrapper"s. There should be three in total,
      two regular ones, and one fullscreen one. 
  
    -->
    <div class="container text-light">
      <div class="row h-100">
        <div class="col-lg-12 mx-auto h-100">
          <h2>Photos</h2>
          <div class="product-gallery">
            <div class="product-photo-main">
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  <!-- Paste "Regular Swiper Slide" here-->
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20190403_134044.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20190403_141609(0).jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20200219_091004.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20200729_135041.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_1348.JPG">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_20190910_131815992_HDR.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_20191201_161750954_HDR.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_2410.JPG">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_4282.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/Snapchat-1691681379.jpg">
                    </div>
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
            <div class="product-photos-side">
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  <!--Paste "Regular Swiper Slide" here.-->
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20190403_134044.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20190403_141609(0).jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20200219_091004.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20200729_135041.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_1348.JPG">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_20190910_131815992_HDR.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_20191201_161750954_HDR.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_2410.JPG">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_4282.jpg">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/Snapchat-1691681379.jpg">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-gallery-full-screen">
              <div class="swiper-container gallery-top">
                <div class="swiper-wrapper">
                  <!--Paste "Fullscreen Swiper Slide" here.-->
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20190403_134044.jpg" draggable="false"
                        ondragstart="return false;">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20190403_141609(0).jpg" draggable="false"
                        ondragstart="return false;">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20200219_091004.jpg" draggable="false"
                        ondragstart="return false;">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/20200729_135041.jpg" draggable="false"
                        ondragstart="return false;">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_1348.JPG" draggable="false" ondragstart="return false;">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_20190910_131815992_HDR.jpg" draggable="false"
                        ondragstart="return false;">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_20191201_161750954_HDR.jpg" draggable="false"
                        ondragstart="return false;">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_2410.JPG" draggable="false" ondragstart="return false;">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/IMG_4282.jpg" draggable="false" ondragstart="return false;">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="images/chapter_photos/Snapchat-1691681379.jpg" draggable="false"
                        ondragstart="return false;">
                    </div>
                  </div>
                </div>
                <div class="swiper-button-next swiper-button-white">
                  <svg fill="#FFFFFF" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" />
                  </svg>
                </div>
                <div class="swiper-button-prev swiper-button-white">
                  <svg fill="#FFFFFF" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                  </svg>
                </div>
                <div class="gallery-nav">
                  <div class="swiper-pagination"></div>
                  <ul class="gallery-menu">
                    <li class="zoom">
                      <svg class="zoom-icon-zoom-in" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M12 10h-2v2H9v-2H7V9h2V7h1v2h2v1z" />
                      </svg>
                      <svg class="zoom-icon-zoom-out" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                          d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14zM7 9h5v1H7z" />
                      </svg>
                    </li>
                    <li class="fullscreen">
                      <svg class="fs-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z" />
                      </svg>
                      <svg class="fs-icon-exit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 16h3v3h2v-5H5v2zm3-8H5v2h5V5H8v3zm6 11h2v-3h3v-2h-5v5zm2-11V5h-2v5h5V8h-3z" />
                      </svg>
                    </li>
                    <li class="close">
                      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                        <path d="M0 0h24v24H0z" fill="none" />
                      </svg>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
  </section>
  <section id="calendar">
    <!--
      To update the calendar:
      Use Google Calendar: https://calendar.google.com
      Ask Mr. Park for edit access to the calendar if you don't have it already.
    -->
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h2>Calendar</h2>
          <p class="lead">Upcoming events for Fairfield FFA</p>
          <iframe
            src="https://calendar.google.com/calendar/embed?src=fairfield.k12.mt.us_38a61j9d76jd5qomjmdb77g1to%40group.calendar.google.com&ctz=America%2FDenver"
            style="border:none" width="100%" height="500" frameborder="0" scrolling="no"></iframe>
        </div>
      </div>
    </div>
  </section>
  <section id="contact">
    <!--
      To update contact information:
      Simply modify the text below.
      A few notes:
         - <li> stands for list item. Add another <li></li> tag to create a new list item.
         - <a href="SOME_URL"> is a link.
         - <a href="tel:SOME_NUMBER"> is a phone number.
         - <a href="mailto:SOMEONE@EXAMPLE.COM"> is an email address.
    -->
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h2>Contact us</h2>
          <p class="lead">Get in touch with Fairfield FFA:</p>
          <ul>
            <?php 
            $contactFile = fopen("contactInfoText.txt", "r");
            $contactText = fread($contactFile, filesize("contactInfoText.txt"));
            fclose($contactFile);
            $contactArray = explode("\n", $contactText);
            for ($contact = 0; $contact <= sizeof($contactArray) - 2; $contact++) {
                //NAME|TYPE|CONTACT_INFO
                $currentContact=$contactArray[$contact];
                if ($currentContact != ""){
                    $currentContactArray = explode("|", $currentContact);
                    echo "<li>" . $currentContactArray[0] . "<a href=\"" . $currentContactArray[1] . $currentContactArray[2] . "\">" . $currentContactArray[2] . "</a></li>"; 
                };
            }
            ?>
            <!--<li>John Park, Advisor: <a href="mailto:jpark@fairfield.k12.mt.us">jpark@fairfield.k12.mt.us</a></li>
            <li>School Phone: <a href="tel:14064672528">(406) 467-2528</a></li>-->
          </ul>
        </div>
      </div>
    </div>
  </section>

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
</body>

</html>
