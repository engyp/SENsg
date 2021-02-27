#!/usr/bin/env python
# Skyhoook lookup library
# Quick'N'dirty TM
# Nils, SUTD, 2014
# API is documented in PDF
#import grequests
import requests
import xml.etree.ElementTree as ET
#import site
from requests_futures.sessions import FuturesSession


#site.addsitedir("/var/www/sensesing")


#silent=1

#responeFile='/var/www/sensesing/uploads/lastResponse'

class SkyhookAgent():
    
    def __init__(self, key, ID):
        self.agent(key,ID)

    # APs should be a list of lists of strings, each a MAC address in hex
    # no colons should be present
    # e.g.: ["0C4DE9AAF11C","0C4DE9AAF11D"]
    def getLocations(self, APs):
        if APs is None:
            return "ERROR: No MACs provided"
        # now process each list of APs 
        query = self.genQuery(APs)
        myReply=self.session.post(query[0], data=query[1], headers=query[2])
        location = self.parseResponse(myReply.result())
        return location
        
    def agent(self, key, ID):

        self.session = FuturesSession(max_workers=10)

#       self.agent = requests.Session()
        self.key=key
        self.ID=ID
            
    def genQuery(self, APs):
        url='https://api.skyhookwireless.com/wps2/location'
        headers = {'content-type': 'text/xml'}
        # Start to build the query string based on API
        # for some reason, python sometimes acts up here sometimes
        try:
            query = myHeader
            query+='<key key="' 
            query+= self.key
            query+='" username="' + self.ID + '"/></authentication>'
        except e:
            print('Error while constructing query string!'+self.ID+self.key)
            return None
        # assemble the list of APs
        for ap in APs:
            macAd= ap['macAddress']
            query+='<access-point><mac>' + macAd.replace(':', '').upper() + '</mac>'
            # Ignore ssid for now
            # <ssid>'+BJC408</ssid>
            # Are we getting SNR or RSSI from the node?
            noiseFloor=-120
            rssi=ap['signalStrength']
            if int(rssi)>0:
                rssi=str(int(rssi)+noiseFloor)
            query+='<signal-strength>'+rssi+'</signal-strength>'
            query+='</access-point>\n'

        query+='</LocationRQ>'
        # To verify the data before sending:
        # print query        
        #return self.agent.post(url, data=query, headers=headers)
        return [url,query,headers]
    
    def parseResponse(self,r):
        # lets log the response to a file for now
        #with open(responeFile,'w') as f:
        #    f.write(r.text)
        if r.status_code==requests.codes.ok:
            # print r.text
            if r.text is None:
                return 'ERROR: no response text '
            try:
                root = ET.fromstring(r.text)
                ns='{http://skyhookwireless.com/wps/2005}'
                if root is None:
                    return 'ERROR: root not found'
                loc=root.find(ns+'location')
                respError=root.find(ns+'error')
                if loc is not None:
                    lat = float(loc.find(ns+'latitude').text)
                    lng = float(loc.find(ns+'longitude').text)
                    acc = float(loc.find(ns+'hpe').text) # not sure if API provides this
                    return lat, lng, acc
                elif respError:
                    return 'ERROR: Skyhook returned: '+error.text
                else:
                    return 'ERROR: Skyhook location not found: '+r.text
            except e: 
                return 'ERROR: XML parsing error'+e
        else:
            #print r.text
            return 'ERROR: '+str(r.status_code)


myHeader= """\
<LocationRQ xmlns="http://skyhookwireless.com/wps/2005"
version="2.21"
street-address-lookup="full">
<authentication version="2.2">
"""
