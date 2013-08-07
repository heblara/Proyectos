$(document).ready(function(){
    
    
    $('#id_btn_buscar_tipo_empleado').click(function(){
                            
        var $id_txt_texto_tipo_empleado      =       $('#id_txt_texto_tipo_empleado').val();
        var $id_sel_buscar_tipo_empleado     =       $('#id_sel_buscar_tipo_empleado').val();   
        $('#id_btn_clean_tipo_empleado').trigger('click');  
        $('#id_btn_cancel_tipo_empleado').trigger('click');  
        
        if($id_txt_texto_tipo_empleado!="" && $id_sel_buscar_tipo_empleado!=""){
            $('#id_result_busqueda_tipo_empleado').html('<img src="images/ajax-loader.gif">');
            
            /* Mostrando resultados en un dialog*/
            $( "#id_result_busqueda_tipo_empleado" ).dialog({
                height      : 350,
                width       : 850,
                modal       : true,
                draggable   : false,
                resizable   : false
            });
        
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroTipoEmpleado.ctrl.php?accion=1',
                data            :   $('#id_form_buscar_tipo_empleado').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_tipo_empleado" class="ui-widget ui-widget-content" width="90%">';
                            table+='<thead>';
                            table+='<tr class="ui-widget-header ">';
                            table+='<th width="5%">#</th>';
                            table+='<th style="display:none">id</th>';                            
                            table+='<th style="display:none">idExperiencia</th>';                            
                            table+='<th width="40%">Tipo Empleado</th>';                            
                            table+='<th width="40%">Experiencia</th>';                            
                            table+='<th width="15%">OPCIONES</th>';
                            table+='</tr>';
                            table+='</thead>';
                            table+='<tbody>';
                            var $razon;
                            
                            $.each(data.rows, function(index,value){
                                table+='<tr>';
                                table+='<td>'+(index+1)+'</td>';
                                table+='<td style="display:none">'+value.id+'</td>';                               
                                table+='<td style="display:none">'+value.idExperiencia+'</td>';                               
                                table+='<td>'+value.descripcion+'</td>';                   
                                table+='<td>'+value.experiencia+'</td>';                   
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_tipo_empleado').html(table);
                            $("#id_table_tipo_empleado tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_tipo_empleado tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_tipo_empleado').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_tipo_empleado').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_tipo_empleado').html('');
            $alert('Error','Debe de llenar todos los campos de busqueda',150,200);
        }
        
        
    });
    
      
    
    var $alert=function(title,mensaje,height,width){
        $('#dialog').html('<p>'+mensaje+'</p>');
        $( "#dialog" ).dialog({
            title       : title,                
            height      : height,
            draggable   : false,
            width       : width,
            modal       : true,              
            resizable   : false,
            dialogClass : "no-close",
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
    
    /* EVENTOS DEL FORMULARIO */
    $('#id_txt_texto_tipo_empleado').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(150===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_nombre_tipo_empleado').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(150===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
           
        
    $('#id_btn_cancel_tipo_empleado').click(function(){
        $('#id_btn_clean_tipo_empleado').trigger('click');
        $('#id_btn_cancel_tipo_empleado').hide();
        $('#id_btn_delete_tipo_empleado').hide();
        $('#id_btn_update_tipo_empleado').hide();
        $('#id_btn_add_tipo_empleado').show();
        $('#id_btn_clean_tipo_empleado').show();
    });
    
    $('#id_btn_clean_tipo_empleado').click(function(){
        $('#id_txt_nombre_tipo_empleado').val('');        
        $('#id_sel_experiencia_tipo_empleado').val('');
    });
    
    $('#id_btn_add_tipo_empleado').click(function(){
        if(validar_form()){
            save_tipo_empleado(2);
        }
    });
    
    $('#id_btn_update_tipo_empleado').click(function(){
        if(validar_form()){
            save_tipo_empleado(3);
        }
    });
    
    $('#id_btn_delete_tipo_empleado').click(function(){
        $('#dialog').html('<p>Desea eliminar el Tipo de Empleado?</p>');
        $( "#dialog" ).dialog({
            title       : 'Confirmacion',
            resizable   : false,
            height      : 120,
            width       : 200,
            modal       : true,
            draggable   : false,
            buttons: {
                "Si": function() {
                    save_tipo_empleado(4);                
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    var validar_form=function(){
        $nombre=$('#id_txt_nombre_tipo_empleado').val();
        $experiencia=$('#id_sel_experiencia_tipo_empleado').val();
        $respuesta=true;
        //verificacion de campos vacios
        if($nombre=="" || $experiencia==""){
            $alert('Error','Debe de llenar todos los campos requeridos',130,200);            
            $respuesta=false;
        }
        
        return $respuesta;
    }
    
    var load_servidor=function(){
        $('#dialog').html('<div align="center"><img src="images/ajax-loader.gif"></div>');
        $('#dialog').dialog({
            title:'Esperando respuesta de servidor',
            height      : 150,
            width       : 200,
            dialogClass : "no-close",
            buttons     :{},
            modal       : true,
            draggable   : false,
            resizable   : false
        });
    }
    
    var save_tipo_empleado=function(estado){
        load_servidor();
        
        $.ajax
        ({
            type            :   'POST',
            url             :   'controlador/registroTipoEmpleado.ctrl.php?accion='+estado,
            data            :   $('#id_registrar_tipo_empleado').serialize(), 
            dataType        :   'json',
            contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
            success         :   function(data)
            {                
                if(data.bandera==1){
                    $('#id_btn_clean_tipo_empleado').trigger('click');
                    $('#id_btn_cancel_tipo_empleado').trigger('click');
                    $alert('Exito',data.mensaje,150,200);                    
                }else{
                    $alert('Error',data.mensaje,150,300);
                }                                    
            }
        });        
    }
    
    
});

var show_information=function(row){
    var id=$(row).parents('tr').find('td').eq(1).html();
    var nombre=$(row).parents('tr').find('td').eq(3).html();
    var idExperiencia=$(row).parents('tr').find('td').eq(2).html();
    
    //clean de campos
    $('#id_btn_clean_tipo_empleado').trigger('click');
     
    $('#id_hidden_cod_tipo_empleado').val(id);
    $('#id_txt_nombre_tipo_empleado').val(nombre);
    $('#id_sel_experiencia_tipo_empleado').val(idExperiencia);
    $('#id_btn_update_tipo_empleado').show();
    $('#id_btn_delete_tipo_empleado').show();
    $('#id_btn_add_tipo_empleado').hide();
    $('#id_btn_clean_tipo_empleado').show();
    $('#id_table_tipo_empleado').hide();
    
    $( '#id_result_busqueda_tipo_empleado' ).dialog( "close" );
} 