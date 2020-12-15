<!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>
  <script src="js/gallery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.min.js"></script>
  <!--Cookie notice-->
  <script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script>


<!-- Matomo -->
<script type="text/javascript">
var _paq = window._paq = window._paq || [];
/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
_paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
_paq.push(["setCookieDomain", "*.fairfieldffa.org"]);
_paq.push(["setDomains", ["*.fairfieldffa.org"]]);
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
(function() {
    var u="//jforseth.tech/matomo/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '2']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
})();
</script>
<!-- End Matomo Code -->


<script>
/* Light YouTube Embeds by @labnol */

/* Web: http://labnol.org/?p=27941 */

document.addEventListener("DOMContentLoaded",
    function() {
        var div, n,
            v = document.getElementsByClassName("youtube-player");
        for (n = 0; n < v.length; n++) {
            div = document.createElement("div");
            div.setAttribute("data-id", v[n].dataset.id);
            div.innerHTML = labnolThumb(v[n].dataset.id);
            div.onclick = labnolIframe;
            v[n].appendChild(div);
        }
    });

function labnolThumb(id) {
    var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg">',
        play = '<div class="play"></div>';
    return thumb.replace("ID", id) + play;
}

function labnolIframe() {
    var iframe = document.createElement("iframe");
    iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.id + "?autoplay=1");
    iframe.setAttribute("frameborder", "0");
    iframe.setAttribute("allowfullscreen", "1");
    this.parentNode.replaceChild(iframe, this);
}

//https://stackoverflow.com/questions/37513628/check-if-scrolled-past-div-with-javascript-no-jquery
window.addEventListener("scroll", function(){
    var aboutImageCarousel = document.getElementById("aboutImageCarousel");
    if (isScrolledIntoView(aboutImageCarousel)){
      $("#aboutImageCarousel").carousel('cycle');
    } else {
      $("#aboutImageCarousel").carousel('pause');
    }

    var aboutImageCarousel = document.getElementById("newsCarousel");
    if (isScrolledIntoView(aboutImageCarousel)){
      $("#newsCarousel").carousel('cycle');
    } else {
      $("#newsCarousel").carousel('pause');
    }
});
//https://stackoverflow.com/questions/487073/how-to-check-if-element-is-visible-after-scrolling
function isScrolledIntoView(el) {
  var rect = el.getBoundingClientRect();
  var elemTop = rect.top;
  var elemBottom = rect.bottom;

  // Only completely visible elements return true:
  var isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);
  // Partially visible elements return true:
  //isVisible = elemTop < window.innerHeight && elemBottom >= 0;
  return isVisible;
}
function advanceNewsCarousel(){
    //Get the current slide
    var newsCarouselInner = document.getElementById("newsCarouselInner");
    var activeSlide = newsCarouselInner.querySelectorAll("div.active");
    //https://stackoverflow.com/questions/5913927/get-child-node-index
    var currentSlide = Array.prototype.indexOf.call(newsCarouselInner.children, activeSlide);
    //Load in the next one
    populateNewsfeed(currentSlide+1);
    //Advance the carousel
    $("#newsCarousel").carousel('next');
    console.log("Got here")
}
function populateNewsfeed(index){
  var newSlide = document.getElementById("carouselItemTemplate").content.cloneNode(true);
  var articleElement = document.getElementById("singleNewsItemTemplate").content.cloneNode(true);
  var url = "https://fairfieldffa.org/news_helper.php";
  var params = "get_article=submit&index="+index;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  var newsCarouselInner = document.getElementById("newsCarouselInner");
  if (index != 0){
    newsCarouselInner.children[index-1].classList.remove("active");
  }
  //Send the proper header information along with the request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.send(params);
  xhr.onload = function(){
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var articleArray = JSON.parse(xhr.response);
        articleElement.querySelectorAll(".headline")[0].innerHTML = articleArray['headline'];
        articleElement.querySelectorAll(".summary")[0].innerHTML = articleArray['article'];
    }
    newSlide.firstElementChild.firstElementChild.firstElementChild.appendChild(articleElement);
    document.getElementById("newsCarouselInner").appendChild(newSlide);
  }
  }
}
function populateNewsModal(index){
  var url = "news_helper.php";
  var params = "get_article=submit&index="+index;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  //Send the proper header information along with the request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(params);
  xhr.onload = function(){
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var articleElement = document.getElementById("#newsModal");
        var articleArray = JSON.parse(xhr.response);
        console.log(articleArray);
        document.getElementById("newsModalTitle").innerHTML = articleArray['news_headline'];
        document.getElementById("newsModalBody").innerHTML = articleArray['news_article'];
        console.log(index);
    }
}
}
}
</script>
