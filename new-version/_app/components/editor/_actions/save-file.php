<?php

namespace pfcEditor\Component\Action\editor;

use PFC\Editor\Component\ActionController;

class saveFile extends ActionController
{
    
   public function indexAction() 
   {
   
            $fs = new \PFC\Editor\Sources($_POST['root']);

             $path = filter_input(INPUT_POST, 'path');
             $text = filter_input(INPUT_POST, 'code');
             $enc  = filter_input(INPUT_POST, 'encoding');
             $notConfirmedOverWrite = filter_input(INPUT_POST, 'confirmedOverwrite') == 'yes' ? false : true;

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

                            if($test!=$text && $notConfirmedOverWrite) {
                               $this->getResponse()
                                       ->setSucc('waiting')
                                       ->setMsg('Cant succesfully convert file contents')
                                       ->addData(['type' => 'cant-succ-convert'])
                                    ;                  
                            }                
                            else {
                                if($fs->writeFileContents($path, $textToSave)) {
                                     $this->getResponse()
                                             ->setSucc(true)
                                             ->setMsg(
                                                 $notConfirmedOverWrite 
                                                     ? 'File contents succesfully converted and saved' 
                                                     : 'File contents converted and succesfully saved'
                                              )
                                             ->addData(['lu' => $fs->getLastModificationTime($path)])
                                        ;
                                }
                                else {
                                     $this->getResponse()
                                            ->setSucc(false)  
                                            ->setMsg('Error writing file contents')
                                        ;                       
                                }
                            }

             }
             else {    
                  if($fs->writeFileContents($path, $text)) {
                        $this->getResponse()
                                ->setSucc(true)  
                                ->setMsg('Succesfully saved')
                                ->addData(['lu' => $fs->getLastModificationTime($path)])
                            ;
                  }
                  else {
                      
                    $this->getResponse()
                                ->setSucc(false)  
                                ->setMsg('Error writing file contents')
                            ;                       
                  }
               }                       
    }

}

