  <section id="videos">
    <div class="container-fluid">
      <h1>Videos</h1>
      <div class="row">
        <?php
        $videoArray = array();
        $videoArray = readArrayFromJSON("videos.json");
        for ($video = 0; $video <= sizeof($videoArray) - 1; $video++) {
          $currentVideoArray = $videoArray[$video];
          $currentVideoArray['video_url'] = str_replace("https://www.youtube.com/watch?v=", "", $currentVideoArray['video_url']);
          $currentVideoArray['video_url'] = str_replace("https://youtu.be/", "", $currentVideoArray['video_url']);

        ?>
          <div class='col-lg-5 my-5 mx-auto h-100'><?php echo str_replace("VIDEO_ID", $currentVideoArray['video_url'], $currentVideoArray['video_type']); ?></div>
        <?php
        };
        //If there is an odd number of videos, 
        //add an empty column to prevent the last
        //video from centering.
        if (sizeof($videoArray) % 2 != 0) {
          ?>
          <div class='col-lg-5 my-5 mx-auto h-100'></div>
          <?php
        };
        ?>
      </div>
    </div>
  </section>