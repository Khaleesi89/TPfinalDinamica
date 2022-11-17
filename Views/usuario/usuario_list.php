<?php
require_once('../../config.php');
$objUsuCon = new UsuarioController();
$lista = $objUsuCon->listarTodo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Vendor/themes/default/easyui.css">
    <link rel="stylesheet" href="../../Vendor/themes/icon.css">
    <link rel="stylesheet" href="../../Vendor/themes/color.css">
    <link rel="stylesheet" href="../../Vendor/demo/demo.css">
    <script src="../../Vendor/jquery.min.js"></script>
    <script src="../../Vendor/jquery.easyui.min.js"></script>
    <title>Prueba isiUI</title>
</head>
<body>
    <table id="dg" title="Administrador de Usuarios" class="easyui-datagrid" style="width:700px;height:600px" url="accion/listar_usuario.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idusuario" width="50">Id</th>
                <th field="usnombre" width="50">Nombre</th>
                <th field="usmail" width="50">Mail</th>
                <th field="usdeshabilitado" width="50">Fecha Deshabilitado</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUsuario()">Nuevo Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUsuario()">Editar Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUsuario()">Deshabilitar Usuario</a>  
    </div>
    <div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="POST" novalidate style="margin:0,padding:20px 50px;">
    <h3>Usuario Información</h3>
    <!-- <div style="margin-bottom:10px;">
        <input name="idusuario" id="idusuario" class="easyui-textbox" required="true" label="Id usuario" style="width:100%;">
    </div> -->
    <div style="margin-bottom:10px;">
        <input name="usnombre" id="usnombre" class="easyui-textbox" required="true" label="Nombre" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="uspass" id="uspass" class="easyui-textbox" required="true" label="Password" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="usmail" id="usmail" class="easyui-textbox" required="true" label="Email" style="width:100%;">
    </div>
        
        
    </form>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarUsuario()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script>
        var url;
        function newUsuario(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo usuario');
            $('#fm').form('clear');
            url='accion/insertar_usuario.php';
        }
        function editUsuario(){
            var row = $('#dg').datagrid('getSelected');
            if(row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar usuario');
                $('#fm').form('load', row);
                url='accion/edit_usuario.php?idusuario='+row.idusuario;
            }
        }
        function guardarUsuario(){
            $('#fm').form('submit', {
                url:url,
                onSubmit:function(){
                    return $(this).form('validate');
                },
                success:function(result){
                    var result=eval('('+result+')');
                    //alert('Volvio servidor');
                    if(!result.respuesta){
                        $.messager.show({
                            title:'Error',
                            msg:result.errorMsg
                        });
                    }else{
                        $('#dlg').dialog('close');
                        $('#dg').datagrid('reload');
                    }
                }
            })
        }
        function destroyUsuario(){
            var row=$('#dg').datagrid('getSelected');
            if(row){
                $.messager.confirm('confirm', 'Seguro desea eliminar el usuario?', function(r){
                    if(r){
                        $.post('accion/destroy_usuario.php?idusuario='+row.idusuario,{idusuario:row.id}, function(result){
                            alert('Volvio servidor');
                            if(result.respuesta){
                                $('#dg').datagrid('reload');
                            }else{
                                $.messager.show({
                                    title:'Error',
                                    msg:result.errorMsg
                                });
                            }
                        }, 'json');
                    }
                })
            }
        }
    </script>
        
    </div>
</body>
</html>