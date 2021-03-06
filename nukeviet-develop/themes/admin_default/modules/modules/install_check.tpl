<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="quote">
	<blockquote class="error">
		<p>
			<span>{ERROR}</span>
		</p></blockquote>
</div>
<!-- END: error -->
<!-- BEGIN: errorfile -->
<table class="tab1">
	<tbody>
		<tr>
			<td class="center"><strong style="color:red">{LANG.autoinstall_module_error_warning_fileexist}</strong></td>
		</tr>
		<!-- BEGIN: loop -->
		<tr>
			<td style="color:red">{FILENAME}</td>
		</tr>
		<!-- END: loop -->
	</tbody>
</table>
<!-- END: errorfile -->
<!-- BEGIN: errorfolder -->
<table class="tab1">
	<tbody>
		<tr>
			<td class="center"><strong style="color:red">{LANG.autoinstall_module_error_warning_invalidfolder}</strong></td>
		</tr>
		<!-- BEGIN: loop -->
		<tr>
			<td style="color:red">{FILENAME}</td>
		</tr>
		<!-- END: loop -->
	</tbody>
</table>
<!-- END: errorfolder -->
<!-- BEGIN: infoerror -->
<div id="checkmessage">
	<table class="tab1">
		<tbody>
			<tr>
				<td class="center"><strong style="color:red">{LANG.autoinstall_module_error_warning_overwrite}</strong></td>
			</tr>
			<tr>
				<td class="center"><input type="button" name="install_content_overwrite" value="{LANG.autoinstall_module_overwrite}"/></td>
			</tr>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	//<![CDATA[
	$(function() {
		$("input[name=install_content_overwrite]").click(function() {
			if (confirm("{LANG.autoinstall_module_error_warning_overwrite}")) {
				$("#checkmessage").html('<div style="text-align:center"><strong>{LANG.autoinstall_package_processing}</strong><br /><br /><img src="{NV_BASE_SITEURL}images/load_bar.gif" alt="" /></div>');
				$("#checkmessage").load("{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}={MODULE_NAME}&{NV_OP_VARIABLE}=install_check&overwrite={CHECKSESS}");
			}
		});
	});
	//]]>
</script>
<!-- END: infoerror -->
<!-- END: main -->

<!-- BEGIN: complete -->
<!-- BEGIN: no_extract -->
<table class="tab1">
	<tbody>
		<tr>
			<td class="center"><strong style="color:red">{LANG.autoinstall_module_cantunzip}</strong></td>
		</tr>
		<!-- BEGIN: loop -->
		<tr>
			<td style="color:red">{FILENAME}</td>
		</tr>
		<!-- END: loop -->
	</tbody>
</table>
<!-- END: no_extract -->
<!-- BEGIN: error_create_folder -->
<table class="tab1">
	<tbody>
		<tr>
			<td class="center"><strong style="color:red">{LANG.autoinstall_module_error_warning_permission_folder}</strong></td>
		</tr>
		<!-- BEGIN: loop -->
		<tr>
			<td style="color:red">{FILENAME}</td>
		</tr>
		<!-- END: loop -->
	</tbody>
</table>
<!-- END: error_create_folder -->
<!-- BEGIN: error_move_folder -->
<table class="tab1">
	<tbody>
		<tr>
			<td class="center"><strong style="color:red">{LANG.autoinstall_module_error_movefile}</strong></td>
		</tr>
		<!-- BEGIN: loop -->
		<tr>
			<td style="color:red">{FILENAME}</td>
		</tr>
		<!-- END: loop -->
	</tbody>
</table>
<!-- END: error_move_folder -->
<!-- BEGIN: ok -->
<table class="tab1">
	<tbody>
		<tr>
			<td class="center"><strong style="color:green">{LANG.autoinstall_module_unzip_success}</strong></td>
		</tr>
		<tr>
			<td class="center"><a href="{URL_GO}" title="{LANG.autoinstall_module_unzip_setuppage}">{LANG.autoinstall_module_unzip_setuppage}</a></td>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
	//<![CDATA[
	setTimeout("redirect_page()", 5000);
	function redirect_page() {
		parent.location = "{URL_GO}";
	}

	//]]>
</script>
<!-- END: ok -->
<!-- END: complete -->