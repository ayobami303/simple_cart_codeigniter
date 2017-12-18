<div class="row">
</br>
<h1>Product In Store</h1>
</br>
<?php 
if (isset($resp) && !empty($resp)) {
	echo "<script type=\"text/javascript\">
	alert('". $resp."');

</script>";
}
?>

	<div class="col-md-6">
		<div class="row">
			<div class="col-md-6">Items in cart:
				<input type="text" name="cart_item" disabled="disabled" value="<?php 
				$cart_item = (isset($cart_item))? $cart_item : 0; echo $cart_item;?>" >
			</div>
			<div class="col-md-3">
				<p>Welcome <?php echo $user_details->full_name?></p>
			</div>
		<div class="col-md-3"><a href="<?php echo site_url().'/logout';?>">Log out </a></div>

		</div>

		<div class="row">
			<table class="table">
				<thead>
					<th>S/N</th>
					<th>product name</th>
					<th>Qty available</th>
					<th>Action</th>
				</thead>

				<tbody>
					<?php
					$sn = 1;
						foreach ($product_list as $product_row) {
							echo "<tr><td>".$sn."</td><td>".$product_row->name."</td><td>".$product_row->qty."</td><td>
							<a href=\"".site_url().'/add-to-cart/'.$product_row->id."\">Add to Cart</a> </td></tr>";
							$sn++;
						}
					?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>