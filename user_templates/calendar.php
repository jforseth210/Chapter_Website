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
src=
 <?php
            $calendarEmbedCodeFile = fopen("../data/calendarEmbedCode.txt", "r");
            $embedCode = fread($calendarEmbedCodeFile, filesize("../data/calendarEmbedCode.txt"));
            fclose($calendarEmbedCodeFile);
            echo "\"" . $embedCode . "\"";
            ?>
style="border:none" width="100%" height="500" frameborder="0" scrolling="no"></iframe>


        </div>
      </div>
    </div>
  </section>
