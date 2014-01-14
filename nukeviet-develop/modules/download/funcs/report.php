<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3-6-2010 0:30
 */

if( ! defined( 'NV_IS_MOD_DOWNLOAD' ) ) die( 'Stop!!!' );

if( ! defined( 'NV_IS_AJAX' ) ) die( 'Wrong URL' );

$id = $nv_Request->get_int( 'id', 'post', 0 );

$dlrp = $nv_Request->get_string( 'dlrp', 'session', '' );

$dlrp = ! empty( $dlrp ) ? unserialize( $dlrp ) : array();

if( $id and ! in_array( $id, $dlrp ) )
{
	$dlrp[] = $id;
	$dlrp = serialize( $dlrp );
	$nv_Request->set_Session( 'dlrp', $dlrp );

	$query = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id;
	$id = $db->query( $query )->fetchColumn();
	if( $id )
	{
		$query = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_report VALUES (' . $id . ', ' . $db->quote( $client_info['ip'] ) . ', ' . NV_CURRENTTIME . ')';
		$db->query( $query );
	}
}

die( 'OK' );

?>