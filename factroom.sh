#!/bin/bash
 
 
# sleep time in seconds
SLEEPTIME="10"
 
[ -n "$1" ] && SLEEPTIME="$1"
 
NOW="`date '+%s'`"
LASTTIME_FILE="/dev/shm/factroom.lasttime"
[ ! -e "$LASTTIME_FILE" ] && echo "$NOW" > $LASTTIME_FILE
LASTTIME=`cat "$LASTTIME_FILE"`
 
if [ `expr $NOW - $LASTTIME` -gt $SLEEPTIME ] ; then
    wget -t 2 -T 1 -qO- 'http://www.factroom.ru/random/' | sed -n '/<title>\|\/random\/[0-9]\+\//p' | tr -d '\n' | sed -e 's/^<title>\t\?\(.*\)\ #.\+.*\(\/random\/[0-9]\+\/\).*$/\1 \t >>> www.factroom.ru\2\n/'
    echo "$NOW" > $LASTTIME_FILE
fi