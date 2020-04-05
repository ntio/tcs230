//
// Cableado de TCS3200 a Arduino
//
#define S0 4
#define S1 5
#define S2 6
#define S3 7
#define salidaSensor 8

// Para guardar las frecuencias de los fotodiodos
int frecuenciaRojo = 0;
int frecuenciaVerde = 0;
int frecuenciaAzul = 0;

void setup() {
  // Definiendo las Salidas
  pinMode(S0, OUTPUT);
  pinMode(S1, OUTPUT);
  pinMode(S2, OUTPUT);
  pinMode(S3, OUTPUT);
  
  // Definiendo salidaSensor como entrada
  pinMode(salidaSensor, INPUT);
  
  // Definiendo la escala de frecuencia a 20%
  digitalWrite(S0,LOW);
  digitalWrite(S1,HIGH);
  
   // Iniciar la comunicacion serie 
  Serial.begin(9600);
}
void loop() {
  // Definiendo la lectura de los fotodiodos con filtro rojo
  digitalWrite(S2,LOW);
  digitalWrite(S3,LOW);
  
  // Leyendo la frecuencia de salida del sensor
  frecuenciaRojo = pulseIn(salidaSensor, LOW);
  
  // Mostrando por serie el valor para el rojo (R = Red)
   Serial.print("{\"rojo\":");
  Serial.print(frecuenciaRojo);
  Serial.print(",");
  delay(100);
  
  // Definiendo la lectura de los fotodiodos con filtro verde
  digitalWrite(S2,HIGH);
  digitalWrite(S3,HIGH);
  
  // Leyendo la frecuencia de salida del sensor
  frecuenciaVerde = pulseIn(salidaSensor, LOW);
  
  // Mostrando por serie el valor para el verde (G = Green)
   Serial.print("\"verde\":");
  Serial.print(frecuenciaVerde);
  Serial.print(",");
  delay(100);
 
  // Definiendo la lectura de los fotodiodos con filtro azul
  digitalWrite(S2,LOW);
  digitalWrite(S3,HIGH);
  
  // Leyendo la frecuencia de salida del sensor
  frecuenciaAzul = pulseIn(salidaSensor, LOW);
  
  // Mostrando por serie el valor para el azul (B = Blue)
  Serial.print("\"azul\":");
  Serial.print(frecuenciaAzul);
  Serial.print("}\n");
  delay(1000);
}
