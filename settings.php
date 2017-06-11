<!DOCTYPE html>
<html>
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

html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
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
  
  <span class="w3-bar-item w3-right"> 
  
  </div

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
   <a href="home.php" class="w3-bar-item w3-button w3-padding" ><i class="fa fa-plus-circle"></i>  Home</a>
     <a href="BMI2.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-plus-circle"></i>  BMI Calculator</a>
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

<style type="text/css">
  #settingsdiv {
     box-shadow: 10px 10px 5px #888888;
     border:1px solid;
     padding: 1%;
     border-color: blue;
     height: 60%;
     width: 80%;
}
</style>
   <div class="row">
   <div id="settingsdiv" style="margin-left: 10%;">
   <div class="col-md-6 col-md-offset-4" style="padding: 20% 0 ;">
   <form>
     Enter your password : <input type="password" id="password" name="password" placeholder="Old password"> <br/><br/>
     Enter new password : <input type="password" id="newpassword" name="newpassword" placeholder="New password"> <br/><br/>
     Enter new password : <input type="password" id="newpassword2" placeholder="New password"> <br/><br/>
    
     <input type="button" class="btn btn-primary col-md-5 col-md-offset-1" onclick="settings();" value="Submit">

     <div class="col-md-6 col-md-offset-1" >
     <p id="success_message"></p>
     <p id="error_message"></p>
    </div>
   </form>
   </div>
   </div>
  </div>




 

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">

    <p style="font-size: 10px;">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>
</body>

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
