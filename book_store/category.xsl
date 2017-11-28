<?xml version="1.0" encoding="ISO-8859-1"?><!-- DWXMLSource="data.xml" -->


<xsl:stylesheet version = "1.0" xmlns:xsl = "http://www.w3.org/1999/XSL/Transform">

   <xsl:output method = "html" omit-xml-declaration = "no" 
      doctype-system = 
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" 
      doctype-public = "-//W3C//DTD XHTML 1.0 Strict//EN" />

   <xsl:template match = "/">
      <html xmlns = "http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Book Shop</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <div id="wrap">
        <div class="header">
            <div class="logo"><a href="home.html"><img src="images/logo.gif" alt="" title="" border="0" /></a></div>            
            <div id="menu">
                <ul>                                                                       
                    <li><a href="home.html">home</a></li>
                    <li><a href="about.html">about us</a></li>
                    <li><a href="category.xml">books</a></li>
                    <li><a href="specials.html">specials</a></li>
                    <li><a href="myaccount.html">my accout</a></li>
                    <li><a href="register.html">gift</a></li>    
                    <li><a href="search.html">search</a></li>
                    <li><a href="contact.html">contact</a></li>
                </ul>
            </div>        
        </div> 
              
			  
			  
			  
		<div class="center_content">
       		<div class="left_content">
                <div class="crumb_nav">
                	<a href="home.html">home</a> &gt;&gt; category name
                </div>
                <div class="title">
                    <span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Category 
                </div>        
				<div class="new_products">
				
				
                	<xsl:for-each select="Catalog/book">
					
                    	<div class="new_prod_box">
                    		<xsl:variable name="name1" select="Name"/>
							
                            <xsl:variable name="price" select="Price"/>
							
                            <xsl:variable name="pic" select="Photo"/>

                            	                   
                        	<a href="details.html?name1={$name1}" >
                            	<xsl:value-of select="Information/Name"/> 
                            </a><br/>
                        	<div class="new_prod_bg">
                            	<xsl:variable name="path" select="PHOTO"/> 
                            	<a href="details.html?name1={$name1}&amp;price={$price}&amp;pic={$pic}&amp;">
                                	<img src="book-images/{$pic}" alt="" title="" class="thumb" border="0" height="100px" />
                                </a>
								<br/>
                        	</div>                                                 
                        </div>
					
                	</xsl:for-each> 
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
                
                
            <div class="cart">
                  <div class="title"><span class="title_icon"><img src="images/cart.gif" alt="" title="" /></span>My cart
				  </div>
                  <div class="home_cart_content">
                  3 x items | <span class="red">TOTAL: 100$</span>
                  </div>
                  <a href="cart.html" class="view_cart">view cart</a>
              
            </div>
                   
            	
        
        
             <div class="title"><span class="title_icon"><img src="images/bullet3.gif" alt="" title="" /><a href="about.html">About Our Shop</a></span></div> 
             <div class="about">
             <p>
             <img src="images/about.gif" alt="" title="" class="right" />
            Pet Shop is an Australian owned &amp; operated pet store that stocks a range of pets and accessories in Geelong. Our online store sells a large selection of dogs, cats, birds and beetles. Make our Pet Shop your first choice for pets!
             </p>
             
             </div>
             
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet4.gif" alt="" title="" /></span>Promotions</div> 
                    <div class="new_prod_box">
                        <a href="details.html">product name</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.html"><img src="images/thumb1.gif" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div>
                    
                    <div class="new_prod_box">
                        <a href="details.html">product name</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.html"><img src="images/thumb2.gif" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div>                    
                    
                    <div class="new_prod_box">
                        <a href="details.html">product name</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.html"><img src="images/thumb3.gif" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div>              
             
             </div>
             
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet5.gif" alt="" title="" /><a href="data.xml">Categories</a></span></div> 
                
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
				
     </div>        
        
   
	<div class="clear"></div>

		   
				  
	<div class="footer">
			<div class="left_footer"><img src="images/footer_logo.gif" alt="" title="" /><br /> <a href="http://csscreme.com/freecsstemplates/" title="free css templates">
			<img src="images/csscreme.gif" alt="free css templates" border="0" /></a>
			</div>
		   
		<div class="right_footer">
			<a href="index.html">home</a>
			<a href="about.html">about us</a>
			<a href="#">services</a>
			<a href="#">privacy policy</a>
			<a href="contact.html">contact us</a>
		</div>
		   
		   <div class="statement">"�Deakin University, School of Information Technology. This web page has been developed as a student assignment for the unit SIT203: Web Programming. Therefore it is not part of the University's authorised web site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY."
		   </div>
	</div>

				
</div>
</div>
</body>
</html>

</xsl:template>
</xsl:stylesheet>
