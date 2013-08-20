$(document).ready(function(){
    
    $('#id_btn_show_buscar_proyecto').click(function(){
                            
        /* Mostrando resultados en un dialog*/
        $( "#id_div_form_proyecto" ).dialog({
            height      : 350,
            width       : 950,
            modal       : true,
            draggable   : false,
            resizable   : false,
            title       : 'Busqueda de proyecto'  
        });       
    });
    
    
    $('#id_btn_show_buscar_empleado').click(function(){
                            
        /* Mostrando resultados en un dialog*/
        $( "#id_div_form_buscar_empleado" ).dialog({
            height      : 350,
            width       : 950,
            modal       : true,
            draggable   : false,
            resizable   : false,
            title       : 'Busqueda de personal'  
        });       
    });
    
    $('#id_btn_buscar_empleado').click(function(){
        
        var $id_txt_texto_proyecto      =       $('#id_txt_buscar_empleado').val();
        
        if($id_txt_texto_proyecto!=""){
            $('#id_result_busqueda_empleado').html('<img src="images/ajax-loader.gif">');
            
                   
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroSalidas.ctrl.php?accion=2',
                data            :   $('#id_form_buscar_empleado').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_personal" class="ui-widget ui-widget-content" width="90%">';
                            table+='<thead>';
                            table+='<tr class="ui-widget-header ">';
                            table+='<th width="5%">#</th>';
                            table+='<th style="display:none">id</th>';                                                                                    
                            table+='<th width="40%">Nombre de Empleado</th>';                                                        
                            table+='<th width="40%">Tipo de Empleado</th>';                                                        
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
                                table+='<td>'+value.TipoEmp+'</td>';                                                   
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information_personal(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_empleado').html(table);
                            $("#id_table_personal tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_personal tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_personal').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_empleado').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_empleado').html('');
            $alert('Error','Debe de llenar todos los campos de busqueda',150,200);
        }
    });
    
    
    $('#id_btn_buscar_proyecto').click(function(){
        
        var $id_txt_texto_proyecto      =       $('#id_txt_buscar_proyecto').val();
        
        if($id_txt_texto_proyecto!=""){
            $('#id_result_busqueda_proyecto').html('<img src="images/ajax-loader.gif">');
            
                   
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroSalidas.ctrl.php?accion=3',
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
                            table+='<th width="30%">Tipo de Proyecto</th>';                                                        
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
                                table+='<td>'+value.label_proyecto+'</td>';                   
                                table+='<td>'+value.nombre+'</td>';                   
                                table+='<td>'+value.fecha_ini+'</td>';                   
                                table+='<td>'+value.fecha_fin+'</td>';                   
                                table+='<td>'+value.costo+'</td>';                   
                                
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information_proyecto(this)"></td>';
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
    
    
    $('#id_sel_opc_buscar').change(function(){
        $value=$(this).val();
        if($value==1){
            $('#id_div_rango_fechas').show();
            $('#id_div_nombre').hide();
        }else{
            $('#id_div_rango_fechas').hide();
            $('#id_div_nombre').show();
        }
    });
    
    
    $('#id_btn_buscar_salidas').click(function(){
        $respuesta=true;
        $opc=$('#id_sel_opc_buscar').val();
        
        var $id_txt_texto_ini_salidas   =       $('#id_txt_texto_ini_salidas').val();
        var $id_txt_texto_fin_salidas   =       $('#id_txt_texto_fin_salidas').val();
        var $id_txt_texto_nombre        =       $('#id_txt_texto_nombre').val();
        if($opc==1){
            if($id_txt_texto_ini_salidas=="" || $id_txt_texto_fin_salidas==""){
                $respuesta=false;
            }
        }else{
            if($id_txt_texto_nombre==""){
                $respuesta=false;
            }
        }
        
        $('#id_btn_clean_salidas').trigger('click');  
                
        if($respuesta==true){
            $('#id_result_busqueda_salidas').html('<img src="images/ajax-loader.gif">');
            
            /* Mostrando resultados en un dialog*/
            $( "#id_result_busqueda_salidas" ).dialog({
                height      : 350,
                width       : 950,
                modal       : true,
                draggable   : false,
                resizable   : false,
                title       : 'Buscando Salidas'
            });
        
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroSalidas.ctrl.php?accion=1',
                data            :   $('#id_form_buscar_salidas').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_salidas" class="ui-widget ui-widget-content" width="90%">';
                            table+='<thead>';
                            table+='<tr class="ui-widget-header ">';
                            table+='<th width="5%">#</th>';
                            table+='<th style="display:none">id</th>';                            
                            table+='<th style="display:none">idPersonal</th>';                            
                            table+='<th style="display:none">idProyecto</th>';                                                        
                            table+='<th width="25%" align="center">Nombre del Empleado</th>';                                                        
                            table+='<th width="25%" align="center">Nombre del Proyecto</th>';                                                                                    
                            table+='<th width="10%" align="center">Cantidad Utilizada</th>';                                                        
                            table+='<th width="10%" align="center">Fecha de Salida</th>';                                                                                    
                            table+='<th width="15%">OPCIONES</th>';
                            table+='</tr>';
                            table+='</thead>';
                            table+='<tbody>';
                            
                            
                            $.each(data.rows, function(index,value){
                                table+='<tr>';
                                table+='<td align="center">'+(index+1)+'</td>';
                                table+='<td style="display:none">'+value.id+'</td>';                               
                                table+='<td style="display:none">'+value.idPersonal+'</td>';                                                               
                                table+='<td style="display:none">'+value.idProyecto+'</td>';                                
                                table+='<td align="center">'+value.nom+'</td>';    
                                table+='<td align="center">'+value.NombreProyecto+'</td>';                                
                                table+='<td align="center">'+value.CantidadUtilizada+'</td>';                                
                                table+='<td align="center">'+value.FechaSalida+'</td>';                                
                                                            
                                                               
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_salidas').html(table);
                            $("#id_table_salidas tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_salidas tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_salidas').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_salidas').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_salidas').html('');
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
    var year = new Date();
    
    $( "#id_txt_texto_ini_salidas" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat:"yy-mm-dd",
        yearRange     :     (parseInt(year.getFullYear()-45))+":"+year.getFullYear(),
        onClose: function( selectedDate ) {
            $( "#id_txt_texto_fin_salidas" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#id_txt_texto_fin_salidas" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat:"yy-mm-dd",
        yearRange     :     (parseInt(year.getFullYear()-45))+":"+year.getFullYear(),
        onClose: function( selectedDate ) {
            $( "#id_txt_texto_ini_salidas" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    
    
    $('#id_txt_cantidad_salidas').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(80===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    
    var year = new Date();    
    $( "#id_txt_fecha_salidas" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat:"yy-mm-dd",
        yearRange     :     (parseInt(year.getFullYear()-45))+":"+year.getFullYear()
    });
        
    $('#id_btn_cancel_salidas').click(function(){       
        $('#id_btn_cancel_salidas').hide();
        $('#id_btn_delete_salidas').hide();
        $('#id_btn_update_salidas').hide();
        $('#id_btn_add_salidas').show();
    });
    
    $('#id_btn_clean_salidas').click(function(){
        $('#id_hidden_cod_empleado_salidas').val('');
        $('#id_txt_nombre_empleado_salidas').val('');        
        $('#id_hidden_cod_proyecto_salidas').val('');
        $('#id_txt_nombre_proyecto_salidas').val('');
        $('#id_txt_cantidad_salidas').val('');
        $('#id_txt_fecha_salidas').val('');
        $('#id_btn_cancel_salidas').trigger('click');  
    });
    
    $('#id_btn_add_salidas').click(function(){
        if(validar_form()){
            save_salidas(4);
        }
    });
    
    $('#id_btn_update_salidas').click(function(){
        if(validar_form()){
            save_salidas(5);
        }
    });
    
    $('#id_btn_delete_salidas').click(function(){
        $('#dialog').html('<p>Desea eliminar la Salida?</p>');
        $( "#dialog" ).dialog({
            title       : 'Confirmacion',
            resizable   : false,
            height      : 120,
            width       : 200,
            modal       : true,
            draggable   : false,
            buttons: {
                "Si": function() {
                    save_salidas(6);
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    var validar_form=function(){
        $hidden_cod_empleado_salidas=$('#id_hidden_cod_empleado_salidas').val();
        $hidden_cod_proyecto_salidas=$('#id_hidden_cod_proyecto_salidas').val();
        $txt_cantidad_salidas=$('#id_txt_cantidad_salidas').val();
        $txt_fecha_salidas=$('#id_txt_fecha_salidas').val();
        
        $respuesta=true;
        //verificacion de campos vacios
        if($hidden_cod_empleado_salidas=='' || $hidden_cod_proyecto_salidas=="" 
            || $txt_cantidad_salidas=="" || $txt_fecha_salidas=="" ){
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
    
    var save_salidas=function(estado){
        load_servidor();
        
        $.ajax
        ({
            type            :   'POST',
            url             :   'controlador/registroSalidas.ctrl.php?accion='+estado,
            data            :   $('#id_registrar_salidas').serialize(), 
            dataType        :   'json',
            contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
            success         :   function(data)
            {
                if(data.bandera==1){
                    $('#id_btn_clean_salidas').trigger('click');                    
                    $alert('Exito',data.mensaje,150,200);                    
                }else{
                    $alert('Error',data.mensaje,150,300);
                }                                    
            }
        });        
    }
    
    
   
    
});

var show_information_personal=function(row){
    $idPersonal=$(row).parents('tr').find('td').eq(1).html();
    $nombre=$(row).parents('tr').find('td').eq(2).html();
    $('#id_hidden_cod_empleado_salidas').val($idPersonal);
    $('#id_txt_nombre_empleado_salidas').val($nombre);
    $( '#id_div_form_buscar_empleado' ).dialog( "close" );
}


var show_information_proyecto=function(row){
    $idProveedor=$(row).parents('tr').find('td').eq(1).html();
    $descripcion=$(row).parents('tr').find('td').eq(4).html();
    $('#id_hidden_cod_proyecto_salidas').val($idProveedor);
    $('#id_txt_nombre_proyecto_salidas').val($descripcion);
    $( '#id_div_form_proyecto' ).dialog( "close" );
}

var show_information=function(row){
                                    
    $id=$(row).parents('tr').find('td').eq(1).html();    
    $idPersonal=$(row).parents('tr').find('td').eq(2).html();    
    $idProyecto=$(row).parents('tr').find('td').eq(3).html();        
    $nombre_empleado=$(row).parents('tr').find('td').eq(4).html();    
    $nombre_proyecto=$(row).parents('tr').find('td').eq(5).html();    
    $cantidadUtilizada=$(row).parents('tr').find('td').eq(6).html();    
    $fecha_salida=$(row).parents('tr').find('td').eq(7).html();    
   
   
    //clean de campos
    $('#id_btn_clean_salidas').trigger('click');
    
    $('#id_hidden_cod_salidas').val($id);
    $('#id_hidden_cod_empleado_salidas').val($idPersonal);
    $('#id_txt_nombre_empleado_salidas').val($nombre_empleado);        
    $('#id_hidden_cod_proyecto_salidas').val($idProyecto);
    $('#id_txt_nombre_proyecto_salidas').val($nombre_proyecto);
    $('#id_txt_cantidad_salidas').val($cantidadUtilizada);
    $('#id_txt_fecha_salidas').val($fecha_salida);
    
    $('#id_btn_update_salidas').show();
    $('#id_btn_delete_salidas').show();
    $('#id_btn_cancel_salidas').show();
    $('#id_btn_add_salidas').hide();
    $('#id_btn_clean_salidas').hide();
        
    //$('#id_table_salidas').hide();
    
    $( '#id_result_busqueda_salidas' ).dialog( "close" );
}   