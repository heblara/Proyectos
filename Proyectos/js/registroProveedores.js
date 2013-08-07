$(document).ready(function(){
    
    
    $('#id_btn_buscar_proveedor').click(function(){
        
            
        var $id_sel_buscar_proveedor     =       $('#id_sel_buscar_proveedor').val();
        var $id_txt_texto_proveedor      =       $('#id_txt_texto_proveedor').val();
        
        $('#id_btn_clean_proveedor').trigger('click');  
        $('#id_btn_cancel_proveedor').trigger('click');  
        
        if($id_sel_buscar_proveedor!="" && $id_txt_texto_proveedor!=""){
            $('#id_result_busqueda_proveedor').html('<img src="images/ajax-loader.gif">');
            
            /* Mostrando resultados en un dialog*/
            $( "#id_result_busqueda_proveedor" ).dialog({
                height      : 350,
                width       : 850,
                modal       : true,
                draggable   : false,
                resizable   : false
            });
        
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroProveedor.ctrl.php?accion=1',
                data            :   $('#id_form_buscar_proveedor').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_proveedor" class="ui-widget ui-widget-content" width="90%">';
                            table+='<thead>';
                            table+='<tr class="ui-widget-header ">';
                            table+='<th width="5%">#</th>';
                            table+='<th style="display:none">id</th>';                            
                            table+='<th width="40%">Nombre</th>';
                            table+='<th width="15%">NIT</th>';
                            table+='<th style="display:none">razon</th>';                        
                            table+='<th style="display:none">direccion</th>';
                            table+='<th width="25%">telefonos</th>';                            
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
                                table+='<td>'+value.nit+'</td>';
                                                                
                                if(value.razon==null || value.razon==""){
                                    $razon='';
                                }else{
                                    $razon=value.razon;
                                }                                
                                
                                table+='<td style="display:none">'+$razon+'</td>';                                                                    
                                table+='<td style="display:none">'+value.direccion+'</td>';
                                table+='<td>'+value.telefonos+'</td>';
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_proveedor').html(table);
                            $("#id_table_proveedor tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_proveedor tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_proveedor').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_proveedor').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_proveedor').html('');
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
    $('#id_txt_texto_proveedor').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(250===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_nombre_proveedor').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(250===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    
    $('#id_txt_nit_proveedor').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(14===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/[0-9]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_texta_razon_proveedor').bind({
        keypress:function(event){            
            if(250===$(this).val().length)return false;            
            return true;
        }
    });
    
    $('#id_texta_direccion_proveedor').bind({
        keypress:function(event){            
            if(250===$(this).val().length)return false;            
            return true;
        }
    });
    
    $('#id_texta_telefonos_proveedor').bind({
        keypress:function(event){            
            if(80===$(this).val().length)return false;            
            return true;
        }
    });
        
    $('#id_btn_cancel_proveedor').click(function(){
        $('#id_btn_clean_proveedor').trigger('click');
        $('#id_btn_cancel_proveedor').hide();
        $('#id_btn_delete_proveedor').hide();
        $('#id_btn_update_proveedor').hide();
        $('#id_btn_add_proveedor').show();
        $('#id_btn_clean_proveedor').show();
    });
    
    $('#id_btn_clean_proveedor').click(function(){
        $('#id_txt_nombre_proveedor').val('');
        $('#id_txt_nit_proveedor').val('');        
        $('#id_texta_razon_proveedor').val('');        
        $('#id_texta_direccion_proveedor').val('');
        $('#id_texta_telefonos_proveedor').val('');
    });
    
    $('#id_btn_add_proveedor').click(function(){
        if(validar_form()){
            save_proveedor(2);
        }
    });
    
    $('#id_btn_update_proveedor').click(function(){
        if(validar_form()){
            save_proveedor(3);
        }
    });
    
    $('#id_btn_delete_proveedor').click(function(){
        $('#dialog').html('<p>Desea eliminar al proveedor?</p>');
        $( "#dialog" ).dialog({
            title       : 'Confirmacion',
            resizable   : false,
            height      : 120,
            width       : 200,
            modal       : true,
            draggable   : false,
            buttons: {
                "Si": function() {
                    save_proveedor(4);
                //                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    var validar_form=function(){
        $nombre=$('#id_txt_nombre_proveedor').val();
        $nit=$('#id_txt_nit_proveedor').val();        
        $direccion=$('#id_texta_direccion_proveedor').val();
        $telefonos=$('#id_texta_telefonos_proveedor').val();
       
        $respuesta=true;
        //verificacion de campos vacios
        if($nombre=="" || $nit=="" || $direccion=="" || $telefonos==""){
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
    
    var save_proveedor=function(estado){
        load_servidor();
        
        $.ajax
        ({
            type            :   'POST',
            url             :   'controlador/registroProveedor.ctrl.php?accion='+estado,
            data            :   $('#id_registrar_proveedor').serialize(), 
            dataType        :   'json',
            contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
            success         :   function(data)
            {
                //                $('#dialog').dialog('close');
                if(data.bandera==1){
                    $('#id_btn_clean_proveedor').trigger('click');
                    $('#id_btn_cancel_proveedor').trigger('click');
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
    var nit=$(row).parents('tr').find('td').eq(3).html();
    var razon=$(row).parents('tr').find('td').eq(4).html();
    var direccion=$(row).parents('tr').find('td').eq(5).html();
    var telefonos=$(row).parents('tr').find('td').eq(6).html();
    
    //clean de campos
    $('#id_btn_clean_proveedor').trigger('click');
     
    $('#id_hidden_cod_proveedor').val(id);
    $('#id_txt_nombre_proveedor').val(nombre);
    $('#id_txt_nit_proveedor').val(nit);
    $('#id_texta_razon_proveedor').val(razon);
    $('#id_texta_direccion_proveedor').val(direccion);
    $('#id_texta_telefonos_proveedor').val(telefonos);
    
        
    $('#id_btn_update_proveedor').show();
    $('#id_btn_delete_proveedor').show();
    $('#id_btn_add_proveedor').hide();
    $('#id_btn_clean_proveedor').show();
    $('#id_table_proveedor').hide();
    
    $( '#id_result_busqueda_proveedor' ).dialog( "close" );
} 