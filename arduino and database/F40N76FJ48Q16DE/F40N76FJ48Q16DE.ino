// Internet Components
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "IoT";
const char* password = "AccessPoint.2024";
const char* host = "192.168.68.102";

// RFID Components
#include <SPI.h>
#include <MFRC522.h>

constexpr uint8_t RST_PIN = D3;     // Configurable, see typical pin layout above
constexpr uint8_t SS_PIN = D4;     // Configurable, see typical pin layout above

MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class
MFRC522::MIFARE_Key key;

String tag;

void setup() {
  Serial.begin(9600);
  
  // Internet Components
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());

  // RFID Components
  SPI.begin();
  rfid.PCD_Init();
}

void loop() {
  getUID();
}



void getUID(){
  if ( ! rfid.PICC_IsNewCardPresent())
    return;

  if (rfid.PICC_ReadCardSerial()) {
    for (byte i = 0; i < 4; i++) {
      tag += rfid.uid.uidByte[i];
    }
    Serial.println(tag);
    temporarySave(tag);

    tag = "";
    rfid.PICC_HaltA();
    rfid.PCD_StopCrypto1();
  }  
}

void temporarySave(String tag) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    WiFiClient wifi;
    http.begin(wifi, "http://192.168.68.102/employee-timekeep-IoT-NodeMCU-RFID/new-account-registration/temp-data.php?ipsrc=1&UID=" + tag); 
    http.addHeader("Content-Type", "text/plain");
    int httpCode = http.GET();
    if (httpCode > 0) {
      String response = http.getString();
      Serial.println(response);
    } else {
      Serial.println("HTTP Error: " + http.errorToString(httpCode));
    }
    http.end();
  } else {
    Serial.println("Error in WiFi connection");
  }

  return;
}