<?php
function updateShoppingCart() 
{
	$cart = $_SESSION['cart'];
	if (!$cart) 
	{
		return '<p>no items in your shopping cart</p>';
	} 
	else 
	{
		// Parse the cart session variable
		$items = explode(',',$cart);
		$s = (count($items) > 1) ? 's':'';
		
		
		return '<p><a href="cart.php">'.count($items).' X item'.$s.' in your cart.</a></p>';
	}
}

function showCart() 
{
	global $db;
	$cart = $_SESSION['cart'];
	if ($cart) 
	{
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) 
		{
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = '<form action="cart.php?action=update" method="post" id="cart">';
		$output[] = '<table width="100%" class="cart_table">';
		$output[] = '<tr class="cart_title">
						<td></td> 
						<td>Item pic</td>
						<td>Item name</td>
						<td>Unit price</td>
						<td>Qty</td>
						<td>Total</td>             
                	</tr>';	
		foreach ($contents as $id=>$qty) 
		{
		
			$sql = 'SELECT * FROM pet_item WHERE id = '.$id;
					
			$stmt = OCIParse($db, $sql); 
  
			if(!$stmt)  
			{
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			}
			OCIExecute($stmt); 

			while(OCIFetch($stmt)) 
			{
				$id = OCIResult($stmt,"ID");
				$name= OCIResult($stmt,"NAME");
				$price = OCIResult($stmt,"PRICE");
				$ps = OCIResult($stmt,"PHOTO_S");			
			}
			$output[] = '<tr>';
			$output[] = '<td width="10%"><a href="cart.php?action=delete&id='.$id.'" class="r">Remove</a></td>';
			$output[] = '<td width="25%"><a href="details.php?action=update&id='.$id.'"><img src="pet-images/'.$ps.'" alt="" title="" border="0" class="cart_thumb" /></a></td>';
			$output[] = '<td width="15%">'.$name.'</td>';
			$output[] = '<td width="15%">AU$'.$price.'</td>';
			$output[] = '<td width="15%"><input type="text" name="qty'.$id.'" value="'.$qty.'" size="3" maxlength="3" /></td>';
			$output[] = '<td width="20%">AU$'.( $qty * $price).'</td>';					
			$total += $qty * $price;
			$output[] = '</tr>';
		}
		$total = $total+250;
		$output[] = '<tr>
						<td colspan="5" class="cart_total">
							<span class="red">TOTAL SHIPPING:</span>
						</td>
						<td>AU$ 250</td>                
                	</tr>';
		$output[] = '<tr>
						<td colspan="5" class="cart_total"><span class="red">TOTAL:</span></td>
						<td>AU$'.$total.'</td>                
                	</tr>';
		$output[] = '<tr>
						<td colspan="6"><button type="submit" class="create_account">Update cart</td>    
                	</tr>';					
		$output[] = '</table>';
		$output[] =	'<a href="category.php" class="continue">&lt; continue</a>
            		<a href="orderform.php" class="checkout">checkout &gt;</a>';
		$output[] = '</form>';
	} else {
		$output[] = '<h3>You shopping cart is empty.</h3>';
		$output[] = '<a href="category.php" class="continue">&lt; continue</a>';
	}
	return join('',$output);
}
?>
