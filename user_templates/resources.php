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
              <?php
                $resourceArray = readArrayFromJSON("resources.json");
                for ($resource = 0; $resource <= sizeof($resourceArray) - 1; $resource++) {
                    $currentResource=$resourceArray[$resource];
                    echo "
                        <div class=\"col-md-4 mx-auto my-5 d-flex\">
                            <div class=\"card zoom d-flex\">
                            <img class=\"card-img-top\" src=\"{$currentResource["resource_image_url"]}\" alt=\"{$currentResource["resource_name"]} Logo\">
                            <div class=\"d-flex flex-column\">
                                <h3><a class=\"card-title px-3\" href=\"{$currentResource["resource_url"]}\">{$currentResource["resource_name"]}</a></h3>
                                <p class=\"card-text px-3\">{$currentResource["resource_body"]}</p>
                            </div>
                            <a href=\"{$currentResource["resource_url"]}\" class=\"mt-auto mx-auto w-75 btn btn-primary\">Open {$currentResource["resource_name"]}</a>
                            <p></p>
                            </div>
                        </div>
                        ";
                    }
              ?>
          </div>
        </div>
      </div>
  </section>
