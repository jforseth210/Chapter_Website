<?php
if (isset($_POST['change_password_submit'])) {
  $old_password = $_POST['old_password'];
  $confirm_old_password = $_POST['confirm_old_password'];
  $new_password = $_POST['new_password'];
  if ($old_password == $confirm_old_password) {
    $users = readArrayFromJSON("users.json");
    $user = array();
    for ($i = 0; $i < sizeof($users); $i++) {
      if ($users[$i]['username'] == $_SESSION['username']) {
        $user = $users[$i];
        if (password_verify($old_password, $user["password_hash"])) {
          $user["password_hash"] = password_hash($new_password, PASSWORD_DEFAULT);
          updateRowJSON($i, $user, "users.json");
        } else {
          echo ("Old password is incorrect");
        }
      }
    }
  } else {
    echo ("Passwords do not match!");
  }
}


if (isset($_POST['userUpdateSubmit'])) {
  $rowToUpdate = intVal($_POST['row_num']);

  $username = $_POST['username'];
  $real_name = $_POST['name'];
  $new_password = $_POST['password'];
  $access = $_POST['access'];

  if ($new_password != "") {
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
  } else {
    $oldUserArray = readArrayFromJSON("users.json");
    $currentUserArray = $oldUserArray[$rowToUpdate];
    $password_hash = $currentUserArray["password_hash"];
  }

  $userArray = array(
    "username" => $username,
    "password_hash" => $password_hash,
    "real_name" => $real_name,
    "access" => $access
  );

  updateRowJSON($rowToUpdate, $userArray, "users.json");
}


if (isset($_POST['userNewSubmit'])) {
  $username = $_POST['username'];
  $real_name = $_POST['name'];
  $new_password = $_POST['password'];
  $access = $_POST['access'];

  $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

  $userArray = array(
    "username" => $username,
    "password_hash" => $password_hash,
    "real_name" => $real_name,
    "access" => $access
  );
  print_r($userArray);

  addNewRowJSON($userArray, "users.json");
}


if (isset($_POST['userDeleteSubmit'])) {
  //Get the row number of the video being modified
  $rowToDelete = intVal($_POST['row_num']);

  deleteRowJSON($rowToDelete, "users.json");
}
?>
<section id="accounts">
  <div class="container-fluid">
    <h2>Accounts</h2>
    <h5>Hello <b><?php echo $_SESSION['real_name'] ?></b>. You are logged in as <b><?php echo $_SESSION['username'] ?></b> and have <b><?php echo $_SESSION['access'] ?></b> access.</b></b></h5><br /><br /><br /><br />
    <div class="row">
      <?php if ($_SESSION["access"] == "admin") {
        //Admin account section
        $userArray = array();
        $userArray = readArrayFromJSON('users.json');
      ?>
        <div class='d-xs-inline  d-sm-none'><small>The table may not display correctly on small screens. Please flip to landscape mode or use a larger device.</small></div>
        <table class='table'>
          <thead>
            <tr>
              <th>Username:</th>
              <th>Name:</th>
              <th>Password Reset:</th>
              <th>Access:</th>
              <th>Reorder:</th>
              <th>Add/Delete:</th>
              <th>Save:</th>
              <tr />
          </thead>
          <tbody id='userTable'>
            <?php
            for ($user = 0; $user <= sizeof($userArray) - 1; $user++) {
              $currentUserArray = $userArray[$user];
              //Autocomplete new-password prevents browsers and password managers from automatically filling the password change fields.
            ?>
              <tr>
                <form role='form' id="users<?php echo $user; ?>" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>#accounts' method="POST">
                  <input hidden name=row_num form="users<?php echo $user; ?>" value="<?php echo $user; ?>">
                  <td><input class='erasable-value form-control' name='username' value='<?php echo $currentUserArray["username"]; ?>' /></td>
                  <td><input class='erasable-value form-control' name='name' value='<?php echo $currentUserArray["real_name"]; ?>' /></td>
                  <td><input class='erasable-value form-control' name='password' type='password' placeholder='New Password' autocomplete='new-password' /></td>

                  <td>
                    <select class='erasable-value form-control' name='access' id='access<?php echo $user; ?>' onchange='checkIfAdminExists("access<?php echo $user; ?>")'>
                      <?php
                      $access_levels = array();
                      for ($i = 0; $i < sizeof($userArray); $i++) {
                        array_push($access_levels, $userArray[$i]["access"]);
                      }
                      $access_levels = array_unique($access_levels);
                      foreach ($access_levels as $access_level) {
                        if ($currentUserArray["access"] == $access_level) {
                          $selected = "selected";
                        } else {
                          $selected = "";
                        }
                      ?>
                        <option selected><?php echo $access_level ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </td>
                </form>
                <td>
                  <div class="btn btn-secondary handle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-move" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10zM.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H5.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2zM10 8a.5.5 0 0 1 .5-.5h3.793l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L14.293 8.5H10.5A.5.5 0 0 1 10 8z" />
                    </svg>
                  </div>
                </td>
                <td>
                  <button type="button" class="new-disable btn btn-success" onclick="newRow('userTable',<?php echo $user; ?>);">+</button>
                  <form style='display:inline' role='form' id="users<?php echo $user; ?>Delete" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#accounts" . "' method="POST">
                    <input class="new-disable btn btn-danger" type=submit name="userDeleteSubmit" value="-" />
                    <input hidden name=row_num form="users<?php echo $user; ?>Delete" value="<?php echo $user; ?>">
                  </form>
                </td>
                <td>
                  <input form="users<?php echo $user; ?>" class="btn btn-primary submit-button" type=submit name="userUpdateSubmit" value="Save" />
                </td>
              </tr>
            <?php
            };
            ?>
          </tbody>
        </table>
      <?php
      } else {
        //Editor account section
      ?>
        <div class="col-lg-6">
          <h4>Change Password</h4>
          <form method="POST" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#aboutUsPhotos' method="POST" enctype="multipart/form-data">
            <label>Old Password</label>
            <input class="form-control" type="password" name="old_password" />
            <label>Confirm Old Password</label>
            <input class="form-control" type="password" name="confirm_old_password" />
            <label>New Password</label>
            <input class="form-control" type="password" name="new_password" />
            <br />
            <input class="form-control btn btn-primary" type="submit" name="change_password_submit" value="Submit">
          </form>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>