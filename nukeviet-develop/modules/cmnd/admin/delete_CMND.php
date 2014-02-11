<?php

//Authentication of delete_CMND.php in ADMIN folder
if( ! defined( 'NV_IS_FILE_ADMIN' ) )
	die( 'Stop!!!' );


//if (!empty($delcmnd_code))
//{
	//get cmnd_code from delete_CMND.tpl and delete this row 
	$cmnd_code = $nv_Request->get_title('CMND_Code','get');
	$sql_delcmnd = "delete from ".$db_config['prefix'] . "_" . NV_LANG_DATA . "_" . $module_data." where CMND_Code = '".$cmnd_code."'";
	//var_dump($sql_delcmnd);
	//die();
	$db->query($sql_delcmnd);
	//$db->exec();
//}

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );



//Display cmnd list again
$sql_cmnd = "SELECT CMND_code , name , birthday , sex , hometown , origin , place , ethnic , religious , date_of_issue , where_licensing , characteristics FROM ".$db_config['prefix'] . "_" . NV_LANG_DATA . "_" . $module_data;
$_query = $db->query($sql_cmnd); 

while($row = $_query->fetch())
{	
	$xtpl->assign('DATA', $row);
	$xtpl->parse('main.loop');
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['main'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';



?>