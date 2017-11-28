<?php
  /* Set oracle user login and password info */
  $dbuser = "wxiangn";  /* your deakin login */
  $dbpass = "Wu18Xiang27Nan00";  /* your deakin password */
  $dbname = "SSID"; 
  $db = OCILogon($dbuser, $dbpass, $dbname); 

  if (!$db)  {
    echo "An error occurred connecting to the database"; 
    exit; 
  }

?>