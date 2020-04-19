#Python code to illustrate parsing of XML files 
# importing the required modules 
# Referensi: https://www.geeksforgeeks.org/xml-parsing-python/
#            https://www.w3schools.com/python/python_mysql_insert.asp
# import csv 
import os
import sys
import logging
import datetime
import requests 
import xml.etree.ElementTree as ET 
#import mysql.connector 
import pymysql

logger = logging.getLogger()
logger.setLevel(logging.INFO)

def connectToDB(): 
	host = "database-travelspot.cawo3rh1m9f3.ap-southeast-1.rds.amazonaws.com"
	database = "travelspot"
	user = "crawler1"
	password = "jO6wm9QwGvv8JKwLUQ2D60tAE3il1XRU"
	try:
		mydb = pymysql.connect(host, user, password, database)
	except pymysql.MySQLError as e:
		logger.error("ERROR: Unexpected error: Could not connect to MySQL instance.")
		logger.error(e)
		sys.exit()
	logger.info("SUCCESS: Connection to RDS MySQL instance succeeded")
	return mydb

def queryChannels(): 
	db = connectToDB()
	mycursor = db.cursor()
	mycursor.execute("SELECT * FROM `rss_channels` WHERE `status` = '1'")
	myresult = mycursor.fetchall()
	return myresult

def loadRSS(channel): 
	# url of rss feed 
	url = channel[3]
	channel_id = channel[0]

	# creating HTTP response object from given url 
	try:
		resp = requests.get(url) 
	except requests.exceptions.RequestException as e:
		logger.error(e)

	# # saving the xml file 
	# x = datetime.datetime.now()
	# filename = "newsfeed_" + str(channel_id) + "_" + x.strftime("%Y%m%d%H%M%S") + ".xml"
	# with open(filename, 'wb') as f: 
	# 	f.write(resp.content) 

	# return {"channel_id": channel_id, "xmlfile": filename}
	return {"channel_id": channel_id, "xmlfile": resp.content}

def parseXML(xmlfile): 
	# create element tree object 
	# tree = ET.parse(xmlfile) 

	# get root element 
	# root = tree.getroot() 
	root = ET.fromstring(xmlfile) 

	# create empty list for news items 
	newsitems = [] 

	# # iterate news items 
	for item in root.findall('./channel/item'): 
		# empty news dictionary 
		news = {} 

		# # iterate child elements of item 
		for child in item: 
			if(child.tag == 'title' or child.tag == 'description' or child.tag == 'link' or child.tag == 'pubDate'): 
				news[child.tag] = child.text 

		# append news dictionary to news items list 
		try: 
			title = news["title"]
			description = news["description"]
			link = news["link"]
			pubDate = news["pubDate"]
			newsitems.append(news) 
		except:
			print("missing tag")

	# return news items list 
	return newsitems 

def savetoDatabase(newsitems, channel_id): 

	db = connectToDB()
	mycursor = db.cursor()

	for item in newsitems: 
		sql = "INSERT INTO rss_feeds (rss_channel_id, title, pub_date, description, link) VALUES (%s, %s, %s, %s, %s)"		
		month = {"Jan":"01","Feb":"02","Mar":"03","Apr":"04","May":"05","Jun":"06","Jul":"07","Aug":"08","Sep":"09","Oct":"10","Nov":"11","Dec":"12"}
		pubDate = item["pubDate"]
		nDate = pubDate[5:7]
		nMonth = pubDate[8:11]
		nYear = pubDate[12:16]
		nTime = pubDate[17:25]
		pub_date = '{}-{}-{} {}'.format(nYear, month[nMonth], nDate, nTime)
		# print(pub_date)
		# print(nYear.month[nMonth].nDate)
		try: 
			val = (channel_id, item["title"], pub_date, item["description"], item["link"])
			mycursor.execute(sql, val)
		except (pymysql.MySQLError) as e: 
			print(e)
			# print("Skip `{}` ({})".format(item["title"], pub_date))

	db.commit()
	print(mycursor.rowcount, "record berhasil di-INSERT.")

#def handler(event,context): 
def main(): 
	channels = queryChannels()
	for channel in channels: 
		logger.info("LOADING channel..")
		myRSS = loadRSS(channel) 

		# parse xml file 
		newsitems = parseXML(myRSS.get("xmlfile")) 

		# store news items into Database 
		savetoDatabase(newsitems, myRSS.get("channel_id")) 

if __name__ == "__main__": 
	
 	# calling main function 
 	main() 

