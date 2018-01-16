<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<title>ErrorLog</title>  	
	</head>
	<body>
		<div class="error_log">
			<div class="Form_title"><h2>ErrorLog Data</h2></div>
				<table class="form-table" border="1">
						<thead>
							<th>TimeStamp</th>
							<th>InterfaceName</th>
							<th>XMLout</th>
							<th>Response</th>
							<th>Status</th>
							<th>Order Number</th>
						</thead>
						<tbody>
						<?php
						
						foreach($myrows as $rows) {
							$order_number = get_post_meta($rows->Order_ID,'order_number',true);
							?>
							<tr>
								<td><?php echo $rows->TimeStamp; ?></td>
								<td><?php echo $rows->InterfaceName; ?></td>
								<td class="no_padding"><textarea disabled><?php echo $rows->XMLout; ?></textarea></td>
								<td><?php echo $rows->Response; ?></td>
								<td><?php echo $rows->Status; ?></td>
								<td><?php echo $order_number; ?></td>
							</tr>
						<?php } ?>	
					    </tbody>	
				</table>	

				<?php $pageurl = admin_url('admin.php?page=errorlog_table'); 
				      $currentpage= $_GET['pagenum'];   ?>
				<p>Total Pages:- <?php echo $num_of_pages.'</p><p>'; 

				echo '<span>-<a href="'.$pageurl.'&pagenum=1">First</a>-';		
				if($pagenum >1) { echo '-<a href="'.$pageurl.'&pagenum='.($pagenum-1).'">Prev</a>-'; }     for($i=1;$i<=$num_of_pages;$i++) { if($i<6){echo '-<a href="'.$pageurl.'&pagenum='.$i.'">'.$i.'</a>-'; } else { if($currentpage == $num_of_pages) { } else { echo '-<a href="'.$pageurl.'&pagenum='.($pagenum+1).'">Next</a>-'; break;} } } 
				if($num_of_pages >1){
					echo '-<a href="'.$pageurl.'&pagenum='.$num_of_pages.'">Last</a>-</span>';
				}
				?></p>		
			
		</div>		
	</body>
</html>


	
	