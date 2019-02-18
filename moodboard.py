#!/usr/bin/env python

import mysql.connector as mariadb
import RPi.GPIO as GPIO

#---------------------------------------------------------------
#                               Globals
#---------------------------------------------------------------

db = 0
cursor = 0

#---------------------------------------------------------------
#                               Functions
#---------------------------------------------------------------

def InitDb():
    global db
    global cursor

    if db == 0:
        db = mariadb.connect(user="dbuser", password="harvestmood", database="moods")
        cursor = db.cursor()
            
def InsertMood(mood):
    global db
    global cursor
    
    try:
        InitDb()
        query = "INSERT INTO EmployeeMoods (mood) VALUES (%s)"
        data = (mood, )
        cursor.execute(query, data)
        db.commit()
    except mariadb.Error as error:
        print("Error: {}".format(error))
    return

def ReadMoods(cursor):
    InitDb()
    cursor.execute("SELECT * FROM EmployeeMoods")

    for _id, pushedAt, mood in cursor:
        print (str(_id) + " " + str(pushedAt) + " " + str(mood))

def GetMoodCount(cursor):
    InitDb()
    cursor.execute("SELECT COUNT(*) FROM EmployeeMoods")
    print(cursor.fetchone()[0])

def InputCallback(channel):
    
    print("-- EDGE CHANNEl " + str(channel) + " --")
    global db
    global cursor
    
    mood = 0

    if channel == 11:
        mood = 1
    elif channel == 13:
        mood = 2
    elif channel == 15:
        mood = 3

    InsertMood(mood)

#---------------------------------------------------------------
#                               Code
#---------------------------------------------------------------

chGreenButton = 11
chYellowButton = 13
chRedButton = 15
delay = 1000

GPIO.setmode(GPIO.BOARD)

GPIO.setup(chGreenButton, GPIO.IN)
GPIO.add_event_detect(chGreenButton, GPIO.FALLING, bouncetime=delay)
GPIO.add_event_callback(chGreenButton, InputCallback)

GPIO.setup(chYellowButton, GPIO.IN)
GPIO.add_event_detect(chYellowButton, GPIO.FALLING, bouncetime=delay)
GPIO.add_event_callback(chYellowButton, InputCallback)

GPIO.setup(chRedButton, GPIO.IN)
GPIO.add_event_detect(chRedButton, GPIO.FALLING, bouncetime=delay)
GPIO.add_event_callback(chRedButton, InputCallback)

while True:
    a = 1
    a = a

db.close()
GPIO.cleanup()