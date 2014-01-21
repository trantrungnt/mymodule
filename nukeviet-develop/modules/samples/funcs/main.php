<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jan 2014 08:23:14 GMT
 */

 //declare request.class.php to use
require ( NV_ROOTDIR . "/includes/class/request.class.php" );
if ( ! defined( 'NV_IS_MOD_SAMPLES' ) ) die( 'Stop!!!' );


$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];


//process array_data
$array_data = array();


//query data in database 
$_sql = 'select * from nv4_vi_student';
$_query = $db->query($_sql);


while ($row = $_query->fetch())
{	
	$array_data[$row['id']] = array('id' => $row['id'] ,
									'name' => $row['name'] ,
									'age' => $row['age'] ,
									'sex' => $row['sex'] ,
									'classname' => $row['classname'] ,
									'hobbies' => $row['hobbies'] ,
									'description' => $row['description'] 								  
	);
	

}
	
//Display $array_data via $content
$contents = nv_theme_samples_main( $array_data );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';



?>