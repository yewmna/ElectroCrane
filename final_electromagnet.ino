#define MAX_ANALOG_INPUT_VAL 1023
#define NOFIELD 503L   

const int POT_INPUT_PIN = A0;
const int HALL_PIN = A1;
const int OUTPUT_PIN = 3;
int prev;

void setup() {
  pinMode(POT_INPUT_PIN, INPUT);
  delay(1);
  pinMode(HALL_PIN, INPUT);
  delay(1);
  pinMode(OUTPUT_PIN,OUTPUT);
  delay(1);
  Serial.begin(9600); 
}

void loop() {
    /*Reading analog input from potentiometer and mapping to pwm pin that supplies power to electromagnet*/
    int POT_raw = analogRead(POT_INPUT_PIN); 
    int POT_pwm = map(POT_raw, 0, MAX_ANALOG_INPUT_VAL, 0, 255);
    
    /*Mapping value for p5js*/
    int POT_p5js = map(POT_raw, 0, MAX_ANALOG_INPUT_VAL, 1, 128); 
    /*Mapping value for and p5js */
    analogWrite(OUTPUT_PIN, POT_pwm);
    Serial.write(POT_p5js);   
    delay(100);
    
    /*Reading Hall effect sensor*/
    int HALL_raw = analogRead(HALL_PIN);  //Reading hall effect sensor

    /*Mapping value for p5js*/
    int magnet_p5js = map(HALL_raw, NOFIELD, MAX_ANALOG_INPUT_VAL, 129, 255);

    /*Making some calculations to clear background magnetic field noise. Only sending signal if magnetic field changes since it's too sensitive */
    if(HALL_raw < NOFIELD) { 
      HALL_raw = NOFIELD + (NOFIELD - HALL_raw);
     }
     if(abs(HALL_raw - NOFIELD)<15){
      HALL_raw = NOFIELD;
     }
      int diff = HALL_raw - prev;
      
     if(abs(diff)>10){
        Serial.write(magnet_p5js);
      }
     prev = HALL_raw; 
     delay(100);
}
