<?php
/**
* Plugin Name: EasyForm
* Plugin URI: https://www.sac.com/
* Description: This is the very first plugin I ever created.
* Version: 1.0
* Author: Sachin Raj
* Author URI: https://sac.com/
**/
defined( 'ABSPATH' ) or die('You are in the wrong place !! Cannot have access !!');

/*On activation creating databases*/
function create_plugin_database_table() {

 global $wpdb;
 $table_name = $wpdb->prefix . 'easyform_contacts';
 $sql = "CREATE TABLE $table_name (
 id mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
 fname varchar(250) NOT NULL,
 lname varchar(250) NOT NULL,
 email varchar(250) NOT NULL,
 gender varchar(250),
 loc varchar(250),
 twitter varchar(350),
 PRIMARY KEY  (id)
 );";

 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
 dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_plugin_database_table' );


register_deactivation_hook( __FILE__, 'deactivate' );

register_uninstall_hook( __FILE__, 'uninstall' );



/*
* create plugin menus to admin panel side nav bar
*/

add_action('admin_menu', 'plugin_menu_setup');
 
function plugin_menu_setup(){
       
        
         add_menu_page('My Page Title', 'Register Contacts', 'manage_options', 'contactapp', 'register_form' );
			add_submenu_page('contactapp', 'List', 'List Contacts', 'manage_options', 'list-cp-contact', 'contact_list');
			add_submenu_page('contactapp', 'Search', 'Search Contacts', 'manage_options', 'search_contacts', 'search_contacts');
			
}

/*
* Get Contact Register Form
*/

function register_form(){

	include '_form_register_contact.php';
	easy_form_register();
}
add_shortcode('contact_form', 'register_form'); 

/*
* List Contacts - from database
*/

function contact_list(){

	include '_form_contact_list.php';
	easy_contact_list();
}

/*
* Get search
*/


function search_contacts(){

	include '_search_contacts.php';
	search();
}










/*
* Styles
*/


add_action('admin_head', 'admin_styles');

function admin_styles() {
    echo '<style>
       h2{
			text-align: center;
		}

		.contact-form{
		    display: block;
		    width: 60%;
		    margin: 25px 20px auto;
		    background-color: #ffffff;
		    padding: 10px;
		    border: 1px solid #e8e8e7;
		    border-radius: 5px;
		}
		.contact-form h2{
			text-align: center;
		    background-color: #fafafa;
		    padding: 20px;
		    color: #333333;
		    font-size: 18px;
		}
		form{
			display: block;
		    margin: 0 auto;
		    text-align: center;
		}
		.form-group{
			padding: 20px;
		}
		.form-group label{
			font-size: 14px;
		    font-weight: 700;
		    padding-right: 60px;
		}
		button{
			border: 1px solid #e8e8e8;
		    padding: 7px 56px;
		    font-size: 18px;
		    font-weight: 600;
		    background-color:#fafafa;
		}
		button:hover{

		    color:#ffffff;
		    background-color:#000000;
		}
		input[type=date], input[type=datetime-local], input[type=datetime], input[type=email], input[type=month], input[type=number], input[type=password], input[type=search], input[type=tel], input[type=text], input[type=time], input[type=url], input[type=week]{
			    border: 1px solid #e8e8e8;
		}
		
		
		
		
		#customers {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 80%;
			margin: 50px auto;
		  }
		  
		  #customers td, #customers th {
			border: 1px solid #ddd;
			padding: 8px;
		  }
		  
		  #customers tr:nth-child(even){background-color: #f2f2f2;}
		  
		  #customers tr:hover {background-color: #ddd;}
		  
		  #customers th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #4c8faf;
			color: white;
			text-transform: uppercase;
			letter-spacing: 1px;
			font-weight: 400;
		  }


		  .delete-btn{
			border: 1px solid #e1e0e0;
			padding: 5px 20px;
			font-size: 12px;
			font-weight: 300;
			background-color: #cc0303;
			color: #ffffff;
		  }
    </style>';
}