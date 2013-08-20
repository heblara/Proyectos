$(document).ready(function(){
    
    $('#id_btn_buscar_entradas').click(function(){
                            
        var $id_txt_texto_ini_entradas      =       $('#id_txt_texto_ini_entradas').val();
        var $id_txt_texto_fin_entradas     =       $('#id_txt_texto_fin_entradas').val();
        
        $('#id_btn_clean_entradas').trigger('click');  
        
        
        if($id_txt_texto_ini_entradas!="" || $id_txt_texto_fin_entradas!=""){
            $('#id_result_busqueda_entradas').html('<img src="images/ajax-loader.gif">');
            
            /* Mostrando resultados en un dialog*/
            $( "#id_result_busqueda_entradas" ).dialog({
                height      : 350,
                width       : 950,
                modal       : true,
                draggable   : false,
                resizable   : false
            });
        
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroEntradas.ctrl.php?accion=1',
                data            :   $('#id_form_buscar_entradas').serialize(), 
                dataType        :   'json',
                contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
                success         :   function(data)
                {
                    if(data.bandera==1){
                        
                        if(data.total_rows>0){
                            var table='<table id="id_table_entradas" class="ui-widget ui-widget-content" width="90%">';
                            table+='<thead>';
                            table+='<tr class="ui-widget-header ">';
                            table+='<th width="5%">#</th>';
                            table+='<th style="display:none">id</th>';                            
                            table+='<th style="display:none">idProveedor</th>';                            
                            table+='<th width="10%" align="center">Fecha de Compra</th>';                                                        
                            table+='<th width="10%" align="center">Cantidad de Producto</th>';                                                        
                            table+='<th width="10%" align="center">Valor de Producto</th>';                                                        
                            table+='<th width="10%" align="center">Porcentaje IVA</th>';                                                        
                            table+='<th width="10%" align="center">Calculo IVA</th>';                                                        
                            table+='<th width="10%" align="center">Stock Minimo</th>';                                                        
                            table+='<th width="10%" align="center">Stock Maximo</th>';                                                        
                            table+='<th width="10%" align="center">Anulada</th>';                                                        
                            table+='<th width="15%">OPCIONES</th>';
                            table+='</tr>';
                            table+='</thead>';
                            table+='<tbody>';
                            
                            
                            $.each(data.rows, function(index,value){
                                table+='<tr>';
                                table+='<td align="center">'+(index+1)+'</td>';
                                table+='<td style="display:none">'+value.id+'</td>';                               
                                table+='<td style="display:none">'+value.idProveedor+'</td>';                                                               
                                table+='<td align="center">'+value.FechaCompra+'</td>';                                
                                table+='<td align="center">'+value.CantidadProducto+'</td>';                                
                                table+='<td align="center">'+value.ValorProducto+'</td>';                                
                                table+='<td align="center">'+value.PorcentajeIVA+'</td>';                                
                                table+='<td align="center">'+value.CalculoIVA+'</td>';                                
                                table+='<td align="center">'+value.StockMinimo+'</td>';                                
                                table+='<td align="center">'+value.StockMaximo+'</td>';                                
                                
                                $anulada="NO";
                                if(value.Anulada==1){
                                    $anulada="SI";
                                }
                                
                                table+='<td align="center">'+$anulada+'</td>';                                
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_entradas').html(table);
                            $("#id_table_entradas tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_entradas tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_entradas').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_entradas').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_entradas').html('');
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
    
    $( "#id_txt_texto_ini_entradas" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat:"yy-mm-dd",
        yearRange     :     (parseInt(year.getFullYear()-45))+":"+year.getFullYear(),
        onClose: function( selectedDate ) {
            $( "#id_txt_texto_fin_entradas" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#id_txt_texto_fin_entradas" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat:"yy-mm-dd",
        yearRange     :     (parseInt(year.getFullYear()-45))+":"+year.getFullYear(),
        onClose: function( selectedDate ) {
            $( "#id_txt_texto_ini_entradas" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    
    
        
    $( "#id_txt_fecha_compra_entradas" ).datepicker
    ({
        defaultDate   :     "+1w",
        changeMonth   :     true,
        changeYear    :     true,
        numberOfMonths:     1,
        dateFormat    :     "yy-mm-dd",
        yearRange     :     (parseInt(year.getFullYear()-45))+":"+year.getFullYear()
    });
    
    $('#id_txt_cantidad_producto_entradas').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(80===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
       
    $('#id_txt_valor_producto_entradas').priceFormat({
        prefix: '',
        thousandsSeparator: ''
    });
    
    
    $('#id_txt_porcentaje_entradas').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(80===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    
    $('#id_txt_stock_minimo_entradas').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(80===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9]{1}/;
            return patron.test(convertirTecla);  
        },
        focus:function(){
            calcular_iva();
        }
    });
    
    $('#id_txt_stock_maximo_entradas').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(80===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9]{1}/;
            return patron.test(convertirTecla);  
        },
        focus:function(){
            calcular_iva();
        }
    });
        
    $('#id_btn_cancel_entradas').click(function(){       
        $('#id_btn_cancel_entradas').hide();
        $('#id_btn_delete_entradas').hide();
        $('#id_btn_update_entradas').hide();
        $('#id_btn_add_entradas').show();
    });
    
    $('#id_btn_clean_entradas').click(function(){
        $('#id_sel_proveedores_entradas').val('');
        $('#id_txt_fecha_compra_entradas').val('');
        $('#id_txt_cantidad_producto_entradas').val('');
        $('#id_txt_valor_producto_entradas').val('');
        $('#id_txt_porcentaje_entradas').val('');
        $('#id_txt_calculo_iva_entradas').val('');
        $('#id_txt_stock_minimo_entradas').val('');
        $('#id_txt_stock_maximo_entradas').val('');
        $('#id_ckd_anulada_entradas').removeAttr('checked')
        $('#id_btn_cancel_entradas').trigger('click');  
    });
    
    $('#id_btn_add_entradas').click(function(){
        if(validar_form()){
            save_entradas(2);
        }
    });
    
    $('#id_btn_update_entradas').click(function(){
        if(validar_form()){
            save_entradas(3);
        }
    });
    
    $('#id_btn_delete_entradas').click(function(){
        $('#dialog').html('<p>Desea eliminar la Entrada?</p>');
        $( "#dialog" ).dialog({
            title       : 'Confirmacion',
            resizable   : false,
            height      : 120,
            width       : 200,
            modal       : true,
            draggable   : false,
            buttons: {
                "Si": function() {
                    save_entradas(4);
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    var validar_form=function(){
        $sel_proveedores_entradas = $('#id_sel_proveedores_entradas').val();
        $txt_fecha_compra_entradas = $('#id_txt_fecha_compra_entradas').val();
        $txt_cantidad_producto_entradas = $('#id_txt_cantidad_producto_entradas').val();
        $txt_valor_producto_entradas = $('#id_txt_valor_producto_entradas').val();
        $txt_porcentaje_entradas = $('#id_txt_porcentaje_entradas').val();
        $txt_calculo_iva_entradas = $('#id_txt_calculo_iva_entradas').val();
        $txt_stock_minimo_entradas = $('#id_txt_stock_minimo_entradas').val();
        $txt_stock_maximo_entradas = $('#id_txt_stock_maximo_entradas').val();
        
        $respuesta=true;
        //verificacion de campos vacios
        if($sel_proveedores_entradas=='' || $txt_fecha_compra_entradas=="" || $txt_cantidad_producto_entradas=="" 
            || $txt_valor_producto_entradas=="" || $txt_porcentaje_entradas=="" || $txt_calculo_iva_entradas=="" 
            || $txt_stock_minimo_entradas=="" || $txt_stock_maximo_entradas==""){
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
    
    var save_entradas=function(estado){
        load_servidor();
        
        $.ajax
        ({
            type            :   'POST',
            url             :   'controlador/registroEntradas.ctrl.php?accion='+estado,
            data            :   $('#id_registrar_entradas').serialize(), 
            dataType        :   'json',
            contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
            success         :   function(data)
            {
                if(data.bandera==1){
                    $('#id_btn_clean_entradas').trigger('click');                    
                    $alert('Exito',data.mensaje,150,200);                    
                }else{
                    $alert('Error',data.mensaje,150,300);
                }                                    
            }
        });        
    }
    
    
    var calcular_iva=function(){
        $txt_cantidad_producto_entradas = $('#id_txt_cantidad_producto_entradas').val();
        $txt_valor_producto_entradas = $('#id_txt_valor_producto_entradas').val();
        $txt_porcentaje_entradas = $('#id_txt_porcentaje_entradas').val();
        var calc=0;
        
        if($txt_cantidad_producto_entradas!="" && $txt_valor_producto_entradas!="" || $txt_porcentaje_entradas!=""){
            calc=($txt_cantidad_producto_entradas * $txt_valor_producto_entradas)*($txt_porcentaje_entradas/100);
            $('#id_txt_calculo_iva_entradas').val(calc);
        }
    }
    
});

var show_information=function(row){
    $idEntrada=$(row).parents('tr').find('td').eq(1).html();    
    $sel_proveedores_entradas = $(row).parents('tr').find('td').eq(2).html();    
    $txt_fecha_compra_entradas = $(row).parents('tr').find('td').eq(3).html();
    $txt_cantidad_producto_entradas = $(row).parents('tr').find('td').eq(4).html();
    $txt_valor_producto_entradas = $(row).parents('tr').find('td').eq(5).html();
    $txt_porcentaje_entradas = $(row).parents('tr').find('td').eq(6).html();
    $txt_calculo_iva_entradas = $(row).parents('tr').find('td').eq(7).html();
    $txt_stock_minimo_entradas = $(row).parents('tr').find('td').eq(8).html();
    $txt_stock_maximo_entradas =$(row).parents('tr').find('td').eq(9).html();  
    $chk_anulada_entradas =$(row).parents('tr').find('td').eq(10).html();  
    //clean de campos
    $('#id_btn_clean_entradas').trigger('click');
     
    $('#id_hidden_cod_entradas').val($idEntrada);
    $('#id_sel_proveedores_entradas').val($sel_proveedores_entradas);
    $('#id_txt_fecha_compra_entradas').val($txt_fecha_compra_entradas);
    $('#id_txt_cantidad_producto_entradas').val($txt_cantidad_producto_entradas);
    $('#id_txt_valor_producto_entradas').val($txt_valor_producto_entradas);
    $('#id_txt_porcentaje_entradas').val($txt_porcentaje_entradas);
    $('#id_txt_calculo_iva_entradas').val($txt_calculo_iva_entradas);
    $('#id_txt_stock_minimo_entradas').val($txt_stock_minimo_entradas);
    $('#id_txt_stock_maximo_entradas').val($txt_stock_maximo_entradas);
    
    if($chk_anulada_entradas=="SI"){
        $('#id_ckd_anulada_entradas').attr('checked',true);
    }
    
            
    $('#id_btn_update_entradas').show();
    $('#id_btn_delete_entradas').show();
    $('#id_btn_cancel_entradas').show();
    $('#id_btn_add_entradas').hide();
    $('#id_btn_clean_entradas').hide();
        
    //$('#id_table_entradas').hide();
    
    $( '#id_result_busqueda_entradas' ).dialog( "close" );
}   