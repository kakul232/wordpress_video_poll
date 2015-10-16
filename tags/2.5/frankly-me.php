<?php
ob_start();


/**
* Plugin Name: Video Polls
* Description: FranklyMe Poll plugin allows you to easily manage the polls and cross-synchronization of Open Question from within your FranklyMe account, wherein users would be able to answer those question via FranklyMe app and website.
* Author: Frankly.me
* Version: 2.5
* Author URI: http://frankly.me
* Plugin URI: https://wordpress.org/plugins/Video-Polls/
* Text Domain: frankly-me
* License: GPLv2
**/


/*  Copyright 2015  ABHISHEK GUPTA  (email : abhishekgupta@frankly.me)

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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


 class frankly_video_poll {
	
	
	public function __construct()
	{	

	add_action( 'admin_menu',array( $this, 'frankly_poll_page' ));
	add_action( 'wp_enqueue_scripts',array( $this, 'my_scripts_main' ));
	add_action( 'admin_enqueue_scripts',array( $this, 'my_adminscripts_main' )); 
	
	add_action('bootsrtap_hook',array( $this, 'add_bootstrap'));
	}

	function frankly_poll_page() {
		add_menu_page( 
			__( 'Frankly Widget', 'textdomain' ),
			'Video Poll',
			'manage_options',
			'Frankly',
			'create_poll',
			plugins_url( '/images/icon.png', __FILE__ ),
			6
		); 
	}


//  wp_enqueue_script for user 

function my_scripts_main() {

    wp_enqueue_style( 'poll_style', plugins_url( '/css/style.css' , __FILE__ ) );


    wp_enqueue_script(
        'my_voter_script',
        plugins_url( '/js/main.js' , __FILE__ ),
        array( 'jquery' )
    );

    wp_localize_script( 'my_voter_script', 
        'myAjax',
         array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'action'=>'my_poll_srt')
    ); 
    wp_localize_script( 'my_voter_script', 
        'myAjaxwiget',
         array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'action'=>'my_poll')
    );           
}


//  wp_enqueue_script for Admin

function my_adminscripts_main() {

    wp_enqueue_style( 'poll_style', plugins_url( '/css/admin-style.css' , __FILE__ ) );
    wp_enqueue_script( 'jquery' );
          
}


//  Create hook for admin bootstrap


function add_bootstrap()
{
     wp_enqueue_style( 'bootstrap', plugins_url( '/css/bootstrap.min.css' , __FILE__ ) );
}

}

$vp = new frankly_video_poll;

// Incude some action File 

require_once(dirname(__FILE__) .'/franklypoll.php');

require_once(dirname(__FILE__) .'/embed-shortcode.php');

require_once(dirname(__FILE__) .'/sidepane-widget.php');





ob_flush();



?>