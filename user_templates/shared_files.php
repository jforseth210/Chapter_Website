 <section id="shared-files">
    <!--
      To update shared-files:
      Update the folder in Google Drive.
      Ask Mr. Park for access if you don't have it already.
      If you need it, original code is from:
      https://thomas.vanhoutte.be/miniblog/embed-add-google-drive-folder-file-website/
    -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Shared Documents</h2>
          <!--<iframe src="https://drive.google.com/embeddedfolderview?id=1HN_rfRhqeXCohLGArZ33A2OhedS8ft9d#list"-->
          <iframe src="<?php
            $googleDriveEmbedCodeFile = fopen("../data/googleDriveEmbedCode.txt", "r");
            $googleDriveString = fread($googleDriveEmbedCodeFile, filesize("../data/googleDriveEmbedCode.txt"));
            fclose($googleDriveEmbedCodeFile);
            $googleDriveArray = explode("|", $googleDriveString);
            echo "https://drive.google.com/embeddedfolderview?id=" . $googleDriveArray[0] . $googleDriveArray[1];
            ?>"
            width="100%" height="500" frameborder="0"></iframe>
        </div>
      </div>
  </section>
