
  $('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
  });

function registerCall(){
	 $(document).ready(function(){

        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
   		 if(username == "" || password == ""){
            $('#error_message').fadeIn().html("All fields are required");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);
        }else if(username.length < 5 || password.length < 5){
        	  $('#error_message').fadeIn().html("Username and password must be minimum 5 characters");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 4000);
        }
        else{

  	      $.ajax({
          url:"register.php",
          type: "POST",
          data:{username:username, password:password},
          success:function(data){        
	    		$("form").trigger("reset");
	            $('#success_message').fadeIn().html(data);
	            setTimeout(function(){
	              $('#success_message').fadeOut('slow');
	            }, 2000);

          },
          error:function(data){
       		$("form").trigger("reset");
            $('#error_message').fadeIn().html(data);
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);

          }
      });
  	  }
   });
}

function loginCall(){
	 $(document).ready(function(){

        var username = document.getElementById('username2').value;
        var password = document.getElementById('password2').value;
        if(username == "" || password == ""){
            $('#error_message').fadeIn().html("All fields are required");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);
        }else if(username.length < 5 || password.length < 5){
        	  $('#error_message').fadeIn().html("Username and password must be minimum 5 characters");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 4000);
        }
        else{

  	      $.ajax({
          url:"login.php",
          type: "POST",
          data:{username:username, password:password},
          success:function(){        
          	window.location.replace("home.php");
          },
          error:function(data){
       		$("form").trigger("reset");
            $('#error_message').fadeIn().html("Wrong username or password");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);

          }
      });
  	     
  	      }
   });
}