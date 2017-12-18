
<div class="row">
	<div class="col-md-6">
		</br>
		<div class="col-md-6"><a href="<?php echo site_url().'/register';?>">Not Registered? </a></div>

		<h1>Customer Login Page</h1>
		<?php 
		if (isset($resp)) {
			echo '<h4 style = "color:red;">'.$resp.'</h4>';
		}
		$form_att = array('class' => 'form');
		echo form_open('login-process',$form_att);
		?>
		
			<div class="form-group">
				<p>Email</p>
				<input type="email" name="email" placeholder="Enter your email address" class="form-control" required="required">
			</div>
			<div class="form-group">
				<p>password</p>
				<input type="password" name="password" placeholder="Enter your password" class="form-control" required="required">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="Login" class=" btn btn-primary" >
			</div>


		</form>
	</div>
</div>