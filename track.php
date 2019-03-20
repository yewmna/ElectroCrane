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
iframe{
  width:100vw;
  position: absolute;
  top:0;
  left:0;
  height:100vh;
      border: none;

}
p#current {
    display: inline;
}
p#mf {
    display: inline;
}
#tracking{
  background: rgba(253, 235, 85, 0.1);
border: 1px solid rgba(196, 196, 196, 0.5);
box-sizing: border-box;
border-radius: 5px;
font-size: 14px;
color:#786e25;
    position: absolute;
    top: 0px;
    left: 359px;
    width: 72vw;
}

#not-tracking{
background: rgba(227, 90, 90, 0.1);
    border: 1px solid rgba(196, 196, 196, 0.5);
    box-sizing: border-box;
    border-radius: 5px;
    line-height: 28px;
    font-size: 14px;
    position: absolute;
    top: 0px;
    left: 359px;
    width: 72vw;
}

.system-status{
  width:30px;
      margin-top: -15px;
}
div#resy {
    padding-top: 15px;
}



</style>
  </head>
  <body>
<iframe id="experiment" src="a7a.php"></iframe>


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
</div>
</div>
<script src="js/sketch.js?v=2"></script>



<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>


$(document).ready(function(){
var iframe = document.getElementById('experiment');
      var header = $('.alert');
var range = 100;
iframe.contentDocument.addEventListener('scroll', function(event) {
   var scrollTop = $(this).scrollTop(),
      height = header.outerHeight(),
      offset = height / 2,
      calc = 1 - (scrollTop - offset + range) / range;

  header.css({ 'opacity': calc });

  if (calc > '0') {
    header.css({ 'opacity': 1 });
  } else if ( calc < '0' ) {
    header.css({ 'opacity': 0 });
  }
}, false);

});






</script>
  

</body></html>
