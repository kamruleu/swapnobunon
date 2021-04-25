
<div id="login" style="padding: 0;">
	<div class="login_form_area">
		<div class="login_contant"> 
			<img class="i__top" src="<?php echo URL; ?>public/images/i_01.png">
			<img class="i__bottom" src="<?php echo URL; ?>public/images/i_02.png">
			<div class="row">
				<div class="col-sm-12 col-md-4 col-xl-4" style="padding: 0">
					<div class="login_box">
						<img src="http://infinitybd-my.com/asset/admin/img/medium/logo_medium-180x57_medium-180x58.png">
						<div class="log_form_area"> 
							<div class="bs-docs-section">
								<div class="bs-example">
									<form role="form" action="<?php echo URL; ?>login/run" method="post">
										<div class="form-group">
											<input type="email" name="login" class="form-control" id="exampleInputEmail1" autocomplete="on" required>
											<span class="form-highlight"></span>
											<span class="form-bar"></span>
											<label class="float-label" for="exampleInputEmail1">Email</label>
										</div>

										<div class="form-group">
											<input type="password" name="password" class="form-control" id="exampleInputEmail1" minlength="6" maxlength="50" autocomplete="on" required>
											<span class="form-highlight"></span>
											<span class="form-bar"></span>
											<label class="float-label" for="exampleInputEmail1">Password</label>
										</div>

										<div class="form-group">
											<input type="text" name="token" class="form-control" id="exampleInputEmail1" autocomplete="on" required>
											<span class="form-highlight"></span>
											<span class="form-bar"></span>
											<label class="float-label" for="exampleInputEmail1">Access Token</label>
										</div>	
										<a href="<?php echo URL; ?>sendpass/index/<?php echo $bizid; ?>">I forgot my password</a>
										<div class="dbbutton">
											<input class="btn btn-raised btn-default ripple-effect" type="submit" value="Log In">
											<input class="btn btn-raised btn-default ripple-effect" type="button" id="accesstoken" value="Request Token">
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
						<h2>Infinity</h2>
						<p>We create passionate, loyal customers by simplifying homes with high- quality, long-lasting solutions. Our superior products and services come with the human touch, from the way we develop them and sell them, to the way they are used. Our unique online/e-commerce direct selling capabilities empower people across the globe, elevating lives for the better. As a trusted family business, we are committed to act in a socially and environmentally responsible way.   </p>
						<p class="login__text__list"> We strive to achieve economic success as a means to ensure family ownership of INFINITY for many generations to come. </p>
						</div>
					</div>
				</div>
		</div>
 </div>


	</div>



	
	
	
	
	
	
	
	
	
