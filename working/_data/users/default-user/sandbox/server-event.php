<?php 

if(isset($_GET['stream']))
{
date_default_timezone_set("America/New_York");
header("Content-Type: text/event-stream\n\n");

$counter = rand(1, 10);
while (1) {
  // Every second, sent a "ping" event.
  
  echo "event: ping\n";
  $curDate = date(DATE_ISO8601);
  echo 'data: {"time": "' . $curDate . '"}';
  echo "\n\n";
  
  // Send a simple message at random intervals.
  
  $counter--;
  
  if (!$counter) {
    echo 'data: This is a message at time ' . $curDate . "\n\n";
    $counter = rand(1, 10);
  }
  
  ob_flush();
  flush();
  sleep(1);
}

}
else {
  ?>
<!DOCTYPE html>
<html>
<head>
  <script>
  
  var evtSource = new EventSource("ssedemo.php");  
  var eventList = document.getElementById("eventlist");  
    
  evtSource.addEventListener("ping", function(e) {
      var newElement = document.createElement("li");
  
      var obj = JSON.parse(e.data);
        newElement.innerHTML = "ping at " + obj.time;
        eventList.appendChild(newElement);
  }, false);  
    
  evtSource.onerror = function(e) {
  alert("EventSource failed.");
  };

  //evtSource.close();
    
    
  </script>
  </head>
  <body>
    <ul id="eventlist"></ul>
  </body>
</html>
<?php
}
