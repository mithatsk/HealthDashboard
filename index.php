<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <!-- <meta http-equiv="refresh" content="0; url=home.html" /> -->
  <title>Login form</title>
  <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:300,200' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="css/style.css">


</head>

<body>

<div class="login-page">
  <div class="form">
    <form class="register-form">
      <input id="username" type="text" name="username" placeholder="name" required/>
      <input id="password" type="password" name="password" placeholder="password" required/>
      <button type="button" onclick="registerCall();"> Create </button>
      <p class="message">Already registered? <a href="#">Sign In</a></p><br/>
    
    </form>
    <form class="login-form">
      <input id="username2" type="text" name="username" placeholder="username" required/>
      <input id="password2" type="password" name="password" placeholder="password" required />
      <button type="button" onclick="loginCall();"> Login </button>
      <p class="message">Not registered? <a href="#">Create an account</a></p><br>
    </form>
      <p style="font-family: Arial;" id="error_message"></p>
      <p style="font-family: Arial;" id="success_message"></p>
  </div>
</div>

  
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>


</body>
</html>
