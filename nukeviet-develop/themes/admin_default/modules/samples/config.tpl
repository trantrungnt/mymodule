<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.css" rel="stylesheet" />

<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>


<!-- BEGIN: main -->
	<form action="{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}={MODULE_NAME}&{NV_OP_VARIABLE}={OP}" method="post">
	<table witdh = "500">
	 	<tr>
	 	 	<td>Họ và tên</td>
	 	 	<td><input type = "text" name = "txtname" /></td>
	 	</tr>
	 	
	 	<tr>
	 		<td>Tuổi</td> 	 
	 		<td><input type = "text" name ="txtage" /></td>
	 	</tr>
	 	
	 	<tr>
	 		<td>Ngày sinh</td> 	
	 		 <td> <input name="exp_date" id="exp_date" value="{DATA.exp_date}" style="width: 90px;" maxlength="10" readonly="readonly" type="text" />
	 	</tr>	 	
	 	
	 	<tr>
	 		<td>Giới tính</td> 	
	 		 <td> 
	 		 	<input type="radio" name="sex" value="1">Nam<br/>
	 		 	<input type="radio" name="sex" value="0">Nữ
	 		 </td>
	 	</tr>	 	
	 	
	 	<tr>
	 		<td>Lớp</td> 	
	 		 <td><input type ="text" name = "txtclassname"/></td>
	 	</tr>	 	
	 	
	 	<tr>
	 		<td>Sở thích</td>
	 		<td>
		 		<select name = "selecthobbies">
	  				<option value="1">Volvo</option>
	  				<option value="2">Saab</option>
	  				<option value="3">Mercedes</option>
	 				<option value="4">Audi</option>
				</select>
			</td> 
	 	</tr>
	 	
	 	<tr>
	 		<td>Mô tả về bản thân</td>
	 		<td><textarea name = "txtareadescription"></textarea></td>
	 	</tr>
	 	
	 </table>
	
		<div style="text-align: center"><input name="submit" type="submit" value="{LANG.save}" /></div>
	</form>
<!-- END: main -->

<script type="text/javascript">
	$(document).ready(function() {
	$("#exp_date").datepicker({
	showOn : "both",
	dateFormat : "dd/mm/yy",
	changeMonth : true,
	changeYear : true,
	showOtherMonths : true,
	buttonImage : nv_siteroot + "images/calendar.gif",
	buttonImageOnly : true
	});
	});
</script>



