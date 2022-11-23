<?php
require_once('../../config.php');
$objConCompraestadotipo = new CompraestadotipoController();
$lista = $objConCompraestadotipo->listarTodo();
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
    <table id="dg" title="Administrador de pruductus" class="easyui-datagrid" style="width:700px;height:600px" url="accion/listar_compraestadotipo.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idcompraestadotipo" width="50">Id</th>
                <th field="cetdescripcion" width="50">Nombre estado de compra</th>
                <th field="cetdetalle" width="50">Detalle</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newEstadoCompraTipo()">Nuevo estado de compra</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editEstadoCompraTipo()">Editar estado de compra</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyEstadoCompraTipo()">Destroy estado de compra</a>  
    </div>
    <div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="POST" novalidate style="margin:0;padding:20px 50px;">
    <h3>Producto informacion</h3>
    <div style="margin-bottom:10px;">
        <input name="cetdescripcion" id="cetdescripcion" class="easyui-textbox" required="true" label="Cetdescripcion" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="cetdetalle" id="cetdetalle" class="easyui-textbox" required="true" label="Cetdetalle" style="width:100%;">
    </div>
    </form>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarEstadoCompraTipo()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script>
        var url;
        function newEstadoCompraTipo(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo estado compra');
            $('#fm').form('clear');
            url='accion/insertar_compraestadotipo.php';
        }
        function editEstadoCompraTipo(){
            var row = $('#dg').datagrid('getSelected');
            if(row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar estado de compra');
                $('#fm').form('load', row);
                url='accion/edit_compraestadotipo.php?idcompraestadotipo='+row.idcompraestadotipo;
            }
        }
        function guardarEstadoCompraTipo(){
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
        function destroyEstadoCompraTipo(){
            var row=$('#dg').datagrid('getSelected');
            if(row){
                $.messager.confirm('confirm', 'Seguro desea eliminar el producto?', function(r){
                    if(r){
                        $.post('accion/destroy_compraestadotipo.php?idcompraestadotipo='+row.idcompraestadotipo,{compraestadotipo:row.id}, function(result){
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