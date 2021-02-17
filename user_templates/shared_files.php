 <section id="shared-files">
   <div class="container">
     <div class="row">
       <div class="col-lg-8 mx-auto">
         <h2>Shared Documents</h2>
         <!--<iframe src="https://drive.google.com/embeddedfolderview?id=1HN_rfRhqeXCohLGArZ33A2OhedS8ft9d#list"-->
         <?php
          $googleDriveEmbedCodeFile = fopen("../data/googleDriveEmbedCode.txt", "r");
          $googleDriveString = fread($googleDriveEmbedCodeFile, filesize("../data/googleDriveEmbedCode.txt"));
          fclose($googleDriveEmbedCodeFile);
          $googleDriveArray = explode("|", $googleDriveString);
          ?><iframe src="https://drive.google.com/embeddedfolderview?id=<?php echo $googleDriveArray[0] . $googleDriveArray[1];?>" width="100%" height="500" frameborder="0"></iframe>
       </div>
     </div>
 </section>