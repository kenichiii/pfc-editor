# pfc editor :: web development tool
free opensource php&amp;jquery online web developer editor :: online IDE :: WebIDE :: WIDE

This project is in first development stage. Existing version is called version 0.1beta - its first functional prototype, which starts from having textarea with file contents. This version wasnt designed as application, but was created with small steps adding needed functionality. Goal of this prototype is show author what will be needed and what is nesecesary to keep in mind when will be designed architecture for project first phase - creating projects based basic editor allowing adding plugins.

You can see first functional prototype of basic editor at
http://pfceditor.kena23.cz/demo/

For more information see:
http://pfceditor.kena23.cz/

You can support project at Pledgie:
https://pledgie.com/campaigns/30171

# INSTALL DEMO

Copy downloaded unpacked zip(folder) into existing web folder/webhosting with PHP 5.4+ and mod_rewrite support. No database is needed.

Open this web address(your web folder + unpacked folder name) ie. http://somedomain.com/pfclite(demo)/ or http://somedomain.com/somefolder/otherfolder/pfclite(demo)/.

---------------------------------------

Use this account to login:
 - login: pfclogin
 - password: pfcpassword
 - pin: hours[hours]mins[minutes]sufix
 
    -> in 12:35:22 pin will be hours12mins35sufix

    -> in 12:05:21 pin will be hours12mins05sufix
    
    -> in 2:05:21 pin will be hours2mins05sufix
    
    -> in 0:05:21 pin will be hours0mins05sufix
    
    -> in 16:55:21 pin will be hours16mins55sufix
    
  => server time is printed for support on login page  

----------------------------------------------

After login in visit top right menu "config":
- change basic section

    -> create some unique project SALT 
    
    -> you can turn sounds on/off
    
- edit account section
    
    -> change login, password, pin

    -> if supported switch to Bcrypt password protection
    
- you can edit php settings section

    -> add your server timezone

    -> more php settings are supported

Refresh/Reload page to get changes visible.

------------------------------------------------

Optionaly you can edit editor ./app/config/Sources.php to manage sources paths/main folders/left panel tabs.

Some application settings(javascript) as sources, open files updaters and routes definitions are located at the end/bottom of editor ./app/layout/layout.php.

CodeMirror config is located at editor ./assets/pfc-editor/config/codeMirror.js. CodeMirror theme should be filename without extension from editor ./assets/libs/codemirror/themes/.

Again reload page to get changes visible.

------------------------------------------

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

