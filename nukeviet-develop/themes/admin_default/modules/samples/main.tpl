<!-- BEGIN: main -->
	 		<table class="tab1">
	 			<tr>
	 				<td><input type="checkbox" name="idcheck"></input></td>
	 				<td>id</td>
	 				<td>name</td>
	 				<td>age</td>
	 				<td>sex</td>
	 				<td>classname</td>
	 				<td>hobbies</td>
	 				<td>description</td>
	 				<td></td>	 							
	 			</tr>

				 <!-- BEGIN: loop -->			
	 			<tr>
	 				<td><input type="checkbox" name="idcheck"></input></td>
	 				<td>{DATA.id}</td>
	 				<td>{DATA.name}</td>
	 				<td>{DATA.age}</td>
	 				<td>{DATA.sex}</td>
	 				<td>{DATA.classname}</td>
	 				<td>{DATA.hobbies}</td>
	 				<td>{DATA.description}</td>	
	 				<td class="center">   
	 					<i class = "icon-edit icon-large "></i>
	 					<a href="#">Edit</a>
	 					--
	 					<i class="icon-trash icon-large"></i>
	 					<a onclick="nv_del_student({DATA.id})">Delete</a>
	 					
	 				</td>			
	 			</tr>
	 			<!-- END: loop -->
	 		</table>	
<!-- END: main -->



