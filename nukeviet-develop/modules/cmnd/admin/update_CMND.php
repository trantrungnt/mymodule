<?php
//authentication of file update_CMND.php in ADMIN folder
if( ! defined( 'NV_IS_FILE_ADMIN' ) )
	die( 'Stop!!!' );


$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );


//get CMND_Code from CMND.tpl 
$cmnd_code = $nv_Request->get_title('CMND_Code','get');

//query by CMND_Code and Display in update_CMND.tpl
$_sql = "SELECT CMND_Code, name, birthday, sex, hometown, origin, place, ethnic, religious, date_of_issue, where_licensing, characteristics FROM nv4_vi_cmnd WHERE CMND_Code='".$cmnd_code."'";
//fill data to update_CMND.tpl
$_query = $db->query($_sql);
$rows = $_query->fetch();

	/*if($rows['sex'] == 1)
	{
		$xtpl->parse('main.check_male');				
	}else
		{
			$xtpl->parse('main.check_female');
		}*/
	
	//check sex
switch ($rows['sex']) 
{
	case '0':
		$xtpl->parse('main.check_female');
		break;
		
	default:
		$xtpl->parse('main.check_male');
		break;
}	
		
//fill data to update_CMND.tpl
$xtpl->assign('DATA', $rows);	


//start to update CMND
//get data from update_CMND
//$data = array();

//why i can not get data from update.tpl via textbox?
$data1 = $nv_Request->get_title('CMND_Code','post','');
var_dump($data1);
die();



/*$data['name'] = $nv_Request->get_title('name','post', '');
$data['birthday'] = $nv_Request->get_title('birthday','post', '');
$data['sex'] = $nv_Request->get_int('sex', 'post');
$data['hometown'] = $nv_Request->get_title('hometown','post', '');
$data['origin'] = $nv_Request->get_title('origin','post', '');
$data['place'] = $nv_Request->get_title('place','post', '');
$data['ethnic'] = $nv_Request->get_title('ethnic','post', '');
$data['religious'] = $nv_Request->get_title('religious','post', '');
$data['date_of_issue'] = $nv_Request->get_title('date_of_issue','post', '');
$data['where_licensing'] = $nv_Request->get_title('where_licensing','post', '');
$data['characteristics'] = $nv_Request->get_title('characteristics','post', '');*/


//execute to update CMND
try{
	//$data = array();

/*$data['CMND_Code'] = $nv_Request->get_title('CMND','post', '');
$data['name'] = $nv_Request->get_title('name','post', '');
$data['birthday'] = $nv_Request->get_title('birthday','post', '');
$data['sex'] = $nv_Request->get_int('sex', 'post');
$data['hometown'] = $nv_Request->get_title('hometown','post', '');
$data['origin'] = $nv_Request->get_title('origin','post', '');
$data['place'] = $nv_Request->get_title('place','post', '');
$data['ethnic'] = $nv_Request->get_title('ethnic','post', '');
$data['religious'] = $nv_Request->get_title('religious','post', '');
$data['date_of_issue'] = $nv_Request->get_title('date_of_issue','post', '');
$data['where_licensing'] = $nv_Request->get_title('where_licensing','post', '');
$data['characteristics'] = $nv_Request->get_title('characteristics','post', '');*/
	
	//$sql = "UPDATE nv4_vi_cmnd SET CMND_Code=:CMND_Code, name=:name, birthday=:birthday, sex=:sex, hometown=:hometown, origin=:origin, place=:place, ethnic=:ethnic, religious=:religious, date_of_issue=:date_of_issue, where_licensing=:where_licensing, characteristics=:characteristics WHERE CMND_Code = '".$cmnd_code."'";
	
	
	//$query = $db->prepare($sql);
	//$row = $query->fetch();
	
	/*$row->bindParam(':CMND_Code', $data['CMND_Code'], PDO::PARAM_STR, 255);
	$row->bindParam(':name', $data['name'], PDO::PARAM_STR, 255);
	$row->bindParam(':birthday', $birthday, PDO::PARAM_STR);
	$row->bindParam(':sex', $data['sex'], PDO::PARAM_INT);
	$row->bindParam(':hometown', $data['hometown'] , PDO::PARAM_STR, 255);
	$row->bindParam(':origin', $data['origin'], PDO::PARAM_STR, 255);
	$row->bindParam(':place', $data['place'], PDO::PARAM_STR, 255);
	$row->bindParam(':ethnic',$data['ethnic'], PDO::PARAM_STR, 255);
	$row->bindParam(':religious', $data['religious'], PDO::PARAM_STR, 255);
	$row->bindParam(':date_of_issue', $data['date_of_issue'], PDO::PARAM_STR);
	$row->bindParam(':where_licensing', $data['where_licensing'], PDO::PARAM_STR, 255);
	$row->bindParam(':characteristics', $data['characteristics'], PDO::PARAM_STR, 255); */ 
					
	//$row->execute();
	
}
catch(PDOException $e)
{
	var_dump($data);
	die();
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['main'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

?>