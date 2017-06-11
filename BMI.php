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
  <span class="w3-bar-item w3-right">Logo</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
    <?php
    include('dbconnection.php');
    //if(empty($_SESSION['username'])){
    //  header('location: index.php');
    //}

     echo "<span>Welcome, <strong>{$_SESSION['username']}</strong></span><br>";
      ?>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
      <a href="logout.php" class="w2-bar-item w3-button"><i class="fa fa-user"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    
    <a href="home.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Home</a><br><br>
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
  <div class="col-md-6 container">
    <div class="container" style="width: 80%; margin: 15px auto;">
  <h3>Calculate your BMI</h3>
  <div>
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
	
	$bmilow = $bmi-5;
	$bmihigh = $bmi+5;
	
		
	
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
		FROM bmi_women
		WHERE Age = '{$age}' and BMI BETWEEN '{$bmilow}' AND  '{$bmihigh}'
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

echo "You are : " . $finalres;

}
$content = <<<END
<form name="bmiform" action="BMI.php" method="post" style="color:black">
			  <label>Enter your weight in kg:</label>
			  <br>
             <input type="text" name="weight" placeholder="Weight [kg]" required>
				<br>
              <label>Enter your height in cm:</label>
			  <br>
              <input type="text" name="height" placeholder="Height [cm]" required>
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
			
			<label> Enter your Age</label>
			<br>
			<input type="text" name="age" placeholder="Age" required>  
			<br>
              <input type="submit" value="Calculate BMI!">
              
			  </form>
            </div>
          </div>
        </div>
	
END;


echo $content;
?>
  </div>
   <div class="row" style="margin-left: 5%; margin-top: 5%;">
</div>
 <br/>
 


</div>





  
<!--end of content-->



 

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>

  <!-- End page content -->
</div>

      <!-- call to chart functions -->

      <script>
        $(document).ready(function(){
        energyChart();
        napChart();
        sleepChart();
        walkChart();
        bedtimeChart();
         });
     </script>


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

</body>
</html>
