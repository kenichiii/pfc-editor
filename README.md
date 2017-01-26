# pfc editor :: web development tool
free opensource php&amp;jquery online web developer editor :: online IDE :: WebIDE :: WIDE

This project will be designed architecture for project first phase - creating projects based basic editor allowing adding plugins.

You can see first functional prototype of basic editor at
http://pfceditor.kena23.cz/demo/

For more information see:
http://pfceditor.kena23.cz/

You can support project at Pledgie:
https://pledgie.com/campaigns/30171

# INSTALL DEMO/NEW VERSION

Copy downloaded unpacked zip(folder) into existing web folder/webhosting with PHP 5.4+ (and mod_rewrite) support. No database is needed.

Open this web address(your web folder + unpacked folder name) ie. http://somedomain.com/pfclite(demo)/ or http://somedomain.com/somefolder/otherfolder/pfclite(demo)/.

For new version you have to move contents of web folder to root folder(also change paths in index.php) or set this folder as public where index.php is located.

both version

system settings file is /_app/config/Editor.php

paths for source code trees are located at /_app/config/Sources.php

----------------

new version

user account + setttings pfcUserData\Config\Settings file is /_data/users/<logged-user-login-name>/Config/Settings.php

ace editor default theme file is /web/pfc-editor/theme/<pfcUserData\Config\Settings::theme>/ace.editor.config.js

ace editor config file is /_data/users/default-user/Config/AceEditorSettings.php

===============================

Use this account to login:
 - login: pfclogin
 - password: pfcpassword
 - pin: pfc[hours][minutes]
 
    -> in 12:35:22 pin will be pfc1235

    -> in 12:05:21 pin will be pfc1205
    
    -> in 2:05:21 pin will be pfc205
    
    -> in 0:05:21 pin will be pfc005
    
    -> in 16:55:21 pin will be pfc1655
    
  => server time is printed for support on login page  

===============================

Enjoy working with pfc editor:
- create or change files, folders in left panel sources using right click on main folder/tab, folders, files

   -> double click on file to open it into code editor
   
- use right panel tools to help you with development
- use Sandbox to create and run php/javascript codes/files
- minimalize left/right panel to get bigger code editor
- see top right menu help for basic key bindings for code editor
- change encoding of open files by double clicking ENCODING in top open file menu
- watch sources, open file updaters -> if there is a problem they tell you
- use undo, back change buttons from open file top menu buttons
- search/replace in open file using key bindings or open file top menu buttons, use next, prev buttons/keys to list results
- select mode inserting/normal from open file top menu buttons
- save changed open files using key binding or open file top menu button Save

====================================

# CONTACT
Martin Königsmark
martinkonigsmark@gmail.com

