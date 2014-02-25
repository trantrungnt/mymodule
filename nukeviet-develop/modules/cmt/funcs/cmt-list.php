<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 19 Feb 2014 15:19:31 GMT
 */

if ( ! defined( 'NV_IS_MOD_CMT' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$array_data = array();



$contents = nv_theme_cmt_cmt_list( $array_data );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

?>