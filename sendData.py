import mysql.connector
import random
import urllib2
import json
import re

#wundergound data gathering
f = urllib2.urlopen('http://api.wunderground.com/api/b5bc40ba034473fd/geolookup/conditions/q/IA/Clemson.json')
json_string = f.read()
parsed_json = json.loads(json_string)
temperature = parsed_json['current_observation']['temp_f']
humidity = parsed_json['current_observation']['relative_humidity']
pressure = parsed_json['current_observation']['pressure_in']
print "Current temp is %s" % temperature
f.close()
 
#getting GPS Location
url = 'http://ipinfo.io/json'
response = urllib2.urlopen(url)
data = json.load(response)
GPS_city = data['city']
GPS_loc = data['loc']
ip_addr = data['ip']

#Generating random data
#temperature = random.randint(50, 99)
#pressure_orig = random.uniform(28.0, 34.0)
#pressure =float("{0:.2f}".format(pressure_orig)) #2 point precision
#humidity = random.randint(0, 100)

print temperature, pressure, humidity


#mysql stuff
cnx = mysql.connector.connect(
#				user='cpsc4240',
				user='cpsc424_eecr',
				password='L33tD@t@b@s3PAsSWoord',
#				password='password',
#				host='198.21.195.81',  
				host='162.243.213.116',
				database='cpsc4240')
#				database='cpsc424_6jt3')

cursor = cnx.cursor()

#Sending Data
query = ("INSERT INTO weather_attrs(timestamp, temperature, gps, pressure, humidity, session) VALUES (UTC_TIMESTAMP, %s, %s, %s, %s, %s)")
args = (temperature, GPS_loc, pressure, humidity, ip_addr)
#cursor.execute("INSERT INTO weather_attrs (timestamp, temperature, gps, pressure, humidity) VALUES (UTC_TIMESTAMP, '88', '32.77, 32.88', '30.10', '70')")
cursor.execute(query, args);

cnx.commit()

cnx.close()
