#
# portalSDK
# Created by sanix-darker
# A simple SDk to interact with the portal API
#

from os import system
import json
try: import requests
except Exception as e: print("[+] requests is not installed, please install it!")

class portalSDK:

    def __init__(self, API, TOKEN, DEBUG=False):
        self.API = API
        self.TOKEN = TOKEN
        self.DEBUG = DEBUG


    def login(self):
        # Une methode potentiellement pour le login dans un futur
        pass


    def logg(self, _object):
        if self.DEBUG == True: print("\n"+_object)



    def req(self, host, method, data = {}):
        """[summary]

        Arguments:
            host {[type]} -- [description]
            method {[type]} -- [description]

        Keyword Arguments:
            data {dict} -- [description] (default: {{}})

        Returns:
            [type] -- [description]
        """
        try:
            if (method.upper() == "GET"):
                self.logg("[+] GET request to : "+str(host))
                return requests.get(host).content.decode('utf-8')
            elif (method.upper() == "POST"):
                self.logg("[+] POST request to : "+str(host)+", data: "+str(data))
                return requests.post(host, json = data).content.decode('utf-8')
        except Exception as es:
            self.logg(es)
            self.logg("[+]Maybe Not internet access")
            return "An Error occur"



    def badging_process(self, matricule, status, student_info):
        """[This method will send badging]

        Arguments:
            matricule {[type]} -- [description]
            status {[type]} -- [description]
            student_info {[type]} -- [description]

        Returns:
            [dict] -- [The response of the badging process]
        """
        data_to_send = {
            "matricule": matricule,
            "info": json.dumps(student_info),
            "status": status
        }
        badging_link = self.API+"?page=badging&token="+self.TOKEN+"&cible=create"
        response = self.req(badging_link, "post", data_to_send)
        self.logg("[+] Response : "+str(response))

        return json.loads(str(response))



    def send_badging(self, matricule, status, student_info):
        """[summary]

        Arguments:
            matricule {[type]} -- [The matricule of the user]
            status {[type]} -- [Ok or NOK to define if th process was done successfully or not]
            student_info {[dict]} -- [Student informations]
        """
        print("-------------------------------------------------------")
        print("--       BADGING PROCESS STARTED              ---------")
        print("-------------------------------------------------------")
        badging_response = self.badging_process(matricule, status, student_info)

        # We print the padging response
        if badging_response["status"] == "success":
            print("[+] Badging saved successfully!")
            print("[+] > "+str(badging_response["output"]))
        else:
            print("Problem on Badging saving!")



    def get_commands(self):
        """[This method will get commands in a certain frequency]

        Returns:
            [dict] -- [Anarray of commands]
        """
        print("-------------------------------------------------------")
        print("--       GETTING COMMAND PROCESS STARTED      ---------")
        print("-------------------------------------------------------")
        self.logg("[+] Fetching commands")
        command_link = self.API+"?page=command&token="+self.TOKEN
        response = self.req(command_link, "get")
        self.logg("[+] Response : "+str(response))

        return json.loads(str(response))["result"]



    def send_command_status(self, status, command_address):
        """[summary]

        Arguments:
            status {[type]} -- [description]
            command_address {[type]} -- [description]

        Returns:
            [type] -- [description]
        """
        data_to_send = {
            "status": status,
            "address": command_address
        }
        update_command_status_link = self.API+"?page=command&token="+self.TOKEN+"&cible=update"
        response = self.req(update_command_status_link, "post", data_to_send)
        self.logg("[+] Response : "+str(response))

        return json.loads(str(response))

    def update_command_status(self, status, command_address):
        """[summary]

        Arguments:
            status {[type]} -- [description]
            command_address {[type]} -- [description]
        """
        print("-------------------------------------------------------")
        print("--      UPDATE COMMAND STATUS PROCESS STARTED ---------")
        print("-------------------------------------------------------")
        update_response = self.send_command_status(status, command_address)

        # We print the padging response
        if update_response["status"] == "success":
            print("[+] Update of the command status done successfully!")
            print("[+] > "+str(update_response["output"]))
        else:
            print("Problem on Update of the command status!")