/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jan 2014 08:23:14 GMT
 */


function nv_del_student (studentid)
{
	if (confirm('Do you want to delete this student ?')){
		alert('ok');
		nv_ajax('post', script_name, nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '= delete & id =' + studentid, '', 'nv_del_student_result');
	}
	else
	{
		alert('no');
	}
	
}

function  nv_del_student_result (res) {
  alert(res);
}