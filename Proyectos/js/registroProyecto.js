$(document).ready(function(){
    
    $('#id_btn_show_buscar_equipo').click(function(){
                            
        /* Mostrando resultados en un dialog*/
        $( "#id_div_form_buscar_equipo" ).dialog({
            height      : 350,
            width       : 950,
            modal       : true,
            draggable   : false,
            resizable   : false,
            title       : 'Busqueda de equipo'  
        });       
    });
    
    
    
    $('#id_btn_buscar_equipo').click(function(){
        
        var $id_txt_texto_equipo      =       $('#id_txt_buscar_equipo').val();
        
        if($id_txt_texto_equipo!=""){
            $('#id_result_busqueda_equipo').html('<img src="images/ajax-loader.gif">');
            
                   
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroProyecto.ctrl.php?accion=5',
                data            :   $('#id_form_buscar_equipo').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_equipo" class="ui-widget ui-widget-content" width="90%">';
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
                                
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information_equipo(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_equipo').html(table);
                            $("#id_table_equipo tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_equipo tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_equipo').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_equipo').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_equipo').html('');
            $alert('Error','Debe de llenar todos los campos de busqueda',150,200);
        }
    });
    
    
    
    $('#id_btn_buscar_proyecto').click(function(){
                            
        var $id_txt_texto_proyecto      =       $('#id_txt_texto_proyecto').val();
        
        $('#id_btn_clean_proyecto').trigger('click');  
        
        if($id_txt_texto_proyecto!=""){
            $('#id_result_busqueda_proyecto').html('<img src="images/ajax-loader.gif">');
            
            /* Mostrando resultados en un dialog*/
            $( "#id_result_busqueda_proyecto" ).dialog({
                height      : 350,
                width       : 850,
                modal       : true,
                draggable   : false,
                resizable   : false
            });
        
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroProyecto.ctrl.php?accion=1',
                data            :   $('#id_form_buscar_proyecto').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_proyecto" class="ui-widget ui-widget-content" width="90%">';
                            table+='<thead>';
                            table+='<tr class="ui-widget-header ">';
                            table+='<th width="5%">#</th>';
                            table+='<th style="display:none">id</th>';                                                        
                            table+='<th style="display:none">idTipoProyecto</th>';   
                            table+='<th style="display:none">idEquipos</th>';   
                            table+='<th width="15%">Equipo</th>';                                                        
                            table+='<th width="15%">Tipo de Proyecto</th>';                                                        
                            table+='<th width="30%">Nombre</th>';                            
                            table+='<th width="8%">Fecha de Inicio</th>';                            
                            table+='<th width="8%">Fecha de Finalizacion</th>';                            
                            table+='<th width="9%">Costo $</th>';                            
                            table+='<th width="15%">OPCIONES</th>';
                            table+='</tr>';
                            table+='</thead>';
                            table+='<tbody>';
                            var $razon;
                            
                            $.each(data.rows, function(index,value){
                                table+='<tr>';
                                table+='<td>'+(index+1)+'</td>';
                                table+='<td style="display:none">'+value.id+'</td>';                                                               
                                table+='<td style="display:none">'+value.idTipoProyecto+'</td>';                                                               
                                table+='<td style="display:none">'+value.idEquipos+'</td>';                                                               
                                table+='<td>'+value.label_equipo+'</td>';
                                table+='<td>'+value.label_proyecto+'</td>';                   
                                table+='<td>'+value.nombre+'</td>';                   
                                table+='<td>'+value.fecha_ini+'</td>';                   
                                table+='<td>'+value.fecha_fin+'</td>';                   
                                table+='<td>'+value.costo+'</td>';                   
                                
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_proyecto').html(table);
                            $("#id_table_proyecto tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_proyecto tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_proyecto').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_proyecto').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_proyecto').html('');
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
    $('#id_txt_nombre_proyecto').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(45===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $( "#id_txt_fecha_inicio_proyecto" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat:"yy-mm-dd",
        onClose: function( selectedDate ) {
            $( "#id_txt_fecha_fin_proyecto" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#id_txt_fecha_fin_proyecto" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat:"yy-mm-dd",
        onClose: function( selectedDate ) {
            $( "#id_txt_fecha_inicio_proyecto" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    
    
    $('#id_txt_costo_proyecto').priceFormat({
        prefix: '',
        thousandsSeparator: ''
    });
   
        
    $('#id_btn_cancel_proyecto').click(function(){        
        $('#id_btn_cancel_proyecto').hide();
        $('#id_btn_delete_proyecto').hide();
        $('#id_btn_update_proyecto').hide();        
        $('#id_btn_add_proyecto').show();
        $('#id_btn_clean_proyecto').show();
    });
    
    $('#id_btn_clean_proyecto').click(function(){
        $('#id_txt_nombre_proyecto').val('');        
        $('#id_txt_fecha_inicio_proyecto').val('');
        $('#id_txt_fecha_fin_proyecto').val('');
        $('#id_txt_costo_proyecto').val('');
        $('#id_sel_tipo_proyecto').val('');
        $('#id_hidden_cod_personal_equipo').val('');            
        $('#id_txt_nombre_equipo_personal_equipo').val('');
        $('#id_btn_cancel_proyecto').trigger('click');
    });
    
    $('#id_btn_add_proyecto').click(function(){
        if(validar_form()){
            save_proyecto(2);
        }
    });
    
    $('#id_btn_update_proyecto').click(function(){
        if(validar_form()){
            save_proyecto(3);
        }
    });
    
    $('#id_btn_delete_proyecto').click(function(){
        $('#dialog').html('<p>Desea eliminar el Proyecto?</p>');
        $( "#dialog" ).dialog({
            title       : 'Confirmacion',
            resizable   : false,
            height      : 120,
            width       : 200,
            modal       : true,
            draggable   : false,
            buttons: {
                "Si": function() {
                    save_proyecto(4);                
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    var validar_form=function(){
        $idtipoproyecto=$('#id_sel_tipo_proyecto').val();
        $nombre=$('#id_txt_nombre_proyecto').val();
        $fecha_ini=$('#id_txt_fecha_inicio_proyecto').val();
        $costo=$('#id_txt_costo_proyecto').val();
        $id_hidden_cod_personal_equipo=$('#id_hidden_cod_personal_equipo').val();
        $respuesta=true;
        //verificacion de campos vacios
        
        if($idtipoproyecto=="" || $nombre=="" || $fecha_ini=="" || $costo=="" || $id_hidden_cod_personal_equipo==""){
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
    
    var save_proyecto=function(estado){
        
        load_servidor(); 
                      
        $.ajax
        ({
            type            :   'POST',
            url             :   'controlador/registroProyecto.ctrl.php?accion='+estado,
            data            :   $('#id_registrar_proyecto').serialize(), 
            dataType        :   'json',
            contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
            success         :   function(data)
            {
                if(data.bandera==1){
                    $('#id_btn_clean_proyecto').trigger('click');                                         
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
    var idTipoProyecto=$(row).parents('tr').find('td').eq(2).html();
    var idEquipo=$(row).parents('tr').find('td').eq(3).html();
    var label_equipo=$(row).parents('tr').find('td').eq(4).html();
    var nombre=$(row).parents('tr').find('td').eq(6).html();
    var fecha_ini=$(row).parents('tr').find('td').eq(7).html();
    var fecha_fin=$(row).parents('tr').find('td').eq(8).html();
    var costo=$(row).parents('tr').find('td').eq(9).html();
    
    //clean de campos
    $('#id_btn_clean_proyecto').trigger('click');

    $('#id_sel_tipo_proyecto').val(idTipoProyecto);
    $('#id_hidden_cod_proyecto').val(id);
    $('#id_txt_nombre_proyecto').val(nombre);
    $('#id_hidden_cod_personal_equipo').val(idEquipo);
    $('#id_txt_nombre_equipo_personal_equipo').val(label_equipo);
    $('#id_txt_fecha_inicio_proyecto').val(fecha_ini);
    $('#id_txt_fecha_fin_proyecto').val(fecha_fin);
    $('#id_txt_costo_proyecto').val(costo);
    
    $('#id_btn_update_proyecto').show();
    $('#id_btn_delete_proyecto').show();
    $('#id_btn_add_proyecto').hide();
    $('#id_btn_clean_proyecto').show();
    $('#id_table_proyecto').hide();
   
    $( '#id_result_busqueda_proyecto' ).dialog( "close" );
} 


var show_information_equipo=function(row){
    
    var id=$(row).parents('tr').find('td').eq(1).html();
    var nombre=$(row).parents('tr').find('td').eq(2).html();
      
    $('#id_hidden_cod_personal_equipo').val(id);
    $('#id_txt_nombre_equipo_personal_equipo').val(nombre);
    
   
    $( '#id_div_form_buscar_equipo' ).dialog( "close" );
} 