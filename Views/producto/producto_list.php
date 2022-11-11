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
    <table id="dg" title="Administrador de pruductus" class="easyui-datagrid" style="width:700px;height:250px" url="accion/listar_producto.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
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
    <div style="margin-bottom:10px;">
        <input name="prdesahabilitad" id="prdesahabilitad" class="easyui-checkbox" required="true" label="Nombre" style="width:100%;">
    </div>
        
    </form>
        
    </div>
</body>
</html>