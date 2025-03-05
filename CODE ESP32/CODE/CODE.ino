#include <WiFiManager.h>
#include <PZEM004Tv30.h>
#include <WiFi.h>
#include <HTTPClient.h>

// KIRIM DATA KE DATABASE
String url = "https://www.powermonitoring.web.id/api/create.php";

#define PutusListrik 14


// WIFI MANAGER
#define WIFI_PIN 26
#define ResetWifi 27
bool wm_nonblocking = false; // change to true to use non blocking
WiFiManager wm; 
WiFiManagerParameter custom_field;

// MODUL PZEM
#if !defined(PZEM_RX_PIN) && !defined(PZEM_TX_PIN)
#define PZEM_RX_PIN 16
#define PZEM_TX_PIN 17
#endif

#if !defined(PZEM_SERIAL)
#define PZEM_SERIAL Serial2
#endif

#if defined(ESP32)
PZEM004Tv30 pzem(PZEM_SERIAL, PZEM_RX_PIN, PZEM_TX_PIN);
#elif defined(ESP8266)
#else
PZEM004Tv30 pzem(PZEM_SERIAL);
#endif

// waktu pengiriman
// Variabel untuk menyimpan waktu
unsigned long previousMillisParam1 = 0; // Waktu terakhir pengiriman parameter

// Interval pengiriman
const long intervalParam1 = 120000; // 2 menit


void setup() {
  WiFi.mode(WIFI_STA); // explicitly set mode, esp defaults to STA+AP  
  Serial.begin(115200);
  Serial.setDebugOutput(true);  
  delay(3000);
  Serial.println("\n Starting");

  pinMode(WIFI_PIN, INPUT);
  pinMode(ResetWifi, OUTPUT);
  digitalWrite(ResetWifi, HIGH);

  pinMode(PutusListrik, OUTPUT);
  digitalWrite(PutusListrik, HIGH);

// RESET PEMBACAAN ENERGY DAN KONFIGURASI WIFI SECARA PAKSA
    // pzem.resetEnergy();  
    // wm.resetSettings();


// PARAMETER WIFI MANAGER DAN COSTUM FIELD
  if(wm_nonblocking) wm.setConfigPortalBlocking(false);
  int customFieldLength = 40;
  const char* custom_radio_str = "<br/><label for='customfieldid'>Custom Field Label</label><input type='radio' name='customfieldid' value='1' checked> One<br><input type='radio' name='customfieldid' value='2'> Two<br><input type='radio' name='customfieldid' value='3'> Three";
  new (&custom_field) WiFiManagerParameter(custom_radio_str);
  
  wm.addParameter(&custom_field);
  wm.setSaveParamsCallback(saveParamCallback);

  std::vector<const char *> menu = {"wifi","info","param","sep","restart","exit"};
  wm.setMenu(menu);
  wm.setConfigPortalTimeout(1200);


// CODE SETTING KONFIGURASI AWAL WIFI MANAGER
  bool res;
  // res = wm.autoConnect(); // auto generated AP name from chipid
  // res = wm.autoConnect("Powermonitoring"); // anonymous ap
  res = wm.autoConnect("Powermonitoring","PMDIGITAL"); // password protected ap

  if(!res) {
    Serial.println("Failed to connect or hit timeout");
  } 
  else {  
    Serial.println("connected");
  }

// CODE CHECk STATUS WIFI
    while (WiFi.status() != WL_CONNECTED){
    Serial.println("Menghubungkan ke Database");
    delay(1000);
  }
  Serial.println("Terhubung ke Database");

}

// CODE SERVER WIFI MANAGER--------------------------------------------------------------------------------------------------------------------------------
String getParam(String name){
  
  String value;
  if(wm.server->hasArg(name)) {
    value = wm.server->arg(name);
  }
  return value;
}

void saveParamCallback(){
  Serial.println("[CALLBACK] saveParamCallback fired");
  Serial.println("PARAM customfieldid = " + getParam("customfieldid"));
}



void loop() {
  unsigned long currentMillis = millis();

  // Code pemanggil fungsi reset Wifi Manager----------------------------------------------------------------------------------------------------------------------------------
  if(wm_nonblocking) wm.process(); 
  checkButton();

  // Code PZEM Modul------------------------------------------------------------------------------------------------------------------------------------
    Serial.print("Pembacaan PZEM-004T");
    Serial.println(pzem.readAddress(), HEX);

    // Pembacaan DATA dari sensor pzem
    float voltage = pzem.voltage();
    float current = pzem.current();
    float power = pzem.power();
    float energy = pzem.energy();
    float frequency = pzem.frequency();
    float powerfactor = pzem.pf();

    // Pengecekan Data
    if(isnan(voltage)){
        Serial.println("Error reading voltage");
    } else if (isnan(current)) {
        Serial.println("Error reading current");
    } else if (isnan(power)) {
        Serial.println("Error reading power");
    } else if (isnan(energy)) {
        Serial.println("Error reading energy");
    } else if (isnan(frequency)) {
        Serial.println("Error reading frequency");
    } else if (isnan(powerfactor)) {
        Serial.println("Error reading power factor");
    } else {

        // Menampilkan data pada serial monitor
        Serial.print("Voltage: ");      Serial.print(voltage);      Serial.println("V");
        Serial.print("Current: ");      Serial.print(current);      Serial.println("A");
        Serial.print("Power: ");        Serial.print(power);        Serial.println("W");
        Serial.print("Energy: ");       Serial.print(energy,3);     Serial.println("kWh");
        Serial.print("Frequency: ");    Serial.print(frequency, 1); Serial.println("Hz");
        Serial.print("PF: ");           Serial.println(powerfactor);

    }

    Serial.println();
    delay(3000);    
 //Code pengiriman data pembacaan PZEM-004T
   if (currentMillis - previousMillisParam1 >= intervalParam1) {
    previousMillisParam1 = currentMillis;

    httpPost(url, voltage, current, power, energy, frequency, powerfactor);
   }
}


// CODE HTTP.POST PENGIRIMAN DATA LOGGER
void httpPost(String url, float voltage, float current, float power, float energy, float frequency, float powerfactor) {
      if (WiFi.status() == WL_CONNECTED) {
      HTTPClient http;
      http.begin(url); 
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");
        String postData = "voltage=" + String(voltage) +
                          "&current=" + String(current) +
                          "&power=" + String(power) +
                          "&energy=" + String(energy) +
                          "&frequency=" + String(frequency) +
                          "&powerfactor=" + String(powerfactor);
      int httpResponseCode = http.POST(postData);
      // PEMBACAAN RESPONSE
        if (httpResponseCode > 0) {
          String response = http.getString();
          Serial.println("Response: " + response);
        }else{
        Serial.print("Error on sending POST: ");
        Serial.println(httpResponseCode); 
      }
      http.end();
    }else{
      Serial.println("WiFi tidak terhubung");
    }
  }


//CODE RESET KONFIGURASI WIFI MANAGER DAN ENERGY -----------------------------------------------------------------------------------------------------------------
void checkButton(){
  // MERESET KONEKSI INTERNET
  if( digitalRead(WIFI_PIN) == LOW ){
    Serial.println("Button Pressed");
      if( digitalRead(WIFI_PIN) == LOW ){
        Serial.println("Button Held");
        Serial.println("Erasing Config Wifi, restarting");
        wm.resetSettings();
        ESP.restart();
      }
      
    // MEMULAI KEMBALI KONEKSI WIFI
    Serial.println("Starting config portal");
    wm.setConfigPortalTimeout(1200);
      
    if (!wm.startConfigPortal("Powermonitoring","PMDIGITAL")) {
      Serial.println("GAGAL TERKONEKSI INTERNET");
      delay(3000);
    } else {
      Serial.println("TERKONEKSI INTERNET");
    }
  }
}

