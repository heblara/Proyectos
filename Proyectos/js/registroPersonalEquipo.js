//var $_jquery=jquery.noConflict();

$(document).ready(function(){
    
    $('#id_btn_show_buscar_equipo').click(function(){
                            
        /* Mostrando resultados en un dialog*/
        $( "#id_div_form_buscar" ).dialog({
            height      : 350,
            width       : 950,
            modal       : true,
            draggable   : false,
            resizable   : false,
            title       : 'Busqueda de equipo'  
        });       
    });
    
    $('#id_btn_show_buscar_personal').attr("disabled",true);
    
    $('#id_btn_show_buscar_personal').click(function(){
                            
        /* Mostrando resultados en un dialog*/
        $( "#id_div_form_buscar_personal" ).dialog({
            height      : 350,
            width       : 950,
            modal       : true,
            draggable   : false,
            resizable   : false,
            title       : 'Busqueda de personal'  
        });       
    });
    
    $('#id_btn_buscar_equipo').click(function(){
        
        var $id_txt_texto_equipo      =       $('#id_txt_buscar_equipo').val();
        
        if($id_txt_texto_equipo!=""){
            $('#id_result_busqueda_equipo').html('<img src="images/ajax-loader.gif">');
            
                   
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroPersonalEquipo.ctrl.php?accion=1',
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
                                
                                table+='<td><input type="button" value="Seleccionar" onclick="show_information(this)"></td>';
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
    
    
    
    
    $('#id_btn_buscar_personal').click(function(){
        
        var $id_txt_texto_equipo      =       $('#id_txt_buscar_personal').val();
        
        if($id_txt_texto_equipo!=""){
            $('#id_result_busqueda_personal').html('<img src="images/ajax-loader.gif">');
            
                   
            $.ajax
            ({
                type            :   'POST',
                url             :   'controlador/registroPersonalEquipo.ctrl.php?accion=2',
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
        
  
    
    var validar_form=function(){
        $equipo=$('#id_txt_nombre_equipo_personal_equipo').val();       
        $existe_input=$('.input_personal').length;
        
        $respuesta=true;
        //verificacion de campos vacios
        
        if($equipo=="" || $existe_input==0 ){
            $alert('Error','Debe de llenar todos los campos requeridos',130,200);            
            $respuesta=false;
        }
        
        return $respuesta;
    }
    
    
            
});



var $alert2=function(title,mensaje,height,width){
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


var load_datos=function(idEquipo){
    load_servidor(); 
    $.ajax
    ({
        type            :   'POST',
        url             :   'controlador/registroPersonalEquipo.ctrl.php?accion=5',            
        dataType        :   'json',
        data             :{
            txt_id_equipo:idEquipo
        },
        success         :   function(data)
        {
            if(data.bandera==1){
                if(data.total_rows>0){
                    $.each(data.rows, function(index,value){
                        $input='<input type="text" id="id_personal'+contadorText+'" name="personal'+contadorText+'" value="'+value.nombre+'" >';
                        $inputHidden='<input type="hidden" id="id_personal'+contadorText+'" name="hidden_personal'+contadorText+'" value="'+value.id+'" class="input_personal">';
                        $button='<input type="button" id="id_btn_personal'+contadorText+'"  name="btn_personal'+contadorText+'" value="Eliminar" style="float:right;position:absolute;" onclick="eliminar_personal(\''+value.id+'\',\''+value.idEquipo+'\',\'#id_div_personal'+contadorText+'\')">'; 
                        $('#id_btn_show_buscar_personal').after('<div id="id_div_personal'+contadorText+'" style="width:85%" class="div_personal_seleccionado">'+$input+$inputHidden+$button+'</div>');
                        contadorText++; 
                    });
                }
            }
            
            $('#dialog').dialog("close");
        }
    });
        
      
}
    
    
    
var save_personal_equipo=function(estado,idPersonal,idEquipo){
        
    load_servidor(); 
                      
    $.ajax
    ({
        type            :   'POST',
        url             :   'controlador/registroPersonalEquipo.ctrl.php?accion='+estado,            
        dataType        :   'json',
        data            :{
            txt_idPersonal:idPersonal,
            txt_idEquipo:idEquipo
        },
        success         :   function(data)
        {
            if(data.bandera==1){                
                $alert2('Exito',data.mensaje,150,200);                    
            }else{
                $alert2('Error',data.mensaje,150,300);
            }                                    
        }
    });        
}


var show_information=function(row){
    $(".div_personal_seleccionado").remove();                          
    var id=$(row).parents('tr').find('td').eq(1).html();
    var nombre=$(row).parents('tr').find('td').eq(2).html();
    
    load_datos(id);
  
    $('#id_hidden_cod_personal_equipo').val(id);
    $('#id_txt_nombre_equipo_personal_equipo').val(nombre);
    $('#id_btn_show_buscar_personal').removeAttr("disabled");
   
    $( '#id_div_form_buscar' ).dialog( "close" );
} 

var contadorText=0;
var show_information_personal=function(row){
    var id=$(row).parents('tr').find('td').eq(1).html();
    var nombre=$(row).parents('tr').find('td').eq(2).html();
    var idEquipo=$('#id_hidden_cod_personal_equipo').val();
    
    //verificacion si existe registros 
    $existe_input=$('.input_personal').length;
    if($existe_input>0){
        $existe=0;
        $.each($('.input_personal'), function(index,value){
            if($(value).val()==id){
                $existe++;
            }
        });
        
        
        if($existe==0){
            save_personal_equipo(3,id,idEquipo);
            $input='<input type="text" id="id_personal'+contadorText+'" name="personal'+contadorText+'" value="'+nombre+'" >';
            $inputHidden='<input type="hidden" id="id_personal'+contadorText+'" name="hidden_personal'+contadorText+'" value="'+id+'" class="input_personal">';
            $button='<input type="button" id="id_btn_personal'+contadorText+'"  name="btn_personal'+contadorText+'" value="Eliminar" style="float:right;position:absolute;" onclick="eliminar_personal(\''+id+'\',\''+idEquipo+'\',\'#id_div_personal'+contadorText+'\')">'; 
            $('#id_btn_show_buscar_personal').after('<div id="id_div_personal'+contadorText+'" style="width:85%" class="div_personal_seleccionado">'+$input+$inputHidden+$button+'</div>');
            contadorText++; 
        }
    }else{
        save_personal_equipo(3,id,idEquipo);
        $input='<input type="text" id="id_personal'+contadorText+'" name="personal'+contadorText+'" value="'+nombre+'" >';
        $inputHidden='<input type="hidden" id="id_personal'+contadorText+'" name="hidden_personal'+contadorText+'" value="'+id+'" class="input_personal">';
        $button='<input type="button" id="id_btn_personal'+contadorText+'"  name="btn_personal'+contadorText+'" value="Eliminar" style="float:right;position:absolute;" onclick="eliminar_personal(\''+id+'\',\''+idEquipo+'\',\'#id_div_personal'+contadorText+'\')">';    
        $('#id_btn_show_buscar_personal').after('<div id="id_div_personal'+contadorText+'" style="width:85%" class="div_personal_seleccionado">'+$input+$inputHidden+$button+'</div>');
        contadorText++; 
    }
    $(row).parents('tr').remove();
    var tr=$('#id_table_personal tr').length;
    
    //verificacion que solo existe el titulo de la tabla
    //para limpiar controlador
    if(tr==1){
        $('#id_result_busqueda_personal').html('');  
    }
        
    
}


var eliminar_personal=function(idPersonal,idEquipo,div){
    $('#dialog').html('<p>Desea eliminar el Personal del Proyecto?</p>');
    $( "#dialog" ).dialog({
        title       : 'Confirmacion',
        resizable   : false,
        height      : 120,
        width       : 200,
        modal       : true,
        draggable   : false,
        buttons: {
            "Si": function() {
                $(div).remove();
                save_personal_equipo(4,idPersonal,idEquipo);          
            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
    
    
}