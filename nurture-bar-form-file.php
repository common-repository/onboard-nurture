<?php
	//Add CSS file for form formatting
	$plugin_directory_name =  plugin_basename(dirname(__FILE__)); 
	wp_enqueue_style( 'nurture_bar_style', plugin_dir_url(dirname(__FILE__)).$plugin_directory_name.'/css/bootstrap.min.css' );
?>

<div class="col-lg-12">	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h4 class="page-header">Onboard Nurture Script code paste below</h4>
		<form class="form" method="POST">
			<!-- some inputs here ... -->
			<?php wp_nonce_field( 'obn_custom_onboard_nurture_display', 'custom_onboard_nurture_display_field' ); ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
				<div class="form-group">
					<label>Enter address 1</label>
					<input type="text" placeholder="Enter address 1"  name="nurture_nav_address1" class="form-control" id="nurture_nav_address1" value='<?php echo $nurture_nav_address1; ?>'/>
					<em id="nurture_nav_address1_err"></em>
					<em>Eg : 90 Broad St. Suite 2001</em>
				</div>	
			</div>	
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
				<div class="form-group">
					<label>Enter address 2</label>
					<input type="text" placeholder="Enter address 2"  name="nurture_nav_address2" class="form-control" id="nurture_nav_address2" value='<?php echo $nurture_nav_address2; ?>'/>
					<em id="nurture_nav_address2_err"></em>
					<em>Eg : New York, NY </em>
				</div>	
			</div>	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
				<div class="form-group">
					<label>Enter zipcode</label>
					<input type="text" placeholder="Enter zip code"  name="nurture_nav_zip" class="form-control" id="nurture_nav_zip" value="<?php echo $nurture_nav_zip; ?>"/>
					<em id="nurture_nav_zip_err"></em>
				</div>	
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
						
				<div class="form-group">
					<label>Nurture widget script</label>
					<textarea name="nurture_bar_text" placeholder="Copy your report widget script"  required style="height:300px" class="form-control" id="nurture_bar_text"><?php echo $nurture_bar_text; ?></textarea>
					<em id="nurture_bar_text_error"></em>
				</div>	
				
				<div class="form-group">
					<input type="submit" value="Save" id="publishNurture" class="btn btn-success">
				</div>	
			</div>	
			
		</form>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h4 class="page-header">Copy your shortcode</h4>	
		<label>&nbsp;</label>
		<figure class="highlight"><pre><code class="codeS language-html" data-lang="html" id="copyTNurturearget">[onboard-nurture <?php if($nurture_nav_address1!='') {?>address1="<?php echo $nurture_nav_address1; ?>" <?php } ?><?php if($nurture_nav_zip!='') {?>zip="<?php echo $nurture_nav_zip; ?>" <?php } ?><?php if($nurture_nav_address2!='') {?>address2="<?php echo $nurture_nav_address2; ?>" <?php } ?>]</code></pre></figure>
		<button onclick="return copy_nurture('copyTNurturearget');" id="copybtn" class="pull-right btn btn-success">Copy</button>
	
	</div>
</div>