/*window.onload=consultaTickets;
window.onload=consultarRol;*/
$(document).ready(function(){
  consultaTickets();
  consultarRol();
});

/**
   * Método que consultar el tipo de rol
   * @author Andrey Sarria
   * @copyright Todos los derechos reservado 2020.
   * @version 1.0  
*/
 function consultarRol(){
    //cotizarProducto();
    var formdata = new FormData();
    formdata.append("command", "CRol");
    $.ajax({
        url: "php_class/FrontController.php",
        type:"POST",
        dataType: "json",
        data: formdata,
        enctype: "multipart/form-data",
        contentType:false,
        processData:false,
        success: function(rta){
            if (rta.tipo == 'exito') {
                var cadena='';
                var cadenaE='';
                var parsed = rta.data;
                cadena+="<label for='Req'>Tipo de Rol:</label> <select class='form-control' id='tipoRol'>";
                cadenaE+="<label for='Req'>Tipo de Rol:</label> <select class='form-control' id='tipoRole'>";
                cadena+="<option value=''>Seleccione Rol</option>";
                cadenaE+="<option value=''>Seleccione Rol</option>";
                for (var i=0; i<parsed.length; i++)
                {
                    cadena+="<option value='"+parsed[i]['idRol']+"'>"+parsed[i]['nombreRol']+"</option>";
                    cadenaE+="<option value='"+parsed[i]['idRol']+"'>"+parsed[i]['nombreRol']+"</option>";
                }
                 cadena+="</select>";
                 cadenaE+="</select>";
                $("#Slrol").html(cadena);
                $("#Slrole").html(cadenaE);

            }else{
                alert('No pudo registrar el producto')
            }
        }
    });    
 
  }


/**
   * Método que permite consultar Usuarios
   * @author Andrey Sarria
   * @copyright Todos los derechos reservado 2020.
   * @version 1.0  
*/

 function consultaTickets(){
    //cotizarProducto();
    var formdata = new FormData();
    formdata.append("command", "CUsuarios");
    $.ajax({
        url: "php_class/FrontController.php",
        type:"POST",
        dataType: "json",
        data: formdata,
        enctype: "multipart/form-data",
        contentType:false,
        processData:false,
        success: function(rta){
            console.log(rta.data);
            if (rta.tipo == 'exito') {
                var cadena='';
                var cadena1='';
                var parsed = rta.data;
                cadena+="<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>"+
                "<thead>"+
                    "<tr>"+
                        "<th>#</th>"+
                        "<th>nombre</th>"+
                        "<th>Rol</th>"+
                        "<th>Estado</th>"+
                        "<th>opciones</th>"+                                        
                    "</tr>"+
                "</thead>"+
                "<tfoot>"+
                    "<tr>"+
                        "<th>#</th>"+
                        "<th>nombre</th>"+
                        "<th>Rol</th>"+
                        "<th>Estado</th>"+
                        "<th>opciones</th>"+                                                                                  
                    "</tr>"+
                "</tfoot>"+
                "<tbody>";
                for (var i=0; i<parsed.length; i++)
                { 
                    cadena+="<tr>"+
                    "<td>"+parsed[i]['idUsuario']+"</td>"+ 
                    "<td>"+parsed[i]['nombreUsuario']+"</td>"+
                    "<td>"+parsed[i]['nombreRol']+"</td>"+
                    "<td>"+parsed[i]['status']+"</td>"+                
                    "<td><div class='btn-group'><button type='button' class='btn btn-success' data-toggle='modal' data-target='#myModal' onclick='editarUser(\""+parsed[i]['idUsuario']+"\",\""+parsed[i]['nombreUsuario']+"\",\""+parsed[i]['idRol']+"\",\""+parsed[i]['status']+"\");'>Editar</button><button type='button' class='btn btn-danger' onclick='eliminarUser(\""+parsed[i]['idUsuario']+"\");'>Eliminar</button></div></td>"+
                    "</tr>";

                    //cadena1+="<button type='button' onclick='ProductoView(\""+parsed[i]['idproductos']+"\",\""+parsed[i]['descripción']+"\",\""+parsed[i]['caracteristicas']+"\",\""+parsed[i]['fechaCreacion']+"\",\""+parsed[i]['valor']+"\");' data-toggle='modal' data-target='#myModal' class='list-group-item'><span class='badge'>$"+parsed[i]['valor']+"</span>"+parsed[i]['descripción']+"</button>";
                 
                }
                cadena+="</tbody>"+
                " </table>";
                $("#compraprod").html(cadena1);
                $("#datableproductos").html(cadena);
                $('#dataTable').DataTable();

                   



            } else {
                alert('No hay productos Creados');
            } 

        }
    });    
 
  }


/**
   * Método que permite guardar usuarios
   * @author Andrey Sarria
   * @copyright Todos los derechos reservado 2020.
   * @version 1.0  
*/
function saveUs(){
	var nombre = $('#Nombre').val();
	var tipoRol = $('#tipoRol').val();
    var estado = new Array();
    $('input[type=radio]:checked').each(function() {
        estado.push($(this).val());
        console.log($(this));
    });
    if (nombre == '') {
        alert('El nombre no puede estar vacío')
    }else if(tipoRol == '')  {
        alert('El  rol no puede estar vacío')
    }else if(estado == ''){
        alert('El  estado no puede estar vacío')
    }else{
        var formdata = new FormData();
        formdata.append("nombre", nombre);
        formdata.append("tipoRol", tipoRol);
        formdata.append("estado", estado);        
        formdata.append("command", "GetUsuarios");
        $.ajax({
    
            url: "php_class/FrontController.php",
            type:"POST",
            dataType: "json",
            data: formdata,
            enctype: "multipart/form-data",
            contentType:false,
            processData:false,
            success: function(rta){
                console.warn(rta);
                if (rta.tipo === 'exito') {
                    document.getElementById("Nombre").value = "";
                    document.getElementById("tipoRol").value = "";                   
                    alert(rta.mess)
                    consultaTickets();
                }else{
                    alert('No pudo registrar')
                }
                          
            }
        })
    }


}


/**
   * Método que permite eliminar usuarios
   * @author Andrey Sarria
   * @copyright Todos los derechos reservado 2020.
   * @version 1.0  
*/
function eliminarUser(usser){
	var formdata = new FormData();	
	formdata.append("usser", usser);
	formdata.append("command", "EUsuario");
	$.ajax({
        url: "php_class/FrontController.php",
        type:"POST",
        dataType: "json",
        data: formdata,
        enctype: "multipart/form-data",
        contentType:false,
        processData:false,
        success: function(rta){	
        	console.log(rta.mess);
        	alert(rta.mess); 
        	consultaTickets();       	
        }
    });
}
/**
   * Método que permite mostrar campos
   * @author Andrey Sarria
   * @copyright Todos los derechos reservado 2020.
   * @version 1.0  
*/
function editarUser(idUsuario, nombreUsuario, idRol, status) {
	//alert(idproductos);
	$("#Nombree").val(nombreUsuario);
	$("#tipoRole").val(idRol);
	$("#idusser").val(idUsuario);
}
/**
   * Método que permite actualizar usuarios productos
   * @author Andrey Sarria
   * @copyright Todos los derechos reservado 2020.
   * @version 1.0  
*/
function actualizarUsser() {
	var idusser = $('#idusser').val();
    var nombre = $('#Nombree').val();
    var tipoRol = $('#tipoRole').val();   
    var estados =$("input:radio[name=stre]:checked").val();
    
    if (nombre == '') {
        alert('El nombre no puede estar vacío')
    }else if(tipoRol == '')  {
        alert('El  rol no puede estar vacío')
    }else{
        var formdata = new FormData();
        formdata.append("idusser", idusser);
        formdata.append("nombre", nombre);
        formdata.append("tipoRol", tipoRol);
        formdata.append("estado", estados);        
        formdata.append("command", "SetUsuarios");
        $.ajax({
    
            url: "php_class/FrontController.php",
            type:"POST",
            dataType: "json",
            data: formdata,
            enctype: "multipart/form-data",
            contentType:false,
            processData:false,
            success: function(rta){
                console.warn(rta);
                if (rta.tipo === 'exito') {
                    document.getElementById("Nombre").value = "";
                    document.getElementById("tipoRol").value = "";                   
                    alert(rta.mess)
                    consultaTickets();
                }else{
                    alert('No pudo registrar')
                }
                          
            }
        })
    }
}