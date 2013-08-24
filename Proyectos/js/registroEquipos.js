$(document).ready(function(){
    
    
    $('#id_btn_buscar_equipos').click(function(){
                            
        var $id_txt_texto_equipos      =       $('#id_txt_texto_equipos').val();
        
        $('#id_btn_clean_equipos').trigger('click');  
                
        if($id_txt_texto_equipos!=""){
            $('#id_result_busqueda_equipos').html('<img src="images/ajax-loader.gif">');
            
            /* Mostrando resultados en un dialog*/
            $( "#id_result_busqueda_equipos" ).dialog({
                height      : 350,
                width       : 850,
                modal       : true,
                draggable   : false,
                resizable   : false
            });
        
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroEquipos.ctrl.php?accion=1',
                data            :   $('#id_form_buscar_equipos').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_equipos" class="ui-widget ui-widget-content" width="90%">';
                            table+='<thead>';
                            table+='<tr class="ui-widget-header ">';
                            table+='<th width="5%">#</th>';
                            table+='<th style="display:none">id</th>';                            
                            table+='<th width="30%">Nombre</th>';                            
                            table+='<th width="50%">Descripcion de Actividad</th>';                            
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
                                table+='<td>'+value.actividad+'</td>';                               
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_equipos').html(table);
                            $("#id_table_equipos tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_equipos tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_equipos').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_equipos').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_equipos').html('');
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
    $('#id_txt_nombre_equipos').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(45===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_actividad_equipos').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(250===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
           
        
    $('#id_btn_cancel_equipos').click(function(){        
        $('#id_btn_cancel_equipos').hide();
        $('#id_btn_delete_equipos').hide();
        $('#id_btn_update_equipos').hide();
        $('#id_btn_add_equipos').show();
        $('#id_btn_clean_equipos').show();
    });
    
    $('#id_btn_clean_equipos').click(function(){
        $('#id_txt_nombre_equipos').val(''); 
        $('#id_txt_actividad_equipos').val(''); 
        $('#id_btn_cancel_equipos').trigger('click');  
    });
    
    $('#id_btn_add_equipos').click(function(){
        if(validar_form()){
            save_equipos(2);
        }
    });
    
    $('#id_btn_update_equipos').click(function(){
        if(validar_form()){
            save_equipos(3);
        }
    });
    
    $('#id_btn_delete_equipos').click(function(){
        $('#dialog').html('<p>Desea eliminar el Equipo de Trabajo?</p>');
        $( "#dialog" ).dialog({
            title       : 'Confirmacion',
            resizable   : false,
            height      : 120,
            width       : 200,
            modal       : true,
            draggable   : false,
            buttons: {
                "Si": function() {
                    save_equipos(4);                
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    var validar_form=function(){
        $nombre=$('#id_txt_nombre_equipos').val();
        $actividad=$('#id_txt_actividad_equipos').val();  
        $respuesta=true;
        //verificacion de campos vacios
        if($nombre=="" || $actividad==""){
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
    
    var save_equipos=function(estado){
        load_servidor();
        
        $.ajax
        ({
            type            :   'POST',
            url             :   'controlador/registroEquipos.ctrl.php?accion='+estado,
            data            :   $('#id_registrar_equipos').serialize(), 
            dataType        :   'json',
            contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
            success         :   function(data)
            {                
                if(data.bandera==1){
                    $('#id_btn_clean_equipos').trigger('click');                    
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
    var actividad=$(row).parents('tr').find('td').eq(3).html();
   
    
    //clean de campos
    $('#id_btn_clean_equipos').trigger('click');
     
    $('#id_hidden_cod_equipos').val(id);
    $('#id_txt_nombre_equipos').val(nombre);
    $('#id_txt_actividad_equipos').val(actividad);
       
    $('#id_btn_update_equipos').show();
    $('#id_btn_delete_equipos').show();
    $('#id_btn_add_equipos').hide();
    $('#id_btn_clean_equipos').show();
    $('#id_table_equipos').hide();
    
    $( '#id_result_busqueda_equipos' ).dialog( "close" );
} 