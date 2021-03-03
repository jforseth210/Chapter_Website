<?php
//Form submissions
if (isset($_POST['newsNewSubmit'])) {
    //Get news information
    $newsHeadline = $_POST['newsHeadline'];
    $newsArticle = $_POST['newsArticle'];

    $newsArray = array(
        "news_headline" => $newsHeadline,
        "news_article" => $newsArticle
    );
    addNewRowJSON($newsArray, "news.json");
    echoToAlert("Article added successfully");
}

if (isset($_POST['newsUpdateSubmit'])) {
    //Get the row number of the news being modified
    $rowToUpdate = intVal($_POST['row_num']);
    //Get news information
    $newsHeadline = $_POST['newsHeadline'];
    $newsArticle = $_POST['newsArticle'];

    $newsArray = array(
        "news_headline" => $newsHeadline,
        "news_article" => $newsArticle
    );

    updateRowJSON($rowToUpdate, $newsArray, "news.json");
    echoToAlert("Article updated successfully");
}
if (isset($_POST['newsDeleteSubmit'])) {
    //Get the row number of the news being modified
    $rowToDelete = intVal($_POST['row_num']);

    deleteRowJSON($rowToDelete, "news.json");
    echoToAlert("Article deleted successfully");
}
if (isset($_POST['newsCardsReorderSubmit'])) {
    $old_index = intVal($_POST['old_index']);
    $new_index = $_POST['new_index'];
    reorderArrayJSON("news.json", $old_index, $new_index);
}
?>
<section id="news">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2>News</h2>
                <div id="newsCards" class=row>
                    <?php
                    $newsArray = readArrayFromJSON("news.json");
                    //Create a table row for each contact
                    for ($news = 0; $news <= sizeof($newsArray) - 1; $news++) {
                        $currentnews = $newsArray[$news];
                        //Create the start of the row, which is also a form.
                    ?>
                        <div class="col-md-4 d-flex">
                            <div class="card mx-auto w-100 my-5 d-flex zoom">
                                <form role='form' id="news<?php echo $news; ?>" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#news' method="POST">
                                    <h3><input form="news<?php echo $news; ?>" name="newsHeadline" class="erasable-value form-control" value="<?php echo $currentnews["news_headline"]; ?>" /></h3>
                                    <textArea form="news<?php echo $news; ?>" style="height:200px !important" name="newsArticle" class="erasable-value form-control"><?php echo $currentnews["news_article"]; ?></textarea>

                                    <br />
                                    <input hidden name=row_num form="news<?php echo $news; ?>" value="<?php echo $news; ?>">
                                    <input hidden name=row_num form="news<?php echo $news; ?>Delete" value="<?php echo $news; ?>">

                                    <div role="group" class="btn-group mx-auto mt-auto w-100">
                                        <form role='form' id="news<?php echo $news; ?>Delete" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#news' method=" POST">
                                            <input class="new-disable btn btn-danger mx-auto" type=submit name="newsDeleteSubmit" value="Delete" />
                                        </form>
                                        <input form="news<?php echo $news; ?>" class="btn btn-primary submit-button mx-auto" type=submit name="newsUpdateSubmit" value="Save" />
                                        <button type="button" class="new-disable btn btn-success mx-auto" onclick="newRow('newsCards',<?php echo $news; ?>);">New</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    };
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>