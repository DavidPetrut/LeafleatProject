<?php
$filename = 'countryBorders.geo.json';
$data = file_get_contents($filename);
$countryBorders = new RecursiveIteratorIterator(
new RecursiveArrayIterator(json_decode($data, TRUE)),
RecursiveIteratorIterator::SELF_FIRST);
?>

<html>
   <head>
      <title>Gazetteer</title>
      <meta name='viewport' content='width=device-width, user-scalable=no initial-scale=1, maximum-scale=1'>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css/leaflet.css" />
      <link rel="stylesheet" href="css/L.Control.OpenCageSearch.dev.css" />
      <link rel="stylesheet" href="css/style.css" />      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <a class="navbar-brand" href="#">Gazetteer</a>
         <div class="collapse navbar-collapse custom-nav-bar" id="navbarSupportedContent">
           <ul class="navbar-nav mr-auto">
             <li class="nav-item dropdown country-dropdown-custom">
               <select id="country" >
               <option value="">Select Country</option>
               <?php foreach ($countryBorders as $key => $val) {
                    if(!is_array($val)) {
                        if($key === "name") {?>
                          <option value=<?= $val; ?>><?= $val; ?></option>
                          <?php }
                        }
                      } 
                ?>
              </select>
             </li>
           </ul>
         </div>
       </nav>
      <div id="map"></div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Country Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="results"></div>
            <div class="weather details">
              <div class="icon"></div>
              <div class="temp"></div>
              <div class="weather"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
   </body>    
   <script src="js/leaflet.js"></script>
   <script src="js/L.Control.OpenCageSearch.dev.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   <script src="js/script.js"></script>
   </html>
