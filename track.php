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
    'length' => $_POST['length'],
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

  </head>
  <body>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
                <div id="sensor">
        <p id="current"></p>
        <p id="mf"></p>
    </div>
        </div>
    </div>
  <div class="row">
    <div id="var" class="col-2 cont">
        <h3 class="secs">Experiment Variables</h3>
        <div class="row">
            <div class="col-12">
                <form method="post" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">Trial</label>
    <input type="text" class="form-control" name="trial" aria-describedby="emailHelp" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Number of coils</label>
    <input type="text" class="form-control" name="coils" aria-describedby="emailHelp" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Current</label>
    <input type="text" class="form-control" name="current" placeholder="">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Nail Length</label>
    <input type="text" class="form-control" name="length" placeholder="">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Number of paperclips</label>
    <input type="text" class="form-control" name="paperclip" placeholder="">
  </div>
              <input type="submit" name="submit" id="submit" action="">
</form>
            </div>
        </div>

    </div>

    <div class="col-10">
       
<div clas="ani">
    <!--<img id="loading" src="https://i.imgur.com/qKJPfpT.gif"/>-->
</div>
<div id="resy">
<div class="row">
    <div class="col-12">
        <h4>Trial Results</h4>
     <table class="table">
        <tr>
            <th> Trial </th>
            <th> Coils </th>
            <th> Current </th>
            <th> Nail Length </th>
            <th> Paperclips </th>

        </tr>
    </table>
    </div>

</div>
<div class="row">


<div class="col-8 ch">
    <canvas id="myChart" width="400" height="200"></canvas>
</div>
<div class="col-8 ch">
    <canvas id="myChart2" width="400" height="200"></canvas>
</div>
<div class="col-8 ch">
    <canvas id="myChart3" width="400" height="200"></canvas>
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
                    tr.append("<td>" + data[i]['length'] + "</td>");
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
