<!-- the html wrapper for p5.js sketch -->
<!-- the main sketch is written is sketch.js  -->
<!--Used the instructions and supporting files from: https://medium.com/@yyyyyyyuan/tutorial-serial-communication-with-arduino-and-p5-js-cd39b3ac10ce-->

<?php
if(isset($_POST['submit'])) {
  header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0");
  //print_r($_POST);
    //$file = "experiments.json";
  //  $json_string = json_encode($_POST, JSON_PRETTY_PRINT);
 //   file_put_contents($file, $json_string, FILE_APPEND);

    $additionalArray = array(
    'trial' => $_POST['trial'],
    'date' => date('jS \of F, h:i A'),
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
echo '
<script src ="js/jquery-3.3.1.min.js"></script>
<script>
function feedback() {
  console.log("im here");
  $("#recorded").css("display","block");
  $(".ins").css("margin-top","-4px");
  $("#placeholder").hide();
}

$( document ).ready(function() {
           feedback();
        });
</script>';

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


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
 img#logo {
    position: absolute;
    top: 26px;
    z-index: 9999;
    left: 42px;
}

 #var{
  background: #FFDC00;
    border-right: 4px solid #BBA202;
    padding-right: 35px;
    padding-left: 35px;
    min-height: 100vh;
    position: fixed;
    padding-top: 110px;

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
    font-size: 14px;
}

h4{
    text-transform: uppercase;
    font-size: 16.5px;
    font-weight: 700;
    line-height: 32px;
    color: #000;
    letter-spacing: 2px;
    text-align: center;
}

label{
font-weight: 500;
    font-size: 16px;
    color: #000;
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
    font-size: 20px;
    text-transform: uppercase;
    font-weight: 700;
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
    margin-top: 5px;
    border-radius: 5px;

}

#track:active {
    box-shadow: none;
    transition: 0.1s;
    margin-left: 1px;
    margin-bottom: -12px;
    width: 98%;
    padding: 16px;
}

#track:focus {outline:0;}


.ins {
padding-top: 19px;
    padding-bottom: 40px;
    margin-top: 70px;
    margin-left: 8px;
    float: left;
    margin-right: 13px;
}

    #insa,
#insa:hover,
#insa:focus {
width: 34px;
    padding: 9px;
    height: 31px;
    line-height: 16px;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: 600;
    background-color: #e84444;
    border: 1px solid #e84444;
    box-shadow: -6px 0px 0px #922b2b, -6px 6px 0px #922b2b, -6px 12px 0px #922b2b, 0px 12px 0px #922b2b;
    border-radius: 0px;
    color: #fff;
    cursor: pointer;
    border-radius: 5px;
}
    

#insa:active {
    box-shadow: none;
    transition: 0.1s;
    margin-left: -6px;
    margin-bottom: -14px;
    width: 38px;
    padding: 16px;
    height: 44px;
    padding-left: 13px;
    padding-top: 12px;
}
#insa:focus {outline:0;}


  #refresh,
#refresh:hover,
#refresh:focus {
    width: 34px;
    padding: 9px;
    height: 31px;
    line-height: 17px;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 600;
    background-color: #9E9E9E;
    border: 1px solid #9E9E9E;
    box-shadow: -6px 0px 0px #4f4f4f, -6px 6px 0px #4f4f4f, -6px 12px 0px #4f4f4f, 0px 12px 0px #4f4f4f;
    border-radius: 0px;
    color: #fff;
    cursor: pointer;
    border-radius: 5px;
    padding-top: 9px;
}
    

#refresh:active {
    box-shadow: none;
    transition: 0.1s;
    margin-left: -6px;
    margin-bottom: -14px;
    width: 38px;
    padding: 16px;
    height: 44px;
    padding-left: 13px;
    padding-top: 12px;
}
#refresh:focus {outline:0;}

#tracking{
  background: rgba(253, 235, 85, 0.1);
border: 1px solid rgba(196, 196, 196, 0.5);
box-sizing: border-box;
border-radius: 5px;
font-size: 14px;
color:#786e25;
}

#not-tracking{
  background: rgba(227, 90, 90, 0.1);
border: 1px solid rgba(196, 196, 196, 0.5);
box-sizing: border-box;
border-radius: 5px;
line-height: 28px;
font-size: 14px;
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
    color: #fff;
    font-weight: 600;
    line-height: normal;
    font-size: 15px;
    color: #FFFFFF;
    border-bottom: 5px solid #135E9A !important;
    border-top: 0px !important;
}
.col-10 {
    margin-left: 23%;
    -ms-flex: 0 0 82.333333%;
    flex: 0 0 82.333333%;
    max-width: 82.333333%;
}

.col-2 {
    -ms-flex: 0 0 19%;
    flex: 0 0 19%;
    max-width: 19%;
}



span#recorded {
        color: #1da71d;
    text-transform: uppercase;
    font-weight: 700;
    text-align: center;
    margin-top: 22px;
    font-size:20px;
}

tr {
    text-align: center;
}

.cutom-labels {
    text-align: center;
}

span.g-l {
    font-size: 14px;
    margin-right: 12px;
    padding-bottom:13px;
}
</style>
  </head>
  <body>

<div class="container-fluid">
  <!-- Modal -->
<div class="modal fade" id="instructionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Instructions</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>
  <div class="row">
      
    <div id="var" class="col-2 cont">
<img id="logo" src="img/logo.svg"/>
        <h4 class="secs">Enter Variables</h4>
        <div class="row">
            <div class="col-12">
                <form method="post" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">Trial</label>
    <input required type="text" class="form-control" name="trial" aria-describedby="emailHelp" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Coils (Turns)</label>
    <input required type="text" class="form-control" name="coils" aria-describedby="emailHelp" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Current (mA)</label>
    <input required  type="text" class="form-control" name="current" placeholder="">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Paperclips</label>
    <input required  type="text" class="form-control" name="paperclip" placeholder="">
  </div>
              <input id="track" type="submit" name="submit" id="submit" action="" value="Record" >
              <span id="recorded" style="display:none"><i class="fas fa-check"></i>Recorded</span>
</form>          <div class="ins">
      <button id="insa" data-toggle="modal" data-target="#instructionModal">?</button>
    </div>
    <div class="ins">
      <button id="refresh"><i class="fas fa-redo-alt"></i></button>
    </div>
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
          <div style="display: none" id="tracking" class="alert alert-primary" role="alert">
                <img class="system-status" src="img/allgood.svg"/>
               You’re all set to play! Current is <strong><p id="current">0mA</p></strong> and magnetic field is <strong><p id="mf">0G</p></strong> .Start playing!
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
     <table id="mytable" class="table table-striped">
        <tr>
            <th style="border-radius: 13px 0px 0px 0px;"> Trial </th>
            <th> Time Recorded </th>
            <th> Coils (Turns) </th>
            <th> Current (mA) </th>
            <th style="border-radius: 0px 13px 0px 0px;"> Paperclips </th>
        </tr>
        <tr id="placeholder">
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tbody id="testit">
        </tbody>
    </table>
    </div>

</div>
<div class="row">


<div class="col-6 ch">
  <h4>Coils & Paperclips</h4>
  <div class="cutom-labels">
    <span class="g-l">Coils</span><img class="g-i" src="img/red.svg"/>
    <span class="g-l">Paperclips</span><img class="g-i" src="img/blue.svg"/>
  </div>
    <canvas id="myChart" width="400" height="250"></canvas>
</div>
<div class="col-6 ch">
  <h4>Current & Paperclips</h4>
    <div class="cutom-labels">
    <span class="g-l">Current</span><img class="g-i" src="img/red.svg"/>
    <span class="g-l">Paperclips</span><img class="g-i" src="img/blue.svg"/>
  </div>
    <canvas id="myChart2" width="400" height="250"></canvas>
</div>
</div>


</div>



    </div>


</div>

</div>
<script src="js/sketch.js?v=2"></script>
<script src="js/Chart.min.js"></script>
<script src="js/graphs.js"></script>
<div id="test"></div>
    <script>


$( document ).ready(function() {
var rowCount = $('#myTable tr').length;

            $.getJSON('experiments.json', function(data) {
                var tr;
                var total=0;
                var attempts=data.length;
                for (var i = 0; i < data.length; i++) {
                  var y = i+1;
                    tr = $('<tr/>');
                    tr.append("<td>" + "Trial " + y + "</td>");
                    tr.append("<td>" + data[i]['date'] + "</td>");
                    tr.append("<td>" + data[i]['coils'] + "</td>");
                    tr.append("<td>" + data[i]['current'] + "</td>");
                    tr.append("<td>" + data[i]['paperclips'] + "</td>");
                    total += Number(data[i]['paperclips']);
                    $('table').append(tr);
                }
                console.log(total);
                console.log(attempts);
                  if($('table tr').length>2){
                  console.log("I hid a thing!");
                 $("tr:eq(1)").remove();

  }
            });
        });

    </script>

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body></html>
