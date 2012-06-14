
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url(__FILE__); ?>css/buttons.css">
<!-- Include the css of the selected theme instead of changing the default using jQuery-->
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url(__FILE__) . 'css/front_view_base.css'; ?> ">
<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url(__FILE__) . 'css/' . $fc_theme_style; ?> ">
<?php echo $maybe_display_wptg_credit; ?>



<div id="toBeAppended">
	<img id="contact_form_small" src="<?php echo plugin_dir_url(__FILE__) . 'img/' . $FCSmallInterfaceImage[$FCLook]; ?>" />
	<div class="fc_image_title"><?php _e('Comment Here', 'WPTSfloatingComments'); ?></div>
	<div class="click_area"><?php _e('Share some love with a comment', 'WPTSfloatingComments'); ?></div>
	<div id='wptg_credit' class='wptg_credit maybe_display_credit'><a href="www.wpthemegenerator.com">by wptg</a></div>
	
	<div class='commemt-form'>
		<form class='custom-comment' action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method='post' id='commentform' >
			
			<input class='custom-comment-form-username' type="text" name='author' value="<?php _e('Name', 'WPTSfloatingComments');  ?>"  >
			<input class='custom-comment-form-email' type='text' name='author_email' value='<?php _e('Gravatar or email', 'WPTSfloatingComments'); ?>' >
			<textarea class='custom-comment-form-textarea' name='comment' id='comment'><?php _e('Thanks for leaving us your comments and suggestions', 'WPTSfloatingComments');  ?></textarea>
			
				<input id='custom-comment-form-submit-button' type='submit' class='btn <?php echo $ft_theme_button_class; ?>  ' value='Submit' >
				<input type='hidden' name='comment_post_ID' value='<?php the_ID(); ?>' />
				<input type='hidden' name='email' id='email' value='sampleUser@gmail.com' />
				<span class="feedback_message"></span>
			 <!-- <?php do_action( 'comment_form', $post->ID ); ?> -->

		</form>

	</div>

</div>

<?php
	//variable Setup
	$comment_url  = get_option( 'siteurl' )  . '/wp-comments-post.php';  
	$postUrl      = plugin_dir_url(__FILE__) . '/comment_digg.php' ;
	$positionXPhp = get_option( 'FCPositionX' );
	$positionYPhp = get_option( 'FCPositionY' );

	

?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">


function hideFieldsValuesWhenClicked()
{
	// Username
	jQuery( '.custom-comment-form-username' ).click(function(){
		jQuery( this ).attr('value', '');
	});

	jQuery( '.custom-comment-form-username' ).focus( function(){
		jQuery( this ).attr('value', '');
	});

	//Textarea
	jQuery( '.custom-comment-form-textarea' ).click(function(){
		jQuery( this ).html('');
	});

	jQuery( '.custom-comment-form-textarea' ).focus( function(){
		jQuery( this ).html('');
	});

	//Email
	jQuery( '.custom-comment-form-email' ).click(function(){
		jQuery( this ).attr('value', '');
	});

	jQuery( '.custom-comment-form-email' ).focus( function(){
		jQuery( this ).attr('value', '');
	});
}

function validate_form()
{	
	$formUsername    = jQuery( '.custom-comment-form-username' );
	$formUserEmail   = jQuery( '.custom-comment-form-email' );
	$formUserContent = jQuery( '.custom-comment-form-textarea' );

	if( $formUsername.val() == '' || $formUserEmail.val() == '' || $formUserContent.val() =='' )
	{
		return false;

	}
	else if ( $formUsername.val()    != '' 
		   && $formUserContent.val() != ''
		   && $formUserEmail.val()   != ''
		   
		   && $formUsername.val()    != 'Name'
		   && $formUserEmail.val()   != 'Grabatar or email'
		   && $formUserContent.val() != 'Thanks for leaving us your comments and suggestions'
		    )
	{
		return true;
	}
}

function show_result_message( $type )
{
	if( $type == 1 )
	{	
		var smallForm = jQuery( '#contact_form_small' );
    	var clickArea = jQuery( '.click_area' );
		
		jQuery( '.feedback_message' ).html( 'Comment Sent.' );
			//Hide the feedback message
			setTimeout( function(){ 
				jQuery( '.feedback_message' ).fadeOut();
			}, 1000);

			//Hide the container
			setTimeout( function(){ 
				$smallFormTitle = jQuery( '.fc_image_title' );
				jQuery( '.commemt-form' ).hide();
				smallForm.show();
				clickArea.show();
				$smallFormTitle.show();
				maybeShowCreditLink();
			}, 2000);

	}

	else if ( $type == 0 )
	{
		jQuery( '.feedback_message' ).html('Fill all Fields');
				setTimeout( function(){
					$smallFormTitle  = jQuery( '.fc_image_title' );
					$feedbackMessage = jQuery( '.feedback_message' );
					
				$feedbackMessage.fadeOut();
				


		}, 10000);
	}

} 

 // Take the div out to avoid position relative troubles
 jQuery( '#toBeAppended' ).appendTo( 'body' );

 // Set the default position of the box
 jQuery(document).ready(function(){




 	// Define Default position
 	var postDiv            = jQuery( '.post' );
 	var titleDiv 		   = jQuery( '.entry-title' );
 	var postDivOffsetLeft  = postDiv.offset().left;
 	var postDivOffsetTop   = postDiv.offset().top;
 	$mainContainer		   = jQuery( '#toBeAppended' );

 	$positionX = <?php echo $positionXPhp; ?>;
 	$positionY = <?php echo $positionYPhp; ?>;
 	jQuery( '#toBeAppended' ).css({'top': postDivOffsetTop + $positionY, 'left': postDivOffsetLeft  - $positionX });
 	$mainContainer.fadeIn();
 

 	//Remove the inherited style from WPTG Theme
 	$commentFormInputText = jQuery('.custom-comment input[type=text]');
 	$commentFormInputText.css( 'background','white' );

	 // Event on scroll
	 jQuery( window ).scroll( function(){
	 	// Be fixed at top 10px
	 	var commentsBox  = jQuery( '#toBeAppended');
	 	var boxPositionY = commentsBox.position().top;
	 	var scrollTopSize = jQuery(window).scrollTop();
	 	//alert( postDivOffsetTop );
	 	//When box position.top = 10px change css position to fixed
	 	
	 	if( scrollTopSize > postDivOffsetTop + $positionY )
	 	{	
	 		commentsBox.css({'position':'fixed', 'top': '35px'});
	 	}
	 	else if( scrollTopSize < postDivOffsetTop + $positionY )
	 	{
	 		commentsBox.css({'position':'absolute', 'top': postDivOffsetTop + $positionY});
	 	}
	 });


 });


// Hide the form values when clicked for the first time
 hideFieldsValuesWhenClicked();
 
 //Show The Commemt Form when small Image Clicked
 jQuery( '.click_area' ).click(function(){

 	jQuery( '.commemt-form' ).show();
 	var smallForm  		  	  = jQuery( '#contact_form_small' );
 	var clickArea         	  = jQuery( '.click_area' );
 	var commentImageTitle 	  = jQuery( '.fc_image_title' );
 	$wptgCreditDiv 		  	  = jQuery( '#wptg_credit' );

 	smallForm.hide();
 	clickArea.hide();
 	commentImageTitle.hide();
 	$wptgCreditDiv.hide();


 });

 //Hide the form when user clicks outside the form
jQuery(document).mouseup(function (e)
{
    var container 		  = jQuery( '.commemt-form' );
    var smallForm 		  = jQuery( '#contact_form_small' );
    var clickArea 		  = jQuery( '.click_area' );
    var commentImageTitle = jQuery( '.fc_image_title' );

    if (container.has(e.target).length === 0)
    {
        container.hide();
        smallForm.show();
        clickArea.show();
        commentImageTitle.show();

        //whether to show credit div back
        maybeShowCreditLink();

    }
});

 // Submit the comment	
 jQuery( '#custom-comment-form-submit-button' ).click(function(e){
 	
 	e.preventDefault();
 	// Variable Definition
 	$userName 		= jQuery( '.custom-comment-form-username' ).val();
 	$userEmail		= jQuery( '.custom-comment-form-email' ).val();
 	$commentContent = jQuery( '.custom-comment-form-textarea' ).val();
 	$postId         = <?php the_ID(); ?>;


 	if( validate_form() )
 	{	
 		jQuery.ajax({
	 		type: 'POST',
	 		data: { userName : $userName, userEmail : $userEmail, commentContent: $commentContent, postId: $postId },
	 		success: function(data){
	 			//alert(data);
	 		}
 		});

 		show_result_message( 1 );
 	}

 	else if ( ! validate_form() )
 	{	
 		
 		show_result_message( 0 );
 	}

 });

  function maybeShowCreditLink()
        {
        	$maybe_show_credit_back = <?php echo $maybe_show_credit_back;  ?>

	        if( $maybe_show_credit_back )
	        {	$wptgCreditDiv = jQuery( '.wptg_credit' );  

	        	$wptgCreditDiv.show();
	        }
        }

 </script>

 

