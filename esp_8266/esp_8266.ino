#include <MFRC522.h>
#include <SPI.h>
#include <Servo.h>

#include <ESP8266WebServer.h>
#include <WiFiClient.h>
#include <ESP8266HTTPClient.h>

#define SS_PIN1 D0
#define RST_PIN1 D1

#define SS_PIN2 D3
#define RST_PIN2 D2

#define SERVO_PIN1 D8
#define SERVO_PIN2 D4

Servo myservo1, myservo2;

MFRC522 mfrc522_1(SS_PIN1, RST_PIN1);
MFRC522 mfrc522_2(SS_PIN2, RST_PIN2);

const char* ssid = "ESP8266";
const char* password = "12345678";

int readsuccess1, readsuccess2;
byte readcard1[4],readcard2[4];
char str1[32] = "";
char str2[32] = "";
String StrUID1,StrUID2;

WiFiClient wifiClient;

ESP8266WebServer server(80);


void setup() {
  Serial.begin(115200); 
  SPI.begin();      
  myservo1.attach(SERVO_PIN1);
  myservo2.attach(SERVO_PIN2);
  delay(500);
  mfrc522_1.PCD_Init();
  mfrc522_2.PCD_Init();
  WiFi.softAP(ssid, password);
}

void loop() {
  
readsuccess1 = getid_1();
 
 if (readsuccess1) {
  
    HTTPClient http;

    String postData, UIDresultSend;
    UIDresultSend = StrUID1;
    
    //Post Data
    postData = "ID=" + UIDresultSend + "&TT=" + String(1) ; //+ "&SoLuot=" + String(random(10,20)) + "TrangThai=" + String(random(1,2));

    http.begin(wifiClient,"http://192.168.4.2/web_iot/checkid.php");  //Specify request destination
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header

    int httpCode = http.POST(postData);   //Send the request
    String payload = http.getString();    //Get the response payload

    Serial.println(UIDresultSend);
    Serial.println(httpCode);   //Print HTTP return code
    Serial.println(payload);    //Print request response payload

    http.end();  //Close connection
    delay(500);

    if(String(payload.substring(0,1)) == "1" && String(payload.substring(2,3)) == "1"){
        Serial.println("Door Open");
        myservo1.write( 180 );
        delay(5500);
        myservo1.write( 0 );

    }else{
        Serial.println("Access denied");
    }
 }

readsuccess2 = getid_2();

if (readsuccess2) {
  
    HTTPClient http;

    String postData, UIDresultSend;
    UIDresultSend = StrUID2;
    
    //Post Data
    postData = "ID=" + UIDresultSend + "&TT=" + String(0) ; //+ "&SoLuot=" + String(random(10,20)) + "TrangThai=" + String(random(1,2));

    http.begin(wifiClient,"http://192.168.4.2/web_iot/checkid.php");  //Specify request destination
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header

    int httpCode = http.POST(postData);   //Send the request
    String payload = http.getString();    //Get the response payload

    Serial.println(UIDresultSend);
    Serial.println(httpCode);   //Print HTTP return code
    Serial.println(payload);    //Print request response payload

    http.end();  //Close connection
    delay(500);

    if(String(payload.substring(0,1)) == "1" && String(payload.substring(2,3)) == "0"){
        Serial.println("Door Open");
        myservo2.write( 180 );
        delay(5500);
        myservo2.write( 0 );

    }else{
        Serial.println("Access denied");
    }

 }
 


}
 

int getid_1() {
  
  if (!mfrc522_1.PICC_IsNewCardPresent()) {
    return 0;
  }
  if (!mfrc522_1.PICC_ReadCardSerial()) {
    return 0;
  }

  Serial.print("THE UID OF THE SCANNED CARD IS : ");
  
  for (int i = 0; i < 4; i++) {
    readcard1[i] = mfrc522_1.uid.uidByte[i]; //storing the UID of the tag in readcard
    array_to_string(readcard1, 4, str1);
    StrUID1 = str1;
  }
  mfrc522_1.PICC_HaltA();
  return 1;
  
}

int getid_2() {
  
  if (!mfrc522_2.PICC_IsNewCardPresent()) {
    return 0;
  }
  if (!mfrc522_2.PICC_ReadCardSerial()) {
    return 0;
  }

  Serial.print("THE UID OF THE SCANNED CARD IS : ");
  
  for (int i = 0; i < 4; i++) {
    readcard2[i] = mfrc522_2.uid.uidByte[i]; //storing the UID of the tag in readcard
    array_to_string(readcard2, 4, str2);
    StrUID2 = str2;
  }
  mfrc522_2.PICC_HaltA();
  return 1;
  
}

void array_to_string(byte array[], unsigned int len, char buffer[]) {
  for (unsigned int i = 0; i < len; i++)
  {
    byte nib1 = (array[i] >> 4) & 0x0F;
    byte nib2 = (array[i] >> 0) & 0x0F;
    buffer[i * 2 + 0] = nib1  < 0xA ? '0' + nib1  : 'A' + nib1  - 0xA;
    buffer[i * 2 + 1] = nib2  < 0xA ? '0' + nib2  : 'A' + nib2  - 0xA;
  }
  buffer[len * 2] = '\0';
}
