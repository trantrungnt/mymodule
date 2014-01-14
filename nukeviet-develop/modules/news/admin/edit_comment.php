<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-9-2010 14:43
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$page_title = $lang_module['comment_edit_title'];
$cid = $nv_Request->get_int( 'cid', 'get' );

if( $nv_Request->isset_request( 'submit', 'post' ) )
{
	nv_insert_logs( NV_LANG_DATA, $module_name, 'log_edit_comment', 'id ' . $cid, $admin_info['userid'] );
	$sql = 'SELECT a.id, a.title, a.listcatid, a.alias FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows a INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_comments b ON a.id=b.id WHERE b.cid=' . $cid;

	list( $id, $title, $listcatid, $alias ) = $db->query( $sql )->fetch( 3 );
	if( $id > 0 )
	{
		$delete = $nv_Request->get_int( 'delete', 'post', 0 );
		if( $delete )
		{
			$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_comments WHERE cid=' . $cid );
		}
		else
		{
			$content = $nv_Request->get_textarea( 'content', '', NV_ALLOWED_HTML_TAGS, 1 );
			$active = $nv_Request->get_int( 'active', 'post', 0 );
			$status = ( $status == 1 ) ? 1 : 0;
			$db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_comments SET content=' . $db->quote( $content ) . ', status=' . $active . ' WHERE cid=' . $cid );
		}

		// Cap nhat lai so luong comment duoc kich hoat
		$array_catid = explode( ',', $listcatid );
		$numf = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_comments where id= ' . $id . ' AND status=1' )->fetchColumn();
		$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_rows SET hitscm=' . $numf . ' WHERE id=' . $id;
		$db->query( $query );
		foreach( $array_catid as $catid_i )
		{
			$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_' . $catid_i . ' SET hitscm=' . $numf . ' WHERE id=' . $id;
			$db->query( $query );
		}
		// Het Cap nhat lai so luong comment duoc kich hoat
	}
	header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=comment' );
	die();
}

$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_comments WHERE cid=' . $cid;
$row = $db->query( $sql )->fetch();

if( empty( $row ) )
{
	header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=comment' );
	die();
}

$row['content'] = nv_htmlspecialchars( nv_br2nl( $row['content'] ) );

$row['status'] = ( $row['status'] ) ? 'checked="checked"' : '';

$xtpl = new XTemplate( 'comment_edit.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'CID', $cid );
$xtpl->assign( 'ROW', $row );

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

?>