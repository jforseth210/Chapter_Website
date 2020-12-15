<section id="news0">
  <div class=container-fluid>
    <div class=row>
      <div class=col-lg-11>
        <h2>News</h2>
        <div class="d-xs-inlined-sm-none">
          <small class="">The table may not display correctly on small screens.
                      Please flip to landscape mode or use a larger device.</small>
        </div>
        <table class='table'>
          <thead>
            <th>Article</th>
            <th>Add/Remove</th>
            <th>Reorder</th>
            <th>Update</th>
          </thead>
          <tbody id="newsTable">
<?php
  $newsArray = array();
  $newsArray = readArrayFromJSON("news.json");
  for ($article = 0; $article <= sizeof($newsArray) - 1; $article++) {
        $currentnewsArray = $newsArray[$article];
        //Create the start of the row, which is also a form.
        echo "
            <tr>
            <form role='form' id=\"news$article\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) ."#news" . "'method=\"POST\">
              <td>
                <input form=\"news$article\" name=\"articleHeadline\" class=\"erasable-value form-control\" value=\"{$currentnewsArray['headline']}\" />
                <textarea name=\"articleBody\" style=\"height:200px !important\" form=\"news$article\"class=\"erasable-value form-control\">{$currentnewsArray["article"]}</textarea>
              </td>
              <td>
                <button type=\"button\" class=\"btn btn-success\" onclick=\"newRow('newsTable',$article);\">
                  +
                </button>
                <form role='form' id=\"news" . $article . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#news" . "' method=\"POST\">
                  <input class=\"btn btn-danger\" type=submit name=\"newsDeleteSubmit\" id=\"newsDeleteSubmit\" value=\"-\"/>
                </form>
              </td>
              <td width=\"120px\">
                <form style=\"width:45px !important; display:inline;\" role='form' id=\"news" . $article . "MoveUp\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#news" . "' method=\"POST\">
                  <button class=\"btn  btn-secondary\" type=submit name=\"newsInfoMoveSubmit\" id=\"newsInfoMoveSubmit\">
                    <svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-arrow-up\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">
                      <path
                          fill-rule=\"evenodd\" d=\"M8 15a.5.5 0 0 0
                          .5-.5V2.707l3.146 3.147a.5.5 0 0 0
                          .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0
                          .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z\"
                      />
                    </svg>
                  </button>
                  <input hidden name=\"direction\" value=\"up\"/>
                </form>
                <form class=mx-0 style=\"width:45px !important; display:inline;\" role='form' id=\"news" . $article . "MoveDown\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#news" . "' method=\"POST\">
                  <button class=\"btn btn-secondary \" type=submit name=\"newsInfoMoveSubmit\"  id=\"newsInfoMoveSubmit\">
                    <svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi  bi-arrow-down\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">
                      <path
                          fill-rule=\"evenodd\" d=\"M8 1a.5.5 0 0 1
                          .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4
                          4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1
                          .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z\"
                      />
                    </svg>
                  </button>
                  <input hidden name=\"direction\" value=\"down\"/>
                </form>
              </td>
              <input hidden name=row_num form=\"news$article\" value=\"$article\" />
              <input hidden name=row_num form=\"news" . $article . "Delete\" value=\"$article\">
              <input hidden name=row_num form=\"news" . $article . "MoveUp\" value=\"$article\">
              <input hidden name=row_num form=\"news" . $article . "MoveDown\" value=\"$article\">
              <td>
                <input form=\"news$article\" class=\"btn btn-primary submit-button\" type=submit name=\"newsInfoUpdateSubmit\" id=\"newsInfoUpdateSubmit\" value=\"Update\"/>
              </td>
              </form>
            </tr>";
};?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<section id="news" >
   <div class="container">

     <div class="row">
       <h2>Live<!--ish--> Feed</h2>
     </div>
     <div class="row">
       <div id="newsCarousel" class="mx-auto carousel slide" data-ride="carousel" data-interval="30000">
      <div id="newsCarouselInner"class="mx-auto carousel-inner news">
        <?php
          $newsArray = readArrayFromJSON("news.json");
          $chunkedNewsArray=array_chunk($newsArray, 3, false);
          //print_r ($chunkedNewsArray);
          //Create a table row for each contact
          $absoluteArticle=0;
          for ($articleGroup = 0; $articleGroup <= sizeof($chunkedNewsArray) - 1; $articleGroup++) {
          	$currentArticleGroup = $chunkedNewsArray[$articleGroup];
          	if ($articleGroup == 0) {
          		$active = " active";
          	} else {
          		$active = "";
          	}
            /*
            I wanted to populate this using AJAX, so I didn't request
            all the articles at once. I couldn't figure out how to do
            that though. I did run a 10,000 line json file through it
            without an performance problems, so I think it's probably
            fine.
            */

          	echo "
                        <div class=\"carousel-item $active\">
                          <div class=container>
                            <div class=row>
            ";
          	for ($article = 0; $article <= sizeof($currentArticleGroup) - 1; $article++) {
              /*echo '<pre>';
              print_r ($chunkedNewsArray);
              echo '</pre>';
              echo $articleGroup . " " .$article;*/
              echo "
              <div type=\"button\" data-toggle=\"modal\" onclick=\"populateNewsModal($absoluteArticle)\" data-target=\"#newsModal\" class=col-md-4>
              <form  role='form' id=\"news$article" .  "\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#news" . "' method=\"POST\" enctype=\"multipart/form-data\"></form>
                            <input form=\"news$article\" class=\"erasable-value form-control\" name=\"headline\" value=\"{$chunkedNewsArray[$articleGroup][$article]['headline']}\"/>
                            <textarea form=\"news$article\" class=\"erasable-value form-control\" name=\"article\">";
          		$articleText = $chunkedNewsArray[$articleGroup][$article]['article'];
          		echo $articleText;
          		echo "</textarea><br/>
                          <input type=submit name=\"newsUpdateSubmit\" form=\"news$article\" class=\"btn btn-primary\" value=\"Update\"/>
                          </form>
                          </div>";
              $absoluteArticle++;
          	}
          	echo "

                            </div>
                          </div>
                        </div>
                        ";
                      }
          ?>
        </div>
      </div>
     </div>
     <div class=row>
       <div class="mx-auto">
         <a href="#newsCarousel" role="button" data-slide="prev">&lt- Prev</a>
         <a href="#newsCarousel" role="button" data-slide="next">Next -&gt</a>
       </div>
   </div>
   </div>
