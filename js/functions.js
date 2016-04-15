var datos_insert;
var roles_usuario;
var tipo_app;
var laboratorio;

$(document).ready(function()
{
	//sistemaOperativo();
	cargarRolesUsuario();
	cargarTipoAplicacion();
	cargarLaboratorio();

	setTimeout(function(){
		lectorUrl();		
	},500);

	$( ".btn_func" ).click(function() {
	  func = $(this).attr("id");
	  masterFunciones(func);
	});

	$( "#newUsuario" ).click(function() {
		if(valida_input())
		{
		  crear_nuevo_usuario();
		}
		else
		{
			alert('Error');
		}
	});

	$( "#newApp" ).click(function() {
		if(valida_input_app())
		{
		  crear_nuevo_app();
		}
		else
		{
			alert('Error');
		}
	});

});

	//lector de url con parametro
	function lectorUrl()
	{
		var url = window.location.href;
		action = url.split("?");
		if(action[1] != undefined)
		{
			lectorUrlAccion(action[1]);	
		}
	}

	function lectorUrlAccion(action)
	{
		var result = null;
		switch(action)
		{
			case 'error_login':
				result = 'Usuario y/o contraseña incorrecta.';
			break;

			case 'generateApp':
				result = '';
				$('#0001').click();
			break;

			case 'generateApp_error':
				result = 'Tipo de imagen o aplicativo erroneo.';
				$('#0001').click();
			break;
		}

		$('#result').text(result);
	}

	function cargarRolesUsuario()
	{
		$.ajax({
		  method: "POST",
		  dataType: 'json',
		  url: "Services/ServicesSelectRoll.php"
		})
		.done(function( data ) 
		{
			pintaDatosRolesUsuario(data);
		});
	}

	function cargarTipoAplicacion()
	{
		$.ajax({
		  method: "POST",
		  dataType: 'json',
		  url: "Services/selectAppType.php"
		})
		.done(function( data ) 
		{
			pintaDatosTipoAplicacion(data);
		});
	}

	function cargarLaboratorio()
	{
		$.ajax({
		  method: "POST",
		  dataType: 'json',
		  url: "Services/selectAppLaboratory.php"
		})
		.done(function( data ) 
		{
			pintaDatosLaboratorio(data);
		});
	}

function pintaDatosRolesUsuario(data)
{
	roles_usuario = data;
	for(i=0;i<roles_usuario.length;i++)
	{
		$('#newRoll').append('<option value="'+data[i].rolId+'">'+data[i].rolName+'</option>');
	}
}

function pintaDatosTipoAplicacion(data)
{
	tipo_app = data;
	for(i=0;i<tipo_app.length;i++)
	{
		$('#newType').append('<option value="'+data[i].typeId+'">'+data[i].typeName+'</option>');
	}
}

function pintaDatosLaboratorio(data)
{
	laboratorio = data;
	for(i=0;i<laboratorio.length;i++)
	{
		$('#newLaboratory').append('<option value="'+data[i].labId+'">'+data[i].labName+'</option>');
	}
}

function sistemaOperativo()
{
	var OSName="Unknown OS";
	if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
	if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
	if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
	if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";

	if (OSName != 'Linux')
	{
		$('#div_contenedor').css('display','none');
		$('#modal').css('display','block');
		$('#contenido-modal').html('Lo sentimos, <br> Su dispositivo no es compatible.');
	}
}

function cerrar_modal()
{
	$('#modal').css('display','none');
}

function validacionUsuarioLogin()
{
	var usuario = $( "#inp_usuario" ).val().toLowerCase().trim();
	var password = $( "#inp_password" ).val();
	if(password.length > 3 && usuario.length > 3)
	{
		descargarAplicacion(usuario,password);
	}
	else
	{
		$('#modal').css('display','block');
		$('#titulo-modal').text('Error.');
		$('#contenido-modal').text('Verifique los datos ingresados.');
		$('.inp_contenedor').val('');
	}
}

function descargarAplicacion(usuario,password)
{
	$.ajax({
	  method: "POST",
	  url: "php/Consult.php",
	  data: { data_usuario: usuario, data_password: password, action: 'searchUser'}
	})
	.done(function( msg ) 
	{
		if(msg.length == 0)
		{
			$('#modal').css('display','block');
			$('#contenido-modal').text('Usuario y/o contraseña invalida.');
			$('.inp_contenedor').val('');
		}
		else
		{
			$('#modal').css('display','block');
			$('#titulo-modal').html('<i>Instrucciones para instalar apk</i>');
			$('#contenido-modal').html('<ol type="1" style="padding-left:10px"><li>En el menú principal seleccione <b>Ajustes</b></li><li>Seleccione <b>Seguridad</b></li><li>Active la opción de <b>"ORIGENES DESCONOCIDOS"</b><li>Seleccione <b>Aceptar</b><li>Descargue la aplicación e instale en el dispositivo móvil</li></ol>');
			$('#resultado-modal').html('<a class="btn_contenedor" href="'+msg+'" donwload>descargar</a>');
		}
	});
}

function masterFunciones(func)
{
	$('#contenido_contenedor').css('display','none');
	func = parseInt(func);
	$('.tbody').css('display','none');
	switch (func)
	{
		case 1:
		$('#data_tbody_createApp').css('display','block').css('margin','0 auto');
		$.ajax({
		  method: "POST",
		  dataType: 'json',
		  url: "Services/ServicesSelectAllApp.php"
		})
		.done(function( data ) 
		{
			pintaDatosAplicacion(data);
			pintaDatosFormulario(1);
		});
		break;
		
		case 2:
		$('#data_tbody_createUser').css('display','block');
		$.ajax({
		  method: "POST",
		  dataType: 'json',
		  url: "Services/ServicesSelectAll.php"
		})
		.done(function( data ) 
		{
			pintaDatosUsuario(data);
			pintaDatosFormulario(2)
		});
		break;

		case 3:
		$('#data_tbody_createPermission').css('display','block');
		$('#bar_menu_action').text('Gestor de Permisos');
		break;
	}
}

function pintaDatosFormulario(action)
{
	switch(parseInt(action))
	{
		//caso aplicacion
		case 1:
			formulario = '<form action="Services/ServicesInsertApp.php" method="post" enctype="multipart/form-data"><input class="inLine-horizontal datas" type="text" id="newNameApp" name="newNameApp" placeholder="Nombre" required></input><input class="inLine-horizontal datas" type="text" id="newDescription" name="newDescription" placeholder="Descripción" required></input><input class="inLine-horizontal datas iFile" type="file" id="newImage" name="newImage" placeholder="Imagen" required></input><input class="inLine-horizontal datas iFile" type="file" id="newApk" name="newApk" placeholder="apk" required></input><select class="inLine-horizontal datas" id="newLaboratory" name="newLaboratory"></select><select class="inLine-horizontal datas" id="newType" name="newType"></select><button class="inLine-horizontal" type="submit" id="newApps">Crear App</button></form>';
		break;
		//caso usuario
		case 2:
			formulario = '<tr><td>Nombre</td><td>Correo Electrónico</td><td>Contraseña</td><td>Estado</td><td>Roll</td><td></td></tr><tr><td><input class="inLine-horizontal datas" type="text" id="newName" name="newName" placeholder="Nombre de Usuario" required></input></td><td><input class="inLine-horizontal datas" type="email" id="newMail" name="newMail" placeholder="Correo Electrónico" required></input></td><td><input class="inLine-horizontal datas" type="text" id="newPasword" name="newPasword" placeholder="Contraseña" required></input></td><td><select class="inLine-horizontal datas" type="text" id="newState" name="newState"><option value="0">Activo</option><option value="1">Inactivo</option></select></td><td><select class="inLine-horizontal datas" type="text" id="newRoll" name="newRoll"></select></td><td><button class="inLine-horizontal" type="submit" id="newUsuario">Crear Usuario</button></td></tr>';
		break;
		$('#table_form').text('ffff');
	}
}
function pintaDatosUsuario(data)
{
	$('#bar_menu_action').text('Gestor de Usuarios');
	table_head = '<tr>';
	table_head +='<th>Nombre</th>';
	table_head +='<th>Correo Electrónico</th>';
	table_head +='<th>Contraseña</th>';
	table_head +='<th>Estado</th>';
	table_head +='<th>Roll</th></tr>';
	$('#data_thead').html(table_head);
	table_body = '';


	for(i=0;i<data.length;i++)
	{

		table_body += '<tr id="row'+data[i].userId+'"><td><p class="class'+data[i].userId+'" id="name'+data[i].userId+'">'+data[i].userName+'</p></td>';
		table_body += '<td><p id="mail'+data[i].userId+'">'+data[i].userMail+'</p></td>';
		table_body += '<td><p class="class'+data[i].userId+'" id="password'+data[i].userId+'">'+data[i].userPassword+'</p></td>';

		if(data[i].userState == 0)
		{
			table_body += '<td><select class="iSelect'+data[i].userId+' class'+data[i].userId+'" id="state'+data[i].userId+'" disabled><option value="0">Activo</value><option value="1">Inactivo</value></select></td>';
		}
		else
		{
			table_body += '<td><select class="iSelect'+data[i].userId+' class'+data[i].userId+'" id="state'+data[i].userId+'" disabled><option value="1">Inactivo</value><option value="0">Activo</value></select></td>';	
		}
		table_body += '<td><select class="iSelect'+data[i].userId+' class'+data[i].userId+'" id="roll'+data[i].userId+'" disabled>'; 

		for(a=0;a<roles_usuario.length;a++)
		{
			if(roles_usuario[a].rolId == data[i].rollId)
			{
				table_body += '<option value="'+roles_usuario[a].rolId+'" selected>'+roles_usuario[a].rolName+'</option>';
			}
			else
			{
				table_body += '<option value="'+roles_usuario[a].rolId+'">'+roles_usuario[a].rolName+'</option>';
			}
		}
		table_body +='</select></td>';
		table_body += '<td class="element_edit" data-value="'+data[i].userId+'" id="edit'+data[i].userId+'" data-action="1"><img src="images/img_edit.png"></td>';
		table_body += '<td class="element_save" data-value="'+data[i].userId+'" id="save'+data[i].userId+'" data-action="1"><img src="images/img_save.png"></td></tr>';
		//table_body += '<td class="element_delete" data-value="'+data[i].userId+'" id="delete'+data[i].userId+'"><img src="images/img_delete.png"></td></tr>';
	}

	$('#data_tbody').html(table_body);

	ElementoEditar();
	ElementoGuardar();
	animacionContenidoContenedor();
}

function crear_nuevo_usuario()
{
	
	$.ajax({
	  method: "POST",
	  dataType: 'json',
	  url: "Services/ServicesInsert.php",
	  data: { uName: datos_insert[0], uMail : datos_insert[1], uPassword: datos_insert[2], uState: datos_insert[3], uRoll : datos_insert[4]}
	})
	.done(function( data ) 
	{
		limpia_datos();
		masterFunciones(2);
	});
}

function valida_input()
{
	name = $('#newName').val();
	email = $('#newMail').val();
	password = $('#newPasword').val();
	state = $('#newState').val();
	roll = $('#newRoll').val();
	var validate = true;
	datos_insert = [name,email,password,state,roll];

	for(i=0;i<datos_insert.length;i++)
	{
		if(datos_insert[i].length == 0 || datos_insert[i] == '')
		{
			validate = false;
		}
	}

	return validate;
}

function pintaDatosAplicacion(data)
{
	$('#bar_menu_action').text('Gestor de Aplicativos');
	table_head = '<tr>';
	table_head +='<th>Nombre</th>';
	table_head +='<th>Descripción</th>';
	table_head +='<th>Imagen</th>';
	table_head +='<th>Ruta</th>';
	table_head +='<th>Laboratorio</th>';
	table_head +='<th>Tipo App</th></tr>';
	$('#data_thead').html(table_head);
	table_body = '';


	for(i=0;i<data.length;i++)
	{
		table_body += '<tr id="row'+data[i].appId+'"><td><p class="class'+data[i].appId+'" id="name'+data[i].appId+'">'+data[i].appName+'</p></td>';
		table_body += '<td><p class="class'+data[i].appId+'" id="description'+data[i].appId+'">'+data[i].appDescription+'</p></td>';

		table_body += '<td><p class="class'+data[i].appId+'" id="image'+data[i].appId+'">'+data[i].appImage+'</p></td>';
		//table_body += '<td><input type="text" id="imageOld'+data[i].appId+' inLine-horizontal" value="'+data[i].appImage+'"></input>';
		//table_body += '<input type="file" class="class'+data[i].appId+' inLine-horizontal" id="image'+data[i].appId+'"></input></td>';

		table_body += '<td><p class="class'+data[i].appId+'" id="route'+data[i].appId+'">'+data[i].appRoute+'</p></td>';
		table_body += '<td><select class="iSelect'+data[i].appId+' class'+data[i].appId+'" id="laboratory'+data[i].appId+'" disabled>'; 
		for(a=0;a<laboratorio.length;a++)
		{
			if(laboratorio[a].labId == data[i].labId)
			{
				table_body += '<option value="'+laboratorio[a].labId+'" selected>'+laboratorio[a].labName+'</option>';
			}
			else
			{
				table_body += '<option value="'+laboratorio[a].labId+'">'+laboratorio[a].labName+'</option>';
			}
		}
		table_body +='</select></td>';
		table_body += '<td><select class="iSelect'+data[i].appId+' class'+data[i].appId+'" id="type'+data[i].appId+'" disabled>'; 
		for(b=0;b<tipo_app.length;b++)
		{
			if(tipo_app[b].typeId == data[i].typeId)
			{
				table_body += '<option value="'+tipo_app[b].typeId+'" selected>'+tipo_app[b].typeName+'</option>';
			}
			else
			{
				table_body += '<option value="'+tipo_app[b].typeId+'">'+tipo_app[b].typeName+'</option>';
			}
		}
		table_body +='</select></td>';
		table_body += '<td class="element_edit" data-value="'+data[i].appId+'" id="edit'+data[i].appId+'" data-action="2"><img src="images/img_edit.png"></td>';
		table_body += '<td class="element_save" data-value="'+data[i].appId+'" id="save'+data[i].appId+'" data-action="2"><img src="images/img_save.png"></td></tr>';
	}

	
	$('#data_tbody').html(table_body);

	ElementoEditar();
	ElementoGuardar();
	animacionContenidoContenedor();
}

function crear_nuevo_app()
{
	$.ajax({
	  method: "POST",
	  dataType: 'json',
	  url: "Services/ServicesInsertApp.php",
	  data: { name: datos_insert[0], description : datos_insert[1], image: datos_insert[2], route: datos_insert[3], laboratory : datos_insert[4], type: datos_insert[5]}
	})
	.done(function( data ) 
	{
		limpia_datos();
		masterFunciones(1);
	});
}

function guardarRegistroEditado(func,action)
{
	switch(parseInt(action))
	{
		case 1:
			name = $('#name'+func).text();
			email = $('#mail'+func).text();
			password = $('#password'+func).text();
			state = $('#state'+func).val();
			roll = $('#roll'+func).val();

			$.ajax({
			  method: "POST",
			  dataType: 'json',
			  url: "Services/ServicesEditUser.php",
			  data: { uName: name, uPassword: password, uMail: email, uState: state, uRoll : roll}
			})
			.done(function( data ) 
			{
				$('.class'+func).attr('contentEditable','false').css('border-bottom','none').css('outline','none');
				$('#edit'+func).css('visibility','visible');
				$('#save'+func).css('visibility','hidden');
				$('.iSelect'+func).attr('disabled',true);
			});
		break;

		case 2:
			id = func;
			name = $('#name'+func).text();
			description = $('#description'+func).text();
			image = $('#image'+func).text();
			route = name.replace(/ /g, "_");
			laboratory = $('#laboratory'+func).val();
			type = $('#type'+func).val();
			$.ajax({
			  method: "POST",
			  dataType: 'json',
			  url: "Services/ServicesEditApp.php",
			  data: {id:id, name: name, description: description, image: image, route: route, laboratory : laboratory, type : type}
			})
			.done(function( data ) 
			{
				$('.class'+func).attr('contentEditable','false').css('border-bottom','none').css('outline','none');
				$('#edit'+func).css('visibility','visible');
				$('#save'+func).css('visibility','hidden');
			});
		break;
	}

}

function valida_input_app()
{
	name = $('#newNameApp').val();
	description = $('#newDescription').val();
	image = $('#newImage').val();
	route = $('#newApk').val();
	laboratory = $('#newLaboratory').val();
	type = $('#newType').val();

	var validate = true;
	datos_insert = [name,description,image,route,laboratory,type];

	for(i=0;i<datos_insert.length;i++)
	{
		if(datos_insert[i].length == 0 || datos_insert[i] == '')
		{
			validate = false;
		}
	}

	return validate;
}

//FUNCIONES REUTILIZABLES
function ElementoEditar()
{
	$(".element_edit").click(function() 
	{
		func = $(this).data("value");
		editarRegistro(func);
	});
}

function editarRegistro(func)
{	
	$('#edit'+func).css('visibility','hidden');
	$('#save'+func).css('visibility','visible');
	$('.class'+func).attr('contentEditable','true').css('border-bottom','1px solid gray').css('outline','none');
	$('.iSelect'+func).removeAttr('disabled');
}

function ElementoGuardar()
{
	$( ".element_save" ).click(function() {
	  func = $(this).data("value");
	  action = $(this).data("action");
	  guardarRegistroEditado(func,action);
	});
}

function animacionContenidoContenedor()
{
	setTimeout(function(){
		$('#contenido_contenedor').slideDown(500);
	},100);
}

function limpia_datos()
{
	$('.datas').val('');
}