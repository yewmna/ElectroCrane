//Tweaked code from https://codepen.io/jackrugile/pen/DozAd


/* requestAnimationFrame */
// Color
var H = 46;
var S = 100;
var L_MAX = 44;
var L_MIN = 20;

var lastTime = 0;
var vendors = ['ms', 'moz', 'webkit', 'o'];
for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x){
  window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
  window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
};

if(!window.requestAnimationFrame){
  window.requestAnimationFrame = function(callback, element){
    var currTime = new Date().getTime();
    var timeToCall = Math.max(0, 16 - (currTime - lastTime));
    var id = window.setTimeout(function() { callback(currTime + timeToCall); }, timeToCall);
    lastTime = currTime + timeToCall;
    return id;
  };
};

if (!window.cancelAnimationFrame){
  window.cancelAnimationFrame = function(id){
    clearTimeout(id);
  };
};


/* Magnet */
var c = document.getElementById('m'),
ctx = c.getContext('2d'),
cw = c.width = window.innerWidth,
ch = c.height = window.innerHeight,
mx = cw/2,
my = ch/2,
pi2 = Math.PI * 2,
mRadius = 120,
mRadiusInput = $('#mRadiusInput'),
mRadiusDisplay = $('#mRadiusDisplay'),
attract = true,
rand = function(a,b){return ~~((Math.random()*(b-a+1))+a);},
things = [],
paperclips = [],
thingCount = 200,
paperCount = 10,
minSpeed = .5,
maxSpeed = 15,
friction = 0.997,

Paperclip = function(){
  base_image = new Image();
  base_image.src = 'img/paperclip.svg';
  this.vx = 0;
  this.vy = rand(2,5);
  this.x = rand(0, cw);
  this.y = rand(0, ch); 
  this.radius = rand(4, 4);
  this.affected = false;
  base_image.onload = function(){
    ctx.drawImage(base_image, this.x, this.y);
  }
}

Paperclip.prototype = {
  update: function(i){
    var dx = mx- this.x;
    var dy = my- this.y;
    var dist = Math.sqrt(dx * dx + dy * dy) - this.radius;
    if(dist < mRadius){
      this.affected = true;
      if(attract){
        this.vx += dx/(10*this.radius);
        this.vy += dy/(10*this.radius);
      } else {
        this.vx -= dx/(10*this.radius);
        this.vy -= dy/(10*this.radius);
      }
    } else {
      this.affected = false;
    }
              
    if(this.vx > maxSpeed){ this.vx = maxSpeed; }
    if(this.vx < -maxSpeed){ this.vx = -maxSpeed; } 
    if(this.vy > maxSpeed){ this.vy = maxSpeed; } 
    if(this.vy < -maxSpeed){ this.vy = -maxSpeed; }
    
    if(Math.abs(this.vx) > minSpeed){
      this.vx *= friction;
    }
    
    if(Math.abs(this.vy) > minSpeed){
      this.vy *= friction;
    }
    
    this.x += this.vx;
    this.y += this.vy;
        
    if(this.x > cw){ this.x = rand(0, cw);  this.y = rand(0, ch); }
    if(this.y> ch){ this.x = rand(0, cw);  this.y = rand(0, ch); }
    if(this.x < 0){ this.x = rand(0, cw);   this.y = rand(0, ch); }
    if(this.y < 0){ this.x = rand(0, cw);   this.y = rand(0, ch); }
  },
  render: function(i){
    ctx.drawImage(base_image, this.x, this.y);
  }
}
  
var updatePapers = function(){
  var i = paperclips.length;
  while(i--){
      base_image = new Image();
  base_image.src = 'img/paperclip.svg';
    paperclips[i].update(i); 
  }
}
      
var renderPapers = function(){
  var i = paperclips.length;
  while(i--){
      base_image = new Image();
  base_image.src = 'img/paperclip.svg';
    paperclips[i].render(i); 

  } 
}

var renderMRadius = function(){
        if(mRadius>265){
          mRadius = 265;
        }


        ctx.beginPath();
        ctx.ellipse(mx, my, mRadius, mRadius/2.25, Math.PI*2, 0, 2 * Math.PI);
        var _currentAlpha = 0.35;
        var gradient = ctx.createRadialGradient(mx, my, mRadius/2, mx, my, 0, mRadius);
        gradient.addColorStop(1, Color.setAlphaToString(_currentAlpha));
        gradient.addColorStop(1, Color.setAlphaToString(0));
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.moveTo(mx + mRadius, my);
        ctx.ellipse(mx, my, mRadius, mRadius/2.25, Math.PI*2, 0, 2 * Math.PI);
        ctx.fill(); 

        ctx.beginPath();
        ctx.ellipse(mx, my, mRadius, mRadius/2, Math.PI*2, 0, 2 * Math.PI);
        var _currentAlpha = 0.30;
        var gradient = ctx.createRadialGradient(mx, my, mRadius/2, mx, my, 0, mRadius);
        gradient.addColorStop(1, Color.setAlphaToString(_currentAlpha));
        gradient.addColorStop(1, Color.setAlphaToString(0));
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.moveTo(mx + mRadius, my);
        ctx.ellipse(mx, my, mRadius, mRadius/2, Math.PI*2, 0, 2 * Math.PI);
        ctx.fill(); 

        ctx.beginPath();
        ctx.ellipse(mx, my, mRadius, mRadius/1.75, Math.PI*2, 0, 2 * Math.PI);
        var _currentAlpha = 0.25;
        var gradient = ctx.createRadialGradient(mx, my, mRadius/2, mx, my, 0, mRadius);
        gradient.addColorStop(1, Color.setAlphaToString(_currentAlpha));
        gradient.addColorStop(1, Color.setAlphaToString(0));
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.moveTo(mx + mRadius, my);
        ctx.ellipse(mx, my, mRadius, mRadius/1.75, Math.PI*2, 0, 2 * Math.PI);
        ctx.fill(); 

        
        ctx.beginPath();
        ctx.ellipse(mx, my, mRadius, mRadius/1.5, Math.PI*2, 0, 2 * Math.PI);
        var _currentAlpha = 0.20;
        var gradient = ctx.createRadialGradient(mx, my, mRadius/2, mx, my, 0, mRadius);
        gradient.addColorStop(1, Color.setAlphaToString(_currentAlpha));
        gradient.addColorStop(1, Color.setAlphaToString(0));
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.moveTo(mx + mRadius, my);
        ctx.ellipse(mx, my, mRadius, mRadius/1.5, Math.PI*2, 0, 2 * Math.PI);
        ctx.fill(); 

        ctx.beginPath();
        ctx.ellipse(mx, my, mRadius, mRadius/1.25, Math.PI*2, 0, 2 * Math.PI);
        var _currentAlpha = 0.15;
        var gradient = ctx.createRadialGradient(mx, my, mRadius/2, mx, my, 0, mRadius);
        gradient.addColorStop(1, Color.setAlphaToString(_currentAlpha));
        gradient.addColorStop(1, Color.setAlphaToString(0));
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.moveTo(mx + mRadius, my);
        ctx.ellipse(mx, my, mRadius, mRadius/1.25, Math.PI*2, 0, 2 * Math.PI);
        ctx.fill(); 

        ctx.beginPath();
        ctx.ellipse(mx, my, mRadius, mRadius, Math.PI*2, 0, 2 * Math.PI);

        var _currentAlpha = 0.1;
        var gradient = ctx.createRadialGradient(mx, my, mRadius/2, mx, my, 0, mRadius);
        gradient.addColorStop(1, Color.setAlphaToString(_currentAlpha));
        gradient.addColorStop(1, Color.setAlphaToString(0));
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.moveTo(mx + mRadius, my);
        ctx.ellipse(mx, my, mRadius, mRadius, Math.PI*2, 0, 2 * Math.PI);
        ctx.fill(); 
        

}


var Color = new function() {
    this.h = H;
    this.s = S;
    this.l = L_MAX;
    
    this.setAlphaToString = function(alpha) {
        if (typeof alpha === 'undefined' || alpha === null) {
            return 'hsl(' + this.h + ', ' + this.s + '%, ' + this.l + '%)';
        }
        return 'hsla(' + this.h + ', ' + this.s + '%, ' + this.l + '%, ' + alpha + ')';
    };
};

function mappy( x,  in_min,  in_max,  out_min,  out_max){
  return (x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;
}

var loop = function(){
  requestAnimationFrame(loop, c);
  ctx.clearRect(0, 0, cw, ch);
  updatePapers();
  renderPapers();
  renderMRadius();
}



var resize = function(){
  cw = c.width = window.innerWidth;
  ch = c.height = window.innerHeight;
  mx = cw/2;
  my = ch/2;
}


for(var i = 0; i < paperCount; i++){
  paperclips.push(new Paperclip());    
}

$(window).on('resize', resize);

setTimeout(function(){
document.body.appendChild(c);
resize();
loop();
}, 50);



var timeout = setInterval(reloadChat, 10);    
    function reloadChat () {
                 $.ajax({
         url: "data.json",
         contentType: "application/json; charset=utf-8",
        type: 'GET',

        }).done(function(response){
        var parsed = jQuery.parseJSON(JSON.stringify(response));
try{
var reading_2 = parsed.substring(
    parsed.lastIndexOf(",") + 1, 
    parsed.lastIndexOf("]")
);
} 
catch(error){
         var reading_2 = parsed[1];
}   

           if (typeof reading_2 == 'undefined'){
                document.getElementById("magneticfield_value").innerHTML = "0G";
            }else{
            size=mappy(reading_2,0,500,0,200);
            mRadius = size;
            var cat;
            if(size ==0){
              cat = "No magnetic field";
            }
            else if(size <= 100){
              cat = "Low Strength";
            }else if(size<=200){
              cat = "Medium Strength";
            }else{
              cat = "High Strength";
            }

            document.getElementById("magneticfield_value").innerHTML = reading_2 + "G";
            document.getElementById("magneticfield_cat").innerHTML = cat;
            }



}).fail(function(jqXHR, textStatus, errorThrown){
});
    }  