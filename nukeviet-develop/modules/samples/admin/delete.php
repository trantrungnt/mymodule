<?php
 
 if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
 
 /*if ($nv_Request->get_int('id','POST', 0) > 0)
 {
 	die ('da xoa :D');
 }
 else {
     die('khong xoa duoc');
 }*/
 
 die('dien ah');
$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
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