<section id="calendar">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <h2>Calendar</h2>
        <p class="lead">Upcoming events for Fairfield FFA</p>
       
        <?php
        //Load calendar URL
        $calendarEmbedCodeFile = fopen("../data/calendarEmbedCode.txt", "r");
        $embedCode = fread($calendarEmbedCodeFile, filesize("../data/calendarEmbedCode.txt"));
        fclose($calendarEmbedCodeFile);
        ?>
       
        <iframe src="<?php echo $embedCode; ?>" style="border:none" width="100%" height="500" frameborder="0" scrolling="no"></iframe>


      </div>
    </div>
  </div>
</section>