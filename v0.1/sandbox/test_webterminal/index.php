<?php
/**
 * Terminal interface
 * This is the terminal interface.
 * Here is all the html output, javascript and styles.
 * As we see, in the bottom of the file, the process of the terminal starts
 * after the end of html tag.
 * The outputs of the terminal is javascript comming from Terminal::output().
 *
 * @author Thiago Bocchile <tykoth@gmail.com>
 */
//die('die on line 12of index.php');

set_time_limit(0);
error_reporting(E_ALL);

/**
 * The includes.
 */
include("process.class.php");
include("terminal.class.php");

/**
 * The command comes from ajax-post.
 */
if(isset($_POST['stdin'])){
    Terminal::postCommand($_POST['stdin']);
    exit;
}

/**
 * The authentication.
 * You can change this method.
 * I've used Auth Basic as example.
 */
/*
if (!isset($_SERVER['PHP_AUTH_USER']) ||
    !Terminal::autenticate('root','kenakena23')) {
    header('WWW-Authenticate: Basic realm="xwiterm (use your linux login)"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Authentication failure :)";
    exit;
}
*/
Terminal::autenticate('root','kenakena23');


/**
 * For brazilians only: "UTF8 MANOLO!"
 */
header("Content-type: text/html; charset=utf8");


?>
<html>
    <head>
        <title>xwiterm - <?php echo Terminal::getTitle(); ?></title>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript">
            var bash_history = [];
            var bash_stop = 0;
            function manda(valor, clean){
                $.post("index.php", {"stdin":valor}, function(data){
                    return true;
                });
                if(clean == true){
                    $(".stdin").val("").focus();
                } else {
                    $(".stdin").focus();
                }
                if(
                    valor.charCodeAt(0) != 3 ||
                    valor.charCodeAt(0) != 4 ||
                    valor.charCodeAt(0) != 26 
                ){
                    bash_history.push(valor);
                    bash_stop = bash_history.length;
                }
            }

            // muito cara de aula de C da faculdade kkkk
            function recebe(valor, type){
                if(valor != "" || valor != null){
                    $("label").before( valor );
                }
                if(typeof(type) != "undefined" && type != ""){
                    $('.stdin').val(type)
                }
                $(".stdin").parent().css({
                    "left":$("pre > span:last").width() + "px"
                });
                $(".stdin").removeAttr("readonly").focus();
                window.scrollTo(0,document.body.scrollHeight);
            }
        </script>
        <style>
        body {
            background-color:#000;
            color:#FFF;
        }
        .stdin {
            background-color:#000000;
            border:0 none;
            color:#FFFFFF;
            font-family:inherit;
            font-size:12px;
            line-height:inherit;
            margin:0;
            outline-style:none;
            outline-width:0;
            padding:0;
            width:100%;
        }
        p{ margin:0;}
        label {
            position:absolute;
            right:0; left:200;
        }
        tt {font-weight: bold}
        .bottom { /* future... */
            border:1px solid white;
        }
        </style>
    </head>
    
    <body>
        <pre><label><input type="text" name="stdin" class="stdin" autocomplete="off"/></label></pre>
  

<script>
        /**
         * This tag "script" is placed here because we can't use "onload" or
         * $(document).ready() - the document only loads after close the terminal.
         */
        $(".stdin").keydown(function(e){
                if($(this).is("[readonly]")) return false;
                code = e.keyCode ? e.keyCode : e.which;

                if(code.toString() == 13) manda(this.value, true);
                if(code.toString() == 9) {
                    e.preventDefault();
                    manda(this.value + String.fromCharCode(9), false);
                    return false;
                }
                if(code.toString() == 38) {
                    if(bash_stop <= 0) bash_stop = 1;
                    this.value = bash_history[bash_stop-1];
                    bash_stop--;
                }
                if(code.toString() == 40) {
                    bash_stop++;
                    if(bash_stop >= bash_history.length){
                        this.value = '';
                        bash_stop = bash_history.length;
                    } else {
                        this.value = bash_history[bash_stop];
                    }

                }
                if(e.ctrlKey && code.toString() == 67) {
                    e.preventDefault();
                    manda(String.fromCharCode(3), true);
                    return false;
                }
                if(e.ctrlKey && code.toString() == 68) {
                    e.preventDefault();
                    manda(String.fromCharCode(4), true);
                    return false;
                }
                if(e.ctrlKey && code.toString() == 90) {
                    e.preventDefault();
                    manda(String.fromCharCode(26), true);
                    return false;
                }
        });
        $(".stdin").val("").focus();

        $("body").click(function(){
            $(".stdin").focus();
        })
    </script>
  </body>  
</html>
  <?php
var_dump(array());
/**
 * All the output is made by this simple method.
 */
   Terminal::run('root','kaaaa');
?>
