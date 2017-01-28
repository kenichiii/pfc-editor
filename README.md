# freePad
free opensource php&amp;jquery online web developer editor :: online web ide

This project will be designed architecture for project first phase - creating projects based basic editor allowing adding plugins.

You can see first functional prototype of basic editor at
http://freePad.kena23.cz/demo/web/

For more information see:
http://freePad.kena23.cz/


# INSTALL DEMO/NEW VERSION

Copy sources into existing web-folder/webhosting with PHP 7+ (and mod_rewrite) support.
No database is needed.


new version:

- system settings file is: 
./_app/config/Editor.php

- paths for source code trees are located at: 
./_app/config/Sources.php

- user account + setttings pfcUserData\Config\Settings file is:
./_data/users/[logged-user-login-name]/Config/Settings.php

- ace editor default theme file is:
/web/pfc-editor/theme/[theme-name]/ace.editor.config.js

- ace editor config file is:
./_data/users/default-user/Config/AceEditorSettings.php

 
- is set to have nologin mode on, RUN ONLY FROM LOCALHOST or change system settings class const nologin = true; 
Use this account to login:
 - login: default-user
 - password: pfcpassword
 - pin: pfc[hours][minutes]
 
    -> in 12:35:22 pin will be pfc1235

    -> in 12:05:21 pin will be pfc1205
    
    -> in 2:05:21 pin will be pfc205
    
    -> in 0:05:21 pin will be pfc005
    
    -> in 16:55:21 pin will be pfc1655
    
  => server time is printed for support on login page  

==========================================================

# CONTACT
Martin Königsmark
martinkonigsmark@gmail.com

