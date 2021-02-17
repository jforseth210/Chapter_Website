<section id="contact">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <h2>Contact us</h2>
        <p class="lead">Get in touch with Fairfield FFA:</p>
        <ul>
          <?php
          $contactArray = array();
          $contactArray = readArrayFromJSON("contactInfoText.json");
          for ($contact = 0; $contact <= sizeof($contactArray) - 1; $contact++) {

            $currentContactArray = $contactArray[$contact];
          ?>

            <li> <?php echo $currentContactArray["contact_name"]; ?>
              <a href="<?php echo $currentContactArray["contact_type"];
                        echo $currentContactArray["contact_info"]; ?>">
                <?php echo $currentContactArray["contact_info"]; ?>
              </a>
            </li>
          
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</section>