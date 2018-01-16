<?php

////////////////// function for create the table /////////////////
if(!function_exists("create_priority_api_tbl"))
{
	function create_priority_api_tbl()
		{
			global $wpdb;
			$table_name = priotity_api_tbl();	
			$charset_collate = $wpdb->get_charset_collate();
				$sql = "CREATE TABLE $table_name (
					id mediumint(9) NOT NULL AUTO_INCREMENT,
					url TEXT NOT NULL,
					api_url TEXT NOT NULL,
					application VARCHAR(55) NOT NULL,
					enviromnet_name VARCHAR(55) NOT NULL,
					language VARCHAR(55) NOT NULL,
					username VARCHAR(55) NOT NULL,
					password VARCHAR(55) NOT NULL,
					interface VARCHAR(55) NOT NULL,
					add_date VARCHAR(55) NOT NULL,
					UNIQUE KEY id (id)		
				) $charset_collate;";		
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
}
if(!function_exists("create_errorlog_table"))
{
	function create_errorlog_table()
		{
			global $wpdb;
			$table_name = errorlog_table_tbl();	
			$charset_collate = $wpdb->get_charset_collate();
				$sql = "CREATE TABLE $table_name (
					id mediumint(9) NOT NULL AUTO_INCREMENT,
					Response TEXT NOT NULL,
					TimeStamp VARCHAR(55) NOT NULL,
					InterfaceName VARCHAR(55) NOT NULL,
					XMLout TEXT NOT NULL,
					Status VARCHAR(55) NOT NULL,
					Order_ID VARCHAR(55) NOT NULL,
					UNIQUE KEY id (id)		
				) $charset_collate;";		
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
}

global $wpdb;
if (count($wpdb->get_var("SHOW TABLES LIKE '" . priotity_api_tbl() . "'")) == 0)
	{
		create_priority_api_tbl();
	}
if (count($wpdb->get_var("SHOW TABLES LIKE '" . errorlog_table_tbl() . "'")) == 0)
	{
		create_errorlog_table();
	}

	
?>
