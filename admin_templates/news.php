<?php
//New article
if (isset($_POST['newsNewSubmit'])) {
    //Get form data
    $newsHeadline = $_POST['newsHeadline'];
    $newsArticle = $_POST['newsArticle'];

    //Create a new article array
    $newsArray = array(
        "news_headline" => $newsHeadline,
        "news_article" => $newsArticle
    );
    
    //Add it to the json file and tell the user
    addNewRowJSON($newsArray, "news.json");
    echoToAlert("Article added successfully");
}

//Update existing article
if (isset($_POST['newsUpdateSubmit'])) {
    //Get the row number of the news being modified
    $rowToUpdate = intVal($_POST['row_num']);
    
    //Get news information
    $newsHeadline = $_POST['newsHeadline'];
    $newsArticle = $_POST['newsArticle'];

    //Create a new article array
    $newsArray = array(
        "news_headline" => $newsHeadline,
        "news_article" => $newsArticle
    );

    //Update the json file and tell the user
    updateRowJSON($rowToUpdate, $newsArray, "news.json");
    echoToAlert("Article updated successfully");
}

//Article deletion. Caution: Based on index. 
if (isset($_POST['newsDeleteSubmit'])) {
    //Get the row number of the news being modified
    $rowToDelete = intVal($_POST['row_num']);

    //Delete it and tell the user
    deleteRowJSON($rowToDelete, "news.json");
    echoToAlert("Article deleted successfully");
}

//Reorder articles
if (isset($_POST['newsCardsReorderSubmit'])) {
    //Get the original index and the new one
    $old_index = intVal($_POST['old_index']);
    $new_index = $_POST['new_index'];

    //Reorder the array
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
                    //Populate with the original data
                    $newsArray = readArrayFromJSON("news.json");
                    for ($news = 0; $news <= sizeof($newsArray) - 1; $news++) {
                        $currentnews = $newsArray[$news];
                    ?>
                        <div class="col-md-4 d-flex">
                            <div class="card mx-auto w-100 my-5 d-flex zoom">
                                <!-- Main form used for update/creation -->
                                <form role='form' id="news<?php echo $news; ?>" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#news' method="POST">
                                    <!-- Headline -->
                                    <h3><input form="news<?php echo $news; ?>" name="newsHeadline" class="erasable-value form-control" value="<?php echo $currentnews["news_headline"]; ?>" /></h3>
                                    <!-- Body text -->
                                    <textArea form="news<?php echo $news; ?>" style="height:200px !important" name="newsArticle" class="erasable-value form-control"><?php echo $currentnews["news_article"]; ?></textarea>

                                    <br />

                                    <!-- Which article is being modified? -->
                                    <input hidden name=row_num form="news<?php echo $news; ?>" value="<?php echo $news; ?>">
                                    <input hidden name=row_num form="news<?php echo $news; ?>Delete" value="<?php echo $news; ?>">
                                    
                                    <!-- Delete, save, new buttons -->
                                    <div role="group" class="btn-group mx-auto mt-auto w-100">
                                        
                                        <!-- Delete button -->
                                        <form role='form' id="news<?php echo $news; ?>Delete" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#news' method=" POST">
                                            <input class="new-disable btn btn-danger mx-auto" type=submit name="newsDeleteSubmit" value="Delete" />
                                        </form>

                                        <!-- Save button -->
                                        <input form="news<?php echo $news; ?>" class="btn btn-primary submit-button mx-auto" type=submit name="newsUpdateSubmit" value="Save" />
                                        
                                        <!-- New button -->
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