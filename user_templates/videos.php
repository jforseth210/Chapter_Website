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
        <!--<div class="col-lg-5 my-4 mx-auto" style="height: 50vh">
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
        </div>-->
        <?php
            $videoArray = array();
            $videoArray = readArrayFromJSON("videos.json");
            for ($video = 0; $video <= sizeof($videoArray) - 1; $video++) {
                $currentVideoArray=$videoArray[$video];
                $currentVideoArray['video_url'] = str_replace("https://www.youtube.com/watch?v=","",$currentVideoArray['video_url']);
                $currentVideoArray['video_url'] = str_replace("https://youtu.be/","",$currentVideoArray['video_url']);
                    
                echo "<div class='col-lg-5 my-4 mx-auto' style='height: 50vh'>" . str_replace("VIDEO_ID", $currentVideoArray['video_url'], $currentVideoArray['video_type']) . "</div>"; 
            };
            //If there is an odd number of videos, 
            //add an empty column to prevent the last
            //video from centering.
            if(sizeof($videoArray) % 2 != 0){ 
                echo "<div class='col-lg-5 my-4 mx-auto' style='height: 50vh'></div>";
            };
        ?>
      </div>
    </div>
  </section>
