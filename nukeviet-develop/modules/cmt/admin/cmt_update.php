<?php

/**
* @Project NUKEVIET 4.x
* @Author VINADES.,JSC (contact@vinades.vn)
* @Copyright (C) 2014 VINADES.,JSC. All rights reserved
* @License GNU/GPL version 2 or any later version
* @Createdate Sun, 26 Jan 2014 09:56:50 GMT
*/

//Authentication for main.php
if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

//get data from main.tpl to array
$data = array( );

$error_cmnd = '';
$error_name = '';
$error_name = '';
$error_birthday= '';
$error_avatar = '';
$error_hometown = '';
$error_origin = '';
$error_place = '';
$error_ethnic = '';
$error_religious = '';
$error_date_of_issue = '';
$error_where_licensing = '';
$error_characteristics = '';

// Kiểm tra dữ liệu khi submit
if( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$data['cmnd'] = $nv_Request->get_title( 'cmnd', 'post', '' );
	$data['name'] = $nv_Request->get_title( 'name', 'post', '' );
	$data['birthday'] = $nv_Request->get_title( 'birthday', 'post', '' );
	$data['sex'] = $nv_Request->get_int( 'sex', 'post' );
	$data['hometown'] = $nv_Request->get_title( 'hometown', 'post', '' );
	$data['origin'] = $nv_Request->get_title( 'origin', 'post', '' );
	$data['place'] = $nv_Request->get_title( 'place', 'post', '' );
	$data['ethnic'] = $nv_Request->get_title( 'ethnic', 'post', '' );
	$data['religious'] = $nv_Request->get_title( 'religious', 'post', '' );
	$data['date_of_issue'] = $nv_Request->get_title( 'date_of_issue', 'post', '' );
	$data['where_licensing'] = $nv_Request->get_title( 'where_licensing', 'post', '' );
	$data['characteristics'] = $nv_Request->get_title( 'characteristics', 'post', '' );
	$data['thumb'] = 'aaa';
	if( empty( $data['cmnd'] ) )
	{
		$error_cmnd = 'Bạn chưa nhập cmnd';
	}
	elseif( empty( $data['name'] ) )
	{
		$error_name = 'Bạn chưa nhập name';
	}
	else
	{
		//upload file avatar
		if( isset( $_FILES['avatar'] ) and is_uploaded_file( $_FILES['avatar']['tmp_name'] ) )
		{
			var_dump('ok');
			die();
			
			@require_once (NV_ROOTDIR . "/includes/class/upload.class.php");

			$upload = new upload( array( 'images' ), $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT );
			$upload_info = $upload->save_file( $_FILES['avatar'], NV_UPLOADS_REAL_DIR . '/' . $module_name . "/images", false );

			@unlink( $_FILES['avatar']['tmp_name'] );
			if( empty( $upload_info['error'] ) )
			{
				@chmod( $upload_info['name'], 0644 );

				$image = $upload_info['name'];
				$basename = $basename_file = $upload_info['basename'];

				$imginfo = nv_is_image( $image );

				$weight = 150;
				$height = 150;

				$basename = preg_replace( '/(.*)(\.[a-zA-Z]+)$/', '\1-' . $weight . '-' . $height . '\2', $basename );

				@require_once (NV_ROOTDIR . "/includes/class/image.class.php");

				$_image = new image( $image, $weight, $height );
				$_image->resizeXY( $weight, $height );
				$_image->save( NV_UPLOADS_REAL_DIR . '/' . $module_name . "/thumb", $basename );

				if( file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_name . '/thumb/' . $basename ) )
				{
					$imgthumb = NV_UPLOADS_REAL_DIR . '/' . $module_name . '/thumb/' . $basename;

					$imgthumb = str_replace( NV_ROOTDIR . "/" . NV_UPLOADS_DIR . "/", "", $imgthumb );

				}

			}
			else
			{
				//$error = $lang_module['upload_error'];
				$error = 'upload is error';
			}
		}

		try
		{
			$sql = "INSERT INTO " . $db_config['prefix'] . "_" . NV_LANG_DATA . "_" . $module_data . " (cmnd, name, birthday, sex, image, thumb, hometown, origin, place, ethnic, religious, date_of_issue, where_licensing, characteristics) VALUES (:cmnd, :name, :birthday, :sex, :image, :thumb, :hometown, :origin, :place, :ethnic, :religious, :date_of_issue, :where_licensing, :characteristics)";
			$imgthumb = 'abc';
			$row = $db->prepare( $sql );
			$data['image'] = $module_data . "/images/" . $basename_file;
			$data['thumb'] = $imgthumb;

			$row->bindParam( ':cmnd', $data['cmnd'], PDO::PARAM_STR, 255 );
			$row->bindParam( ':name', $data['name'], PDO::PARAM_STR, 255 );
			$row->bindParam( ':birthday', $data['birthday'], PDO::PARAM_STR );
			$row->bindParam( ':sex', $data['sex'], PDO::PARAM_INT );
			$row->bindParam( ':image', $data['image'], PDO::PARAM_STR, 255 );
			$row->bindParam( ':thumb', $data['thumb'], PDO::PARAM_STR, 255 );
			$row->bindParam( ':hometown', $data['hometown'], PDO::PARAM_STR, 255 );
			$row->bindParam( ':origin', $data['origin'], PDO::PARAM_STR, 255 );
			$row->bindParam( ':place', $data['place'], PDO::PARAM_STR, 255 );
			$row->bindParam( ':ethnic', $data['ethnic'], PDO::PARAM_STR, 255 );
			$row->bindParam( ':religious', $data['religious'], PDO::PARAM_STR, 255 );
			$row->bindParam( ':date_of_issue', $data['date_of_issue'], PDO::PARAM_STR );
			$row->bindParam( ':where_licensing', $data['where_licensing'], PDO::PARAM_STR, 255 );
			$row->bindParam( ':characteristics', $data['characteristics'], PDO::PARAM_STR, 255 );

			$row->execute( );
			$rowCount = $row->rowCount( );
			if( $rowCount )
			{
				Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=CMND' );
				die();
			}

			

		}
		catch(PDOException $e)
		{
			print_r( $e );
			die( );
		}

	}
}

//$_sql = "select cmnd from " . $db_config['prefix'] . "_" . NV_LANG_DATA . "_" . $module_data;
//$_query = $db->query( $_sql );
//$rows = $_query->fetch( );

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'error_cmnd', $error_cmnd);
$xtpl->assign( 'error_name', $error_name);
$xtpl->assign( 'error_birthday', $error_birthday);
$xtpl->assign( 'error_avatar', $error_avatar);
$xtpl->assign( 'error_hometown', $error_hometown);
$xtpl->assign( 'error_origin', $error_origin);
$xtpl->assign( 'error_place', $error_place);
$xtpl->assign( 'error_ethnic', $error_ethnic);
$xtpl->assign( 'error_religious', $error_religious);
$xtpl->assign( 'error_date_of_issue', $error_date_of_issue);
$xtpl->assign( 'error_where_licensing', $error_where_licensing);
$xtpl->assign( 'error_characteristics', $error_characteristics);


$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL ); ///mymodule/nukeviet-develop/
$xtpl->assign( 'NV_LANG_INTERFACE', NV_LANG_INTERFACE ); //vi

$xtpl->assign( 'DATA', $data );

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['main'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
?>