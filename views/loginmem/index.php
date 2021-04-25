
<?php
	$bizid="";
	$bizname="";			
	foreach($this->bizness as $key=>$value){
	   //echo '<h3><strong>Welcome To '. $value['bizlong'] .'</strong></h3>';
	   $bizid = $value['bizid'];
	   $bizname = $value['bizlong'];
	}
	//echo $this->pass;
?>


<div id="login" style="padding: 0;">
	<div class="login_form_area">
		<div class="login_contant"> 
			<img class="i__top" src="<?php echo URL; ?>public/images/i_01.png">
			<img class="i__bottom" src="<?php echo URL; ?>public/images/i_02.png">
			<div class="row">
				<div class="col-sm-12 col-md-4 col-xl-4">
					<div class="login_box">
						<img src="../../public/images/bizdir/100.jpg" style="height: 72px; width: 190px;">
						<div class="log_form_area"> 
							<div class="bs-docs-section">
								<div class="bs-example">
									<form role="form" action="<?php echo URL; ?>loginmem/run/<?php echo $bizid; ?>" method="post">
										<div class="form-group">
											<input type="text" name="login" class="form-control" id="exampleInputEmail1" autocomplete="on" required>
											<span class="form-highlight"></span>
											<span class="form-bar"></span>
											<label class="float-label" for="exampleInputEmail1">Member ID</label>
										</div>

										<div class="form-group">
											<input type="password" name="password" class="form-control" id="exampleInputEmail1" minlength="6" maxlength="50" autocomplete="on" required>
											<span class="form-highlight"></span>
											<span class="form-bar"></span>
											<label class="float-label" for="exampleInputEmail1">Password</label>
										</div>	
										<a href="#">I forgot my password</a>
										<div class="dbbutton">
											<input class="btn btn-raised btn-default ripple-effect" type="submit" value="Log In">
											<input class="btn btn-raised btn-default ripple-effect" type="button" id="accesstoken" value="Reset Password">
										</div>		
										<div class="forgot">
											<a href="<?php echo URL; ?>index"><strong>Back to Directories</strong></a>
										</div>					



										<!-- <button type="submit" class="btn btn-raised btn-default ripple-effect">Submit</button> -->
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-8 col-xl-8">
				<div class="login_box">
						<!-- <img src="http://infinitybd-my.com/asset/admin/img/medium/logo_medium-180x57_medium-180x58.png"> -->
						<img class="login__images" src="<?php echo URL; ?>public/images/login__banner.jpeg">
				
						<div class="login__text">
						<h2>Swapnobunon</h2>
						<p>We have a dream. With whom we have a genuine bond, a group of individuals with a maximum of 40/45 members in a 10/12 floors Feni / Dhaka 12/15 years plan to do something for themselves to arrange accommodation in the future. But not business attitudes, because there is a huge risk of breaking long-term relation.</p></br>
						<p class="login__text__list"> May Allah accept our dream. We should contribute with our best to make reality of our SWAPNOBUNON. </p>
						</div>
					</div>
				</div>
		</div>
 </div>

	</div>



	
	
	
	
	
	
	
	
	
