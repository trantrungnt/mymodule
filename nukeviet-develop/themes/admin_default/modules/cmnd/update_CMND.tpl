<!-- BEGIN: main -->
	<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
		<div style="text-align: center"><input name="submit" type="submit" value="Cập nhật" /></div>
		<div style="text-align: left"><input name="CMND_Code" type="hidden" value="{DATA.cmnd_code}" /></div>
		
		<table width="500">
			
			<tr>
				<td> Mã Chứng minh thư nhân dân</td>
				<td> <input type="text" name="code" value="{DATA.cmnd_code}"/> </td>				
			</tr> 
			
			<tr>
				<td> Họ và tên</td>
				<td> <input type="text" name="name" value="{DATA.name}"/></td>
			</tr>
			
			<tr>
				<td> Ngày sinh</td>
				<td> <input type="text" name="birthday" value="{DATA.birthday}"/></td>
			</tr>
			
			
			<tr>
				<td> Giới tính</td>
				
				<td> 	 
					<input type="radio" name="sex" value="{DATA.sex}"
					<!-- BEGIN: check_male -->
					checked="true"
					 <!-- END: check_male -->	
					>Nam
					<br/>					
					<input type="radio" name="sex" value="{DATA.sex}"
					<!-- BEGIN: check_female -->
					checked="false"
					 <!-- END: check_female -->
					>Nữ		
	 		 	</td>
			</tr>
			
			
			<tr>
				<td> Quê quán </td>
				<td> <input type="text" name="hometown" value="{DATA.hometown}"/></td>
			</tr>
			
			<tr>
				<td> Nguyên quán</td>
				<td> <input type="text" name="origin" value="{DATA.hometown}"/></td>
			</tr>
			
			<tr>
				<td> Nơi đăng ký hộ khẩu thường trú</td>
				<td> <input type="text" name="place" value="{DATA.place}"/></td>
			</tr>
			
			<tr>
				<td> Dân tộc</td>
				<td> <input type="text" name="ethnic" value="{DATA.ethnic}"/></td>
			</tr>
			
			<tr>
				<td> Tôn giáo</td>
				<td> <input type="text" name="religious" value="{DATA.religious}"/> </td>
			</tr>
			
			<tr>
				<td> Ngày cấp</td>
				<td><input type="text" name="date_of_issue" value="{DATA.date_of_issue}"/></td>
			</tr>
			
			<tr>
				<td> Nơi cấp</td>
				<td> <input type="text" name="where_licensing" value="{DATA.where_licensing}"/></td>
			</tr>
			
			<tr>
				<td> Đặc điểm</td>
				<td> <input type="text" name="characteristics" value="{DATA.characteristics}"/></td>
			</tr>
			
		</table>
	</form>
<!-- END: main -->
