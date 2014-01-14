<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 19 Mar 2011 16:50:45 GMT
 */

if ( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

define( 'NV_IS_MOD_NVTOOLS', true );

function nv_mkdir_nvtools ( $path, $dir_name, $index_file = 0, $htaccess = 0 )
{
    global $lang_global, $global_config, $sys_info;
    $dir_name = nv_string_to_filename( trim( basename( $dir_name ) ) );
    if ( ! preg_match( "/^[a-zA-Z0-9-_.]+$/", $dir_name ) ) return array(
        0, sprintf( $lang_global['error_create_directories_name_invalid'], $dir_name )
    );
    $path = @realpath( $path );
    if ( ! preg_match( '/\/$/', $path ) ) $path = $path . "/";

    if ( file_exists( $path . $dir_name ) ) return array(
        2, sprintf( $lang_global['error_create_directories_name_used'], $dir_name ), $path . $dir_name
    );

    if ( ! is_dir( $path ) ) return array(
        0, sprintf( $lang_global['error_directory_does_not_exist'], $path )
    );

    $ftp_check_login = 0;
    if ( $sys_info['ftp_support'] and intval( $global_config['ftp_check_login'] ) == 1 )
    {
        $ftp_server = nv_unhtmlspecialchars( $global_config['ftp_server'] );
        $ftp_port = intval( $global_config['ftp_port'] );
        $ftp_user_name = nv_unhtmlspecialchars( $global_config['ftp_user_name'] );
        $ftp_user_pass = nv_unhtmlspecialchars( $global_config['ftp_user_pass'] );
        $ftp_path = nv_unhtmlspecialchars( $global_config['ftp_path'] );
        // set up basic connection
        $conn_id = ftp_connect( $ftp_server, $ftp_port );
        // login with username and password
        $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
        if ( ( ! $conn_id ) || ( ! $login_result ) )
        {
            $ftp_check_login = 3;
        }
        elseif ( ftp_chdir( $conn_id, $ftp_path ) )
        {
            $ftp_check_login = 1;
        }
        else
        {
            $ftp_check_login = 2;
        }
    }
    if ( $ftp_check_login == 1 )
    {
        $dir = str_replace( NV_ROOTDIR . "/", "", str_replace( '\\', '/', $path . $dir_name ) );
        $res = ftp_mkdir( $conn_id, $dir );
        ftp_chmod( $conn_id, 0777, $dir );
        ftp_close( $conn_id );
    }
    if ( ! is_dir( $path . $dir_name ) )
    {
        if ( ! is_writable( $path ) )
        {
            @chmod( $path, 0777 );
        }
        if ( ! is_writable( $path ) ) return array(
            0, sprintf( $lang_global['error_directory_can_not_write'], $path )
        );

        $oldumask = umask( 0 );
        $res = @mkdir( $path . $dir_name );
        umask( $oldumask );
    }
    if ( ! $res ) return array(
        0, sprintf( $lang_global['error_create_directories_failed'], $dir_name )
    );
    if ( $index_file )
    {
        file_put_contents( $path . $dir_name . '/index.html', '' );
    }
    if ( $htaccess )
    {
        file_put_contents( $path . $dir_name . '/.htaccess', 'deny from all' );
    }
    return array(
        1, sprintf( $lang_global['directory_was_created'], $dir_name ), $path . $dir_name
    );
}

?>