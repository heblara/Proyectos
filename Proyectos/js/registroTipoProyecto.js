$(document).ready(function(){
    
    
    $('#id_btn_buscar_tipo_proyecto').click(function(){
                            
        var $id_txt_texto_tipo_proyecto      =       $('#id_txt_texto_tipo_proyecto').val();
        
        $('#id_btn_clean_tipo_proyecto').trigger('click');  
        
        if($id_txt_texto_tipo_proyecto!=""){
            $('#id_result_busqueda_tipo_proyecto').html('<img src="images/ajax-loader.gif">');
            
            /* Mostrando resultados en un dialog*/
            $( "#id_result_busqueda_tipo_proyecto" ).dialog({
                height      : 350,
                width       : 850,
                modal       : true,
                draggable   : false,
                resizable   : false
            });
        
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroTipoProyecto.ctrl.php?accion=1',
                data            :   $('#id_form_buscar_tipo_proyecto').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_tipo_proyecto" class="ui-widget ui-widget-content" width="90%">';
                            table+='<thead>';
                            table+='<tr class="ui-widget-header ">';
                            table+='<th width="5%">#</th>';
                            table+='<th style="display:none">id</th>';                                                        
                            table+='<th width="30%">Nombre</th>';                            
                            table+='<th width="30%">Descripcion</th>';                            
                            table+='<th width="20%" align="center">Imagen</th>';                            
                            table+='<th width="15%">OPCIONES</th>';
                            table+='</tr>';
                            table+='</thead>';
                            table+='<tbody>';
                            var $razon;
                            
                            $.each(data.rows, function(index,value){
                                table+='<tr>';
                                table+='<td>'+(index+1)+'</td>';
                                table+='<td style="display:none">'+value.id+'</td>';                                                               
                                table+='<td>'+value.nombre+'</td>';                   
                                table+='<td>'+value.descripcion+'</td>';                   
                                if(value.imagen!=""){
                                    table+='<td><img src="'+value.imagen+'" border="0" height="100%" width="100%"></td>';                   
                                }else{
                                    table+='<td></td>';                   
                                }
                                    
                                
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_tipo_proyecto').html(table);
                            $("#id_table_tipo_proyecto tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_tipo_proyecto tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_tipo_proyecto').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_tipo_proyecto').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_tipo_proyecto').html('');
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
    $('#id_txt_nombre_tipo_proyecto').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(45===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_texta_descripcion_tipo_proyecto').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;            
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
        
    $('#id_btn_cancel_tipo_proyecto').click(function(){        
        $('#id_btn_cancel_tipo_proyecto').hide();
        $('#id_btn_delete_tipo_proyecto').hide();
        $('#id_btn_update_tipo_proyecto').hide();
        $('#id_row_imagen').hide();
        $('#id_btn_add_tipo_proyecto').show();
        $('#id_btn_clean_tipo_proyecto').show();
    });
    
    $('#id_btn_clean_tipo_proyecto').click(function(){
        $('#id_txt_nombre_tipo_proyecto').val('');        
        $('#id_texta_descripcion_tipo_proyecto').val('');
        $('#id_fil_imagen_tipo_proyecto').val('');
        $('#id_div_imagen').html('');
        $('#id_btn_cancel_tipo_proyecto').trigger('click');
    });
    
    $('#id_btn_add_tipo_proyecto').click(function(){
        if(validar_form()){
            save_tipo_proyecto(2);
        }
    });
    
    $('#id_btn_update_tipo_proyecto').click(function(){
        if(validar_form()){
            save_tipo_proyecto(3);
        }
    });
    
    $('#id_btn_delete_tipo_proyecto').click(function(){
        $('#dialog').html('<p>Desea eliminar el Tipo de Proyecto?</p>');
        $( "#dialog" ).dialog({
            title       : 'Confirmacion',
            resizable   : false,
            height      : 120,
            width       : 200,
            modal       : true,
            draggable   : false,
            buttons: {
                "Si": function() {
                    save_tipo_proyecto(4);                
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    var validar_form=function(){
        $nombre=$('#id_txt_nombre_tipo_proyecto').val();
        $descripcion=$('#id_texta_descripcion_tipo_proyecto').val();
        $imagen=$('#id_fil_imagen_tipo_proyecto').val();
        $respuesta=true;
        //verificacion de campos vacios
        
        if ($imagen!=''){
            var ext_file=$imagen.substr(-3);
            if(ext_file!='png' && ext_file!='gif' && ext_file!='jpg'){
                $alert('Error','El archivo seleccionado no es una imagen',130,200);            
                $respuesta=false;
            }else{
                $respuesta=true;
            }
        }
        
        
        if($nombre=="" || $descripcion==""){
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
    
    var save_tipo_proyecto=function(estado){
        
        load_servidor(); 
        
        var inputFileImage = document.getElementById("id_fil_imagen_tipo_proyecto");
        var $id_texta_descripcion_tipo_proyecto=$("#id_texta_descripcion_tipo_proyecto").val();
        var $id_txt_nombre_tipo_proyecto=$("#id_txt_nombre_tipo_proyecto").val();
        var $id_hidden_cod_tipo_proyecto=$("#id_hidden_cod_tipo_proyecto").val();
        
        
        var file = inputFileImage.files[0];
        var data = new FormData();
        data.append('fil_imagen_tipo_proyecto',file);
        data.append('txt_nombre_tipo_proyecto',$id_txt_nombre_tipo_proyecto);
        data.append('texta_descripcion_tipo_proyecto',$id_texta_descripcion_tipo_proyecto);
        if($id_hidden_cod_tipo_proyecto!=''){
            data.append('hidden_cod_tipo_proyecto',$id_hidden_cod_tipo_proyecto); 
        }
        
        $.ajax
        ({
            type            :   'POST',
            url             :   'controlador/registroTipoProyecto.ctrl.php?accion='+estado,            
            data            :   data,            
            dataType        :   'json',            
            processData     :false,
            contentType     :   false,
            cache           :false,
            success         :   function(data)
            {                
                if(data.bandera==1){
                    $('#id_btn_clean_tipo_proyecto').trigger('click');                    
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
    var nombre=$(row).parents('tr').find('td').eq(2).html();
    var descripcion=$(row).parents('tr').find('td').eq(3).html();
    var imagen=$(row).parents('tr').find('td').eq(4).html();
    
    //clean de campos
    $('#id_btn_clean_tipo_proyecto').trigger('click');
     
    $('#id_hidden_cod_tipo_proyecto').val(id);
    $('#id_txt_nombre_tipo_proyecto').val(nombre);
    $('#id_texta_descripcion_tipo_proyecto').val(descripcion);
    $('#id_div_imagen').html(imagen);
    
    $('#id_btn_update_tipo_proyecto').show();
    $('#id_btn_delete_tipo_proyecto').show();
    $('#id_btn_add_tipo_proyecto').hide();
    $('#id_btn_clean_tipo_proyecto').show();
    $('#id_table_tipo_proyecto').hide();
    if(imagen!=""){
        $('#id_row_imagen').show();
    }
    $( '#id_result_busqueda_tipo_proyecto' ).dialog( "close" );
} 