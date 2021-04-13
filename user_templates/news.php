<?php
//If the body text of the news article is too long, truncate it. 
//https://stackoverflow.com/questions/9219795/truncating-text-in-php
function truncate($text, $chars = 25)
{
  if (strlen($text) <= $chars) {
    return $text;
  }
  $text = $text . " ";
  $text = substr($text, 0, $chars);
  $text = substr($text, 0, strrpos($text, ' '));
  $text = $text . "...";
  return $text;
}
?>
<section id="news">
  <div class="container">
    <div class="row">
      <!--Not actually live, you have to reload the page.-->
      <h2>Live Feed</h2>
    </div>
    <div class="row">
      <div id="newsCarousel" class="mx-auto carousel slide" data-ride="carousel" data-interval="30000">
        <div id="newsCarouselInner" class="mx-auto carousel-inner news">
          <?php
          $newsArray = readArrayFromJSON("news.json");
          //Split the news array into groups of three.
          $chunkedNewsArray = array_chunk($newsArray, 3, false);

          //Create a table row for each contact
          $absoluteArticle = 0;
          for ($articleGroup = 0; $articleGroup <= sizeof($chunkedNewsArray) - 1; $articleGroup++) {
            $currentArticleGroup = $chunkedNewsArray[$articleGroup];
            $active = ($articleGroup == 0) ? " active" : "";
            /*
            I considered populating this using AJAX, so I didn't request
            all the articles at once. I couldn't figure out how to do
            that though. I did run a 10,000 line json file through it
            without an performance problems, so I think it's probably
            fine.
            */
          ?>
            <div class="carousel-item <?php echo $active; ?>">
              <div class=container>
                <div class=row>
                  <?php
                  for ($article = 0; $article <= sizeof($currentArticleGroup) - 1; $article++) {
                    $articleText = $chunkedNewsArray[$articleGroup][$article]['news_article'];
                  ?>
                    <div type="button" data-toggle="modal" onclick="populateNewsModal(<?php echo ($absoluteArticle) ?>)" data-target="#newsModal" class=col-md-4>
                      <h4><?php echo $chunkedNewsArray[$articleGroup][$article]['news_headline']; ?></h4>
                      <p><?php echo truncate($articleText, 150); ?>
                      <div class="btn btn-primary">Read More</div>
                      </p>
                    </div>
                  <?php
                    $absoluteArticle++;
                  }
                  ?>

                </div>
              </div>
            </div>
          <?php
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
  <!-- Modal -->
  <div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newsModalTitle">Loading...</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="newsModalBody" class="modal-body">
          Article loading... If this message doesn't disappear in a few seconds, please report the problem to the chapter.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</section>