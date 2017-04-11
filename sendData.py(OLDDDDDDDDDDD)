import mysql.connector
import random
import urllib2
import json

#wundergound

#Generating random data
temperature = random.randint(50, 99)
pressure_orig = random.uniform(28.0, 34.0)
pressure =float("{0:.2f}".format(pressure_orig)) #2 point precision
humidity = random.randint(0, 100)

print temperature, pressure, humidity


#mysql stuff
cnx = mysql.connector.connect(user='cpsc4240',
				password='password',
				host='192.168.0.5',  
				database='cpsc424_6jt3')

cursor = cnx.cursor()

query = ("INSERT INTO weather_attrs(timestamp, temperature, gps, pressure, humidity) VALUES (UTC_TIMESTAMP, %s, %s, %s, %s)")
args = (temperature, '34.68, 82.83', pressure, humidity)


#cursor.execute("INSERT INTO weather_attrs (timestamp, temperature, gps, pressure, humidity) VALUES (UTC_TIMESTAMP, '88', '32.77, 32.88', '30.10', '70')")
cursor.execute(query, args);

cnx.commit()

cnx.close()
