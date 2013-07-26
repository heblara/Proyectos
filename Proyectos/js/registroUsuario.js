$(document).ready(function(){
    $('#id_btn_buscar_empleado').click(function(){
        var $id_sel_buscar_empleado     =       $('#id_sel_buscar_empleado').val();
        var $id_txt_texto_empleado      =       $('#id_txt_texto_empleado').val();
        $('#id_div_form__registrar').hide();  
        $('#id_result_busqueda_usuario').html('<img src="images/ajax-loader.gif">');
        if($id_sel_buscar_empleado!="" && $id_txt_texto_empleado!=""){
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroUsuario.ctrl.php?accion=1',
                data            :   $('#id_form_buscar_usuario').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_usuarios" class="ui-widget ui-widget-content" width="90%">';
                            table+='<thead>';
                            table+='<tr class="ui-widget-header ">';
                            table+='<th width="5%">#</th>';
                            table+='<th style="display:none">id</th>';
                            table+='<th style="display:none">idPrivilegio</th>';
                            table+='<th style="display:none">estado</th>';
                            table+='<th width="30%">Nombre</th>';
                            table+='<th width="10%">DUI</th>';
                            table+='<th width="10%">NIT</th>';                        
                            table+='<th width="10%">Privilegio</th>';
                            table+='<th width="10%">Nick</th>';
                            table+='<th width="10%">Estado</th>';
                            table+='<th width="15%">OPCIONES</th>';
                            table+='</tr>';
                            table+='</thead>';
                            table+='<tbody>';
                            var $nick;
                            var $labelPrivilegio;
                            var $estado;
                            $.each(data.rows, function(index,value){
                                table+='<tr>';
                                table+='<td>'+(index+1)+'</td>';
                                table+='<td style="display:none">'+value.id+'</td>';
                                table+='<td style="display:none">'+value.idPrivilegio+'</td>';
                                table+='<td style="display:none">'+value.estado+'</td>';
                                table+='<td>'+value.nombre+'</td>';
                                table+='<td>'+value.dui+'</td>';
                                table+='<td>'+value.nit+'</td>';  
                                
                                if(value.labelPrivilegio==null || value.labelPrivilegio==""){
                                    $labelPrivilegio='Sin usuario';
                                }else{
                                    $labelPrivilegio=value.labelPrivilegio;
                                }
                                
                                table+='<td>'+$labelPrivilegio+'</td>';    
                                
                                if(value.nick==null || value.nick==""){
                                    $nick='Sin usuario';                                
                                }else{
                                    $nick=value.nick;
                                }
                                table+='<td>'+$nick+'</td>';    
                                
                                if(value.estado=='0'){
                                    $estado='Inactivo';
                                }else if(value.estado=='1'){
                                    $estado='Activo';
                                }else{
                                    $estado='Sin usuario';
                                }
                                table+='<td>'+$estado+'</td>';
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_usuario').html(table);
                            $("#id_table_usuarios tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_usuarios tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_usuario').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert(data.mensaje,130,200);
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_usuario').html('');
            $alert('Debe de llenar todos los campos de busqueda',130,200);
        }
    });
    
      
    
    var $alert=function(mensaje,height,width){
        $('#dialog').html('<p>'+mensaje+'</p>');
        $( "#dialog" ).dialog({
            title       : "Error",                
            height      : height,
            draggable   : false,
            width       : width,
            modal       : true,              
            resizable   : false,
            show        :'scale',
            hide        :'explode',
            buttons: [
            {
                text: "OK",
                click: function() {
                    $( this ).dialog( "close" );
                }
            }
            ]
        });
    }
});

var show_information=function(row){
    var id=$(row).parents('tr').find('td').eq(1).html();
    var idPrivilegio=$(row).parents('tr').find('td').eq(2).html();
    var estado=$(row).parents('tr').find('td').eq(3).html();
    var nombre=$(row).parents('tr').find('td').eq(4).html();
    var nick=$(row).parents('tr').find('td').eq(8).html();
    
    $('#id_hidden_cod_empleado').val(id);
    $('#id_sel_privilegio_usuario').val(idPrivilegio);
    $('#id_txt_nombre_empleado_usuario').val(nombre);
    console.log(nick);
    if(nick!='Sin usuario'){
        $('#id_txt_nick_usuario').val(nick);
    }
    if(estado=='1'){
        $('#id_ckd_estado_usuario').attr('checked','true');
    }else{
        $('#id_ckd_estado_usuario').attr('checked','false');
    }
    
    $('#id_div_form__registrar').show();    
    $('#id_table_usuarios').hide();
} 