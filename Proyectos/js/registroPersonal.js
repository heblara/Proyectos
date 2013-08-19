
$(document).ready(function(){
    
    
    $('#id_btn_buscar_personal').click(function(){
                            
        var $id_txt_texto_personal      =       $('#id_txt_texto_personal').val();
        var $id_sel_buscar_personal     =       $('#id_sel_buscar_personal').val();
        
        $('#id_btn_clean_personal').trigger('click');  
        
        if($id_txt_texto_personal!="" && $id_sel_buscar_personal!=""){
            $('#id_result_busqueda_personal').html('<img src="images/ajax-loader.gif">');
            
            /* Mostrando resultados en un dialog*/
            $( "#id_result_busqueda_personal" ).dialog({
                height      : 350,
                width       : 850,
                modal       : true,
                draggable   : false,
                resizable   : false
            });
        
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroPersonal.ctrl.php?accion=1',
                data            :   $('#id_form_buscar_personal').serialize(), 
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
                            table+='<th style="display:none">id_tipo_empleado</th>';                                                        
                            table+='<th style="display:none">label_tipo_empleado</th>';                                                        
                            table+='<th width="20%">Nombres</th>';                            
                            table+='<th width="20%">Apellidos</th>';           
                            table+='<th style="display:none">fecha_ingreso</th>';                                                        
                            table+='<th style="display:none">fecha_nacimiento</th>';                                                        
                            table+='<th style="display:none">habilidad1</th>';
                            table+='<th style="display:none">habilidad2</th>';                                                        
                            table+='<th style="display:none">habilidad3</th>';                                                                                    
                            table+='<th width="10%">dui</th>';           
                            table+='<th width="10%">nit</th>';           
                            table+='<th style="display:none">pasaporte</th>';                                                                                    
                            table+='<th style="display:none">nacionalidad</th>';      
                            table+='<th style="display:none">afp</th>';      
                            table+='<th style="display:none">nup</th>';      
                            table+='<th style="display:none">isss</th>';      
                            table+='<th style="display:none">salario</th>';      
                            table+='<th style="display:none">personal</th>';      
                            table+='<th width="15%">OPCIONES</th>';
                            table+='</tr>';
                            table+='</thead>';
                            table+='<tbody>';
                            var $razon;
                            
                            $.each(data.rows, function(index,value){
                                table+='<tr>';
                                table+='<td>'+(index+1)+'</td>';
                                table+='<td style="display:none">'+value.id+'</td>';                                                               
                                table+='<td style="display:none">'+value.id_tipo_empleado+'</td>';                                                               
                                table+='<td style="display:none">'+value.label_tipo_empleado+'</td>';                                                               
                                table+='<td>'+value.nombres+'</td>';                                                               
                                table+='<td>'+value.apellidos+'</td>';                                                               
                                table+='<td style="display:none">'+value.fecha_ingreso+'</td>';                                                               
                                table+='<td style="display:none">'+value.fecha_nacimiento+'</td>';                                                               
                                table+='<td style="display:none">'+value.habilidad1+'</td>';                                                               
                                table+='<td style="display:none">'+value.habilidad2+'</td>';                                                               
                                table+='<td style="display:none">'+value.habilidad3+'</td>';                                                               
                                table+='<td>'+value.dui+'</td>';                                                               
                                table+='<td>'+value.nit+'</td>';                                                               
                                table+='<td style="display:none">'+value.pasaporte+'</td>';                                                               
                                table+='<td style="display:none">'+value.nacionalidad+'</td>';                                                               
                                table+='<td style="display:none">'+value.afp+'</td>';                                                               
                                table+='<td style="display:none">'+value.nup+'</td>';                                                               
                                table+='<td style="display:none">'+value.isss+'</td>';                                                               
                                table+='<td style="display:none">'+value.salario+'</td>';                                                               
                                table+='<td style="display:none">'+value.personal+'</td>';                                                               
                                    
                                
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
                                table+='</tr>';
                            });
                            table+='</tbody>';
                            table+="</table>";
                        
                            $('#id_result_busqueda_personal').html(table);
                            $("#id_table_personal tbody tr:even").addClass('even'); // filas impares
                            $("#id_table_personal tbody tr:odd").addClass('odd'); // filas pares
                        }else{
                            $('#id_result_busqueda_personal').html('<p>No se encontraron coicidencias</p>');
                        }
                    }else{
                        $alert('Error',data.mensaje,130,200);
                        $('#id_result_busqueda_personal').html('');
                    }
                }
            });
        
        }else{
            $('#id_result_busqueda_personal').html('');
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
    $('#id_txt_nombre_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(250===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_apellidos_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(250===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
       
    var year = new Date();
    $( "#id_txt_fecha_ingreso_personal" ).datepicker
    ({
        defaultDate   :     "+1w",
        changeMonth   :     true,
        changeYear    :     true,
        numberOfMonths:     1,
        dateFormat    :     "yy-mm-dd",
        yearRange     :     (parseInt(year.getFullYear()-45))+":"+year.getFullYear()
    });
    
    $( "#id_txt_fecha_nacimiento_personal" ).datepicker
    ({
        defaultDate   :     "+1w",
        changeMonth   :     true,
        changeYear    :     true,
        numberOfMonths:     1,
        dateFormat    :     "yy-mm-dd",
        yearRange     :     (parseInt(year.getFullYear()-45))+":"+year.getFullYear()
    });
    
    $('#id_txt_dui_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(9===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_nit_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(14===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_pasaporte_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(20===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9A-Za-z]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_afp_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;            
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_nup_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(20===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9a-zA-Z]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_isss_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(20===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[0-9]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_nacionalidad_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(20===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    
    $('#id_texta_habilidad1_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;            
            if(150===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_texta_habilidad2_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;            
            if(150===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_texta_habilidad3_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;            
            if(150===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_txt_salario_personal').priceFormat({
        prefix: '',
        thousandsSeparator: ''
    });
        
    $('#id_txt_personal_personal').bind({
        keypress:function(event){
            var tecla = (document.all) ? event.keyCode : event.which;                              
            if(tecla===0 || tecla===8 || tecla===9) return true;
            if(45===$(this).val().length)return false;
            var convertirTecla=String.fromCharCode(tecla);
            var patron=/^[A-Za-zñÑáéíóúÁÉÍÓÚ#,.:;-_\s]{1}/;
            return patron.test(convertirTecla);  
        }
    });
    
    $('#id_btn_cancel_personal').click(function(){        
        $('#id_btn_cancel_personal').hide();
        $('#id_btn_delete_personal').hide();
        $('#id_btn_update_personal').hide();
        $('#id_row_imagen').hide();
        $('#id_btn_add_personal').show();
        $('#id_btn_clean_personal').show();
    });
    
    $('#id_btn_clean_personal').click(function(){
        $('#id_sel_tipo_empleado_personal').val('');
        $('#id_txt_nombre_personal').val('');
        $('#id_txt_apellidos_personal').val('');
        $('#id_txt_fecha_ingreso_personal').val('');
        $('#id_txt_fecha_nacimiento_personal').val('');
        $('#id_txt_dui_personal').val('');
        $('#id_txt_nit_personal').val('');        
        $('#id_txt_pasaporte_personal').val('');        
        $('#id_txt_afp_personal').val('');
        $('#id_txt_nup_personal').val('');        
        $('#id_txt_isss_personal').val('');        
        $('#id_txt_nacionalidad_personal').val('');
        $('#id_texta_habilidad1_personal').val('');
        $('#id_texta_habilidad2_personal').val('');
        $('#id_texta_habilidad3_personal').val('');
        $('#id_txt_salario_personal').val('');
        $('#id_txt_personal_personal').val('');
        $('#id_btn_cancel_personal').trigger('click');
    });
    
    $('#id_btn_add_personal').click(function(){
        if(validar_form()){
            save_personal(2);
        }
    });
    
    $('#id_btn_update_personal').click(function(){
        if(validar_form()){
            save_personal(3);
        }
    });
    
    $('#id_btn_delete_personal').click(function(){
        $('#dialog').html('<p>Desea eliminar el Personal?</p>');
        $( "#dialog" ).dialog({
            title       : 'Confirmacion',
            resizable   : false,
            height      : 120,
            width       : 200,
            modal       : true,
            draggable   : false,
            buttons: {
                "Si": function() {
                    save_personal(4);                
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    var validar_form=function(){
        $tipo_empleado=$('#id_sel_tipo_empleado_personal').val();
        $nombres=$('#id_txt_nombre_personal').val();
        $apellidos=$('#id_txt_apellidos_personal').val();
        $fecha_ingreso=$('#id_txt_fecha_ingreso_personal').val();
        $fecha_nacimiento=$('#id_txt_fecha_nacimiento_personal').val();
        $dui=$('#id_txt_dui_personal').val();
        $nit=$('#id_txt_nit_personal').val();        
        $afp=$('#id_txt_afp_personal').val();
        $isss=$('#id_txt_isss_personal').val();        
        $nacionalidad=$('#id_txt_nacionalidad_personal').val();
        $salario=$('#id_txt_salario_personal').val();
        
        $respuesta=true;
        //verificacion de campos vacios
               
        if($tipo_empleado=="" || $nombres=="" || $apellidos=="" || $fecha_ingreso=="" || 
            $fecha_nacimiento=="" || $dui=="" || $nit=="" || 
            $afp=="" || $nacionalidad=="" || $salario=="" || $isss==""){
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
    
    var save_personal=function(estado){
        
        load_servidor(); 
        
        $.ajax
        ({
            type            :   'POST',
            url             :   'controlador/registroPersonal.ctrl.php?accion='+estado,
            data            :   $('#id_registrar_personal').serialize(), 
            dataType        :   'json',
            contentType     :   'application/x-www-form-urlencoded; charset=UTF-8', //Tipo de contenido que se enviara
            success         :   function(data)
            {                
                if(data.bandera==1){
                    $('#id_btn_clean_personal').trigger('click');                    
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
    var id_tipo_empleado=$(row).parents('tr').find('td').eq(2).html();
    var nombres=$(row).parents('tr').find('td').eq(4).html();
    var apellidos=$(row).parents('tr').find('td').eq(5).html();
    var fecha_ingreso=$(row).parents('tr').find('td').eq(6).html();
    var fecha_nacimiento=$(row).parents('tr').find('td').eq(7).html();
    var habilidad1=$(row).parents('tr').find('td').eq(8).html();
    var habilidad2=$(row).parents('tr').find('td').eq(9).html();
    var habilidad3=$(row).parents('tr').find('td').eq(10).html();
    var dui=$(row).parents('tr').find('td').eq(11).html();
    var nit=$(row).parents('tr').find('td').eq(12).html();
    var pasaporte=$(row).parents('tr').find('td').eq(13).html();
    var nacionalidad=$(row).parents('tr').find('td').eq(14).html();
    var afp=$(row).parents('tr').find('td').eq(15).html();
    var nup=$(row).parents('tr').find('td').eq(16).html();
    var isss=$(row).parents('tr').find('td').eq(17).html();
    var salario=$(row).parents('tr').find('td').eq(18).html();
    var personal=$(row).parents('tr').find('td').eq(19).html();
    
    
    //clean de campos
    $('#id_btn_clean_personal').trigger('click');
     
    $('#id_hidden_cod_personal').val(id);
    $('#id_sel_tipo_empleado_personal').val(id_tipo_empleado);
    $('#id_txt_nombre_personal').val(nombres);
    $('#id_txt_apellidos_personal').val(apellidos);
    $('#id_txt_fecha_ingreso_personal').val(fecha_ingreso);
    $('#id_txt_fecha_nacimiento_personal').val(fecha_nacimiento);
    $('#id_txt_dui_personal').val(dui);
    $('#id_txt_nit_personal').val(nit);        
    $('#id_txt_pasaporte_personal').val(pasaporte);        
    $('#id_txt_afp_personal').val(afp);
    $('#id_txt_nup_personal').val(nup);        
    $('#id_txt_isss_personal').val(isss);        
    $('#id_txt_nacionalidad_personal').val(nacionalidad);
    $('#id_texta_habilidad1_personal').val(habilidad1);
    $('#id_texta_habilidad2_personal').val(habilidad2);
    $('#id_texta_habilidad3_personal').val(habilidad3);
    $('#id_txt_salario_personal').val(salario);
    $('#id_txt_personal_personal').val(personal);
    
    $('#id_btn_update_personal').show();
    $('#id_btn_delete_personal').show();
    $('#id_btn_add_personal').hide();
    $('#id_btn_clean_personal').show();
    $('#id_table_personal').hide();
    
    $( '#id_result_busqueda_personal' ).dialog( "close" );
} 