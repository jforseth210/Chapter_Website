<?php
//Simple alert for users.
function echoToAlert($message){
  echo"<script>
    document.getElementById('alert-modal-alert').innerHTML = \"$message\";
    $('#alert-modal').modal('show');
  </script>";
}

//console.log
function echoToConsole($message){
    echo "<script>console.log(\"$message\");</script>";
}
?>