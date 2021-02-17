<section id="resources" class="bg-ffablue">
  <div class="container">
    <div class="row">
      <div class="mx-auto">
        <h2 class="text-light">Student Resources</h2>
        <div class="container my-5">
          <div class="row">
            <?php
            $resourceArray = readArrayFromJSON("resources.json");
            for ($resource = 0; $resource <= sizeof($resourceArray) - 1; $resource++) {
              $currentResource = $resourceArray[$resource];
            ?>
              <div class="col-md-4 mx-auto my-5 d-flex">
                <div class="card zoom d-flex">
                  <img class="card-img-top" src="<?php echo $currentResource["resource_image_url"]; ?>" alt="<?php echo $currentResource["resource_name"]; ?> Logo">
                  <div class="d-flex flex-column">
                    <h3><a class="card-title px-3" href="<?php echo $currentResource["resource_url"]; ?>"><?php echo $currentResource["resource_name"]; ?></a></h3>
                    <p class="card-text px-3"><?php echo $currentResource["resource_body"]; ?></p>
                  </div>
                  <a href="<?php echo $currentResource["resource_url"]; ?>" class="mt-auto mx-auto w-75 btn btn-primary">Open <?php echo $currentResource["resource_name"]; ?></a>
                  <p></p>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
</section>