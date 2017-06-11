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
  <span class="w3-bar-item w3-right"><body onload="startTime()">
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

      <!-- Logout button -->
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
    <a href="home.php" class="w3-bar-item w3-button w3-padding" onclick="toggle_div_back('hide1')"><i class="fa fa-plus-circle"></i>  Home</a>
    <a href="settings.php" class="w3-bar-item w3-button w3-padding" onclick="toggle_div_back('hide1')"><i class="fa fa-cog"></i>  Settings</a>

  </div>
  
    <!-- DIsplay temperature -->

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

  <div class="col-md-6 container col-md-offset-3">
    <div class="container" style="box-shadow: 10px 10px 5px #888888;
     border:1px solid;
     padding: 2%;
     border-color: blue;
     height: 80%;
     width: 80%; margin-top:10%;">
  <h3>Calculate your BMI</h3>
  <div class="col-md-6">
    <!--CONTENT-->
<?php 
  if(isset($_POST['weight']))
{
  $bmi = ($_POST["weight"] / ($_POST["height"]/100 * $_POST["height"]/100));
  $bmi = round($bmi);
  
  //Adjusting age
  if ($_POST["age"]<= 16)
  {
    $age = 16;
  }
  else if ($_POST["age"] = 17)
  {
    $age = 17;
  }
  else if ($_POST["age"] = 18)
  {
    $age = 18;
  }
  else if ($_POST["age"] <18 and $_POST["age"]>=24)
  {
    $age = 24;
  }
  else if ($_POST["age"] <24 and $_POST["age"]>=34)
  {
    $age = 34;
  }
  else if ($_POST["age"] <34 and $_POST["age"]>=44)
  {
    $age = 44;
  }
  else if ($_POST["age"] <4 and $_POST["age"]>=54)
  {
    $age = 54;
  }
  else if ($_POST["age"] <54 and $_POST["age"]>=64)
  {
    $age = 64;
  }
  else if ($_POST["age"] <64 and $_POST["age"]>=90)
  {
    $age = 90;
  }
  
  // To adapt to the BMI range
  $bmilow = $bmi-5;
  $bmihigh = $bmi+5;
  
    //male or female

  if($_POST["gender"] == "male")
  {
    $query = <<<END
    SELECT BodyCondition
    FROM bmi_men
    WHERE Age = '{$age}' and BMI BETWEEN '{$bmilow}' AND '{$bmihigh}'
END;
  }
  else if($_POST["gender"] == "female")
  {
    $query = <<<END
   SELECT BodyCondition
    FROM bmi_men
    WHERE Age = '{$age}' and BMI BETWEEN '{$bmilow}' AND '{$bmihigh}'
END;
  }

$res = $mysqli->query($query);
if($res->num_rows > 0)
{
  while($row = $res->fetch_object())
  {
    $finalres = <<<END
    {$row->BodyCondition}
END;
  }
}
if($bmihigh < 22){
  echo "You are way too thin";
}else if($bmilow > 28){
  echo "You are a bit fat";
}else if(!isset ($finalres)){
  echo "";
}
else{
  echo "You are : " . $finalres;
}

}
//Form
$content = <<<END
<form name="bmiform" action="BMI2.php" method="post" style="color:black">
<label>Enter your weight in kg:</label>
<br>
 <input type="number" name="weight" min="30" max="130"  required>
<br>
  <label>Enter your height in cm:</label>
<br>
  <input type="number" name="height" min="120" max="210" required>
<br>
<label>Are you male or female?</label>
<div class="radio">
<label>
  <input type="radio" name="gender" id="male" value="male" checked>
  Male
</label>
<label>
  <input type="radio" name="gender" id="female" value="female">
  Female
</label>
</div>

<label> Enter your Age:</label>
<br>
<input type="number" name="age" min="0" max="90" required>
<br>
<br>
      <input type="submit" value="Calculate BMI!"> 

      
</form>
<br>
    </div>
  </div>
</div>
  
END;


echo $content;
?>
</div>


 <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
    
      <div>
        <!--map-->
       <div id="mapPlaceholder"></div>
        </div>

        <div class="w3-panel">
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
<!-- Script to fetch the clock-->
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
