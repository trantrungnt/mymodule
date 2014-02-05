<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 26 Jan 2014 09:56:50 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$data = array();

$data['CMND_Code'] = $nv_Request->get_title('CMND','post', '');
$data['name'] = $nv_Request->get_title('name','post', '');
$data['birthday'] = $nv_Request->get_title('birthday','post', '');
$data['sex'] = $nv_Request->get_int('sex', 'post');
$data['hometown'] = $nv_Request->get_title('hometown','post', '');
$data['origin'] = $nv_Request->get_title('origin','post', '');
$data['place'] = $nv_Request->get_title('place','post', '');
$data['ethnic'] = $nv_Request->get_title('ethnic','post', '');
$data['religious'] = $nv_Request->get_title('religious','post', '');
$data['date_of_issue'] = $nv_Request->get_title('date_of_issue','post', '');
$data['where_licensing'] = $nv_Request->get_title('where_licensing','post', '');
$data['characteristics'] = $nv_Request->get_title('characteristics','post', '');




if (!empty($data['CMND_Code']) OR !empty($data['name']) 
	OR !empty($data['birthday']) OR !empty($data['sex']) 
	OR !empty($data['hometown']) OR !empty($data['origin']) 
	OR !empty($data['place']) OR !empty($data['ethnic'])
	OR !empty($data['religious']) OR !empty($data['date_of_issue'])
	OR !empty($data['where_licensing']) OR !empty($data['characteristics']))
{	
	try{
		$sql = 'INSERT INTO nv4_vi_cmnd (CMND_Code, name, birthday, sex, hometown, origin, place, ethnic, religious, date_of_issue, where_licensing, characteristics) VALUES (:CMND_Code, :name, :birthday, :sex, :hometown, :origin, :place, :ethnic, :religious, :date_of_issue, :where_licensing, :characteristics)';
		
		$row = $db->prepare($sql);
		//var_dump($data);
		//die();
		
	    $row->bindParam(':CMND_Code', $data['CMND_Code'], PDO::PARAM_STR, 255);
		$row->bindParam(':name', $data['name'], PDO::PARAM_STR, 255);
		$row->bindParam(':birthday', $data['birthday'], PDO::PARAM_STR);
		$row->bindParam(':sex', $data['sex'], PDO::PARAM_INT);
		$row->bindParam(':hometown', $data['hometown'], PDO::PARAM_STR, 255);
		$row->bindParam(':origin', $data['origin'], PDO::PARAM_STR, 255);
		$row->bindParam(':place', $data['place'], PDO::PARAM_STR, 255);
		$row->bindParam(':ethnic', $data['ethnic'], PDO::PARAM_STR, 255);
		$row->bindParam(':religious', $data['religious'], PDO::PARAM_STR, 255);
		$row->bindParam(':date_of_issue', $data['date_of_issue'], PDO::PARAM_STR);
		$row->bindParam(':where_licensing', $data['where_licensing'], PDO::PARAM_STR, 255);
		$row->bindParam(':characteristics', $data['characteristics'], PDO::PARAM_STR, 255); 
			
		$row->execute();    
		  
	}catch(PDOException $e){
		print_r($e);
		die();
	}
}

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );



$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['main'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

?>