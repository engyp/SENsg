#!/usr/bin/python
#!/usr/bin/env python

import sys, json, math, MySQLdb, os
from SkyhookAgent import SkyhookAgent


def processInput(APs):
  myA=SkyhookAgent('eJwVwcENACAIBLC3w5DIiYBPg7iUcXdjy4XrB4GX4xgKDSZuVqlLLpphm3wJAjZ1pNwHDHELCw','SENSESING')# Erik's Skyhook key and our ID
      
  r=myA.getLocations(APs)

  location=[r[0],r[1],r[2]]

  return location

def processMac(macstring):

  if not(macstring):
    
    return "N/A", "N/A", "N/A"

  else:
    
    macs = macstring.split(",")
    macs = filter(None, macs)
    
    APs = []

    for i in range(len(macs)):
      if i%2 == 0:
        APs.append({'macAddress': macs[i].strip(), 
                    'signalStrength': int(macs[i+1].strip())})
        
    shlist = processInput(APs)
    wlat = shlist[0]
    wlon = shlist[1]
    acc = shlist[2]

    if not(isinstance(wlat, float)):
      return "N/A", "N/A", "N/A"


  return str(wlat), str(wlon), str(acc)

def pmac():

    mfound = 0.0
    l = 0


    data = sys.argv[1]
    line = json.loads(data)

      
    mstring = ''

    if 'Node' not in line:
        a = line.split(',')
        if r'\n' not in a[7]:
            l += 1

            for i in range(7, len(a)):
                if r'\n' not in a[i]:
                    mstring += a[i] + ', '

            mstring = mstring[:-1]
            wlat, wlon, acc = processMac(mstring)

            #if wlat != "N/A":
            latlon = [wlat, wlon]
            print json.dumps(latlon)
            mfound += 1

pmac()