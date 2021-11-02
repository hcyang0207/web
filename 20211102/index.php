<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="robots" content="index, follow">
		<title>20211102 - 專題指導(物聯網雲端應用)</title>
		<!-- cdn javascript and css -->
		<script src="//code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
		<style>
		pre {padding:5px;font-family:monospace;font-size:12px;}
		.blue {color:blue;}
		.commit {color:#888;}
		.yellow {color:yellow;}
		.noselect {
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		</style>
	</head>
	<body>
		<div class="container">
			<h1>專題指導(物聯網雲端應用)</h1>
			<p>楊皓程 2021/11/02</p>
			<hr>
			<div class="h3" style="display:flex;align-items:center;"><img src="https://i.imgur.com/sDSInju.png" style="width:1em;vertical-align:middle">&nbsp;相關檔案/工具</div>
			<ol>
				<li><a href="http://www.hivemq.com/demos/websocket-client/" target="_blank">HiveMQ(Websockets Client Showcase)</a></li>
				<li><a href="https://chrome.google.com/webstore/detail/mqttbox/kaajoficamnjijhkeomgfljpicifbkaf?hl=zh-TW" target="_blank">MQTTBox(Google Chrome Extension)</a></li>
				<li><a href="/20180611/downloads/IO-Cable_PL-2303_Drivers-Generic_Windows_PL2303_Prolific.zip" target="_blank">PL2303 驅動程式(Windows)</a></li>
				<li><a href="https://mqtt.cumi.co/iot.html" target="_blank">MQTT 測試網頁</a></li>
				<li><a href="https://cumi.co/20180611/arduino_esp8266.html" target="_blank">Arduino IDE 設定</a></li>
			</ol>
			<div class="h3" style="display:flex;align-items:center;"><img src="https://i.imgur.com/sDSInju.png" style="width:1em;vertical-align:middle">&nbsp;MQTT Broker架設(Linux)</div>
			<ul>
				<p><b><a class="btn btn-xs btn-primary" data-toggle="collapse" href="#a1" role="button" aria-expanded="false" aria-controls="a1">A-1. 架設(帳號密碼認證+支援Websocket協定)</a></b></p>
<pre style="background:#000;color:#999;" class="collapse" id="a1">
<span class="noselect">root@localhost:~# </span>sudo apt update
<span class="noselect">root@localhost:~# </span>sudo apt upgrade
<span class="noselect">root@localhost:~# </span>sudo apt install -y mosquitto mosquitto-clients vim
<span class="noselect">root@localhost:~# </span>rm /etc/mosquitto/passwd
<span class="noselect">root@localhost:~# </span>echo "" > /etc/mosquitto/passwd
<span class="noselect">root@localhost:~# </span>sudo mosquitto_passwd -b /etc/mosquitto/passwd <span class="yellow">test</span> <span class="yellow">12345</span>
<span class="noselect">root@localhost:~# </span>echo "port 1883" > /etc/mosquitto/conf.d/test.conf
<span class="noselect">root@localhost:~# </span>echo "allow_anonymous false" >> /etc/mosquitto/conf.d/test.conf
<span class="noselect">root@localhost:~# </span>echo "password_file /etc/mosquitto/passwd" >> /etc/mosquitto/conf.d/test.conf
<span class="noselect">root@localhost:~# </span>echo "listener 1884" >> /etc/mosquitto/conf.d/test.conf
<span class="noselect">root@localhost:~# </span>echo "protocol websockets" >> /etc/mosquitto/conf.d/test.conf
<span class="noselect">root@localhost:~# </span>sudo systemctl restart mosquitto
</pre>
				<p><b><a class="btn btn-xs btn-primary" data-toggle="collapse" href="#a2" role="button" aria-expanded="false" aria-controls="a2">A-2. 測試伺服器</a></b></p>
<pre style="background:#eee;" class="collapse" id="a2">
<span class="noselect">Web: </span><a href="https://mqtt.cumi.co" target="_blank">https://mqtt.cumi.co</a>
<span class="noselect">MQTT: </span><font color="blue">mqtt://mqtt.cumi.co:1883</font>
<span class="noselect">WS: </span><font color="blue">ws://mqtt.cumi.co/websocket</font>
<span class="noselect">WSS: </span><font color="blue">wss://mqtt.cumi.co/websocket</font>
<span class="noselect">帳號: </span><font color="blue">test</font>
<span class="noselect">密碼: </span><font color="blue">12345</font>
</pre>
			</ul>
			<div class="h3" style="display:flex;align-items:center;"><img src="https://i.imgur.com/sDSInju.png" style="width:1em;vertical-align:middle">&nbsp;Web Server架設(Linux)</div>
			<ul>
				<p><b><a class="btn btn-xs btn-primary" data-toggle="collapse" href="#b1" role="button" aria-expanded="false" aria-controls="b1">B-1. 架設(Nginx)</a></b></p>
<pre style="background:#000;color:#999;" class="collapse" id="b1">
<span class="noselect">root@localhost:~# </span>sudo apt update
<span class="noselect">root@localhost:~# </span>sudo apt upgrade
<span class="noselect">root@localhost:~# </span>sudo apt install -y nginx
</pre>
				<p><b><a class="btn btn-xs btn-primary" data-toggle="collapse" href="#b2" role="button" aria-expanded="false" aria-controls="b2">B-2. Nginx WebSite Config</a></b></p>
<pre style="background:#000;color:#999;" class="collapse" id="b2">
<span class="noselect">root@localhost:~# </span>cd /etc/nginx/sites-available
<span class="noselect">root@localhost:~# </span>vi iot-mqtt

<font color="yellow">server {
	<font color="#777"><i>#網域名稱</i></font>
	server_name <span class="blue">xxx.xxx.xx</span>;
	<font color="#777"><i>#網站目錄</i></font>
	root <span class="blue">/var/www/html</span>;
	location /websocket {
		proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
		proxy_set_header Host $host;
		proxy_pass http://websocket-mqtt;
		proxy_http_version 1.1;
		proxy_set_header Upgrade $http_upgrade;
		proxy_set_header Connection "upgrade";
		proxy_connect_timeout 4s;
		proxy_send_timeout 12s;
		proxy_read_timeout 3600s;
	}
	listen 80;
	listen [::]:80;
}
upstream websocket-mqtt {
	<font color="#777"><i>#代理Websocker Port</i></font>
	server <span class="blue">127.0.0.1:1884</span>;
	keepalive 1000;
}</font>

<span class="noselect">root@localhost:~# </span>cd ../sites-enabled
<span class="noselect">root@localhost:~# </span>ln -s ../sites-available/iot-mqtt .
<span class="noselect">root@localhost:~# </span>service nginx restart
</pre>
				<p><b><a class="btn btn-xs btn-primary" data-toggle="collapse" href="#b3" role="button" aria-expanded="false" aria-controls="b3">B-3. WebClient程式</a></b></p>
<pre style="background:#000;color:#999;" class="collapse" id="b3">
<span class="noselect">root@localhost:~# </span>vi /var/www/html/mqtt.html

<font color="yellow">&lt;html&gt;
	&lt;head&gt;
		&lt;meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /&gt;
		&lt;meta http-equiv="X-UA-Compatible" content="IE=edge" /&gt;
		&lt;meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"&gt;
		&lt;meta name="robots" content="index, follow"&gt;
		&lt;title&gt;MQTT over Websocket&lt;/title&gt;
		<font color="#777"><i>&lt;!-- cdn javascript and css --&gt;</i></font>
		&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/mqtt/3.0.0/mqtt.min.js"&gt;&lt;/script&gt;
		&lt;script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"&gt;&lt;/script&gt;
		&lt;script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"&gt;&lt;/script&gt;
		&lt;link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"&gt;
		&lt;link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet"&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;div class="container"&gt;
			&lt;script&gt;
			const clientId = 'mqttjs_' + Math.random().toString(16).substr(2, 8);
			const host = '<font color="blue">ws://xxx.xxx.xx/websocket</font>';
			const options = {
				keepalive: 10,
				clientId: clientId,
				protocolId: 'MQTT',
				protocolVersion: 4,
				username: '<font color="blue">test</font>',
				password: '<font color="blue">12345</font>',
				clean: true,
				will: {
					topic: '<font color="blue">iot/web-client</font>',
					payload: '<font color="blue">web client is online</font>',
					qos: 0,
					retain: false
				},
			};
			const client = mqtt.connect(host, options);
			client.on('connect', () =&gt; {
				$(".console").prepend($("&lt;li/&gt;").html('Connected to MQTT server'));
				client.subscribe('<font color="blue">iot/#</font>', { qos: 0 });
			});
			client.on('message', (topic, message, packet) =&gt; {
				$(".console").prepend($("&lt;li/&gt;").html("[&lt;span style='color:green'&gt;" + topic + "&lt;/span&gt;] &lt;span style='color:blue'&gt;" + message.toString() + "&lt;/span&gt;"));
			});
			client.on('error', (err) =&gt; {
				$(".console").prepend($("&lt;li/&gt;").html('Connection error'));
				client.end();
			});
			function publish_data() {
				var uid = $("#uid").val();
				var device = $("#device").val();
				var power = $("#power").val();
				client.publish('iot/' + uid, device + "." + power, { qos: 0, retain: false });
			}
			&lt;/script&gt;
			&lt;h1&gt;MQTT over Websocket&lt;/h1&gt;
			&lt;div&gt;
				&lt;input class="input input-sm" id="uid" type="input" value="<font color="blue">a1</font>"&gt;
				&lt;select class="input input-sm" id="device"&gt;
					&lt;option value="<font color="blue">1</font>"&gt;加熱裝置&lt;/option&gt;
					&lt;option value="<font color="blue">2</font>"&gt;降溫裝置&lt;/option&gt;
				&lt;/select&gt;
				&lt;input class="input input-sm" id="power" type="number" value="0" max="100" min="0"&gt;
				&lt;button class="btn btn-primary btn-sm" onclick="publish_data()"&gt;發送指令&lt;/button&gt;
			&lt;/div&gt;
			&lt;div class="console"&gt;&lt;/div&gt;
		&lt;/div&gt;
	&lt;/body&gt;
&lt;/html&gt;
</font>

</pre>
			</ul>
			<div class="h3" style="display:flex;align-items:center;"><img src="https://i.imgur.com/sDSInju.png" style="width:1em;vertical-align:middle">&nbsp;韌體</div>
			<ul>
				<p><b><a class="btn btn-xs btn-primary" data-toggle="collapse" href="#c1" role="button" aria-expanded="false" aria-controls="c1">C-1. NodeMCU(ESP8266)</a></b></p>
<pre style="background:#efe;color:#111;" class="collapse" id="c1">
#include &lt;ESP8266WiFi.h&gt;
#include &lt;PubSubClient.h&gt;

<span class="commit"><i>// WiFi</i></span>
const char *ssid = "<span class="blue">TestWifi</span>";		<span class="commit"><i>// Enter your WiFi name</i></span>
const char *password = "<span class="blue">123456789</span>";	<span class="commit"><i>// Enter WiFi password</i></span>

<span class="commit"><i>// MQTT Broker</i></span>
const char *mqtt_broker = "<span class="blue">xxx.xxx.xx</span>";
const char *topic = "<span class="blue">iot/a2</span>";
const char *mqtt_username = "<span class="blue">test</span>";
const char *mqtt_password = "<span class="blue">12345</span>";
const int mqtt_port = <span class="blue">1883</span>;

WiFiClient espClient;
PubSubClient client(espClient);

void setup() {
	<span class="commit"><i>// Set software serial baud to 115200;</i></span>
	Serial.begin(9600);
	<span class="commit"><i>// connecting to a WiFi network</i></span>
	WiFi.begin(ssid, password);
	while (WiFi.status() != WL_CONNECTED) {
		delay(500);
		<span class="commit"><i>//Serial.println("Connecting to WiFi..");</i></span>
	}
	<span class="commit"><i>//Serial.println("Connected to the WiFi network");</i></span>
	<span class="commit"><i>//connecting to a mqtt broker</i></span>
	client.setServer(mqtt_broker, mqtt_port);
	client.setCallback(callback);
	while (!client.connected()) {
		String client_id = "esp8266-client-";
		client_id += String(WiFi.macAddress());
		<span class="commit"><i>//Serial.printf("The client %s connects to the public mqtt broker\n", client_id.c_str());</i></span>
		if (client.connect(client_id.c_str(), mqtt_username, mqtt_password)) {
			<span class="commit"><i>//Serial.println("Public mqtt broker connected");</i></span>
		} else {
			<span class="commit"><i>//Serial.print("failed with state ");</i></span>
			<span class="commit"><i>//Serial.print(client.state());</i></span>
			delay(2000);
		}
	}
	<span class="commit"><i>// publish and subscribe</i></span>
	client.publish(topic, "<span class="blue">device is online</span>");
	client.subscribe(topic);
}

void callback(char *topic, byte *payload, unsigned int length) {
	char strarr[length];
	for (int i = 0; i &lt; length; i++) {
		strarr[i] = (char) payload[i];
		<span class="commit"><i>//Serial.print((char) payload[i]);</i></span>
	}
	Serial.println(strarr);
}

void loop() {
	client.loop();
}
</pre>
			</ul>
			<div class="h3" style="display:flex;align-items:center;"><img src="https://i.imgur.com/sDSInju.png" style="width:1em;vertical-align:middle">&nbsp;Heroku MQTT 測試伺服器(by HC)</div>
			<ul>
				<p><b><a class="btn btn-xs btn-primary" data-toggle="collapse" href="#d1" role="button" aria-expanded="false" aria-controls="d1">D-1. 連線資訊</a></b></p>
<pre style="background:#efe;color:#111;" class="collapse" id="d1">
<span class="noselect">host: </span><font color="blue">driver.cloudmqtt.com</font>
<span class="noselect">mqtt port: </span><font color="blue">mqtt://driver.cloudmqtt.com:18687</font>
<span class="noselect">mqtt(ssl) port: </span><font color="blue">mqtt://driver.cloudmqtt.com:28687</font>
<span class="noselect">wss(tls) port: </span><font color="blue">wss://driver.cloudmqtt.com:38687</font>
<span class="noselect">connection limit: </span><font color="blue">5</font>
<span class="noselect">user: </span><font color="blue">test</font>
<span class="noselect">pass: </span><font color="blue">12345</font>
<span class="noselect">topic: </span><font color="blue">iot/#</font>
</pre>
				<p><b><a class="btn btn-xs btn-primary" href="./heroku.html" target="_blank">D-2. 測試頁面</a></b></p>
				<p><b><a class="btn btn-xs btn-primary" data-toggle="collapse" href="#d3" role="button" aria-expanded="false" aria-controls="d3">D-3. NodeMCU(ESP8266) 韌體</a></b></p>
<pre style="background:#efe;color:#111;" class="collapse" id="d3">
#include &lt;ESP8266WiFi.h&gt;
#include &lt;PubSubClient.h&gt;

<span class="commit"><i>// WiFi</i></span>
const char *ssid = "<span class="blue">TestWifi</span>";		<span class="commit"><i>// Enter your WiFi name</i></span>
const char *password = "<span class="blue">123456789</span>";	<span class="commit"><i>// Enter WiFi password</i></span>

<span class="commit"><i>// MQTT Broker</i></span>
const char *mqtt_broker = "<span class="blue">driver.cloudmqtt.com</span>";
const char *topic = "<span class="blue">iot/a1</span>";
const char *mqtt_username = "<span class="blue">test</span>";
const char *mqtt_password = "<span class="blue">12345</span>";
const int mqtt_port = <span class="blue">18687</span>;

WiFiClient espClient;
PubSubClient client(espClient);

void setup() {
	<span class="commit"><i>// Set software serial baud to 115200;</i></span>
	Serial.begin(9600);
	<span class="commit"><i>// connecting to a WiFi network</i></span>
	WiFi.begin(ssid, password);
	while (WiFi.status() != WL_CONNECTED) {
		delay(500);
		<span class="commit"><i>//Serial.println("Connecting to WiFi..");</i></span>
	}
	<span class="commit"><i>//Serial.println("Connected to the WiFi network");</i></span>
	<span class="commit"><i>//connecting to a mqtt broker</i></span>
	client.setServer(mqtt_broker, mqtt_port);
	client.setCallback(callback);
	while (!client.connected()) {
		String client_id = "esp8266-client-";
		client_id += String(WiFi.macAddress());
		<span class="commit"><i>//Serial.printf("The client %s connects to the public mqtt broker\n", client_id.c_str());</i></span>
		if (client.connect(client_id.c_str(), mqtt_username, mqtt_password)) {
			<span class="commit"><i>//Serial.println("Public mqtt broker connected");</i></span>
		} else {
			<span class="commit"><i>//Serial.print("failed with state ");</i></span>
			<span class="commit"><i>//Serial.print(client.state());</i></span>
			delay(2000);
		}
	}
	<span class="commit"><i>// publish and subscribe</i></span>
	client.publish(topic, "<span class="blue">device is online</span>");
	client.subscribe(topic);
}

void callback(char *topic, byte *payload, unsigned int length) {
	char strarr[length];
	for (int i = 0; i &lt; length; i++) {
		strarr[i] = (char) payload[i];
		<span class="commit"><i>//Serial.print((char) payload[i]);</i></span>
	}
	Serial.println(strarr);
}

void loop() {
	client.loop();
}
</pre>
			</ul>

		</div>
		<br><br><br><br><br><br><br><br>
	</body>
</html>