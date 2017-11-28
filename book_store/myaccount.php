<?php
// Include database connection
require_once('inc/connect.php');
// Include functions
require_once('inc/functions.php');
// Start the session
session_start();
//file connect.php
session_start(); 

session_regenerate_id(true); 
$username = $_REQUEST['username'];
$pass = $_REQUEST['pass'];



// build SELECT query
         $sql ="SELECT * FROM PET_ACCOUNT WHERE USERNAME  = '".$username."'";

		$flag=false;
         // Connect to Oracle
         /* Set oracle user login and password info */

   
         /* check the sql statement for errors and if errors report them */
		$stmt = OCIParse($db, $sql); 

		if(!$stmt) {
		echo "An error occurred in parsing the sql string.\n";
		exit;
		}
		OCIExecute($stmt);
		while(OCIFetch($stmt)) {
			if(OCIResult($stmt,"PASSWORD")==$pass) {
			$flag=true;	
			$_SESSION['flag'] = $flag;
			
			
			$password=OCIResult($stmt,"PASSWORD");
			$email=OCIResult($stmt,"EMAIL");
			$phone=OCIResult($stmt,"PHONE");
			$address=OCIResult($stmt,"ADDRESS");
			//set up session values
			//session_start();
			
			$_SESSION['userid'] = OCIResult($stmt,"USERID"); 

			$_SESSION['pass'] = $password;
			$_SESSION['email'] = $email;
			$_SESSION['phone'] = $phone;
			$_SESSION['address'] = $address;
			
			$_SESSION['un'] = $username;
			//$_SESSION['sessionID']=$PHPSESSID;
			
			}
		} //end of while
		


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Pet Shop</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrap">

       <div class="header">
       		<div class="logo"><a href="index.php"><img src="images/logo.gif" alt="" title="" border="0" /></a></div>            
        <div id="menu">
            <ul>                                                                       
            <li><a href="index.php">home</a></li>
            <li><a href="about.php">about us</a></li>
            <li><a href="category.php">category</a></li>
            <li><a href="specials.php">specials</a></li>
            <li><a href="myaccount.php">my accout</a></li>
            <li class="selected"><a href="register.php">register</a></li>            
            <li><a href="contact.php">contact</a></li>
            <li><a href="searchform.php">search</a></li>
            </ul>
        </div>    
            
            
       </div> 
       
       
       <div class="center_content">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>My account</div>
        	<div class="clear"></div>
        		
            <?php
				global $db;
				$username = $_SESSION['un'];
				 
				if(isset($_SESSION['un']))
			  	{
					$email = $_SESSION['email'];
					$phone = $_SESSION['phone'];
					$address = $_SESSION['address'];
	 
					$pass = $_SESSION['pass']; 		
					echo "<h1>Hello $username, welcome to our System! </h1>";
					echo "Welcome $username <br /><br />";					
					echo "<form method='post' action='updateaccount.php'>";
					
					echo "Password: <input type='password' name='pass' value='$pass'> <br /><br />";
					echo "Email: <input type='text' name='email' value='$email'> <br /><br />";
					echo "Address: <input type='text' name='address' value='$address'> <br /><br />";
					echo "Phone: <input type='text' name='phone' value='$phone'> <br /><br />";
					echo "<table>";
					echo "<tr>";
					echo "<td>";
					echo '<a href="#" class="continue">set</a> <br /><br />';
					echo "</td>";
					echo "<td>&nbsp;</td>";
					echo "<td>";
					echo '<a href="logout.php" class="continue">Logout</a><br clear = "all"/>';
					echo "</td>";
					echo "</tr>";
					echo "</table>";
					echo "</form>";
					
					echo "your user name is ".$_SESSION['un']."<br />";
					//echo "this is your session id: ".$_SESSION['sessionID']."<br /><br />";
					echo "this is your session_id(): ".session_id();  
				}
				else
				{
			  		echo ('<div class="feat_prod_box_details">
            
            
					<div class="contact_form">
						<div class="form_subtitle">login into your account</div>
						 <form name="register" method="post" action="myaccount.php">          
							<div class="form_row">
								<label class="contact"><strong>Username:</strong></label>
								<input type="text" class="contact_input" name="username" />
							</div>  
		
		
							<div class="form_row">
								<label class="contact"><strong>Password:</strong></label>
								<input type="password" class="contact_input" name="pass" />
							</div>                     
							
							<div class="form_row">
								<a href="register.php" class="continue">Register</a>
								<br/>
								<input type="submit" class="register" value="login" />
							</div>   
							
						  </form>     
						</div>  
					</div>');
		
				  }

?> 
              

            

            
        <div class="clear"></div>
        </div><!--end of left content-->
        
        <div class="right_content">
        
                	<div class="languages_box">
                <span class="red">Languages:</span>
                <a href="#"><img src="images/au.gif" alt="" title="" border="0" height="12px" width="15px"/></a>
                <!-- commented out by Shang 10/07/2014
                <a href="#"><img src="images/gb.gif" alt="" title="" border="0" /></a>
                <a href="#"><img src="images/fr.gif" alt="" title="" border="0" /></a>
                <a href="#"><img src="images/de.gif" alt="" title="" border="0" /></a>
                -->
                </div>
            
                <div class="currency">
                <span class="red">Currency: </span>
                <!-- commented by shang 10/07/2014 
                <a href="#">GBP</a>
                <a href="#">EUR</a> -->
                <a href="#" class="selected">AUD</a>
                </div>
                
                
              <div class="cart">
                  <div class="title"><span class="title_icon"><img src="images/cart.gif" alt="" title="" /></span>My cart</div>
                  <div class="home_cart_content">
                  	<?php
						echo updateShoppingCart();
					?> 
                  </div>
                  <a href="cart.php" class="view_cart">view cart</a>
              
              </div>
        
             <div class="title"><span class="title_icon"><img src="images/bullet3.gif" alt="" title="" /></span>About Our Shop</div> 
             <div class="about">
             <p>
             <img src="images/about.gif" alt="" title="" class="right" />Pet Shop is an Australian owned &amp; operated pet store that stocks a range of pets and accessories in Geelong. Our online store sells a large selection of dogs, cats, birds and beetles. Make our Pet Shop your first choice for pets! </p>
             
             </div>
             
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet4.gif" alt="" title="" /></span>Promotions</div> 
                <div class="clear"></div>
           <?php
				$sql = "SELECT * FROM pet_item WHERE nstate = 2 ORDER BY id";
				$stmt = OCIParse($db, $sql);   
				if(!$stmt)  
				{
    				echo "An error occurred in parsing the sql string.\n"; 
    				exit; 
  				}
				OCIExecute($stmt); 
				$output[] = '<ul>';
				$output[] = '<div class="new_products">';
				while(OCIFetch($stmt)) 
				{
					$id = OCIResult($stmt,"ID");
					$name= OCIResult($stmt,"NAME");
					$ps = OCIResult($stmt,"PHOTO_S");
					$output[] = 
						'
							<div class="new_prod_box">
								<a href="details.php?action=add&id='.$id.'">'.$name.'</a>
								<div class="new_prod_bg">
									<span class="new_icon">
										<img src="images/promo_icon.gif" alt="" title="" />
									</span>
									<a href="details.php?action=add&id='.$id.'">
										<img src="pet-images/'.$ps.'" alt="" title="" class="thumb" border="0" height="80px" width="80px"/>
									</a>
								</div>           
                    		</div>
						';
					
					
				}
				$output[] = '</div>';
				$output[] = '</ul>';
				echo join('',$output);
			?>       
                    
                                
             
             </div>
             
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet5.gif" alt="" title="" /></span>Categories</div> 
                
                <ul class="list">
                <li><a href="#">accesories</a></li>
                <li><a href="#">pets gifts</a></li>
                <li><a href="#">specials</a></li>
                <li><a href="#">hollidays gifts</a></li>
                <li><a href="#">accesories</a></li>
                <li><a href="#">pets gifts</a></li>
                <li><a href="#">specials</a></li>
                <li><a href="#">hollidays gifts</a></li>
                <li><a href="#">accesories</a></li>
                <li><a href="#">pets gifts</a></li>
                <li><a href="#">specials</a></li>                                              
                </ul>
                
             	<!-- commented out by Shang 10/07/2014 
             	<div class="title"><span class="title_icon"><img src="images/bullet6.gif" alt="" title="" /></span>Partners</div> 
                
                <ul class="list">
                <li><a href="#">accesories</a></li>
                <li><a href="#">pets gifts</a></li>
                <li><a href="#">specials</a></li>
                <li><a href="#">hollidays gifts</a></li>
                <li><a href="#">accesories</a></li>
                <li><a href="#">pets gifts</a></li>
                <li><a href="#">specials</a></li>
                <li><a href="#">hollidays gifts</a></li>
                <li><a href="#">accesories</a></li>                              
                </ul>      
                
                -->  
             
             </div>         
             
        
        </div><!--end of right content-->
        
        
       
       
       <div class="clear"></div>
       </div><!--end of center content-->
       
              
       <div class="footer">
            <div class="left_footer">
            	<img src="images/footer_logo.gif" alt="" title="" /><br /> <a href="http://csscreme.com/freecsstemplates/" title="free css templates"><img src="images/csscreme.gif" alt="free css templates" border="0" /></a>
            </div>
            
            <div class="right_footer">
                <a href="index.php">home</a>
                <a href="about.php">about us</a>
                <a href="category.php">services</a>
                <a href="myaccount.php">privacy policy</a>
                <a href="contact.php">contact us</a>
            </div>
            
            <div class="clear"></div>
            <p>©Deakin University, School of Information Technology. This web page has been developed as a student assignment for the unit SIT203: Web Programming. Therefore it is not part of the University's authorised web site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY.</p>
            </div>
       
       </div>
    

</div>

</body>
</html>