<?php
$_SESSION['invisibleCaptcha'] = md5( rand( 0, 100000 ) );


if(      isset( $_POST['userName'], $_POST['commentContent'], $_POST['postId'], $_POST['userEmail'] ) 
	&& ! empty($_POST['userName']) && ! empty($_POST['commentContent'] ) && ! empty($_POST['userEmail']) )
{
	$time 	  		   = current_time('mysql');
	$userName 		   = htmlentities($_POST['userName']);
	$userEmail		   = htmlentities($_POST['userEmail']);
	$commentContent    = htmlentities($_POST['commentContent']);
	$postId            = $_POST['postId'];
	$commentModeration = get_option( 'comment_moderation' );
	
	// Check for comment moderation
	if( empty( $commentModeration ))
	{
		$commentApproved = 1;
	}
	else if ( $commentModeration == 1 )
	{
		$commentApproved = 0;
	}

	// Set up the array with the info for the comment
	$data = array(
	    'comment_post_ID' => $postId,
	    'comment_author' => $userName,
	    'comment_author_email' => $userEmail,
	    'comment_author_url' => 'http://',
	    'comment_content' => $commentContent,
	    'comment_type' => '',
	    'comment_parent' => 0,
	    'user_id' => 0,
	    'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
	    'comment_agent' => $_SERVER['HTTP_USER_AGENT'],
	    'comment_date' => $time,
	    'comment_approved' => $commentApproved,
	);
	
	wp_insert_comment($data);
}


?>