<?php
//Simple alert for users.
function echoToAlert($message){
    echo "
    <div class=\"w3alert fixed-top\">
    $message
    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
    </div>
    <style>
        /* The alert message box */
        .w3alert {
            padding: 20px;
            background-color: #f44336;
            /* Red */
            color: white;
            margin-bottom: 15px;
            margin-left: -30%;
            width: 60%;
            position: absolute;
            margin-top: 50;
            left: 50%;
            z-index: 10000000000000;
            opacity: 1;
            transition: opacity 0.6s;
            /* 600ms to fade out */
        }
        
        .w3alert.success {
            background-color: #4CAF50;
        }
        
        .w3alert.info {
            background-color: #2196F3;
        }
        
        .w3alert.warning {
            background-color: #ff9800;
        }
        
        /*For simplelogin*/
        
        .w3alert.primary {
            background-color: #4CAF50;
        }
        
        .w3alert.danger {
            background-color: #ff9800;
        }
        

        /* When moving the mouse over the close button */
        .closebtn:hover {
        color: black;
        }
        </style>
        <style>
        .alert {
        opacity: 1;
        transition: opacity 0.6s; /* 600ms to fade out */
        }
    </style>
    <script>
    // Get all elements with class=\"closebtn\"
    var close = document.getElementsByClassName(\"closebtn\");
    var i;

    // Loop through all close buttons
    for (i = 0; i < close.length; i++) {
    // When someone clicks on a close button
    close[i].onclick = function(){

        // Get the parent of <span class=\"closebtn\"> (<div class=\"alert\">)
        var div = this.parentElement;

        // Set the opacity of div to 0 (transparent)
        div.style.opacity = \"0\";

        // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
        setTimeout(function(){ div.style.display = \"none\"; }, 600);
    }
    }
    </script>
    ";
}

//console.log
function echoToConsole($message){
    echo "<script>console.log(\"$message\");</script>";
}
?>