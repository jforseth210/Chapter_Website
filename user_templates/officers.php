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
            <?php 
                $officerArray = readArrayFromJSON("officers.json");
                //Create a table row for each contact
                for ($officer = 0; $officer <= sizeof($officerArray) - 1; $officer++) {
                    $currentOfficer = $officerArray[$officer];
                    echo "<div class=\"col-md-4 mx-auto d-flex\">
                    <div class=\"card my-5 d-flex zoom d-flex\">
                    <img class=\"card-img-top\" src=\"images/officers/{$currentOfficer["officer_title"]}.{$currentOfficer["officer_image_ext"]}\" alt=\"Officer Photo\">
                    <div class=\"card-body\">
                        <h3>{$currentOfficer["officer_title"]}</h3>
                        <h5>{$currentOfficer["officer_name"]}</h5>
                        <p class=\"card-text px-3\">{$currentOfficer["officer_bio"]}</p>
                    </div>
                    <p></p>
                    </div>
                </div>";
            }
            ?>
              <!--<div class="col-md-4 mx-auto d-flex">
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
              </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
