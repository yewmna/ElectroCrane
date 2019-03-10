//Tweaked code from https://github.com/yyyuan/arduino-p5-tutorial-starter

/*
References for these codes:
https://itp.nyu.edu/physcomp/labs/labs-serial-communication/lab-serial-input-to-the-p5-js-ide/
https://itp.nyu.edu/physcomp/labs/labs-serial-communication/lab-serial-input-to-the-p5-js-ide/
*/
var serial;   // variable to hold an instance of the serialport library
var portName = '/dev/cu.usbmodem14301';    // fill in your serial port name here
var inData;   // variable to hold the input data from Arduino

var minWidth = 10;   //set min width and height for canvas
var minHeight = 10;
var width, height;    // actual width and height for the sketch
var team;
var current;
var magnetic_field;

var mynewVal;
function setup() {
  // set the canvas to match the window size
  team = location.hash.substr(1);
  if (window.innerWidth > minWidth){
    width = window.innerWidth;
  } else {
    width = minWidth;
  }
  if (window.innerHeight > minHeight) {
    height = window.innerHeight;
  } else {
    height = minHeight;
  }

  //set up canvas

  //set up communication port
  serial = new p5.SerialPort();       // make a new instance of the serialport library
  serial.on('list', printList);  // set a callback function for the serialport list event
  serial.on('connected', serverConnected); // callback for connecting to the server
  serial.on('open', portOpen);        // callback for the port opening
  serial.on('data', serialEvent);     // callback for when new data arrives
  serial.on('error', serialError);    // callback for errors
  serial.on('close', portClose);      // callback for the port closing

  serial.list();                      // list the serial ports
  serial.open(portName);              // open a serial port
}

var timeout = setInterval(passVal, 500);    


function passVal(){

  if(inData){
    if(inData<129){
    current = mappy(inData, 1, 128, 0, 150);
    document.getElementById("current").innerHTML = Math.floor(current) + "mA";
    }else{
    magnetic_field = inData;//change this later
    magnetic_field = mappy(inData, 129, 255, 0, 1000);
    document.getElementById("mf").innerHTML = Math.floor(magnetic_field)+"G";
     }

           $.ajax({
  url: "./saveJSON.php",
  type: 'POST',
  ContentType: 'application/json',
  data: {'current': Math.floor(current),'magnetic_field': Math.floor(magnetic_field)}
}).done(function(response){
}).fail(function(jqXHR, textStatus, errorThrown){
});
 }

  }

  


    




// Following functions print the serial communication status to the console for debugging purposes

function printList(portList) {
 // portList is an array of serial port names
 for (var i = 0; i < portList.length; i++) {
 // Display the list the console:
 print(i + " " + portList[i]);
 }
}

function serverConnected() {
  print('connected to server.');
}

function portOpen() {
  print('the serial port opened.')
}

function serialEvent() {
  inData = Number(serial.read());
}

function serialError(err) {
  print('Something went wrong with the serial port. ' + err);
}

function portClose() {
  print('The serial port closed.');
}

function mappy( x,  in_min,  in_max,  out_min,  out_max){
  return (x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;
}