<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" enctype="multipart/form-data">

	<table align="center" width="600">
		<tr>
			<td> Mã Chứng minh thư nhân dân</td>
			<td><input type="text" name="cmnd" value="{DATA.cmnd}"/> <span style="color: red">{error_cmnd}</span></td> 
		</tr>

		<tr>
			<td> Họ và tên</td>
			<td><input type="text" name="name" value="{DATA.name}"/> <span style="color: red">{error_name}</span></td>
		</tr>

		<tr>
			<td> Ngày sinh</td>
			<td> <input name="birthday" id="birthday" value="{DATA.birthday}" style="width: 90px;" maxlength="10" type="text" readonly="readonly"/><span style="color: red">{error_birthday}</span></td>	
		</tr>

		<tr>
			<td> Ảnh đại diện</td>
			<td> {avatar}
				<input type="file" name="avatar" /><span style="color: red">{error_avatar}</span></td>
		</tr>

		<tr>
			<td> Giới tính</td>

			<td><input type="radio" name="sex" value="1" {checkmale}/>Nam
			<br/>
			<input type="radio" name="sex" value="0" {checkfemale} />Nữ </td>
		</tr>

		<tr>
			<td> Quê quán </td>
			<td><input type="text" name="hometown" value="{DATA.hometown}"/> <span style="color: red">{error_hometown}</span></td>
		</tr>

		<tr>
			<td> Nguyên quán</td>
			<td><input type="text" name="origin" value="{DATA.origin}"/><span style="color: red">{error_origin}</span></td>
		</tr>

		<tr>
			<td> Nơi đăng ký hộ khẩu thường trú</td>
			<td><input type="text" name="place" value="{DATA.place}"/><span style="color: red">{error_place}</span></td>
		</tr>

		<tr>
			<td> Dân tộc</td>
			<td><input type="text" name="ethnic" value="{DATA.ethnic}"/><span style="color: red">{error_ethnic}</span></td>
		</tr>

		<tr>
			<td> Tôn giáo</td>
			<td><input type="text" name="religious" value="{DATA.religious}" /> <span style="color: red">{error_religious}</span></td>
		</tr>

		<tr>
			<td> Ngày cấp</td>
			<td><input type="text" name="date_of_issue" id="date_of_issue"  value="{DATA.date_of_issue}" style="width: 90px;" maxlength="10" type="text" readonly="readonly"/> <span style="color: red">{error_date_of_issue}</span></td>
		</tr>

		<tr>
			<td> Nơi cấp</td>
			<td><input type="text" name="where_licensing" value="{DATA.where_licensing}" /> <span style="color: red">{error_where_licensing}</span> </td>
		</tr>

		<tr>
			<td> Đặc điểm</td>
			<td><input type="text" name="characteristics" value="{DATA.characteristics}" /> <span style="color: red">{error_characteristics}</span> </td>
		</tr>	
	</table>
		<br/>
	<div style="text-align: center"><input name="submit" type="submit" value="{chkUpdate}" />
	</div>

</form>

<script type="text/javascript">
	$("#birthday, #date_of_issue").datepicker({
		showOn : "both",
		dateFormat : "dd/mm/yy",
		changeMonth : true,
		changeYear : true,
		showOtherMonths : true,
		buttonImage : nv_siteroot + "images/calendar.gif",
		buttonImageOnly : true
	});	
</script>



<!-- END: main -->



