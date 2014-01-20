<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jan 2014 08:23:14 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );


$data = array();


$data['txtname'] = $nv_Request->get_title( 'txtname', 'post', '' ); 
$data['txtage'] = $nv_Request->get_title( 'txtage', 'post', '' );
$data['sex'] = $nv_Request->get_editor( 'sex', '', NV_ALLOWED_HTML_TAGS, 0);
$data['txtclassname'] = $nv_Request->get_title( 'txtclassname', 'post', '' );
$data['selecthobbies'] = $nv_Request->get_int( 'selecthobbies', 'post' );
$data['txtareadescription'] = $nv_Request->get_textarea( 'txtareadescription', '', NV_ALLOWED_HTML_TAGS );


if (!empty($data['txtname']))
{
	$row = $db->prepare('INSERT INTO nv4_vi_student (name, age, sex, classname, hobbies, description) VALUES (:txtname,:txtage,:sex,:txtclassname,:selecthobbies,:txtareadescription)');
	$row->bindParam(':txtname', $data['txtname'], PDO::PARAM_STR, 255);
	$row->bindParam(':txtage', $data['txtage'], PDO::PARAM_STR, 10);
	$row->bindParam(':sex', $data['sex'], PDO::PARAM_INT);
	$row->bindParam(':txtclassname', $data['txtclassname'], PDO::PARAM_STR, 255);
	$row->bindParam(':selecthobbies', $data['selecthobbies'], PDO::PARAM_INT);
	$row->bindParam(':txtareadescription', $data['txtareadescription'], PDO::PARAM_STR);
	$row->execute();
}

//print_r($data);
//die();



$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );



$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );




$page_title = $lang_module['config'];





include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

?>