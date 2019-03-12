<!-- the html wrapper for p5.js sketch -->
<!-- the main sketch is written is sketch.js  -->
<!--Used the instructions and supporting files from: https://medium.com/@yyyyyyyuan/tutorial-serial-communication-with-arduino-and-p5-js-cd39b3ac10ce-->

<?php
if(isset($_POST['submit'])) {
  //print_r($_POST);
    //$file = "experiments.json";
  //  $json_string = json_encode($_POST, JSON_PRETTY_PRINT);
 //   file_put_contents($file, $json_string, FILE_APPEND);

    $additionalArray = array(
    'trial' => $_POST['trial'],
    'coils' => $_POST['coils'],
    'current' => $_POST['current'],
    'paperclips' => $_POST['paperclip']
  );
    //open or read json data
$data_results = file_get_contents('experiments.json');
$tempArray = json_decode($data_results);

//append additional json to json file
$tempArray[] = $additionalArray ;
$jsonData = json_encode($tempArray);

file_put_contents('experiments.json', $jsonData);   

  }
?>
<!DOCTYPE html><html><head>
   <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!--My CSS-->
    <link rel="stylesheet" href="css/style.css" crossorigin="anonymous">
<!--Serial connection-->
    <script src ="js/jquery-3.3.1.min.js"></script>
    <script src="js/p5.min.js"></script>
    <script src="js/p5.dom.min.js"></script>
    <script src="js/p5.sound.min.js"></script>
    <script src="js/p5.serialport.js"></script>
    <title>ElectroCrane</title>
<style>
 body{
  background: #FFF;
 } 

 #var{
  background: #FFDC00;
  border-right: 4px solid #BBA202;
      padding-right: 35px;
    padding-left: 35px;
        min-height: 100vh;
        position: fixed;

 }
 #current,#mf {
    display: inline;
}



.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #262525;
    background: #fff;
    padding: 10px;
    border-radius: 12px;
    border: 0px;
        font-size: 12pt;
}

h4{
  text-transform: uppercase;
  font-size: 18px;
  font-weight: 700;
 line-height: 32px;
 color: #252004;
}

label{
 font-weight: bold;
line-height: 24px;
font-size: 18px;
color: #6A6224;
}

input.form-control{
background: rgba(255, 255, 255, 1);
border-radius: 5px;
}


#track,
#track:hover,
#track:focus {
    width: 180px;
    padding: 10px;
    font-size: 15px;
    text-transform: uppercase;
    font-weight: 600;
    background-color: #2196F3;
    border: 1px solid #2295f3;
    box-shadow: -6px 0px 0px #165f9a, -6px 6px 0px #165f9a, -6px 12px 0px #165f9a, 0px 12px 0px #165f9a;
    border-radius: 0px;
    color: #fff;
    cursor: pointer;
    margin: 0 auto;
    text-align: center;
    width: 96%;
        margin-left: 7px;
        margin-top:5px;

}

a#track:active {
    box-shadow: none;
    transition: 0.1s;
    margin-left: -6px;
    margin-bottom: -6px;
    width: 186px;
    padding: 16px;
}

.ins {
    padding-top: 19px;
    padding-bottom: 40px;
}

    #insa,
#insa:hover,
#insa:focus {
      width: 50px;
    padding: 9px;
    font-size: 20px;
    text-transform: uppercase;
    font-weight: 600;
     background-color: #e84444;
    border: 1px solid #e84444;
    box-shadow: -6px 0px 0px #922b2b, -6px 6px 0px #922b2b, -6px 12px 0px #922b2b, 0px 12px 0px #922b2b;
    border-radius: 0px;
    color: #fff;
    cursor: pointer;
}
    

a#insa:active {
    box-shadow: none;
    transition: 0.1s;
    margin-left: -6px;
    margin-bottom: -6px;
    width: 186px;
    padding: 16px;
}

#tracking{
  background: rgba(253, 235, 85, 0.1);
border: 1px solid rgba(196, 196, 196, 0.5);
box-sizing: border-box;
border-radius: 5px;
font-size: 18px;
color:#786e25;
}

#not-tracking{
  background: rgba(227, 90, 90, 0.1);
border: 1px solid rgba(196, 196, 196, 0.5);
box-sizing: border-box;
border-radius: 5px;
line-height: 28px;
font-size: 18px;
}

.system-status{
  width:30px;
      margin-top: -15px;
}
div#resy {
    padding-top: 15px;
}

th{
  background: #2196F3;
  color:#fff;
  font-weight: 600;
line-height: normal;
font-size: 14px;
color: #FFFFFF;
border-bottom: 5px solid #135E9A;
}
.col-9 {
    margin-left: 30%;
}
</style>
  </head>
  <body>

<div class="container-fluid">
  <div class="row">
    <div id="var" class="col-3 cont">
          <div class="ins">
      <button id="insa">?</button>
    </div>
        <h4 class="secs">Experiment Variables</h4>
        <div class="row">
            <div class="col-12">
                <form method="post" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">Trial</label>
    <input type="text" class="form-control" name="trial" aria-describedby="emailHelp" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Coils</label>
    <input type="text" class="form-control" name="coils" aria-describedby="emailHelp" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Current</label>
    <input type="text" class="form-control" name="current" placeholder="">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Paperclips</label>
    <input type="text" class="form-control" name="paperclip" placeholder="">
  </div>
              <input id="track" type="submit" name="submit" id="submit" action="">
</form>
            </div>
        </div>

    </div>

    <div class="col-9">
       
<div clas="ani">
    <!--<img id="loading" src="https://i.imgur.com/qKJPfpT.gif"/>-->
</div>
<div id="resy">
  <div class="row">
    <div class="col-12">
          <div style="display: none" id="tracking" class="alert alert-primary" role="alert">
                <img class="system-status" src="img/allgood.svg"/>
               You’re all set to play! Current is <strong><p id="current"></p></strong> and magnetic field is <strong><p id="mf"></p></strong> .Start playing!
            </div>
                <div style="display: none" id="not-tracking" class="alert alert-danger" role="alert">
                  <img class="system-status" src="img/warning.svg"/>
               Uh oh! Looks like there's a problem. Make sure your circuit is properly connected. 
            </div>
    </div>
  </div>
<div class="row">
    <div class="col-12">
        <h4 style="padding-top: 23px;">Experiment Logger</h4>
     <table class="table table-striped">
        <tr>
            <th> Trial </th>
            <th> Coils </th>
            <th> Current </th>
            <th> Paperclips </th>

        </tr>
    </table>
    </div>

</div>
<div class="row">


<div class="col-6 ch">
  <h4>Coils & Paperclips</h4>
    <canvas id="myChart" width="400" height="300"></canvas>
</div>
<div class="col-6 ch">
  <h4>Current & Paperclips</h4>
    <canvas id="myChart2" width="400" height="300"></canvas>
</div>
</div>


</div>



    </div>


</div>

</div>
<script src="js/sketch.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="js/graphs.js"></script>
<div id="test"></div>
    <script>
$( document ).ready(function() {
            $.getJSON('experiments.json', function(data) {
                var tr;
                for (var i = 0; i < data.length; i++) {
                  var y = i+1;
                    tr = $('<tr/>');
                    tr.append("<td>" + "Trial " + y + "</td>");
                    tr.append("<td>" + data[i]['coils'] + "</td>");
                    tr.append("<td>" + data[i]['current'] + "</td>");
                    tr.append("<td>" + data[i]['paperclips'] + "</td>");
                    $('table').append(tr);
                }
            });
        });
    </script>

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body></html>
