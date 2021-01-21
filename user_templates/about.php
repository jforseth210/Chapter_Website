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
            <div id="aboutImageCarousel" class="carousel slide carousel-fade" data-ride="carousel">
              <div class="carousel-inner" style="max-height: 60vh !important; max-width: 100vw; width:100">
                <!--Paste "Code for About Us Image Gallery"-->
                <?php
                    $photoArray = readArrayFromJSON("aboutUsImageGallery.json");
                    //Create a table row for each contact
                    for ($photo = 0; $photo <= sizeof($photoArray) - 1; $photo++) {
                        $currentPhoto = $photoArray[$photo];
                        if ($photo == 0) {
                      		$active = " active";
                      	} else {
                      		$active = "";
                      	}
                        echo "
                        <div class=\"carousel-item $active\">
                          <img class=\"mx-auto d-block\" src=\"{$currentPhoto["path"]}\"
                            style=\"max-height: 60vh !important;\" alt=\"Slide $photo\">
                        </div>
                        ";
                    }
                ?>
                    <!--
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
                    </div>-->
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
                    $aboutFile = fopen("../data/aboutUsText.txt","r");
                    $aboutUsText = fread($aboutFile,filesize("../data/aboutUsText.txt"));
                    fclose($aboutFile);
                    $aboutUsText = str_replace("\n", "<br/>", $aboutUsText);
                    echo $aboutUsText;
                    ?>
            </p>
          </div>
        </div>
      </div>
  </section>
