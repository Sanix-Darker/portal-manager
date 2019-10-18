# PORTALSDK

A client implementation of portalAPI.

## HOW TO USE IT

This is how to use it :
```python
from portalSDK import portalSDK

# We set the Token
TOKEN ="2nSftf0JYKAQ52qz6RLRfoWmPqiSPmnRFI4C3fOiMZ7RKE5LVOcv1Eb7QWLOqQikrh2cZX_zZgQJxKgbIDHGjY4Ko4LDex1vqyNu";
# We set the API address
API = "http://127.0.0.1:80/php/portal/api/";

# We instantiate the portalSDK
#? Put True to see portalSDK logs or False to hide them
#? As default is False
pSDK = portalSDK(API, TOKEN, DEBUG=False)

#
#-------------------------------------------
#| __ )  / \  |  _ \ / ___|_ _| \ | |/ ___|
#|  _ \ / _ \ | | | | |  _ | ||  \| | |  _
#| |_) / ___ \| |_| | |_| || || |\  | |_| |
#|____/_/   \_\____/ \____|___|_| \_|\____|
#-------------------------------------------
#

# TO send a Badging to the server :
# We set the matricule
matricule = "ISTDI12E004428"
# We set the status
status = "OK"
# We set the student_info
student_info = {
    "nom": "sanix",
    "prenom": "darker",
    "level": "License Management"
}
# We send the badging and get the response in badging_response
pSDK.send_badging(matricule, status, student_info)



#
#-----------------------------------------------------
# / ___/ _ \|  \/  |  \/  |  / \  | \ | |  _ \/ ___|
#| |  | | | | |\/| | |\/| | / _ \ |  \| | | | \___ \
#| |__| |_| | |  | | |  | |/ ___ \| |\  | |_| |___) |
# \____\___/|_|  |_|_|  |_/_/   \_\_| \_|____/|____/
#-----------------------------------------------------
#

#TO get the list of commands setted on the server
# To get the list of commands
command_list = pSDK.get_commands()
for index, command in enumerate(command_list):
    print(str(index+1)+"-) "+ str(command))
```

## OUTPUT

This is an output of example.py :
```shell
-------------------------------------------------------
--       BADGING PROCESS STARTED              ---------
-------------------------------------------------------
[+] Badging saved successfully!
[+] > {'BADGING_ID': '15', 'MATRICULE': 'ISTDI12E004428', 'INFO': '{"nom": "sanix", "prenom": "darker", "level": "License Management"}', 'STATUS': 'OK', 'DATE_': '2019-10-17 22:36:31'}
-------------------------------------------------------
--       GETTING COMMAND PROCESS STARTED      ---------
-------------------------------------------------------
1-) {'COMMAND_ID': '1', 'TODO': 'activate', 'ADDRESS': '92.245.12.78', 'STATUS': 'NOK', 'DATE_': '2019-10-17 16:08:16'}
2-) {'COMMAND_ID': '2', 'TODO': 'deactivate', 'ADDRESS': '11.215.12.78', 'STATUS': 'NOK', 'DATE_': '2019-10-17 16:08:16'}
3-) {'COMMAND_ID': '7', 'TODO': 'activate', 'ADDRESS': '123.45.67.211', 'STATUS': 'OK', 'DATE_': '2019-10-17 17:07:25'}
```

## TO TEST

You can run theese command for testing:
```shell
cd tests
# A complete implementation is available on ./example.py
python example.py

# To test Badging system:
# cd to the tests directory
cd tests
# Hit this command
python test_badging.py

# To test commands interactions system:
# cd to the tests directory
cd tests
# Hit this command
python test_command.py
```

## Author

- Sanix-darker