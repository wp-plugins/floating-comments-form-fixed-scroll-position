<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url(__FILE__); ?>css/optionsView.css">

<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2>Custom Comment Form Options</h2>


	
				
		
	<form method="post" action="">
		
	
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th>
							<label for="name"><?php _e('Choose Horizontal offset', 'WPTSfloatingComments'); ?></label>
						</th>
						<td>
							<input name='X_position' type='text'  id="" value='<?php echo get_option( 'FCPositionX' ) - 120; ?>'  />
						</td>
					</tr>
					<tr valign="top">
						<th>
							<label for="name"><?php _e('Choose vertical offset', 'WPTSfloatingComments'); ?></label>
						</th>
						<td>
							<input name='Y_position' type='text'  id="" value='<?php echo get_option( 'FCPositionY' ); ?>'  />
						</td>
					</tr>
					<tr valign="top">
						<th>
							<label for="name"><?php _e('Let it fixed at', 'WPTSfloatingComments'); ?></label>
						</th>
						<td>
							<input name='fc-fixed_position' type='text'  id="" value='<?php echo get_option( 'FCFixedPosition' ) - 35; ?>'  />
						</td>
					</tr>
				</tbody>
			</table>
			
			<p><?php _e('Use above options to set Floating Comments position', 'WPTSfloatingComments'); ?></p>

			<div class="fc-theme-scheme">
				
					
					
							<label for="name"><img src='<?php echo plugin_dir_url(__FILE__); ?>/img/comments-black.png' /></label>
							

							<label for="name"><img src='<?php echo plugin_dir_url(__FILE__); ?>/img/comments-blue.png' /></label>
							

							<label for="name"><img src='<?php echo plugin_dir_url(__FILE__); ?>/img/comments-red.png' /></label>
							

							<label for="name"><img src='<?php echo plugin_dir_url(__FILE__); ?>/img/comments-white.png' /></label>
							
							<div class='fc_theme_scheme_option'>
								<input id='FCDesign1' type='checkbox' name="FCDesign1" value='1' <?php checked( get_option( 'FC_form_checkbox1' ), 1 ); ?> />
								<span>Black</span>
							</div>

							<div class='fc_theme_scheme_option'>
								<input id='FCDesign2' type='checkbox' name="FCDesign2" value='2' <?php checked( get_option( 'FC_form_checkbox2' ), 1 ); ?> />
								<span>Blue</span>
							</div>
							
							<div class='fc_theme_scheme_option'>
								<input id='FCDesign3' type='checkbox' name="FCDesign3" value='3' <?php checked( get_option( 'FC_form_checkbox3' ), 1 ); ?> />
								<span>Red</span>
							</div>

							<div class='fc_theme_scheme_option'>
								<input id='FCDesign4' type='checkbox' name="FCDesign4" value='4' <?php checked( get_option( 'FC_form_checkbox4' ), 1 ); ?> />
								<span >White</span>
							</div>
				</div>
			</table>

			<p><?php _e('Would you like give us some credit? come on be nice :) ', 'WPTSfloatingComments'); ?><input type='checkbox' name='maybe_give_credit' value='1' <?php checked(  get_option('does_user_allow_credit'), 1 ); ?> /></p>

			<p class='submit'>
				<input id='floatComSubmit' type="submit" name="submit" class="button-primary" value='<?php _e('Save Changes', 'WPTSfloatingComments'); ?>'>
			</p>

			<h3><?php _e('Powered By: ', 'WPTSfloatingComments'); ?><a href="http://www.wpthemegenerator.com">WordPress Theme Generator</a> <?php _e(' and ', 'WPTSfloatingComments'); ?><a href="http://www.wpthemeshock.com/">ThemeShock</a></h3>
			<p id='WPTG_description'><?php _e('One theme, a thousand posibilities: Create amazing and unlimited themes by playing with 1000+ pre-designed elements (or uploading your own designs) and then download in fully working WP or HTML/CSS.', 'WPTSfloatingComments'); ?></p>
			<h4><a href="http://www.wpthemegenerator.com/gallery/?element=public%20themes"><?php _e('100 Free Sample Themes', 'WPTSfloatingComments'); ?></a>&nbsp; &nbsp; <a id='launch_modal_link' href="#"><?php _e('Check The 1 Minute Video', 'WPTSfloatingComments'); ?></a></h4>
	</form>

	<!-- Modal -->
  	<div class='fc_modal_box'>
  		<iframe id='videoIframe' width="560" height="315" src="http://www.youtube.com/embed/wVNmXzCblrw" frameborder="0" allowfullscreen></iframe>
  		
  	</div>
  	<div class='fc_modal_backdrop'></div>

</div>
  	


	<!-- Jquery Stuff -->
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	 <script type="text/javascript">

	 function select_this_when_none_selected()
	 	{	
	 		var checkedBoxes = 0;
	 		jQuery( '.fc-theme-scheme input[type=checkbox]' ).each(function(){
	 			$isChecked       = jQuery( this ).attr( 'checked' );
	 			if ( $isChecked == 'checked' )
	 			{
	 				checkedBoxes++;
	 			}
	 		});

	 		if ( checkedBoxes == 0 )
	 		{
	 			return true;
	 		}

	 		else if ( checkedBoxes > 0 )
	 		{
	 			return false;
	 		}
	 	}


	 	// Let just one option be active
	 	jQuery( '.fc-theme-scheme input[type=checkbox]' ).click( function(){
			
			var clickedBoxId = jQuery( this ).attr( 'id' );

			// At lease one should be selected
				if ( select_this_when_none_selected() )
				{
					jQuery( this ).attr( 'checked', 'checked' );
				}

	 		
	 		jQuery( '.fc-theme-scheme input[type=checkbox]' ).each( function(){
	 			$boxId   = jQuery( this ).attr( 'id' );
	 			
	 			if( $boxId != clickedBoxId )
	 			{
	 				jQuery( this ).removeAttr( 'checked' );
	 			}

	 			
	 		});
	 	});

	 	// Show the modal
	 	show_modal_box_for_video();

	 	// Hide the modal when backdroop clicked
	 	hide_modal_box_for_video();

	 	function show_modal_box_for_video()
	 	{	
	 		$launchModalLink  = jQuery( '#launch_modal_link' );
	 		$fcModalContainer = jQuery( '.fc_modal_backdrop');
	 		$fcModalBackdrop  = jQuery( '.fc_modal_box');
	 		$videoIframe      = jQuery( '#videoIframe' );
	 		
	 		$launchModalLink.on('click', function(e){
	 			e.preventDefault();
	 			
	 			$fcModalContainer.fadeIn();  
	 			$fcModalBackdrop.fadeIn();  
	 			$videoIframe.fadeIn(1000);
	 	    });
	 		
	 		
	 	}

	 	function hide_modal_box_for_video()
	 	{	

	 		$fcModalBackdrop   = jQuery( '.fc_modal_backdrop');
	 		
	 		$fcModalContainer  = jQuery( '.fc_modal_box');
	 		$videoIframe       = jQuery( '#videoIframe' );

	 		$fcModalBackdrop.click( function(){
	 			$fcModalContainer.fadeOut();  
	 			$fcModalBackdrop.fadeOut();  

	 		});


	 		
	 	}

	 	
	 	
	 </script>



