<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-9-2010 14:43
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$page_title = $lang_module['topics'];

$error = '';
$savecat = 0;

$array = array();
$array['topicid'] = 0;
$array['title'] = '';
$array['alias'] = '';
$array['image'] = '';
$array['description'] = '';
$array['keywords'] = '';

$savecat = $nv_Request->get_int( 'savecat', 'post', 0 );
if( ! empty( $savecat ) )
{
	$array['topicid'] = $nv_Request->get_int( 'topicid', 'post', 0 );
	$array['title'] = $nv_Request->get_title( 'title', 'post', '', 1 );
	$array['keywords'] = $nv_Request->get_title( 'keywords', 'post', '', 1 );
	$array['alias'] = $nv_Request->get_title( 'alias', 'post', '' );
	$array['description'] = $nv_Request->get_string( 'description', 'post', '' );

	$array['description'] = strip_tags( $array['description'] );
	$array['description'] = nv_nl2br( nv_htmlspecialchars( $array['description'] ), '<br />' );

	// Xu ly anh minh hoa
	$array['image'] = $nv_Request->get_title( 'homeimg', 'post', '' );
	if( ! nv_is_url( $array['image'] ) and file_exists( NV_DOCUMENT_ROOT . $array['image'] ) )
	{
		$lu = strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/topics/" );
		$array['image'] = substr( $array['image'], $lu );
	}
	else
	{
		$array['image'] = '';
	}

	$array['alias'] = ( $array['alias'] == '' ) ? change_alias( $array['title'] ) : change_alias( $array['alias'] );

	if( empty( $array['title'] ) )
	{
		$error = $lang_module['topics_error_title'];
	}
	elseif( $array['topicid'] == 0 )
	{
		$weight = $db->query( "SELECT max(weight) FROM " . NV_PREFIXLANG . "_" . $module_data . "_topics" )->fetchColumn();
		$weight = intval( $weight ) + 1;

		$_sql = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_topics (title, alias, description, image, weight, keywords, add_time, edit_time) VALUES (" . $db->quote( $array['title'] ) . ", " . $db->quote( $array['alias'] ) . ", " . $db->quote( $array['description'] ) . ", " . $db->quote( $array['image'] ) . ", " . $db->quote( $weight ) . ", " . $db->quote( $array['keywords'] ) . ", " . NV_CURRENTTIME . ", " . NV_CURRENTTIME . ")";

		if( $db->insert_id( $_sql, 'topicid' ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_add_topic', " ", $admin_info['userid'] );
			Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
			die();
		}
		else
		{
			$error = $lang_module['errorsave'];
		}
	}
	else
	{
		$sql = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_topics SET title=" . $db->quote( $array['title'] ) . ", alias = " . $db->quote( $array['alias'] ) . ", description=" . $db->quote( $array['description'] ) . ", image = " . $db->quote( $array['image'] ) . ", keywords= " . $db->quote( $array['keywords'] ) . ", edit_time=" . NV_CURRENTTIME . " WHERE topicid =" . $array['topicid'];
		if( $db->exec( $sql ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_edit_topic', "topicid " . $array['topicid'], $admin_info['userid'] );
			Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
			die();
		}
		else
		{
			$error = $lang_module['errorsave'];
		}
	}
}

$array['topicid'] = $nv_Request->get_int( 'topicid', 'get', 0 );
if( $array['topicid'] > 0 )
{
	list( $array['topicid'], $array['title'], $array['alias'], $array['image'], $array['description'], $array['keywords'] ) = $db->query( "SELECT topicid, title, alias, image, description, keywords FROM " . NV_PREFIXLANG . "_" . $module_data . "_topics where topicid=" . $array['topicid'] )->fetch( 3 );
	$lang_module['add_topic'] = $lang_module['edit_topic'];
}

if( is_file( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . "/" . $module_name . "/topics/" . $array['image'] ) )
{
	$array['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/topics/" . $array['image'];
}

$xtpl = new XTemplate( 'topics.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'UPLOADS_DIR', NV_UPLOADS_DIR . '/' . $module_name . '/topics' );
$xtpl->assign( 'DATA', $array );
$xtpl->assign( 'TOPIC_LIST', nv_show_topics_list() );

if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', $error );
	$xtpl->parse( 'main.error' );
}

if( empty( $array['alias'] ) )
{
	$xtpl->parse( 'main.getalias' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

?>