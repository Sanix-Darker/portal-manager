from portalSDK import portalSDK
import time
from data_for_test import data_for_test

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


for student in data_for_test:
    print("-----------------------------------------")
    time.sleep(7)
    # TO send a Badging to the server :
    # We set the matricule
    matricule = student["matricule"]
    # We set the status
    status = student["status"]
    # We set the student_info
    student_info = student["student_info"]
    # We send the badging and get the response in badging_response
    pSDK.send_badging(matricule, status, student_info)