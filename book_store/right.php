<div class="right_content">
		<div class="languages_box">
            <span class="red">Welcome! </span>
            <strong><?php echo $_SESSION['username']; ?></strong>
		</div>
		
		<div class="currency">
            <span class="red">Currency: </span>
            <a href="#"><strong>AUD</strong></a>
        </div>
		
		<div class="languages_box">
                <span class="red">Languages:</span>
                <a href="#"><img src="images/au.gif" alt="" title="" border="0" height="12px" width="15px"/>
				</a>                
        </div>
		
		<div class="cart">
                  <div class="title">
					  <span class="title_icon"><img src="images/cart.gif" alt="" title="" />
					  </span>My cart
				  </div>
                  <div class="home_cart_content">
					<?php
						echo writeShoppingCart();
					?>
                  </div>
                  <a href="cart.php" class="view_cart">view cart
				  </a>
              
        </div>
		
		
		<div class="title">
				<span class="title_icon"><img src="images/bullet3.gif" alt="" title="" />
				</span>About Our Shop
		</div> 
        <div class="about">
			 <p>
             <img src="images/about.gif" alt="" title="" class="right" />
             BookStore is a 100% Australian-owned online retail store selling books Australia wide. 
			 Based in Geelong, Australia we offer handreds books from our database which have been categorised into a variety of subjects to make it easier for you to browse and shop. 
             </p>
        </div>
		
		
		<div class="right_box">
            <object width="300" height="250">
				<param name="movie" value="book.swf">
				<embed src="images/book.swf" width="550" height="440">
				</embed>
			</object>   
             
        </div>
		
</div>		
		
		
		
		
		
		
		
		