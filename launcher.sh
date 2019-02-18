#!/bin/sh
# launcher.sh
# navigate to home directory, then to this directory, then execute python script, then back home

cd /
cd home/pi/Source/moodboard
sudo python3 moodboard.py
cd /
