<?php
//https://stackoverflow.com/questions/9219795/truncating-text-in-php
function truncate($text, $chars = 25) {
    if (strlen($text) <= $chars) {
        return $text;
    }
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text."...";
    return $text;
}
?>
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
              echo "<div type=\"button\" data-toggle=\"modal\" onclick=\"populateNewsModal($absoluteArticle)\" data-target=\"#newsModal\" class=col-md-4>
                            <h4>{$chunkedNewsArray[$articleGroup][$article]['news_headline']}</h4>
                            <p>
                          ";
          		$articleText = $chunkedNewsArray[$articleGroup][$article]['news_article'];
          		echo truncate($articleText, 200);
          		echo "
                          <div class=\"btn btn-primary\">Read More</div></p>
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
<!-- Modal -->
<div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newsModalTitle">Student who called soil "dirt" missing</h5>
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
