<?php
/**
* @package Floating Comments
*
**/
class FC_Controller
{
	public $load;
	public $model;

	function __construct()
	{
		$this->load = new FC_Load();
		$this->model = new FC_Model();
		
		$this->addOptionsPage();
		$this->addContentFilter();

	}

	/* ----------- addOptionsPage required Functions --------------- */
	function addOptionsPage()
	{
		add_action( 'admin_menu', array( &$this, 'floating_comments_plugin_page' ) );
	}

	function floating_comments_plugin_page()
	{
		add_menu_page(
			'Floating Comments Options',
			'Floating Comments',
			'manage_options',
			'floating_comments_slug',
			array( &$this, 'render_interface' ),
			plugin_dir_url(__FILE__). 'views/img/themeshock2.png'
		);

	}

	function render_interface()
	{	
		$data['fc_options_positionX_prompt'] = maybe_unserialize( get_option( 'fc_options_positionX_prompt' ) );
		$data['fc_options_positionY_prompt'] = maybe_unserialize( get_option( 'fc_options_positionY_prompt' ) );
		$data['fc_options_info_prompt'] 	 = maybe_unserialize( get_option( 'fc_options_info_prompt' ) );
		$data['fc_options_wptg_description'] = maybe_unserialize( get_option( 'fc_options_wptg_description') );

		$this->model->checkPostData();
		$this->load->view('floating_comments_options.php', $data );
		//$this->load->view('js/floatComFormValidation.js');
	}

	/* ---------------- end addOptionspage ----------------------- */

	/* ----------------- addSampleFilter ----------------------------*/
		
	function addContentFilter()
	{
		add_filter('the_content', array( &$this, 'filter_callback' ));
	}

	function filter_callback($content)
	{	
		if( is_single() )
		{	
			// Get the Prompts in the different languages array 
			$data['comment_box_title_prompt']    	  = maybe_unserialize( get_option( 'comment_box_title_prompt') );
			$data['comment_box_content_prompt']  	  = maybe_unserialize( get_option( 'comment_box_content_prompt' ) );

			$data['comment_box_large_email_prompt']   = maybe_unserialize( get_option( 'comment_box_large_email_prompt' ) );
			$data['comment_box_large_title_prompt']   = maybe_unserialize( get_option( 'comment_box_large_title_prompt' ) );
			$data['comment_box_large_content_prompt'] = maybe_unserialize( get_option( 'comment_box_large_content_prompt' ) );


			// Send the selected theme stylesheet name to the view
			$data['fc_theme_style']                   = $this->model->get_fc_selected_theme();
			$data['ft_theme_button_class']            = $this->model->get_fc_selected_theme_button_class();
			$data['maybe_display_wptg_credit']		  = $this->model->display_wptg_credit();
			$data['maybe_show_credit_back']			  = get_option( 'does_user_allow_credit' );

			// Send box positions X plus Y
			$data['positionXPhp']                     = get_option( 'FCPositionX' );
			$data['positionYPhp']                     = get_option( 'FCPositionY' );
			$data['fixedPosition']					  = get_option( 'FCFixedPosition' );

			// Images
			$data[ 'FCSmallInterfaceImage']  				  = array(
																'comments-black.png',
																'comments-blue.png',
																'comments-red.png',
																'comments-white.png'

							    								);
			$data[ 'FCLook']               					  = get_option( 'FCDesign' ) - 1;


			$this->load->view( 'comment_receiver.php' );
			$this->load->view( 'comments_widget.php', $data );

			return $content;
		}
		else
		{
			return $content;
		}
		
	}

	/* ---------------- end addOptionspage ----------------------- */



}	

?>