#include <ESP8266WiFi.h>
#include <PubSubClient.h>

// WiFi
const char *ssid = "CueMei";			// Enter your WiFi name
const char *password = "0912267716";	// Enter WiFi password

// MQTT Broker
const char *mqtt_broker = "141.164.46.83";
const char *topic = "hc/home.control";
const char *mqtt_username = "hc";
const char *mqtt_password = "123";
const int mqtt_port = 1883;

WiFiClient espClient;
PubSubClient client(espClient);

void setup() {
	// Set software serial baud to 115200;
	Serial.begin(9600);
	// connecting to a WiFi network
	WiFi.begin(ssid, password);
	while (WiFi.status() != WL_CONNECTED) {
		delay(500);
		//Serial.println("Connecting to WiFi..");
	}
	//Serial.println("Connected to the WiFi network");
	//connecting to a mqtt broker
	client.setServer(mqtt_broker, mqtt_port);
	client.setCallback(callback);
	while (!client.connected()) {
		String client_id = "esp8266-client-";
		client_id += String(WiFi.macAddress());
		//Serial.printf("The client %s connects to the public mqtt broker\n", client_id.c_str());
		if (client.connect(client_id.c_str(), mqtt_username, mqtt_password)) {
			//Serial.println("Public mqtt broker connected");
		} else {
			//Serial.print("failed with state ");
			//Serial.print(client.state());
			delay(2000);
		}
	}
	// publish and subscribe
	client.publish(topic, "device is online");
	client.subscribe(topic);
}

void callback(char *topic, byte *payload, unsigned int length) {
	//Serial.print("Message arrived in topic: ");
	//Serial.println(topic);
	for (int i = 0; i < length; i++) {
		Serial.print((char) payload[i]);
	}
	Serial.println();
	//Serial.println("-----------------------");
}

void loop() {
	client.loop();
}
