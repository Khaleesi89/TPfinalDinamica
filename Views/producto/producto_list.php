<?php
require_once('../../config.php');
$objConPro = new ProductoController();
$lista = $objConPro->listarTodo();
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
    <table id="dg" title="Administrador de pruductus" class="easyui-datagrid" style="width:700px;height:600px" url="accion/listar_producto.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idproducto" width="50">Id</th>
                <th field="pronombre" width="50">Nombre producto</th>
                <th field="sinopsis" width="50">Sinopsis</th>
                <th field="procantstock" width="50">Stock</th>
                <th field="autor" width="50">Autor</th>
                <th field="precio" width="50">Precio</th>
                <th field="isbn" width="50">ISBN</th>
                <th field="categoria" width="50">Categoria</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newProducto()">Nuevo producto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editProducto()">Editar producto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyProducto()">Destroy producto</a>  
    </div>
    <div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="POST" novalidate style="margin:0,padding:20px 50px;">
    <h3>Producto informacion</h3>
    <div style="margin-bottom:10px;">
        <input name="pronombre" id="pronombre" class="easyui-textbox" required="true" label="Nombre" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="sinopsis" id="sinopsis" class="easyui-textbox" required="true" label="Sinopsis" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="procantstock" id="procantstock" class="easyui-textbox" required="true" label="Stock" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="autor" id="autor" class="easyui-textbox" required="true" label="Autor" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="precio" id="precio" class="easyui-textbox" required="true" label="Precio" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="isbn" id="isbn" class="easyui-textbox" required="true" label="ISBN" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="categoria" id="categoria" class="easyui-textbox" required="true" label="Categoria" style="width:100%;">
    </div>
    
        
    </form>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarProducto()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script>
        var url;
        function newProducto(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo producto');
            $('#fm').form('clear');
            url='accion/insertar_producto.php';
        }
        function editProducto(){
            var row = $('#dg').datagrid('getSelected');
            if(row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar producto');
                $('#fm').form('load', row);
                url='accion/edit_producto.php?idproducto='+row.idproducto;
            }
        }
        function guardarProducto(){
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
        function destroyProducto(){
            var row=$('#dg').datagrid('getSelected');
            if(row){
                $.messager.confirm('confirm', 'Seguro desea eliminar el producto?', function(r){
                    if(r){
                        $.post('accion/destroy_producto.php?idproducto='+row.idproducto,{idproducto:row.id}, function(result){
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