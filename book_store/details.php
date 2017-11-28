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
	<link rel="stylesheet" href="lightbox.css" type="text/css" media="screen" />
	
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="js/lightbox.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/java.js"></script>
    
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
        	<?php 
				$sql = "select * from pet_item where id = ".$_GET['id']."";
				$stmt = OCIParse($db, $sql); 
				if(!$stmt)  
				{
   					echo "An error occurred in parsing the sql string.\n"; 
  			 		exit; 
  				}
				OCIExecute($stmt); 
				while(OCIFetch($stmt)) 
				{				
					$name= OCIResult($stmt,"NAME");
					$colour = OCIResult($stmt,"COLOR");
					$price = OCIResult($stmt,"PRICE");
					$sphoto = OCIresult($stmt,"PHOTO_S");
					$lphoto = OCIresult($stmt,"PHOTO_L");
					$breed = OCIresult($stmt,"BLEED");
					$sex = OCIresult($stmt,"SEX");
					$petsize = OCIresult($stmt,"PET_SIZE");
					$age = OCIresult($stmt,"AGE");
					$tag = OCIResult($stmt,"TAG");	
					$id = OCIresult($stmt,"ID");			
				}
				echo 
				'
					<div class="crumb_nav">
            			<a href="index.php">home</a> &gt;&gt; '.$name.'
            		</div>
					<div class="title">
						<span class="title_icon">
							<img src="images/bullet1.gif" alt="" title="" />
						</span>'.$name.'
					</div>
					<div class="feat_prod_box_details">
						<div class="prod_img">
							<a href="details.php?id='.$id.'">
								<img src="pet-images/'.$sphoto.'" alt="" title="" border="0" />
							</a>
                			<br /><br />
                			<a href="pet-images/'.$lphoto.'" rel="lightbox">
								<img src="images/zoom.gif" alt="" title="" border="0" />
							</a>
                		</div>
                		<div class="prod_det_box">
                			<div class="box_top">
							</div>
                    		<div class="box_center">
                    			<div class="prod_title">Details</div>
                    			<p class="details">	Name:'.$name.'<br />
											   		Breed: '.$breed.'<br /> 
											  		Sex: ' .$sex.'<br />
											   		Age: '.$age.'<br />
											   		Size: '.$petsize.'<br/>
						   		</p>
                    			<div class="price">
									<strong>PRICE:</strong>
									<span class="red"> AU$'.$price.'</span>
								</div>
                    			<div class="price">
									<strong>COLORS:</strong> 
                    				<span class="colors">'.$colour.'</span>
                    			</div>
                    			<a href="cart.php?action=add&id='.$id.'" class="more">
									<img src="images/order_now.gif" alt="" title="" border="0" />
								</a>
                    		<div class="clear"></div>
                    		</div>
							<div class="box_bottom"></div>
                		</div>     
            			<div class="clear"></div>
            		</div>	
				';			
			?>
        	
            
              
            <div id="demo" class="demolayout">

                <ul id="demo-nav" class="demolayout">
                <li><a class="active" href="#tab1">More details</a></li>
                <li><a class="" href="#tab2">Related books</a></li>
                </ul>
    
            <div class="tabs-container">
            
                <div style="display: block;" class="tab" id="tab1">
                      <p class="more_details">
                      	Pet Shop is an Australian owned &amp; operated pet store that stocks a range of pets and accessories in Geelong. Our online store sells a large selection of dogs, cats, birds and beetles. Make our Pet Shop your first choice for pets!                 
                      </p>
                      <ul class="list">
                      	<li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></li>
                      	<li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></li>
                      	<li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></li>
                      	<li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></li>                   
                      </ul>
                      <p class="more_details">
                      	Pet Shop is an Australian owned &amp; operated pet store that stocks a range of pets and accessories in Geelong. Our online store sells a large selection of dogs, cats, birds and beetles. Make our Pet Shop your first choice for pets!                  
                      </p>                           
                </div>	
                    
                <div style="display: none;" class="tab" id="tab2">
                    <?php
							$sql = "SELECT * FROM pet_item ORDER BY id";
							$stmt = OCIParse($db, $sql); 
  
							if(!$stmt)  
							{
    							echo "An error occurred in parsing the sql string.\n"; 
    							exit; 
  							}
							OCIExecute($stmt); 
							$output[] = '<ul>';

							while(OCIFetch($stmt)) 
							{
								$id = OCIResult($stmt,"ID");
								$name= OCIResult($stmt,"NAME");
								$type = OCIResult($stmt,"TYPE");
								$bleed = OCIResult($stmt,"BLEED");
								$sex = OCIResult($stmt,"SEX");
								$size = OCIResult($stmt,"PET_SIZE");
								$color = OCIResult($stmt,"COLOR");
								$price = OCIResult($stmt,"PRICE");
								$age = OCIResult($stmt,"AGE");
								$age = OCIResult($stmt,"TAG");
								$ps = OCIResult($stmt,"PHOTO_S");
								$nstate = OCIResult($stmt,"NSTATE");
								if($nstate == 0)
								{
									$output[] = 
									'
									<div class="new_prod_box">
										<a href="details.php?id='.$id.'">'.$name.'</a>
										<div class="new_prod_bg">
											<a href="details.php?id='.$id.'">
												<img src="pet-images/'.$ps.'" alt="" title="" class="thumb" border="0" height="80px" width="80px"/>
											</a>
										</div>           
                    				</div>
									';
								}
								else if ($nstate == 1)
								{
									$output[] = 
									'
									<div class="new_prod_box">
										<a href="details.php?action=add&id='.$id.'">'.$name.'</a>
										<div class="new_prod_bg">
											<span class="new_icon"><img src="images/new_icon.gif" alt="" title="" /></span>
											<a href="details.php?action=add&id='.$id.'">
												<img src="pet-images/'.$ps.'" alt="" title="" class="thumb" border="0" height="80px" width="80px"/>
											</a>
										</div>           
                    				</div>
									';
								}
								else
								{
									$output[] = 
									'
									<div class="new_prod_box">
										<a href="details.php?action=add&id='.$id.'">'.$name.'</a>
										<div class="new_prod_bg">
											<span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
											<a href="details.php?action=add&id='.$id.'">
												<img src="pet-images/'.$ps.'" alt="" title="" class="thumb" border="0" height="80px" width="80px"/>
											</a>
										</div>           
                    				</div>
									';	
								}
								
							}
							$output[] = '</ul>';
							echo join('',$output);

						?>
                 
                </div>	
            
            </div>


			</div>
            

            
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
					$sql1 = "SELECT * FROM pet_item WHERE nstate = '2' ORDER BY id";
					$stmt1 = OCIParse($db, $sql1);   
					if(!$stmt1)  
					{
						echo "An error occurred in parsing the sql string.\n"; 
						exit; 
					}
					OCIExecute($stmt1); 
					$output1[] = '<ul>';
					$output1[] = '<div class="new_products">';
					while(OCIFetch($stmt1)) 
					{
						$id1 = OCIResult($stmt1,"ID");
						$name1= OCIResult($stmt1,"NAME");
						$ps1 = OCIResult($stmt1,"PHOTO_S");
						$output1[] = 
							'
								<div class="new_prod_box">
									<a href="details.php?action=add&id='.$id1.'">'.$name1.'</a>
									<div class="new_prod_bg">
										<span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
										<a href="details.php?action=add&id='.$id1.'">
											<img src="pet-images/'.$ps1.'" alt="" title="" class="thumb" border="0" height="80px" width="80px"/>
										</a>
									</div>           
								</div>
							';											
					}
					$output1[] = '</div>';
					$output1[] = '</ul>';
					echo join('',$output1);
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
<script type="text/javascript">

var tabber1 = new Yetii({
id: 'demo'
});

</script>
</html>