<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 26 Jan 2014 09:56:50 GMT
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );


$submenu['main'] = 'Danh sách Chứng minh nhân dân' ;
$submenu['CMND'] = 'Chứng minh nhân dân';

//$submenu['config'] = $lang_module['config'];


$allow_func = array('CMND' , 'main', 'config', 'update_CMND', 'delete_CMND');

define( 'NV_IS_FILE_ADMIN', true );

?>