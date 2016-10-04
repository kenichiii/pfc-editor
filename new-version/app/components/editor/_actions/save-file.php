<?php

$fs = new \PFC\Editor\Sources($_POST['root']);

 $path = $_POST['path'];
 $text = $_POST['code'];
 $enc  = $_POST['encoding'];
 $notConfirmedOverWrite = isset($_POST['confirmedOverwrite']) && $_POST['confirmedOverwrite']=='yes' ? false : true;
   
 if($enc!=='UTF-8')
   {
   /*
		  $supportedTransEnc = array('ISO-8859-1', 	'ISO8859-1',
                                    'ISO-8859-5', 	'ISO8859-5',
                                    'ISO-8859-15', 	'ISO8859-15',
                                    'UTF-8',
                                    'cp866', 	'ibm866', '866',
                                    'cp1251', 	'Windows-1251', 'win-1251', '1251',
                                    'cp1252', 	'Windows-1252', '1252',
                                    'KOI8-R', 	'koi8-ru', 'koi8r',
                                    'BIG5', 	'950',
                                    'GB2312', 	'936',
                                    'BIG5-HKSCS', 	 
                                    'Shift_JIS', 	'SJIS', 'SJIS-win', 'cp932', '932',
                                    'EUC-JP', 	'EUCJP', 'eucJP-win',
                                    'MacRoman');
   
          if(in_array($enc,$supportedTransEnc))
                 $textToConvert = htmlentities($text,ENT_HTML5,'UTF-8');
          else $textToConvert = $text;
          */  
                 $textToConvert = mb_convert_encoding($text, $enc,'UTF-8');
          /*
          if(in_array($enc,$supportedTransEnc))
                 $textToSave = html_entity_decode($textToConvert,ENT_HTML5,$enc);
          else
          {
            */
            $textToSave = $textToConvert;   
   
        
             $test = mb_convert_encoding($textToSave, 'UTF-8',$enc);
          //}
   
          		if( $test!=$text && $notConfirmedOverWrite )
                {
                   echo json_encode(array(
                      'succ' => 'waiting',
                      'type' => 'cant-succ-convert',
                      'msg' => 'Cant succesfully convert file contents'
                   ));                     
                }                
          		else
                {
                    if($fs->writeFileContents($path, $textToSave ))
                    {
                     echo json_encode(array(
                        'succ' => 'yes',
                        'msg' => $notConfirmedOverWrite ? 'File contents succesfully converted and saved' : 'File contents converted and succesfully saved',
                        'lu' => $fs->getLastModificationTime($path)
                     ));
                    }
                    else {
                         echo json_encode(array(
                            'succ' => 'no',
                            'msg' => 'Error writing file contents'
                         ));   
                    }
                }
   
   }
 else
   {    
      if($fs->writeFileContents($path, $text ))
      {
       echo json_encode(array(
          'succ' => 'yes',
          'msg' => 'Succesfully saved',         
          'lu' => $fs->getLastModificationTime($path)
       ));
      }
      else {
           echo json_encode(array(
              'succ' => 'no',
              'msg' => 'Error writing file contents'
           ));   
      }
   }

