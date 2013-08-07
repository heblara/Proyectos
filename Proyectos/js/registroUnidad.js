$(document).ready(function(){
    
    
    $('#id_btn_buscar_unidad').click(function(){
                            
        var $id_txt_texto_unidad      =       $('#id_txt_texto_unidad').val();
        
        $('#id_btn_clean_unidad').trigger('click');  
        $('#id_btn_cancel_unidad').trigger('click');  
        
        if($id_txt_texto_unidad!=""){
            $('#id_result_busqueda_unidad').html('<img src="images/ajax-loader.gif">');
            
            /* Mostrando resultados en un dialog*/
            $( "#id_result_busqueda_unidad" ).dialog({
                height      : 350,
                width       : 850,
                modal       : true,
                draggable   : false,
                resizable   : false
            });
        
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroUnidad.ctrl.php?accion=1',
                data            :   $('#id_form_buscar_unidad').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_unidad" class="ui-widget ui-widget-content" width="90%">';
                            table+='<thead>';
                            table+='<tr class="ui-widget-header ">';
                            table+='<th width="5%">#</th>';
                            table+='<th style="display:none">id</th>';                            
                            table+='<th width="40%">Descripcion</th>';                                                        
                            table+='<th width="15%">OPCIONES</th>';
                            table+='</tr>';
                            table+='</thead>';
                            table+='<tbody>';
                            var $razon;
                            
                            $.each(data.rows, function(index,value){
                                table+='<tr>';
                                table+='<td>'+(index+1)+'</td>';
                                table+='<td style="display:none">'+value.id+'</td>';                               
                                table+='<td>'+value.descripcion+'</td>';                                
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_unidad').html(table);
                            $("#id_table_unidad tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_unidad tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_unidad').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_unidad').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_unidad').html('');
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
    $('#id_texta_descripcion_unidad').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(80===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
        
    $('#id_btn_cancel_unidad').click(function(){
        $('#id_btn_clean_unidad').trigger('click');
        $('#id_btn_cancel_unidad').hide();
        $('#id_btn_delete_unidad').hide();
        $('#id_btn_update_unidad').hide();
        $('#id_btn_add_unidad').show();
    });
    
    $('#id_btn_clean_unidad').click(function(){
        $('#id_texta_descripcion_unidad').val('');        
    });
    
    $('#id_btn_add_unidad').click(function(){
        if(validar_form()){
            save_unidad(2);
        }
    });
    
    $('#id_btn_update_unidad').click(function(){
        if(validar_form()){
            save_unidad(3);
        }
    });
    
    $('#id_btn_delete_unidad').click(function(){
        $('#dialog').html('<p>Desea eliminar la unidad?</p>');
        $( "#dialog" ).dialog({
            title       : 'Confirmacion',
            resizable   : false,
            height      : 120,
            width       : 200,
            modal       : true,
            draggable   : false,
            buttons: {
                "Si": function() {
                    save_unidad(4);
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    var validar_form=function(){
        $descripcion=$('#id_texta_descripcion_unidad').val();
        
        $respuesta=true;
        //verificacion de campos vacios
        if($descripcion==""){
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
    
    var save_unidad=function(estado){
        load_servidor();
        $.ajax
        ({
            type            :   'POST',
            url             :   'controlador/registroUnidad.ctrl.php?accion='+estado,
            data            :   $('#id_registrar_unidad').serialize(), 
            dataType        :   'json',
            contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
            success         :   function(data)
            {
                if(data.bandera==1){
                     $('#id_btn_clean_unidad').trigger('click');                     
                    $('#id_btn_cancel_unidad').trigger('click');
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
    var descripcion=$(row).parents('tr').find('td').eq(2).html();
    
    //clean de campos
    $('#id_btn_clean_unidad').trigger('click');
     
    $('#id_hidden_cod_unidad').val(id);
    $('#id_texta_descripcion_unidad').val(descripcion);
            
    $('#id_btn_update_unidad').show();
    $('#id_btn_delete_unidad').show();
    $('#id_btn_cancel_unidad').show();
    $('#id_btn_add_unidad').hide();
    $('#id_btn_clean_unidad').hide();
        
    //$('#id_table_unidad').hide();
    
    $( '#id_result_busqueda_unidad' ).dialog( "close" );
} 