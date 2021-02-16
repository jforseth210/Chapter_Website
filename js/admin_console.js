/*
  This function is responsible for creating a new element
  when the user clicks the new button. It does this by cloning
  the last element, and performing some modifications. I know,
  it's messy and has a lot of problems, but hopefully this
  explaination will help a bit:

  newRow() takes two arguments parentId and row.
    parentId - The id of the parent element
    row - This hasn't been implemented yet,
          but it would specifiy where to add
          the new element.

  However, most functionality is controlled by
  setting classes:

    .new-disable - Disables a button on the new element.
        The new element needs to be sent to the server
        before reordering, deletion, etc, can take place
        Therefore, disable these buttons to prevent user
        confusion.
    .fresh-id - Since we are directly cloning an elements,
        id conflicts will arise. Any element with .fresh-id
        will have addnew appended to it's id.

    .fresh-for - Changing the id breaks the "for" attribute on
        labels and other elements. This sets the
        freshFors[n] = freshIds[n]
        If there are more freshIds than freshFors, this will
        break. A quick and dirty solution is to set .fresh-for
        on previous elements that don't necessarily need it.

    .new-load-file-function - This is particularly messy.
        Basically, when the user browses for a file, loadFile()
        is called, and sets the image to that file.
        .new-load-file-function sets the id string passed to
        loadFile() to freshIds[0].

    .erasable-value - An input that should be cleared before creating
        the new function.
*/

function newRow(parentId, row) {
/*
  Since the entire site is a single page,
  we need a unique prefix for when we
  modify ids.

  These are hardcoded based on the id
  of the parent element.

  If a new section is added, a new case
  statement is required.
*/
    switch (parentId) {
        case "userTable":
            idPrefix = "user";
            break;
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

    //Find the parent element, amd make a copy of it's last child.
    var parentElement = document.getElementById(parentId);
    var newChild = parentElement.lastElementChild.cloneNode(true);

    //Automatically rename the form and submit buttons:
    newChild.getElementsByClassName("submit-button")[0].name = idPrefix + "NewSubmit";
    newChild.getElementsByClassName("submit-button")[0].id = idPrefix + "NewSubmit";
    newChild.getElementsByClassName("submit-button")[0].setAttribute("form", "new" + idPrefix + "Form");
    newChild.getElementsByClassName("submit-button")[0].value = "Save New";
    newChild.getElementsByTagName("form")[0].id = "new" + idPrefix + "Form";

   //Set the value of any row_num inputs
   var rowNumFields = newChild.getElementsByClassName("row_num");
   for (var i = 0; i < rowNumFields.length; i++) {
   var newRowNum = parentElement.children.length;
        rowNumFields[i].id = newRowNum;
    }

    //Replace all images with a generic "upload" photo.
    var images = newChild.getElementsByTagName("img");
    for (var i = 0; i < images.length; i++) {
      images[i].src = "https://www.lifewire.com/thmb/2KYEaloqH6P4xz3c9Ot2GlPLuds=/1920x1080/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg";
    }

    //Disable buttons
    var newDisable = newChild.getElementsByClassName("new-disable");
    for (var i = 0; i < newDisable.length; i++) {
         newDisable[i].disabled=true;
    }

    //Append "addnew" to an id
    var freshIds = newChild.getElementsByClassName("fresh-id");
    for (var i = 0; i < freshIds.length; i++) {
         freshIds[i].id = freshIds[i].id + "addnew";
    }

    //Append "addnew" to a for attribue.
    var freshFors = newChild.getElementsByClassName("fresh-for");
    for (var i = 0; i < freshFors.length; i++) {
          freshFors[i].setAttribute("for", freshIds[i].id);
    }

    //Modify the loadFile() function
    var newLoadFileFunctions = newChild.getElementsByClassName("new-load-file-function");
    for (var i = 0; i<newLoadFileFunctions.length; i++){
      newLoadFileFunctions[i].setAttribute("onchange", "loadFile(event,\"" + freshIds[0].id + "\")");
    }

    //Erase form inputs
    var erasableInputs = newChild.getElementsByClassName("erasable-value");
    for (var i = 0; i < erasableInputs.length; i++) {
        erasableInputs[i].value = "";
        erasableInputs[i].setAttribute("form", "new" + idPrefix + "Form");
    }

    //Create the element
    parentElement.appendChild(newChild);

}

/*
  Takes the id of an image and an onchange event
  for a file input. Sets the image src to the
  selected image.
*/
function loadFile(event, imageId){
  var image = document.getElementById(imageId);
  image.src = URL.createObjectURL(event.target.files[0]);
}

function checkIfAdminExists(id){
  userAccessLevels = document.getElementsByName("access");
  adminUserExists = false;
  for(var i = 0; i < userAccessLevels.length; i++){
    if (userAccessLevels[i].value == "admin"){
      adminUserExists = true;
    }
  }
  if (!adminUserExists){
    alert("Please give someone else admin access first!");
    document.getElementById(id).value = "admin"
  }

}
