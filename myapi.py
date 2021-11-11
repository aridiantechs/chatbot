import requests
from flask import request


sender = input("What is your name?\n")
bot_message = ""
while bot_message != "Bye":
    message = input("What's your message?\n")
    print("Sending message now")
    if message.endswith("2") == False:
        r = requests.post("http://localhost:5008/webhooks/rest/webhook", json={"sender": sender, "message": message})
    else:
        r = requests.post("http://localhost:5002/webhooks/rest/webhook", json={"sender": sender, "message": message})
    print("boy says, ", end=' ')
    for i in r.json():
        bot_message = i['text']
        print(f"{i['text']}")
    #if 'json' in r.headers.get('Content-Type'):
      #  js = r.json()
       # for i in js:
          #  bot_message = i['text']
          #  print(f"{i['text']}")
   # else:
    #    print('Response content is not in JSON format.')