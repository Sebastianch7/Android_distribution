var datos_insert;
var roles_usuario;

$(document).ready(function()
{
	//sistemaOperativo();
	carga_roles();
	$( ".btn_func" ).click(function() {
	  func = $(this).attr("id");
	  master_functions(func);
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

});
	function carga_roles()
	{
		$.ajax({
		  method: "POST",
		  dataType: 'json',
		  url: "Services/ServicesSelectRoll.php"
		})
		.done(function( data ) 
		{
			crear_roles(data);
		});
	}

function crear_roles(data)
{
	roles_usuario = data;
	for(i=0;i<roles_usuario.length;i++)
	{
		$('#newRoll').append('<option value="'+data[i].rolId+'">'+data[i].rolName+'</option>');
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

function validacion()
{
	var usuario = $( "#inp_usuario" ).val().toLowerCase().trim();
	var password = $( "#inp_password" ).val();
	if(password.length > 3 && usuario.length > 3)
	{
		descargar(usuario,password);
	}
	else
	{
		$('#modal').css('display','block');
		$('#titulo-modal').text('Error.');
		$('#contenido-modal').text('Verifique los datos ingresados.');
		$('.inp_contenedor').val('');
	}
}

function descargar(usuario,password)
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

function master_functions(func)
{
	func = parseInt(func);

	switch (func)
	{
		case 1:
		$('#barra_menu_action').text('Gestor de Aplicaciones');
		break;
		
		case 2:
		$.ajax({
		  method: "POST",
		  dataType: 'json',
		  url: "Services/ServicesSelectAll.php"
		})
		.done(function( data ) 
		{
			pinta_datos_usuario(data);
		});
		break;

		case 3:
		$('#barra_menu_action').text('Gestor de Permisos');
		break;
	}
}

function pinta_datos_usuario(data)
{
	$('#barra_menu_action').text('Gestor de Usuarios');
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
			table_body += '<td><select class="class'+data[i].userId+'" id="state'+data[i].userId+'"><option value="0">Activo</value><option value="1">Inactivo</value></select></td>';
		}
		else
		{
			table_body += '<td><select class="class'+data[i].userId+'" id="state'+data[i].userId+'"><option value="1">Inactivo</value><option value="0">Activo</value></select></td>';	
		}
		table_body += '<td><select class="class'+data[i].userId+'" id="roll'+data[i].userId+'">'; 

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
		table_body += '<td class="element_edit" data-value="'+data[i].userId+'" id="edit'+data[i].userId+'"><img src="images/img_edit.png"></td>';
		table_body += '<td class="element_save" data-value="'+data[i].userId+'" id="save'+data[i].userId+'"><img src="images/img_save.png"></td></tr>';
		//table_body += '<td class="element_delete" data-value="'+data[i].userId+'" id="delete'+data[i].userId+'"><img src="images/img_delete.png"></td></tr>';
	}


	$('#data_tbody').html(table_body);

	$( ".element_edit" ).click(function() {
	  func = $(this).data("value");
	  editar_registro(func);
	});

	$( ".element_save" ).click(function() {
	  func = $(this).data("value");
	  guardar_registro(func);
	});

	$( ".element_delete" ).click(function() {
	  func = $(this).data("value");
	  eliminar_registro(func);
	});
}

function editar_registro(func)
{
	var cont = $('.class'+func).length;
	$('#edit'+func).css('visibility','hidden');
	$('#save'+func).css('visibility','visible');
	$('.class'+func).attr('contentEditable','true').css('border-bottom','1px solid gray').css('outline','none');

}


function guardar_registro(func)
{
	name = $('#name'+func).text();
	email = $('#mail'+func).text();
	password = $('#password'+func).text();
	state = $('#state'+func).val();
	roll = $('#roll'+func).val();

	console.log(name+'-'+email+'-'+password+'-'+state+'-'+roll);

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
	});

}

function crear_nuevo_usuario()
{
	
alert("SI");
	$.ajax({
	  method: "POST",
	  dataType: 'json',
	  url: "Services/ServicesInsert.php",
	  data: { uName: datos_insert[0], uMail : datos_insert[1], uPassword: datos_insert[2], uState: datos_insert[3], uRoll : datos_insert[4]}
	})
	.done(function( data ) 
	{
		master_functions(2);
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

