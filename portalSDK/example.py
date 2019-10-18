from PortalSDK import PortalSDK

# We set the Token
TOKEN ="2nSftf0JYKAQ52qz6RLRfoWmPqiSPmnRFI4C3fOiMZ7RKE5LVOcv1Eb7QWLOqQikrh2cZX_zZgQJxKgbIDHGjY4Ko4LDex1vqyNu";
# We set the API address
API = "http://127.0.0.1:80/php/portal/api/";

# We instantiate the portalSDK
#? Put True to see portalSDK logs or False to hide them
#? As default is False
pSDK = PortalSDK(API, TOKEN, DEBUG=False)

# -----------------------------------------------------------------------------------

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


# -----------------------------------------------------------------------------------


#
#-----------------------------------------------------
# / ___/ _ \|  \/  |  \/  |  / \  | \ | |  _ \/ ___|
#| |  | | | | |\/| | |\/| | / _ \ |  \| | | | \___ \
#| |__| |_| | |  | | |  | |/ ___ \| |\  | |_| |___) |
# \____\___/|_|  |_|_|  |_/_/   \_\_| \_|____/|____/
#-----------------------------------------------------
#

# - TO get the list of commands setted on the server
#
# We get the list of commands
command_list = pSDK.get_commands()
for index, command in enumerate(command_list):
    print(str(index+1)+"-) "+ str(command))

# ---------------------


# - TO Update the status of a specific command
#
# We set the address of the portal
command_address = "72.45.67.87"
# We set the status
status = "OK"
# We update the status in the API
pSDK.update_command_status(status, command_address)

# -----------------------------------------------------------------------------------
