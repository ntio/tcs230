#!/usr/bin/python
import time
import serial
import json
import MySQLdb
puerto_serie=serial.Serial("/dev/ttyACM0",9600)
monitor_activo=0
while 1:
  character=puerto_serie.readline().strip()
  MyJson= character
  db = MySQLdb.connect("localhost","user","pass","arduino")
  print(character)
  if character != '\n':
      try:
       data=json.loads(character)
       print (data)
       curs = db.cursor()
       curs.execute("INSERT INTO tcs230(rojo,verde,azul)values("+str(data['rojo'])+","+str(data['verde'])+","+str(data['azul'])+")")
       db.commit()
      except ValueError:
        print (" error")
 
 

puerto_serie.close() # Nunca llega a ejecutarse al estar fuera del bucle while pero se incluye para ilustrar la secuencia correcta de manejo de un puerto serie en Python con PySerial
