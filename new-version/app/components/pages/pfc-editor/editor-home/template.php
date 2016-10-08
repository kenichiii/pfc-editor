
<br>
<h1>
  <span style="color:greenyellow;">pfc <em style="color:lightskyblue">lite</em></span> 
  <span style="color:lightsteelblue;font-weight:normal;"><span style="color:greenyellow">editor</span> 
  <span style="font-size:0.75em;">[[v0.1beta]]</span></span>
</h1>

<ul>
    
    <li>use new php backend + models User, Project(s), Sources</li>
   
    <li>app header, tools to config</li>
    
    <li>pages add controller script</li>
    
    <li>projects -> default,html,php -> sources, pages(apps), tools</li>
    
    <li>javascript router -> generate links for page, section, tools, ajax, action</li>
    
    
</ul>

<br>  
<div style="float:right;max-width:250px">
  <b>FINDED BUGS:</b><br>
  - if sources change name from upercase to small updater not find our <br>
  - sources, editor tabs, tools remember scrolltop+left -> load from state, on active<br>
  - sources if file first in tree after auto-update add folder is not add before<br> 
  - sources auto-update add folder after open folder inside this folder<br>
  - editor header tabs -> scrollLeft:0 when open new file<br>
  - sources -> get folder -> return json only<br>
  - sources attributtes -> only linux?<br>
  
  - sources(left panels) dont hide with display -> use z-index -> dont reset scrollbar!!!!<br>
  - open file -> add php memory limit check to filesize<br>
 


  - editor header -> filepath in scrolled header has big margin-left<br>

  - sources check if scandir is allowed to scan<br>

  - editor open file -> check is writable<br>
  - sources prevent re-loading/click on opening/waiting folder
  - five click in row to sources href -> left panel disapear<br>

  - sources public folder better protection to not display editor folder<br>

  - sources add file to not expanded folder->open<br>

  - sources [context rename] take wrong path in js<br>


  - clean inner css from templates<br>

  - left panel add trigger reopen before try to load<br>

  - ui alerts play sound when come not when is called<br>  




  (- sources load big folder in small(short) pieces -> firefox things that script is wrong [timeout])
</div>

<div style="float:left;max-width:400px;">

<h3>MISSING:</h3>
- graphical design<br>
  --> add .htaccess, .json file icon<br>
- sounds only after save -> add some better<br><br>
  <h3>app</h3>
<p>
  - login add reset password to email+pin function<br>
  
  
<br>
  - add install script -> gen salt, confirm to config, install info on homepage<br>
  
  
</p>
<br>
  <h3>editor</h3>
<p>
- add auto-save for files -> configurable<br>
- sandbox fix open to blank page<br>
- reload, close after modification at the background<br>

(- add jquery media support)<br>
(- add image viewer)<br>

  
</p>
<br>
  <h3>sources</h3>
<p>
- finish context menu<br>
        - add copy, move<br>
        - add zip, unzip, tarball, unpack tar<br>
        - add download ziped folder<br>

(- add select group option)<br>
(- add drag&amp;drop)
</p>
<br>
  <h3>tools</h3>
<p>  
- tools snippets add basic/example new html5 file, some javascript<br>  
(- snippets add from form support)<br>
- calculator add ACTIVE|OFF keybord support<br>
- calculator add math interface toggling button+width fix support<br>
</p>
<br>

<br>

homepage<br>
  - add news feed load from external server<br>
<br><br>
css<br>
  - finish skin file

<br><br>

</div>



