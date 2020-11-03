<section id="calendar">
    <div class=container-fluid>
        <div class=row>
            <div class=col-lg-10>
                <h2>Change Calendar</h2>
                <ul>
                    <li>Go to the Google Calendar you want to share.</li>
                    <li>Click "Options for ______"</li>
                    <li>Click "Settings and sharing"</li>
                    <li>Click "Integrate calendar"</li>
                    <li>Copy/paste the embed code into the box below</li>
                    <li>It will automatically extract the calendar url. Click submit.</li>
                    <li>If it gets a little too trigger happy, and deletes the tail-end of the URL, it might let you type by pressing each key twice (maybe). If it still doesn't work, temporarily block javascript on this site.</li>
                </ul>
                <?php
                $calendarEmbedCodeFile = fopen("data_files/calendarEmbedCode.txt", "r");
                $embedCode = fread($calendarEmbedCodeFile, filesize("data_files/calendarEmbedCode.txt"));
                fclose($calendarEmbedCodeFile);
                ?>
                <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <textarea class=form-control id="calendarEmbedCode" oninput="extractURL();" name="calendarEmbedCode" style="height:200px"><?php echo $embedCode; ?></textarea>
                    <input class="btn btn-primary" name="calendarEmbedSubmit" type=submit value=Submit>
                </form>
                <script>
                    function extractURL() {
                        var userInput = document.getElementById("calendarEmbedCode").value;
                        try {
                            var url = userInput.match(/\bhttps?:\/\/\S+/gi)[0];
                            //Closing " gets picked up by the regex. Remove it. 
                            url = url.substring(0, url.length - 1);
                            // Add a short wait, to make it clear that the original data WAS pasted in correctly. 
                            // Otherwise it looks like nothing happened
                            setTimeout(function() {
                                document.getElementById("calendarEmbedCode").value = url;
                            }, 500);
                        } catch (TypeError) {
                            //There is no URL in the textbox.
                        }
                    };
                    //Don't resubmit on reload.
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>
            </div>
        </div>
    </div>
</section>
