<?php
  if (isset($_POST['change_password_submit'])) {
    $old_password = $_POST['old_password'];  
    $confirm_old_password = $_POST['confirm_old_password'];  
    $new_password = $_POST['new_password'];
    if ($old_password == $confirm_old_password){
      $users = readArrayFromJSON("users.json");
      $user = array();
      for($i = 0; $i < sizeof($users); $i++){
        if ($users[$i]['username']==$_SESSION['username']){
          $user = $users[$i];
          if (password_verify($old_password, $user["password_hash"])){
            $user["password_hash"] = password_hash($new_password, PASSWORD_DEFAULT);
            updateRowJSON($i, $user, "users.json");
          } else {
            echo("Old password is incorrect");
          } 
        }
      } 
    } else {
      echo("Passwords do not match!");
    }
  }
?>
<section id="accounts">
  <div class="container">
    <h2>Accounts</h2>
        <?php
        echo "<h5>Hello <b>{$_SESSION['real_name']}</b>. You are logged in as <b>{$_SESSION['username']}</b> and have <b>{$_SESSION['access']}</b> access.</b></b></h5><br /><br /><br /><br />";
        ?>
        <div class="row">
        <div class="col-lg-6">
        <?php if ($_SESSION["access"] != "admin") {
                    echo "
                    <h4>Change Password</h4>
                    <form method=\"POST\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#aboutUsPhotos" . "' method=\"POST\" enctype=\"multipart/form-data\">
                      <label>Old Password</label>
                      <input class=\"form-control\" type=\"password\" name=\"old_password\"/>
                      <label>Confirm Old Password</label>
                      <input class=\"form-control\" type=\"password\" name=\"confirm_old_password\"/>
                      <label>New Password</label>
                      <input class=\"form-control\" type=\"password\" name=\"new_password\"/>
                      <br />
                      <input class=\"form-control btn btn-primary\" type=\"submit\" name=\"change_password_submit\" value=\"Submit\">
                    </form>
                    ";
                }
                ?>
            </div>
        </div>
    </div>
</section>
