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
thingCount = 200,
minSpeed = .5,
maxSpeed = 15,
friction = 0.997,

Thing = function(){
  this.vx = 0;
  this.vy = rand(2,5);
  this.x = rand(0, cw);
  this.y = rand(0, ch); 
  this.radius = rand(4, 4);
  this.affected = false;
}

Thing.prototype = {
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
    
     ctx.beginPath();

    ctx.rect(this.x, this.y, 6, 1);
      ctx.stroke();
ctx.fill();

    ctx.fillStyle = 'hsla(51, 89%, 45%, 1)';//Color of circles when not attracted
    ctx.strokeStyle = 'hsla(51, 89%, 45%, 1)';//Color of circles when not attracted
    if(this.affected){
      if(attract){
        ctx.fillStyle = 'hsla(51, 89%, 45%, 1)';//Color of circles when attracted
        ctx.strokeStyle = 'hsla(51, 89%, 45%, 1)'; //Color of circles when attracted
      } else {
        ctx.fillStyle = 'hsla(51, 89%, 45%, 1)';
        ctx.strokeStyle = 'hsla(51, 89%, 45%, 1)';
      }
    }    
    ctx.fill();
    ctx.stroke();
  }
}
  
var updateThings = function(){
  var i = things.length;
  while(i--){
    things[i].update(i); 
  }
}
      
var renderThings = function(){
  var i = things.length;
  while(i--){
    things[i].render(i); 
  } 
}
    
var renderMRadius = function(){
        if(mRadius>265){
          mRadius = 265;
        }


        ctx.beginPath();
        ctx.ellipse(mx, my, mRadius, mRadius/2.25, Math.PI*2, 0, 2 * Math.PI);
        var _currentAlpha = 0.6;
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
        var _currentAlpha = 0.5;
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
        var _currentAlpha = 0.4;
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
        var _currentAlpha = 0.3;
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
        var _currentAlpha = 0.2;
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

var loop = function(){
  requestAnimationFrame(loop, c);
  ctx.clearRect(0, 0, cw, ch);
  updateThings();
  renderThings();
  renderMRadius();
}



var resize = function(){
  cw = c.width = window.innerWidth;
  ch = c.height = window.innerHeight;
  mx = cw/2;
  my = ch/2;
}
    
for(var i = 0; i < thingCount; i++){
  things.push(new Thing());    
}

$(window).on('resize', resize);

mRadiusInput.on('change', function(){
  var val = $(this).val();
  mRadius = val;
  mRadiusDisplay.text(val);
});

setTimeout(function(){
document.body.appendChild(c);
resize();
loop();
}, 50);



var mousedown = function(){
  attract = (attract) ? false : true;
}

$(c).on('mousedown', mousedown);



var timeout = setInterval(reloadChat, 500);    
    function reloadChat () {
                var team = location.hash.substr(1);

                 $.ajax({
           url: "data.json",
         contentType: "application/json; charset=utf-8",
          type: 'GET',

        }).done(function(response){
            var parsed = JSON.parse(response);
            var length = Object.keys(parsed).length;
            for(var i = 0; i<length; i++){
                var reading_1 = parsed[team]['readings']['arduino_1'];
                var reading_2 = parsed[team]['readings']['arduino_2'];
            }
            if (typeof reading_1 == 'undefined'){
                console.log("No connected laptop");
            }else{
            size=reading_1*20;
            mRadius = size;

            document.getElementById("magneticfield_value").innerHTML = Math.floor(size);
            }



}).fail(function(jqXHR, textStatus, errorThrown){
});
    }  