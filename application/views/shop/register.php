</br>
<div><a href="<?php echo site_url().'/login';?>">Registered? Login</a></div>

<div class="row">
	<div class="col-md-6">
		</br>
		<h1>Customer Registration Page</h1>
		<?php 
		if (isset($resp)) {
			echo '<h4 style = "color:red;">'.$resp.'</h4>';
		}
		$form_att = array('class' => 'form');
		echo form_open('register-process',$form_att);
		?>
			<div class="form-group">
				<p>Full name</p>
				<input type="text" name="name" placeholder="Enter your full name" class="form-control" required="required">
			</div>
			<div class="form-group">
				<p>Email</p>
				<input type="email" name="email" placeholder="Enter your email address" class="form-control" required="required">
			</div>
			<div class="form-group">
				<p>Phone number</p>
				<input type="text" name="phone" placeholder="Enter your phone number" class="form-control">
			</div>
			
			<div class="form-group">
				<p>Password</p>
				<input type="password" name="password" placeholder="Enter your password" class="form-control" required="required">
			</div>
			<div class="form-group">
				<p>Confirm password</p>
				<input type="password" name="password_confirm" placeholder="Confirm password" class="form-control" required="required">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="Submit" class=" btn btn-primary" >
			</div>


		</form>
	</div>
</div>