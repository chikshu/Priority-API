<?php
/*
Plugin Name: PriorityAPI
Plugin URI: 52.31.192.197/leofresh
Description: This plugin allows you to add InterfaceIn/Out parameters.
Author: Shikha
Version: 1.0
Author URI: 
*/

//////////////////////// Set Global Vraiables ////////////////////
global $apistatus;

//////////////////////// Define Constants ////////////////////////
if (!defined("WP_Priority_DIR")) define("WP_Priority_DIR", plugin_dir_path(__FILE__));

//////////////////////// Add Menu under settings//////////////////////
function add_settings_menu(){	
//add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
		add_menu_page( 'PriorityAPI', 'PriorityAPI', 'read', 'priority_api', 'priority_parpameters','dashicons-index-card');
	
//add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' )
		add_submenu_page( 'priority_api','Priority API', 'Priority API', 'read', 'priority_api', 'priority_parpameters');
		add_submenu_page( 'priority_api', 'ErrorLog', 'ErrorLog Table', 'read', 'errorlog_table', 'errorlog_table_parameters');
		add_submenu_page( 'priority_api', 'TestUnit', 'TestUnit', 'read', 'testunit', 'testunit_frm');
	   
	   
} 

/////////////////////// Function for show the priority form //////////////
if(!function_exists("priority_parpameters")){
	function priority_parpameters() {
		global $wpdb;
		$table_name = priotity_api_tbl();
		$myrows = $wpdb->get_results( "SELECT * FROM ".$table_name );
		include WP_Priority_DIR . "/views/priority_parameter.php";
	}
}

/////////////////////// Function for show the ErrorLog Table form //////////////
if(!function_exists("errorlog_table_parameters")){
	function errorlog_table_parameters() {
		global $wpdb;
		$table_name = errorlog_table_tbl();
		//$myrows = $wpdb->get_results( "SELECT * FROM ".$table_name );
		
		$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
		
		$limit = 20; // number of rows in page
		$offset = ( $pagenum - 1 ) * $limit;
		$total = $wpdb->get_var( "SELECT COUNT(`id`) FROM ".$table_name );
		$num_of_pages = ceil( $total / $limit );		
		$myrows = $wpdb->get_results( "SELECT * FROM ".$table_name ." limit ".$offset.",".$limit);
		include WP_Priority_DIR . "/views/error_log_parameter.php";
	}
}

/////////////////////// Function for show the TestUnit form //////////////
if(!function_exists("testunit_frm")){
	function testunit_frm() {
		include WP_Priority_DIR . "/views/testunit_frm.php";
	}
}

/////////////////////// Function for add the style files //////////////
if(!function_exists("backend_plugin_css_styles_for_priority_api")) {
	function backend_plugin_css_styles_for_priority_api(){
		wp_enqueue_style("form_custom.css", plugins_url("/assets/css/form_custom.css", __file__));
	}
}

/////////////////////// Function for add the install script //////////////
if(!function_exists("plugin_install_script_for_priority_api")) {
	function plugin_install_script_for_priority_api() {
			if(file_exists(WP_Priority_DIR . "/lib/install_script.php"))
				{
					include WP_Priority_DIR . "/lib/install_script.php";
				}
	}
}

////////////////////// Functions for Returning Table Names ////////////////
function priotity_api_tbl()
{
	global $wpdb;
	return $wpdb->prefix."priotity_api_tbl";
}
function errorlog_table_tbl()
{
	global $wpdb;
	return $wpdb->prefix."errorlog_table_tbl";
}

function PriorityAPI_credential(){
	$api_table_name = priotity_api_tbl();
	$API_credential = $wpdb->get_results( "SELECT * FROM ".$api_table_name );
	return $API_credential;
}

///////////////////////////////////  Call Hooks   /////////////////////////////////////////////////////

// activation Hook called for installation_for_priority_api
register_activation_hook(__FILE__, "plugin_install_script_for_priority_api");

// add_action Hook called for function backend_plugin_css_styles_for_priority_api
add_action("admin_init", "backend_plugin_css_styles_for_priority_api");

// Add action hook for add menu under settings
add_action('admin_menu', 'add_settings_menu');


////////////////////////////////// Form Submit ///////////////////////////////////////////

////////////////// Add Priority API parameters ///////////////////////////
if(isset($_POST['application'])){
	global $wpdb;
	$table_name = priotity_api_tbl();
	if($_POST['prio_id'] != '') {
			$wpdb->update( 
			$table_name, 
			array( 
				'url' => $_POST['url'], 
				'api_url' => $_POST['api_url'], 
					'application' => $_POST['application'] ,
					'enviromnet_name' => $_POST['enviromnet_name'], 
					'language' => $_POST['language'], 
					'username' => $_POST['username'], 
					'password' => $_POST['password']					
			), 
			array( 'id' => $_POST['prio_id'] )			 
		);
		echo 'updated';
	} else {
			$dt = date("m-d-y h:i");	
			$wpdb->insert( 
			$table_name, 
			array( 
					'url' => $_POST['url'], 
					'api_url' => $_POST['api_url'], 
					'application' => $_POST['application'] ,
					'enviromnet_name' => $_POST['enviromnet_name'], 
					'language' => $_POST['language'], 
					'username' => $_POST['username'], 
					'password' => $_POST['password'], 
					'interface' => '', 
					'add_date' => $dt 
				)
			);	
			echo 'Inserted';
	}
	exit;
	
}

////////////////////// Test xml using InterfaceIn/Out methods ////////////////////
if(isset($_POST['xmldata'])){
	$api_table_name = priotity_api_tbl();
	$API_credential = $wpdb->get_results( "SELECT * FROM ".$api_table_name );
	$xmldata = $_POST['xmldata'];
	$interface_type = $_POST['interface_type'];
	
	 $api_url = $API_credential[0]->api_url;
	 $Application = $API_credential[0]->application;
	 $EnviromnetName = $API_credential[0]->enviromnet_name;
	 $Language = $API_credential[0]->language;
	 $apiUrl = $API_credential[0]->url;
	 $Password = $API_credential[0]->password;
	 $UserName = $API_credential[0]->username;
	 //$Interface = $API_credential[0]->interface;
	 
	 $Interface = $_POST['interface'];
	
	if($interface_type == 'InterfaceIn') {
		//$url = 'http://webapi.roi-holdings.com/api/Priority/'.$interface_type;
		 $url = $api_url.$interface_type;
		
		$postData = array('Application' => $Application, 'EnviromnetName' => $EnviromnetName,'Language' => $Language,'UserName' => $UserName,'Url' => $apiUrl, 'Password' => $Password, 'Interface' => $Interface,'inputxml' => $xmldata);
				$jsonData = json_encode($postData);
				
				$curlObj = curl_init();
				curl_setopt($curlObj, CURLOPT_URL, $url);
				curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curlObj, CURLOPT_HEADER, 0);
				curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
				curl_setopt($curlObj, CURLOPT_POST, 1);
				curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

				$response = curl_exec($curlObj);
				echo $response;
				curl_close($curlObj);			
				exit;	
	} else {
		$act_text = str_replace(' ', '%20', $xmldata);
		$act_text = str_replace('+', '%2B', $act_text);
		$act_text = str_replace('&', '%26', $act_text);

		 //$url = 'http://webapi.roi-holdings.com/api/Priority/InterfaceOut?Application='.$Application.'&EnviromnetName='.$EnviromnetName.'&Language='.$Language.'&UserName='.$UserName.'&Url='.$apiUrl.'&Password='.$Password.'&Interface='.$Interface.'&inputxml='.$act_text;
		 $url = $api_url.'InterfaceOut?Application='.$Application.'&EnviromnetName='.$EnviromnetName.'&Language='.$Language.'&UserName='.$UserName.'&Url='.$apiUrl.'&Password='.$Password.'&Interface='.$Interface.'&inputxml='.$act_text;
	
		$data=file_get_contents($url);
		print_r($data);
		exit;
	}
}


?>
