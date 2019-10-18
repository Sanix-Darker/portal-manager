from os import path as ospath
from sys import path as syspath
# moving the path outside of the current dir
syspath.insert(1, ospath.join(syspath[0], '..'))

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


# - TO Update the status of a specific command
#
# We set the address of the portal
command_address = "72.45.67.87"
# We set the status
status = "OK"
# We update the status in the API
pSDK.update_command_status(status, command_address)