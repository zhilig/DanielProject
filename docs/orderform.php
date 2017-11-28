<?php
// Include database connection
require_once('inc/connect.php');
// Include functions
require_once('inc/functions.php');
// Start the session
session_start();
$username = $_SESSION['un'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Pet Shop</title>
<link rel="stylesheet" type="text/css" href="style.css" />

<script type = "text/javascript" language = "Javascript">
         // validates if the input is empty and displays the error message
         function validateNotEmpty( input, id )
         {
            var errorDisplay =  document.getElementById( id );
            var notEmpty;
            if ( input == "" ) // check if input is empty
            {
               errorDisplay.innerHTML = "This is a requiered field";
               notEmpty = false; // update return value
            } // end if
            else
            {
               errorDisplay.innerHTML = ""; // clear the error area
               notEmpty = true; // update return value
            } // end else

            return notEmpty; // return whether the input is empty

         }// end function validateNotEmpty
         // validate that  the email has corect format and is allowed 
         function validateEmail( input )
         {
            if( validateNotEmpty( input, 'emailEmptyError' ) )
            {
               if ( validateEmailFormat( input ) ) // if correct format
               {
                  // send the request for a list of emails that are not
                  // allowed ot post
                  try
                  {
                     asyncRequest = new XMLHttpRequest();

                     // register event handler
                     asyncRequest.onreadystatechange = function()
                     {
                        checkIfAllowed( input ); 
                     }; 
                     asyncRequest.open( 'GET', 'emails.xml', true ); 
                     asyncRequest.send( null ); 
                  } // end try
                  catch ( exception )
                  {
                     alert( 'Request Failed' );
                  } // end catch

               } // end if

            } // end if

         } // end function validateEmail
         // validate that the email has correct format
         function validateEmailFormat( input )
         {
            var valid = false; // tracks validity of the e-mail address
            var section = 'user'; // tracks the section of the address
            for( var i = 0; i < input.length && !valid; i++ )
            {
               // if we reach an "@" the user section is over
               
               if( section == "user" && input.charAt( i )  == '@' )
               {
                  section = "domain"; // update section variable
               } //  end if

               // if we reach a "." the domain section is over 
               else if ( section == "domain" && input.charAt( i ) == '.' )
               {
                  // if there is something after the "." the email has 
                  // valid format
                  if ( i != input.length - 1 )
                  {
                     valid = true; // update validity
                  } //  end if

               } // end else if

            } // end for

            var errorDisplay = 
               document.getElementById( 'emailFormatError' );
            
            // display error if email does not have valid format
            if ( !valid )
            {
               errorDisplay.innerHTML = "E-mail has incorrect format";
            } // end if
            else
            {
               errorDisplay.innerHTML = "";  // clear error area
            } // end else

            return valid; // return validity tracker
         }        
         // check if the e-mail address user entered is not allowed
         // to post feedback
         function checkIfAllowed( input )
         {
            if ( asyncRequest.readyState == 4 && 
              asyncRequest.status == 200 &&  asyncRequest.responseXML )
            {
               // get the emails from the responseXML
				var emails = asyncRequest.responseXML.getElementByTagName("email");
				var allowed = true;
				
				for(var i = 0; i<emails.length && allowed; i++)
				{
					var email = emails.item(i).firstChild.nodeValue;
					
					if (input == email)
					{
						allowed = false;
					}
				}
				
				var displayError = document.getElementById("emailNotAllowedError");
				
				if(!allowed)
				{
					displayError.innerHTML = input + " is not allowed to submit feedback.";
				}
				else
				{
					displayError.innerHTML = "";	
				}			
               // initialize return value
               // iterate over the list of e-mails not allowed to post
               // feedback and check if the input matches any of them        
               // display appropriate error message
               // clear the error area              
	   		} // end of if
         } // end function checkIfAllowed

      </script>
   <script TYPE="text/javascript" SRC="/d2l/common/math/MathML.js?v=10.3.0.791-69" ></script><script TYPE="text/javascript">D2LMathML.DesktopInit('/d2l/common/mathjax/2.1/MathJax.js?config=MML_HTMLorMML&v=10.3.0.791-69','/d2l/common/mathjax/2.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML&v=10.3.0.791-69');</script>
</head>

<body>
<div id="wrap">
    <div class="header">
       	<div class="logo">
            <a href="index.php"><img src="images/logo.gif" alt="" title="" border="0" /></a>
        </div>            
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
   </div><!--end of header-->
       
       
   <div class="center_content">
       	<div class="left_content">       	
          	<div class="title">
            	<span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Order form
            </div>
            
            <form method = "post" action = "">
            	<div class="feat_prod_box">
            		
                  	<div class="contact_form">
                        <div class="form_subtitle">Customer contect and delivery detail</div>          
                        <div class="form_row">
                            <label><strong>Customer Name: </strong>
                       		<input name = "name" type = "text" size = "25" onblur = "validateNotEmpty( this.value, 'nameError' )"/>
                    		</label><span id = "nameError" class = "errorMessage"></span>
                        </div>  
        
                        <div class="form_row">
                            <label><strong>Phone number: </strong>
                       		<input name = "phone" type="text" size = "25" onblur = "validateNotEmpty( this.value, 'phoneError' )"/>
                    		</label><span id = "phoneError" class = "errorMessage"></span>
                        </div>
    
                        <div class="form_row">
                            <label><strong>E-mail address: </strong>
                            <input name = "email" type = "text"  size = "25" onblur = "validateEmail( this.value )"/>
                        	</label>
                            <span id = "emailEmptyError"></span>
                            <span id = "emailFormatError"></span> 
                            <span id = "emailNotAllowedError"></span>
                        </div>
                            
                        <div class="form_row">
                            <label><strong>Unit number<br />
                    	and street name: </strong>
                   		  	<input name = "unit" type = "text" size = "25" onblur = "validateNotEmpty( this.value, 'unitError' )"/>
                    		</label><span id = "unitError" class = "errorMessage"></span>
                        </div>
                            
                        <div class="form_row">
                            <label><strong>State: </strong>
                   		  	<input name = "State" type = "text" size = "25" onblur = "validateNotEmpty( this.value, 'StateError' )"/>
                    		</label><span id = "StateError" class = "errorMessage"></span>
                        </div>
                            
                        <div class="form_row">
                     		<label><strong>Postal code: </strong>
                			<input name = "post" type = "text" size = "6" onblur = "validateNotEmpty( this.value, 'postError' )"/>
                    		</label><span id = "postError" class = "errorMessage"></span>
                       	</div>                           
                   	</div>
                   
                   
                   	<div class="contact_form">
                		<div class="form_subtitle">Payment methods</div>          
 
                        <div class="form_row">
                            <label>
                               <input name = "choose" type = "radio" value = "Credit card" checked = "checked" />
                               Credit card
                            </label><br />
                            <label>Card number: 
                              <input name = "postalcode" type = "text" size = "20"/><br />
                              Expire date: <input name = "expiredate" type = "text" size = "20"/><br />
                              CVC/CVV2<input name = "CVC/CVV2" type = "text" size = "20"/>
                            </label>
                        </div>
                        
                        <div class="form_row">
                        	<label>
                           	<input name = "choose" type = "radio" value = "Paypal" />
                           Paypal
                        	</label><br />
                        	<label>Paypal account: 
                   		  	<input name = "Paypal" type = "text" size = "20"/><br />
                          Password: <input name = "Paypal" type = "text" size = "20"/>
                    		</label><br />
                        </div>
                        
                        <div class="form_row">
                        	<label>
                           	<input name = "choose" type = "radio" value = "Mobile" />
                           Mobile payment
                        </label><br />
                        <label>
                        	Mobile number: <input name = "Mobile" type = "text" size = "20"/>
                        </label>
                        </div>
                        
                        <div class="form_row">
                        	<label><strong>Comments: </strong><br />
                            <textarea name = "comments" rows = "4" cols = "36" onblur = "validateNotEmpty( this.value, 'commentsError' )">Enter comments here.
                            </textarea>
                     	</label>
						<span id = "commentsError" class = "errorMessage"></span>
                 		</div>
                  </div>
         	  
           		  <div class="form_row">
                        <a href="#" class="contact">Submit</a>
                        <a href="#" class="contact">Clear</a> 
                  </div>       			
          	</div>
          </form>
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
                
                <div>
                <a href="myaccount.php">  
					<?php
                    global $db;
                    $un =$_SESSION['un'];
                    if($un)
                    {
                            echo ('--welcome: '.$un.'--');
                        }
                    else
                    {
                        echo('--Login--');
                        }
                    ?>
                </a>
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