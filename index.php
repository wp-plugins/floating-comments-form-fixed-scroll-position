<?php
/*
Plugin Name: Floating Comments Fixed Scroll Position
Plugin URI: http://www.wordpressthemeshock.com/
Description: Creates a fancy comment box at the side of the content
Author: ThemeShock
Version: 1.0
Author URI: http://www.wordpressthemeshock.com/
*/

/*  Copyright 2012  (email : blog.iconshock@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

    // NOTE: Whether to display errors 
    //ini_set('display_errors', 1);

    // Include the main application file
    require 'application/floatingComments.php';


    // Set the default data when the plugin is first installed
    afterInstallFCplugin();

    // When plugins loaded
    add_action('plugins_loaded', 'fc_translations_pack');

    function fc_translations_pack() {
       load_plugin_textdomain( 'WPTSfloatingComments', false, dirname( plugin_basename( __FILE__ ) ) . '/application/languages/' );
    }

    function afterInstallFCplugin()
    {   
        register_activation_hook( __FILE__, 'after_FC_plugin_activated' );
    }

    function after_FC_plugin_activated()
    {           
        $defaultPositionX     = 120;
        $defaultPositionY     = 1;
        $defaultFixedPosition = 35;
        $defaultStyle         = 1;

        //Set default Positions
        update_option( 'FCPositionX', $defaultPositionX );
        update_option( 'FCPositionY', $defaultPositionY );
        update_option( 'FCFixedPosition', $defaultFixedPosition );

        //Set default Design
        update_option( 'FCDesign', $defaultStyle );

        // Maybe display credit Link
        update_option( 'does_user_allow_credit', 0 );

        //Set checkbox 1 value 1 and 0 for the others 
        update_option( 'FC_form_checkbox1', 1 );
        update_option( 'FC_form_checkbox2', 0 );
        update_option( 'FC_form_checkbox3', 0 );
        update_option( 'FC_form_checkbox4', 0 );
    }

    


    
?>