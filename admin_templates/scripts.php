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
            case "contactTable":
                idPrefix = "contactInfo";
                break;
        }
        var contactTable = document.getElementById(tableId);
        var newContact = contactTable.lastElementChild.cloneNode(true);
        var erasableInputs = newContact.getElementsByClassName("erasable-value");
        newContact.getElementsByClassName("submit-button")[0].name = idPrefix + "NewSubmit";
        newContact.getElementsByClassName("submit-button")[0].id = idPrefix + "NewSubmit";
        newContact.getElementsByClassName("submit-button")[0].setAttribute("form", "new" + idPrefix + "Form");
        newContact.getElementsByClassName("submit-button")[0].value = "Add";
        newContact.getElementsByTagName("form")[0].id = "new" + idPrefix + "Form";
        for (var i = 0; i < erasableInputs.length; i++) {
            erasableInputs[i].value = "";
            erasableInputs[i].setAttribute("form", "new" + idPrefix + "Form");
        }
        contactTable.appendChild(newContact)

    }
</script>
