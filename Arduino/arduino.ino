//Użyte biblioteki
#include <WiFiNINA.h>
#include "DHT.h"
#include "DFRobot_CCS811.h"


#define DHTPIN 2      //pin czujnika DHT11
#define DHTTYPE DHT11 //typ czujnika

//hasło i login sieci WiFi
char ssid[] = "DOM_Robert";     //"TP-Link_B72D"; // 
char pass[] = "robertrobert";  //"87433333"; //


int status = WL_IDLE_STATUS;

//Adres IP do połączenia z siecią
//char server[] = "192.168.1.7";
//IPAddress server (192,168,0,105);
IPAddress server (192,168,1,7);
//IPAddress server (157,158,124,109);

String wilgotnosc;
String temperatura_C;
String temperatura_F;
String CO2;
String TVOC;

String temp1 = ",";
String temp2 = ", ";
String temp3 = "temperatura_F= ";
String temp4 = ", ";
String temp5 = "TVOC= ";

String Data;

WiFiClient client;

DHT dht(DHTPIN, DHTTYPE);
DFRobot_CCS811 CCS811;

//łączenie z siecią WiFi
void setup() {

  Serial.begin(9600);

  while (status != WL_CONNECTED) {
    Serial.print("Attempting to connect to Network named: ");
    Serial.println(ssid);
    status = WiFi.begin(ssid, pass);
    delay(10000);
  }

  Serial.print("SSID: ");
  Serial.println(WiFi.SSID());
  IPAddress ip = WiFi.localIP();
  IPAddress gateway = WiFi.gatewayIP();
  Serial.print("IP Address: ");
  Serial.println(ip);

  dht.begin();

   while(CCS811.begin() != 0){
        Serial.println("failed to init chip, please check if the chip connection is fine");
        delay(1000);
    }
}

void loop() {
  
  delay(2000);
  
   //odczyt pomiarów: temperatury i wilgotności
  float h = dht.readHumidity();
  // odczyt temperatury w st. celsjusza (domyślnie)
  float t = dht.readTemperature();
  //odczyt temperatury w st. Fahrenheit (isFahrenheit = true)
  float f = dht.readTemperature(true);

  // iddex ciepla
  float hif = dht.computeHeatIndex(f, h);
  float hic = dht.computeHeatIndex(t, h, false);


  // Sprawdzanie czy nie pojawiły się błędy
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    return;
  }

  if(CCS811.checkDataReady() == true){
    
       // Serial.print("CO2: ");
       // Serial.print(CCS811.getCO2PPM());
      //  Serial.print("ppm, TVOC: ");
       // Serial.print(CCS811.getTVOCPPB());
       // Serial.println("ppb");

  //oczyt pomiaru TVOC i CO2
     CO2 = temp4 + CCS811.getCO2PPM();
     TVOC = temp5 + CCS811.getTVOCPPB();
        
    } else {
        Serial.println("Data is not ready!");
    }

 
     wilgotnosc =  temp1 +h;
     temperatura_C = temp2 + t;
    
    

    Data= TVOC + CO2 + temperatura_C + wilgotnosc;

  //przesyłanie danych na serwera www
  if (client.connect(server, 80)) {
    client.println("POST /bsphp/post.php HTTP/1.1");
    client.println("Host: 192.168.1.7");
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.print("Content-Length: ");
    
    client.println(Data.length());
    client.println();
    client.print(TVOC);
    client.print(CO2);
    client.print(temperatura_C);
    client.print(wilgotnosc);
    
    //client.println(temperatura_C.length());
    //client.println();
    //client.println(CO2.length());
   // client.println();
    //client.println(TVOC.length());
    //client.println();
    

   Serial.println("conected");
  }
  else{
    Serial.println();
   Serial.println("disconecting");
   
  }
/*
  Serial.print(F("Humidity: "));
  Serial.print(h);
  Serial.print(F("%  Temperature: "));
  Serial.print(t);
  Serial.print(F("°C "));
  Serial.print(f);
  Serial.print(F("°F  Heat index: "));
  Serial.print(hic);
  Serial.print(F("°C "));
  Serial.print(hif);
  Serial.println(F("°F"));
*/
  
  //if (client.connected()) {
    client.stop();
  //}
  Serial.print(TVOC);
  Serial.print(CO2);
  Serial.print(temperatura_C);
  Serial.print(wilgotnosc);
  
  
 //podana linia bazowa
    CCS811.writeBaseLine(0x447B);
   // CCS811.writeBaseLine(0x3476);
  delay(3000);
}
