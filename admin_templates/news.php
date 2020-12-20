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
}
if (isset($_POST['newsDeleteSubmit'])) {
    //Get the row number of the news being modified
    $rowToDelete = intVal($_POST['row_num']);

    deleteRowJSON($rowToDelete, "news.json");
}
if (isset($_POST['newsMoveSubmit'])) {
    //Get the row number of the news being modified
    $rowToMove = intVal($_POST['row_num']);
    $direction = $_POST['direction'];
    reorderArrayJSON("news.json", $rowToMove, $direction);
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
                        echo "
                            <div class=\"col-md-4 d-flex\">
                                <div class=\"card mx-auto w-100 my-5 d-flex zoom\">
                                        <div class=\"card-body\">
                                        <form role='form' id=\"news$news\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#news" . "' method=\"POST\">
                                            <h3><input form=\"news$news\" name=\"newsHeadline\" class=\"erasable-value form-control\" value=\"{$currentnews["news_headline"]}\" /></h3>
                                            <textArea form=\"news$news\" style=\"height:200px !important\"name=\"newsArticle\" class=\"erasable-value form-control\">" . $currentnews["news_article"] . "</textarea>

                                            <br />
                                            <input hidden name=row_num form=\"news$news\" value=\"$news\">
                                            <input hidden name=row_num form=\"news$news" . "Delete\" value=\"$news\">
                                            <input hidden name=row_num form=\"news" . $news . "MoveUp\" value=\"$news\">
                                            <input hidden name=row_num form=\"news" . $news . "MoveDown\" value=\"$news\">

                                            <div role=\"group\" class=\"btn-group mx-auto mt-auto\">
                                                <form role='form' id=\"" . "news" . $news . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#news" . "' method=\" POST\">
                                                    <input class=\"new-disable btn btn-danger mx-auto\" type=submit name=\"newsDeleteSubmit\" value=\"Delete\" />
                                                </form>
                                                <input form=\"news$news\" class=\"btn btn-primary submit-button mx-auto\" type=submit name=\"newsUpdateSubmit\" value=\"Save\" />
                                                <button type=\"button\" class=\"new-disable btn btn-success mx-auto\" onclick=\"newRow('newsCards',$news);\">New</button>
                                            </div>

                                            <form style=\"display:inline;\" role='form' id=\"news" . $news . "MoveUp\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#news" . "' method=\"POST\">
                                              <button class=\"new-disable btn btn-secondary\" type=submit name=\"newsMoveSubmit\">
                                                Move Up
                                              </button>
                                              <input hidden name=\"direction\" value=\"up\"/>
                                            </form>

                                            <form class=mx-0 style=\"display:inline;\" role='form' id=\"news" . $news . "MoveDown\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#news" . "' method=\"POST\">
                                              <button class=\"new-disable btn btn-secondary \" type=submit name=\"newsMoveSubmit\">
                                                Move Down
                                              </button>
                                              <input hidden name=\"direction\" value=\"down\"/>
                                            </form>
                                        </div>
                                        <p></p>
                                    </form>
                                </div>
                            </div>
                            ";
                      };
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
