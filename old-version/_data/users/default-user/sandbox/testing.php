<?php 

                    
$data_json = json_encode(
  array(
    "appId"=>"testApp", 
    "section"=>"general", 
    "name"=>"assessment",
    "value"=>"testValue1"
  )
);                                                                                   
                                                                                                                     
$url = 'http://23.251.131.170/sportscarver/api/web/v1/app-registries';                                                                      

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);

var_dump($response);



//class Node{value; Node leftChildNode; Node rightChildNode;}
function getLevelSum(Node $root, $level)
{
  $sum = 0;
  
      	if($level>0)
          {                       	
  			  $sum += getLevelSum($root->leftChildNode, $level-1);      	
              $sum += getLevelSum($root->rightChildNode, $level-1);      	
          }
        else
          {
          	$sum = $root->value;
          }  
      	
  
  
  return $sum;
}