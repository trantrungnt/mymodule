<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 19 Feb 2014 15:19:31 GMT
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );

$submenu['cmt_update'] = $lang_module['cmt_update'];
$submenu['main'] = $lang_module['main'];

$allow_func = array( 'cmt_update', 'main');

define( 'NV_IS_FILE_ADMIN', true );

?>