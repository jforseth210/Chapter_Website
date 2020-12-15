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
            $contactArray = array();
            $contactArray = readArrayFromJSON("contactInfoText.json");
            for ($contact = 0; $contact <= sizeof($contactArray) - 1; $contact++) {
            
                $currentContactArray=$contactArray[$contact];
                
                echo
                    "<li>" . $currentContactArray["contact_name"] . 
                        " <a href=\"" . $currentContactArray["contact_type"] . $currentContactArray["contact_info"] . "\">"
                                . $currentContactArray["contact_info"] . 
                        "</a>
                    </li>"; 
            }
            ?>
            <!--<li>John Park, Advisor: <a href="mailto:jpark@fairfield.k12.mt.us">jpark@fairfield.k12.mt.us</a></li>
            <li>School Phone: <a href="tel:14064672528">(406) 467-2528</a></li>-->
          </ul>
        </div>
      </div>
    </div>
  </section>
