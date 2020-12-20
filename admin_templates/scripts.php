<!-- Matomo web analytics -->
<script type="text/javascript">
    var _paq = window._paq = window._paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
    _paq.push(["setCookieDomain", "*.fairfieldffa.org"]);
    _paq.push(["setDomains", ["*.fairfieldffa.org"]]);
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u = "//jforseth.tech/matomo/";
        _paq.push(['setTrackerUrl', u + 'matomo.php']);
        _paq.push(['setSiteId', '2']);
        var d = document,
            g = d.createElement('script'),
            s = d.getElementsByTagName('script')[0];
        g.type = 'text/javascript';
        g.async = true;
        g.src = u + 'matomo.js';
        s.parentNode.insertBefore(g, s);
    })();
</script>
<!-- End Matomo Code -->

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!--Theme js-->
<script src="js/scrolling-nav.js"></script>
<!--<script src="js/gallery.js"></script>-->
<script>
    function newRow(tableId, row) {
        //To the person responsible for fixing
        //this disaster when it inevitably
        //breaks, be it my future self or
        //someone else: I'm sorry.
        switch (tableId) {
            case "officerCards":
                idPrefix = "officer";
                break;
            case "resourceCards":
                idPrefix = "resource";
                break;
            case "videoTable":
                idPrefix = "video";
                break;
            case "PhotoCards":
                idPrefix = "photos";
                break;
            case "contactTable":
                idPrefix = "contactInfo";
                break;
            case "newsCards":
                idPrefix = "news";
                break;
            case "aboutUsPhotoCards":
                idPrefix = "aboutUsPhoto";
        }
        var contactTable = document.getElementById(tableId);
        var newContact = contactTable.lastElementChild.cloneNode(true);
        var erasableInputs = newContact.getElementsByClassName("erasable-value");
        var freshIds = newContact.getElementsByClassName("fresh-id");
        var freshFors = newContact.getElementsByClassName("fresh-for");
        var newDisable = newContact.getElementsByClassName("new-disable");
        var rowNumFields = newContact.getElementsByClassName("row_num");
        var newLoadFileFunctions = newContact.getElementsByClassName("new-load-file-function");

        var newRowNum = contactTable.children.length;
        var images = newContact.getElementsByTagName("img");

        newContact.getElementsByClassName("submit-button")[0].name = idPrefix + "NewSubmit";
        newContact.getElementsByClassName("submit-button")[0].id = idPrefix + "NewSubmit";
        newContact.getElementsByClassName("submit-button")[0].setAttribute("form", "new" + idPrefix + "Form");
        newContact.getElementsByClassName("submit-button")[0].value = "Save New";
        newContact.getElementsByTagName("form")[0].id = "new" + idPrefix + "Form";

       for (var i = 0; i < rowNumFields.length; i++) {
            rowNumFields[i].id = newRowNum;
        }
        //This is buggy and hacky and bad,
        //but I can't think of another way
        //to do it.
        for (var i = 0; i < newDisable.length; i++) {
             newDisable[i].disabled=true;
        }

        for (var i = 0; i < images.length; i++) {
             images[i].src = "https://www.lifewire.com/thmb/2KYEaloqH6P4xz3c9Ot2GlPLuds=/1920x1080/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg";

        }
        for (var i = 0; i < freshIds.length; i++) {
             freshIds[i].id = freshIds[i].id + "addnew";
        }

        for (var i = 0; i < freshFors.length; i++) {
              freshFors[i].setAttribute("for", freshIds[i].id);
        }
        for (var i = 0; i<newLoadFileFunctions.length; i++){
          newLoadFileFunctions[i].setAttribute("onchange", "loadFile(event,\"" + freshIds[0].id + "\")");
        }

        for (var i = 0; i < erasableInputs.length; i++) {
            erasableInputs[i].value = "";
            erasableInputs[i].setAttribute("form", "new" + idPrefix + "Form");
        }
        contactTable.appendChild(newContact);

    }

    function loadFile(event, imageId){
      console.log("loadFile() was called")
      var image = document.getElementById(imageId);
      //alert(imageId);

      //console.log("Image:");
      //console.log(image.src);
      image.src = URL.createObjectURL(event.target.files[0]);
      //console.log(image.src);

      //console.log("Object URL:");
      //console.log(URL.createObjectURL(event.target.files[0]));
    }
</script>
