<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 19 Feb 2014 15:19:31 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$module_version = array(
		'name' => 'Cmt',
		'modfuncs' => 'cmt-list,main',
		'submenu' => 'cmt-list,main',
		'is_sysmod' => 0,
		'virtual' => 1,
		'version' => '4.0.0',
		'date' => 'Wed, 19 Feb 2014 15:19:32 GMT',
		'author' => 'VINADES (contact@vinades.vn)',
		'uploads_dir' => array($module_name),
		'note' => 'Đây là Module quản lý Chứng minh thư nhân dân'
	);

?>