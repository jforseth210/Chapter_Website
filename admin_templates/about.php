<section id="about">
    <div class=container-fluid>
        <div class=row>
            <div class=col-lg-10>
                <h2>About Fairfield FFA</h2>
                <?php
                $aboutFile = fopen("data_files/aboutUsText.txt", "r");
                $aboutUsText = fread($aboutFile, filesize("data_files/aboutUsText.txt"));
                fclose($aboutFile);
                ?>
                <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <textarea class=form-control name="aboutUsBodyText" style="height:400px"><?php echo $aboutUsText; ?></textarea>
                    <input class="btn btn-primary" name="aboutUsSubmit" type=submit value=Submit>
                </form>
            </div>
        </div>
    </div>
</section>
