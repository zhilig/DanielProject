<?php 
	// ---------------------------------------------------------------- // 
	// DATABASE CONNECTION PARAMETER 									// 
	// ---------------------------------------------------------------- // 
	// Modify global-connect.inc.php with your DB connection parameters or add them //
	// directly below  					//
	
	//include('global-connect.inc.php'); 

  /* Set oracle user login and password info */
  $dbuser = "wxiangn";  /* your deakin login */
  $dbpass = "Wu18Xiang27Nan00";  /* your deakin password */
  $dbname = "SSID"; 
  $db = OCILogon($dbuser, $dbpass, $dbname); 

  if (!$db)  
  {
    echo "An error occurred connecting to the database"; 
    exit; 
  }
	
	// ---------------------------------------------------------------- // 
	// SET PHP VAR - CHANGE THEM										// 
	// ---------------------------------------------------------------- // 
	// You can use these variables to define Query Search Parameters:	//
	
	// $SQL_FROM:	is the FROM clausule, you can add a TABLE: books ...//
	
	// $SQL_WHERE	is the WHER clausule, you can add an table 	 		//
	// 				field for example title  					//
	
	

	$SQL_FROM = 'PET_item';
	
	$searchq =	strip_tags($_GET['q']);
	$sql	=	"SELECT * FROM ".$SQL_FROM." WHERE NAME LIKE '%".$searchq."%'";
		
	$stmt = OCIParse($db, $sql); 
  
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt); 

	$output[] = '<ul>';

	while(OCIFetch($stmt)) {

		$name= OCIResult($stmt,"NAME");
		$id = OCIResult($stmt,"ID");
		$output[] = '<li><a href="details.php?id='.$id.'"><small>'.$name.'</small></a></li>';
	}
	$output[] = '</ul>';
	echo join('',$output);	
?> 