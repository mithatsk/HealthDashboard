
     $(document).ready(function(){
        energyChart();
        napChart();
        sleepChart();
        walkChart();
        bedtimeChart();
        tempChart();
      });

//call al charts with function

 /* function clearCanvas(context, canvas) {
  context.clearRect(0, 0, canvas.width, canvas.height);
  var w = canvas.width;
  canvas.width = 1;
  canvas.width = w;
  }*/
  function callAll(){

   document.getElementById('bedtimeChart').innerHTML = "<table class='table table-bordered' id='myTable'><tr><th>Date</th><th>Getup time</th><th>Bed time</th></tr></table>";


  $('#energyChart').remove(); // this is my <canvas> element
  $('#energyChartContainer').append('<canvas id="energyChart"><canvas>');
  $('#walkChart').remove(); // this is my <canvas> element
  $('#walkChartContainer').append('<canvas id="walkChart"><canvas>');
  $('#napChart').remove(); // this is my <canvas> element
  $('#napChartContainer').append('<canvas id="napChart"><canvas>');
  $('#tempChart').remove(); // this is my <canvas> element
  $('#tempChartContainer').append('<canvas id="tempChart"><canvas>');
  $('#sleepChart').remove(); // this is my <canvas> element
  $('#sleepChartContainer').append('<canvas id="sleepChart"><canvas>');
        energyChart();
        napChart();
        sleepChart();
        walkChart();
        bedtimeChart();
        tempChart();
   
  }

//call all charts with function
//Datepicker
  $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.form-group form').length>0 ? $('.form-group form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
            orientation : 'top auto'
        });
    });
//Datepicker end

  function energyChart(){
        var tablename ="Run";
        var column ="energy"
  	      $.ajax({
          url:"chart.php",
          type: "POST",
          data:{tablename:tablename, column:column},
          success : function(data){
          	console.log(data);
          	var data = JSON.parse(data);
          	console.log(data);
          	var date = [];
          	var energy = [];

          	for (var i in data){
          		date.push(data[i].date);
          		energy.push(data[i].energy);

          	}

          	for(var i=0;i<5;i++)
          	{
          		console.log(energy[i]);
          	}
          	var chartdata = {
          		labels: date,
          		datasets: [
          		{
          		label: 'Calories Burned',
          		fill:false,
          		backgroundColor: "rgba(0,64,245,0.6)",
          		data: energy
          		}
          		]
          	};
          
          var ctx = document.getElementById('energyChart').getContext('2d');
			var lineGraph = new Chart(ctx,{
			type: 'bar',
			data: chartdata
      
			});
      //lineGraph.destroy();
          }

      });

    date = null;
    energy = null;

}


    function napChart(){
      var tablename ="Sleep";
        var column ="naps";
          $.ajax({
          url:"chart.php",
          type: "POST",
          data:{tablename:tablename, column:column},
          success : function(data){
            console.log(data);
            var data = JSON.parse(data);
            console.log(data);
            var date = [];
            var naps = [];

            for (var i in data){
              date.push(data[i].date);
              naps.push(data[i].naps);

            }

            var chartdata = {
              labels: date,
              datasets: [
              {
              label: 'Nap times',
              fill:false,
              backgroundColor: "rgba(0,64,245,0.6)",
              data: naps
              }
              ]
            };
          
          var ctx = document.getElementById('napChart').getContext('2d');
      var lineGraph = new Chart(ctx,{
      type: 'bar',
      data: chartdata
      
      });
     // lineGraph.destroy();
          }

      });

          date = null;
          naps = null;
}

 function sleepChart(){
        var tablename ="Sleep";
        var column ="sleeping_hours";
          $.ajax({
          url:"chart.php",
          type: "POST",
          data:{tablename:tablename, column:column},
          success : function(data){
            console.log(data);
            var data = JSON.parse(data);
            console.log(data);
            var date = [];
            var sleeping_hours = [];

            for (var i in data){
              date.push(data[i].date);
              sleeping_hours.push(data[i].sleeping_hours);

            }

            var chartdata = {
              labels: date,
              datasets: [
              {
              label: 'sleeping hours',
              fill:false,
              backgroundColor: "rgba(0,64,245,0.6)",
              data: sleeping_hours
              }
              ]
            };
          
          var ctx = document.getElementById('sleepChart').getContext('2d');
      var lineGraph = new Chart(ctx,{
      type: 'bar',
      data: chartdata
      });
     // lineGraph.destroy();
          }

      });

          date = null;
          sleeping_hours = null;
}


  function walkChart(){
        var tablename ="Run";
        var column = "walked_distance";
        var column2 = "steps";
          $.ajax({
          url:"chart.php",
          type: "POST",
          data:{tablename:tablename, column:column, column2:column2},
          success : function(data){
            console.log(data);
            var data = JSON.parse(data);
            console.log(data);
            var date = [];
            var walked_distance = [];
            var steps = [];
            for (var i in data){
              date.push(data[i].date);
              walked_distance.push(data[i].walked_distance);
              steps.push(data[i].steps);
            }

            var chartdata = {
              labels: date,
              datasets: [
              {
              label: 'Walked distance',
              fill:false,
              backgroundColor: "rgba(0,64,245,0.6)",
              data: walked_distance
              
              },
              {
              label: 'steps',
              fill:false,
              backgroundColor: "rgba(50,164,45,230.6)",
              data: steps
                
              }
              ]
            };
          
          var ctx = document.getElementById('walkChart').getContext('2d');
      var lineGraph = new Chart(ctx,{
      type: 'bar',
      data: chartdata
      });
    //  lineGraph.destroy();
          }

      });

          date = null;
          steps = null;
          walked_distance = null;
}
function bedtimeChart (){
  var tablename ="Sleep";
        var column = "bedtime";
        var column2 = "getup";
          $.ajax({
          url:"chart.php",
          type: "POST",
          data:{tablename:tablename, column:column, column2:column2},
          success : function(data){
            var data = JSON.parse(data);

            var date = [];
            var bedtime = [];
            var getup = [];
            for (var i in data){
              date.push(data[i].date);
              bedtime.push(data[i].bedtime);
              getup.push(data[i].getup);
            }

           var table = document.getElementById("myTable");
            for(var i=0; i<date.length ; i++){

              var row = table.insertRow(i+1);
              var cell1 = row.insertCell(0);
              var cell2 = row.insertCell(1);
              var cell3 = row.insertCell(2);
              console.log(date[i]);
              console.log(getup[i]);
              console.log(bedtime[i]);
              cell1.innerHTML = date[i];
              cell2.innerHTML = getup[i];
              cell3.innerHTML = bedtime[i];
       
            }
    }


     
});
}

function tempChart(){
        var tablename ="Temperature";
        var column = "out_temp";
        var column2 = "in_temp";
          $.ajax({
          url:"chart.php",
          type: "POST",
          data:{tablename:tablename, column:column, column2:column2},
          success : function(data){
            console.log(data);
            var data = JSON.parse(data);
            console.log(data);
            var date = [];
            var out_temp = [];
            var in_temp = [];
            for (var i in data){
              date.push(data[i].date);
              out_temp.push(data[i].out_temp);
              in_temp.push(data[i].in_temp);
            }

            var chartdata = {
              labels: date,
              datasets: [
              {
              label: 'Outdoor temp',
              fill:false,
              backgroundColor: "rgba(0,64,245,0.6)",
              data: out_temp
              
              },
              {
              label: 'Indoor temp',
              fill:false,
              backgroundColor: "rgba(50,164,45,230.6)",
              data: in_temp
                
              }
              ]
            };
          
          var ctx = document.getElementById('tempChart').getContext('2d');
      var lineGraph = new Chart(ctx,{
      type: 'line',
      data: chartdata
      });
     // lineGraph.destroy();
          }

      });
          date = null;
          in_temp = null;
          out_temp = null;
}

function popupdata(tablename){
  column = document.getElementById(tablename).value;
  tablename = document.getElementById(tablename).name;

  if(column == "out_temp"){
    $("form").trigger("reset");
    document.getElementById('time').style.display = "none";
    document.getElementById('entry').style.display = "inline";
    if(document.getElementById('dropdownData').options.length > 1){
    $('#dropdownData option').remove();
    }
    $('#dropdownData').append('<option disabled selected>Select one</option>');
    $('#dropdownData').append('<option value="in_temp">In temp</option>');
    $('#dropdownData').append('<option value="out_temp">Out temp</option>');
    }

  if(column == "steps"){
    $("form").trigger("reset");
    document.getElementById('time').style.display = "none";
    document.getElementById('entry').style.display = "inline";
    if(document.getElementById('dropdownData').options.length > 1){
    $('#dropdownData option').remove();
    }
    $('#dropdownData').append('<option disabled selected>Select one</option>');
    $('#dropdownData').append('<option value="steps">Steps</option>');
    $('#dropdownData').append('<option value="walked_distance">Walking distance</option>');
    }
  
  if(column == "bedtime"){
    $("form").trigger("reset");
    document.getElementById('entry').style.display = "none";
    document.getElementById('time').style.display = "inline";
      
      if(document.getElementById('dropdownData').options.length > 1){
      $('#dropdownData option').remove();
      }
   $('#dropdownData').append('<option disabled selected>Select one</option>');
   $('#dropdownData').append('<option value="bedtime">Bed time</option>');
   $('#dropdownData').append('<option value="getup">Getup time</option>');
  }
  if(column == "naps"){
    $("form").trigger("reset");
    document.getElementById('time').style.display = "none";
    document.getElementById('entry').style.display = "inline";
      if(document.getElementById('dropdownData').options.length > 1){
        $('#dropdownData option').remove();
      }
    $('#dropdownData').append('<option disabled selected>Select one</option>');
    $('#dropdownData').append('<option value="naps">Naps</option>');
  }
  if(column == "sleeping_hours"){
    $("form").trigger("reset");
    document.getElementById('time').style.display = "none";
    document.getElementById('entry').style.display = "inline";
      if(document.getElementById('dropdownData').options.length > 1){
        $('#dropdownData option').remove();
      }
    $('#dropdownData').append('<option disabled selected>Select one</option>');
    $('#dropdownData').append('<option value="sleeping_hours">Sleeping hours</option>');
  }
 /* if(column == "walked_distance"){
    $("form").trigger("reset");
    document.getElementById('time').style.display = "none";
    document.getElementById('entry').style.display = "inline";
      if(document.getElementById('dropdownData').options.length > 1){
        $('#dropdownData option').remove();
      }
    $('#dropdownData').append('<option disabled selected>Select one</option>');
    $('#dropdownData').append('<option value="walked_distance">Walking distance</option>');
  }*/
  if(column == "energy"){
    $("form").trigger("reset");
    document.getElementById('time').style.display = "none";
    document.getElementById('entry').style.display = "inline";
      if(document.getElementById('dropdownData').options.length > 1){
        $('#dropdownData option').remove();
      }
    $('#dropdownData').append('<option disabled selected>Select one</option>');
    $('#dropdownData').append('<option value="energy">Calories burned</option>');
  }


  document.getElementById('tablenamebox').value = tablename;
}

function databasecall(){
  var e = document.getElementById('dropdownData');
  var e2 = document.getElementById('processoptions');
var column = e.options[e.selectedIndex].value;
var option = e2.options[e2.selectedIndex].value;
var time = document.getElementById('time').value;
var date = document.getElementById('date').value;
var entry = document.getElementById('entry').value;

//console.log("entry: "+entry+"date: "+date+"column: "+column+"option: "+option)
  if(column == "Select one" || option == "Select one" || date == ""){
    $('#error_message').fadeIn().html("All fields are required");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);
 
  }else if(column == "in_temp" || column == "out_temp" && isNaN(entry)){
      $('#error_message').fadeIn().html("Entry has to be a number");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);
  }
  else if((column != "in_temp" && column != "out_temp") &&( isNaN(entry) || entry<0)){    
    $('#error_message').fadeIn().html("Entry has to be a positive number");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);

  }else{
    if(column == "bedtime" || column == "getup")
      { 
        tablename = document.getElementById('EditBedTime').name;
        if(option == "INSERT")
        {
          Insert(date,time,tablename,column);
        }
        if(option == "UPDATE"){
            Update(date,time,tablename,column);
        }
        if(option == "DELETE"){
            Delete(date,tablename,column);
        }   

      }
        if(column == "steps" || column == "walked_distance")
        {
          tablename = document.getElementById('EditSteps').name;
          if(option == "INSERT"){
            Insert(date,entry,tablename,column);
          }
          if(option == "UPDATE"){
            Update(date,entry,tablename,column);
          }
          if(option == "DELETE"){
            Delete(date,tablename,column);
          }     
        }
        if(column == "naps")
        {
          tablename = document.getElementById('EditNaps').name;
          if(option == "INSERT"){
            Insert(date,entry,tablename,column);
          }
          if(option == "UPDATE"){
            Update(date,entry,tablename,column);
          }
          if(option == "DELETE"){
            Delete(date,tablename,column);
          }     
  
        }
        if(column == "sleeping_hours")
        {
          tablename = document.getElementById('Edithours').name;
          if(option == "INSERT"){
            Insert(date,entry,tablename,column);
          }
          if(option == "UPDATE"){
            Update(date,entry,tablename,column);
          }
          if(option == "DELETE"){
            Delete(date,tablename,column);
          }  
           
        }
        if(column == "walked_distance")
        {
          tablename = document.getElementById('EditSteps').name;
          if(option == "INSERT"){
            Insert(date,entry,tablename,column);
         
          }
          if(option == "UPDATE"){
            Update(date,entry,tablename,column);       
          }
          if(option == "DELETE"){
            Delete(date,tablename,column);         
          }     
          
        }
        if(column == "energy")
        {
          tablename = document.getElementById('EditEnergy').name;
          if(option == "INSERT"){
            Insert(date,entry,tablename,column);
          }
          if(option == "UPDATE"){
            Update(date,entry,tablename,column);
          }
          if(option == "DELETE"){
            Delete(date,tablename,column);
          }     

        }
         if(column == "in_temp" || column == "out_temp")
        {
          tablename = document.getElementById('EditTemp').name;
          if(option == "INSERT"){
            Insert(date,entry,tablename,column);
          }
          if(option == "UPDATE"){
            Update(date,entry,tablename,column);
          }
          if(option == "DELETE"){
            Delete(date,tablename,column);
          }     

        }





  }

}

function Insert(date,text,tablename,column){
  $(document).ready(function(){
 
      if(date == '' || text == '' || tablename == '' || column == '')
      {
          $('#error_message').fadeIn().html("All fields are required");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);
      }
      else
      {
        $('#error_message').html('');
        $.ajax({
          url:"insert.php",
          method:"POST",
          data:{date:date, text:text, tablename:tablename, column:column},
          success:function(data){
            $("form").trigger("reset");
            $('#success_message').fadeIn().html(data);
            setTimeout(function(){
              $('#success_message').fadeOut('slow');
            }, 2000);

          }
        });
      }
  
  });
} 


function Update(date,text,tablename,column){
  $(document).ready(function(){
 
      if(date == '' || text == '' || tablename == '' || column == '')
      {
          $('#error_message').fadeIn().html("All fields are required");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);
      }
      else
      {
        $('#error_message').html('');
        $.ajax({
          url:"update.php",
          method:"POST",
          data:{date:date, text:text, tablename:tablename, column:column},
          success:function(data){
            $("form").trigger("reset");
            $('#success_message').fadeIn().html(data);
            setTimeout(function(){
              $('#success_message').fadeOut('slow');
            }, 2000);

          }
        });
      }
  
  });
} 

function Delete(date,tablename,column){
  $(document).ready(function(){
 
      if(date == '' || tablename == '' || column == '')
      {
          $('#error_message').fadeIn().html("All fields are required");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);
      }
      else
      {
        $('#error_message').html('');
        $.ajax({
          url:"delete.php",
          method:"POST",
          data:{date:date, tablename:tablename, column:column},
          success:function(data){
            $("form").trigger("reset");
            $('#success_message').fadeIn().html(data);
            setTimeout(function(){
              $('#success_message').fadeOut('slow');
            }, 2000);

          }
        });
      }
  
  });
} 




function settings(){
  $(document).ready(function(){

      var password = document.getElementById('password').value;
      var newpassword = document.getElementById('newpassword').value;
      var newpassword2 = document.getElementById('newpassword2').value;
      if(password == '' || newpassword == '' || newpassword2 == '' )
      {
          $('#error_message').fadeIn().html("All fields are required");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);
      }else if(newpassword != newpassword2){
        $('#error_message').fadeIn().html("You have to enter same password");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 2000);
      }
      else if(newpassword.length < 5 || newpassword2.length < 5){
            $('#error_message').fadeIn().html("Username and password must be minimum 5 characters");
            setTimeout(function(){
              $('#error_message').fadeOut('slow');
            }, 4000);
        }
      else
      {
        $('#error_message').html('');
        $.ajax({
          url:"changepass.php",
          method:"POST",
          data:{password:password, newpassword:newpassword},
          success:function(data){
            $("form").trigger("reset");
            $('#success_message').fadeIn().html(data);
            setTimeout(function(){
              $('#success_message').fadeOut('slow');
            }, 2000);

          }
        });
      }
  
  });
}



