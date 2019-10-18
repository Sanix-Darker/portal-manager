import time
from random import randrange
from data_for_test import data_for_test

from os import path as ospath
from sys import path as syspath
# moving the path outside of the current dir
syspath.insert(1, ospath.join(syspath[0], '..'))

from PortalSDK import PortalSDK


# We set the Token
TOKEN ="2nSftf0JYKAQ52qz6RLRfoWmPqiSPmnRFI4C3fOiMZ7RKE5LVOcv1Eb7QWLOqQikrh2cZX_zZgQJxKgbIDHGjY4Ko4LDex1vqyNu";
# We set the API address
API = "http://127.0.0.1:80/php/portal/api/";

# We instantiate the portalSDK
#? Put True to see portalSDK logs or False to hide them
#? As default is False
pSDK = PortalSDK(API, TOKEN, DEBUG=False)

#
#-------------------------------------------
#| __ )  / \  |  _ \ / ___|_ _| \ | |/ ___|
#|  _ \ / _ \ | | | | |  _ | ||  \| | |  _
#| |_) / ___ \| |_| | |_| || || |\  | |_| |
#|____/_/   \_\____/ \____|___|_| \_|\____|
#-------------------------------------------
#

for student in data_for_test:
    print("\n-")
    time.sleep(randrange(10)) # A timer randomly between 1 to 10
    # TO send a Badging to the server :
    # We set the matricule
    matricule = student["matricule"]
    # We set the status
    status = student["status"]
    # We set the student_info
    student_info = student["student_info"]
    # We send the badging and get the response in badging_response
    pSDK.send_badging(matricule, status, student_info)