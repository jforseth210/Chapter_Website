<div class="modal fade in" id="alert-modal" tabindex="-2" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Information:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="alert-modal-alert"></p>
      </div>
    </div>
  </div>
</div>
<?php
//Simple alert for users.
function echoToAlert($message)
{
  echoToConsole("I did something");
  echo "<script>function defer(method) {
    if (window.jQuery) {
      document.getElementById('alert-modal-alert').innerHTML = \"$message\";
      $('#alert-modal').modal('show');
    } else {
        setTimeout(function() { defer(method) }, 50);
    }
}
defer();
  </script>";
}

//console.log
function echoToConsole($message)
{
  echo "<script>console.log(\"$message\");</script>";
}
?>