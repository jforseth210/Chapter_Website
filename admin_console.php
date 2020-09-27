<?php
session_start();
?>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Maintainer Tools</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <!--Swiper CSS for photo gallery-->
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/css/swiper.min.css" rel="stylesheet">-->
    <link rel="shortcut icon" href="images/emblem_favicon.png" type="image/x-icon">
</head>

<body>
    <?php
    if (!$_SESSION['valid']) {
        header("Location: https://fairfieldffa.org/login.php");
        exit();
    };
    ?>
    <?php
    if (isset($_POST['aboutUsSubmit'])) {
        $aboutUsText = $_POST['aboutUsBodyText'];
        $aboutFile = fopen("aboutUsText.txt", "w");
        fwrite($aboutFile, $aboutUsText);
        fwrite($aboutFile, "\n");
        fclose($aboutFile);
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-ffablue fixed-top" id="mainNav">
        <div class="container">
            <img src="images/emblem.png" class="mx-1" style="height:32px"></img>
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Fairfield FFA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="bg-ffablue text-white">
        <div class="container text-center">
            <h1>Administrator Tools</h1>
            <p class="lead">Tools to make updating and maintaining fairfieldffa.org a little easier.</p>
        </div>
    </header>
    <section id="about">
        <div class=container>
            <div class=row>
                <div class=col-lg-10>
                    <h2>About Fairfield FFA</h2>
                    <?php
                    $aboutFile = fopen("aboutUsText.txt", "r");
                    $aboutUsText = fread($aboutFile, filesize("aboutUsText.txt"));
                    fclose($aboutFile);
                    ?>
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <textarea class=form-control name="aboutUsBodyText" style="height:400px"><?php echo $aboutUsText; ?></textarea>
                        <input class="btn btn-primary" name="aboutUsSubmit" type=submit value=Submit>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--<section id="resource_card_creator">
        <div class=container>
            <div class=row>
                <div class=col-lg-8>

                    <h2>Resources</h2>
                    <h5>Title</h5>
                    <input class="w-25 form-control" name="title" id="rc_title" />
                    <h5>Image URL</h5>
                    <input class="w-25 form-control" name="photo_src" id="rc_photo_src" />
                    <h5>Image Alt Text</h5>
                    <p>Displays if the image fails to load. Used for screen readers and text-to-speech programs.</p>
                    <input class="w-25 form-control" name="alt_text" id="rc_alt_text" />
                    <h5>Body Text</h5>
                    <input class="w-25 form-control" name=body_text id="rc_body_text" />
                    <h5>Link</h5>
                    <input class="w-25 form-control" name="link" id="rc_link" />
                    <br />
                    <input class="btn btn-primary" name=resourceSubmit type=submit value="Generate" />
                </div>
            </div>
        </div>
    </section>
    <section id="officer_card_creator">
        <div class=container>
            <div class=row>
                <div class=col-lg-8>

                    <h2>Officer Card Creator</h2>
                    <h5>Image URL</h5>
                    <input class="w-25 form-control" name="photo_src" id="oc_photo_src" />
                    <h5>Image Alt Text</h5>
                    <p>Displays if the image fails to load. Used for screen readers and text-to-speech programs.</p>
                    <input class="w-25 form-control" name="alt_text" id="oc_alt_text" />
                    <h5>Office</h5>
                    <input class="w-25 form-control" name="office" id="oc_office" />
                    <h5>Name</h5>
                    <input class="w-25 form-control" name="name" id="oc_name" />
                    <h5>Body Text</h5>
                    <input class="w-25 form-control" name=body_text id="oc_body_text" />
                    <br />
                    <button class="btn btn-primary" onclick="generate_officer_card()">Generate</button>
                </div>
            </div>
        </div>
    </section>
    <section id="officer_card_creator">
        <div class=container>
            <div class=row>
                <div class=col-lg-8>

                    <h2>Photo Gallery Updater</h2>
                    <h5>Image URL</h5>
                    <input class="w-25 form-control" name="photo_src" id="gallery_src" />
                    <small>You can also add multiple images, separated by commas: 
                    <br/>(images/chapter_photos/chapterphoto1.jpg,images/chapterphotos/chapterphoto2.jpg)</small>
                    <br/>
                    <button class="btn btn-primary" onclick="generate_photo_gallery_code()">Generate</button>
                </div>
            </div>
        </div>
    </section>  
    <section id="gallery_slide_generator">
        <div class=container>
            <div class=row>
                <div class=col-lg-8>

                    <h2>Gallery Slide Generator</h2>
                    <h5>Image URL</h5>
                    <input class="w-25 form-control" name="photo_src" id="gallery_src_2" />
                    <small>You can also add multiple images, separated by commas: 
                    <br/>(images/chapter_photos/chapterphoto1.jpg,images/chapterphotos/chapterphoto2.jpg)</small>
                    <br/>
                    <button class="btn btn-primary" onclick="generate_photo_gallery_code_2()">Generate</button>
                </div>
            </div>
        </div>
    </section>-->
    <?php
    $contactTypeConversion = array(
        "Phone Number" => "tel:",
        "Email" => "mailto:",
        "Link" => "https://"
    );
    if (isset($_POST['contactInfoUpdateSubmit'])) {
        //Get the row number of the contact being modified
        $index = intVal($_POST['row_num']);
        //Get contact information
        $contactName = $_POST['contactName'];
        $contactType = $_POST['contactType'];
        $contactInfo = $_POST['contactInfo'];
        //Convert human-readable to proper href
        //Ex: Phone Number => tel:
        $contactType = $contactTypeConversion[$contactType];
        //Prevent https://https:// if user enters it. 
        $contactInfo = str_replace("https://", "", $contactInfo);

        //Read original contact information
        $contactFile = fopen("contactInfoText.txt", "r");
        $contactText = fread($contactFile, filesize("contactInfoText.txt"));
        fclose($contactFile);
        //Split contact file by line
        $contactArray = explode("\n", $contactText);
        //Open the file for writing
        $contactFile = fopen("contactInfoText.txt", "w");
        $fwstring = "";
        //Iterate through the rows, update the one the that the user modified.
        for ($contact = 0; $contact <= sizeof($contactArray) - 1; $contact++) {
            if ($contact == $index) {
                $fwstring = $fwstring . $contactName . "|" . $contactType . "|" . $contactInfo . "\n";
            } else {
                $fwstring = $fwstring . $contactArray[$contact] . "\n";
            }
        }
        
        //If this line is uncommented, the final line
        //becomes truncated intermittently. 
        //If it is commented, the file will grow in size
        //on every update. 
        
        //$fwstring = str_replace("\n\n", "\n", $fwstring);
        
        //Write and close the file.
        fwrite($contactFile, $fwstring);
        fclose($contactFile);
    }
    ?>
    <section id="contact">
        <div class=container>
            <div class=row>
                <div class=col-lg-11>
                    <h2>Contact</h2>
                    <small>Please refresh the page after updating contact info.</small>
                    <table class='table' id="contactTable">
                        <tr>
                            <th>Name:</th>
                            <th>Type:</th>
                            <th>Contact:</th>
                            <th>Add/Remove</th>
                            <th>Update</th>
                            <tr />
                            <?php
                            //Read the contacts
                            $contactFile = fopen("contactInfoText.txt", "r");
                            $contactText = fread($contactFile, filesize("contactInfoText.txt"));
                            fclose($contactFile);
                            //Split the contacts by row.
                            $contactArray = explode("\n", $contactText);
                            //Create a table row for each contact
                            for ($contact = 0; $contact <= sizeof($contactArray) - 1; $contact++) {
                                $currentContact = $contactArray[$contact];
                                //Ignore empty lines
                                if ($currentContact != "") {
                                    //Create the start of the row, which is also a form.
                                    echo "<form role='form' id=\"$contact\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\"POST\"><tr>";
                                    $currentContactArray = explode("|", $currentContact);

                                    $optionsArray = array("Phone Number", "Email", "Link");
                                    echo "
                                    <td>
                                        <input form=\"$contact\" name=\"contactName\" class=\"form-control\" value=\"$currentContactArray[0]\" />
                                    </td>
                                    <td>
                                        <select form=\"$contact\" name=\"contactType\">
                                ";
                                    for ($option = 0; $option <= sizeof($optionsArray) - 1; $option++) {
                                        if ($contactTypeConversion[$optionsArray[$option]] == $currentContactArray[1]) {
                                            echo "<option selected>{$optionsArray[$option]}</option>";
                                        } else {
                                            echo "<option>{$optionsArray[$option]}</option>";
                                        };
                                    }
                                    echo "
                            </select>
                            </td>
                            <td>
                                <input name=\"contactInfo\" form=\"$contact\"class=\"form-control\" value=\"{$currentContactArray[2]}\" />
                            </td>
                                <td>
                                    <button type=\"button\" class=\"btn btn-success\" onclick=\"newContactRow($contact);\">+</button>
                                    <button type=\"button\" class=\"btn btn-danger\">-</button>
                                </td>
                                <input hidden name=row_num form=\"$contact\" value=\"$contact\">
                                <td>
                                    <input class=\"btn btn-primary\" type=submit name=\"contactInfoUpdateSubmit\" id=\"contactInfoUpdateSubmit\" value=\"Update\"/>
                                </td>";
                                    echo "</tr></form>
                                ";
                                };
                            };
                            ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div id="snippet_modal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Paste this code into index.html:</h6>
                    <div id=snippet></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script>
        function newContactRow(row){

            let temp = document.createElement('template');
            temp.innerHTML = `<tr><form role='form' action='' method="POST">
                                    <td>
                                        <input form="" name="" class="form-control" value="" />
                                    </td>
                                    <td>
                                        <select form="$contact" name="contactType">
                                <option selected></option><option></option>
                            </select>
                            </td>
                            <td>
                                <input name="contactInfo" form=""class="form-control" value="" />
                            </td>
                                <td>
                                    <button class="btn btn-success" onclick="newContactRow();">+</button>
                                    <button class="btn btn-danger">-</button>
                                </td>
                                <input hidden name=row_num form="$contact" value="$contact">
                                <td>
                                    <input class="btn btn-primary" type=submit name="contactInfoUpdateSubmit" id="contactInfoUpdateSubmit" value="Update"/>
                                </td></form></tr>`;
                                var contactTable = document.getElementById("contactTable");
            contactTable.children[0].insertBefore(temp.content.firstChild,contactTable.children[0].childNodes[row+3]);
    
        }
        function generate_resource_card() {
            var title = document.getElementById("rc_title").value;
            var photo_src = document.getElementById("rc_photo_src").value;
            var link = document.getElementById("rc_link").value;
            var body_text = document.getElementById("rc_body_text").value;
            var alt_text = document.getElementById("rc_alt_text").value;
            var resource_card_template_string = `\
            <div class="col-md-4 mx-auto my-5 d-flex">
                <div class="card zoom d-flex">
                <img class="card-img-top" src="${photo_src}" alt="${alt_text}">
                <div class="d-flex flex-column">
                    <h3><a class="card-title px-3" href="${link}">${title}</a></h3>
                    <p class="card-text px-3">${body_text}</p><br />
                </div>
                <a href="${link}" class="mt-auto mx-auto w-75 btn btn-primary">Open ${title}</a>
                <p></p>
                </div>
            </div>\
            `;
            text = document.createTextNode(resource_card_template_string);
            document.getElementById("snippet").appendChild(text)
            $('#snippet_modal').modal();
        }

        function generate_officer_card() {
            var office = document.getElementById("oc_office").value;
            var photo_src = document.getElementById("oc_photo_src").value;
            var name = document.getElementById("oc_name").value;
            var bio = document.getElementById("oc_body_text").value;
            var alt_text = document.getElementById("oc_alt_text").value;
            var resource_card_template_string = `\              
            <div class="col-md-4 mx-auto d-flex">
                <div class="card my-5 d-flex zoom d-flex">
                  <img class="card-img-top" src="${photo_src}" alt="${alt_text}">
                  <div class="card-body">
                    <h3>${office}:</h3>
                    <h5>${name}</h5>
                    <p class="card-text px-3">${bio}</p>
                  </div>
                  <p></p>
                </div>
              </div>\
            `;
            text = document.createTextNode(resource_card_template_string);
            document.getElementById("snippet").appendChild(text);
            $('#snippet_modal').modal();
        }

        function generate_photo_gallery_code() {
            var url = document.getElementById("gallery_src").value;
            var urls = url.split(',');
            var template_string;
            var normal_snippet = "";
            var fullscreen_snippet = "";
            for (var i = 0; i < urls.length; i++) {
                url = urls[i]
                template_string_normal = `\
                <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="${url}">
                    </div>
                  </div>\
                `
                template_string_fullscreen = `\
                <div class="swiper-slide">
                    <div class="swiper-zoom-container">
                      <img src="${url}" draggable="false"
                        ondragstart="return false;">
                    </div>\
                `
                normal_snippet = normal_snippet + "\n" + template_string_normal;
                fullscreen_snippet = fullscreen_snippet + "\n" + template_string_fullscreen;
            }
            text = document.createTextNode(normal_snippet);
            fs_text = document.createTextNode(fullscreen_snippet);
            document.getElementById("snippet").innerHTML = "";
            document.getElementById("snippet").appendChild(document.createTextNode("Regular Swiper Slide:"));
            document.getElementById("snippet").appendChild(document.createElement("BR"));
            document.getElementById("snippet").appendChild(document.createElement("H6"));
            document.getElementById("snippet").appendChild(text);
            document.getElementById("snippet").appendChild(document.createElement("BR"));
            document.getElementById("snippet").appendChild(document.createTextNode("Fullscreen Swiper Slide:"));
            document.getElementById("snippet").appendChild(document.createElement("BR"));
            document.getElementById("snippet").appendChild(document.createElement("BR"));
            document.getElementById("snippet").appendChild(fs_text);
            $('#snippet_modal').modal();
        }

        function generate_photo_gallery_code_2() {
            var url = document.getElementById("gallery_src_2").value;
            var urls = url.split(',');
            var template_string;
            var normal_snippet = "";
            var fullscreen_snippet = "";
            for (var i = 0; i < urls.length; i++) {
                url = urls[i]
                template_string_normal = `\
                <div class="carousel-item">
                    <img class="mx-auto d-block" src="${url}"
                      style="max-height: 60vh !important;" alt="First slide">
                  </div>\
                `
                normal_snippet = normal_snippet + "\n" + template_string_normal;
            }
            text = document.createTextNode(normal_snippet);
            document.getElementById("snippet").innerHTML = "";
            document.getElementById("snippet").appendChild(document.createTextNode("Code for About Us Image Gallery:"));
            document.getElementById("snippet").appendChild(document.createElement("BR"));
            document.getElementById("snippet").appendChild(text);
            $('#snippet_modal').modal();
        }
    </script>
</body>

</html>
