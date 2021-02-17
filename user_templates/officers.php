 <section id="officers" class=bg-ffablue>
   <div class="container-fluid">
     <div class="row">
       <div class="col-lg-10 mx-auto text-light my-5">
         <h2>Meet the chapter officers</h2>
         <div class="container y-5 text-dark">
           <div class="row h-100">
             <?php
              $officerArray = readArrayFromJSON("officers.json");
              //Create a table row for each contact
              for ($officer = 0; $officer <= sizeof($officerArray) - 1; $officer++) {
                $currentOfficer = $officerArray[$officer];
              ?>
               <div class="col-md-4 mx-auto d-flex">
                 <div class="card my-5 d-flex zoom d-flex">
                   <img class="card-img-top" src="images/officers/<?php echo $currentOfficer["officer_title"] . "." . $currentOfficer["officer_image_ext"]; ?>" alt="Officer Photo">
                   <div class="card-body">
                     <h3><?php echo $currentOfficer["officer_title"]; ?></h3>
                     <h5><?php echo $currentOfficer["officer_name"]; ?></h5>
                     <p class="card-text px-3"><?php echo $currentOfficer["officer_bio"]; ?></p>
                   </div>
                   <p><p>
                 </div>
               </div>
             <?php
              }
              ?>
           </div>
         </div>
       </div>
     </div>
   </div>
   </div>
 </section>