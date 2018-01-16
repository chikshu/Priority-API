<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<title>PriorityApi Form</title>  	
	</head>
	<body>
		<div class="">
			<div class="Form_title"><h2>Priority API Paramters</h2></div>
			<form action="" method="post" id="priority_frm">
				<input type="hidden" name="prio_id" value="<?php if($myrows[0]->id) { echo $myrows[0]->id; } ?>" />
				<table class="form-table">
						<tbody><tr class="form-field form-required">
							<th scope="row"><label for="api_url">API Url</label></th>
							<td><input type="text" name="api_url" value="<?php if($myrows[0]->api_url) { echo $myrows[0]->api_url; } ?>" placeholder="http://webapi.roi-holdings.com/api/Priority/" required/></td>
						</tr>						
						<tr class="form-field form-required">
							<th scope="row"><label for="user_login">Application</label></th>
							<td><input type="text" name="application" value="<?php if($myrows[0]->application) { echo $myrows[0]->application; } ?>" required/></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="enviromnet_name">EnviromnetName</label></th>
							<td><input type="text" name="enviromnet_name" value="<?php if($myrows[0]->enviromnet_name) { echo $myrows[0]->enviromnet_name; } ?>" required/></td>
						</tr>
						<tr class="form-field">
							<th scope="row"><label for="language">Language</label></th>
							<td><input type="text" name="language" value="<?php if($myrows[0]->language) { echo $myrows[0]->language; } ?>" required/></td>
						</tr>
						<tr class="form-field">
							<th scope="row"><label for="url">Url</label></th>
							<td><input type="text" name="url" value="<?php if($myrows[0]->url) { echo $myrows[0]->url; } ?>" required/></td>
						</tr>
						<tr class="form-field">
							<th scope="row"><label for="url">UserName</label></th>
							<td><input type="text" name="username" value="<?php if($myrows[0]->username) { echo $myrows[0]->username; } ?>" required/></td>
						</tr>
						<tr class="form-field">
							<th scope="row"><label for="url">Password</label></th>
							<td><input type="text" name="password" value="<?php if($myrows[0]->password) { echo $myrows[0]->password; } ?>" required/></td>
						</tr>
						<!--tr class="form-field">
							<th scope="row"><label for="interface">Interface</label></th>
							<td><input type="text" name="interface" value="<?php if($myrows[0]->interface) { echo $myrows[0]->interface; } ?>" required/></td>
						</tr-->
					</tbody>
				</table>
				<p class="submit">
					<img src="<?php echo plugins_url("/assets/images/Loader.gif",dirname(__FILE__))?>" style="display:none;" id="loader_img">
					<input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
				</p>
			</form>
		</div>
<script>		
		jQuery('#priority_frm').on('submit', function (e) {
            e.preventDefault();
			jQuery("#loader_img").show();
			jQuery.ajax({ 
				 data: jQuery('#priority_frm').serialize(),
				 type: 'post',
				 url: '',
				 success: function(data) {
					  //alert(data); //should print out the name since you sent it along
					   location.reload();
					}
			});
		});
</script>
	</body>
</html>

<?php


?>
	
	