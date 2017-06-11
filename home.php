<!DOCTYPE html>
<html>
<head>
<title>Health Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/myscript.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>





<style>

    #mapPlaceholder {
        height: 300px;
        width: 400px;
      }
/*html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}*/
 
  .shadowdiv {
    box-shadow: 7px 7px 5px #888888;
    border: 1px solid;
    padding: 1%;
    border-color: blue;
  }

</style>
</head>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <!-- CLOCK -->
  <span class="w3-bar-item w3-right"> 
  <body onload="startTime()">
  <div style="color: green; font-size: 1.3em;" id="txt"></div>
  </span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="img/logo.png" class="w3-circle w3-margin-right" alt="Logo of a heart" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
    <?php
    include('dbconnection.php');
    if(empty($_SESSION['username'])){
      header('location: index.php');
    }

     echo "<span>Welcome, <strong>{$_SESSION['username']}</strong></span><br>";
      ?>
      <a href="logout.php" class="w2-bar-item w3-button"><i class="fa fa-sign-out">Logout</i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>

    <!-- Buttons for toggling charts back below -->
    <a href="home.php" class="w3-bar-item w3-button w3-padding" ><i class="fa fa-plus-circle"></i>  Home</a>
     
      <a href="#" class="w3-bar-item w3-button w3-padding" onclick="toggle_div_back('hide1')"><i class="fa fa-plus-circle"></i>  Bedtime</a>
       <a href="#" class="w3-bar-item w3-button w3-padding" onclick="toggle_div_back('hide2')"><i class="fa fa-plus-circle"></i>  Energy Expedenture</a>
        <a href="#" class="w3-bar-item w3-button w3-padding" onclick="toggle_div_back('hide3')"><i class="fa fa-plus-circle"></i>  Naps per day</a>
         <a href="#" class="w3-bar-item w3-button w3-padding" onclick="toggle_div_back('hide4')"><i class="fa fa-plus-circle"></i>  Hours Slept</a>
          <a href="#" class="w3-bar-item w3-button w3-padding" onclick="toggle_div_back('hide5')"><i class="fa fa-plus-circle"></i>  Walkings</a>
           <a href="#" class="w3-bar-item w3-button w3-padding" onclick="toggle_div_back('hide6')"><i class="fa fa-plus-circle"></i>  Temperatures</a>
             <a href="BMI2.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-plus-circle"></i>  BMI Calculator</a>
              <a href="settings.php" class="w3-bar-item w3-button w3-padding" ><i class="fa fa-cog "></i>  Settings</a>

  </div>
  
  

      <div class="w3-panel w3-teal w3-padding-16" style="height:auto;">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
         <?php 
              $jsonurl = "http://api.openweathermap.org/data/2.5/group?id=2708365&units=metric&appid=c65b11d5826529cbef75c3353bd0374a";
              $json = file_get_contents($jsonurl);

              $weather = json_decode($json);
    
            $celcius = $weather->list[0]->main->temp;
          echo "<h1>{$celcius} °C</h1>";
          echo "<script>console.log({$celcius});</script>";
        ?> 
        </div>
      </div>

  </div>

</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Health Dashboard</b></h5>
  </header>

   <div class="row" style="margin:3% 0;">
   
   
   <!-- chart 1 -->

  <div class="col-md-5 container" id="hide1" style="box-shadow: 7px 7px 5px #888888;
    border: 1px solid;
    padding: 1%;
    border-color: blue;
    ">
   <button class="fa fa-minus-circle" style="float: right;" onclick="toggle_div('hide1')"></button>
    <div class="container" style="width: 80%; margin: 15px auto;">
  <h3>Bedtime</h3>
  <div id="bedtimeChart">
    
      <table class="table table-bordered" id="myTable">
      <tr>
      <th>Date</th>
      <th>Getup time</th>
      <th>Bed time</th>
    </tr>
  </table>
   
  </div>
   <div class="row" style="margin-left: 5%; margin-top: 5%;">
     <button data-toggle="modal" id="EditBedTime" name="Sleep" value="bedtime" onclick="popupdata('EditBedTime');" data-target="#squarespaceModal"  class="btn btn-primary center-block">EditBedTime</button>
</div>
 <br/><!-- pop up button -->

   <!-- <button data-toggle="modal" id="EditDistance" name="Run" value="walked_distance" onclick="popupdata('EditDistance');" data-target="#squarespaceModal"  class="btn btn-primary center-block">EditDistance</button>
-->
</div>



<!-- popup -->

<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      
      <h3 class="modal-title" id="lineModalLabel">Enter values</h3>
    </div>
    <div class="modal-body">
      
            <!-- content goes here -->
      <form action="home.php">
      <div class="form-group">
      <input style="display:none;" type="text" id="tablenamebox" value="">

            <select id="dropdownData"><!-- keeps the column to be edited -->
              <!--  <option disabled selected>Select one</option> -->
                <!-- OPTIONS HERE (They are added on the popupdata() function )-->
            </select>

              <select id="processoptions">
                <option disabled selected>Select one</option>
        <option value="INSERT">Insert</option>
        <option value="UPDATE">Update</option>
        <option value="DELETE">Delete</option>
           </select>
          
     
            </div>
      
                 <div class="form-group">
                <input  id="date" name="date" placeholder="yyyy-mm-dd" type="text" size="8"  readonly/>
                <input id="time" type="time" step='1' min="00:00:00" max="23:59:59" name="time" placeholder="Select time" style="display: none;">
                <input id="entry" type="text" /> 
              </div>


              <button type="button" onclick="databasecall();" class="btn btn-default">Submit</button>
                  <p id="error_message"></p>
            <p id="success_message"></p>
            </form>



           

           

    </div>
    <div class="modal-footer">
      <div class="btn-group btn-group-justified" role="group" aria-label="group button">
        <div class="btn-group" role="group">
          <button type="button" class="btn btn-default" onclick="callAll();" data-dismiss="modal"  role="button">Close</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

<!-- Pop up end -->

<!-- pop up script -->


<!-- Update Form -->



<!-- -->

  </div>

  
  <!--chart 2-->
  <div class="col-md-5 container" id="hide2" style="box-shadow: 7px 7px 5px #888888;
    border: 1px solid;
    padding: 1%;
    border-color: blue;
    ">
  <button class="fa fa-minus-circle" style="float: right;" onclick="toggle_div('hide2')"></button>
  <div class="container" style="width: 80%; margin: 15px auto;">
  <h3>Energy Expedenture</h3>
  <div id="energyChartContainer">
    <canvas id="energyChart"></canvas>
  </div> 
 <div class="row" style="margin-left: 5%; margin-top: 5%;">
    <button data-toggle="modal" id="EditEnergy" name="Run" value="energy" onclick="popupdata('EditEnergy');" data-target="#squarespaceModal"  class="btn btn-primary center-block">EditEnergy</button>
</div>
</div>

  </div>
  </div>


  <!--chart 3-->
     <div class="row" style="margin:3% 0;">
    <div class="col-md-5 container" id="hide3" style="box-shadow: 7px 7px 5px #888888;
    border: 1px solid;
    padding: 1%;
    border-color: blue;">
    <button class="fa fa-minus-circle" style="float: right;" onclick="toggle_div('hide3')"></button>
<div class="container" style="width: 80%; margin: 15px auto;">
  <h3>Naps per day</h3>
  <div id="napChartContainer">
    <canvas id="napChart"></canvas>
  </div>
  <button data-toggle="modal" id="EditNaps" name="Sleep" value="naps" onclick="popupdata('EditNaps');" data-target="#squarespaceModal"  class="btn btn-primary center-block">EditNaps</button>
</div>

  </div>
  
  
<!-- end of row -->

<!-- new row-->
 
  
    <!--chart 4-->
       <div class="col-md-5 container" id="hide4" style="box-shadow: 7px 7px 5px #888888;
    border: 1px solid;
    padding: 1%;
    border-color: blue;
    ">
       <button class="fa fa-minus-circle" style="float: right;" onclick="toggle_div('hide4')"></button>
  
<div class="container" style="width: 80%; margin: 15px auto;">
  <h3>Hours slept</h3>
  <div id="sleepChartContainer">
    <canvas id="sleepChart"></canvas>
  </div>
  <div class="row" style="margin-left: 5%; margin-top: 5%;">   
   <button data-toggle="modal" id="Edithours" name="Sleep" value="sleeping_hours" onclick="popupdata('Edithours');" data-target="#squarespaceModal"  class="btn btn-primary center-block">Edithours</button>

</div>
</div>

    </div>
</div> 
    <!--chart 5-->
         <div class="row" style="margin:3% 0;">
  <div class="col-md-5 container" id="hide5" style="box-shadow: 7px 7px 5px #888888;
    border: 1px solid;
    padding: 1%;
    border-color: blue;
    ">
  <button class="fa fa-minus-circle" style="float: right;" onclick="toggle_div('hide5')"></button>
  
  <div class="container" style="width: 80%; margin: 15px auto;">
  <h3>Walking</h3>
  <div id="walkChartContainer">
    <canvas id="walkChart"></canvas>
    </div>
     <div class="row" style="margin-left: 5%; margin-top: 5%;"> 
    <button data-toggle="modal" id="EditSteps" name="Run" value="steps" onclick="popupdata('EditSteps');" data-target="#squarespaceModal"  class="btn btn-primary center-block">EditWalking</button>
  </div>
</div>
</div>

<!-- Chart 6 -->

  <div class="col-md-5 container" id="hide6" style="box-shadow: 7px 7px 5px #888888;
    border: 1px solid;
    padding: 1%;
    border-color: blue;
    ">
  <button class="fa fa-minus-circle" style="float: right;" onclick="toggle_div('hide6')"></button>
  
  <div class="container" style="width: 80%; margin: 15px auto;">
  <h3>Temperatures</h3>
  <div id="tempChartContainer">
    <canvas id="tempChart"></canvas>
    </div>
     <div class="row" style="margin-left: 5%; margin-top: 5%;"> 
    <button data-toggle="modal" id="EditTemp" name="Temperature" value="out_temp" onclick="popupdata('EditTemp');" data-target="#squarespaceModal"  class="btn btn-primary center-block">EditTemp</button>
  </div>
</div>
</div>
</div>

<!--end of charts-->

<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">

    <!-- Form code begins -->
    
     <!-- Form code ends --> 

    </div>
  </div>    
 </div>
</div>


 <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
    
      <div>
        <!--map-->
       <div id="mapPlaceholder"></div>
        </div>

  <div class="w3-panel">
   
      <!--<div class="w3-third">
     <div class="w3-row-padding" style="margin-top: 47px;">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
         <?php 
              $jsonurl = "http://api.openweathermap.org/data/2.5/group?id=2708365&units=metric&appid=c65b11d5826529cbef75c3353bd0374a";
              $json = file_get_contents($jsonurl);

              $weather = json_decode($json);
    
            $celcius = $weather->list[0]->main->temp;
          echo "<h1>{$celcius} °C</h1>";
          echo "<script>console.log({$celcius});</script>";
?> 
      
        </div>

        <div class="w3-clear"></div>
        <h4>Temperature overview</h4>
      </div>
  -->
  
      </div>
  
      </div>
     
  </div>

<div class="row">
  <!-- Footer -->
 <br>

  <footer class="w3-container w3-padding-16 w3-light-grey">
  <hr>
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>
</div>

  <!-- End page content -->
</div>
<!--
<script type="text/javascript">
  
  $(document).ready(function(){

      $.ajax({
        url:"http://api.openweathermap.org/data/2.5/group?id=2708365&units=metric&appid=c65b11d5826529cbef75c3353bd0374a",
        type:"GET",
        dataType:"jsonp",
        success: function(data){
          console.log(data);
        }
      });

  });
</script>
      <!-- call to chart functions -->


<!-- 

        <script src="http://maps.google.com/maps/api/js?sensor=false">
        </script>
        <script>
            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(showCurrentLocation);
            }
            else
            {
               alert("Geolocation API not supported.");
            }

            function showCurrentLocation(position)
            {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                var coords = new google.maps.LatLng(latitude, longitude);

                var mapOptions = {
                zoom: 15,
                center: coords,
                mapTypeControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            //create the map, and place it in the HTML map div
            map = new google.maps.Map(
            document.getElementById("mapPlaceholder"), mapOptions
            );

            //place the initial marker
            var marker = new google.maps.Marker({
            position: coords,
            map: map,
            title: "Current location!"
            });
            }
        </script>-->

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}


</script>

<script type="text/javascript">
 //hide Div
  function toggle_div(id){

  var divelement = document.getElementById(id);

  if (divelement.style.display == 'none')
      divelement.style.display = 'block';
    else
      divelement.style.display = 'none';
}

</script>
<script type="text/javascript">
  function toggle_div_back(id){

  var divelement = document.getElementById(id);

  if (divelement.style.display == 'block')
      divelement.style.display = 'none';
    else
      divelement.style.display = 'block';
}
</script>
<script type="text/javascript">
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>

</body>
</html>
