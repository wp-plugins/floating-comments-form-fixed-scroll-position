<?php

class FC_Model
{
	function checkPostData()
	{
		if ( isset($_POST['submit']) ) 
		{	
			if( isset($_POST['X_position'], $_POST['Y_position'], $_POST['fc-fixed_position']) 
				&&  $_POST['X_position'] != null 
				&&  $_POST['Y_position'] != null
				/*&& $_POST['X_position'] < 1000 
				&& $_POST['X_position'] > 0 
				&& $_POST['Y_position'] < 1000 
				&& $_POST['Y_position'] > 0 */
				&& is_numeric( $_POST['X_position'] )
				&& is_numeric( $_POST['Y_position'] )
				)
			{	
				$positionX     = $_POST['X_position'] + 120;
				$positionY     = $_POST['Y_position'];
				$fixedPosition = $_POST['fc-fixed_position'] + 35;

				if( isset( $_POST['FCDesign1'])  )
				{
					//Asign the Variables 
					$design1 = 1;

					//Write Values in the DB
					$this->update_FC_options( $positionX, $positionY, $design1, $fixedPosition );

					//Write the selected checkbox value
					$this->FC_checked_box( 1 );

					//Show Feedback Message
					$this->show_FC_message();

				}

				else if( isset( $_POST['FCDesign2'])  )
				{
					//Asign the Variables 
					$design2 = 2;

					//Write Values in the DB
					$this->update_FC_options( $positionX, $positionY, $design2, $fixedPosition );

					//Write the selected checkbox value
					$this->FC_checked_box( 2 );

					//Show Feedback Message
					$this->show_FC_message();
				}

				else if( isset( $_POST['FCDesign3'])  )
				{
					//Asign the Variables 
					$design3 = 3;

					//Write Values in the DB
					$this->update_FC_options( $positionX, $positionY, $design3, $fixedPosition );

					//Write the selected checkbox value
					$this->FC_checked_box( 3 );

					//Show Feedback Message
					$this->show_FC_message();
				}

				if( isset( $_POST['FCDesign4'])  )
				{
					//Asign the Variables 
					$design4 = 4;

					//Write Values in the DB
					$this->update_FC_options( $positionX, $positionY, $design4, $fixedPosition );

					//Write the selected checkbox value
					$this->FC_checked_box( 4 );

					//Show Feedback Message
					$this->show_FC_message();
				}
			}

			else 
			{
				$this->show_FC_message( false );
			}

			// Does user allow credit
			if( isset( $_POST[ 'maybe_give_credit' ] ) )
				{
					update_option( 'does_user_allow_credit', 1 );
				}
			else
				{
					update_option( 'does_user_allow_credit', 0 );
				}
		}
 	}

	function show_FC_message( $status=true )
	{ 
		if ( $status == true ) :
			?>
			<div id="notice" class="updated below-h2">
					<p>Options Saved</p>
			</div>
			<?php
		endif;

		if ( $status == false )
		{ ?>
			<div id="notice" class="error below-h2">
					<p>Please use only numbers.</p>
			</div>
		<?php  }
	}

	function update_FC_options( $positionX, $positionY, $design, $fixedPosition )
	{
		//Update Positions
		update_option( 'FCPositionX', $positionX );
		update_option( 'FCPositionY', $positionY );
		update_option( 'FCFixedPosition', $fixedPosition );

		//Update Design
		update_option( 'FCDesign', $design );
	}

	function FC_checked_box( $selectedBoxId ) 
	{
		switch ( $selectedBoxId )
		{
			case 1 :

			//Set checkbox 1 value 1 and 0 for the others 
			update_option( 'FC_form_checkbox1', 1 );
			update_option( 'FC_form_checkbox2', 0 );
			update_option( 'FC_form_checkbox3', 0 );
			update_option( 'FC_form_checkbox4', 0 );

			break;

			case 2 :

			//Set checkbox 2 value 1 and 0 for the others 
			update_option( 'FC_form_checkbox1', 0 );
			update_option( 'FC_form_checkbox2', 1 );
			update_option( 'FC_form_checkbox3', 0 );
			update_option( 'FC_form_checkbox4', 0 );

			break;

			case 3 :

			//Set checkbox 3 value 1 and 0 for the others 
			update_option( 'FC_form_checkbox1', 0 );
			update_option( 'FC_form_checkbox2', 0 );
			update_option( 'FC_form_checkbox3', 1 );
			update_option( 'FC_form_checkbox4', 0 );
			break;

			case 4 :

			//Set checkbox 3 value 1 and 0 for the others 
			update_option( 'FC_form_checkbox1', 0 );
			update_option( 'FC_form_checkbox2', 0 );
			update_option( 'FC_form_checkbox3', 0 );
			update_option( 'FC_form_checkbox4', 1 );

			break;


		}
	}

    // Get the selected Theme
    function get_fc_selected_theme()
    {
    	$fc_actual_theme =  get_option( 'FCDesign' );

    	switch( $fc_actual_theme )
    	{
    		case 1 :
    		$fc_selected_theme_stylesheet = 'fc_black_theme.css';
    		break;

    		case 2 :
    		$fc_selected_theme_stylesheet = 'fc_blue_theme.css';
    		break;

    		case 3 :
    		$fc_selected_theme_stylesheet = 'fc_red_theme.css';
    		break;

    		case 4 :
    		$fc_selected_theme_stylesheet = 'fc_white_theme.css';
    		break;

    		default:
    		$fc_selected_theme_stylesheet = 'fc_black_theme.css';
    	}

    	return $fc_selected_theme_stylesheet;
    }

    // Select the buttons style for the actual theme
    function get_fc_selected_theme_button_class()
    {	
    	$fc_actual_theme =  get_option( 'FCDesign' );

    	switch( $fc_actual_theme )
    	{
    		case 1 :
    		$ft_theme_button_class = 'btn-inverse';
    		break;

    		case 2 :
    		$ft_theme_button_class = 'btn-primary';
    		break;

    		case 3 :
    		$ft_theme_button_class = 'btn-danger';
    		break;

    		case 4 :
    		$ft_theme_button_class = 'btn-info';
    		break;

    		default:
    		$ft_theme_button_class = 'btn-inverse';
    	}

    	return $ft_theme_button_class;
    }

    // Whether to display the credit link div
    function display_wptg_credit()
    { 	
    	$does_user_allow_credit = get_option( 'does_user_allow_credit' );

    	switch ( $does_user_allow_credit  )
    	{	
    		case 0 :
    		$maybe_show_credit = 'display: none';
    		break;

    		case 1 :
    		$maybe_show_credit = 'display: block';
    		break;
    	}

    	?>

    	<style type="text/css">
			.maybe_display_credit
			{
				<?php echo $maybe_show_credit; ?>
			}
		</style>

		<?php 

    }

}


?>