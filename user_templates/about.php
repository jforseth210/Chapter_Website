  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>About Fairfield FFA</h2>
          <div class=container-fluid>
            <div id="aboutImageCarousel" class="carousel slide carousel-fade" data-ride="carousel">
              <div class="carousel-inner" style="max-height: 60vh !important; max-width: 100vw; width:100">
                <?php
                $photoArray = readArrayFromJSON("aboutUsImageGallery.json");

                for ($photo = 0; $photo <= sizeof($photoArray) - 1; $photo++) {
                  $currentPhoto = $photoArray[$photo];
                  //Bootstrap needs an active element for a carousel, 
                  //so we set the 0th element to be active.
                  $active = ($photo == 0) ? " active" : "";
                ?>
                  <div class='carousel-item <?php echo ($active); ?>'>
                    <img class='mx-auto d-block' src='<?php echo ($currentPhoto["path"]); ?>' style='max-height: 60vh !important;' alt='Slide <?php echo $photo; ?>'>
                  </div>
                <?php
                }
                ?>
              </div>
              <a class="carousel-control-prev" href="#aboutImageCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#aboutImageCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <p class="lead" style="word-wrap: break-word">
              <?php
              //Read the About Us body text and display it. 
              $aboutFile = fopen("../data/aboutUsText.txt", "r");
              $aboutUsText = fread($aboutFile, filesize("../data/aboutUsText.txt"));
              fclose($aboutFile);
              $aboutUsText = str_replace("\n", "<br/>", $aboutUsText);
              echo $aboutUsText;
              ?>
            </p>
          </div>
        </div>
      </div>
  </section>